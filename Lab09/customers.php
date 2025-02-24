<?php
require_once("database.php");

class Customer extends DataMapper
{
    public $table = "customers";
    public $pk = "id";
    public $fields = ['name', 'city'];

}

$Customer = new Customer();
$data = $Customer->list();

var_dump($data);

echo "<br>";
$cake = $Customer->get(1);
var_dump($cake);