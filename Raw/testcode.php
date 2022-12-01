<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$connection = mysqli_connect('localhost', 'root', '', 'test');

$productid = 7;
$totalqty = 1;


$inser_production = "INSERT INTO production(id,qty)
VALUES('$productid','$totalqty')";
echo "<br>$inser_production<br>";

$ret = mysqli_query($connection, $inser_production);


$update_product = "Update product Set qty=qty+'$totalqty' where id='$productid'";
$ret = mysqli_query($connection, $update_product);

echo "<br>$update_product<br>";

// Select * from product p, item i where p.id = $productid AND i.id = $productid
// Select * from product p, item i, raw r where p.id = $productid AND i.id = $productid AND i.rid = r.id

// Select * from product p, item i, raw r where p.id = 5 AND i.id = 5 AND i.rid = r.id
// Update raw Set qty=qty-5 where id=

// Select * from product p, item i, raw r where p.id = 5 AND i.id = 5 AND i.rid = r.id;
// UPDATE raw r, item i SET r.qty = r.qty-5 WHERE i.rid=3 AND r.id=3;

// Select * from product p, itemdetail i, raw r where p.productid = 13 AND i.productid = 13 AND i.rawid = r.rawid

$item_show = "Select * from product p, item i, raw r where p.id = $productid AND i.id = $productid AND i.rid = r.id";
$ret = mysqli_query($connection, $item_show);

echo "<br>$item_show<br>";

// $totalamount = 0;

// $data = mysqli_fetch_array($ret);
// $item_raw = $data['rawqty'];
// $totalamount = $totalamount + ($item_raw * $totalqty);

$select = "UPDATE raw r, item i SET r.qty = r.qty-(i.rawqty*$totalqty) WHERE i.id=$productid AND i.rid=r.id";
$query = mysqli_query($connection, $select);

echo "<br>$select<br>";
