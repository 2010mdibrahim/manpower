<?php
class Dbc{
    private $server = 'localhost';
    private $user ='root';
    private $dbname='samin_erp';
    private $path = 'C:/xampp/htdocs/mahfuza/';
    private $password = '';
    protected function connection(){
        if(file_exists($this->path)){
            $this->password = '';
        }else{
            $this->password = '!@#$%databaseserveradmin2020';
        }
        $conn = mysqli_connect($this->server,$this->user,$this->password,$this->dbname);
        return $conn;
    }
}