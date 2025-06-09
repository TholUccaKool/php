<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['UserID']) || !isset($_SESSION['UserRole'])) {
    header("Location: login.php");
    exit();
}

// Assign session variables to local variables
$userID = $_SESSION['UserID'];
$userRole = $_SESSION['UserRole'];
$userEmail = isset($_SESSION['UserEmail']) ? $_SESSION['UserEmail'] : '(Email not tracked)';

// Handle sidebar clicks to update the session
if (isset($_GET['page'])) {
    if ($_GET['page'] == 'view_booking') {
        $_SESSION['ShowDashboard'] = 'ViewBooking';
    } elseif ($_GET['page'] == 'home') {
        $_SESSION['ShowDashboard'] = 'Dashboard';
    }
} elseif (!isset($_SESSION['ShowDashboard'])) {
    $_SESSION['ShowDashboard'] = 'Dashboard';
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Riho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Riho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>Riho - Premium Admin Template</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/echart.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/date-picker.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
  </head>
  <body> 
    <!-- loader starts-->
    <div class="loader-wrapper">
      <div class="loader"> 
        <div class="loader4"></div>
      </div>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
      
        <!-- Page Sidebar Ends-->
        
          <!-- Container-fluid starts-->
          <div class="container-fluid"> 
            <div class="row size-column">
              <!-- This is where you start putting in your content-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body email-verify">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <div class="card-wrapper border rounded-3 h-100">
                          <div class="row g-1"> 
                            <div class="col-xxl-4 box-col-5">
                              <div class="authenticate"><img class="img-fluid" src="assets/images/forms/email.png" alt=""></div>
                            </div>
                            <div class="col-xxl-12 box-col-7">
                              <h4>Email verification</h4>
                              <p>A verification code has been sent to your email. This code will be valid for 15 minutes.</p>
                              <div class="input-group mb-3">
                                <input class="form-control" type="text" placeholder="Please enter the code here" aria-label="basic-addon2" aria-describedby="basic-addon2"><span class="input-group-text bg-primary" id="basic-addon2">Verify</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="card-wrapper border rounded-3 h-100">
                          <div class="authenticate">
                            <h4>Verification code</h4><img class="img-fluid" src="assets/images/forms/authenticate.png" alt="authenticate"><span>We've sent a verification code to</span><span>+91********70</span>
                            <form class="row">
                              <div class="col"> 
                                <h5>Your OTP Code here:</h5>
                              </div>
                              <div class="col otp-generate">
                                <input class="form-control code-input" type="text" maxlength="1" pattern="[0-9]" required>
                                <input class="form-control code-input" type="text" maxlength="1" pattern="[0-9]" required>
                                <input class="form-control code-input" type="text" maxlength="1" pattern="[0-9]" required>
                                <input class="form-control code-input" type="text" maxlength="1" pattern="[0-9]" required>
                                <input class="form-control code-input" type="text" maxlength="1" pattern="[0-9]" required>
                                <input class="form-control code-input" type="text" maxlength="1" pattern="[0-9]" required>
                              </div>
                              <div class="col"> 
                                <button class="btn btn-primary w-100" type="submit">Verify</button>
                              </div>
                              <div> <span>Not received your code?</span><span><a href="javascript:void(0)">Resend </a>OR <a href="javascript:void(0)">Call  </a></span></div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- and this is the last line of your content-->
            </div>
          </div>
          <!-- Container-fluid Ends-->
        
        <!-- footer start-->
        
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">Copyright 2024 © Riho theme by pixelstrap  </p>
              </div>
            </div>
          </div>
        
      </div>
    </div>
    <!-- latest jquery-->
    <script src="assets/js/jquery.min.js"></script>
    <!-- Bootstrap js-->
    <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="assets/js/scrollbar/simplebar.js"></script>
    <script src="assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="assets/js/sidebar-menu.js"></script>
    <script src="assets/js/sidebar-pin.js"></script>
    <script src="assets/js/slick/slick.min.js"></script>
    <script src="assets/js/slick/slick.js"></script>
    <script src="assets/js/header-slick.js"></script>
    <script src="assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="assets/js/chart/apex-chart/moment.min.js"></script>
    <script src="assets/js/chart/echart/esl.js"></script>
    <script src="assets/js/chart/echart/config.js"></script>
    <script src="assets/js/chart/echart/pie-chart/facePrint.js"></script>
    <script src="assets/js/chart/echart/pie-chart/testHelper.js"></script>
    <script src="assets/js/chart/echart/pie-chart/custom-transition-texture.js"></script>
    <script src="assets/js/chart/echart/data/symbols.js"></script>
    <!-- calendar js-->
    <script src="assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="assets/js/datepicker/date-picker/datepicker.custom.js"></script>
    <script src="assets/js/dashboard/dashboard_3.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <!-- <script src="assets/js/theme-customizer/customizer.js"></script> -->
  </body>
</html>