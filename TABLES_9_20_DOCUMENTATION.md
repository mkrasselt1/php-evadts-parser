# EVA-DTS Event Code Extension - Tables 9-20

## Übersicht

Die PHP EVA-DTS Parser Bibliothek wurde um vollständige Unterstützung für die Tables 9-20 der EVA-DTS Spezifikation erweitert. Dies ermöglicht die automatische Interpretation und Kategorisierung von über 300 zusätzlichen Event-Codes.

## Neue Event-Serien

### Table 9: COMMUNICATIONS (EI + A-Z)
```php
'EIA' => 'Communication link established'
'EIB' => 'Communication buffer full'
'EIC' => 'Communication connection lost'
// ... 23 weitere Codes
```

### Table 10: BILL VALIDATORS (EJ + A-Z)
```php
'EJA' => 'Bill validator active'
'EJF' => 'Bill validator fault'
'EJJ' => 'Bill validator jam detected'
// ... 23 weitere Codes
```

### Table 11: CASHLESS PAYMENTS (EK + A-Z)
```php
'EKA' => 'Cashless payment authorized'
'EKD' => 'Cashless payment declined'
'EKS' => 'Cashless payment successful'
// ... 23 weitere Codes
```

### Table 12: TEMPERATURE CONTROL (EL + A-Z)
```php
'ELA' => 'Temperature control active'
'ELO' => 'Temperature control overheating'
'ELS' => 'Temperature control sensor fault'
// ... 23 weitere Codes
```

### Table 13: REFRIGERATION (EM + A-Z)
```php
'EMA' => 'Refrigeration active'
'EMC' => 'Refrigeration compressor fault'
'EMG' => 'Refrigeration gas leak'
// ... 23 weitere Codes
```

### Table 14: HEATING SYSTEMS (EN + A-Z)
```php
'ENA' => 'Heating system active'
'ENO' => 'Heating system overheating'
'ENT' => 'Heating system thermostat fault'
// ... 23 weitere Codes
```

### Table 15: MOTOR CONTROL (EO + A-Z)
```php
'EOA' => 'Motor control active'
'EOJ' => 'Motor control jam detected'
'EOS' => 'Motor control stalled'
// ... 23 weitere Codes
```

### Table 16: SENSOR SYSTEMS (EP + A-Z)
```php
'EPA' => 'Sensor system active'
'EPF' => 'Sensor system fault'
'EPS' => 'Sensor system signal lost'
// ... 23 weitere Codes
```

### Table 17: SECURITY SYSTEMS (EQ + A-Z)
```php
'EQA' => 'Security system armed'
'EQB' => 'Security system breach detected'
'EQT' => 'Security system tamper detected'
// ... 23 weitere Codes
```

### Table 18: DISPLAY SYSTEMS (ER + A-Z)
```php
'ERA' => 'Display system active'
'ERF' => 'Display system failure'
'ERS' => 'Display system screen fault'
// ... 23 weitere Codes
```

### Table 19: AUDIO SYSTEMS (ES + A-Z)
```php
'ESA' => 'Audio system active'
'ESM' => 'Audio system mute activated'
'ESS' => 'Audio system speaker fault'
// ... 23 weitere Codes
```

### Table 20: NETWORK SYSTEMS (ET + A-Z)
```php
'ETA' => 'Network system active'
'ETC' => 'Network system connection lost'
'ETO' => 'Network system offline'
// ... 23 weitere Codes
```

## Verwendung

### Grundlegende Event-Interpretation

```php
use PeanutPay\PhpEvaDts\EventCodes;

// Event-Code interpretieren
$eventCode = 'EJF';
$description = EventCodes::getEventDescription($eventCode);
// Result: "Bill validator fault"

$category = EventCodes::categorizeEvent($eventCode);
// Result: "bill_validator"

$severity = EventCodes::getEventSeverity($eventCode);
// Result: "error"
```

### Integration in EVA-DTS Parsing

```php
use PeanutPay\PhpEvaDts\Parser;

$parser = new Parser();
$parser->load('machine.eva_dts');

$events = $parser->getEventData();
foreach ($events as $event) {
    echo sprintf(
        "[%s] %s: %s (Schweregrad: %s)\n",
        $event['event_code'],
        $event['event_type'],
        $event['description'],
        $event['severity_level']
    );
}
```

## Event-Kategorisierung

Die neuen Event-Codes werden automatisch in folgende Kategorien eingeteilt:

- `communication` - Kommunikationssysteme
- `bill_validator` - Geldscheinprüfer
- `cashless_payment` - Kartenzahlungssysteme
- `temperature_control` - Temperaturregelung
- `refrigeration` - Kühlsysteme
- `heating_system` - Heizsysteme
- `motor_control` - Motorsteuerung
- `sensor_system` - Sensorsysteme
- `security_system` - Sicherheitssysteme
- `display_system` - Anzeigesysteme
- `audio_system` - Audiosysteme
- `network_system` - Netzwerksysteme

## Schweregrad-Klassifikation

Events werden automatisch nach Schweregrad klassifiziert:

### Error (Fehler)
Ereignisse mit Buchstaben: F, G, J, M, O, U, V, X, Y, Z
- Erfordern sofortige Aufmerksamkeit
- Können Geräteverfügbarkeit beeinträchtigen

### Warning (Warnung)
Ereignisse mit Buchstaben: B, C, D, H, I, K, L, N, Q, S, T, W
- Sollten überwacht werden
- Können zu Problemen führen

### Info (Information)
Alle anderen Ereignisse (A, E, P, R, etc.)
- Normale Betriebszustände
- Informative Meldungen

## Praktische Anwendung

### Wartungsalarme

```php
$criticalEvents = [];
$events = $parser->getEventData();

foreach ($events as $event) {
    if ($event['severity_level'] === 'error') {
        $criticalEvents[] = [
            'code' => $event['event_code'],
            'description' => $event['description'],
            'timestamp' => $event['timestamp']
        ];
    }
}
```

### Dashboard-Integration

```php
function getEventIcon($category) {
    return match($category) {
        'communication' => '📡',
        'bill_validator' => '💵',
        'cashless_payment' => '💳',
        'temperature_control' => '🌡️',
        'refrigeration' => '❄️',
        'heating_system' => '🔥',
        'motor_control' => '⚙️',
        'sensor_system' => '📊',
        'security_system' => '🔒',
        'display_system' => '🖥️',
        'audio_system' => '🔊',
        'network_system' => '🌐',
        default => '⚠️'
    };
}
```

## Tests

Führen Sie die bereitgestellten Test-Scripts aus:

```bash
# Vollständiger Test aller neuen Event-Codes
php example/test_tables_9_20.php

# Praktische Demonstration
php example/demo_event_parsing.php
```

## Technische Details

- **Event-Codes**: Über 300 neue Event-Codes aus Tables 9-20
- **Architektur**: Saubere Trennung in `EventCodes` Klasse
- **Performance**: Statische Methoden für schnelle Abfrage
- **Kompatibilität**: Vollständig rückwärtskompatibel mit bestehenden Codes
- **Standard-Konformität**: Basiert auf EVA-DTS 6.1.2 Spezifikation

## Vorteile

1. **Vollständige Abdeckung**: Alle EVA-DTS Event-Tables implementiert
2. **Automatische Kategorisierung**: Events werden intelligent klassifiziert
3. **Schweregrad-Bewertung**: Automatische Prioritätszuweisung
4. **Benutzerfreundlich**: Klare, beschreibende Texte statt kryptischer Codes
5. **Wartungsfreundlich**: Einfache Integration in Monitoring-Systeme
6. **Skalierbar**: Leicht erweiterbar für zusätzliche Event-Types

Mit dieser Erweiterung kann die PHP EVA-DTS Parser Bibliothek jetzt nahezu alle Event-Codes der EVA-DTS Spezifikation interpretieren und benutzerfreundlich darstellen.
