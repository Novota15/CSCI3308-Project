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
   $tbl = "select * from nasdaq_data where Symbol = '$id' limit 1 ";
   $tbl1 = mysqli_query($db1,$tbl);
   $rows = mysqli_fetch_assoc($tbl1);
   echo '<p <span style = "color: black;"> Name:'.$rows["Name"].'</span></p>'.
   '<p <span style = "color: black;"> Last Sale:'.$rows["LastSale"].'</span></p>'.
   '<p <span style = "color: black;"> Market Capacity:'.$rows["MarketCap"].'</span></p>'.
   '<p <span style = "color: black;"> Address:' .$rows["ADR_TSO"].'</span></p>'.
   '<p <span style = "color: black;">IPO year:'.$rows["IPOyear"].'</span></p>'.
   '<p <span style = "color: black;"> Sector: '.$rows["Sector"].'</span></p>'.
   '<p <span style = "color: black;">Industry: '.$rows["Industry"].'</span></p>'.
   '<p <span style = "color: black;">Summary Qoute: '.$rows["Summary_Quote"].'</span></p>';
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




    <li class=" active nav-item dropdown">
      <a class="nav-link" href="#0" id="navbarDropdownMenuLink" >
        <i class="material-icons">settings</i>

        <span class="notification" >Settings</span>
        <div  >
          <a class="dropdown-item1" style="display: none;" >
            <form>
              Start Date
              <input type="text">  </input>

            </form>
            End Date <input type="text">  </input>
          </a>
          <a class="dropdown-item1" style="display: none;" >
            <form>
              Start Date
              <input type="text">  </input>

            </form>
            End Date <input type="text">  </input>
          </a>


        </div>
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
              <a class="dropdown-item" href="profile.html">Profile</a>
              <a class="dropdown-item" href="settings.html">Account Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="" >Log out</a>
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
                <i class="fa fa-apple"></i>
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
                <i class="fa fa-google"></i>
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
                <i class="fa fa-facebook"></i>
              </div>
              <p> <button value="" type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <h7  class="card-category material-icons"> close </h7>  </button> </p>
              <br/>
              <h3 class="card-title">Facebook</h3>
              <?php
              $id = 'GOOG';
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
                <i class="fa fa-amazon"></i>
              </div>
              <p>  <button value="" type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <h7  class="card-category material-icons"> close </h7>  </button> </p>
              <br/>
              <h3 class="card-title">Amazon</h3>
              <?php
              $id = 'GOOG';
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
            <div class="card-header card-header-GRAY card-header-icon">
              <div class="card-icon">
                 <img src="../static/assets/img/sony.png" style =" width: 55px; height: 55px;"></img>

              </div>
              <p>
                <button value="GOOG" type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <h7  class="card-category material-icons"> close </h7>
                </button>
              </p>
              <br/>
              <h3 class="card-title">Sony</h3>
              <?php
              $id = 'GOOG';
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
              $id = 'GOOG';
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
                <i class="fa fa-facebook"></i>
              </div>
              <p> <button value="" type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <h7  class="card-category material-icons"> close </h7>  </button> </p>
              <br/>
              <h3 class="card-title">Facebook</h3>
              <?php
              $id = 'GOOG';
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
                <i class="fa fa-amazon"></i>
              </div>
              <p>  <button value="" type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <h7  class="card-category material-icons"> close </h7>  </button> </p>
              <br/>
              <h3 class="card-title">Amazon</h3>
               <?php
                $id = 'GOOG';
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
