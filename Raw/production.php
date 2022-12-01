<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('connect.php');
include('autoidfunction.php');
include('productionfunction.php');

// look here
if (isset($_GET['btnsave'])) {
    $StaffID = $_GET['cboStaffID'];
    $txtproductionid = $_GET['txtproductionid'];
    //$govtax=CalculateTax();
    $txtproductiondate = $_GET['txtproductiondate'];
    $productid = $_GET['cboproduct']; // productid from cbo
    $categoryid = $_GET['cbocategory']; // categoryid from cbo

    $Totalquantity = CalculateTotalQuantity();
    $Status = "Pending";

    $insert_pro = "INSERT INTO production
	(productionid,productiondate,staffid,totalquantity,productionstatus)values
	('$txtproductionid','$txtproductiondate','$StaffID','$Totalquantity','$Status')";

    $ret = mysqli_query($connection, $insert_pro);
    // echo $ret;

    $size = count($_SESSION['productionfunction']);
    for ($i = 0; $i < $size; $i++) {
        $productid = $_SESSION['productionfunction'][$i]['productid'];
        $categoryidd = $_SESSION['productionfunction'][$i]['categoryid'];
        $productquantity =  $_SESSION['productionfunction'][$i]['productquantity'];

        $inser_PRODetail = "INSERT INTO productiondetail(productionid,categoryid,productid,totalquantity)
	VALUES('$txtproductionid','$categoryidd','$productid','$productquantity')";
        $ret = mysqli_query($connection, $inser_PRODetail);
        // echo $ret;
        $inser_PRODetail = "Update product Set unitquantity=unitquantity+'$productquantity' where productid='$productid'";
        $ret = mysqli_query($connection, $inser_PRODetail);
        // echo $ret;
        $inser_PRODetail = "Update  raw r, itemdetail i  Set rawqtyleft=rawqtyleft- (i.rawqty*'$productquantity') WHERE  i.productid='$productid' AND i.rawid=r.rawid";
        $ret = mysqli_query($connection, $inser_PRODetail);
        echo $inser_PRODetail;
        echo $ret;
    }

    if ($ret) {
        //unset($_SESSION['productionfunction']);
        echo "<script>window.alert('Production Process Complete.')</script>";
        echo "<script>window.location='production.php'</script>";
    } else {
        echo "<p>Something went wrong in production process:" . mysqli_error($connection) . "</p>";
    }
}


if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action === 'add') {

        $categoryid = $_GET['cbocategory'];
        $productid = $_GET['cboproduct'];
        $productquantity = $_GET['txtproductquantity'];

        Add($categoryid, $productid, $productquantity);
    } elseif ($action === 'remove') {
        $productid = $_GET['productid'];
        Remove($productid);
    } elseif ($action === 'clearall') {
        //	ClearAll();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Production Raw</title>
</head>

<body>
    <form action="production.php" method="GET">
        <input type="hidden" name="action" value="add">
        <table>
            <tr>
                <td>Production ID</td>
                <td>
                    <input type="text" name="txtproductionid" value="<?php echo AutoID('production', 'productionid', 'PRO-', 6) ?>" readonly>
                </td>
            </tr>
            <tr>
                <td> Production Date</td>
                <td>
                    <input name="txtproductiondate" type="text" value="<?php echo date('Y-m-d') ?>" readonly />
                </td>
            </tr>



            <tr>
                <td> Category </td>
                <td>
                    <?php

                    $select = "SELECT * FROM category";
                    $query = mysqli_query($connection, $select);
                    $count = mysqli_num_rows($query);

                    echo "<select name='cbocategory'>";
                    echo "<option value=''>---Select---</option>";
                    for ($i = 0; $i < $count; $i++) {
                        $data = mysqli_fetch_array($query);
                        $categoryname = $data['categoryname'];
                        $categoryid = $data['categoryid'];
                        echo "<option value='$categoryid'>$categoryname</option>";
                    }
                    echo "</select>";
                    ?>

                </td>
            </tr>

            <tr>
                <td> Product </td>
                <td>
                    <?php

                    $select = "SELECT * FROM product";
                    $query = mysqli_query($connection, $select);
                    $count = mysqli_num_rows($query);

                    echo "<select name='cboproduct'>";
                    echo "<option value=''>---Select---</option>";
                    for ($i = 0; $i < $count; $i++) {
                        $data = mysqli_fetch_array($query);
                        $productname = $data['productname'];
                        $productid = $data['productid'];
                        echo "<option value='$productid'>$productname</option>";
                    }
                    echo "</select>";
                    ?>

                </td>
            </tr>


            <tr>
                <td> Product Quantity</td>
                <td>
                    <input name="txtproductquantity" type="number" placeholder="0" />
                </td>
            </tr>
            <tr>
                <td> </td>
                <td>
                    <input type="submit" name="btnAdd" value="Add">
                </td>
            </tr>
        </table>

        <fieldset>
            <legend>Item List</legend>
            <?php
            if (!isset($_SESSION['productionfunction'])) {
                echo "<p>No Item Record Found.</p>";
                exit();
            }
            ?>
            <table align="center" border="1" cellpadding="3px">
                <tr>
                    <th>Image</th>
                    <th>Category Name</th>
                    <th>Product Name</th>
                    <th>Purchase Qty</th>

                    <th>Action</th>
                </tr>

                <!-- look here -->
                <?php
                $size = count($_SESSION['productionfunction']);
                for ($i = 0; $i < $size; $i++) {
                    $image1 = $_SESSION['productionfunction'][$i]['image1'];
                    $categoryname = $_SESSION['productionfunction'][$i]['categoryname'];
                    $productname = $_SESSION['productionfunction'][$i]['productname'];
                    $productquantity = $_SESSION['productionfunction'][$i]['productquantity'];

                    echo "<tr>";
                    echo "<td><img src='$image1' width='100px' height='100px'/></td>";
                    echo "<td>$categoryname</td>";
                    echo "<td>$productname</td>";
                    echo "<td>$productquantity Pcs</td>";

                    echo "<td><a href='production.php?action=remove&productid=$productid'>Remove</a><td>";
                    echo "</tr>";
                }
                ?>



                <tr>
                    <td>Staff Name</td>
                    <td>
                        <select name="cboStaffID">
                            <option>-----Select Staff Name------</option>
                            <?php
                            $query = "Select * FROM staff";
                            $ret = mysqli_query($connection, $query);
                            $count = mysqli_num_rows($ret);

                            for ($i = 0; $i < $count; $i++) {
                                $arr = mysqli_fetch_array($ret);
                                $StaffID = $arr['staffid'];
                                $staffname = $arr['staffname'];
                                echo "<option value='$StaffID'>" . $staffname . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="submit" name="btnsave" value="Save">
                    </td>
                </tr>

            </table>
        </fieldset>

    </form>
</body>

</html>