<?php

class RedirectingController
{
    public function whatsapp()
    {
        $target =
            $_GET['target'] ?? '';

        $links = [

            'homestay' =>
                'https://wa.me/628xxxx',

            'kelas' =>
                'https://wa.me/628xxxx',

            'umkm' =>
                'https://wa.me/628xxxx'

        ];

        if (!isset($links[$target])) {

            die('Link tidak ditemukan');
        }

        header(
            'Location: ' .
            $links[$target]
        );

        exit;
    }
}