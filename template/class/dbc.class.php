<?php
class Dbc{
    private $server = 'localhost';
    private $user ='root';
    private $dbname='samin_erp';
    private $path = 'C:/xampp/htdocs/mahfuza/';
    private $password = '';

    public function __construct() {
        if(file_exists($this->path)){
            $this->password = '';
        }else{
            $this->password = '!@#$%databaseserveradmin2020';
        }
    }
    protected function connection(){        
        $conn = mysqli_connect($this->server,$this->user,$this->password,$this->dbname);
        return $conn;
    }
    protected function getServer()
    {
        return $this->server;
    }
    protected function getUser()
    {
        return $this->server;
    }
    protected function getDbName()
    {
        return $this->server;
    }
    protected function getPassword()
    {
        return $this->server;
    }
}