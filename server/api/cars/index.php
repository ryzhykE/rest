<?php
include '../../lib/RestServer.php';
class Cars extends RestServer
{
    public function __construct()
    {
        $this->run();
    }

    public function getCars($data = false)
    {
        //TODO: if data=false get all cars
        //if isset id - get detail cars by id
        return '<br>Hello! Params = 1';

    }

    public function postCars()
    {
        //TODO: add data to db
        return ' The Post method postCars'.$_POST['id'];
    }

    public function putCars($data = false)
    {
        $data = file_get_contents('php://input');
        return $data;
    }

    public function deleteCars($data = false)
    {
        return 'del'. $data[0];
    }
}
$cars = new Cars();
