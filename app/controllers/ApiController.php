<?php

class ApiController
{
    protected function view(
        string $page,
        array $data = []
    ) {
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
?>