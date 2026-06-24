<?php

$routes = [

    'login' => [

        'view' => 'login.php',
        'auth' => false,
        'name' => 'login'

    ],

    'dashboard' => [

        'view' => 'pages/dashboard.php',
        'auth' => true,
        'name' => 'dashboard'

    ],

    'profil' => [

        'view' => 'pages/profil.php',
        'auth' => true,
        'name' => 'profil'

    ],

    'kelas' => [

        'view' => 'pages/kelas.php',
        'auth' => true,
        'name' => 'kelas'

    ],

    'homestay' => [

        'view' => 'pages/homestay.php',
        'auth' => true,
        'name' => 'homestay'

    ],

    'umkm' => [

        'view' => 'pages/umkm.php',
        'auth' => true,
        'name' => 'umkm'

    ],

    'pengaturan' => [

        'view' => 'pages/pengaturan.php',
        'auth' => true,
        'name' => 'pengaturan'

    ]

];
?>