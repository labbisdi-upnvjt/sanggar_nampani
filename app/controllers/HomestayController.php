<?php

require_once BASE_PATH .
'/app/controllers/BaseController.php';

class HomestayController extends BaseController
{
    public function index()
    {
        $this->view('homestay');
    }
}
?>