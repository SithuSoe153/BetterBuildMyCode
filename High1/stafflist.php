<?php
include('connect.php');
include('sheader.php');

?>

<form action="stafflist.php" method="POST" style="margin-top: 175px;">


    <div class=" main-wrapper">

        <div class="container">

            <?php

            $select = "SELECT * FROM staff";
            $query = mysqli_query($connection, $select);
            $count = mysqli_num_rows($query);

            if ($count > 0) {
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>Staff Id</th>";
                echo "<th>Staff Name</th>";
                echo "<th>Staff Email</th>";
                echo "<th>Password</th>";
                echo "<th>Phone Number</th>";
                echo "<th>Address</th>";
                echo "<th>Staff Profile</th>";
                echo "<th>Action</th>";
                echo "</tr>";

                for ($i = 0; $i < $count; $i++) {
                    $data = mysqli_fetch_array($query);
                    $staffid = $data['staffid'];
                    $staffname = $data['staffname'];
                    $staffemail = $data['staffemail'];
                    $password = $data['password'];
                    $phonenumber = $data['phonenumber'];
                    $address = $data['address'];
                    $staffprofile = $data['staffprofile'];


                    echo "<tr>";
                    echo "<td>$staffid</td>";
                    echo "<td>$staffname</td>";
                    echo "<td>$staffemail</td>";
                    echo "<td>$password</td>";
                    echo "<td>$phonenumber</td>";
                    echo "<td>$address</td>";
                    echo "<td>$staffprofile</td>";
                    echo "<td>
                    <a href='updatestaff.php?sid=$staffid'>	
                    Update
                    </a>

                    |

                    <a href='deletestaffraw.php?sid=$staffid'>
                    Delete
                    </a>
                    </td>";
                    echo "<tr>";
                }
                echo "</table>";
            }

            ?>

        </div>
    </div>
</form>

<?php

include('footer.php');
