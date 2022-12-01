<?php
include('connect.php');

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Raw</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="categoryraw.php" method="POST">

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

</body>

</html>