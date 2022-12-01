<?php 
session_start();
include('connect.php');
if(!isset($_SESSION['cid']))
{
	echo "<script>alert('Pls Login Again')</script>";
    echo "<script>window.location='CustomerLogin.php'</script>";

}


if (isset($_REQUEST['productid']))
{
	$productid=$_REQUEST['productid'];
	$query="SELECT p.*,b.brandid,b.brandname,c.categoryid,c.categoryname
    FROM product p,brand b,category c
    WHERE p.brandid=b.brandid
    AND p.categoryid=c.categoryid
    AND p.productid='$productid'";
    $ret=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($ret);

    $productid=$arr['productid'];
    $productname=$arr['productname'];
    $price=$arr['unitprice'];
    $quantity=$arr['unitquantity'];
    $brandname=$arr['brandname'];
    $categoryname=$arr['categoryname'];
    $image1=$arr['productimage'];
}
else
{
	echo "<script>window.location='Index.php'</script>";
}

 ?>



 <!DOCTYPE html>
 <html>
 <head>
    <title></title>
 </head>
 <body>
    <TABLE>
        <tr>
            <td>|</td>
            <td><a href="ChangeProfile.php">Change Profile</a></td>
            <td>|</td>
            <td><a href="ChangePassword.php">Change Password</a></td>
            <td>|</td>
        </tr>
    </TABLE>
    <form action="shoppingcart.php" method="get">
        <input type="hidden" name="productid" value="<?php echo $productid ?>"/>
        <input type="hidden" name="action" value="buy" />
       
        <fieldset>
            <legend>Product Detail of<?php echo $productname ?></legend>
            <table align="center">
                <tr>
                    <td>
                        <img src="<?php echo $image1 ?>" width="$400px" height="400px" id="ImgPhoto"/><br/>
                    </td>
                    <td>
                        <table>
                            <tr>
                <td>Product Name</td>
                <td>
                    :<b><?php echo $productname ?></b>
                </td>
            </tr>
            <tr>
            <td>Brand Name</td>
            <td>
                :<b><?php echo $brandname ?></b>
            </td>
        </tr>
        <tr>
            <td>Category Name</td>
            <td><?php echo $categoryname ?></td>
        </tr>
        <tr>
            <td>Price</td>
            <td>
                :<b style="colour:blue;"><?php echo $price ?></b>MMK
            </td>
        </tr>
        <tr>
            <td>Quantity</td>
            <td>
                :<b>
                    <?php 
                    if($quantity<1) 
                    {
                        echo "Out Of Stock";
                        exit(); 
                    }
                    echo $quantity ?></b>Pcs
            </td>
        </tr>
        <tr>
            <td>Buying Quantity</td>
            <td>
                :<input type="number" name="txtBuyQuantity" value="1" min="1" max="20"/>
                <input type="submit" name="btnAdd" value="Add"/>
            </td>
        </tr>
                            
                        </table>

                    </td>
                </tr>
            
</table>
        </fieldset>
        
    </form>
 </body>
 </html>
