<?php 	

function Add($productid,$purchaseprice,$purchasequantity)
{
	$connect=mysqli_connect("localhost","root","","pos_db");
	$query="SELECT * FROM product WHERE productid='$productid'";
	$ret=mysqli_query($connect,$query);
	$count=mysqli_num_rows($ret);
	if ($count<1)
	 {
		echo "<p>NO Record Found.</p>";
		//exit();
	}
	$arr=mysqli_fetch_array($ret);
	$productname=$arr['productname'];
	$image1=$arr['productimage'];

	if(isset($_SESSION['purchasefunction'])) 
	{
	  $index=IndexOf($productid);
	  if($index==-1)	
	  {
	  	$size=count($_SESSION['purchasefunction']);

	  	$_SESSION['purchasefunction'][$size]['productid']=$productid;
	  	$_SESSION['purchasefunction'][$size]['productname']=$productname;
	  	$_SESSION['purchasefunction'][$size]['purchaseprice']=$purchaseprice;
	  	$_SESSION['purchasefunction'][$size]['purchasequantity']=$purchasequantity;
	  	$_SESSION['purchasefunction'][$size]['image1']=$image1;

	  
	}
	else
	{
      
	  	$_SESSION['purchasefunction'][$index]['purchasequantity']+=$purchasequantity;
	  	
	}
	}
	else
	{
		$_SESSION['purchasefunction']=array();
		$_SESSION['purchasefunction'][0]['productid']=$productid;
		$_SESSION['purchasefunction'][0]['productname']=$productname;
		$_SESSION['purchasefunction'][0]['purchaseprice']=$purchaseprice;
		$_SESSION['purchasefunction'][0]['purchasequantity']=$purchasequantity;
		$_SESSION['purchasefunction'][0]['image1']=$image1;
	}
	echo "<script>window.location='Purchase.php'</Script>";



}

function Remove($productid)
{
	$index=IndexOf($productid);
	if($index!=-1)
	{
		unset($_SESSION['purchasefunction'][$index]);
		echo "<script>window.location='purchase.php'</script>";
	}
}

function IndexOf($productid)
  {
  	if(!isset($_SESSION['purchasefunction']))
  	{
  		return -1;
  	}
  	$size=count($_SESSION['purchasefunction']);
  	if($size==0)
  	{
  		return -1;
  	}
  	for($i=0; $i<$size; $i++)
  	{
  		if($productid==$_SESSION['purchasefunction'][$i]['productid'])
     {
     	return $i;
     }
  	}
     return -1;
  }
function CalculateTotalAmount()
{
	$totalamount=0;
	$size=count($_SESSION['purchasefunction']);
	for ($i=0; $i <$size ; $i++)
	 { 
		$purchaseprice=$_SESSION['purchasefunction'][$i]['purchaseprice'];
		$purchasequantity=$_SESSION['purchasefunction'][$i]['purchasequantity'];
		$totalamount=$totalamount + ($purchaseprice* $purchasequantity);
	}
	return $totalamount;
}

function CalculateTotalQuantity()
{
	$Qty=0;

	$size=count($_SESSION['purchasefunction']);

	for ($i=0; $i <$size ; $i++) 
	{ 
		$quantity=$_SESSION['purchasefunction'][$i]['purchasequantity'];
		$Qty=$Qty + ($quantity);
	}
	return $Qty;
}

 ?>