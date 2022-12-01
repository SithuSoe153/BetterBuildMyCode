<?php

include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="search.php" method="POST">

        <td align="right" width="50%"><input type="text" name="txtSearch" placeholder="Search vehicle name"></td>
        <td aligh="right" width="10%"><input type="submit" name="btnSearch" value="Search"></td>


        <?php
        if (isset($_POST['btnSearch'])) {
            $VehicleName = $_POST['txtSearch'];
            echo $VehicleName;
            $query = "SELECT * FROM product WHERE productname LIKE '%$VehicleName%'";
            $result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                echo "<table class='car' align='center' width='65%'>";
                for ($i = 0; $i < $count; $i += 1) {
                    $query1 = "SELECT * FROM product 
                            WHERE productname LIKE '%$VehicleName%'
                            LIMIT $i,1";
                    $result1 = mysqli_query($connection, $query1);
                    $count1 = mysqli_num_rows($result1);
                    echo "<tr>";
                    for ($j = 0; $j < $count1; $j++) {
                        $arr = mysqli_fetch_array($result1);
                        echo "<td>";
                        // echo "<a href='VehicleDetail.php?PID=" . $arr['ProductCode'] . "'>";
                        echo "<img src='" . $arr['productprofile'] . "' width='450px'>";
                        echo "<br>";
                        echo "<br>";
                        echo "<b>" . $arr['productname'] . "</b>";
                        echo "<br>";
                        echo $arr['unitprice'] . " <b>MMK</b>";
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<h1><b><u>Search Record Not Found</u></b></h1>";
            }
        } else {

            $query = "SELECT * FROM product WHERE productname LIKE '%$VehicleName%'";
            $result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($result);





            if ($count > 0) {
                echo "<table class='car' align='center' width='70%'>";
                for ($i = 0; $i < $count; $i += 1) {
                    $query1 = "SELECT * FROM product ORDER BY productname
                            LIMIT $i,1";
                    $result1 = mysqli_query($connection, $query1);
                    $count1 = mysqli_num_rows($result1);
                    echo "<tr>";
                    for ($j = 0; $j < $count1; $j++) {
                        $arr = mysqli_fetch_array($result1);
                        // $productcode = $arr['ProductCode'];
                        $productimage = $arr['productprofile'];
                        $productname = $arr['productname'];
                        $price = $arr['unitprice'];
                        echo "<td>";
                        // echo "<a href='ProductDetail.php?PID=$productcode'>";
                        echo "<img src='$productimage' width='400px'>";
                        echo "<br>";
                        echo "<b>$productname</b></a>";
                        echo "<br>";
                        echo $price;
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
        ?>

    </form>
</body>

</html>