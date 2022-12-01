<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('connect.php');
include('sheader.php');
include('autoidfunction.php');
include('purchasefunction.php');

if (isset($_GET['btnsave'])) {
    $cboSupplierID = $_GET['cboSupplierID'];
    $StaffID = $_GET['cboStaffID'];
    $txtpurchaseid = $_GET['txtpurchaseid'];
    //$govtax=CalculateTax();
    $txtpurchasedate = $_GET['txtpurchasedate'];
    $TotalAmount = CalculateTotalAmount();
    $Totalquantity = CalculateTotalQuantity();
    $Status = "Pending";
    $insert_pur = "INSERT INTO purchase
	(purchaseid,purchasedate,supplierid,staffid,totalamount,totalquantity,purchasestatus)values
	('$txtpurchaseid','$txtpurchasedate','$cboSupplierID','$StaffID','$TotalAmount','$Totalquantity','$Status')";
    $ret = mysqli_query($connection, $insert_pur);

    $size = count($_SESSION['purchasefunction']);
    for ($i = 0; $i < $size; $i++) {
        $rawid = $_SESSION['purchasefunction'][$i]['rawid'];
        $rawtype = $_SESSION['purchasefunction'][$i]['rawtype'];
        $purchaseprice = $_SESSION['purchasefunction'][$i]['purchaseprice'];
        $purchasequantity = $_SESSION['purchasefunction'][$i]['purchasequantity'];

        $inser_PDetail = "INSERT INTO purchasedetail(purchaseid,rawid,rawtype,unitprice,unitquantity)
	VALUES('$txtpurchaseid','$rawid','$rawtype','$purchaseprice','$purchasequantity')";
        $ret = mysqli_query($connection, $inser_PDetail);

        $inser_PDetail = "Update raw Set rawqtyleft=rawqtyleft+'$purchasequantity' where rawid='$rawid'";
        $ret = mysqli_query($connection, $inser_PDetail);

        $inser_PDetail = "Update raw Set rawtp=rawtp+'$purchasequantity' where rawid='$rawid'";
        $ret = mysqli_query($connection, $inser_PDetail);
    }

    if ($ret) {
        //unset($_SESSION['purchasefunction']);
        echo "<script>window.alert('Purchase Process Complete.')</script>";
        echo "<script>window.location='purchase.php'</script>";
    } else {
        echo "<p>Something went wrong in purchase:" . mysqli_error($connection) . "</p>";
    }
}


if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action === 'add') {
        $rawid = $_GET['cborawtype'];
        $rawtype = $_GET['rawtype'];
        $purchaseprice = $_GET['txtpurchaseprice'];
        $purchasequantity = $_GET['txtpurchasequantity'];
        Add($rawid, $purchaseprice, $purchasequantity);
    } elseif ($action === 'remove') {
        $rawid = $_GET['rawid'];
        Remove($rawid);
    } elseif ($action === 'clearall') {
        //	ClearAll();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Purchase Raw</title>
</head>

<body>
    <form action="purchase.php" method="GET" style="margin-top: 161px;">
        <input type="hidden" name="action" value="add">
        <table>
            <tr>
                <td>Purchase ID</td>
                <td>
                    <input type="text" name="txtpurchaseid" value="<?php echo AutoID('purchase', 'purchaseid', 'PUR-', 6) ?>" readonly>
                </td>
            </tr>
            <tr>
                <td> Purchase Date</td>
                <td>
                    <input name="txtpurchasedate" type="text" value="<?php echo date('Y-m-d') ?>" readonly />
                </td>
            </tr>
            <tr>
                <td> Total Amount</td>
                <td>
                    <input name="txttotalamount" type="number" placeholder="0" />

                </td>
            </tr>

            <tr>
                <td> Total Quantity</td>
                <td>
                    <input name="txttotalquantity" type="number" placeholder="0" />

                </td>
            </tr>

            <tr>
                <td> Raw Material Name</td>
                <td>
                    <?php

                    $select = "SELECT * FROM raw";
                    $query = mysqli_query($connection, $select);
                    $count = mysqli_num_rows($query);

                    echo "<select name='cborawtype'>";
                    for ($i = 0; $i < $count; $i++) {
                        $data = mysqli_fetch_array($query);
                        $rawtype = $data['rawtype'];
                        $rawid = $data['rawid'];
                        echo "<option value='$rawid'>$rawtype</option>";
                    }
                    echo "</select>";
                    ?>

                </td>
            </tr>
            <tr>
                <td>Purchase Price</td>
                <td>
                    <input name="txtpurchaseprice" type="number" placeholder="0" />
                </td>
            </tr>

            <tr>
                <td> Purchase Quantity</td>
                <td>
                    <input name="txtpurchasequantity" type="number" placeholder="0" />
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
            <legend>Product List</legend>
            <?php
            if (!isset($_SESSION['purchasefunction'])) {
                echo "<p>No Purchase Record Found.</p>";
                exit();
            }
            ?>
            <table align="center" border="1" cellpadding="3px">
                <tr>
                    <th>Image</th>
                    <th>Raw ID</th>
                    <th>Raw Type</th>
                    <th>Purchase Price</th>
                    <th>Purchase Qty</th>
                    <th>Sub Total</th>
                    <th>Action</th>
                </tr>
                <?php
                $size = count($_SESSION['purchasefunction']);
                for ($i = 0; $i < $size; $i++) {
                    $image1 = $_SESSION['purchasefunction'][$i]['image1'];
                    $rawid = $_SESSION['purchasefunction'][$i]['rawid'];
                    $rawtype = $_SESSION['purchasefunction'][$i]['rawtype'];
                    $purchaseprice = $_SESSION['purchasefunction'][$i]['purchaseprice'];
                    $purchasequantity = $_SESSION['purchasefunction'][$i]['purchasequantity'];
                    $Subtotal = $purchaseprice * $purchasequantity;

                    echo "<tr>";
                    echo "<td><img src='$image1' width='100px' height='100px'/></td>";
                    echo "<td>$rawid</td>";
                    echo "<td>$rawtype</td>";
                    echo "<td>$purchaseprice MMK</td>";
                    echo "<td>$purchasequantity Pcs</td>";
                    echo "<td>$Subtotal MMK</td>";

                    echo "<td><a href='Purchase.php?action=remove&rawid=$rawid'>Remove</a><td>";

                    echo "</tr>";
                }
                ?>


                <tr>
                    <td>Supplier Name</td>
                    <td>
                        <select name="cboSupplierID">
                            <option>-----Select Supplier Name------</option>
                            <?php
                            $query = "Select * FROM supplier";
                            $ret = mysqli_query($connection, $query);
                            $count = mysqli_num_rows($ret);

                            for ($i = 0; $i < $count; $i++) {
                                $arr = mysqli_fetch_array($ret);
                                $SupplierID = $arr['supplierid'];
                                $suppliername = $arr['suppliername'];
                                echo "<option value='$SupplierID'>" . $suppliername . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
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