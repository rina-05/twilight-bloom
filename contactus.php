<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Twilight-bloom</title>
  <link rel="stylesheet" href="contactus.css">
</head>
<body>

<?php

require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

$mail = new PHPMailer(true); 



try {
  
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com'; 
  $mail->SMTPAuth = true;
  $mail->Username = 'gjonbalajjanina@gmail.com'; 
$mail->Password = 'jfhr pbii yevr dbzr'; 
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;

  $mail->setFrom('emaili_yt@gmail.com', 'Twilight-Bloom');
  $mail->addAddress($_POST['email']); 
  $mail->Subject = 'We have received your message.';
  $mail->Body = 'Thank you for contacting us. We will get back to you as soon as possible. :)';

  
  $mail->send();
  echo '  Emaili u dërgua me sukses!';
} catch (Exception $e) {
  echo " Emaili dështoi: {$mail->ErrorInfo}";
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $message = htmlspecialchars($_POST["message"]);

    if (empty($name) || empty($email) || empty($message)) {
        echo "<p style='color: red;'> Të gjitha fushat janë të detyrueshme!</p>";
    } else {
        
        $to = "gjonbalajjanina@gmail.com"; 
        $subject = "Mesazh i ri nga formulari i kontaktit";
        $body = "Emri: $name\nEmail: $email\nTelefoni: $phone\n\nMesazhi:\n$message";
        $headers = "From: $email";

        if (@mail($to, $subject, $body, $headers)) {
            echo "<p style='color: green;'> Mesazhi u dërgua me sukses!</p>";
        } else {
        }

        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "contact_form";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("<p style='color: red;'>Lidhja me databazën dështoi: " . $conn->connect_error . "</p>");
        }

        $sql = "INSERT INTO messages (name, email, phone, message) 
        VALUES ('Emri', 'email@example.com', '1234567890', '')";

        $stmt = $conn->prepare("INSERT INTO messages (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $message);

        if ($stmt->execute()) {
            echo "<p style='color: green;'> Mesazhi u ruajt në databazë!</p>";
        } else {
            echo "<p style='color: red;'> Gabim gjatë ruajtjes në databazë: " . $stmt->error . "</p>";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
  <div class="container">
    <div  class="form">
      <div class="contact-info"></div>
 <div class="contact-form">
    <span class="circle one "></span>
    <span class="circle two "></span>

    <form action="index.html">
      <h3 class="title">Contact Us</h3>
      
      <div class="input-container">

        <input type="text" name="name"  class="input">
        <label for="">Username</label>
        <span>Username</span>

      </div>
      <div class="input-container">
        <input type="email" name="email" class="input">
        <label for="">Email</label>
        <span>Email</span>

      </div>
      <div class="input-container">
        <input type="tel" name="phone"  class="input">
        <label for="">Phone</label>
        <span>Phone</span>

      </div>
      <div class="input-container textarea">
       <textarea name="message"  class="input"></textarea>
        <label for="">Message</label>
        <span>Message</span>

      </div>
      <input type="submit" value="Send" class="btn">



    </form>
   </div>
 </div>
</div>

  

  <script src="contactus.js"></script>
</body>
</html>