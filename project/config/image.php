<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd' ,

    //index sizes

    'index_image_sizes' => [

        'large' => [

            'width'=>800,
            'height'=>600
        ],

        'medium' => [

            'width' => 400,
            'height' =>300
        ],

        'small' => [

            'width' => 80,
            'height' =>60
        ]
    ],

    'default_current_index_image' => 'medium',

    // cache sizes

    'cache_image_sizes' => [

        'large' => [

            'width'=>800,
            'height'=>600
        ],

        'medium' => [

            'width' => 400,
            'height' =>300
        ],

        'small' => [

            'width' => 80,
            'height' =>60
        ]
    ],

    'default_current_cache_image' => 'medium',
    'image-cache-life-time' => 10,
    'image_not_found' => ''

];
