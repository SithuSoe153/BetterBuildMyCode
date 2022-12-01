<?php


$staffLogoutphpans = "active";

session_start();
session_destroy();
echo "<script>alert('LogOut Succesful')</script>";
echo "<script>window.location='staffLogin.php'</script>";
