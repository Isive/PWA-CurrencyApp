<?php
session_start();

$fName = "";
$lName = "";
$email    = "";
$activated = "";
$errors = array(); 
$token = "";
$email_activate = "";


function generateRandomString($length = 8) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

  function hasInternet()
{
    $hosts = ['1.1.1.1', '1.0.0.1', '8.8.8.8', '8.8.4.4'];

    foreach ($hosts as $host) {
        if ($connected = @fsockopen($host, 443)) {
            fclose($connected);
            return true;
        }
    }

    return false;
}

$check_connection=hasInternet();
if($check_connection==true)
{

  $db = mysqli_connect("localhost","root","","freedb_currencyConv");

  if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if (isset($_POST['reg_user'])) {

    $fName = mysqli_real_escape_string($db, $_POST['fName']);
    $lName = mysqli_real_escape_string($db, $_POST['lName']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['pass']);
    $password_2 = mysqli_real_escape_string($db, $_POST['rpass']);
  
    if (empty($fName)) { array_push($errors, "Imie jest wymagane"); }
    if (empty($lName)) { array_push($errors, "Nazwisko jest wymagane"); }
    if (empty($email)) { array_push($errors, "Email jest wymagany"); }
    if (empty($password_1)) { array_push($errors, "Hasło jest wymagane"); }
    if ($password_1 != $password_2) {
    array_push($errors, "Hasła się nie zgadzają!");
    }
    else if(strlen($password_1)<6)
    {
      array_push($errors, "Hasło za krótkie!(Przynajmniej 6 znaków)");
      }
    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
      $select = mysqli_query($db, "SELECT `email` FROM `users` WHERE `email` = '".$_POST['email']."'") or exit(mysqli_error($db));
      if(mysqli_num_rows($select)) {
          array_push($errors, "Email jest zajęty");
      }
  
    if (count($errors) == 0) {
      $password = md5($password_1);
      $token = generateRandomString();
      $htmlStr = "";
                $htmlStr .= "Witam " . $email . ",<br /><br />";
  
                $htmlStr .= "Ponizej podano kod aktywacyjny do konta. Kliknij w ponizszy link, aby przejsc do aktywacji.<br /><br /><br />";
                $htmlStr .= "Kod aktywacyjny: '$token'<br />";
                $htmlStr .= "<a href='localhost/Projekt/activate.php'>Przejdz, aby aktywowac konto</a>";
                $name = "PWA - CurrencyApp";
                $email_sender = "164023@stud.prz.edu.pl";
                $subject = "Link aktywacyjny - Progresywna aplikacja webowa";
                $recipient_email = $email;
                $headers  = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $headers .= "Od: {$name} <{$email_sender}> \n";
                $body = $htmlStr;
  
                if( mail($recipient_email, $subject, $body, $headers) ){
                    echo "<div id='successMessage'>Wiadomosc zostala wyslana do <b>" . $email . "</b>, prosze otworzyc link i aktywowac konto aby zalogowac sie.</div>";
                }
      $query = "INSERT INTO users (firstname,lastname, email, password,token) 
            VALUES('$fName','$lName', '$email', '$password', '$token')";
      mysqli_query($db, $query);
      header('location: login.php');
    }
  }
  
  if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($email)) {
      array_push($errors, "Email jest wymagany");
    }
    if (empty($password)) {
      array_push($errors, "Hasło jest wymagane");
    }
  
    if (count($errors) == 0) 
    {
      $password = md5($password);
      $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
      $results = mysqli_query($db, $query);
      $user1 = mysqli_fetch_assoc($results);
    
      if (mysqli_num_rows($results) == 1) {

        if($user1['activated']=="false"){
          array_push($errors, "Sprawdź skrzynkę pocztową w celu aktywacji konta");
        }
        else {
          $_SESSION['email'] = $user1['email'];
          $_SESSION['firstname'] = $user1['firstname'];
          $_SESSION['lastname'] = $user1['lastname'];
          $_SESSION['id'] = $user1['id'];
          $_SESSION['password'] = $user1['password'];
          $_SESSION['loggedin'] = true;
      
          header('location: index.php');
        }  
      }else {
        array_push($errors, "Nieprawidłowy email lub nieprawidłowe hasło");
      } 
  }
  }

  if (isset($_POST['activate'])) {
    $email_activate = mysqli_real_escape_string($db, $_POST['email-aktywacja']);
    $token = mysqli_real_escape_string($db, $_POST['token']);
    if (empty($email_activate)) {array_push($errors, "Email jest wymagany");}
    if (empty($token)) {array_push($errors, "Kod aktywacyjny jest wymagany");}
    if (count($errors) == 0) 
    {
      $query = "SELECT * FROM users WHERE email='$email_activate'";
      $results = mysqli_query($db, $query);
      $user2 = mysqli_fetch_assoc($results);
      if (mysqli_num_rows($results) == 1) {
      if($user2['token']==$token && $user2['email']==$email_activate){
        $query = "UPDATE users SET activated='true' WHERE email='$email_activate'";
        mysqli_query($db, $query);
        array_push($errors, "Pomyślnie aktywowano");
      }
      else if($user2['activated']=="true"){array_push($errors, "Konto zostało już aktywowane");}
      
      else{ array_push($errors, "Niepoprawne dane");}
    }
    else {array_push($errors, "Nieprawidłowy email");}
  }
  }

  if (isset($_POST['remind'])) 
  {
    $visited = "false";
    $email_remind = mysqli_real_escape_string($db, $_POST['email_remind']);
    if (empty($email_remind)) {array_push($errors, "Email jest wymagany");}
    if (count($errors) == 0) 
    {
      $query = "SELECT * FROM users WHERE email='$email_remind'";
      $results = mysqli_query($db, $query);
      $user3 = mysqli_fetch_assoc($results);
      if (mysqli_num_rows($results) == 1) 
      {
        if($user3['activated']=='false'){  array_push($errors, "Konto nie zostało aktywowane");}
        else {
                $token = generateRandomString();
                $htmlStr = "";
                $htmlStr .= "Witam " . $email_remind . ",<br /><br />";
                $htmlStr .= "Ponizej podano kod zmiany hasla. Kliknij w ponizszy link, aby przejsc do aktywacji.<br /><br /><br />";
                $htmlStr .= "Kod weryfikacyjny: '$token'<br />";
                $htmlStr .= "<a href='localhost/Projekt/remind_pass.php'>Przejdz, aby ustawic nowe haslo</a>";
                $name = "PWA - CurrencyApp";
                $email_sender = "164023@stud.prz.edu.pl";
                $subject = "Przypomnienie hasla - Progresywna aplikacja webowa";
                $recipient_email = $email_remind;
                $headers  = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $headers .= "Od: {$name} <{$email_sender}> \n";
                $body = $htmlStr;
  
                if( mail($recipient_email, $subject, $body, $headers) ){
                  array_push($errors, "Kod do zmiany hasła został wysłany na podany adres email");}

      $query = "UPDATE users SET token='$token' WHERE email='$email_remind'"; 
      mysqli_query($db, $query);
      $_SESSION["visited"] = "true";
      }
      }
      else { array_push($errors, "Brak konta z powiązanym adresem email");}
    }
  }

  if (isset($_POST['remind_pass'])) {
   
    $visited="true";
    $token = mysqli_real_escape_string($db, $_POST['token']);
    $email_remind = mysqli_real_escape_string($db, $_POST['email_remind']);
    $password_1 = mysqli_real_escape_string($db, $_POST['pass']);
    $password_2 = mysqli_real_escape_string($db, $_POST['rpass']);
    if (empty($token)) { array_push($errors, "Kod weryfikacyjny jest wymagany"); }
    if (empty($email_remind)) { array_push($errors, "Email jest wymagany"); }
    if (empty($password_1)) { array_push($errors, "Hasło jest wymagane"); }
    if ($password_1 != $password_2) {
    array_push($errors, "Hasła się nie zgadzają!");
    }
    else if(strlen($password_1)<6)
    {
      array_push($errors, "Hasło za krótkie!(Przynajmniej 6 znaków)");
      }
      if (count($errors) == 0) 
      {
        $query = "SELECT * FROM users WHERE email='$email_remind'";
        $results = mysqli_query($db, $query);
        $user4 = mysqli_fetch_assoc($results);
        if (mysqli_num_rows($results) == 1) 
        { 
          if($user4['token']==$token && $user4['email']==$email_remind) {
            $password_1 = md5($password_1);
            $query = "UPDATE users SET password='$password_1' WHERE email='$email_remind'"; 
            mysqli_query($db, $query);
            $_SESSION["visited"] = "false";
            array_push($errors, "Hasło zostało pomyślnie zmienione");
          }
          else {array_push($errors, "Błędne dane");}
        }
        else {array_push($errors, "Brak konta z powiązanym adresem email");}
      }
  }
  $db->close();
}

?>
