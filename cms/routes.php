<?php

$routes = [

    'login' => [

        'view' => 'login.php',
        'auth' => false

    ],

    'dashboard' => [

        'view' => 'dashboard.php',
        'auth' => true

    ],

    'profil' => [

        'view' => 'profil.php',
        'auth' => true

    ],

    'kelas' => [

        'view' => 'kelas.php',
        'auth' => true

    ],

    'homestay' => [

        'view' => 'homestay.php',
        'auth' => true

    ],

    'umkm' => [

        'view' => 'umkm.php',
        'auth' => true

    ],

    'galeri' => [

        'view' => 'galeri.php',
        'auth' => true

    ],

    'pengaturan' => [

        'view' => 'pengaturan.php',
        'auth' => true

    ]

];
?>