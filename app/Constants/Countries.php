<?php
namespace App\Constants;
use Illuminate\Support\Str;

class Countries
{
    public const LIST = [
        0  => ['name' => 'United States',     'code' => 'US', 'slug' => 'united-states'],
        1  => ['name' => 'United Kingdom',    'code' => 'GB', 'slug' => 'united-kingdom'],
        2  => ['name' => 'Canada',            'code' => 'CA', 'slug' => 'canada'],
        3  => ['name' => 'Australia',         'code' => 'AU', 'slug' => 'australia'],
        4  => ['name' => 'Germany',           'code' => 'DE', 'slug' => 'germany'],
        5  => ['name' => 'France',            'code' => 'FR', 'slug' => 'france'],
        6  => ['name' => 'India',             'code' => 'IN', 'slug' => 'india'],
        7  => ['name' => 'Sri Lanka',         'code' => 'LK', 'slug' => 'sri-lanka'],
        8  => ['name' => 'Japan',             'code' => 'JP', 'slug' => 'japan'],
        9  => ['name' => 'China',             'code' => 'CN', 'slug' => 'china'],
        10 => ['name' => 'New Zealand',       'code' => 'NZ', 'slug' => 'new-zealand'],
        11 => ['name' => 'South Africa',      'code' => 'ZA', 'slug' => 'south-africa'],
        12 => ['name' => 'United Arab Emirates', 'code' => 'AE', 'slug' => 'uae'],
        13 => ['name' => 'Singapore',         'code' => 'SG', 'slug' => 'singapore'],
        14 => ['name' => 'Maldives',          'code' => 'MV', 'slug' => 'maldives'],
    ];

    public static function getCountryName($slug)
    {
        return self::LIST[$slug]['name'] ?? null;
    }

    public static function getCountryCode($slug)
    {
        return self::LIST[$slug]['code'] ?? null;
    }

    public static function getAllCountries()
    {
        return self::LIST;
    }
    public static function getCountrySlugs()
    {
        return array_keys(self::LIST);
    }
    public static function getCountrySlugsWithNames()
    {
        return array_map(function ($country) {
            return $country['name'];
        }, self::LIST);
    }
    public static function getCountrySlugsWithCodes()
    {
        return array_map(function ($country) {
            return $country['code'];
        }, self::LIST);
    }
}
