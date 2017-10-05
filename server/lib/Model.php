<?php
class Model
{
    private $dbh;
    public function __construct()
    {
        if (!$this->dbh = new \PDO('mysql:host='.HOST.';dbname='.DB, USER, PASSWORD))
        {
            throw new SoapFault('Server', 'Error DB');
        }
    }
    private function query( $sql,$data = [])
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($data);
        if (false === $result) {
            throw new SoapFault('Server', NO_CONNECT);
            die;
        }
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
    private function execute(string $sql, array $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($data);
        if (false === $result) {
            throw new SoapFault('Server', NO_CONNECT);
            die;
        }
        return true;
    }
}
