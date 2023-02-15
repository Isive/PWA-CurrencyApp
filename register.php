<?php include('Reg_sec.php') ?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins',sans-serif;
}
body{
  background-image:url(images/background1.jpg) ;
  background-repeat:no-repeat;
    background-size: cover;
    min-height: 100vh; 
  overflow: hidden;
}
::selection{
  background: rgba(26,188,156,0.3);
}
.container{
  max-width: 440px;
  padding: 0 20px;
  margin: 170px auto;
}
.wrapper{
  width: 100%;
  background: #fff;
  border-radius: 5px;
  box-shadow: 0px 4px 10px 1px rgba(0,0,0,0.1);
}
.wrapper .title{
  height: 90px;
  background-color: rgba(20, 52, 157, 0.8); 
  border-radius: 5px 5px 0 0;
  color: #fff;
  font-size: 30px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
}
.wrapper form{
  padding: 30px 25px 25px 25px;
}
.wrapper form .row{
  height: 45px;
  margin-bottom: 15px;
  position: relative;
}
.wrapper form .row input{
  height: 100%;
  width: 100%;
  outline: none;
  padding-left: 60px;
  border-radius: 5px;
  border: 1px solid lightgrey;
  font-size: 16px;
  transition: all 0.3s ease;
}
form .row input:focus{
  box-shadow: inset 0px 0px 2px 2px rgba(26,188,156,0.25);
}
form .row input::placeholder{
  color: #999;
}
.wrapper form .row i{
  position: absolute;
  width: 47px;
  height: 100%;
  color: #fff;
  font-size: 18px;
  background-color: rgba(20, 52, 157, 0.8); 
  border-radius: 5px 0 0 5px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.wrapper form .pass{
  margin: -8px 0 20px 0;
}
.wrapper form .pass a{
  font-size: 17px;
  text-decoration: none;
}
.wrapper form .pass a:hover{
  text-decoration: underline;
}
.wrapper form .button input{
  color: #fff;
  font-size: 20px;
  font-weight: 500;
  padding-left: 0px;
  background-color: rgba(20, 52, 157, 0.8); 
  cursor: pointer;
}
form .button input:hover{
  background: #20aa27;
}
.wrapper form .signup-link{
  text-align: center;
  margin-top: 20px;
  font-size: 17px;
}
.wrapper form .signup-link a{
  color: rgba(20, 52, 157);
  text-decoration: none;
}
form .signup-link a:hover{
  text-decoration: underline;
}
    </style>

  </head>
  <body>

    <div class="container">
      <div class="wrapper">
        <div class="title"><span>Rejestracja</span></div>
        <form action="register.php" method="POST">
       
            <div class="row">
                <i class="fas fa-user"></i>
                <input type="text" name="fName" placeholder="Imię" required>
              </div>

              <div class="row">
                <i class="fas fa-user"></i>
                <input type="text" name="lName" placeholder="Nazwisko" required>
              </div>

          <div class="row">
            <i class="fas fa-user"></i>
            <input type="email" name="email" placeholder="Email" required>
          </div>

          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" name=pass placeholder="Hasło" required>
          </div>

          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" name="rpass" placeholder="Powtórz hasło" required>
          </div>
          <?php include('errors.php'); ?>
          <div class="row button">
            <input type="submit" name="reg_user" value="Zarejestruj">
          </div>
          <div class="signup-link">Posiadasz konto? <a href="login.php">Zaloguj się</a></div>
        </form>
      </div>
    </div>



  </body>
</html>