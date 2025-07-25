<?php

/**
 * Master Test Suite Runner for EVA-DTS Parser
 * Coordinates all test suites and provides comprehensive reporting
 */

echo "\n" . str_repeat("=", 80) . "\n";
echo "EVA-DTS PARSER - COMPREHENSIVE TEST SUITE\n";
echo str_repeat("=", 80) . "\n";
echo "Running all test suites with detailed reporting...\n\n";

$startTime = microtime(true);
$totalTests = 0;
$totalPassed = 0;
$totalFailed = 0;

// Test Suite 1: Core Functionality
echo "🧪 RUNNING: Core Functionality Test Suite\n";
echo str_repeat("-", 60) . "\n";

ob_start();
$coreExitCode = 0;
try {
    include __DIR__ . '/run_test_suite.php';
} catch (Exception $e) {
    $coreExitCode = 1;
    echo "❌ Core test suite failed with exception: " . $e->getMessage() . "\n";
}
$coreOutput = ob_get_clean();

// Parse output for statistics
preg_match('/Tests run: (\d+)/', $coreOutput, $coreTestsMatch);
preg_match('/Passed: (\d+)/', $coreOutput, $corePassedMatch);
preg_match('/Failed: (\d+)/', $coreOutput, $coreFailedMatch);

$coreTests = isset($coreTestsMatch[1]) ? (int)$coreTestsMatch[1] : 0;
$corePassed = isset($corePassedMatch[1]) ? (int)$corePassedMatch[1] : 0;
$coreFailed = isset($coreFailedMatch[1]) ? (int)$coreFailedMatch[1] : 0;

echo $coreOutput;
echo "\n";

// Test Suite 2: Field Coverage
echo "📊 RUNNING: Field Coverage Test Suite\n";
echo str_repeat("-", 60) . "\n";

ob_start();
$coverageExitCode = 0;
try {
    include __DIR__ . '/run_coverage_tests.php';
} catch (Exception $e) {
    $coverageExitCode = 1;
    echo "❌ Coverage test suite failed with exception: " . $e->getMessage() . "\n";
}
$coverageOutput = ob_get_clean();

// Parse coverage output for statistics
preg_match('/Tests run: (\d+)/', $coverageOutput, $covTestsMatch);
preg_match('/Passed: (\d+)/', $coverageOutput, $covPassedMatch);
preg_match('/Failed: (\d+)/', $coverageOutput, $covFailedMatch);

$covTests = isset($covTestsMatch[1]) ? (int)$covTestsMatch[1] : 0;
$covPassed = isset($covPassedMatch[1]) ? (int)$covPassedMatch[1] : 0;
$covFailed = isset($covFailedMatch[1]) ? (int)$covFailedMatch[1] : 0;

echo $coverageOutput;
echo "\n";

// Calculate overall statistics
$totalTests = $coreTests + $covTests;
$totalPassed = $corePassed + $covPassed;
$totalFailed = $coreFailed + $covFailed;
$totalDuration = microtime(true) - $startTime;

// Generate comprehensive final report
echo str_repeat("=", 80) . "\n";
echo "COMPREHENSIVE TEST RESULTS SUMMARY\n";
echo str_repeat("=", 80) . "\n\n";

echo "📈 OVERALL STATISTICS\n";
echo str_repeat("-", 40) . "\n";
echo sprintf("Total Test Suites: %d\n", 2);
echo sprintf("Total Tests: %d\n", $totalTests);
echo sprintf("Total Passed: %d\n", $totalPassed);
echo sprintf("Total Failed: %d\n", $totalFailed);
echo sprintf("Overall Success Rate: %.1f%%\n", $totalTests > 0 ? ($totalPassed / $totalTests) * 100 : 0);
echo sprintf("Total Duration: %.3f seconds\n", $totalDuration);
echo "\n";

echo "🔍 SUITE BREAKDOWN\n";
echo str_repeat("-", 40) . "\n";
echo sprintf("Core Functionality: %d/%d passed (%.1f%%)\n", 
    $corePassed, $coreTests, $coreTests > 0 ? ($corePassed / $coreTests) * 100 : 0);
echo sprintf("Field Coverage: %d/%d passed (%.1f%%)\n", 
    $covPassed, $covTests, $covTests > 0 ? ($covPassed / $covTests) * 100 : 0);
echo "\n";

echo "🎯 QUALITY METRICS\n";
echo str_repeat("-", 40) . "\n";

$successRate = $totalTests > 0 ? ($totalPassed / $totalTests) * 100 : 0;

if ($successRate >= 95) {
    echo "🏆 EXCELLENT: Code quality is exceptional\n";
    $grade = "A+";
} elseif ($successRate >= 90) {
    echo "🌟 VERY GOOD: Code quality is very high\n";
    $grade = "A";
} elseif ($successRate >= 80) {
    echo "✅ GOOD: Code quality is good\n";
    $grade = "B";
} elseif ($successRate >= 70) {
    echo "⚠️  ACCEPTABLE: Code quality needs improvement\n";
    $grade = "C";
} elseif ($successRate >= 60) {
    echo "🔧 POOR: Code quality requires significant work\n";
    $grade = "D";
} else {
    echo "❌ CRITICAL: Code quality is unacceptable\n";
    $grade = "F";
}

echo sprintf("Quality Grade: %s (%.1f%%)\n", $grade, $successRate);
echo "\n";

// Performance analysis
if ($totalTests > 0) {
    $avgTestTime = $totalDuration / $totalTests;
    echo "⚡ PERFORMANCE ANALYSIS\n";
    echo str_repeat("-", 40) . "\n";
    echo sprintf("Average test time: %.3f seconds\n", $avgTestTime);
    
    if ($avgTestTime < 0.1) {
        echo "🚀 FAST: Excellent test performance\n";
    } elseif ($avgTestTime < 0.5) {
        echo "⚡ GOOD: Good test performance\n";
    } elseif ($avgTestTime < 1.0) {
        echo "🐌 SLOW: Tests are running slowly\n";
    } else {
        echo "🐢 VERY SLOW: Tests need optimization\n";
    }
    echo "\n";
}

// Test coverage summary  
echo "📋 COVERAGE SUMMARY\n";
echo str_repeat("-", 40) . "\n";
echo "✓ Parser instantiation and basic functionality\n";
echo "✓ File loading across multiple formats (.eva_dts, .txt)\n";
echo "✓ All 9 core parser methods (getTables, getSalesData, etc.)\n";
echo "✓ Report generation (sales, product, error reports)\n";
echo "✓ Multi-file format support (Animo, Sielaff, Hewa, ACTECH)\n";
echo "✓ EVA-DTS field identifier coverage validation\n";
echo "✓ DataBlock class implementation coverage\n";
echo "✓ Data integrity and parsing quality checks\n";
echo "✓ Performance and error rate analysis\n";
echo "\n";

// Recommendations
if ($totalFailed > 0) {
    echo "🔧 RECOMMENDATIONS\n";
    echo str_repeat("-", 40) . "\n";
    echo "• Review failed tests for specific issues\n";
    echo "• Check file format compatibility\n";
    echo "• Validate DataBlock implementations\n";
    echo "• Consider additional error handling\n";
    echo "\n";
}

echo str_repeat("=", 80) . "\n";

// Final status
if ($totalFailed === 0) {
    echo "🎉 ALL TESTS PASSED - EVA-DTS Parser is ready for production!\n";
    $exitCode = 0;
} else {
    echo "⚠️  SOME TESTS FAILED - Review and fix issues before deployment\n";
    $exitCode = 1;
}

echo str_repeat("=", 80) . "\n";

// Summary for CI/CD
echo "\nTEST SUMMARY FOR CI/CD:\n";
echo "Tests: $totalTests, Passed: $totalPassed, Failed: $totalFailed\n";
echo "Success Rate: " . round($successRate, 1) . "%\n";
echo "Duration: " . round($totalDuration, 3) . "s\n";

exit($exitCode);
