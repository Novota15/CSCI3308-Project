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

    if($user['Username'] === $Username){
      array_push($errors, "Username already exists");
      echo '<script type="text/javascript">',
      'alert("Username already exists.");',
      '</script>';
      header("location: registration.php");
    }
    if($user['emailAddress'] === $emailAddress){array_push($errors, "Email already exists");}
    debug_to_console($errors);

  }


  if(count($errors) == 0){
    $password = md5($passwordFirst); //encrypting password for safety
    $query = "INSERT INTO nwusers VALUES ('$Username','$fullname', '$password','$emailAddress','$address','$City','$Region','$PostalCode','$Country','$Phone')";
    //debug_to_console($query);
    mysqli_query($db,$query) or die("Cannot Query Database");
    $_SESSION['success'] = "You are now logged in";
    $_SESSION['auth'] = 1;
    $_SESSION['user'] = $Username;
    $_SESSION['fullname'] = $fullname;
    $_SESSION['password'] = $passwordFirst;
    $_SESSION['emailAddress'] = $emailAddress;
    $_SESSION['Address'] = $address;
    $_SESSION['City'] = $City;
    $_SESSION['Region'] = $Region;
    $_SESSION['PostalCode'] = $PostalCode;
    $_SESSION['Country'] = $Country;
    $_SESSION['Phone'] = $Phone;
    header("location: cards.php");
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
    debug_to_console($password);
    $query = "select * from nwusers where emailAddress = '$emailAddress' and password = '$password' limit 1";
    $result = mysqli_query($db,$query);
    debug_to_console(mysqli_num_rows($result));
    if(mysqli_num_rows($result)){
      $user_login = mysqli_fetch_assoc($result);
      $_SESSION['auth'] = 1;
      $_SESSION['user'] = $user_login["Username"];
      $_SESSION['fullname'] = $user_login["fullname"];
      $_SESSION['password'] = $user_login["password"];
      $_SESSION['emailAddress'] = $user_login["emailAddress"];
      $_SESSION['Address'] = $user_login["Address"];
      $_SESSION['City'] = $user_login["City"];
      $_SESSION['Region'] = $user_login["Region"];
      $_SESSION['PostalCode'] = $user_login["PostalCode"];
      $_SESSION['Country'] = $user_login["Country"];
      $_SESSION['Phone'] = $user_login["Phone"];
      $_SESSION['success'] = "You are now logged in";
      header("location: cards.php");
    }
    else{
      array_push($errors, "Wrong Password/Username");
      error($errors);
    }
  }
}


//Update profile info
if(isset($_POST['update_profile'])){
  debug_to_console("posted");
  $currentEmail = $_SESSION['emailAddress'];
  $newEmailAddress = mysqli_real_escape_string($db, $_POST['emailAddress']); //Entered email
  $newUserName = mysqli_real_escape_string($db, $_POST['userName']); //Entered username
  $newFirstName = mysqli_real_escape_string($db, $_POST['firstName']); //Entered first name
  $newLastName = mysqli_real_escape_string($db, $_POST['lastName']); //Entered last name
  $newAddress = mysqli_real_escape_string($db, $_POST['address']); //Entered address
  $newCity = mysqli_real_escape_string($db, $_POST['city']); //Entered city
  $newCountry = mysqli_real_escape_string($db, $_POST['country']); //Entered county
  $newPostalCode = mysqli_real_escape_string($db, $_POST['postalCode']); //Entered county
  $newPassword = mysqli_real_escape_string($db, $_POST['password']);
  //Check if we have text
  if(empty($newEmailAddress)){array_push($errors, "Email is required");}
  if(empty($newUserName)){array_push($errors, "Username is required");}
  if(strcmp($newUserName, $_SESSION['user']) !== 0){
    debug_to_console("User changed username");
    $username_check = "select Username from nwusers where emailAddress = '$newUserName' limit 1";
    $username_results = mysqli_query($db,$username_check);
    $username_mySqlObj = mysqli_fetch_assoc($username_results);
    if(mysqli_num_rows($username_results) > 0){
      debug_to_console("Username is already taken");
      array_push($errors, "Username taken by another user");
    }
  }
  if(strcmp($newEmailAddress, $_SESSION['emailAddress']) !== 0){
    debug_to_console("User changed email");
    //Check if new email is already taken
    $email_check = "select emailAddress from nwusers where emailAddress = '$newEmailAddress' limit 1";
    $email_results = mysqli_query($db,$email_check);
    $email_user = mysqli_fetch_assoc($email_results);
    if(mysqli_num_rows($email_results) > 0){
      debug_to_console("Email is already taken");
      array_push($errors, "Email taken by another user");
    }
  }

  //check if password matches
  //if($passwordFirst != $passwordConfirm){array_push($errors, "Password do not match");}

  if(count($errors) ==0){
    debug_to_console("no errors");
    $password = md5($_SESSION['password']);
    $_SESSION['user'] = $newUserName;
    $newName = $newFirstName." ";
    $newName = $newName.$newLastName;
    $_SESSION['fullname'] = $newName;
    //$_SESSION['password'] = $user_login["password"];
    $_SESSION['emailAddress'] = $newEmailAddress;
    $_SESSION['Address'] = $newAddress;
    $_SESSION['City'] = $newCity;
    //$_SESSION['Region'] = $user_login["Region"];
    $_SESSION['PostalCode'] = $newPostalCode;
    $_SESSION['Country'] = $newCountry;
   // $_SESSION['Phone'] = $user_login["Phone"];
    if(strlen($newPassword) == 0){
      $query = "update nwusers set emailAddress ='$newEmailAddress', address ='$newAddress', Username = '$newUserName', fullname = '$newName', Country = '$newCountry', City = '$newCity', PostalCode = '$newPostalCode'  where emailAddress = '$currentEmail'";
    }else if(strlen($newPassword) > 0){
      $_SESSION['password'] = $newPassword;
      $newPasswordEncrypted = md5($newPassword);
      $query = "update nwusers set emailAddress ='$newEmailAddress', address ='$newAddress', Username = '$newUserName', password = '$newPasswordEncrypted', fullname = '$newName', Country = '$newCountry', City = '$newCity', PostalCode = '$newPostalCode'  where emailAddress = '$currentEmail'";
    }
    $result = mysqli_query($db,$query);
    $_SESSION['success'] = "You successfully changed Email/Password";
    $_SESSION['updated_profile'] = 1; 
    header("location: Profile.php");
    }
    else{
      debug_to_console("email exists");
      array_push($errors, "New Email already exists");
      error($errors);
    }
}
?>
