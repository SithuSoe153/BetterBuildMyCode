<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('connect.php');
// include('autoidfunction.php');

// include('shoppingcart_functions.php');


$file_checker = 'images/captureimage.jpeg';



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/Exception.php');
require('PHPMailer/SMTP.php');
require('PHPMailer/PHPMailer.php');

$mail = new PHPMailer(true);

$customername = $_SESSION['cusname'];
$customerid = $_SESSION['cid'];
$customermail = $_SESSION['cusmail'];

// $testphp = file_get_contents("purchasedetail.php");

if (file_exists($file_checker)) {


    $enquirydata = [
        'fname' => $customername,
        'cid' => $customerid,
        'email' => $_SESSION['cusmail'],
        'message' => 'messages are here and message is message',
    ];

    $emailbody = '';
    $emailbody .= '<h1> Name is ' . $enquirydata['fname'] . '</h1>' . '<h1> Mail is ' . $enquirydata['email'] . '</h1>' . '<h1> ID is ' . $enquirydata['cid'] . '</h1>';


    // if (isset($_POST['btnsendmail'])) {

    try {
        //Server settings                   
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sithu032001@gmail.com';
        $mail->Password   = 'ixgsswtvsdsjayur';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('sithu032001@gmail.com', 'Better Build Furniture Company Limited');
        $mail->addAddress($customermail);

        // Optional
        // $mail->addAddress('companymail@gmail.com', 'Sithu Soe');
        $mail->addReplyTo('sithu032001@gmail.com', 'BBFurniture');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');



        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Order Receipt From Better Build Company';
        $mail->Body    = $emailbody . '
    

    <img src="cid:order_report" style="margin-left: 25%; width=20%; height=10%;">
    
    ';

        // $mail->msgHTML(file_get_contents('checkout.php'), __DIR__);
        $mail->addEmbeddedImage(dirname(__FILE__) . '/images/captureimage.jpeg', 'order_report');
        // $mail->addAttachment('./images/ha.jpg', 'new.jpg');    //Optional name
        // $mail->addAttachment('/files/report.docx');

        $mail->AltBody = 'This text will show in the main page beside the name.';

        $mail->send();

        // echo 'Message has been sent <br>';
        echo "<script>alert('Please Check Your Gmail !')</script>";

        $file_pointer = "images/captureimage.jpeg";

        // Use unlink() function to delete a file
        if (!unlink($file_pointer)) {
            // echo ("$file_pointer cannot be deleted due to an error");
        } else {
            // echo ("$file_pointer has been deleted");
        }



        echo "<script>window.location='index.php'</script>";

        // echo $customerid;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    // }



} else {

    $file_pointer = "images/captureimage.jpeg";

    // Use unlink() function to delete a file
    if (!unlink($file_pointer)) {
        // echo ("$file_pointer cannot be deleted due to an error");
    } else {
        // echo ("$file_pointer has been deleted");
    }

    echo "<script>window.location='index.php'</script>";
}
?>

<!-- <form action="phpmailer.php" method="post">
    <button type="submit" name="btnsendmail">Send Mail</button>

</form> -->