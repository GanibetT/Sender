<?php
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;

   require 'phpmailer/src/Exception.php';
   require 'phpmailer/src/PHPMailer.php';

   $mail = new PHPMailer(true);
   $mail->CharSet = 'UTF-8';
   $mail->setLanguage('ru', 'phpmailer/language/');
   $mail->IsHTML(true);

   $mail->setFrom('info@gis.guru', 'Freelance by the life');

   $mail->addAddress('talgatulygani@gmail.com');

   $mail->Subject = 'Hello! It is Ganibet';

   $hand = "Right";
   if($_POST['hand'] == "left") {
      $hand = "Left";
   }

   $body = "<h1>Meet great letter</h1>"

   if(trim(!empty($_POST['name']))){
      $body.='<p><strong>Name:</strong> '.$_POST['name'].'</p>';
   }
   if(trim(!empty($_POST['email']))){
      $body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
   }
   if(trim(!empty($_POST['hand']))){
      $body.='<p><strong>Hand:</strong> '.$hand.'</p>';
   }
   if(trim(!empty($_POST['age']))){
      $body.='<p><strong>Age:</strong> '.$_POST['age'].'</p>';
   }
   if(trim(!empty($_POST['message']))){
      $body.='<p><strong>Message:</strong> '.$_POST['message'].'</p>';
   }

   if (!empty($_FILES['image']['tmp_name'])) {
      $filePath = __DIR__ ."/files/" .$_FILES['image']['name'];

      if(copy($_FILES['image']['tmp_name'], $filePath)) {
         $fileAttach = $filePath;
         $body.=<p><strong>Photo in app</strong></p>;
         $mail->addAttachment($fileAttach);
      }
   }

   $mail->Body = $body;

   if(!$mail->send()) {
      $message = "Error";
   }else{
      $message = "Data sent";
   }

   $response = ['message' => $message];

   header('Content-type: application/json');
   echo json_encode($response);
?>
   