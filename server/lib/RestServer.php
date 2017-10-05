<?php
include_once ('config.php');
class RestServer
{
    protected $reqMethod;
    public $params;

    public function run()
    {
        list($s, $user, $REST, $server, $api, $class, $data) = explode("/", $_SERVER['REQUEST_URI'], 7);
        $this->reqMethod = $_SERVER['REQUEST_METHOD'];
        $expansion = (preg_match('#(\.[a-z]+)#', $_SERVER['REQUEST_URI'], $match)) ;
        if ($expansion[0] === 0)
        {
            $this->params = trim($data, '/'.JSON_TYPE);
        }
        else
        {
            $this->params = trim($data, '/'.$expansion);
        }

        switch ($this->reqMethod)
        {
            case 'GET':
              $this->setMethod('get'.ucfirst($class), explode('/', $this->cleanInputs($data)));
                break;
            case 'POST':
                $this->setMethod('post'.ucfirst($class), explode('/', $this->cleanInputs($data)));
                break;
            case 'PUT':
                $this->setMethod('put'.ucfirst($class), explode('/', $this->cleanInputs($data)));
                break;
            case 'DELETE':
                $this->setMethod('delete'.ucfirst($class), explode('/', $this->cleanInputs($data)));
                break;
            default:
                return false;
        }
    }

    public function setMethod($classMethod, $param=false)
    {
        if(method_exists($this, $classMethod))
        {
            echo $this->$classMethod($param);
        }
        else
        {
            echo 'ERROR!';
        }
    }

    private function cleanInputs($data) {
        $clean_input = Array();
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $clean_input[$k] = $this->cleanInputs($v);
            }
        } else {
            $clean_input = trim(strip_tags($data));
        }
        return $clean_input;
    }

}
