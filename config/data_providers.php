<?php

use App\Http\Controllers\API\Helpers;

return [
    Helpers::PROVIDER_X =>\App\Http\Abstraction\Classes\UserXClass::class,
    Helpers::PROVIDER_Y=>\App\Http\Abstraction\Classes\UserYClass::class,
//    Helpers::PROVIDER_Z=>\App\Http\Abstraction\Classes\UserZClass::class,
];
