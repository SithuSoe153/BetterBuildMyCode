<?php

// Get the incoming image data
$imagesave = $_POST["imagesave"];

// Remove image/jpeg from left side of image data
// and get the remaining part
$imagesave = explode(";", $imagesave)[1];

// Remove base64 from left side of image data
// and get the remaining part
$imagesave = explode(",", $imagesave)[1];

// Replace all spaces with plus sign (helpful for larger images)
$imagesave = str_replace(" ", "+", $imagesave);

// Convert back from base64
$imagesave = base64_decode($imagesave);

// Save the image as filename.jpeg
file_put_contents("images/captureimage.jpeg", $imagesave);

// Sending response back to client
echo "Done";
