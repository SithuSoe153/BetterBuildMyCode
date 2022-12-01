<?php

function Add($categoryid, $productid, $productquantity)
{
    $connect = mysqli_connect("localhost", "root", "", "posdb");

    $runid = " Select * from product p, item i Where p.productid = '$productid' And i.productid = '$productid'";
    $runquery = mysqli_query($connect, $runid);
    $data = mysqli_fetch_array($runquery);
    $itemid = $data['id'];

    $query = "SELECT * FROM product p, category c, item i WHERE p.productid='$productid' AND c.categoryid='$categoryid'";
    // $query = "SELECT * FROM product p, category c, item i WHERE p.productid='$productid' AND c.categoryid='$categoryid'"
    // SELECT p.productname FROM product p, category c WHERE p.productid=14 AND c.categoryid=8

    $query1 = "SELECT * FROM product p, item i ,raw r WHERE p.productid='$productid' AND i.productid = '$productid'";

    // last working $query1 = "SELECT * FROM product p, item i ,raw r WHERE p.productid='$productid' AND i.item_name = r.rawid";
    // SELECT i.productid, productname, item_name,item_quantity, item_name1, item_quantity1 FROM product p, item i WHERE p.productid= 14 AND i.productid = 14
    // SELECT productname,item_name,item_quantity,item_name1,item_quantity1 FROM product p, item i WHERE p.productid= 14 AND i.productid = p.productid
    // $query1 = "SELECT * FROM product p, item i ,raw r WHERE p.productid='$productid' AND i.productid='$productid'";

    // rawtype
    $query2 = "SELECT p.productname, i.item_name, r.rawtype, i.item_quantity, i.item_name1,r.rawtype, i.item_quantity1 FROM product p, item i ,raw r WHERE p.productid= '$productid' AND i.id = '$itemid' And i.item_name = r.rawid";

    // rawtype1
    $query3 = "SELECT p.productname, i.item_name, r.rawtype, i.item_quantity, i.item_name1,r.rawtype, i.item_quantity1 FROM product p, item i ,raw r WHERE p.productid= '$productid' AND i.id = '$itemid' And i.item_name1 = r.rawid";

    // $query = "SELECT * from product,category,item";

    $ret = mysqli_query($connect, $query);
    $ret1 = mysqli_query($connect, $query1);
    $ret2 = mysqli_query($connect, $query2);
    $ret3 = mysqli_query($connect, $query3);
    $count = mysqli_num_rows($ret);
    if ($count < 1) {
        echo "<p>NO Record Found.</p>";
        //exit();
    }

    $arr = mysqli_fetch_array($ret);
    $arr1 = mysqli_fetch_array($ret1);
    $arr2 = mysqli_fetch_array($ret2);
    $arr3 = mysqli_fetch_array($ret3);

    // $irawid = $arr2['item_name'];
    $item_name = $arr2['rawtype'];
    $item_quantity = $arr1['item_quantity'];
    // $irawid1 = $arr3['item_name1'];
    $item_name1 = $arr3['rawtype'];
    $item_quantity1 = $arr1['item_quantity1'];
    $categoryidd = $arr['categoryid'];
    $categoryname = $arr['categoryname'];
    $productname = $arr['productname'];
    $image1 = $arr['productprofile'];

    if (isset($_SESSION['productionfunction'])) {
        $index = IndexOf($productid);
        if ($index == -1) {
            $size = count($_SESSION['productionfunction']);

            $_SESSION['productionfunction'][$size]['productid'] = $productid;
            $_SESSION['productionfunction'][$size]['categoryid'] = $categoryidd;
            $_SESSION['productionfunction'][$size]['categoryname'] = $categoryname;
            $_SESSION['productionfunction'][$size]['productname'] = $productname;
            // $_SESSION['productionfunction'][$size]['item_name'] = $irawid;
            $_SESSION['productionfunction'][$size]['item_name'] = $item_name;
            // $_SESSION['productionfunction'][$size]['item_name'] = $irawid1;
            $_SESSION['productionfunction'][$size]['item_quantity'] = $item_quantity;
            $_SESSION['productionfunction'][$size]['item_name1'] = $item_name1;
            $_SESSION['productionfunction'][$size]['item_quantity1'] = $item_quantity1;
            $_SESSION['productionfunction'][$size]['productquantity'] = $productquantity;
            $_SESSION['productionfunction'][$size]['image1'] = $image1;
        } else {

            $_SESSION['productionfunction'][$index]['productquantity'] += $productquantity;
        }
    } else {
        $_SESSION['productionfunction'] = array();
        $_SESSION['productionfunction'][0]['productid'] = $productid;
        $_SESSION['productionfunction'][0]['categoryid'] = $categoryidd;
        $_SESSION['productionfunction'][0]['categoryname'] = $categoryname;
        $_SESSION['productionfunction'][0]['productname'] = $productname;
        // $_SESSION['productionfunction'][0]['item_name'] = $irawid;
        $_SESSION['productionfunction'][0]['item_name'] = $item_name;
        $_SESSION['productionfunction'][0]['item_quantity'] = $item_quantity;
        // $_SESSION['productionfunction'][0]['item_name'] = $irawid1;
        $_SESSION['productionfunction'][0]['item_name1'] = $item_name1;
        $_SESSION['productionfunction'][0]['item_quantity1'] = $item_quantity1;
        $_SESSION['productionfunction'][0]['productquantity'] = $productquantity;
        $_SESSION['productionfunction'][0]['image1'] = $image1;
    }
    echo "<script>window.location='production.php'</Script>";
}

function Remove($productid)
{
    $index = IndexOf($productid);
    if ($index != -1) {
        unset($_SESSION['productionfunction'][$index]);
        echo "<script>window.location='production.php'</script>";
    }
}


function IndexOf($productid)
{
    if (!isset($_SESSION['productionfunction'])) {
        return -1;
    }
    $size = count($_SESSION['productionfunction']);
    if ($size == 0) {
        return -1;
    }
    for ($i = 0; $i < $size; $i++) {
        if ($productid == $_SESSION['productionfunction'][$i]['productid']) {
            return $i;
        }
    }
    return -1;
}

function CalculateTotalQuantity()
{
    $Qty = 0;

    $size = count($_SESSION['productionfunction']);

    for ($i = 0; $i < $size; $i++) {
        $quantity = $_SESSION['productionfunction'][$i]['productquantity'];
        $Qty = $Qty + ($quantity);
    }
    return $Qty;
}
