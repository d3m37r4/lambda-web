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
                'default_name' => 'Abkhazia'
            ],
            [
                'short_code' => 'AU',
                'default_name' => 'Australia'
            ],
            [
                'short_code' => 'AT',
                'default_name' => 'Austria'
            ],
            [
                'short_code' => 'AZ',
                'default_name' => 'Azerbaijan'
            ],
            [
                'short_code' => 'AL',
                'default_name' => 'Albania'
            ],
            [
                'short_code' => 'DZ',
                'default_name' => 'Algeria'
            ],
            [
                'short_code' => 'AS',
                'default_name' => 'American Samoa'
            ],
            [
                'short_code' => 'AI',
                'default_name' => 'Anguilla'
            ],
            [
                'short_code' => 'AO',
                'default_name' => 'Angola'
            ],
            [
                'short_code' => 'AD',
                'default_name' => 'Andorra'
            ],
            [
                'short_code' => 'AQ',
                'default_name' => 'Antarctica'
            ],
            [
                'short_code' => 'AG',
                'default_name' => 'Antigua and Barbuda'
            ],
            [
                'short_code' => 'AR',
                'default_name' => 'Argentina'
            ],
            [
                'short_code' => 'AM',
                'default_name' => 'Armenia'
            ],
            [
                'short_code' => 'AW',
                'default_name' => 'Aruba'
            ],
            [
                'short_code' => 'AF',
                'default_name' => 'Afghanistan'
            ],
            [
                'short_code' => 'BS',
                'default_name' => 'Bahamas'
            ],
            [
                'short_code' => 'BD',
                'default_name' => 'Bangladesh'
            ],
            [
                'short_code' => 'BB',
                'default_name' => 'Barbados'
            ],
            [
                'short_code' => 'BH',
                'default_name' => 'Bahrain'
            ],
            [
                'short_code' => 'BY',
                'default_name' => 'Belarus'
            ],
            [
                'short_code' => 'BZ',
                'default_name' => 'Belize'
            ],
            [
                'short_code' => 'BE',
                'default_name' => 'Belgium'
            ],
            [
                'short_code' => 'BJ',
                'default_name' => 'Benin'
            ],
            [
                'short_code' => 'BM',
                'default_name' => 'Bermuda'
            ],
            [
                'short_code' => 'BG',
                'default_name' => 'Bulgaria'
            ],
            [
                'short_code' => 'BO',
                'default_name' => 'Bolivia, plurinational state of'
            ],
            [
                'short_code' => 'BQ',
                'default_name' => 'Bonaire, Sint Eustatius and Saba'
            ],
            [
                'short_code' => 'BA',
                'default_name' => 'Bosnia and Herzegovina'
            ],
            [
                'short_code' => 'BW',
                'default_name' => 'Botswana'
            ],
            [
                'short_code' => 'BR',
                'default_name' => 'Brazil'
            ],
            [
                'short_code' => 'IO',
                'default_name' => 'British Indian Ocean Territory'
            ],
            [
                'short_code' => 'BN',
                'default_name' => 'Brunei Darussalam'
            ],
            [
                'short_code' => 'BF',
                'default_name' => 'Burkina Faso'
            ],
            [
                'short_code' => 'BI',
                'default_name' => 'Burundi'
            ],
            [
                'short_code' => 'BT',
                'default_name' => 'Bhutan'
            ],
            [
                'short_code' => 'VU',
                'default_name' => 'Vanuatu'
            ],
            [
                'short_code' => 'HU',
                'default_name' => 'Hungary'
            ],
            [
                'short_code' => 'VE',
                'default_name' => 'Venezuela'
            ],
            [
                'short_code' => 'VG',
                'default_name' => 'Virgin Islands, British'
            ],
            [
                'short_code' => 'VI',
                'default_name' => 'Virgin Islands, U.S.'
            ],
            [
                'short_code' => 'VN',
                'default_name' => 'Vietnam'
            ],
            [
                'short_code' => 'GA',
                'default_name' => 'Gabon'
            ],
            [
                'short_code' => 'HT',
                'default_name' => 'Haiti'
            ],
            [
                'short_code' => 'GY',
                'default_name' => 'Guyana'
            ],
            [
                'short_code' => 'GM',
                'default_name' => 'Gambia'
            ],
            [
                'short_code' => 'GH',
                'default_name' => 'Ghana'
            ],
            [
                'short_code' => 'GP',
                'default_name' => 'Guadeloupe'
            ],
            [
                'short_code' => 'GT',
                'default_name' => 'Guatemala'
            ],
            [
                'short_code' => 'GN',
                'default_name' => 'Guinea'
            ],
            [
                'short_code' => 'GW',
                'default_name' => 'Guinea-Bissau'
            ],
            [
                'short_code' => 'DE',
                'default_name' => 'Germany'
            ],
            [
                'short_code' => 'GG',
                'default_name' => 'Guernsey'
            ],
            [
                'short_code' => 'GI',
                'default_name' => 'Gibraltar'
            ],
            [
                'short_code' => 'HN',
                'default_name' => 'Honduras'
            ],
            [
                'short_code' => 'HK',
                'default_name' => 'Hong Kong'
            ],
            [
                'short_code' => 'GD',
                'default_name' => 'Grenada'
            ],
            [
                'short_code' => 'GL',
                'default_name' => 'Greenland'
            ],
            [
                'short_code' => 'GR',
                'default_name' => 'Greece'
            ],
            [
                'short_code' => 'GE',
                'default_name' => 'Georgia'
            ],
            [
                'short_code' => 'GU',
                'default_name' => 'Guam'
            ],
            [
                'short_code' => 'DK',
                'default_name' => 'Denmark'
            ],
            [
                'short_code' => 'JE',
                'default_name' => 'Jersey'
            ],
            [
                'short_code' => 'DJ',
                'default_name' => 'Djibouti'
            ],
            [
                'short_code' => 'DM',
                'default_name' => 'Dominica'
            ],
            [
                'short_code' => 'DO',
                'default_name' => 'Dominican Republic'
            ],
            [
                'short_code' => 'EG',
                'default_name' => 'Egypt'
            ],
            [
                'short_code' => 'ZM',
                'default_name' => 'Zambia'
            ],
            [
                'short_code' => 'EH',
                'default_name' => 'Western Sahara'
            ],
            [
                'short_code' => 'ZW',
                'default_name' => 'Zimbabwe'
            ],
            [
                'short_code' => 'IL',
                'default_name' => 'Israel'
            ],
            [
                'short_code' => 'IN',
                'default_name' => 'India'
            ],
            [
                'short_code' => 'ID',
                'default_name' => 'Indonesia'
            ],
            [
                'short_code' => 'JO',
                'default_name' => 'Jordan'
            ],
            [
                'short_code' => 'IQ',
                'default_name' => 'Iraq'
            ],
            [
                'short_code' => 'IR',
                'default_name' => 'Iran, Islamic Republic of'
            ],
            [
                'short_code' => 'IE',
                'default_name' => 'Ireland'
            ],
            [
                'short_code' => 'IS',
                'default_name' => 'Iceland'
            ],
            [
                'short_code' => 'ES',
                'default_name' => 'Spain'
            ],
            [
                'short_code' => 'IT',
                'default_name' => 'Italy'
            ],
            [
                'short_code' => 'YE',
                'default_name' => 'Yemen'
            ],
            [
                'short_code' => 'CV',
                'default_name' => 'Cape Verde'
            ],
            [
                'short_code' => 'KZ',
                'default_name' => 'Kazakhstan'
            ],
            [
                'short_code' => 'KH',
                'default_name' => 'Cambodia'
            ],
            [
                'short_code' => 'CM',
                'default_name' => 'Cameroon'
            ],
            [
                'short_code' => 'CA',
                'default_name' => 'Canada'
            ],
            [
                'short_code' => 'QA',
                'default_name' => 'Qatar'
            ],
            [
                'short_code' => 'KE',
                'default_name' => 'Kenya'
            ],
            [
                'short_code' => 'CY',
                'default_name' => 'Cyprus'
            ],
            [
                'short_code' => 'KG',
                'default_name' => 'Kyrgyzstan'
            ],
            [
                'short_code' => 'KI',
                'default_name' => 'Kiribati'
            ],
            [
                'short_code' => 'CN',
                'default_name' => 'China'
            ],
            [
                'short_code' => 'CC',
                'default_name' => 'Cocos (Keeling) Islands'
            ],
            [
                'short_code' => 'CO',
                'default_name' => 'Colombia'
            ],
            [
                'short_code' => 'KM',
                'default_name' => 'Comoros'
            ],
            [
                'short_code' => 'CG',
                'default_name' => 'Congo'
            ],
            [
                'short_code' => 'CD',
                'default_name' => 'Congo, Democratic Republic of the'
            ],
            [
                'short_code' => 'KP',
                'default_name' => "Korea, Democratic People's republic of"
            ],
            [
                'short_code' => 'KR',
                'default_name' => 'Korea, Republic of'
            ],
            [
                'short_code' => 'CR',
                'default_name' => 'Costa Rica'
            ],
            [
                'short_code' => 'CI',
                'default_name' => "Cote d'Ivoire"
            ],
            [
                'short_code' => 'CU',
                'default_name' => 'Cuba'
            ],
            [
                'short_code' => 'KW',
                'default_name' => 'Kuwait'
            ],
            [
                'short_code' => 'CW',
                'default_name' => 'Curaçao'
            ],
            [
                'short_code' => 'LA',
                'default_name' => "Lao People's Democratic Republic"
            ],
            [
                'short_code' => 'LV',
                'default_name' => 'Latvia'
            ],
            [
                'short_code' => 'LS',
                'default_name' => 'Lesotho'
            ],
            [
                'short_code' => 'LB',
                'default_name' => 'Lebanon'
            ],
            [
                'short_code' => 'LY',
                'default_name' => 'Libyan Arab Jamahiriya'
            ],
            [
                'short_code' => 'LR',
                'default_name' => 'Liberia'
            ],
            [
                'short_code' => 'LI',
                'default_name' => 'Liechtenstein'
            ],
            [
                'short_code' => 'LT',
                'default_name' => 'Lithuania'
            ],
            [
                'short_code' => 'LU',
                'default_name' => 'Luxembourg'
            ],
            [
                'short_code' => 'MU',
                'default_name' => 'Mauritius'
            ],
            [
                'short_code' => 'MR',
                'default_name' => 'Mauritania'
            ],
            [
                'short_code' => 'MG',
                'default_name' => 'Madagascar'
            ],
            [
                'short_code' => 'YT',
                'default_name' => 'Mayotte'
            ],
            [
                'short_code' => 'MO',
                'default_name' => 'Macao'
            ],
            [
                'short_code' => 'MW',
                'default_name' => 'Malawi'
            ],
            [
                'short_code' => 'MY',
                'default_name' => 'Malaysia'
            ],
            [
                'short_code' => 'ML',
                'default_name' => 'Mali'
            ],
            [
                'short_code' => 'UM',
                'default_name' => 'United States Minor Outlying Islands'
            ],
            [
                'short_code' => 'MV',
                'default_name' => 'Maldives'
            ],
            [
                'short_code' => 'MT',
                'default_name' => 'Malta'
            ],
            [
                'short_code' => 'MA',
                'default_name' => 'Morocco'
            ],
            [
                'short_code' => 'MQ',
                'default_name' => 'Martinique'
            ],
            [
                'short_code' => 'MH',
                'default_name' => 'Marshall Islands'
            ],
            [
                'short_code' => 'MX',
                'default_name' => 'Mexico'
            ],
            [
                'short_code' => 'FM',
                'default_name' => 'Micronesia, Federated States of'
            ],
            [
                'short_code' => 'MZ',
                'default_name' => 'Mozambique'
            ],
            [
                'short_code' => 'MD',
                'default_name' => 'Moldova'
            ],
            [
                'short_code' => 'MC',
                'default_name' => 'Monaco'
            ],
            [
                'short_code' => 'MN',
                'default_name' => 'Mongolia'
            ],
            [
                'short_code' => 'MS',
                'default_name' => 'Montserrat'
            ],
            [
                'short_code' => 'MM',
                'default_name' => 'Myanmar'
            ],
            [
                'short_code' => 'NA',
                'default_name' => 'Namibia'
            ],
            [
                'short_code' => 'NR',
                'default_name' => 'Nauru'
            ],
            [
                'short_code' => 'NP',
                'default_name' => 'Nepal'
            ],
            [
                'short_code' => 'NE',
                'default_name' => 'Niger'
            ],
            [
                'short_code' => 'NG',
                'default_name' => 'Nigeria'
            ],
            [
                'short_code' => 'NL',
                'default_name' => 'Netherlands'
            ],
            [
                'short_code' => 'NI',
                'default_name' => 'Nicaragua'
            ],
            [
                'short_code' => 'NU',
                'default_name' => 'Niue'
            ],
            [
                'short_code' => 'NZ',
                'default_name' => 'New Zealand'
            ],
            [
                'short_code' => 'NC',
                'default_name' => 'New Caledonia'
            ],
            [
                'short_code' => 'NO',
                'default_name' => 'Norway'
            ],
            [
                'short_code' => 'AE',
                'default_name' => 'United Arab Emirates'
            ],
            [
                'short_code' => 'OM',
                'default_name' => 'Oman'
            ],
            [
                'short_code' => 'BV',
                'default_name' => 'Bouvet Island'
            ],
            [
                'short_code' => 'IM',
                'default_name' => 'Isle of Man'
            ],
            [
                'short_code' => 'NF',
                'default_name' => 'Norfolk Island'
            ],
            [
                'short_code' => 'CX',
                'default_name' => 'Christmas Island'
            ],
            [
                'short_code' => 'HM',
                'default_name' => 'Heard Island and McDonald Islands'
            ],
            [
                'short_code' => 'KY',
                'default_name' => 'Cayman Islands'
            ],
            [
                'short_code' => 'CK',
                'default_name' => 'Cook Islands'
            ],
            [
                'short_code' => 'TC',
                'default_name' => 'Turks and Caicos Islands'
            ],
            [
                'short_code' => 'PK',
                'default_name' => 'Pakistan'
            ],
            [
                'short_code' => 'PW',
                'default_name' => 'Palau'
            ],
            [
                'short_code' => 'PS',
                'default_name' => 'Palestinian Territory, Occupied'
            ],
            [
                'short_code' => 'PA',
                'default_name' => 'Panama'
            ],
            [
                'short_code' => 'VA',
                'default_name' => 'Holy See (Vatican City State)'
            ],
            [
                'short_code' => 'PG',
                'default_name' => 'Papua New Guinea'
            ],
            [
                'short_code' => 'PY',
                'default_name' => 'Paraguay'
            ],
            [
                'short_code' => 'PE',
                'default_name' => 'Peru'
            ],
            [
                'short_code' => 'PN',
                'default_name' => 'Pitcairn'
            ],
            [
                'short_code' => 'PL',
                'default_name' => 'Poland'
            ],
            [
                'short_code' => 'PT',
                'default_name' => 'Portugal'
            ],
            [
                'short_code' => 'PR',
                'default_name' => 'Puerto Rico'
            ],
            [
                'short_code' => 'MK',
                'default_name' => 'Macedonia, The Former Yugoslav Republic Of'
            ],
            [
                'short_code' => 'RE',
                'default_name' => 'Reunion'
            ],
            [
                'short_code' => 'RU',
                'default_name' => 'Russian Federation'
            ],
            [
                'short_code' => 'RW',
                'default_name' => 'Rwanda'
            ],
            [
                'short_code' => 'RO',
                'default_name' => 'Romania'
            ],
            [
                'short_code' => 'WS',
                'default_name' => 'Samoa'
            ],
            [
                'short_code' => 'SM',
                'default_name' => 'San Marino'
            ],
            [
                'short_code' => 'ST',
                'default_name' => 'Sao Tome and Principe'
            ],
            [
                'short_code' => 'SA',
                'default_name' => 'Saudi Arabia'
            ],
            [
                'short_code' => 'SH',
                'default_name' => 'Saint Helena, Ascension And Tristan Da Cunha'
            ],
            [
                'short_code' => 'MP',
                'default_name' => 'Northern Mariana Islands'
            ],
            [
                'short_code' => 'BL',
                'default_name' => 'Saint Barthélemy'
            ],
            [
                'short_code' => 'MF',
                'default_name' => 'Saint Martin (French Part)'
            ],
            [
                'short_code' => 'SN',
                'default_name' => 'Senegal'
            ],
            [
                'short_code' => 'VC',
                'default_name' => 'Saint Vincent and the Grenadines'
            ],
            [
                'short_code' => 'LC',
                'default_name' => 'Saint Lucia'
            ],
            [
                'short_code' => 'KN',
                'default_name' => 'Saint Kitts and Nevis'
            ],
            [
                'short_code' => 'PM',
                'default_name' => 'Saint Pierre and Miquelon'
            ],
            [
                'short_code' => 'RS',
                'default_name' => 'Serbia'
            ],
            [
                'short_code' => 'SC',
                'default_name' => 'Seychelles'
            ],
            [
                'short_code' => 'SG',
                'default_name' => 'Singapore'
            ],
            [
                'short_code' => 'SX',
                'default_name' => 'Sint Maarten'
            ],
            [
                'short_code' => 'SY',
                'default_name' => 'Syrian Arab Republic'
            ],
            [
                'short_code' => 'SK',
                'default_name' => 'Slovakia'
            ],
            [
                'short_code' => 'SI',
                'default_name' => 'Slovenia'
            ],
            [
                'short_code' => 'GB',
                'default_name' => 'United Kingdom'
            ],
            [
                'short_code' => 'US',
                'default_name' => 'United States'
            ],
            [
                'short_code' => 'SB',
                'default_name' => 'Solomon Islands'
            ],
            [
                'short_code' => 'SO',
                'default_name' => 'Somalia'
            ],
            [
                'short_code' => 'SD',
                'default_name' => 'Sudan'
            ],
            [
                'short_code' => 'SR',
                'default_name' => 'Suriname'
            ],
            [
                'short_code' => 'SL',
                'default_name' => 'Sierra Leone'
            ],
            [
                'short_code' => 'TJ',
                'default_name' => 'Tajikistan'
            ],
            [
                'short_code' => 'TH',
                'default_name' => 'Thailand'
            ],
            [
                'short_code' => 'TW',
                'default_name' => 'Taiwan, Province of China'
            ],
            [
                'short_code' => 'TZ',
                'default_name' => 'Tanzania, United Republic Of'
            ],
            [
                'short_code' => 'TL',
                'default_name' => 'Timor-Leste'
            ],
            [
                'short_code' => 'TG',
                'default_name' => 'Togo'
            ],
            [
                'short_code' => 'TK',
                'default_name' => 'Tokelau'
            ],
            [
                'short_code' => 'TO',
                'default_name' => 'Tonga'
            ],
            [
                'short_code' => 'TT',
                'default_name' => 'Trinidad and Tobago'
            ],
            [
                'short_code' => 'TV',
                'default_name' => 'Tuvalu'
            ],
            [
                'short_code' => 'TN',
                'default_name' => 'Tunisia'
            ],
            [
                'short_code' => 'TM',
                'default_name' => 'Turkmenistan'
            ],
            [
                'short_code' => 'TR',
                'default_name' => 'Turkey'
            ],
            [
                'short_code' => 'UG',
                'default_name' => 'Uganda'
            ],
            [
                'short_code' => 'UZ',
                'default_name' => 'Uzbekistan'
            ],
            [
                'short_code' => 'UA',
                'default_name' => 'Ukraine'
            ],
            [
                'short_code' => 'WF',
                'default_name' => 'Wallis and Futuna'
            ],
            [
                'short_code' => 'UY',
                'default_name' => 'Uruguay'
            ],
            [
                'short_code' => 'FO',
                'default_name' => 'Faroe Islands'
            ],
            [
                'short_code' => 'FJ',
                'default_name' => 'Fiji'
            ],
            [
                'short_code' => 'PH',
                'default_name' => 'Philippines'
            ],
            [
                'short_code' => 'FI',
                'default_name' => 'Finland'
            ],
            [
                'short_code' => 'FK',
                'default_name' => 'Falkland Islands (Malvinas)'
            ],
            [
                'short_code' => 'FR',
                'default_name' => 'France'
            ],
            [
                'short_code' => 'GF',
                'default_name' => 'French Guiana'
            ],
            [
                'short_code' => 'PF',
                'default_name' => 'French Polynesia'
            ],
            [
                'short_code' => 'TF',
                'default_name' => 'French Southern Territories'
            ],
            [
                'short_code' => 'HR',
                'default_name' => 'Croatia'
            ],
            [
                'short_code' => 'CF',
                'default_name' => 'Central African Republic'
            ],
            [
                'short_code' => 'TD',
                'default_name' => 'Chad'
            ],
            [
                'short_code' => 'ME',
                'default_name' => 'Montenegro'
            ],
            [
                'short_code' => 'CZ',
                'default_name' => 'Czech Republic'
            ],
            [
                'short_code' => 'CL',
                'default_name' => 'Chile'
            ],
            [
                'short_code' => 'CH',
                'default_name' => 'Switzerland'
            ],
            [
                'short_code' => 'SE',
                'default_name' => 'Sweden'
            ],
            [
                'short_code' => 'SJ',
                'default_name' => 'Svalbard and Jan Mayen'
            ],
            [
                'short_code' => 'LK',
                'default_name' => 'Sri Lanka'
            ],
            [
                'short_code' => 'EC',
                'default_name' => 'Ecuador'
            ],
            [
                'short_code' => 'GQ',
                'default_name' => 'Equatorial Guinea'
            ],
            [
                'short_code' => 'AX',
                'default_name' => 'Åland Islands'
            ],
            [
                'short_code' => 'SV',
                'default_name' => 'El Salvador'
            ],
            [
                'short_code' => 'ER',
                'default_name' => 'Eritrea'
            ],
            [
                'short_code' => 'SZ',
                'default_name' => 'Eswatini'
            ],
            [
                'short_code' => 'EE',
                'default_name' => 'Estonia'
            ],
            [
                'short_code' => 'ET',
                'default_name' => 'Ethiopia'
            ],
            [
                'short_code' => 'ZA',
                'default_name' => 'South Africa'
            ],
            [
                'short_code' => 'GS',
                'default_name' => 'South Georgia and the South Sandwich Islands'
            ],
            [
                'short_code' => 'OS',
                'default_name' => 'South Ossetia'
            ],
            [
                'short_code' => 'SS',
                'default_name' => 'South Sudan'
            ],
            [
                'short_code' => 'JM',
                'default_name' => 'Jamaica'
            ],
            [
                'short_code' => 'JP',
                'default_name' => 'Japan'
            ]
        ];

        if (Schema::hasTable($table)) {
            DB::table($table)->insert($countries);
        } else {
            throw new \Exception("The '$table' database was not found!");
        }
    }
}
