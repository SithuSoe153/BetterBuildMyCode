<?php 
session_start();
session_destroy();
echo "<script>alert('LogOut Succesful')</script>";
echo "<script>window.location='CustomerLogin.php'</script>";
