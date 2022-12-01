<?php
include('connect.php');

if (isset($_POST['btnregister'])) {
    $rawtype = $_POST['rawtype'];
    $rawdes = $_POST['rawdes'];
    $rawtp = $_POST['rawtp'];
    $rawqtyleft = $_POST['rawqtyleft'];

    //////////////////////////////////Image/////////////////////////////////

    $Image = $_FILES['rawprofile']['name'];
    $Folder = "images/";
    $filename = $Folder . '_' . $Image;
    $image = copy($_FILES['rawprofile']['tmp_name'], $filename);
    if (!$image) {
        echo "<p>Cannot Upload  Raw Profile</p>";
        exit();
    }

    /////////////////////////////////////////////////////////////////////////



    $select = "SELECT * FROM raw where rawtype='$rawtype'";
    $query1 = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query1);
    if ($count > 0) {
        echo "<script>alert('Duplicate Raw')</script>";
    } else {
        $insert = "INSERT INTO raw
        (rawtype,rawdes,rawtp,rawqtyleft,rawprofile)
        VALUES
        ('$rawtype','$rawdes','$rawtp','$rawqtyleft','$filename')";
        $query = mysqli_query($connection, $insert);
        if ($query) {
            echo "<script>alert('Raw Register Successful!')</script>";
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
    <title>Raw raw</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="rawraw.php" method="POST" enctype="multipart/form-data">

        <table id=" tableformat" align="center">

            <tr>
                <th colspan="2">
                    <h2>Raw Type</h2>
                </th>
            </tr>

            <tr>
                <td>Raw Type</td>
                <td>
                    <input type="name" name="rawtype" placeholder="Raw Type" data-error="Valid raw material is required." required="required">
                </td>
            </tr>

            <tr>
                <td>Raw Description</td>
                <td>
                    <input type="text" name="rawdes" placeholder="Raw Description" data-error="Valid Raw Material is required." required="required">
                </td>
            </tr>

            <tr>
                <td>Raw Total Price</td>
                <td>
                    <input type="number" name="rawtp" placeholder="Total Price" data-error="Valid Price is required." required="required">
                </td>
            </tr>

            <tr>
                <td>Raw qty left</td>
                <td>
                    <input type="text" name="rawqtyleft" placeholder="QTY Left" data-error="Valid Qty is required." required="required">
                </td>
            </tr>

            <tr>
                <td>Raw Profile</td>
                <td>
                    <input type="file" name="rawprofile">
                </td>
            </tr>

            <tr>
                <td align="left">
                    <button name="btnregister" type="submit">Register</button>
                </td>
                <td align="left">
                    <button name="btnreset" type="reset">Reset</button>
                </td>
            </tr>

        </table>

    </form>

</body>

</html>