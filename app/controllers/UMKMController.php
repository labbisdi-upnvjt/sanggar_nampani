<?php

require_once BASE_PATH .
'/app/controllers/ApiController.php';

class UMKMController extends ApiController
{
    public function index()
    {
        $this->view('umkm');
    }
}
?>