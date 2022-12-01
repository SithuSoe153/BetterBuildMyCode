<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connect.php');

if (isset($_POST['btnregister'])) {
    $staffid = $_POST['staffid'];
    $messagedate = $_POST['messagedate'];
    $message_title = $_POST['message_title'];
    $messagedescription = $_POST['messagedescription'];
    $message_status = 0;

    $select = "SELECT * FROM message m, staff s WHERE s.staffid = '$staffid' AND m.staffid = '$staffid'";
    $query = mysqli_query($connection, $select);
    $count = mysqli_num_rows($query);


    $insert = "INSERT INTO message
    (staffid,messagedate,message_title,messagedescription,message_status) 
    VALUES
    ('$staffid','$messagedate','$message_title','$messagedescription','$message_status')";
    $query = mysqli_query($connection, $insert);
    if ($query) {
        echo "<script>alert('Staff message Successfully')</script>";
    }
}
$select = "SELECT * FROM message, staff";
$query = mysqli_query($connection, $select);
$data = mysqli_fetch_array($query);
$staffidd = $data['staffid']

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .navbar {
            overflow: hidden;
            background-color: #333;
        }

        .navbar a {
            float: left;
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .dropdown {
            float: left;
            overflow: hidden;
        }

        .dropdown .dropbtn {
            font-size: 16px;
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }

        .navbar a:hover,
        .dropdown:hover .dropbtn {
            background-color: red;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>

<body>

    <form action="dropdown.php" method="POST" enctype="multipart/form-data">

        <div class="navbar">
            <a href="#home">Home</a>
            <a href="#news">News</a>
            <div class="dropdown">
                <button class="dropbtn">Dropdown
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <?php
                    // code reference .... https://www.webslesson.info/2016/03/facebook-style-time-ago-function-using-php.html
                    // SELECT * FROM message m, staff s WHERE s.staffid = 46 AND m.staffid = 46
                    $select = "SELECT * FROM message m, staff s Where s.staffid = m.staffid ";
                    $query = mysqli_query($connection, $select);
                    $count = mysqli_num_rows($query);



                    for ($i = 0; $i < $count; $i++) {
                        $data = mysqli_fetch_array($query);
                        $staffname = $data['staffname'];
                        // echo time_elapsed_string('2013-05-01 00:22:35');
                        $messagedate = $data['messagedate'];


                        $messagedescription = $data['messagedescription'];

                    ?>
                        <a href='#'> <?php echo time_elapsed_string($messagedate) ?> <br> <?php echo $staffname ?> <p></p> <?php echo $messagedescription ?> </a>
                        <hr>
                    <?php
                    }


                    function time_elapsed_string($datetime, $full = false)
                    {
                        $now = new DateTime;
                        $ago = new DateTime($datetime);
                        $diff = $now->diff($ago);

                        $diff->w = floor($diff->d / 7);
                        $diff->d -= $diff->w * 7;

                        $string = array(
                            'y' => 'year',
                            'm' => 'month',
                            'w' => 'week',
                            'd' => 'day',
                            'h' => 'hour',
                            'i' => 'minute',
                            's' => 'second',
                        );
                        foreach ($string as $k => &$v) {
                            if ($diff->$k) {
                                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                            } else {
                                unset($string[$k]);
                            }
                        }

                        if (!$full) $string = array_slice($string, 0, 1);
                        return $string ? implode(', ', $string) . ' ago' : 'just now';
                    }

                    ?>
                </div>

            </div>
        </div>

        <input type="text" name="staffid" required placeholder="Enter Staff id">
        <input name="messagedate" type="text" value="<?php echo date('Y-m-d H:i:s') ?>" readonly />
        <input type="text" name="message_title" required placeholder="Message Title">
        <input type="text" name="messagedescription" required placeholder="Message Description">

        <input type="submit" name="btnregister" value="Register">

    </form>

</body>

</html>