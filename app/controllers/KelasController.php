<?php

require_once BASE_PATH .
'/app/controllers/BaseController.php';

class KelasController extends BaseController
{
    public function index()
    {
        $this->view('kelas');
    }
}
?>