<?php
include('connect.php');

if (isset($_POST['btnlogout'])) {
    include('LogOut.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Home</title>
    <style>
        .topnav {
            background-color: #333;
            overflow: hidden;
        }

        .topnav input {
            float: right;
            display: block;
            padding: 14px 15px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav input:hover {
            background-color: gray;
            color: white;
        }

        .topnav a {
            float: right;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #04AA6D;
            color: white;
        }

        /* _______________ */
        p {
            font-size: 30px;
        }
    </style>

</head>

<body>

    <form action="CustomerHome.php" method="POST">

        <div class="topnav">

            <input type="submit" name="btnlogout" value="Logout">
            <a href="updatecustomerraw.php"> Change Profile</a>
            <a href="customerchangepassword.php"> Change Password</a>

        </div>


        <fieldset>
            <legend>Product List:</legend>
            <table align="center" cellpadding="10px">
                <?php
                $query = "SELECT * FROM product ORDER BY productid DESC";
                $ret = mysqli_query($connection, $query);
                $count = mysqli_num_rows($ret);
                if ($count < 1) {
                    echo "<p>No Product Data Found.</p>";
                    exit();
                }
                for ($a = 0; $a < $count; $a += 3) {
                    $query1 = "SELECT * FROM product ORDER BY productid DESC LIMIT $a,3";
                    $ret1 = mysqli_query($connection, $query1);
                    $count1 = mysqli_num_rows($ret1);
                    echo "<tr>";
                    for ($b = 0; $b < $count1; $b++) {
                        $arr = mysqli_fetch_array($ret1);
                        $productid = $arr['productid'];
                        $productname = $arr['productname'];
                        $price = $arr['unitprice'];
                        $Image = $arr['productprofile'];

                ?>
                        <td>
                            <img src="<?php echo $Image ?>" width="200px" height="200px" /><br />
                            <b><?php echo $productname ?></b><br />
                            <b><?php echo $price ?></b>MMK<br />
                            <a href="productdetailraw.php?productid=<?php echo $productid ?>" style="color:red">Detail</a>
                        </td>
                <?php
                    }
                    echo "</tr>";
                }

                ?>
            </table>
        </fieldset>

    </form>

</body>

</html>