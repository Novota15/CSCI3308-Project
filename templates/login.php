
<?php

  function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
  }   
  session_start();
  if(isset($_SESSION['auth']) && $_SESSION['auth']==1){
    $_SESSION['auth'] = 0;
    debug_to_console("Session Variables unset");
  }
?>
<!DOCTYPE html>
<html>
<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>



  <body class="center text-center">

    <form method = "post" action = "server.php" >
    <div class= "center-box">
    <h1 class="h3 mb-3 font-weight-normal">Login</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="emailAddress" id="inputEmail" class="form-control form-signin" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="passwordFirst" id="inputPassword" class="form-control form-signin" placeholder="Password" required>
    <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me |
    </label>
      <a href="">Forgot Password?</a>
    </div>
    <button class="btn btn-lg btn-primary" type="submit" name="login_user" id="login_user">Sign in</button>
    <a class="btn btn-lg btn-primary" href="registration.php">Register</a>
    </div>
  </form>
</body>


<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap-material-design.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
</html>
