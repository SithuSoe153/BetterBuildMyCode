

<form action="theSamePage.php" method="post">
    <input type="submit" name="someAction" value="GO" />
</form>

<?php
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Action']))
    {
        func();
    }
    function func()
    {
        // do stuff     
    }
?>


<button name="btnupdate"class="main-btn" type="submit">Update</button>
	<?php
		if(isset($_POST['Action']))
		{
			$updatee=$data['updatestaffraw.php?sid=$staffid'];
		}
		?>


-----------------------------------------

<form action="functioncalling.php">
    <input type="text" name="txt" />
    <input type="submit" name="insert" value="insert" onclick="insert()" />
    <input type="submit" name="select" value="select" onclick="select()" />
</form>

<?php
    function action(){
		echo "deletestaffraw.php?sid=$staffid";
    }
?>

<input type='hidden' name='id' value='<?php echo $id;?>' />
<a href='deletestaffraw.php?sid=$staffid'>

echo "<form action='add_answer.php' method='post' class='login'>";
echo "<input type='hidden' name='id' value='{$id}' />";
