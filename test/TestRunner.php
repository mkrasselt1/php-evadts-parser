<?php

/**
 * Custom Test Runner for EVA-DTS Parser
 * Provides PHPUnit-like test reporting and statistics
 */
class TestRunner 
{
    private $tests = [];
    private $results = [];
    private $startTime;
    private $assertions = 0;
    private $passed = 0;
    private $failed = 0;
    private $skipped = 0;
    private $coverage = [];
    private $currentTest = null;
    
    public function __construct() 
    {
        $this->startTime = microtime(true);
    }
    
    /**
     * Add a test to run
     */
    public function addTest($name, $callable, $description = '') 
    {
        $this->tests[] = [
            'name' => $name,
            'callable' => $callable,
            'description' => $description
        ];
    }
    
    /**
     * Run all tests and generate report
     */
    public function run() 
    {
        echo "\n" . str_repeat("=", 70) . "\n";
        echo "EVA-DTS Parser Test Suite\n";
        echo str_repeat("=", 70) . "\n\n";
        
        foreach ($this->tests as $test) {
            $this->runTest($test);
        }
        
        $this->generateFinalReport();
    }
    
    /**
     * Run individual test
     */
    private function runTest($test) 
    {
        $this->currentTest = $test['name'];
        echo "Running: {$test['name']}";
        if ($test['description']) {
            echo " - {$test['description']}";
        }
        echo "\n";
        
        $testStart = microtime(true);
        
        try {
            $result = call_user_func($test['callable']);
            $duration = microtime(true) - $testStart;
            
            if ($result === true || $result === null) {
                $this->passed++;
                echo "  ✓ PASSED (" . number_format($duration, 3) . "s)\n";
                $this->results[] = ['test' => $test['name'], 'status' => 'PASSED', 'duration' => $duration];
            } else {
                $this->failed++;
                echo "  ✗ FAILED (" . number_format($duration, 3) . "s)\n";
                if (is_string($result)) {
                    echo "    Reason: $result\n";
                }
                $this->results[] = ['test' => $test['name'], 'status' => 'FAILED', 'duration' => $duration, 'message' => $result];
            }
        } catch (Exception $e) {
            $duration = microtime(true) - $testStart;
            $this->failed++;
            echo "  ✗ ERROR (" . number_format($duration, 3) . "s)\n";
            echo "    Exception: " . $e->getMessage() . "\n";
            $this->results[] = ['test' => $test['name'], 'status' => 'ERROR', 'duration' => $duration, 'message' => $e->getMessage()];
        }
        
        echo "\n";
    }
    
    /**
     * Assert that condition is true
     */
    public function assertTrue($condition, $message = '') 
    {
        $this->assertions++;
        if (!$condition) {
            throw new Exception($message ?: 'Assertion failed');
        }
    }
    
    /**
     * Assert that two values are equal
     */
    public function assertEquals($expected, $actual, $message = '') 
    {
        $this->assertions++;
        if ($expected !== $actual) {
            $msg = $message ?: "Expected '$expected', got '$actual'";
            throw new Exception($msg);
        }
    }
    
    /**
     * Assert that value is not empty
     */
    public function assertNotEmpty($value, $message = '') 
    {
        $this->assertions++;
        if (empty($value)) {
            throw new Exception($message ?: 'Value should not be empty');
        }
    }
    
    /**
     * Assert that array contains key
     */
    public function assertArrayHasKey($key, $array, $message = '') 
    {
        $this->assertions++;
        if (!array_key_exists($key, $array)) {
            throw new Exception($message ?: "Array does not contain key '$key'");
        }
    }
    
    /**
     * Assert that value is instance of class
     */
    public function assertInstanceOf($expectedClass, $actual, $message = '') 
    {
        $this->assertions++;
        if (!($actual instanceof $expectedClass)) {
            throw new Exception($message ?: "Expected instance of '$expectedClass'");
        }
    }
    
    /**
     * Track coverage for specific feature
     */
    public function trackCoverage($feature, $covered = true) 
    {
        if (!isset($this->coverage[$feature])) {
            $this->coverage[$feature] = 0;
        }
        if ($covered) {
            $this->coverage[$feature]++;
        }
    }
    
    /**
     * Generate final test report
     */
    private function generateFinalReport() 
    {
        $totalDuration = microtime(true) - $this->startTime;
        $totalTests = count($this->results);
        
        echo str_repeat("=", 70) . "\n";
        echo "TEST RESULTS SUMMARY\n";
        echo str_repeat("=", 70) . "\n\n";
        
        // Overall statistics
        echo "Tests run: $totalTests\n";
        echo "Assertions: {$this->assertions}\n";
        echo "Passed: {$this->passed} (" . ($totalTests > 0 ? round(($this->passed / $totalTests) * 100, 1) : 0) . "%)\n";
        echo "Failed: {$this->failed}\n";
        echo "Skipped: {$this->skipped}\n";
        echo "Time: " . number_format($totalDuration, 3) . " seconds\n\n";
        
        // Success rate indicator
        $successRate = $totalTests > 0 ? ($this->passed / $totalTests) * 100 : 0;
        if ($successRate >= 95) {
            echo "🎉 EXCELLENT: " . round($successRate, 1) . "% success rate\n";
        } elseif ($successRate >= 80) {
            echo "✅ GOOD: " . round($successRate, 1) . "% success rate\n";
        } elseif ($successRate >= 60) {
            echo "⚠️  MODERATE: " . round($successRate, 1) . "% success rate\n";
        } else {
            echo "❌ POOR: " . round($successRate, 1) . "% success rate\n";
        }
        echo "\n";
        
        // Coverage report
        if (!empty($this->coverage)) {
            echo str_repeat("-", 50) . "\n";
            echo "FEATURE COVERAGE\n";
            echo str_repeat("-", 50) . "\n";
            foreach ($this->coverage as $feature => $count) {
                echo sprintf("%-30s: %d tests\n", $feature, $count);
            }
            echo "\n";
        }
        
        // Failed tests details
        if ($this->failed > 0) {
            echo str_repeat("-", 50) . "\n";
            echo "FAILED TESTS\n";
            echo str_repeat("-", 50) . "\n";
            foreach ($this->results as $result) {
                if ($result['status'] !== 'PASSED') {
                    echo "✗ {$result['test']}\n";
                    if (isset($result['message'])) {
                        echo "  {$result['message']}\n";
                    }
                }
            }
            echo "\n";
        }
        
        // Performance summary
        echo str_repeat("-", 50) . "\n";
        echo "PERFORMANCE SUMMARY\n";
        echo str_repeat("-", 50) . "\n";
        
        $durations = array_column($this->results, 'duration');
        if (!empty($durations)) {
            echo "Fastest test: " . number_format(min($durations), 3) . "s\n";
            echo "Slowest test: " . number_format(max($durations), 3) . "s\n";
            echo "Average test: " . number_format(array_sum($durations) / count($durations), 3) . "s\n";
        }
        
        echo "\n" . str_repeat("=", 70) . "\n";
        
        // Exit code for CI/CD
        if ($this->failed > 0) {
            echo "❌ TESTS FAILED\n";
            exit(1);
        } else {
            echo "✅ ALL TESTS PASSED\n";
            exit(0);
        }
    }
}
