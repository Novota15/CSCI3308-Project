<!--
=========================================================
 Material Dashboard - v2.1.1
=========================================================

 Product Page: https://www.creative-tim.com/product/material-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/material-dashboard/blob/master/LICENSE.md)

 Coded by Creative Tim

=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->

<?php
 
 function debug_to_console( $data ) {
  $output = $data;
  if ( is_array( $output ) )
    $output = implode( ',', $output);
    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}


 session_start();
 $username = $_SESSION['user'];
 if(isset($_SESSION['updated_profile']) && $_SESSION['updated_profile'] == 1){
   $_SESSION['updated_profile'] = 0;
   echo '<script type="text/javascript">',
     'alert("Updated profile settings.");',
     '</script>';
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../static/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../static/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../static/assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../static/assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <  <div class="wrapper ">
    <div class="sidebar" data-color="azure" data-background-color="white">
<!--
Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
Tip 2: you can also add an image using data-image tag
-->
<div class="logo">
</a>
<a href="landing-page.html" class="simple-text logo-normal">
  StockAnalytica
</a>
</div>
<div class="sidebar-wrapper">
  <ul class="nav">
    
    <li class="nav-item active  ">
      <a class="nav-link" href="cards.php"  data-image="../assets/img/vue.png">
        <i class="material-icons">dashboard</i>
        <p>Dashboard</p>
      </a>
    </li>

    <li class="nav-item active  ">
      <a class="nav-link" href="http://10.201.85.150:5000/dashboard.html"  data-image="../assets/img/vue.png">
        <i class="material-icons">assessment</i>
        <p>Assessments</p>
      </a>
    </li>


    

    <!-- your sidebar here -->
  </ul>
</div>
</div>
<div class="main-panel">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
      <div class="navbar-wrapper">
        <a class="navbar-brand" href="profile.html">User Profile</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">
        <form class="navbar-form" action="." method="POST">
          <div class="input-group no-border">
            <select type="text" name="ticker" class="form-control" placeholder="Search..." style= "width:150px;">
              <option value="Search">Search..</option>
              <option value="GOOG">Google</option>
              <option value="TSLA">Tesla</option>
              <option value="MSFT">Microsoft</option>
              <option value="F">Ford</option>
              <option value="FB">Facebook</option>
              <option value="SNE">Sony</option>  
            </select>
            <button type="submit" class="btn btn-white btn-round btn-just-icon">
              <i class="material-icons">search</i>

              <div class="ripple-container"></div>
            </button>
          </div>
        </form>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">person</i>
              <p class="d-lg-none d-md-block">
                Account
              </p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
              <a class="dropdown-item" href="Profile.php">Profile</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="landing-page.html" >Log out</a> 
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Edit Profile</h4>
                  <p class="card-category">Complete your profile</p>
                </div>
                <div class="card-body">
                  <form id="profile_form" method="post" action="server.php">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Company </label>
                          <input style= "width:150px;" type="text" class="form-control"  >
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Username</label>
                          <input type="text"  class="form-control" style= "width:150px;" name="userName" id="userName">
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email address</label>
                          <input type="email" class="form-control" style= "width:300px;" name="emailAddress" id="emailAddress">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="password" class="form-control" style= "width:150px;" name="password" id="password">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Fist Name</label>
                          <input type="text" class="form-control" style= "width:150px;" name="firstName" id="firstName">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Last Name</label>
                          <input type="text" class="form-control" style= "width:150px;" name="lastName" id="lastName">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Address</label>
                          <input type="text" class="form-control" style= "width:300px;" name="address" id="address">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">City</label>
                          <input type="text" class="form-control" style= "width:150px;" name="city" id="city">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Country</label>
                          <input type="text" class="form-control" style= "width:150px;" name="country" id="country">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Postal Code</label>
                          <input type="text" class="form-control" style= "width:150px;" name="postalCode" id="postalCode">
                        </div>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary pull-right" name="update_profile">Update Profile</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     <footer class="footer">
    <div class="container-fluid">
      <nav class="float-left">
        <ul>
          <li>
            <a href="https://www.creative-tim.com">
              Creative Tim
            </a>
          </li>
        </ul>
      </nav>
      <div class="copyright float-right">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>, made with <i class="material-icons">favorite</i> by
        <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
      </div>
      <!-- your footer here -->
    </div>
  </footer>
</div>
</div>

<!--   Core JS Files   -->
<script src="../static/assets/js/core/jquery.min.js"></script>
<script src="../static/assets/js/core/popper.min.js"></script>
<script src="../static/assets/js/core/bootstrap-material-design.min.js"></script>
<script src="../static/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
        
        // Monitors the buttons for click events and slides <img> in response
        
 
        
        $('#navbarDropdownMenuLink').click(function(){
            $('.dropdown-item1').slideToggle('fast');
        });
    </script>
    <script>
      var username = "<?php echo $_SESSION['user']; ?>";
      var fullName = "<?php echo $_SESSION['fullname']; ?>";
      var firstName = (fullName.toString()).split(" ")[0];
      var lastName = (fullName.toString()).split(" ")[1];
      var password = "<?php echo $_SESSION['password']; ?>";
      var email = "<?php echo $_SESSION['emailAddress']; ?>";
      var address = "<?php echo $_SESSION['Address']; ?>";
      var city = "<?php echo $_SESSION['City']; ?>";
      var country = "<?php echo $_SESSION['Country']; ?>";
      var postalCode = "<?php echo $_SESSION['PostalCode']; ?>";
      //var usernameBox = document.getElementById("userName");
      var formObject = document.forms["profile_form"];
      formObject.elements["userName"].value = username.toString();
      if(firstName != undefined){
        formObject.elements["firstName"].value = firstName;
      }
      if(lastName != undefined){
        formObject.elements["lastName"].value = lastName;
      }
      
      formObject.elements["emailAddress"].value = email.toString();
      formObject.elements["address"].value = address.toString();
      formObject.elements["city"].value = city.toString();
      formObject.elements["country"].value = country.toString();
      formObject.elements["postalCode"].value = postalCode.toString();
      document.getElementById("user-title").innerHTML = username.toString();
    </script>
</body>

</html>