<?php
function Add($categoryid, $productid, $productquantity)
{
    $connect = mysqli_connect("localhost", "root", "", "posdb");
    $query = "SELECT * FROM product WHERE productid='$productid'";
    $query = "Select * from product p, itemdetail i, raw r, category c where p.productid = '$productid' AND i.productid = '$productid' AND i.rawid = r.rawid AND c.categoryid=i.categoryid";
    $ret = mysqli_query($connect, $query);
    $count = mysqli_num_rows($ret);
    if ($count < 1) {
        // echo "<p>No Record Found.</p>";
        echo "<script>window.alert('No Record Found !')</script>";
        echo "<script>window.location='production.php'</script>";
        exit();
    }
    $arr = mysqli_fetch_array($ret);

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
        $_SESSION['productionfunction'][0]['productquantity'] = $productquantity;
        $_SESSION['productionfunction'][0]['image1'] = $image1;
    }
    echo "<script>window.location='production.php'</script>";
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


function Remove($productid)
{
    $index = IndexOf($productid);
    if ($index != -1) {
        unset($_SESSION['productionfunction'][$index]);
        echo "<script>window.location='production.php'</script>";
    }
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
