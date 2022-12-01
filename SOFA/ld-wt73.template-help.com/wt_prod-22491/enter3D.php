<?php
include('connect.php');
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
    echo "<script>window.location='index.php'</script>";
    // echo "<script>window.location='enter3D.php'</script>";
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

            width: 800px;
            height: 480px;
            margin: 0, auto;
        }
    </style>


</head>

<body>
    <div class="box">
        <model-viewer src="<?php echo $product3D ?>" ios-src="<?php echo $productAR ?>" poster="images/cubeloader2.2.gif" camera-controls auto-rotate ar disable-zoom loading="eager">

            <a href="enter3D.php?productid=<?php echo $_REQUEST['productid'] ?>">

                <svg style="width:24px;height:24px;" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M17 4H20C21.1 4 22 4.9 22 6V8H20V6H17V4M4 8V6H7V4H4C2.9 4 2 4.9 2 6V8H4M20 16V18H17V20H20C21.1 20 22 19.1 22 18V16H20M7 18H4V16H2V18C2 19.1 2.9 20 4 20H7V18M16 10V14H8V10H16M18 8H6V16H18V8Z" />
                </svg>

            </a>

        </model-viewer>



    </div>
</body>

</html>