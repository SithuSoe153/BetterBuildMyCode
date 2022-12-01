<?php
include('connect.php');
include('sheader.php');

if (isset($_POST['btnregister'])) {
    $categoryname = $_POST['categoryname'];

    $select = "SELECT * FROM category where categoryname ='$categoryname'";
    $query1 = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query1);
    if ($count > 0) {
        echo "<script>alert('Duplicate Category Name')</script>";
    } else {
        $insert = "INSERT INTO category
        (categoryname)
        VALUES
        ('$categoryname')";
        $query = mysqli_query($connection, $insert);
        if ($query) {
            echo "<script>alert('Category Save Successful!')</script>";
        }
    }
}

?>

<form action="category.php" method="POST" style="margin-top: 161px;">

    <table id="tableformat" align="center">

        <tr>
            <th colspan="2">
                <h2>Category</h2>
            </th>
        </tr>



        <tr>
            <td>Category</td>
            <td>
                <input type="name" name="categoryname" placeholder="Category Name" data-error="Valid category is required." required="required">
            </td>
        </tr>

        <tr>
            <td align="left">
                <button name="btnregister" class="main-btn" type="submit">Register</button>
            </td>
            <td align="left">
                <button name="btnreset" class="main-btn" type="reset">Reset</button>
            </td>
        </tr>

    </table>

</form>

<?php
include('footer.php');
