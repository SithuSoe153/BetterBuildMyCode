<?php
include('connect.php');
include('sheader.php');
// include('slider.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_POST['btnrecord'])) {
    $productname = $_POST['productname'];
    $categoryid = $_POST['categoryid'];
    $unitprice = $_POST['unitprice'];
    $unitquantity = $_POST['unitquantity'];
    $productdescription = $_POST['productdescription'];

    //////////////////////////////////Image/////////////////////////////////

    $Image = $_FILES['productprofile']['name'];
    $Folder = "images/";
    $filename = $Folder . '_' . $Image;
    $image = copy($_FILES['productprofile']['tmp_name'], $filename);
    if (!$image) {
        echo "<p>Cannot Upload  Product Profile</p>";
        exit();
    }

    /////////////////////////////////////////////////////////////////////////


    $select = "SELECT * FROM product where productname='$productname'";
    $query1 = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query1);
    if ($count > 0) {
        echo "<script>alert('Duplicate Product')</script>";
    } else {
        $insert = "INSERT INTO product
        (productname,unitprice,unitquantity,productdescription,categoryid,productprofile)
        VALUES
        ('$productname','$unitprice','$unitquantity','$productdescription','$categoryid','$filename')";
        $query = mysqli_query($connection, $insert);
        if ($query) {
            echo "<script>alert('Product Register Successful!')</script>";
        }
    }
}

?>

<form action="product.php" method="POST" enctype="multipart/form-data" style="margin-top: 161px;">

    <table id="tableformat" align="center">

        <tr>
            <th colspan="2">
                <h2>Product Register</h2>
            </th>
        </tr>


        <tr>
            <td>Product Name</td>
            <td>
                <input type="text" name="productname" placeholder="Enter Product Name" data-error="Valid staff name is required." required="required">
            </td>
        </tr>

        <tr>
            <td>Category Name</td>
            <td>
                <?php

                $select = "SELECT * FROM category";
                $query = mysqli_query($connection, $select);
                $count = mysqli_num_rows($query);

                echo "<select name='categoryid'>";
                for ($i = 0; $i < $count; $i++) {
                    $data = mysqli_fetch_array($query);
                    $categoryid = $data['categoryid'];
                    $categoryname = $data['categoryname'];

                    echo "<option value='$categoryid'>$categoryname</option>";
                }
                echo "</select>";
                ?>
            </td>
        </tr>
        <tr>
            <td>Description</td>
            <td>
                <textarea name="productdescription" id="" cols="30" rows="5"></textarea>

            </td>
        </tr>

        <tr>
            <td>Unit Price</td>
            <td>
                <input type="number" name="unitprice" placeholder="Enter Unit Price" data-error="Valid staff name is required." required="required">
            </td>
        </tr>



        <tr>
            <td>Unit Quantity</td>
            <td>
                <input type="number" name="unitquantity" placeholder="Unit Quantity" data-error="Valid email is required." required="required">
            </td>
        </tr>

        <tr>
            <td>Product Profile</td>
            <td>
                <input type="file" name="productprofile">
            </td>
        </tr>

        <tr>
            <td align="left">
                <button name="btnrecord" type="submit">Record</button>
            </td>
            <td align="left">
                <button name="btnreset" type="reset">Reset</button>
            </td>
        </tr>

    </table>

</form>

<?php
include('footer.php');
