<?php
session_start();
session_destroy();
echo "<script>alert('LogOut Succesful')</script>";
echo "<script>window.location='customerlogin.php'</script>";
