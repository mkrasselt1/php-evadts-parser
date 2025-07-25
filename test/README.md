# Test Directory

This directory contains comprehensive test suites for the EVA-DTS parser with PHPUnit-style reporting and detailed coverage analysis.

## 🧪 Test Suites

### Core Test Files
- **`TestRunner.php`** - Custom test framework with PHPUnit-like reporting
- **`run_all_tests.php`** - Master test suite runner with comprehensive reporting
- **`run_test_suite.php`** - Core functionality tests (parser methods, file loading)
- **`run_coverage_tests.php`** - Field coverage and DataBlock validation tests
- **`test_all_reports.php`** - Legacy comprehensive functionality test

### Specialized Test Scripts
- **`validate_all_fields.php`** - EVA-DTS 6.1.2 field coverage validation
- **`comprehensive_test.php`** - Multi-file format validation
- **`debug_*.php`** - Debugging tools for specific data types
- **`coverage_analysis.php`** - Field coverage analysis and reporting

## 🚀 Quick Start

### Run Complete Test Suite (Recommended)
```bash
# Run all tests with comprehensive reporting
php test/run_all_tests.php
```

### Run Individual Test Suites
```bash
# Core functionality tests
php test/run_test_suite.php

# Field coverage tests  
php test/run_coverage_tests.php

# Legacy comprehensive test
php test/test_all_reports.php
```

### Run from Project Root
```bash
# From project root directory
php test/run_all_tests.php

# Or run specific suites
php test/run_test_suite.php
php test/run_coverage_tests.php
```

## 📊 Test Reporting Features

### PHPUnit-Style Output
- ✅ **Test Statistics** - Total tests, passed, failed, success rate
- ⏱️ **Performance Metrics** - Test duration, average test time
- 📈 **Coverage Analysis** - Field coverage, DataBlock coverage, method coverage
- 🎯 **Quality Grades** - A+ to F grading based on success rates
- 🔧 **Detailed Failure Reports** - Specific error messages and recommendations

### Sample Output
```
======================================================================
EVA-DTS Parser Test Suite
======================================================================

Running: parser_initialization - Test basic parser instantiation
  ✓ PASSED (0.001s)

Running: file_loading_animo - Test loading Animo EVA-DTS file
  ✓ PASSED (0.045s)

...

======================================================================
TEST RESULTS SUMMARY
======================================================================

Tests run: 17
Assertions: 42
Passed: 16 (94.1%)
Failed: 1
Skipped: 0
Time: 1.234 seconds

🌟 VERY GOOD: 94.1% success rate

--------------------------------------------------
FEATURE COVERAGE
--------------------------------------------------
Core Parser                    : 3 tests
File Loading                   : 3 tests
Parser Methods                 : 6 tests
Report Generation              : 3 tests
Error Handling                 : 2 tests

✅ ALL TESTS PASSED
```

## 🎯 Coverage Areas

### Core Functionality
- Parser instantiation and basic operations
- File loading across multiple formats (.eva_dts, .txt)
- All 9 parser methods (getTables, getSalesData, getProductData, etc.)
- Report generation (sales, product, error reports)
- Multi-manufacturer support (Animo, Sielaff, Hewa, ACTECH, Rhevendors)

### Field Coverage Validation
- EVA-DTS 6.1.2 specification compliance (115+ field identifiers)
- DataBlock class coverage (93+ classes)
- Field identifier detection and parsing
- Data integrity and consistency checks
- Parsing quality and error rate analysis

### Performance Testing
- Parsing speed validation (< 5 seconds per file)
- Memory usage monitoring
- Multi-file processing efficiency
- Method execution time tracking

## Test Data

Test data files (*.eva, *.eva_dts, *.txt) are located in the `../example/` directory.
