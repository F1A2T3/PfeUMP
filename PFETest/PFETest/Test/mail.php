<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="#" method="post">
      <label>
        send email
      </label>
      <button type="submit" name="ok">submit</button>
    </form>
</body>
</html>
<?php
  // if (isset($_POST['ok'])){
  //   $to = "imanebakhtaoui04@gmail.com";
  //   $subject = "Reponse de la demmande de rejoint au club sportif";
  //   $message = "Bonjour,\n\nCeci est un exemple d'e-mail envoyé depuis PHP.";
  //   $headers = "From: <hassanifatima773@gmail.com>";

  //   if (mail($to,$subject,$message,$headers)) {
  //      echo "L'e-mail a été envoyé avec succès.";
  //   } else {
  //      echo "Une erreur est survenue lors de l'envoi de l'e-mail.";
  //   }
  // }
  $password = "mouad";
  $passwordhack = sha1($password);
  echo $passwordhack ; 
?>