<?php
include ('connect.php');
if (isset($_REQUEST['pid'])) 
{

	$pid=$_REQUEST['pid'];
	$Select="select * from purchase p,supplier s, purchasedetail pd,product pr 
	where p.supplierid=s.supplierid
	AND p.purchaseid=pd.purchaseid
	AND pd.productid=pr.productid
	AND p.purchaseid='$pid'";
	$query=mysqli_query($connection,$Select);
	$count=mysqli_num_rows($query);


}

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form>
		<table border="1" width="500px">


			<tr>
				<td>Product Name</td>
				<td>Unit Price</td>
				<td>Unit Quantity</td>
			</tr>

			<?php 


					for ($i=0; $i <$count ; $i++) 
					{ 
						
							$data=mysqli_fetch_array($query);

							$productname=$data['productname'];
							$unitprice=$data['unitprice'];
							$unitquantity=$data['unitquantity'];
							$purchasedate=$data['purchasedate'];
							$suppliername=$data['suppliername'];
							$totalamount=$data['totalamount'];
							$totalquantity=$data['totalquantity'];

					


			 ?>
			<tr>
				<td>
					<?php echo $productname ?>
				</td>
				<td>
					<?php echo $unitprice ?>
				</td>
				<td>
					<?php echo $unitquantity ?>
				</td>
			</tr>

			<?php 
				}
			 ?>
			 			<tr>
				<td colspan="3">
					Order ID :<?php echo $pid ?><p>
					Order Date :<?php echo $purchasedate  ?><p>
					Customer Name : <?php echo $suppliername ?>
				</td>
			</tr>
			 <tr>
			 	<td colspan="3">
			 		Total Amount :<?php echo $totalamount ?><p>
			 		Total Quantity :<?php echo $totalquantity ?>
			 	</td>
			 </tr>
		</table>
	</form>
</body>
</html>