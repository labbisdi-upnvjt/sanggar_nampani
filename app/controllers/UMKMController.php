<?php

require_once BASE_PATH .
'/app/controllers/BaseController.php';

class UMKMController extends BaseController
{
    public function index()
    {
        $this->view('umkm');
    }
}
?>