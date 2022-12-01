<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connect.php');
include('sheader.php');


if (isset($_POST['btnSearch'])) {
    $rdoSearchType = $_POST['rdoSearchType'];

    if ($rdoSearchType == 1) {
        $cboOrderID = $_POST['cboOrderID'];

        $Squery = "SELECT o.*,c.customerid,c.customername
					FROM orders o,customer c 
					WHERE o.customerid=c.customerid 
                    AND o.orderid='$cboOrderID'";
        $result = mysqli_query($connection, $Squery);
    } elseif ($rdoSearchType == 2) {
        $txtFrom = date('Y-m-d', strtotime($_POST['txtFrom']));
        $txtTo = date('Y-m-d', strtotime($_POST['txtTo']));

        $Squery = "SELECT o.*,c.customerid,c.customername
					FROM orders o,customer c 
					WHERE o.customerid=c.customerid
                    AND o.orderdate BETWEEN '$txtFrom' AND '$txtTo'";
        $result = mysqli_query($connection, $Squery);
    } else {
        $Squery = "SELECT o.*,c.customerid,c.customername
					FROM orders o,customer c 
					WHERE o.customerid=c.customerid";
        $result = mysqli_query($connection, $Squery);
    }
} elseif (isset($_POST['btnShowAll'])) {
    $Squery = "SELECT o.*,c.customerid,c.customername
					FROM orders o,customer c 
					WHERE o.customerid=c.customerid";
    $result = mysqli_query($connection, $Squery);
} else {
    $todayDate = date('Y-m-d');

    $Squery = "SELECT o.*,c.customerid,c.customername
					FROM orders o,customer c 
					WHERE o.customerid=c.customerid
                    AND o.orderdate='$todayDate'";
    $result = mysqli_query($connection, $Squery);
}
?>

<form action="orderreport.php" method="post" style="margin-top: 168px;">
    <fieldset>

        <table border="1" align="center">
            <tr>
                <td align="center" colspan="6">
                    <h1>Search:</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="rdoSearchType" value="1" checked />Search by Product Order
                    <br />
                    <select name="cboOrderID">
                        <option>Choose OrderID</option>
                        <?php
                        $query = "SELECT o.*,c.customerid,c.customername
					FROM orders o,customer c 
					WHERE o.customerid=c.customerid";
                        $ret = mysqli_query($connection, $query);
                        $count = mysqli_num_rows($ret);

                        for ($i = 0; $i < $count; $i++) {
                            $arr = mysqli_fetch_array($ret);
                            $orderid = $arr['orderid'];
                            $CustomerName = $arr['CustomerName'];

                            echo "<option value='$orderid'>" . $orderid . $CustomerName . "</option>";
                        }

                        ?>
                    </select>
                </td>

                <td>
                    <input type="radio" name="rdoSearchType" value="2" />Search by Date
                    <br />
                    From:<input type="date" name="txtFrom" value="<?php echo date('Y-m-d') ?>" />
                    To :<input class="form-control valid" type="date" name="txtTo" value="<?php echo date('Y-m-d') ?>" />
                </td>

                <td>
                    <br />
                    <input type="submit" name="btnSearch" value="Search" />
                    <input type="submit" name="btnShowAll" value="Show All" />
                    <input type="reset" value="Clear" />
                </td>

            </tr>
        </table>
    </fieldset>

    <fieldset>
        <legend>Search Results :</legend>
        <?php
        $count = mysqli_num_rows($result);

        if ($count == 0) {
            echo "<p>No Order Record Found.</p>";
            //exit();
        }
        ?>
        <table id="tableid" class="display" align="center" border="1px">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>customer Name</th>
                    <th>TotalAmount</th>
                    <th>TotalQuantity</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < $count; $i++) {
                    $arr = mysqli_fetch_array($result);
                    $OrderID = $arr['orderid'];
                    $CustomerName = $arr['customername'];

                    echo "<tr>";
                    echo "<td>$OrderID</td>";
                    echo "<td>" . $arr['orderdate'] . "</td>";
                    echo "<td>" . $CustomerName .  "</td>";
                    echo "<td>" . $arr['totalamount'] . "</td>";
                    echo "<td>" . $arr['totalquantity'] . "</td>";
                    echo "<td>" . $arr['orderstatus'] . "</td>";
                    echo "<td> 

		<a href='orderdetail.php?pid=$OrderID' style='color:red'>Detail</a> |
		<a href='orderaccept.php?pid=$OrderID' style='color:red'>Accept</a> |

        </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </fieldset>
</form>

<?php
include('footer.php');
