<?php
//....
$user =  "John Doe"; // $row['user_name'];
$message = "User $user is logged in. Do you want to take over?";

if (isset($_GET['takeover'])) {
    if ($_GET['takeover'] == "confirm") {
        // $stmt1 = $connect->pre......etc
        exit(json_encode(["message" => "Access confirmed"])); // Send response to JS
    } else {
        // $stmt1 = $connect->pre......etc
        exit(json_encode(["message" => "Access revoked"])); // Send response to JS
    }
}
?>


<?php $message = "user " . $user . " is logged in. Do you want to take over ?"; ?>
<a href="userpage.php?confirm=yes">Yes</a>
<a href="userpage.php?confirm=no">No</a>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST</title>
</head>

<body>

    <h1>MY USER INTERFACE</h1>

    <script>
        const takeover = confirm("<?= $message ?>");
        fetch(`?takeover=${takeover ? "confirm" : "revoke"}`)
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });
    </script>
</body>

</html>