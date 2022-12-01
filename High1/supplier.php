<?php
include('connect.php');
include('sheader.php');

if (isset($_POST['btnregister'])) {
    $suppliername = $_POST['suppliername'];
    $supplieraddress = $_POST['supplieraddress'];
    $supplierphone = $_POST['supplierphone'];
    $supplieremail = $_POST['supplieremail'];


    $select = "SELECT * FROM supplier where supplieremail='$supplieremail'";
    $query1 = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query1);
    if ($count > 0) {
        echo "<script>alert('Duplicate Supplier')</script>";
    } else {
        $insert = "INSERT INTO supplier
        (suppliername,supplieraddress,supplierphone,supplieremail)
        VALUES
        ('$suppliername','$supplieraddress','$supplierphone','$supplieremail')";
        $query = mysqli_query($connection, $insert);
        if ($query) {
            echo "<script>alert('Supplier Register Successful!')</script>";
        }
    }
}

?>

<form action="supplier.php" method="POST" style="margin-top: 161px;">

    <table id="tableformat" align="center">

        <tr>
            <th colspan="2">
                <h2>Supplier</h2>
            </th>
        </tr>

        <tr>
            <td>Supplier Name</td>
            <td>
                <input type="name" name="suppliername" placeholder="Supplier Name" data-error="Valid email is required." required="required">
            </td>
        </tr>

        <tr>
            <td>Supplier Address</td>
            <td>
                <textarea name="supplieraddress" placeholder="Address" cols="20" rows="7" data-error="Please,leave us a message." required="required"></textarea>
            </td>
        </tr>

        <tr>
            <td>Supplier Ph.no</td>
            <td>
                <input type="text" name="supplierphone" placeholder="Enter Phone Number" data-error="Valid phone number is required." required="required">
            </td>
        </tr>

        <tr>
            <td>Supplier Email</td>
            <td>
                <input type="email" name="supplieremail" placeholder="Supplier-Email" data-error="Valid email is required." required="required">
            </td>
        </tr>



        <td align="left">
            <button name="btnregister" type="submit">Register</button>
        </td>
        <td align="left">
            <button name="btnreset" type="reset">Reset</button>
        </td>
        </tr>

    </table>

</form>

<?php
include('footer.php');
