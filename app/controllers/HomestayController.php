<?php

require_once BASE_PATH .
'/app/controllers/ApiController.php';

class HomestayController extends ApiController
{
    public function index()
    {
        $this->view('homestay');
    }
}