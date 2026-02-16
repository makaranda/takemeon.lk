<?php
namespace App\Constants;

class ProgramCategories
{

    public const CATEGORIES = [
        0 => [
            'name' => 'University Programs',
            'sub_category' => [
                [
                    'country' => 'Maldives',
                    'list' => ['Faculty of Psychology', 'Faculty of Education', 'Faculty of Business']
                ]
            ]
        ],
        1 => [
            'name' => 'Ofqual - UK Regulated Programs',
            'sub_category' => [
                [
                    'country' => 'UK',
                    'list' => ['QUALIFI']
                ]
            ]
        ],
        2 => [
            'name' => 'Others',
            'sub_category' => [
                [
                    'country' => 'UK',
                    'list' => ['CPD - UK']
                ]
            ]
        ],
    ];

}
?>
