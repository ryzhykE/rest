<?php
include '../../lib/RestServer.php';
include '../../lib/Response.php';
class Cars extends RestServer
{
    public function __construct()
    {
        $this->run();
    }

    

    public function getCars($data = false, $params = false)
    {  
       
        $array = array(
                "marka" => "x5",
                "car" => "bmw",
                "color" => "red"
                );
        //var_dump($data);
        //var_dump($params);
        $res = Response::typeDatat($array,'.xml');
        //TODO: if data=false get all cars
        //if isset id - get detail cars by id
        print_r( $res);

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
