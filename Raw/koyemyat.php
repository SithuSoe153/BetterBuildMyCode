<form action="koyemyat.php" method="post">
    number: <input type="text" name="n" />
    <br />
    <input type="radio" name="opt" value="2" /> multi 2
    <br />
    <input type="radio" name="opt" value="4" /> multi 4
    <br />
    <input type="radio" name="opt" value="6" /> multi 6
    <br />
    <input type="submit" value="calculate" />
</form>

<?php
$price = $_POST['n'] * $_POST['opt'];
echo "$price";


$six = 6;
$two = 2;

$answer = "$six" + "$two";
echo $answer;
