<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



if (isset($_REQUEST['productid'])) {
    $productid = $_REQUEST['productid'];
    $query = "SELECT *
    FROM product
    WHERE productid='$productid'";

    $ret = mysqli_query($connection, $query);
    $arr = mysqli_fetch_array($ret);

    // $productid = $arr['productid'];
    // $productname = $arr['productname'];
    // $unitprice = $arr['unitprice'];
    // $quantity = $arr['unitquantity'];
    // $categoryname = $arr['categoryname'];
    // $image1 = $arr['productprofile'];

    $product3D =  $arr['3D'];
    $productAR =  $arr['AR'];
} else {
    echo "<script>window.location='CustomerHome.php'</script>";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="js/model-viewer.min.js"></script>
    <script src="js/webcomponents-loader.js"></script>
    <script src="js/fullscreen.polyfill.js"></script>
    <script src="js/focus-visible.js" defer></script>


    <title>Document</title>

    <style>
        .box {
            display: flex;
        }

        model-viewer {
            /* width: 800px;
            height: 600px;
            margin: 0, auto; */

            width: 400px;
            height: 400px;
            margin: 0, auto;
        }
    </style>


</head>

<body>
    <div class="box">
        <model-viewer src="<?php echo $product3D ?>" ios-src="<?php echo $productAR ?>" poster="images/loading_checkmark.gif" camera-controls auto-rotate ar disable-zoom loading="eager">
        </model-viewer>

    </div>
</body>

</html>