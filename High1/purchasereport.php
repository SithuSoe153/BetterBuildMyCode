<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('sheader.php');

include('connect.php');

if (isset($_POST['btnSearch'])) {
    $rdoSearchType = $_POST['rdoSearchType'];

    if ($rdoSearchType == 1) {
        $cboPurchaseID = $_POST['cboPurchaseID'];

        $Squery = "SELECT p.*,s.supplierid,s.suppliername
					FROM purchase p,supplier s 
					WHERE p.supplierid=s.supplierid
					AND p.PurchaseID='$cboPurchaseID'";
        $result = mysqli_query($connection, $Squery);
    } elseif ($rdoSearchType == 2) {
        $txtFrom = date('Y-m-d', strtotime($_POST['txtFrom']));
        $txtTo = date('Y-m-d', strtotime($_POST['txtTo']));

        $Squery = "SELECT p.*,s.supplierid,s.suppliername
				FROM purchase p,supplier s 
				WHERE p.PurchaseDate BETWEEN '$txtFrom' AND '$txtTo'
				AND p.supplierid=s.supplierid";
        $result = mysqli_query($connection, $Squery);
    } else {
        $Squery = "SELECT p.*,s.supplierid,s.suppliername
				FROM purchase p,supplier s 
				WHERE p.supplierid=s.supplierid";
        $result = mysqli_query($connection, $Squery);
    }
} elseif (isset($_POST['btnShowAll'])) {
    $Squery = "SELECT p.*,s.supplierid,s.suppliername
			FROM purchase p,supplier s 
			WHERE p.supplierid=s.supplierid";
    $result = mysqli_query($connection, $Squery);
} else {
    $todayDate = date('Y-m-d');

    $Squery = "SELECT p.*,s.supplierid,s.suppliername
				FROM purchase p,supplier s 
				WHERE p.purchasedate='$todayDate'
				AND p.supplierid=s.supplierid";
    $result = mysqli_query($connection, $Squery);
}
?>


<form action="purchasereport.php" method="post">
    <fieldset>

        <table border="1" align="center">
            <tr>
                <td align="center" colspan="6">
                    <h1>Search:</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="rdoSearchType" value="1" checked />Search by Purchase
                    <br />
                    <select name="cboPurchaseID">
                        <option>Choose PurchaseID</option>
                        <?php
                        $query = "SELECT p.*,s.supplierid,s.suppliername
					FROM purchase p,supplier s 
					WHERE p.supplierid=s.supplierid";
                        $ret = mysqli_query($connection, $query);
                        $count = mysqli_num_rows($ret);

                        for ($i = 0; $i < $count; $i++) {
                            $arr = mysqli_fetch_array($ret);
                            $PurchaseID = $arr['purchaseid'];
                            $SupplierName = $arr['suppliername'];

                            echo "<option value='$PurchaseID'>" . $PurchaseID . $SupplierName . "</option>";
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
            echo "<p>No Purchase Record Found.</p>";
            exit();
        }
        ?>
        <table id="tableid" class="display" align="center" border="1px">
            <thead>
                <tr>
                    <th>PurchaseID</th>
                    <th>Purchase Date</th>
                    <th>Supplier Name</th>
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
                    $purchaseid = $arr['purchaseid'];
                    $suppliername = $arr['suppliername'];

                    echo "<tr>";
                    echo "<td>$purchaseid</td>";
                    echo "<td>" . $arr['purchasedate'] . "</td>";
                    echo "<td>" . $suppliername .  "</td>";
                    echo "<td>" . $arr['totalamount'] . "</td>";
                    echo "<td>" . $arr['totalquantity'] . "</td>";
                    echo "<td>" . $arr['purchasestatus'] . "</td>";
                    echo "<td> 

		<a href='purchasedetail.php?pid=$purchaseid' style='color:red'>Detail</a> |
		<a href='purchaseaccept.php?pid=$purchaseid' style='color:red'>Accept</a> |

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
