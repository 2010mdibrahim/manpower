<?php
class Dbc{
    // this is a testing change
    private $server = 'localhost';
    private $user ='root';
    private $dbname='samin_erp';
    private $path = 'C:/xampp/htdocs/mahfuza/';
    private $password = '!@#$%databaseserveradmin2020';
    protected function connection(){
        if(file_exists($this->path)){
            $this->password = '!@#$%databaseserveradmin2020';
        }else{
            $this->password = '!@#$%databaseserveradmin2020';
        }

        $conn = mysqli_connect($this->server,$this->user,$this->password,$this->dbname);
        return $conn;
    }
}