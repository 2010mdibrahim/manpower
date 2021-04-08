<?php
include ('dbc.class.php');
class getConnectionController extends Dbc{
    public function getConnection(){
        $conn = $this->connection();
        return $conn;
    }
}