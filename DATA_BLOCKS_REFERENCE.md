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
| DXS | DXSDataBlock | Data Exchange Status |
| EA1 | EventDataBlock | System Events |
| EA2 | EventDetailsDataBlock | Event Details |
| FA1 | GatewayIDDataBlock | Gateway ID |
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
| ST | STDataBlock | Status Data |
| VA1 | VendsPaidDataBlock | Paid Vends |
| VA2 | VendsTestDataBlock | Test Vends |
| VA3 | VendsFreeDataBlock | Free Vends |
