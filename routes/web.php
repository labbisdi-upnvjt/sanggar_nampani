<?php

$routes = [

    'dashboard' => [
        'controller' => 'DashboardController',
        'method'     => 'index'
    ],

    'homestay' => [
        'controller' => 'HomestayController',
        'method'     => 'index'
    ],

    'kelas' => [
        'controller' => 'KelasController',
        'method'     => 'index'
    ],

    'umkm' => [
        'controller' => 'UMKMController',
        'method'     => 'index'
    ],

    'redirect' => [
        'controller' => 'RedirectingController',
        'method'     => 'whatsapp'
    ]

];