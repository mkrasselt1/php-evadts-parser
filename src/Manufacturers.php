<?php

namespace PeanutPay\PhpEvaDts;

/**
 * EVA-DTS Manufacturer Codes Database
 * Based on European Vending Association aisbl documentation (March 2016)
 * 
 * This class provides access to the complete list of known EVA-DTS manufacturer codes
 * as defined by the European Vending Association.
 */
class Manufacturers
{
    /**
     * Get all known EVA-DTS manufacturer codes
     * 
     * @return array Manufacturer codes with details [code => [name, country]]
     */
    public static function getAll(): array
    {
        return [
            'AAS' => ['name' => 'Alldata', 'country' => 'Germany'],
            'ABS' => ['name' => 'Absec', 'country' => 'Ireland'],
            'ACQ' => ['name' => 'Acquis AB', 'country' => 'Sweden'],
            'ADE' => ['name' => 'Ade Elettronica', 'country' => 'Italy'],
            'AEP' => ['name' => 'Advanced Electronic Products', 'country' => 'U.S.A'],
            'AEQ' => ['name' => 'Aequator AG Arbon', 'country' => 'Switzerland'],
            'AGR' => ['name' => 'AgriaComputer', 'country' => 'Hungary'],
            'AMS' => ['name' => 'Adaptive Micro Systems', 'country' => 'U.S.A.'],
            'ANI' => ['name' => 'Animo BV', 'country' => 'Netherlands'],
            'ANT' => ['name' => 'Antronics Ltd', 'country' => 'U.K.'],
            'API' => ['name' => 'Automatic Products', 'country' => 'U.S.A.'],
            'ARD' => ['name' => 'Ardac', 'country' => 'U.S.A.'],
            'ASC' => ['name' => 'Audit Systems Company', 'country' => 'U.S.A.'],
            'ASM' => ['name' => 'Automaten-Seitz', 'country' => 'Germany'],
            'AST' => ['name' => 'Astrosystems Ltd', 'country' => 'U.K.'],
            'ATB' => ['name' => 'Automatentechnik Baumann', 'country' => 'Germany'],
            'AUT' => ['name' => 'Automated Merchandising Systems', 'country' => 'U.S.A.'],
            'AZK' => ['name' => 'Azkoyen Comercial', 'country' => 'Spain'],
            'BBN' => ['name' => 'Bravilor Bonamat BV', 'country' => 'Netherlands'],
            'BES' => ['name' => 'Bassett Electronic Systems Ltd', 'country' => 'U.K.'],
            'BIW' => ['name' => 'BiWa', 'country' => 'Germany'],
            'BKS' => ['name' => 'Banksys', 'country' => 'Belgium'],
            'CAF' => ['name' => 'Cafection', 'country' => 'Canada'],
            'CAI' => ['name' => 'Coin Acceptors International', 'country' => 'U.S.A.'],
            'CAL' => ['name' => 'Cale Access AB', 'country' => 'Sweden'],
            'CAN' => ['name' => 'Cantaloupe Systems', 'country' => 'U.S.A.'],
            'CAR' => ['name' => 'Cardinal', 'country' => 'U.K.'],
            'CAS' => ['name' => 'Cashfree Vending', 'country' => 'Norway'],
            'CBV' => ['name' => 'Coin Bill Validators', 'country' => 'U.S.A.'],
            'CCC' => ['name' => 'The Coca-Cola Company', 'country' => 'U.S.A.'],
            'CCD' => ['name' => 'Crane Cash Code', 'country' => 'U.S.A.'],
            'CCV' => ['name' => 'CCB Deutschland GmbH', 'country' => 'Germany'],
            'CDS' => ['name' => 'CDS Worldwide Pty', 'country' => 'Australia'],
            'CEL' => ['name' => 'Celectronic', 'country' => 'Germany'],
            'CFR' => ['name' => 'CoinFree', 'country' => 'U.S.A.'],
            'CHC' => ['name' => 'Celadon Hailstone Cooperation', 'country' => 'Belgium'],
            'CLX' => ['name' => 'Nippon Conlux', 'country' => 'Japan'],
            'CMS' => ['name' => 'Crane', 'country' => 'U.S.A'],
            'CNV' => ['name' => 'Crane National Vendors', 'country' => 'U.S.A.'],
            'COG' => ['name' => 'Coges', 'country' => 'Italy'],
            'COL' => ['name' => 'Coin Controls', 'country' => 'U.K.'],
            'COM' => ['name' => 'Comestero Group', 'country' => 'Italy'],
            'CRO' => ['name' => 'CroBoCom AS', 'country' => 'Norway'],
            'DAM' => ['name' => 'Damian', 'country' => 'Italy'],
            'DAR' => ['name' => 'DarenthMJS Ltd', 'country' => 'UK'],
            'DEB' => ['name' => 'Debitek', 'country' => 'U.S.A.'],
            'DIX' => ['name' => 'Dixie-Narco', 'country' => 'U.S.A.'],
            'DJD' => ['name' => 'J.M. de Jong Duke', 'country' => 'The Netherlands'],
            'DLG' => ['name' => 'Distrilog', 'country' => 'France'],
            'DMK' => ['name' => 'D.M. (Kent) Electronics Ltd.', 'country' => 'U.K.'],
            'DMS' => ['name' => 'DMS Tech. Ltd.', 'country' => 'Turkey'],
            'DNL' => ['name' => 'Danyl Corporation', 'country' => 'U.S.A.'],
            'DPS' => ['name' => 'Direct Payment Solution Limited', 'country' => 'New Zealand'],
            'DUC' => ['name' => 'Ducale', 'country' => 'Italy'],
            'ECT' => ['name' => 'Etna Coffee Technologies', 'country' => 'The Netherlands'],
            'EDI' => ['name' => 'Edue Italia S.p.A.', 'country' => 'Italy'],
            'ELK' => ['name' => 'Elkey', 'country' => 'Italy'],
            'ELM' => ['name' => 'ELME Elektronische Messgeräte GmbH', 'country' => 'Germany'],
            'ETI' => ['name' => 'Ellenby Technologies, Inc', 'country' => 'U.S.A.'],
            'EVI' => ['name' => 'Evis AG', 'country' => 'Switzerland'],
            'EZC' => ['name' => 'Eazy Coin Corp', 'country' => 'USA'],
            'FAG' => ['name' => 'Fage', 'country' => 'Italy'],
            'FAN' => ['name' => 'Franchier', 'country' => 'Italy'],
            'FAS' => ['name' => 'Fas International', 'country' => 'Italy'],
            'FEI' => ['name' => 'FEIG Electronic GmbH', 'country' => 'Germany'],
            'FIM' => ['name' => 'Frosh Invent GmbH', 'country' => 'Germany'],
            'FRA' => ['name' => 'Franke Kaffeemaschinene AG', 'country' => 'Switzerland'],
            'FST' => ['name' => 'Food Automation Systems Technologies, Inc', 'country' => 'U.S.A.'],
            'FSQ' => ['name' => 'Four Square Drinks', 'country' => 'U.K.'],
            'GAT' => ['name' => 'Gantner Electronic GmbH', 'country' => 'Austria'],
            'GDS' => ['name' => 'General Dispensing Systems', 'country' => 'U.K.'],
            'GIR' => ['name' => 'Girovend', 'country' => 'U.K.'],
            'GMV' => ['name' => 'GM Vending', 'country' => 'Spain'],
            'GMX' => ['name' => 'Gamemax Corporation', 'country' => 'U.S.A.'],
            'GPA' => ['name' => 'Grünig-Poth Automaten', 'country' => 'Germany'],
            'GPE' => ['name' => 'GPE Vendors', 'country' => 'Italy'],
            'GUF' => ['name' => 'Garz&Fricke GmbH', 'country' => 'Germany'],
            'HAR' => ['name' => 'Harting Elektronik', 'country' => 'Germany'],
            'HAW' => ['name' => 'Hug-Witschi', 'country' => 'Switzerland'],
            'HEC' => ['name' => 'Hectronic', 'country' => 'Germany'],
            'HES' => ['name' => 'Hesa Innovation GmbH', 'country' => 'Germany'],
            'HET' => ['name' => 'Hentel Telecommunication CO, LTD', 'country' => 'Taiwan'],
            'HOE' => ['name' => 'Hoefer Elektronik', 'country' => 'Germany'],
            'HWI' => ['name' => 'Hans Weinert', 'country' => 'Germany'],
            'HYC' => ['name' => 'Hypercom', 'country' => 'Germany'],
            'IBE' => ['name' => 'Ibersegur', 'country' => 'Spain'],
            'IDS' => ['name' => 'Integrated Dispensing Systems', 'country' => 'Australia'],
            'IMP' => ['name' => 'Impulsa Soluciones Tecnológicas', 'country' => 'Spain'],
            'ING' => ['name' => 'Ingenico', 'country' => 'France'],
            'JCM' => ['name' => 'Japan Cash Machine Co.', 'country' => 'Japan'],
            'JED' => ['name' => 'Jede AB', 'country' => 'Sweden'],
            'JOF' => ['name' => 'Jofemar', 'country' => 'Spain'],
            'KBT' => ['name' => 'Kobetron', 'country' => 'U.S.A.'],
            'KES' => ['name' => 'Keso GmbH', 'country' => 'Austria'],
            'KRH' => ['name' => 'KRh Thermal Systems', 'country' => 'U.S.A.'],
            'KRO' => ['name' => 'Hypercom', 'country' => 'Germany'],
            'KSN' => ['name' => 'Kontrole-Systeme', 'country' => 'Switzerland'],
            'LAV' => ['name' => 'Lavazza', 'country' => 'Italy'],
            'LGC' => ['name' => 'Landis&Gyr Communications', 'country' => 'Switzerland'],
            'LHD' => ['name' => 'LHD Vending Systems', 'country' => 'U.S.A.'],
            'LOG' => ['name' => 'Logos Design A/S', 'country' => 'Denmark'],
            'MAK' => ['name' => 'Conlux USA Corporation', 'country' => 'U.S.A.'],
            'MAS' => ['name' => 'Maas International', 'country' => 'The Netherlands'],
            'MAX' => ['name' => 'Maxtrol Corporation', 'country' => 'U.S.A.'],
            'MCC' => ['name' => 'Magna Carta Chip Card Solutions bv', 'country' => 'The Netherlands'],
            'MCS' => ['name' => 'MCS Micronic Computer Systeme GmbH', 'country' => 'Germany'],
            'MEI' => ['name' => 'Mars Electronics International', 'country' => 'UK, U.S.A., Switzerland'],
            'MFX' => ['name' => 'Moneyflex', 'country' => 'U.S.A.'],
            'MIC' => ['name' => 'Microtronic', 'country' => 'Switzerland'],
            'MIK' => ['name' => 'mikrolab GmbH', 'country' => 'Germany'],
            'MNM' => ['name' => 'MNM Automatenbau', 'country' => 'Germany'],
            'MPX' => ['name' => 'Maxpax', 'country' => 'U.K.'],
            'MSC' => ['name' => 'Microsystem Controls Pty Ltd', 'country' => 'U.K.'],
            'NAM' => ['name' => 'NAMA', 'country' => 'U.S.A.'],
            'NAT' => ['name' => 'Nagler Automaten Technik GmbH', 'country' => 'Germany'],
            'NBF' => ['name' => 'Nuova Bianchi', 'country' => 'Italy'],
            'NCO' => ['name' => 'Nippon Conlux', 'country' => 'Japan'],
            'NEC' => ['name' => 'Necta Vending Solutions', 'country' => 'Italy'],
            'NES' => ['name' => 'Nestlé Professional', 'country' => 'Switzerland'],
            'NEW' => ['name' => 'Newtec Ebert GmbH', 'country' => 'Germany'],
            'NIS' => ['name' => 'N&W Innovative Solutions', 'country' => 'Italy'],
            'NIT' => ['name' => 'Nitela', 'country' => 'Turkey'],
            'NRI' => ['name' => 'National Rejectors Inc.', 'country' => 'Germany'],
            'NYX' => ['name' => 'Nayax', 'country' => 'Israel'],
            'OMN' => ['name' => 'Omnimatic', 'country' => 'Italy'],
            'OMR' => ['name' => 'Omron', 'country' => 'Germany'],
            'OTR' => ['name' => 'O.T.R.', 'country' => 'Italy'],
            'PIL' => ['name' => 'Planeta Informatica Ltda', 'country' => 'Brazil'],
            'PJV' => ['name' => 'Project Vending Srl', 'country' => 'Italy'],
            'PLF' => ['name' => 'Profilic Technologies Inc', 'country' => 'Canada'],
            'PML' => ['name' => 'Playsafe Monitoring Limited', 'country' => 'U.K.'],
            'PRA' => ['name' => 'Pranasys', 'country' => 'Uruguay'],
            'PRO' => ['name' => 'Protel, Inc.', 'country' => 'U.S.A.'],
            'PRT' => ['name' => 'Protere', 'country' => 'Portugal'],
            'PSL' => ['name' => 'Provend Services Limited', 'country' => 'U.K.'],
            'PTA' => ['name' => 'PayTec AG', 'country' => 'Switzerland'],
            'PTV' => ['name' => 'Politeknik Elektronik', 'country' => 'Turkey'],
            'QEB' => ['name' => 'Quality Equipment Benelux B.V.', 'country' => 'The Netherlands'],
            'RFT' => ['name' => 'RFTECH SRL', 'country' => 'Italy'],
            'RHV' => ['name' => 'Rhea Vendors', 'country' => 'Italy'],
            'ROE' => ['name' => 'Roesler', 'country' => 'Germany'],
            'ROG' => ['name' => 'Royal Olland Group', 'country' => 'The Netherlands'],
            'ROW' => ['name' => 'Rowe International', 'country' => 'U.S.A.'],
            'SAD' => ['name' => 'Sade Group', 'country' => 'Turkey'],
            'SAE' => ['name' => 'Saeco Intl Group', 'country' => 'Italy'],
            'SAG' => ['name' => 'Sagem Monetel', 'country' => 'France'],
            'SAR' => ['name' => 'Schaerer AG', 'country' => 'Switzerland'],
            'SCH' => ['name' => 'Schmidt GmbH', 'country' => 'Germany'],
            'SEL' => ['name' => 'Selecta', 'country' => 'Switzerland'],
            'SHP' => ['name' => 'SUZOHAPP', 'country' => 'The Netherlands'],
            'SIE' => ['name' => 'Sielaff', 'country' => 'Germany'],
            'SIL' => ['name' => 'Silibit srl', 'country' => 'Italy'],
            'SIP' => ['name' => 'Siemens Intelligent Traffic System', 'country' => 'Germany'],
            'SMA' => ['name' => 'Smarcom', 'country' => 'Switzerland'],
            'SMS' => ['name' => 'Sm solutions GmbH', 'country' => 'Germany'],
            'SOF' => ['name' => 'Softel, s.a. de C.V.', 'country' => 'Mexico'],
            'SPG' => ['name' => 'Spengler', 'country' => 'Germany'],
            'STF' => ['name' => 'Stentorfield', 'country' => 'U.K.'],
            'SVM' => ['name' => 'Sanyo Electric Co, Vending Machine Division', 'country' => 'Japan'],
            'SWR' => ['name' => 'Streamware Corporation', 'country' => 'U.S.A.'],
            'TES' => ['name' => 'Tuttoespresso', 'country' => 'Italy'],
            'TET' => ['name' => 'Hypercom', 'country' => 'Germany/France'],
            'TMG' => ['name' => 'T M Group', 'country' => 'U.K.'],
            'TOM' => ['name' => 'Tommerup Elektronik', 'country' => 'Denmark'],
            'TRA' => ['name' => 'Tratécnica', 'country' => 'Spain'],
            'UNI' => ['name' => 'Unicum', 'country' => 'Russia'],
            'VCS' => ['name' => 'Versatile Control Systems', 'country' => 'U.S.A.'],
            'VDK' => ['name' => 'Vendotek', 'country' => 'Czech Republic'],
            'VEC' => ['name' => 'VendingControl Gesellschaft', 'country' => 'Germany'],
            'VEI' => ['name' => 'Vendors Exchange International, Inc', 'country' => 'U.S.A.'],
            'VFI' => ['name' => 'Verifone International', 'country' => 'U.S.A.'],
            'VIA' => ['name' => 'Vianet Group', 'country' => 'U.K.'],
            'VMI' => ['name' => 'Veromatic International', 'country' => 'The Netherlands'],
            'VML' => ['name' => 'Vending Microcircuits Limited', 'country' => 'U.K.'],
            'VMV' => ['name' => 'Vending Machines Verona', 'country' => 'Italy'],
            'VND' => ['name' => 'Vendo', 'country' => 'U.S.A., Italy'],
            'VON' => ['name' => 'Vendon', 'country' => 'Latvia'],
            'VST' => ['name' => 'Verisoft', 'country' => 'Turkey'],
            'WHM' => ['name' => 'WH Münzprüfer Dietmar Trenner Gmbh', 'country' => 'Germany'],
            'WIK' => ['name' => 'Witkowsli GmbH', 'country' => 'Germany'],
            'WIT' => ['name' => 'N&W Global Vending', 'country' => 'U.K.'],
            'WTC' => ['name' => 'World . Techno Co, Ltd', 'country' => 'Japan'],
            'WTN' => ['name' => 'Wittern Group', 'country' => 'U.S.A.'],
            'WUR' => ['name' => 'Deutsche Wurlitzer', 'country' => 'Germany'],
            'WVS' => ['name' => 'Westomatic Vending Services', 'country' => 'U.K.'],
            'XCP' => ['name' => 'XCP/nc', 'country' => 'U.S.A.']
        ];
    }

    /**
     * Resolve manufacturer code to full information
     * 
     * @param string $code 3-letter manufacturer code
     * @return array|null Manufacturer information or null if not found
     */
    public static function resolve(string $code): ?array
    {
        $manufacturers = self::getAll();
        $code = strtoupper(trim($code));
        
        return $manufacturers[$code] ?? null;
    }

    /**
     * Search manufacturers by name or country
     * 
     * @param string $search Search term (name or country)
     * @return array Array of matching manufacturers with codes
     */
    public static function search(string $search): array
    {
        $manufacturers = self::getAll();
        $results = [];
        $search = strtolower($search);
        
        foreach ($manufacturers as $code => $info) {
            if (strpos(strtolower($info['name']), $search) !== false ||
                strpos(strtolower($info['country']), $search) !== false) {
                $results[$code] = $info;
            }
        }
        
        return $results;
    }
}
