<?php

require_once BASE_PATH .
'/app/controllers/ApiController.php';

class DashboardController extends ApiController
{
    public function index()
    {
        $this->view('dashboard');
    }
}
?>