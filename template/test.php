<?php
$test = $_POST['test'];
foreach($test as $name){
    print_r($name.'<br>');
}