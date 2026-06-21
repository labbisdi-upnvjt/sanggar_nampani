<?php

class BaseController
{
    protected function view(
        string $page,
        array $data = []
    ) {
        // Membuat setiap key pada $data menjadi variabel
        extract($data);

        require BASE_PATH .
            '/app/views/layouts/header.php';

        require BASE_PATH .
            '/app/views/pages/' .
            $page .
            '.php';

        require BASE_PATH .
            '/app/views/layouts/footer.php';
    }
}