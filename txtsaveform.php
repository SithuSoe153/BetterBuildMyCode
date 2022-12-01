<?php
// error_reporting(E_ERROR | E_PARSE);
$name = $_POST["txtname"];
$password = $_POST["txtpassword"];

echo "<script>alert('User Save Successful')</script>";

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

    <div>
        <h2>Login</h2>
        <form method="POST">

            <div>
                <label> User Name : </label>
                <input type="text" name="txtname" required>
            </div>

            <div>
                <label for=""> Password : </label>
                <input type="password" name="txtpassword" required>

            </div>

            <div>
                <input type="submit" value="Save">
            </div>


        </form>
    </div>
</body>

</html>

<?php
$currentDateTime = date('Y-m-d H:i:s');
$file = fopen("test.txt", "a");

fwrite($file, $currentDateTime . "\n");
fwrite($file, "Name : ");
fwrite($file, $name . "\n");

fwrite($file, "Password : ");
fwrite($file, $password . "\n" . "\n");
fclose($file);
?>