<?php

return [

    'providers' => [

        'DataProviderX' => [
            'class' => \App\Http\Abstraction\Classes\UserXClass::class,
            'file_name' => 'DataProviderX',
            'entry_key' => 'users',
        ],

        'DataProviderY' => [
            'class' => \App\Http\Abstraction\Classes\UserYClass::class,
            'file_name' => 'DataProviderY',
            'entry_key' => 'users',
        ],

//        'DataProviderZ' => [
//            'class' => \App\Http\Abstraction\Classes\UserZClass::class,
//            'file_name' => 'DataProviderZ',
//            'entry_key' => 'users',
//        ],

    ],
];
