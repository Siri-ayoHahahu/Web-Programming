<?php
require_once("database.php");

class Receipt extends DataMapper
{
    public $table = "receipt";
    public $pk = "receipt_id";
    public $fields = ['customer_id', 'menu_id'];

}

$Receipt = new Receipt();
$data = $Receipt->list();

var_dump($data);

echo "<br>";
$cake = $Receipt->get(1);
var_dump($cake);