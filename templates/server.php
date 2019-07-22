<?php
function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

$errors = array();
function error($errors){

  if(count($errors > 0)){
    foreach($errors as $totalerrors){
    echo "$totalerrors <br>";
  }
}
}
session_start();

//echo "<h3> PHP List All Session Variables</h3>";
//foreach ($_SESSION as $key=>$val)
  //echo $key." ".$val."<br/>";

$_SESSION['auth'] = 0;

//var_dump($_POST);


//connect to // // DEBUG:
$db = mysqli_connect("localhost","root","", "users") or die("could not connect");

//if (mysqli_connect_errno()) {
//  echo "Failed to connect to MySQL: " . mysqli_connect_error();
//}
debug_to_console("hello world");

//User wants to register an account
debug_to_console("Trying logic for register user");
if(isset($_POST['register_user'])){
  $Username = mysqli_real_escape_string($db, $_POST['Username']);
  debug_to_console("Clicked Register User");
  $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
  $passwordFirst = mysqli_real_escape_string($db, $_POST['passwordFirst']);
  $passwordConfirm = mysqli_real_escape_string($db, $_POST['passwordConfirm']);
  $emailAddress= mysqli_real_escape_string($db, $_POST['emailAddress']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $City = mysqli_real_escape_string($db, $_POST['City']);
  $Region = mysqli_real_escape_string($db, $_POST['Region']);
  $PostalCode = mysqli_real_escape_string($db, $_POST['PostalCode']);
  $Country = mysqli_real_escape_string($db, $_POST['Country']);
  $Phone = mysqli_real_escape_string($db, $_POST['Phone']);

  if(empty($Username)){array_push($errors, "Username is required");}
  if(empty($emailAddress)){array_push($errors, "Email is required");}
  if(empty($passwordFirst)){array_push($errors, "Password is required");}
  if($passwordFirst != $passwordConfirm){array_push($errors, "Password do not match");}

  $user_check = "select * from nwusers where Username = '$Username' or emailAddress = '$emailAddress' limit 1";
  $results = mysqli_query($db,$user_check);
  $user = mysqli_fetch_assoc($results);

  if ($user){

    if($user['Username'] === $Username){array_push($errors, "Username already exists");}
    debug_to_console($user['Username']);
    debug_to_console($Username);
    if($user['emailAddress'] === $emailAddress){array_push($errors, "Email already exists");}
    debug_to_console($errors);

  }


  if(count($errors) == 0){
    $password = md5($passwordFirst); //encrypting password for safty
    $query = "INSERT INTO nwusers VALUES ('$Username','$fullname', '$password','$emailAddress','$address','$City','$Region','$PostalCode','$Country','$Phone')";
    //debug_to_console($query);
    mysqli_query($db,$query) or die("Cannot Query Database");
    $_SESSION['success'] = "You are now logged in";
    $_SESSION['auth'] = 1;
    header("location: template.php");
  }
  else{
    error($errors);
    //header("location: registration.php");
  }
}
//If user is logging in
debug_to_console("Trying logic for login user");
if(isset($_POST['login_user'])){
  debug_to_console("Clicked Log In");
  $emailAddress = mysqli_real_escape_string($db, $_POST['emailAddress']);
  $passwordFirst = mysqli_real_escape_string($db, $_POST['passwordFirst']);
  debug_to_console($emailAddress);
  debug_to_console($passwordFirst);
  //debug_to_console($emailAddress);
  if(empty($emailAddress)){array_push($errors, "Email is required");}
  if(empty($passwordFirst)){array_push($errors, "Password is required");}
  if(count($errors) ==0){
    debug_to_console("Error?");
    $password = md5($passwordFirst);
    $query = "select * from nwusers where emailAddress = '$emailAddress' and password = '$password' limit 1";
    $result = mysqli_query($db,$query);
    debug_to_console(mysqli_num_rows($result));
    if(mysqli_num_rows($result)){
      debug_to_console("What about fucking now");
      $_SESSION['auth'] = 1;
      $_SESSION['success'] = "You are now logged in";
      debug_to_console("Clicked Log In 2");
      header("location: template.php");
    }
    else{
      array_push($errors, "Wrong Password/Username");
      error($errors);
    }
  }
}

//Account settings
if(isset($_POST['singlebutton'])){
  $emailAddress = mysqli_real_escape_string($db, $_POST['emailAddress']); //current email address
  $nemailAddress = mysqli_real_escape_string($db, $_POST['nemailAddress']); //new emailAddress
  $passwordFirst = mysqli_real_escape_string($db, $_POST['passwordFirst']); //new password
  $passwordConfirm =  mysqli_real_escape_string($db, $_POST['passwordConfirm']); //confirmation
  //Check if we have text
  if(empty($emailAddress)){array_push($errors, "Current Email is required");}
  if(empty($nemailAddress)){array_push($errors, "new Email is required");}
  if(empty($passwordFirst)){array_push($errors, "Password is required");}
  if(empty($passwordConfirm)){array_push($errors, "Password Confirmation is required");}

  //check if password matches
  if($passwordFirst != $passwordConfirm){array_push($errors, "Password do not match");}

  // check if email matches an email in the database
  $user_check = "select emailAddress from nwusers where emailAddress = '$emailAddress' limit 1";
  $results = mysqli_query($db,$user_check);
  $user = mysqli_fetch_assoc($results);
  if(strcmp($user['emailAddress'], $emailAddress) !== 0){array_push($errors, "Email does not exists");}

  //
  if(count($errors) ==0){
    debug_to_console("no errors");
    //check if the new email already exists in the database
    $query2 = "select emailAddress from nwusers where emailAddress = '$nemailAddress' limit 1";
    $result2 = mysqli_query($db,$query2);
    // if not then add it to the database
    if(mysqli_num_rows($result2) == 0){
    $password = md5($passwordFirst);
    $query = "update nwusers set emailAddress ='$nemailAddress', password ='$password'  where emailAddress = '$emailAddress'";
    $result = mysqli_query($db,$query);
    $_SESSION['success'] = "You successfully changed Email/Password";
    header("location: Settings.php");
    }
    else{
    debug_to_console("email exists");
    array_push($errors, "New Email already exists");
    error($errors);
    }
  }
}
?>
