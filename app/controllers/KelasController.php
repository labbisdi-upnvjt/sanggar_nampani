<?php

require_once BASE_PATH .
'/app/controllers/ApiController.php';

class KelasController extends ApiController
{
    public function index()
    {
        $this->view('kelas');
    }
}
?>