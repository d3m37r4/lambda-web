<?php

namespace Database\Seeders;

use DB;
use Exception;
use Illuminate\Database\Seeder;
use Schema;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $table = 'countries';
        $countries = [
            [
                'short_code' => 'AB',
                'name' => 'Abkhazia'
            ],
            [
                'short_code' => 'AU',
                'name' => 'Australia'
            ],
            [
                'short_code' => 'AT',
                'name' => 'Austria'
            ],
            [
                'short_code' => 'AZ',
                'name' => 'Azerbaijan'
            ],
            [
                'short_code' => 'AL',
                'name' => 'Albania'
            ],
            [
                'short_code' => 'DZ',
                'name' => 'Algeria'
            ],
            [
                'short_code' => 'AS',
                'name' => 'American Samoa'
            ],
            [
                'short_code' => 'AI',
                'name' => 'Anguilla'
            ],
            [
                'short_code' => 'AO',
                'name' => 'Angola'
            ],
            [
                'short_code' => 'AD',
                'name' => 'Andorra'
            ],
            [
                'short_code' => 'AQ',
                'name' => 'Antarctica'
            ],
            [
                'short_code' => 'AG',
                'name' => 'Antigua and Barbuda'
            ],
            [
                'short_code' => 'AR',
                'name' => 'Argentina'
            ],
            [
                'short_code' => 'AM',
                'name' => 'Armenia'
            ],
            [
                'short_code' => 'AW',
                'name' => 'Aruba'
            ],
            [
                'short_code' => 'AF',
                'name' => 'Afghanistan'
            ],
            [
                'short_code' => 'BS',
                'name' => 'Bahamas'
            ],
            [
                'short_code' => 'BD',
                'name' => 'Bangladesh'
            ],
            [
                'short_code' => 'BB',
                'name' => 'Barbados'
            ],
            [
                'short_code' => 'BH',
                'name' => 'Bahrain'
            ],
            [
                'short_code' => 'BY',
                'name' => 'Belarus'
            ],
            [
                'short_code' => 'BZ',
                'name' => 'Belize'
            ],
            [
                'short_code' => 'BE',
                'name' => 'Belgium'
            ],
            [
                'short_code' => 'BJ',
                'name' => 'Benin'
            ],
            [
                'short_code' => 'BM',
                'name' => 'Bermuda'
            ],
            [
                'short_code' => 'BG',
                'name' => 'Bulgaria'
            ],
            [
                'short_code' => 'BO',
                'name' => 'Bolivia, plurinational state of'
            ],
            [
                'short_code' => 'BQ',
                'name' => 'Bonaire, Sint Eustatius and Saba'
            ],
            [
                'short_code' => 'BA',
                'name' => 'Bosnia and Herzegovina'
            ],
            [
                'short_code' => 'BW',
                'name' => 'Botswana'
            ],
            [
                'short_code' => 'BR',
                'name' => 'Brazil'
            ],
            [
                'short_code' => 'IO',
                'name' => 'British Indian Ocean Territory'
            ],
            [
                'short_code' => 'BN',
                'name' => 'Brunei Darussalam'
            ],
            [
                'short_code' => 'BF',
                'name' => 'Burkina Faso'
            ],
            [
                'short_code' => 'BI',
                'name' => 'Burundi'
            ],
            [
                'short_code' => 'BT',
                'name' => 'Bhutan'
            ],
            [
                'short_code' => 'VU',
                'name' => 'Vanuatu'
            ],
            [
                'short_code' => 'HU',
                'name' => 'Hungary'
            ],
            [
                'short_code' => 'VE',
                'name' => 'Venezuela'
            ],
            [
                'short_code' => 'VG',
                'name' => 'Virgin Islands, British'
            ],
            [
                'short_code' => 'VI',
                'name' => 'Virgin Islands, U.S.'
            ],
            [
                'short_code' => 'VN',
                'name' => 'Vietnam'
            ],
            [
                'short_code' => 'GA',
                'name' => 'Gabon'
            ],
            [
                'short_code' => 'HT',
                'name' => 'Haiti'
            ],
            [
                'short_code' => 'GY',
                'name' => 'Guyana'
            ],
            [
                'short_code' => 'GM',
                'name' => 'Gambia'
            ],
            [
                'short_code' => 'GH',
                'name' => 'Ghana'
            ],
            [
                'short_code' => 'GP',
                'name' => 'Guadeloupe'
            ],
            [
                'short_code' => 'GT',
                'name' => 'Guatemala'
            ],
            [
                'short_code' => 'GN',
                'name' => 'Guinea'
            ],
            [
                'short_code' => 'GW',
                'name' => 'Guinea-Bissau'
            ],
            [
                'short_code' => 'DE',
                'name' => 'Germany'
            ],
            [
                'short_code' => 'GG',
                'name' => 'Guernsey'
            ],
            [
                'short_code' => 'GI',
                'name' => 'Gibraltar'
            ],
            [
                'short_code' => 'HN',
                'name' => 'Honduras'
            ],
            [
                'short_code' => 'HK',
                'name' => 'Hong Kong'
            ],
            [
                'short_code' => 'GD',
                'name' => 'Grenada'
            ],
            [
                'short_code' => 'GL',
                'name' => 'Greenland'
            ],
            [
                'short_code' => 'GR',
                'name' => 'Greece'
            ],
            [
                'short_code' => 'GE',
                'name' => 'Georgia'
            ],
            [
                'short_code' => 'GU',
                'name' => 'Guam'
            ],
            [
                'short_code' => 'DK',
                'name' => 'Denmark'
            ],
            [
                'short_code' => 'JE',
                'name' => 'Jersey'
            ],
            [
                'short_code' => 'DJ',
                'name' => 'Djibouti'
            ],
            [
                'short_code' => 'DM',
                'name' => 'Dominica'
            ],
            [
                'short_code' => 'DO',
                'name' => 'Dominican Republic'
            ],
            [
                'short_code' => 'EG',
                'name' => 'Egypt'
            ],
            [
                'short_code' => 'ZM',
                'name' => 'Zambia'
            ],
            [
                'short_code' => 'EH',
                'name' => 'Western Sahara'
            ],
            [
                'short_code' => 'ZW',
                'name' => 'Zimbabwe'
            ],
            [
                'short_code' => 'IL',
                'name' => 'Israel'
            ],
            [
                'short_code' => 'IN',
                'name' => 'India'
            ],
            [
                'short_code' => 'ID',
                'name' => 'Indonesia'
            ],
            [
                'short_code' => 'JO',
                'name' => 'Jordan'
            ],
            [
                'short_code' => 'IQ',
                'name' => 'Iraq'
            ],
            [
                'short_code' => 'IR',
                'name' => 'Iran, Islamic Republic of'
            ],
            [
                'short_code' => 'IE',
                'name' => 'Ireland'
            ],
            [
                'short_code' => 'IS',
                'name' => 'Iceland'
            ],
            [
                'short_code' => 'ES',
                'name' => 'Spain'
            ],
            [
                'short_code' => 'IT',
                'name' => 'Italy'
            ],
            [
                'short_code' => 'YE',
                'name' => 'Yemen'
            ],
            [
                'short_code' => 'CV',
                'name' => 'Cape Verde'
            ],
            [
                'short_code' => 'KZ',
                'name' => 'Kazakhstan'
            ],
            [
                'short_code' => 'KH',
                'name' => 'Cambodia'
            ],
            [
                'short_code' => 'CM',
                'name' => 'Cameroon'
            ],
            [
                'short_code' => 'CA',
                'name' => 'Canada'
            ],
            [
                'short_code' => 'QA',
                'name' => 'Qatar'
            ],
            [
                'short_code' => 'KE',
                'name' => 'Kenya'
            ],
            [
                'short_code' => 'CY',
                'name' => 'Cyprus'
            ],
            [
                'short_code' => 'KG',
                'name' => 'Kyrgyzstan'
            ],
            [
                'short_code' => 'KI',
                'name' => 'Kiribati'
            ],
            [
                'short_code' => 'CN',
                'name' => 'China'
            ],
            [
                'short_code' => 'CC',
                'name' => 'Cocos (Keeling) Islands'
            ],
            [
                'short_code' => 'CO',
                'name' => 'Colombia'
            ],
            [
                'short_code' => 'KM',
                'name' => 'Comoros'
            ],
            [
                'short_code' => 'CG',
                'name' => 'Congo'
            ],
            [
                'short_code' => 'CD',
                'name' => 'Congo, Democratic Republic of the'
            ],
            [
                'short_code' => 'KP',
                'name' => "Korea, Democratic People's republic of"
            ],
            [
                'short_code' => 'KR',
                'name' => 'Korea, Republic of'
            ],
            [
                'short_code' => 'CR',
                'name' => 'Costa Rica'
            ],
            [
                'short_code' => 'CI',
                'name' => "Cote d'Ivoire"
            ],
            [
                'short_code' => 'CU',
                'name' => 'Cuba'
            ],
            [
                'short_code' => 'KW',
                'name' => 'Kuwait'
            ],
            [
                'short_code' => 'CW',
                'name' => 'Curaçao'
            ],
            [
                'short_code' => 'LA',
                'name' => "Lao People's Democratic Republic"
            ],
            [
                'short_code' => 'LV',
                'name' => 'Latvia'
            ],
            [
                'short_code' => 'LS',
                'name' => 'Lesotho'
            ],
            [
                'short_code' => 'LB',
                'name' => 'Lebanon'
            ],
            [
                'short_code' => 'LY',
                'name' => 'Libyan Arab Jamahiriya'
            ],
            [
                'short_code' => 'LR',
                'name' => 'Liberia'
            ],
            [
                'short_code' => 'LI',
                'name' => 'Liechtenstein'
            ],
            [
                'short_code' => 'LT',
                'name' => 'Lithuania'
            ],
            [
                'short_code' => 'LU',
                'name' => 'Luxembourg'
            ],
            [
                'short_code' => 'MU',
                'name' => 'Mauritius'
            ],
            [
                'short_code' => 'MR',
                'name' => 'Mauritania'
            ],
            [
                'short_code' => 'MG',
                'name' => 'Madagascar'
            ],
            [
                'short_code' => 'YT',
                'name' => 'Mayotte'
            ],
            [
                'short_code' => 'MO',
                'name' => 'Macao'
            ],
            [
                'short_code' => 'MW',
                'name' => 'Malawi'
            ],
            [
                'short_code' => 'MY',
                'name' => 'Malaysia'
            ],
            [
                'short_code' => 'ML',
                'name' => 'Mali'
            ],
            [
                'short_code' => 'UM',
                'name' => 'United States Minor Outlying Islands'
            ],
            [
                'short_code' => 'MV',
                'name' => 'Maldives'
            ],
            [
                'short_code' => 'MT',
                'name' => 'Malta'
            ],
            [
                'short_code' => 'MA',
                'name' => 'Morocco'
            ],
            [
                'short_code' => 'MQ',
                'name' => 'Martinique'
            ],
            [
                'short_code' => 'MH',
                'name' => 'Marshall Islands'
            ],
            [
                'short_code' => 'MX',
                'name' => 'Mexico'
            ],
            [
                'short_code' => 'FM',
                'name' => 'Micronesia, Federated States of'
            ],
            [
                'short_code' => 'MZ',
                'name' => 'Mozambique'
            ],
            [
                'short_code' => 'MD',
                'name' => 'Moldova'
            ],
            [
                'short_code' => 'MC',
                'name' => 'Monaco'
            ],
            [
                'short_code' => 'MN',
                'name' => 'Mongolia'
            ],
            [
                'short_code' => 'MS',
                'name' => 'Montserrat'
            ],
            [
                'short_code' => 'MM',
                'name' => 'Myanmar'
            ],
            [
                'short_code' => 'NA',
                'name' => 'Namibia'
            ],
            [
                'short_code' => 'NR',
                'name' => 'Nauru'
            ],
            [
                'short_code' => 'NP',
                'name' => 'Nepal'
            ],
            [
                'short_code' => 'NE',
                'name' => 'Niger'
            ],
            [
                'short_code' => 'NG',
                'name' => 'Nigeria'
            ],
            [
                'short_code' => 'NL',
                'name' => 'Netherlands'
            ],
            [
                'short_code' => 'NI',
                'name' => 'Nicaragua'
            ],
            [
                'short_code' => 'NU',
                'name' => 'Niue'
            ],
            [
                'short_code' => 'NZ',
                'name' => 'New Zealand'
            ],
            [
                'short_code' => 'NC',
                'name' => 'New Caledonia'
            ],
            [
                'short_code' => 'NO',
                'name' => 'Norway'
            ],
            [
                'short_code' => 'AE',
                'name' => 'United Arab Emirates'
            ],
            [
                'short_code' => 'OM',
                'name' => 'Oman'
            ],
            [
                'short_code' => 'BV',
                'name' => 'Bouvet Island'
            ],
            [
                'short_code' => 'IM',
                'name' => 'Isle of Man'
            ],
            [
                'short_code' => 'NF',
                'name' => 'Norfolk Island'
            ],
            [
                'short_code' => 'CX',
                'name' => 'Christmas Island'
            ],
            [
                'short_code' => 'HM',
                'name' => 'Heard Island and McDonald Islands'
            ],
            [
                'short_code' => 'KY',
                'name' => 'Cayman Islands'
            ],
            [
                'short_code' => 'CK',
                'name' => 'Cook Islands'
            ],
            [
                'short_code' => 'TC',
                'name' => 'Turks and Caicos Islands'
            ],
            [
                'short_code' => 'PK',
                'name' => 'Pakistan'
            ],
            [
                'short_code' => 'PW',
                'name' => 'Palau'
            ],
            [
                'short_code' => 'PS',
                'name' => 'Palestinian Territory, Occupied'
            ],
            [
                'short_code' => 'PA',
                'name' => 'Panama'
            ],
            [
                'short_code' => 'VA',
                'name' => 'Holy See (Vatican City State)'
            ],
            [
                'short_code' => 'PG',
                'name' => 'Papua New Guinea'
            ],
            [
                'short_code' => 'PY',
                'name' => 'Paraguay'
            ],
            [
                'short_code' => 'PE',
                'name' => 'Peru'
            ],
            [
                'short_code' => 'PN',
                'name' => 'Pitcairn'
            ],
            [
                'short_code' => 'PL',
                'name' => 'Poland'
            ],
            [
                'short_code' => 'PT',
                'name' => 'Portugal'
            ],
            [
                'short_code' => 'PR',
                'name' => 'Puerto Rico'
            ],
            [
                'short_code' => 'MK',
                'name' => 'Macedonia, The Former Yugoslav Republic Of'
            ],
            [
                'short_code' => 'RE',
                'name' => 'Reunion'
            ],
            [
                'short_code' => 'RU',
                'name' => 'Russian Federation'
            ],
            [
                'short_code' => 'RW',
                'name' => 'Rwanda'
            ],
            [
                'short_code' => 'RO',
                'name' => 'Romania'
            ],
            [
                'short_code' => 'WS',
                'name' => 'Samoa'
            ],
            [
                'short_code' => 'SM',
                'name' => 'San Marino'
            ],
            [
                'short_code' => 'ST',
                'name' => 'Sao Tome and Principe'
            ],
            [
                'short_code' => 'SA',
                'name' => 'Saudi Arabia'
            ],
            [
                'short_code' => 'SH',
                'name' => 'Saint Helena, Ascension And Tristan Da Cunha'
            ],
            [
                'short_code' => 'MP',
                'name' => 'Northern Mariana Islands'
            ],
            [
                'short_code' => 'BL',
                'name' => 'Saint Barthélemy'
            ],
            [
                'short_code' => 'MF',
                'name' => 'Saint Martin (French Part)'
            ],
            [
                'short_code' => 'SN',
                'name' => 'Senegal'
            ],
            [
                'short_code' => 'VC',
                'name' => 'Saint Vincent and the Grenadines'
            ],
            [
                'short_code' => 'LC',
                'name' => 'Saint Lucia'
            ],
            [
                'short_code' => 'KN',
                'name' => 'Saint Kitts and Nevis'
            ],
            [
                'short_code' => 'PM',
                'name' => 'Saint Pierre and Miquelon'
            ],
            [
                'short_code' => 'RS',
                'name' => 'Serbia'
            ],
            [
                'short_code' => 'SC',
                'name' => 'Seychelles'
            ],
            [
                'short_code' => 'SG',
                'name' => 'Singapore'
            ],
            [
                'short_code' => 'SX',
                'name' => 'Sint Maarten'
            ],
            [
                'short_code' => 'SY',
                'name' => 'Syrian Arab Republic'
            ],
            [
                'short_code' => 'SK',
                'name' => 'Slovakia'
            ],
            [
                'short_code' => 'SI',
                'name' => 'Slovenia'
            ],
            [
                'short_code' => 'GB',
                'name' => 'United Kingdom'
            ],
            [
                'short_code' => 'US',
                'name' => 'United States'
            ],
            [
                'short_code' => 'SB',
                'name' => 'Solomon Islands'
            ],
            [
                'short_code' => 'SO',
                'name' => 'Somalia'
            ],
            [
                'short_code' => 'SD',
                'name' => 'Sudan'
            ],
            [
                'short_code' => 'SR',
                'name' => 'Suriname'
            ],
            [
                'short_code' => 'SL',
                'name' => 'Sierra Leone'
            ],
            [
                'short_code' => 'TJ',
                'name' => 'Tajikistan'
            ],
            [
                'short_code' => 'TH',
                'name' => 'Thailand'
            ],
            [
                'short_code' => 'TW',
                'name' => 'Taiwan, Province of China'
            ],
            [
                'short_code' => 'TZ',
                'name' => 'Tanzania, United Republic Of'
            ],
            [
                'short_code' => 'TL',
                'name' => 'Timor-Leste'
            ],
            [
                'short_code' => 'TG',
                'name' => 'Togo'
            ],
            [
                'short_code' => 'TK',
                'name' => 'Tokelau'
            ],
            [
                'short_code' => 'TO',
                'name' => 'Tonga'
            ],
            [
                'short_code' => 'TT',
                'name' => 'Trinidad and Tobago'
            ],
            [
                'short_code' => 'TV',
                'name' => 'Tuvalu'
            ],
            [
                'short_code' => 'TN',
                'name' => 'Tunisia'
            ],
            [
                'short_code' => 'TM',
                'name' => 'Turkmenistan'
            ],
            [
                'short_code' => 'TR',
                'name' => 'Turkey'
            ],
            [
                'short_code' => 'UG',
                'name' => 'Uganda'
            ],
            [
                'short_code' => 'UZ',
                'name' => 'Uzbekistan'
            ],
            [
                'short_code' => 'UA',
                'name' => 'Ukraine'
            ],
            [
                'short_code' => 'WF',
                'name' => 'Wallis and Futuna'
            ],
            [
                'short_code' => 'UY',
                'name' => 'Uruguay'
            ],
            [
                'short_code' => 'FO',
                'name' => 'Faroe Islands'
            ],
            [
                'short_code' => 'FJ',
                'name' => 'Fiji'
            ],
            [
                'short_code' => 'PH',
                'name' => 'Philippines'
            ],
            [
                'short_code' => 'FI',
                'name' => 'Finland'
            ],
            [
                'short_code' => 'FK',
                'name' => 'Falkland Islands (Malvinas)'
            ],
            [
                'short_code' => 'FR',
                'name' => 'France'
            ],
            [
                'short_code' => 'GF',
                'name' => 'French Guiana'
            ],
            [
                'short_code' => 'PF',
                'name' => 'French Polynesia'
            ],
            [
                'short_code' => 'TF',
                'name' => 'French Southern Territories'
            ],
            [
                'short_code' => 'HR',
                'name' => 'Croatia'
            ],
            [
                'short_code' => 'CF',
                'name' => 'Central African Republic'
            ],
            [
                'short_code' => 'TD',
                'name' => 'Chad'
            ],
            [
                'short_code' => 'ME',
                'name' => 'Montenegro'
            ],
            [
                'short_code' => 'CZ',
                'name' => 'Czech Republic'
            ],
            [
                'short_code' => 'CL',
                'name' => 'Chile'
            ],
            [
                'short_code' => 'CH',
                'name' => 'Switzerland'
            ],
            [
                'short_code' => 'SE',
                'name' => 'Sweden'
            ],
            [
                'short_code' => 'SJ',
                'name' => 'Svalbard and Jan Mayen'
            ],
            [
                'short_code' => 'LK',
                'name' => 'Sri Lanka'
            ],
            [
                'short_code' => 'EC',
                'name' => 'Ecuador'
            ],
            [
                'short_code' => 'GQ',
                'name' => 'Equatorial Guinea'
            ],
            [
                'short_code' => 'AX',
                'name' => 'Åland Islands'
            ],
            [
                'short_code' => 'SV',
                'name' => 'El Salvador'
            ],
            [
                'short_code' => 'ER',
                'name' => 'Eritrea'
            ],
            [
                'short_code' => 'SZ',
                'name' => 'Eswatini'
            ],
            [
                'short_code' => 'EE',
                'name' => 'Estonia'
            ],
            [
                'short_code' => 'ET',
                'name' => 'Ethiopia'
            ],
            [
                'short_code' => 'ZA',
                'name' => 'South Africa'
            ],
            [
                'short_code' => 'GS',
                'name' => 'South Georgia and the South Sandwich Islands'
            ],
            [
                'short_code' => 'OS',
                'name' => 'South Ossetia'
            ],
            [
                'short_code' => 'SS',
                'name' => 'South Sudan'
            ],
            [
                'short_code' => 'JM',
                'name' => 'Jamaica'
            ],
            [
                'short_code' => 'JP',
                'name' => 'Japan'
            ]
        ];

        if (Schema::hasTable($table)) {
            DB::table($table)->insert($countries);
        } else {
            throw new \Exception("The '$table' database was not found!");
        }
    }
}
