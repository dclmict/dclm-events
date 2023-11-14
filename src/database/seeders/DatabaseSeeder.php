<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Country;
use App\Models\Continent;
use App\Models\Program;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // DB::table('users')->delete();
        User::create(array(
            'name' => 'EventAdmin',
            'email' => 'dclmict@gmail.com',
            'password' => Hash::make(12345678),
        ));

        Continent::insert(
            [
                [ 'name' => "Africa" ],
                [ 'name' => "Antarctica"],
                [ 'name' => "Asia"],
                [ 'name' => "Australia/Oceania"],
                [ 'name' => "Europe"],
                [ 'name' => "North America"],
                [ 'name' => "South America"],
            ]
        );

        Program::insert([
            [
                'name' => 'Full Redemption Through Christ',
                'slug' => 'loose-him-let-him-go',
                'is_active' => true,
                'is_featured' => true,
                'image_location' => '/assets/img/event-img/asg.jpg',
                'event_type' => 'Global',
                'category' => 'EVENING CRUSADES',
                'event_days' => '26,27,28,29,30,31',
                'event_month' => 'OCT',
                'event_date' => '26-31',
                'event_countdown' => '2023/10/26 16:00:00',
                'schedules' => json_encode([
                    ['time' => '05:30PM', 'event' => 'Prelude Activities/Instrumental', 'speakers' => ''],
                    ['time' => '05:50PM', 'event' => 'Opening Prayer', 'speakers' => ''],
                    ['time' => '05:55PM', 'event' => 'Congregation Song', 'speakers' => ''],
                    ['time' => '06:00PM', 'event' => 'Intercession for Total Emancipation', 'speakers' => ''],
                    ['time' => '06:10PM', 'event' => 'Announcements', 'speakers' => ''],
                    ['time' => '06:15PM', 'event' => 'Choir from Nations', 'speakers' => ''],
                    ['time' => '06:25PM', 'event' => 'Testimonies', 'speakers' => ''],
                    ['time' => '06:35PM', 'event' => 'Alpha Location Choir', 'speakers' => ''],
                    ['time' => '06:40PM', 'event' => 'Music Minister', 'speakers' => ''],
                    ['time' => '07:00PM', 'event' => 'GS Ministration', 'speakers' => ''],
                ]),
            ],
            [
                'name' => 'MINISTERS CONFERENCE',
                'slug' => 'ministers-conference',
                'is_active' => true,
                'is_featured' => false,
                'image_location' => '/assets/img/event-img/zambia_banner.jpg',
                'event_type' => 'Global',
                'category' => 'MINISTERS CONFERENCE',
                'event_days' => '27,30,31',
                'event_month' => 'OCT',
                'event_date' => '27,30,31',
                'event_countdown' => NULL,
                'schedules' => json_encode([
                    ['time' => '05:30PM', 'event' => 'Prelude Activities/Instrumental', 'speakers' => ''],
                    ['time' => '05:50PM', 'event' => 'Opening Prayer', 'speakers' => ''],
                    ['time' => '05:55PM', 'event' => 'Congregation Song', 'speakers' => ''],
                    ['time' => '06:00PM', 'event' => 'Intercession for Total Emancipation', 'speakers' => ''],
                    ['time' => '06:10PM', 'event' => 'Announcements', 'speakers' => ''],
                    ['time' => '06:15PM', 'event' => 'Choir from Nations', 'speakers' => ''],
                    ['time' => '06:25PM', 'event' => 'Testimonies', 'speakers' => ''],
                    ['time' => '06:35PM', 'event' => 'Alpha Location Choir', 'speakers' => ''],
                    ['time' => '06:40PM', 'event' => 'Music Minister', 'speakers' => ''],
                    ['time' => '07:00PM', 'event' => 'GS Ministration', 'speakers' => ''],
                ]),
            ],
            [
                'name' => 'IMPACT ACADEMY',
                'slug' => 'impact-academy',
                'is_active' => true,
                'is_featured' => false,
                'image_location' => '/assets/img/event-img/asg.jpg',
                'event_type' => 'Global',
                'category' => 'IMPACT ACADEMY',
                'event_days' => '28',
                'event_month' => 'OCT',
                'event_date' => '28th',
                'event_countdown' => '2023/10/28 07:00:00',
                'schedules' => json_encode([
                    ['time' => '05:30PM', 'event' => 'Prelude Activities/Instrumental', 'speakers' => ''],
                    ['time' => '05:50PM', 'event' => 'Opening Prayer', 'speakers' => ''],
                    ['time' => '05:55PM', 'event' => 'Congregation Song', 'speakers' => ''],
                    ['time' => '06:00PM', 'event' => 'Intercession for Total Emancipation', 'speakers' => ''],
                    ['time' => '06:10PM', 'event' => 'Announcements', 'speakers' => ''],
                    ['time' => '06:15PM', 'event' => 'Choir from Nations', 'speakers' => ''],
                    ['time' => '06:25PM', 'event' => 'Testimonies', 'speakers' => ''],
                    ['time' => '06:35PM', 'event' => 'Alpha Location Choir', 'speakers' => ''],
                    ['time' => '06:40PM', 'event' => 'Music Minister', 'speakers' => ''],
                    ['time' => '07:00PM', 'event' => 'GS Ministration', 'speakers' => ''],
                ]),
            ],
        ]);
        Country::insert(
            [
                 [ 'name' => 'Afghanistan', 'continent_id'=> 3, 'iso2' => 'AF'], [ 'name' => 'Albania', 'continent_id'=> 5, 'iso2' => 'AL'], [ 'name' => 'Algeria', 'continent_id'=> 1, 'iso2' => 'DZ'], [ 'name' => 'Andorra', 'continent_id'=> 5, 'iso2' => 'AD'], [ 'name' => 'Angola', 'continent_id'=> 1, 'iso2' => 'AO'], [ 'name' => 'Antigua and Barbuda', 'continent_id'=> 6, 'iso2' => 'AG'], [ 'name' => 'Argentina', 'continent_id'=> 7, 'iso2' => 'AR'], [ 'name' => 'Armenia', 'continent_id'=> 3, 'iso2' => 'AM'], [ 'name' => 'Australia', 'continent_id'=> 4, 'iso2' => 'AU'], [ 'name' => 'Austria', 'continent_id'=> 5, 'iso2' => 'AT'], [ 'name' => 'Azerbaijan', 'continent_id'=> 3, 'iso2' => 'AZ'], [ 'name' => 'Bahamas', 'continent_id'=> 6, 'iso2' => 'BS'], [ 'name' => 'Bahrain', 'continent_id'=> 3, 'iso2' => 'BH'], [ 'name' => 'Bangladesh', 'continent_id'=> 3, 'iso2' => 'BD'], [ 'name' => 'Barbados', 'continent_id'=> 6, 'iso2' => 'BB'], [ 'name' => 'Belarus', 'continent_id'=> 5, 'iso2' => 'BY'], [ 'name' => 'Belgium', 'continent_id'=> 5, 'iso2' => 'BE'], [ 'name' => 'Belize', 'continent_id'=> 6, 'iso2' => 'BZ'], [ 'name' => 'Benin', 'continent_id'=> 1, 'iso2' => 'BJ'], [ 'name' => 'Bhutan', 'continent_id'=> 3, 'iso2' => 'BT'], [ 'name' => 'Bolivia', 'continent_id'=> 7, 'iso2' => 'BO'], [ 'name' => 'Bosnia and Herzegovina', 'continent_id'=> 5, 'iso2' => 'BA'], [ 'name' => 'Botswana', 'continent_id'=> 1, 'iso2' => 'BW'], [ 'name' => 'Brazil', 'continent_id'=> 7, 'iso2' => 'BR'], [ 'name' => 'Brunei', 'continent_id'=> 3, 'iso2' => 'BN'], [ 'name' => 'Bulgaria', 'continent_id'=> 5, 'iso2' => 'BG'], [ 'name' => 'Burkina Faso', 'continent_id'=> 1, 'iso2' => 'BF'], [ 'name' => 'Burundi', 'continent_id'=> 1, 'iso2' => 'BI'], [ 'name' => 'Cambodia', 'continent_id'=> 3, 'iso2' => 'KH'], [ 'name' => 'Cameroon', 'continent_id'=> 1, 'iso2' => 'CM'], [ 'name' => 'Canada', 'continent_id'=> 6, 'iso2' => 'CA'], [ 'name' => 'Cape Verde', 'continent_id'=> 1, 'iso2' => 'CV'], [ 'name' => 'Central African Republic', 'continent_id'=> 1, 'iso2' => 'CF'], [ 'name' => 'Chad', 'continent_id'=> 1, 'iso2' => 'TD'], [ 'name' => 'Chile', 'continent_id'=> 7, 'iso2' => 'CL'], [ 'name' => 'China', 'continent_id'=> 3, 'iso2' => 'CN'], [ 'name' => 'Colombia', 'continent_id'=> 7, 'iso2' => 'CO'], [ 'name' => 'Comoros', 'continent_id'=> 1, 'iso2' => 'KM'], [ 'name' => 'Congo (Brazzaville)', 'continent_id'=> 1, 'iso2' => 'CG'], [ 'name' => 'Congo (Kinshasa)', 'continent_id'=> 1, 'iso2' => 'CD'], [ 'name' => 'Costa Rica', 'continent_id'=> 6, 'iso2' => 'CR'], [ 'name' => 'Croatia', 'continent_id'=> 5, 'iso2' => 'HR'], [ 'name' => 'Cuba', 'continent_id'=> 6, 'iso2' => 'CU'], [ 'name' => 'Cyprus', 'continent_id'=> 5, 'iso2' => 'CY'], [ 'name' => 'Czechia', 'continent_id'=> 5, 'iso2' => 'CZ'], [ 'name' => 'Denmark', 'continent_id'=> 5, 'iso2' => 'DK'], [ 'name' => 'Djibouti', 'continent_id'=> 1, 'iso2' => 'DJ'], [ 'name' => 'Dominica', 'continent_id'=> 6, 'iso2' => 'DM'], [ 'name' => 'Dominican Republic', 'continent_id'=> 6, 'iso2' => 'DO'], [ 'name' => 'East Timor (Timor-Leste)', 'continent_id'=> 3, 'iso2' => 'TL'], [ 'name' => 'Ecuador', 'continent_id'=> 7, 'iso2' => 'EC'], [ 'name' => 'Egypt', 'continent_id'=> 1, 'iso2' => 'EG'], [ 'name' => 'El Salvador', 'continent_id'=> 6, 'iso2' => 'SV'], [ 'name' => 'Equatorial Guinea', 'continent_id'=> 1, 'iso2' => 'GQ'], [ 'name' => 'Eritrea', 'continent_id'=> 1, 'iso2' => 'ER'], [ 'name' => 'Estonia', 'continent_id'=> 5, 'iso2' => 'EE'], [ 'name' => 'Eswatini', 'continent_id'=> 1, 'iso2' => 'SZ'], [ 'name' => 'Ethiopia', 'continent_id'=> 1, 'iso2' => 'ET'], [ 'name' => 'Fiji', 'continent_id'=> 4, 'iso2' => 'FJ'], [ 'name' => 'Finland', 'continent_id'=> 5, 'iso2' => 'FI'], [ 'name' => 'France', 'continent_id'=> 5, 'iso2' => 'FR'], [ 'name' => 'Gabon', 'continent_id'=> 1, 'iso2' => 'GA'], [ 'name' => 'Gambia', 'continent_id'=> 1, 'iso2' => 'GM'], [ 'name' => 'Georgia', 'continent_id'=> 5, 'iso2' => 'GE'], [ 'name' => 'Germany', 'continent_id'=> 5, 'iso2' => 'DE'], [ 'name' => 'Ghana', 'continent_id'=> 1, 'iso2' => 'GH'], [ 'name' => 'Greece', 'continent_id'=> 5, 'iso2' => 'GR'], [ 'name' => 'Grenada', 'continent_id'=> 6, 'iso2' => 'GD'], [ 'name' => 'Guatemala', 'continent_id'=> 6, 'iso2' => 'GT'], [ 'name' => 'Guinea', 'continent_id'=> 1, 'iso2' => 'GN'], [ 'name' => 'Guinea-Bissau', 'continent_id'=> 1, 'iso2' => 'GW'], [ 'name' => 'Guyana', 'continent_id'=> 7, 'iso2' => 'GY'], [ 'name' => 'Haiti', 'continent_id'=> 6, 'iso2' => 'HT'], [ 'name' => 'Honduras', 'continent_id'=> 6, 'iso2' => 'HN'], [ 'name' => 'Hungary', 'continent_id'=> 5, 'iso2' => 'HU'], [ 'name' => 'Iceland', 'continent_id'=> 5, 'iso2' => 'IS'], [ 'name' => 'India', 'continent_id'=> 3, 'iso2' => 'IN'], [ 'name' => 'Indonesia', 'continent_id'=> 3, 'iso2' => 'ID'], [ 'name' => 'Iran', 'continent_id'=> 3, 'iso2' => 'IR'], [ 'name' => 'Iraq', 'continent_id'=> 3, 'iso2' => 'IQ'], [ 'name' => 'Ireland', 'continent_id'=> 5, 'iso2' => 'IE'], [ 'name' => 'Israel', 'continent_id'=> 3, 'iso2' => 'IL'], [ 'name' => 'Italy', 'continent_id'=> 5, 'iso2' => 'IT'], [ 'name' => 'Ivory Coast (Côte d\'Ivoire)', 'continent_id'=> 1, 'iso2' => 'CI'], [ 'name' => 'Jamaica', 'continent_id'=> 6, 'iso2' => 'JM'], [ 'name' => 'Japan', 'continent_id'=> 3, 'iso2' => 'JP'], [ 'name' => 'Jordan', 'continent_id'=> 3, 'iso2' => 'JO'], [ 'name' => 'Kazakhstan', 'continent_id'=> 3, 'iso2' => 'KZ'], [ 'name' => 'Kenya', 'continent_id'=> 1, 'iso2' => 'KE'], [ 'name' => 'Kiribati', 'continent_id'=> 4, 'iso2' => 'KI'], [ 'name' => 'Kosovo', 'continent_id'=> 5, 'iso2' => 'XK'], [ 'name' => 'Kuwait', 'continent_id'=> 3, 'iso2' => 'KW'], [ 'name' => 'Kyrgyzstan', 'continent_id'=> 3, 'iso2' => 'KG'], [ 'name' => 'Laos', 'continent_id'=> 3, 'iso2' => 'LA'], [ 'name' => 'Latvia', 'continent_id'=> 5, 'iso2' => 'LV'], [ 'name' => 'Lebanon', 'continent_id'=> 3, 'iso2' => 'LB'], [ 'name' => 'Lesotho', 'continent_id'=> 1, 'iso2' => 'LS'], [ 'name' => 'Liberia', 'continent_id'=> 1, 'iso2' => 'LR'], [ 'name' => 'Libya', 'continent_id'=> 1, 'iso2' => 'LY'], [ 'name' => 'Liechtenstein', 'continent_id'=> 5, 'iso2' => 'LI'], [ 'name' => 'Lithuania', 'continent_id'=> 5, 'iso2' => 'LT'], [ 'name' => 'Luxembourg', 'continent_id'=> 5, 'iso2' => 'LU'], [ 'name' => 'North Macedonia (Macedonia)', 'continent_id'=> 5, 'iso2' => 'MK'], [ 'name' => 'Madagascar', 'continent_id'=> 1, 'iso2' => 'MG'], [ 'name' => 'Malawi', 'continent_id'=> 1, 'iso2' => 'MW'], [ 'name' => 'Malaysia', 'continent_id'=> 3, 'iso2' => 'MY'], [ 'name' => 'Maldives', 'continent_id'=> 3, 'iso2' => 'MV'], [ 'name' => 'Mali', 'continent_id'=> 1, 'iso2' => 'ML'], [ 'name' => 'Malta', 'continent_id'=> 5, 'iso2' => 'MT'], [ 'name' => 'Marshall Islands', 'continent_id'=> 4, 'iso2' => 'MH'], [ 'name' => 'Mauritania', 'continent_id'=> 1, 'iso2' => 'MR'], [ 'name' => 'Mauritius', 'continent_id'=> 1, 'iso2' => 'MU'], [ 'name' => 'Mexico', 'continent_id'=> 6, 'iso2' => 'MX'], [ 'name' => 'Micronesia', 'continent_id'=> 4, 'iso2' => 'FM'], [ 'name' => 'Moldova', 'continent_id'=> 5, 'iso2' => 'MD'], [ 'name' => 'Monaco', 'continent_id'=> 5, 'iso2' => 'MC'], [ 'name' => 'Mongolia', 'continent_id'=> 3, 'iso2' => 'MN'], [ 'name' => 'Montenegro', 'continent_id'=> 5, 'iso2' => 'ME'], [ 'name' => 'Morocco', 'continent_id'=> 1, 'iso2' => 'MA'], [ 'name' => 'Mozambique', 'continent_id'=> 1, 'iso2' => 'MZ'], [ 'name' => 'Myanmar (Burma)', 'continent_id'=> 3, 'iso2' => 'MM'], [ 'name' => 'Namibia', 'continent_id'=> 1, 'iso2' => 'NA'], [ 'name' => 'Nauru', 'continent_id'=> 4, 'iso2' => 'NR'], [ 'name' => 'Nepal', 'continent_id'=> 3, 'iso2' => 'NP'], [ 'name' => 'Netherlands', 'continent_id'=> 5, 'iso2' => 'NL'], [ 'name' => 'New Zealand', 'continent_id'=> 4, 'iso2' => 'NZ'], [ 'name' => 'Nicaragua', 'continent_id'=> 6, 'iso2' => 'NI'], [ 'name' => 'Niger', 'continent_id'=> 1, 'iso2' => 'NE'], [ 'name' => 'Nigeria', 'continent_id'=> 1, 'iso2' => 'NG'], [ 'name' => 'North Korea (DPRK)', 'continent_id'=> 3, 'iso2' => 'KP'], [ 'name' => 'Norway', 'continent_id'=> 5, 'iso2' => 'NO'], [ 'name' => 'Oman', 'continent_id'=> 3, 'iso2' => 'OM'], [ 'name' => 'Pakistan', 'continent_id'=> 3, 'iso2' => 'PK'], [ 'name' => 'Palau', 'continent_id'=> 4, 'iso2' => 'PW'], [ 'name' => 'Palestine', 'continent_id'=> 3, 'iso2' => 'PS'], [ 'name' => 'Panama', 'continent_id'=> 6, 'iso2' => 'PA'], [ 'name' => 'Papua New Guinea', 'continent_id'=> 4, 'iso2' => 'PG'], [ 'name' => 'Paraguay', 'continent_id'=> 7, 'iso2' => 'PY'], [ 'name' => 'Peru', 'continent_id'=> 7, 'iso2' => 'PE'], [ 'name' => 'Philippines', 'continent_id'=> 3, 'iso2' => 'PH'], [ 'name' => 'Poland', 'continent_id'=> 5, 'iso2' => 'PL'], [ 'name' => 'Portugal', 'continent_id'=> 5, 'iso2' => 'PT'], [ 'name' => 'Qatar', 'continent_id'=> 3, 'iso2' => 'QA'], [ 'name' => 'Romania', 'continent_id'=> 5, 'iso2' => 'RO'], [ 'name' => 'Russia', 'continent_id'=> 5, 'iso2' => 'RU'], [ 'name' => 'Rwanda', 'continent_id'=> 1, 'iso2' => 'RW'], [ 'name' => 'Saint Kitts and Nevis', 'continent_id'=> 6, 'iso2' => 'KN'], [ 'name' => 'Saint Lucia', 'continent_id'=> 6, 'iso2' => 'LC'], [ 'name' => 'Saint Vincent and the Grenadines', 'continent_id'=> 6, 'iso2' => 'VC'], [ 'name' => 'Samoa', 'continent_id'=> 4, 'iso2' => 'WS'], [ 'name' => 'San Marino', 'continent_id'=> 5, 'iso2' => 'SM'], [ 'name' => 'Sao Tome and Principe', 'continent_id'=> 1, 'iso2' => 'ST'], [ 'name' => 'Saudi Arabia', 'continent_id'=> 3, 'iso2' => 'SA'], [ 'name' => 'Senegal', 'continent_id'=> 1, 'iso2' => 'SN'], [ 'name' => 'Serbia', 'continent_id'=> 5, 'iso2' => 'RS'], [ 'name' => 'Seychelles', 'continent_id'=> 1, 'iso2' => 'SC'], [ 'name' => 'Sierra Leone', 'continent_id'=> 1, 'iso2' => 'SL'], [ 'name' => 'Singapore', 'continent_id'=> 3, 'iso2' => 'SG'], [ 'name' => 'Slovakia', 'continent_id'=> 5, 'iso2' => 'SK'], [ 'name' => 'Slovenia', 'continent_id'=> 5, 'iso2' => 'SI'], [ 'name' => 'Solomon Islands', 'continent_id'=> 4, 'iso2' => 'SB'], [ 'name' => 'Somalia', 'continent_id'=> 1, 'iso2' => 'SO'], [ 'name' => 'South Africa', 'continent_id'=> 1, 'iso2' => 'ZA'], [ 'name' => 'South Korea (ROK)', 'continent_id'=> 3, 'iso2' => 'KR'], [ 'name' => 'South Sudan', 'continent_id'=> 1, 'iso2' => 'SS'], [ 'name' => 'Spain', 'continent_id'=> 5, 'iso2' => 'ES'], [ 'name' => 'Sri Lanka', 'continent_id'=> 3, 'iso2' => 'LK'], [ 'name' => 'Sudan', 'continent_id'=> 1, 'iso2' => 'SD'], [ 'name' => 'Suriname', 'continent_id'=> 7, 'iso2' => 'SR'], [ 'name' => 'Sweden', 'continent_id'=> 5, 'iso2' => 'SE'], [ 'name' => 'Switzerland', 'continent_id'=> 5, 'iso2' => 'CH'], [ 'name' => 'Syria', 'continent_id'=> 3, 'iso2' => 'SY'], [ 'name' => 'Taiwan', 'continent_id'=> 3, 'iso2' => 'TW'], [ 'name' => 'Tajikistan', 'continent_id'=> 3, 'iso2' => 'TJ'], [ 'name' => 'Tanzania', 'continent_id'=> 1, 'iso2' => 'TZ'], [ 'name' => 'Thailand', 'continent_id'=> 3, 'iso2' => 'TH'], [ 'name' => 'Togo', 'continent_id'=> 1, 'iso2' => 'TG'], [ 'name' => 'Tonga', 'continent_id'=> 4, 'iso2' => 'TO'], [ 'name' => 'Trinidad and Tobago', 'continent_id'=> 6, 'iso2' => 'TT'], [ 'name' => 'Tunisia', 'continent_id'=> 1, 'iso2' => 'TN'], [ 'name' => 'Turkey', 'continent_id'=> 5, 'iso2' => 'TR'], [ 'name' => 'Turkmenistan', 'continent_id'=> 3, 'iso2' => 'TM'], [ 'name' => 'Tuvalu', 'continent_id'=> 4, 'iso2' => 'TV'], [ 'name' => 'Uganda', 'continent_id'=> 1, 'iso2' => 'UG'], [ 'name' => 'Ukraine', 'continent_id'=> 5, 'iso2' => 'UA'], [ 'name' => 'United Arab Emirates', 'continent_id'=> 3, 'iso2' => 'AE'], [ 'name' => 'United Kingdom (UK)', 'continent_id'=> 5, 'iso2' => 'GB'], [ 'name' => 'United States (USA)', 'continent_id'=> 6, 'iso2' => 'US'], [ 'name' => 'Uruguay', 'continent_id'=> 7, 'iso2' => 'UY'], [ 'name' => 'Uzbekistan', 'continent_id'=> 3, 'iso2' => 'UZ'], [ 'name' => 'Vanuatu', 'continent_id'=> 4, 'iso2' => 'VU'], [ 'name' => 'Vatican City (Holy See)', 'continent_id'=> 5, 'iso2' => 'VA'], [ 'name' => 'Venezuela', 'continent_id'=> 7, 'iso2' => 'VE'], [ 'name' => 'Vietnam', 'continent_id'=> 3, 'iso2' => 'VN'], [ 'name' => 'Yemen', 'continent_id'=> 3, 'iso2' => 'YE'], [ 'name' => 'Zambia', 'continent_id'=> 1, 'iso2' => 'ZM'], [ 'name' => 'Zimbabwe', 'continent_id'=> 1, 'iso2' => 'ZW'],
            ]
        );

        // Dclmadminpassword
    }
}
