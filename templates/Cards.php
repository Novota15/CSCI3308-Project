<?php

  function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
      $output = implode( ',', $output);
      echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
  }
  
  session_start();
  if(isset($_SESSION['auth']) && $_SESSION['auth'] == 1 ){
    $_SESSION['msg'] = "You must log in first to view this page";
    $user = $_SESSION['user'];
    debug_to_console("auth = 1");
    debug_to_console($user);
    //header("location: login.php");
  }
  else {
    $_SESSION['auth'] = 0;
    header("location: login.php");
  }

?>

<!doctype html>

<!--
=========================================================
Material Dashboard - v2.1.1
=========================================================
Product Page: https://www.creative-tim.com/product/material-dashboard
Copyright 2019 Creative Tim (https://www.creative-tim.com)
Licensed under MIT (https://github.com/creativetimofficial/material-dashboard/blob/master/LICENSE.md)
Coded by Creative Tim
Templated Edited by Team EE for CSCI3308
=========================================================
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<style>a.majorheading
{
  color:black;
  border: 2px solid black;
  font-family: times
}
</style>

<?php
function printcard($id,$db1){
   $tbl = "select * from nasdaq_data where nasdaq_data.Symbol = '$id' limit 1 ";
   $tbl1 = mysqli_query($db1,$tbl);
   if(mysqli_num_rows($tbl1) == 0){
    $tbl = "select * from nyse_data where nyse_data.Symbol = '$id' limit 1 ";
    $tbl1 = mysqli_query($db1,$tbl);
   }
   $rows = mysqli_fetch_assoc($tbl1);
   debug_to_console($rows["Name"]);
   echo '<p <span style = "color: black;"><strong> Name: </strong>'.$rows["Name"].'</span></p>'.
   '<p <span style = "color: black;"><strong> Last Sale: </strong>'.$rows["LastSale"].'</span></p>'.
   '<p <span style = "color: black;"><strong> Market Capacity: </strong>'.$rows["MarketCap"].'</span></p>'.
   '<p <span style = "color: black;"><strong> Address: </strong>' .$rows["ADR_TSO"].'</span></p>'.
   '<p <span style = "color: black;"><strong> IPO year: </strong>'.$rows["IPOyear"].'</span></p>'.
   '<p <span style = "color: black;"><strong> Sector: </strong>'.$rows["Sector"].'</span></p>'.
   '<p <span style = "color: black;"><strong>Industry: </strong>'.$rows["Industry"].'</span></p>';
}
 ?>


<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="../static/assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


</head>

<body>

  <div class="wrapper ">
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
      <a class="nav-link" href="#0"  data-image="../assets/img/vue.png">
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
        <a class="navbar-brand" href="dashboard.html">Dashboard</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">
        <form class="navbar-form" action="." method="POST">
          <div class="input-group no-border" style="visibility: hidden;">
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
  <?php
  $db1 = mysqli_connect("localhost","root","", "market") or die("could not connect to market Database");
   ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-GRAY card-header-icon">
              <div class="card-icon">
                <i class="fab fa-apple"></i>
              </div>
              <p>
                <button value="GOOG" type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <h7  class="card-category material-icons"> close </h7>
                </button>
              </p>
              <br/>
              <h3 class="card-title" id="APPL" name="AAPL">Apple</h3>
              <?php
              $id = 'AAPL';
               printcard($id,$db1);
            ?>
            </div>
            <div class="card-footer">

            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="fab fa-google"></i>
              </div>
              <p>
                <button value="" type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <h7  class="card-category material-icons"> close </h7>
                </button>
              </p>
              <br/>
              <h3 class="card-title" name="GOOGL">Google</h3>
              <?php
              $id = 'GOOGL';
               printcard($id,$db1);
            ?>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="fab fa-facebook"></i>
              </div>
              <p> <button value="" type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <h7  class="card-category material-icons"> close </h7>  </button> </p>
              <br/>
              <h3 class="card-title">Facebook</h3>
              <?php
              $id = 'FB';
               printcard($id,$db1);
            ?>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="fab fa-twitter"></i>
              </div>
              <p>  <button value="" type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <h7  class="card-category material-icons"> close </h7>  </button> </p>
              <br/>
              <h3 class="card-title">Twitter</h3>
              <?php
              $id = 'TWTR';
               printcard($id,$db1);
            ?>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
      </div>






  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
              <i class="fab fa-amazon"></i>
              </div>
              <p>
                <button value="GOOG" type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <h7  class="card-category material-icons"> close </h7>
                </button>
              </p>
              <br/>
              <h3 class="card-title">Amazon</h3>
              <?php
              $id = 'AMZN';
               printcard($id,$db1);
            ?>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="fa fa-car"></i>
              </div>
              <p>
                <button value="" type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <h7  class="card-category material-icons"> close </h7>
                </button>
              </p>
              <br/>
              <h3 class="card-title">Tesla</h3>
              <?php
              $id = 'TSLA';
               printcard($id,$db1);
            ?>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="fab fa-cc-visa"></i>
              </div>
              <p> <button value="" type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <h7  class="card-category material-icons"> close </h7>  </button> </p>
              <br/>
              <h3 class="card-title">VISA</h3>
              <?php
              $id = 'V';
               printcard($id,$db1);
            ?>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-rose card-header-icon">
              <div class="card-icon">
                <i class="fab fa-lyft"></i>
              </div>
              <p>  <button value="" type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <h7  class="card-category material-icons"> close </h7>  </button> </p>
              <br/>
              <h3 class="card-title">Lyft, Inc.</h3>
               <?php
                $id = 'LYFT';
                 printcard($id,$db1);
              ?>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="fab fa-spotify"></i>
              </div>
              <p>  <button value="" type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <h7  class="card-category material-icons"> close </h7>  </button> </p>
              <br/>
              <h3 class="card-title">Spotify</h3>
               <?php
                $id = 'SPOT';
                 printcard($id,$db1);
              ?>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="fab fa-microsoft"></i>
              </div>
              <p>  <button value="" type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <h7  class="card-category material-icons"> close </h7>  </button> </p>
              <br/>
              <h3 class="card-title">Microsoft</h3>
               <?php
                $id = 'MSFT';
                 printcard($id,$db1);
              ?>
          </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>






















    </div>
  </div>


















</div>
</div>











<?php
mysqli_close($db1); // Closing Connection with Server
?>

<!-- End Navbar -->
<footer class="footer">
  <div class="container-fluid">
    <nav class="float-left">

    </nav>
    <div class="copyright float-right">
      &copy;
      <script>
        document.write(new Date().getFullYear())
      </script>, made with <i class="material-icons">favorite</i> by
      <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
    </div>
  </div>
</footer>







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



$('.close').click(function(){
  var $target = $(this).parents('.card');
  $target.hide('slow', function(){ $target.remove(); });
})
</script>



</body>

</html>
