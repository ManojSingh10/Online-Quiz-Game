<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div id="bg">
      <br>
      <h2>Welcome to Online Quiz Game!</h2>
      <hr>
      <div id="basic">

        <div id="rules">
          <h3>Take the Quiz to test your Tech knowledge!</h3>
          <br><br><br>
          <h3><u>THE RULES:</u></h3><br>
          <p>1. The Quiz consist of 15 questions.</p><br>
          <p>2. Each question is of 10 points.</p><br>
          <p>3. For each correct answer, user is awarded 10 points.</p><br>
          <p>4. No negative marking is done.</p><br>
          <p>5. The user must answer within 10 seconds.</p>
          <br><br>
          <h3>Login or Signup to start now!</h3>
        </div>
      </div>
      <div class="module">
        <div id="heading">Create Account</div>

        <form class="form" method="post" onsubmit="return Validate()" action="registration.php" >
          <input type="text" placeholder="USERNAME" class="textbox" id="user" name="username" required/>

          <input type="password" placeholder="PASSWORD" class="textbox" id="pass" name="password" required/>

          <div id="check"><input type="checkbox" onclick="myFunction()">Show Password</input></div>

          <input type="password" placeholder="CONFIRM PASSWORD" class="textbox" name="cpassword" required/>

          <input type="submit" value="Sign Up" class="button" />
          <p id="login">Already Signed Up? <a href="login.php">Login</a> here to continue.
        </form>
      </div>
    </div>



  </body>

  <script>

    function myFunction()
    {
      var x = document.getElementById("pass");
      if (x.type === "password")
      {
        x.type = "text";
      }
      else
      {
        x.type = "password";
      }
    }
    get
  </script>
</html>
