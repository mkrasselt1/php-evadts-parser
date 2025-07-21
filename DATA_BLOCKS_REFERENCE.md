# EVA DTS Data Block Reference

This document provides detailed information about all supported EVA DTS data block types and their field mappings.

## Data Block Format

All EVA DTS data blocks follow the format: `TYPE*field1*field2*field3*...`

Where:
- `TYPE` is the block type identifier (e.g., PA1, LA1, ID1)
- Fields are separated by asterisks (`*`)
- Empty fields are represented as empty strings between asterisks

## Product Data Blocks

### PA1 - Product Data Block

Contains product definitions and configuration.

**Format:** `PA1*productNumber*price*name*field4*field5*field6*active*field8`

**Fields:**
- `productNumber` (int) - Unique product identifier
- `price` (int) - Price in cents/smallest currency unit
- `name` (string) - Product name/description
- `active` (bool) - Product availability status

**Example:** `PA1*1*150*Coffee*0*0*0*1*0`

### PA2 - Product Vends Data Block

Aggregate sales data for all products.

**Format:** `PA2*numberProductsInit*valueProductsInit*numberProductsReset*valueProductsReset*numberDiscountsInit*valueDiscountsInit*numberDiscountsReset*valueDiscountsReset*numberSurchargesInit*valueSurchargesInit*numberSurchargesReset*valueSurchargesReset`

**Fields:**
- `numberProductsInit` (int) - Initial products sold count
- `valueProductsInit` (int) - Initial products sold value (cents)
- `numberProductsReset` (int) - Reset products sold count
- `valueProductsReset` (int) - Reset products sold value (cents)
- `numberDiscountsInit` (int) - Initial discount count
- `valueDiscountsInit` (int) - Initial discount value (cents)
- `numberDiscountsReset` (int) - Reset discount count
- `valueDiscountsReset` (int) - Reset discount value (cents)
- `numberSurchargesInit` (int) - Initial surcharge count
- `valueSurchargesInit` (int) - Initial surcharge value (cents)
- `numberSurchargesReset` (int) - Reset surcharge count
- `valueSurchargesReset` (int) - Reset surcharge value (cents)

### PA3 - Product Test Vends Data Block

Test vend counters for products.

### PA4 - Product Free Vends Data Block

Free vend counters for products.

### PA7 - Product Vends New Data Block

Enhanced product sales data format.

## Price List Data Blocks

### LA1 - Price List Vends Data Block

Contains price list assignments and sales counters.

**Format:** `LA1*priceList*productNumber*price*numberPaidInit*numberPaidReset`

**Fields:**
- `priceList` (int) - Price list identifier
- `productNumber` (int) - Product identifier
- `price` (int) - Product price in cents
- `numberPaidInit` (int) - Initial paid counter value
- `numberPaidReset` (int) - Reset paid counter value

**Example:** `LA1*1*1*150*0*150`

## Machine Identification Blocks

### ID1 - VMC ID Data Block

Vending Machine Controller identification.

**Fields:**
- Machine serial number
- Software version
- Hardware configuration

### ID4 - Currency Data Block

Currency and monetary settings.

### ID5 - Time Data Block

Machine date and time information.

### ID6 - Cash Bag Data Block

Cash collection and audit data.

### MA5 - Machine Data Block

General machine information and settings.

## Payment System Blocks

### Coin System (CA Series)

#### CA1 - Coin ID Data Block
Coin mechanism identification and configuration.

#### CA2 - Coin Vends Data Block
Coin-based transaction data and counters.

#### CA3 - Cash Report Data Block
Comprehensive cash audit reports.

#### CA7 - Cash Discounts Data Block
Cash discount transaction data.

#### CA9 - Coin Change Data Block
Coin change dispensing data.

#### CA11 - Coin Accepted Data Block
Accepted coin transaction records.

#### CA12 - Coin Dispensed Data Block
Dispensed coin records.

#### CA13 - Coin Filled Data Block
Coin tube fill records.

#### CA15 - Coin Tube Level Data Block
Current coin tube inventory levels.

#### CA17 - Coin Tube Data Block
Coin tube configuration and settings.

### Bill System (BA Series)

#### BA1 - Bill ID Data Block
Bill acceptor identification and configuration.

### Cashless System (DA Series)

#### DA1 - Cashless ID Data Block
Cashless payment system identification.

#### DA2 - Cashless Vends Data Block
Cashless transaction data and counters.

#### DA5 - Cashless Discounts Data Block
Cashless discount transaction data.

## Event and Audit Blocks

### EA1 - Event Data Block

System events and alerts.

**Fields:**
- Event type identifier
- Timestamp
- Event description
- Status codes

### EA2 - Event Details Data Block

Detailed event information and context.

### AM1 - Audit Module Data Block

Audit trail and compliance data.

## Control and Status Blocks

### CB1 - Control Board Data Block

Control board status and configuration.

### ST - Status Data Block

General machine status information.

### DXS - Data Exchange Status

Data communication status.

## Gateway and Network Blocks

### FA1 - Gateway ID Data Block

Network gateway identification and configuration.

## Power and Hardware Blocks

### CA5 - Power Out Data Block

Power outage and restoration events.

### CA6 - Reads Open Data Block

Door/access panel open events.

## Field Data Types

### Common Data Types

- **int** - Integer values, often counters or identifiers
- **string** - Text fields for names, descriptions
- **bool** - Boolean values (0 = false, 1 = true)
- **timestamp** - Date/time in YYYYMMDDHHMMSS format
- **currency** - Monetary values in smallest currency unit (cents)

### Counter Logic

Most sales counters follow this pattern:
- `Init` values represent the counter state at initialization
- `Reset` values represent the counter state at last reset
- Actual count = `Reset` - `Init`

### Price Representation

All monetary values are stored in the smallest currency unit:
- $1.50 is stored as 150
- €2.00 is stored as 200
- Convert to display format by dividing by 100

## Usage Examples

### Accessing Block Data

```php
foreach ($report->blocks as $block) {
    if ($block instanceof ProductDataBlock) {
        echo "Product {$block->productNumber}: {$block->name}\n";
        echo "Price: €" . number_format($block->price / 100, 2) . "\n";
        echo "Status: " . ($block->active ? 'Active' : 'Inactive') . "\n\n";
    }
}
```

### Sales Calculation

```php
foreach ($report->blocks as $block) {
    if ($block instanceof PriceListVendsDataBlock) {
        $salesCount = $block->numberPaidReset - $block->numberPaidInit;
        $salesValue = $salesCount * ($block->price / 100);
        echo "Product {$block->productNumber} sold {$salesCount} units for €{$salesValue}\n";
    }
}
```

| MA1  | Machine audit information block         | Machine ID, checksums                           |
| PA5  | Product/price audit block               | Product numbers, pricing audit data             |
| EA5  | Extended event audit data block         | Extended event audit information                 |
| EC2  | Error/control audit data block          | Error codes, control system audit data          |

## Block Type Mapping

| Code | Class Name | Description |
|------|------------|-------------|
| AM1 | AuditModuleDataBlock | Audit Module Data |
| BA1 | BillIDDataBlock | Bill Acceptor ID |
| CA1 | CoinIDDataBlock | Coin Mechanism ID |
| CA2 | CoinVendsDataBlock | Coin Sales Data |
| CA3 | CashReportDataBlock | Cash Report |
| CA5 | PowerOutDataBlock | Power Outage Data |
| CA6 | ReadsOpenDataBlock | Door Open Events |
| CA7 | CashDiscountsDataBlock | Cash Discounts |
| CA9 | CoinChangeDataBlock | Coin Change Data |
| CA11 | CoinAcceptedDataBlock | Accepted Coins |
| CA12 | CoinDispensedDataBlock | Dispensed Coins |
| CA13 | CoinFilledDataBlock | Coin Fill Events |
| CA15 | CoinTubeLevelDataBlock | Coin Tube Levels |
| CA17 | CoinTubeDataBlock | Coin Tube Config |
| CB1 | ControlBoardDataBlock | Control Board Status |
| DA1 | CashlessIDDataBlock | Cashless System ID |
| DA2 | CashlessVendsDataBlock | Cashless Sales |
| DA5 | CashlessDiscountsDataBlock | Cashless Discounts |
| DB1 | DB1DataBlock | Database/Device Block Type 1 |
| DB2 | DB2DataBlock | Database/Device Block Type 2 |
| DB4 | DB4DataBlock | Database/Device Block Type 4 |
| DB5 | DB5DataBlock | Database/Device Block Type 5 |
| DB10 | DB10DataBlock | Database/Device Block Type 10 |
| DXS | DXSDataBlock | Data Exchange Status |
| DXE | DXEDataBlock | Data Exchange End |
| EA1 | EventDataBlock | System Events |
| EA2 | EventDetailsDataBlock | Event Details |
| EA3 | EA3DataBlock | Event Audit Type 3 |
| EA4 | EA4DataBlock | Event Audit Type 4 |
| EA6 | EA6DataBlock | Extended Event Data |
| EA7 | EA7DataBlock | Event Audit Type 7 |
| FA1 | GatewayIDDataBlock | Gateway ID |
| G85 | G85DataBlock | General/Manufacturer Data |
| ID1 | VMCIDDataBlock | VMC Identification |
| ID4 | CurrencyDataBlock | Currency Settings |
| ID5 | TimeDataBlock | Date/Time Info |
| ID6 | CashBagDataBlock | Cash Collection |
| LA1 | PriceListVendsDataBlock | Price List Data |
| MA5 | MachineDataBlock | Machine Info |
| PA1 | ProductDataBlock | Product Definitions |
| PA2 | ProductVendsDataBlock | Product Sales |
| PA3 | ProductTestVendsDataBlock | Test Vends |
| PA4 | ProductFreeVendsDataBlock | Free Vends |
| PA7 | ProductVendsNewDataBlock | Enhanced Sales Data |
| PA8 | PA8DataBlock | Product Audit Data |
| PP1 | PP1DataBlock | Product/Position Data |
| SA2 | SA2DataBlock | Selection Audit Data |
| SD1 | SD1DataBlock | System Data |
| SE | SEDataBlock | Session End |
| ST | STDataBlock | Status Data |
| TA2 | TA2DataBlock | Total Audit Data |
| TA3 | TA3DataBlock | Total Audit Data Type 3 |
| TA5 | TA5DataBlock | Total Audit Data Type 5 |
| VA1 | VendsPaidDataBlock | Paid Vends |
| VA2 | VendsTestDataBlock | Test Vends |
| VA3 | VendsFreeDataBlock | Free Vends |

## Extended Data Blocks

### SA2 - Selection Audit Data Block

Contains individual product selection audit data.

**Format:** `SA2*selectionNumber*numberSelections*field3`

**Fields:**
- `selectionNumber` (int) - Product/selection identifier
- `numberSelections` (int) - Number of selections made
- `field3` (string) - Additional data field

**Example:** `SA2*1*992*`

### EA6 - Extended Event Data Block

Contains detailed event information with timestamps and descriptions.

**Format:** `EA6*eventDate*eventTime*machineId*eventDescription`

**Fields:**
- `eventDate` (string) - Event date in YYYYMMDD format
- `eventTime` (string) - Event time in HHMMSS format
- `machineId` (string) - Machine or module identifier
- `eventDescription` (string) - Human-readable event description

**Example:** `EA6*20100111*232706*ANIKraftver*Clean Brewer`

### TA2 - Total Audit Data Block

Contains comprehensive audit totals and counters.

**Format:** `TA2*totalValueInit*totalNumberInit*totalValueReset*totalNumberReset*field5*field6*field7*field8`

**Fields:**
- `totalValueInit` (int) - Initial total value
- `totalNumberInit` (int) - Initial total count
- `totalValueReset` (int) - Reset total value
- `totalNumberReset` (int) - Reset total count
- Additional fields for extended data

**Example:** `TA2**0**0`

### TA3 - Total Audit Data Block (Type 3)

Contains audit totals for specific metrics.

**Format:** `TA3*valueInit*valueReset`

**Fields:**
- `valueInit` (int) - Initial value
- `valueReset` (int) - Reset value

### TA5 - Total Audit Data Block (Type 5)

Contains audit totals for specific metrics.

**Format:** `TA5*valueInit*valueReset`

**Fields:**
- `valueInit` (int) - Initial value
- `valueReset` (int) - Reset value

### SD1 - System Data Block

Contains system configuration and status information.

**Format:** `SD1*systemData`

**Fields:**
- `systemData` (string) - System configuration data

### G85 - General Data Block

Contains manufacturer-specific or general data, often checksums.

**Format:** `G85*generalData`

**Fields:**
- `generalData` (string) - General purpose data (often checksums)

**Example:** `G85*B9AE`

### SE - Session End Data Block

Marks the end of a data session with control information.

**Format:** `SE*recordCount*controlNumber`

**Fields:**
- `recordCount` (int) - Number of records in session
- `controlNumber` (string) - Session control/sequence number

**Example:** `SE*117*0001`

### DXE - Data Exchange End Data Block

Indicates the completion of data exchange.

**Format:** `DXE*exchangeStatus*exchangeMode`

**Fields:**
- `exchangeStatus` (int) - Exchange completion status
- `exchangeMode` (int) - Exchange mode identifier

**Example:** `DXE*1*1`

## Device-Specific Data Blocks

### DB1, DB2, DB4, DB5, DB10 - Database/Device Data Blocks

These blocks contain device or database-specific information that varies by manufacturer and implementation.

### PP1 - Product/Position Data Block

Contains product position and configuration data.

**Format:** `PP1*productNumber*position*productName*...*field9`

**Example:** `PP1*17*0*NO CUP ****9535*0`

### PA8 - Product Audit Data Block

Contains additional product audit information and counters.

**Format:** `PA8*valueInit*valueReset*field3*field4`

### EA3, EA4, EA7 - Event Audit Data Blocks

Various event audit block types with different timestamp and counter formats:

- **EA3**: Event audit with start/end timestamps
- **EA4**: Event audit with single timestamp  
- **EA7**: Event audit with counter information
