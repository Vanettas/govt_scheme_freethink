<?php
// Use the correct path based on your folder structure
require 'C:/xampp/php/phpmailer/src/PHPMailer.php';
require 'C:/xampp/php/phpmailer/src/SMTP.php';
require 'C:/xampp/php/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();
echo "PHPMailer is working!";
?>
