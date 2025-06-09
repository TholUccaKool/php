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
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/select2.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/sweetalert2.css">
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
      <div class="page-header">
        <div class="header-wrapper row m-0">
          <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
              <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative"> 
                  <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Riho .." name="q" title="" autofocus>
                  <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading... </span></div><i class="close-search" data-feather="x"></i>
                </div>
                <div class="Typeahead-menu"> </div>
              </div>
            </div>
          </form>
          <div class="header-logo-wrapper col-auto p-0">  
            <div class="logo-wrapper"> <a href="index.html"><img class="img-fluid for-light" src="assets/images/logo/logo_dark.png" alt="logo-light"><img class="img-fluid for-dark" src="assets/images/logo/logo.png" alt="logo-dark"></a></div>
            <div class="toggle-sidebar"> <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
          </div>
          <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
            <div> <a class="toggle-sidebar" href="#"> <i class="iconly-Category icli"> </i></a>
              <div class="d-flex align-items-center gap-2 ">
                <h4 class="f-w-600">Welcome Alex</h4><img class="mt-0" src="assets/images/hand.gif" alt="hand-gif">
              </div>
            </div>
            <div class="welcome-content d-xl-block d-none"><span class="text-truncate col-12">Here’s what’s happening with your store today. </span></div>
          </div>
          <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus"> 
              <li class="d-md-block d-none"> 
                <div class="form search-form mb-0">
                  <div class="input-group"><span class="input-icon">
                      <svg>
                        <use href="assets/svg/icon-sprite.svg#search-header"></use>
                      </svg>
                      <input class="w-100" type="search" placeholder="Search"></span></div>
                </div>
              </li>
              <li class="d-md-none d-block"> 
                <div class="form search-form mb-0">
                  <div class="input-group"> <span class="input-show"> 
                      <svg id="searchIcon">
                        <use href="assets/svg/icon-sprite.svg#search-header"></use>
                      </svg>
                      <div id="searchInput">
                        <input type="search" placeholder="Search">
                      </div></span></div>
                </div>
              </li>
              <li class="onhover-dropdown">
                <svg>
                  <use href="assets/svg/icon-sprite.svg#star"></use>
                </svg>
                <div class="onhover-show-div bookmark-flip">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="front">
                        <h6 class="f-18 mb-0 dropdown-title">Bookmark</h6>
                        <ul class="bookmark-dropdown">
                          <li>
                            <div class="row">
                              <div class="col-4 text-center">
                                <div class="bookmark-content">
                                  <div class="bookmark-icon"><i data-feather="file-text"></i></div><span>Forms</span>
                                </div>
                              </div>
                              <div class="col-4 text-center">
                                <div class="bookmark-content">
                                  <div class="bookmark-icon"><i data-feather="user"></i></div><span>Profile</span>
                                </div>
                              </div>
                              <div class="col-4 text-center">
                                <div class="bookmark-content">
                                  <div class="bookmark-icon"><i data-feather="server"></i></div><span>Tables</span>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="text-center"><a class="flip-btn f-w-700" id="flip-btn" href="javascript:void(0)">Add New Bookmark</a></li>
                        </ul>
                      </div>
                      <div class="back">
                        <ul>
                          <li>
                            <div class="bookmark-dropdown flip-back-content">
                              <input type="text" placeholder="search...">
                            </div>
                          </li>
                          <li><a class="f-w-700 d-block flip-back" id="flip-back" href="javascript:void(0)">Back</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li> 
                <div class="mode"><i class="moon" data-feather="moon"> </i></div>
              </li>
              <li class="onhover-dropdown notification-down">
                <div class="notification-box"> 
                  <svg> 
                    <use href="assets/svg/icon-sprite.svg#notification-header"></use>
                  </svg><span class="badge rounded-pill badge-secondary">4 </span>
                </div>
                <div class="onhover-show-div notification-dropdown"> 
                  <div class="card mb-0"> 
                    <div class="card-header">
                      <div class="common-space"> 
                        <h4 class="text-start f-w-600">Notitications</h4>
                        <div><span>4 New</span></div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="notitications-bar">
                        <ul class="nav nav-pills nav-primary p-0" id="pills-tab" role="tablist">
                          <li class="nav-item p-0"> <a class="nav-link active" id="pills-aboutus-tab" data-bs-toggle="pill" href="#pills-aboutus" role="tab" aria-controls="pills-aboutus" aria-selected="true">All(3)</a></li>
                          <li class="nav-item p-0"> <a class="nav-link" id="pills-blog-tab" data-bs-toggle="pill" href="#pills-blog" role="tab" aria-controls="pills-blog" aria-selected="false">
                               Messages</a></li>
                          <li class="nav-item p-0"> <a class="nav-link" id="pills-contactus-tab" data-bs-toggle="pill" href="#pills-contactus" role="tab" aria-controls="pills-contactus" aria-selected="false">
                               Cart  </a></li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="pills-aboutus" role="tabpanel" aria-labelledby="pills-aboutus-tab">
                            <div class="user-message"> 
                              <div class="cart-dropdown notification-all">
                                <ul>
                                  <li class="pr-0 pl-0 pb-3 pt-3">
                                    <div class="media"><img class="img-fluid b-r-5 me-3 img-60" src="assets/images/other-images/receiver-img.jpg" alt="">
                                      <div class="media-body"><a class="f-light f-w-500" href="template/product.html">Men Blue T-Shirt</a>
                                        <div class="qty-box"> 
                                          <div class="input-group"> <span class="input-group-prepend">
                                              <button class="btn quantity-left-minus" type="button" data-type="minus" data-field="">- </button></span>
                                            <input class="form-control input-number" type="text" name="quantity" value="1"><span class="input-group-prepend">
                                              <button class="btn quantity-right-plus" type="button" data-type="plus" data-field="">+</button></span>
                                          </div>
                                        </div>
                                        <h6 class="font-primary">$695.00</h6>
                                      </div>
                                      <div class="close-circle"><a class="bg-danger" href="#"><i data-feather="x"></i></a></div>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                              <ul> 
                                <li>
                                  <div class="user-alerts"><img class="user-image rounded-circle img-fluid me-2" src="assets/images/dashboard/user/5.jpg" alt="user"/>
                                    <div class="user-name">
                                      <div> 
                                        <h6><a class="f-w-500 f-14" href="template/user-profile.html">Floyd Miles</a></h6><span class="f-light f-w-500 f-12">Sir, Can i remove part in des...</span>
                                      </div>
                                      <div> 
                                        <svg>
                                          <use href="assets/svg/icon-sprite.svg#more-vertical"></use>
                                        </svg>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                                <li>
                                  <div class="user-alerts"><img class="user-image rounded-circle img-fluid me-2" src="assets/images/dashboard/user/6.jpg" alt="user"/>
                                    <div class="user-name">
                                      <div> 
                                        <h6><a class="f-w-500 f-14" href="template/user-profile.html">Dianne Russell</a></h6><span class="f-light f-w-500 f-12">So, what is my next work ?</span>
                                      </div>
                                      <div> 
                                        <svg>
                                          <use href="assets/svg/icon-sprite.svg#more-vertical"></use>
                                        </svg>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="pills-blog" role="tabpanel" aria-labelledby="pills-blog-tab">
                            <div class="notification-card"> 
                              <ul> 
                                <li class="notification d-flex w-100 justify-content-between align-items-center">
                                  <div class="d-flex w-100 notification-data justify-content-center align-items-center gap-2">
                                    <div class="user-alerts flex-shrink-0"><img class="rounded-circle img-fluid img-40" src="assets/images/dashboard/user/3.jpg" alt="user"/></div>
                                    <div class="flex-grow-1">
                                      <div class="common-space user-id w-100">
                                        <div class="common-space w-100"> <a class="f-w-500 f-12" href="template/private-chat.html">Robert D. Hambly</a></div>
                                      </div>
                                      <div><span class="f-w-500 f-light f-12">Hello Miss...😊</span></div>
                                    </div><span class="f-light f-w-500 f-12">44 sec</span>
                                  </div>
                                </li>
                                <li class="notification d-flex w-100 justify-content-between align-items-center">
                                  <div class="d-flex w-100 notification-data justify-content-center align-items-center gap-2">
                                    <div class="user-alerts flex-shrink-0"><img class="rounded-circle img-fluid img-40" src="assets/images/dashboard/user/7.jpg" alt="user"/></div>
                                    <div class="flex-grow-1">
                                      <div class="common-space user-id w-100">
                                        <div class="common-space w-100"> <a class="f-w-500 f-12" href="template/private-chat.html">Courtney C. Strang</a></div>
                                      </div>
                                      <div><span class="f-w-500 f-light f-12">Wishing You a Happy Birthday Dear.. 🥳🎊</span></div>
                                    </div><span class="f-light f-w-500 f-12">52 min</span>
                                  </div>
                                </li>
                                <li class="notification d-flex w-100 justify-content-between align-items-center">
                                  <div class="d-flex w-100 notification-data justify-content-center align-items-center gap-2">
                                    <div class="user-alerts flex-shrink-0"><img class="rounded-circle img-fluid img-40" src="assets/images/dashboard/user/5.jpg" alt="user"/></div>
                                    <div class="flex-grow-1">
                                      <div class="common-space user-id w-100">
                                        <div class="common-space w-100"> <a class="f-w-500 f-12" href="template/private-chat.html">Raye T. Sipes</a></div>
                                      </div>
                                      <div><span class="f-w-500 f-light f-12">Hello Dear!! This Theme Is Very beautiful</span></div>
                                    </div><span class="f-light f-w-500 f-12">48 min</span>
                                  </div>
                                </li>
                                <li class="notification d-flex w-100 justify-content-between align-items-center">
                                  <div class="d-flex w-100 notification-data justify-content-center align-items-center gap-2">
                                    <div class="user-alerts flex-shrink-0"><img class="rounded-circle img-fluid img-40" src="assets/images/dashboard/user/6.jpg" alt="user"/></div>
                                    <div class="flex-grow-1">
                                      <div class="common-space user-id w-100">
                                        <div class="common-space w-100"> <a class="f-w-500 f-12" href="template/private-chat.html">Henry S. Miller</a></div>
                                      </div>
                                      <div><span class="f-w-500 f-light f-12">You’re older today than yesterday, happy birthday!</span></div>
                                    </div><span class="f-light f-w-500 f-12">3 min</span>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="pills-contactus" role="tabpanel" aria-labelledby="pills-contactus-tab">
                            <div class="cart-dropdown mt-4"> 
                              <ul>
                                <li class="pr-0 pl-0 pb-3">
                                  <div class="media"><img class="img-fluid b-r-5 me-3 img-60" src="assets/images/other-images/cart-img.jpg" alt="">
                                    <div class="media-body"><a class="f-light f-w-500" href="template/product.html">Furniture Chair for Home</a>
                                      <div class="qty-box">
                                        <div class="input-group"> <span class="input-group-prepend">
                                            <button class="btn quantity-left-minus" type="button" data-type="minus" data-field="">-</button></span>
                                          <input class="form-control input-number" type="text" name="quantity" value="1"><span class="input-group-prepend">
                                            <button class="btn quantity-right-plus" type="button" data-type="plus" data-field="">+</button></span>
                                        </div>
                                      </div>
                                      <h6 class="font-primary">$500</h6>
                                    </div>
                                    <div class="close-circle"><a class="bg-danger" href="#"><i data-feather="x"></i></a></div>
                                  </div>
                                </li>
                                <li class="pr-0 pl-0 pb-3 pt-3">
                                  <div class="media"><img class="img-fluid b-r-5 me-3 img-60" src="assets/images/other-images/receiver-img.jpg" alt="">
                                    <div class="media-body"><a class="f-light f-w-500" href="template/product.html">Men Cotton Blend Blue T-Shirt</a>
                                      <div class="qty-box"> 
                                        <div class="input-group"> <span class="input-group-prepend">
                                            <button class="btn quantity-left-minus" type="button" data-type="minus" data-field="">- </button></span>
                                          <input class="form-control input-number" type="text" name="quantity" value="1"><span class="input-group-prepend">
                                            <button class="btn quantity-right-plus" type="button" data-type="plus" data-field="">+</button></span>
                                        </div>
                                      </div>
                                      <h6 class="font-primary">$695.00</h6>
                                    </div>
                                    <div class="close-circle"><a class="bg-danger" href="#"><i data-feather="x"></i></a></div>
                                  </div>
                                </li>
                                <li class="mb-3 total"><a href="template/checkout.html">
                                    <h6 class="mb-0">
                                       Order Total :<span class="f-right">$1195.00  </span></h6></a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="card-footer pb-0 pr-0 pl-0"> 
                            <div class="text-center"> <a class="f-w-700" href="private-chat.html">
                                <button class="btn btn-primary" type="button" title="btn btn-primary">Check all</button></a></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="profile-nav onhover-dropdown"> 
                <div class="media profile-media"><img class="b-r-10" src="assets/images/dashboard/profile.png" alt="">
                  <div class="media-body d-xxl-block d-none box-col-none">
                    <div class="d-flex align-items-center gap-2"> <span>Alex Mora </span><i class="middle fa fa-angle-down"> </i></div>
                    <p class="mb-0 font-roboto">Admin</p>
                  </div>
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <li><a href="user-profile.html"><i data-feather="user"></i><span>My Profile</span></a></li>
                  <li><a href="letter-box.html"><i data-feather="mail"></i><span>Inbox</span></a></li>
                  <li> <a href="edit-profile.html"> <i data-feather="settings"></i><span>Settings</span></a></li>
                  <li><a class="btn btn-pill btn-outline-primary btn-sm" href="login.html">Log Out</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details"> 
            <div class="ProfileCard-realName">{{name}}</div>
            </div> 
            </div>
          </script>
          <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
        </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper" data-layout="stroke-svg">
          <div class="logo-wrapper"><a href="index.html"><img class="img-fluid" src="assets/images/logo/logo.png" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
          </div>
          <!-- Interns to figure what the next line of code is -->
          <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="assets/images/logo/logo-icon.png" alt=""></a></div>
          <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
              <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn"><a href="index.html"><img class="img-fluid" src="assets/images/logo/logo-icon.png" alt=""></a>
                  <div class="mobile-back text-end"> <span>Back </span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                </li>

                <!-- Interns to figure out what the next <li> is -->
                <li class="pin-title sidebar-main-title">
                  <div> 
                    <h6>Pinned</h6>
                  </div>
                </li>

                <?php if (strtolower($userRole) === "admin"): ?>
                  <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="dashboard.php">
                    <svg class="stroke-icon">
                      <use href="assets/svg/icon-sprite.svg#stroke-file"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="../assets/svg/icon-sprite.svg#fill-file"></use>
                    </svg><span>Dashboard</span></a>
                  </li>

                  <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="projectcreate.php">
                    <svg class="stroke-icon">
                      <use href="assets/svg/icon-sprite.svg#stroke-file"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="../assets/svg/icon-sprite.svg#fill-file"></use>
                    </svg><span>Create Show</span></a>
                  </li>

                  <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="letter-box.php">
                    <svg class="stroke-icon">
                      <use href="assets/svg/icon-sprite.svg#stroke-file"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="assets/svg/icon-sprite.svg#fill-file"></use>
                    </svg><span>EDM</span></a>
                  </li>

                  <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="group-chat.php">
                    <svg class="stroke-icon">
                      <use href="assets/svg/icon-sprite.svg#stroke-file"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="../assets/svg/icon-sprite.svg#fill-file"></use>
                    </svg><span>WhatsApp</span></a>
                  </li>

                  <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="contacts.php">
                    <svg class="stroke-icon">
                      <use href="assets/svg/icon-sprite.svg#stroke-file"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="../assets/svg/icon-sprite.svg#fill-file"></use>
                    </svg><span>School Information</span></a>
                  </li>

                  <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="calendar-basic.php">
                    <svg class="stroke-icon">
                      <use href="assets/svg/icon-sprite.svg#stroke-file"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="../assets/svg/icon-sprite.svg#fill-file"></use>
                    </svg><span>Calendar</span></a>
                  </li>

                <?php elseif (strtolower($userRole) === "freelancer"): ?>
                  <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="projects.php">
                    <svg class="stroke-icon">
                      <use href="assets/svg/icon-sprite.svg#stroke-file"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="../assets/svg/icon-sprite.svg#fill-file"></use>
                    </svg><span>Dashboard</span></a>
                  </li>

                  <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="edit-profile.php">
                    <svg class="stroke-icon">
                      <use href="assets/svg/icon-sprite.svg#stroke-file"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="../assets/svg/icon-sprite.svg#fill-file"></use>
                    </svg><span>Settings</span></a>
                  </li>

                <?php elseif (strtolower($userRole) === "agency"): ?>

                <?php endif; ?>
                
                
              </ul>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </div>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Contacts</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Apps</li>
                    <li class="breadcrumb-item active">Contacts</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="email-wrap bookmark-wrap">
              <div class="row">
                <div class="col-xl-3 box-col-6">
                  <div class="md-sidebar"><a class="btn btn-primary md-sidebar-toggle" href="javascript:void(0)">contact filter</a>
                    <div class="md-sidebar-aside job-left-aside custom-scrollbar">
                      <div class="email-left-aside">
                        <div class="card">
                          <div class="card-body">
                            <div class="email-app-sidebar left-bookmark">
                              <div class="media">
                                <div class="media-size-email"><img class="me-3 rounded-circle" src="assets/images/user/user.png" alt=""></div>
                                <div class="media-body">
                                  <h6 class="f-w-600">MARK JENCO</h6>
                                  <p>Markjecno@gmail.com</p>
                                </div>
                              </div>
                              <ul class="nav main-menu contact-options" role="tablist">
                                <li class="nav-item">
                                  <button class="btn-primary btn-block btn-mail w-100" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="me-2" data-feather="users"></i> New Contacts</button>
                                  <div class="modal fade modal-bookmark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header"> 
                                          <h5 class="modal-title f-w-500" id="exampleModalLabel">Add Contact</h5>
                                          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                                            <div class="row g-2">
                                              <div class="mb-3 col-md-12 mt-0">
                                                <label for="con-name">Name</label>
                                                <div class="row">
                                                  <div class="col-sm-6">
                                                    <input class="form-control" id="con-name" type="text" required="" placeholder="First Name" autocomplete="off">
                                                  </div>
                                                  <div class="col-sm-6">   
                                                    <input class="form-control" id="con-last" type="text" required="" placeholder="Last Name" autocomplete="off">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="mb-3 col-md-12 mt-0">
                                                <label for="con-mail">Email Address</label>
                                                <input class="form-control" id="con-mail" type="text" required="" autocomplete="off">
                                              </div>
                                              <div class="mb-3 col-md-12 my-0">
                                                <label for="con-phone">Phone</label>
                                                <div class="row">
                                                  <div class="col-sm-6">
                                                    <input class="form-control" id="con-phone" type="number" required="" autocomplete="off">
                                                  </div>
                                                  <div class="col-sm-6">
                                                    <select class="form-control" id="con-select">
                                                      <option>Mobile</option>
                                                      <option>Work</option>
                                                      <option>Others</option>
                                                    </select>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <input id="index_var" type="hidden" value="5">
                                            <button class="btn btn-secondary" type="submit" onclick="submitContact()">Save</button>
                                            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                                <li class="nav-item"><span class="main-title f-w-600"> Views</span></li>
                                <li><a id="pills-personal-tab" data-bs-toggle="pill" href="#pills-personal" role="tab" aria-controls="pills-personal" aria-selected="true"><span class="title"> Personal</span></a></li>
                                <li>
                                  <button class="btn btn-category" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal1"><span class="title txt-primary f-w-600"> + Add Category</span></button>
                                  <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content"> 
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel1">Add Category</h5>
                                          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <form class="form-bookmark">
                                            <div class="row g-2">
                                              <div class="mb-3 col-md-12">
                                                <input class="form-control" type="text" required="" placeholder="Enter category name" autocomplete="off">
                                              </div>
                                            </div>
                                            <button class="btn btn-secondary" type="button">Save</button>
                                            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                                <li><a class="show" id="pills-organization-tab" data-bs-toggle="pill" href="#pills-organization" role="tab" aria-controls="pills-organization" aria-selected="false"><span class="title"> Organization</span></a></li>
                                <li><a href="#"><span class="title">Follow up</span></a></li>
                                <li><a href="#"><span class="title">Favorites</span></a></li>
                                <li><a href="#"><span class="title">Ideas</span></a></li>
                                <li><a href="#"><span class="title">Important</span></a></li>
                                <li><a href="#"><span class="title">Business</span></a></li>
                                <li><a href="#"><span class="title">Holidays</span></a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-9 col-md-12 box-col-12">
                  <div class="email-right-aside bookmark-tabcontent contacts-tabs">
                    <div class="card email-body radius-left dark-contact">
                      <div class="ps-0">
                        <div class="tab-content">
                          <div class="tab-pane fade active show" id="pills-personal" role="tabpanel" aria-labelledby="pills-personal-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h5 class="f-w-600">Personal</h5><span class="f-14 pull-right mt-0">5 Contacts</span>
                              </div>
                              <div class="card-body p-0"> 
                                <div class="row list-persons" id="addcon">
                                  <div class="col-xl-4 xl-50 col-md-5">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical"><a class="contact-tab-0 nav-link active" id="v-pills-user-tab" data-bs-toggle="pill" onclick="activeDiv(0)" href="#v-pills-user" role="tab" aria-controls="v-pills-user" aria-selected="true">
                                        <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle update_img_0" src="assets/images/user/2.png" alt="">
                                          <div class="media-body">
                                            <h6> <span class="first_name_0">Bucky </span><span class="last_name_0">Barnes</span></h6>
                                            <p class="email_add_0">barnes@gmail.com</p>
                                          </div>
                                        </div></a><a class="contact-tab-1 nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" onclick="activeDiv(1)" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"> 
                                        <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle update_img_1" src="assets/images/user/8.jpg" alt="">
                                          <div class="media-body">
                                            <h6> <span class="first_name_1">Comeren </span><span class="last_name_1">Diaz</span></h6>
                                            <p class="email_add_1">comeren@gmail.com</p>
                                          </div>
                                        </div></a><a class="contact-tab-2 nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" onclick="activeDiv(2)" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                        <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle update_img_2" src="assets/images/user/1.jpg" alt="">
                                          <div class="media-body">
                                            <h6> <span class="first_name_2">Issa </span><span class="last_name_2">Bell</span></h6>
                                            <p class="email_add_2">issabell@gmail.com</p>
                                          </div>
                                        </div></a><a class="contact-tab-3 nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" onclick="activeDiv(3)" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                        <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle update_img_3" src="assets/images/user/14.png" alt="">
                                          <div class="media-body">
                                            <h6> <span class="first_name_3">Andew </span><span class="last_name_3">Jon</span></h6>
                                            <p class="email_add_3">andewjon@gmail.com</p>
                                          </div>
                                        </div></a><a class="contact-tab-4 nav-link" id="v-pills-contact1-tab" data-bs-toggle="pill" onclick="activeDiv(4)" href="#v-pills-contact1" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                        <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle update_img_4" src="assets/images/user/5.jpg" alt="">
                                          <div class="media-body">
                                            <h6> <span class="first_name_4">Jason </span><span class="last_name_4">Borne</span></h6>
                                            <p class="email_add_4">jasonb@gmail.com</p>
                                          </div>
                                        </div></a><a class="contact-tab-5 nav-link" id="v-pills-contact8-tab" data-bs-toggle="pill" onclick="activeDiv(5)" href="#v-pills-contact2" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                        <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle update_img_5" src="assets/images/avtar/11.jpg" alt="">
                                          <div class="media-body">
                                            <h6> <span class="first_name_5">Monty </span><span class="last_name_5">Carlo</span></h6>
                                            <p class="email_add_5">monty@gmail.com</p>
                                          </div>
                                        </div></a><a class="contact-tab-6 nav-link" id="v-pills-contact3-tab" data-bs-toggle="pill" onclick="activeDiv(6)" href="#v-pills-contact3" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                        <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle update_img_6" src="assets/images/avtar/16.jpg" alt="">
                                          <div class="media-body">
                                            <h6> <span class="first_name_6">Brock </span><span class="last_name_6">Lee</span></h6>
                                            <p class="email_add_6">lee@gmail.com</p>
                                          </div>
                                        </div></a></div>
                                  </div>
                                  <div class="col-xl-8 xl-50 col-md-7">
                                    <div class="tab-content" id="v-pills-tabContent">
                                      <div class="tab-pane contact-tab-0 tab-content-child fade show active" id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-user-tab">
                                        <div class="profile-mail">
                                          <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_0" src="assets/images/user/2.png" alt="">
                                            <input class="updateimg" type="file" name="img" onchange="readURL(this,0)">
                                            <div class="media-body mt-0">
                                              <h5><span class="first_name_0">Bucky </span><span class="last_name_0">Barnes</span></h5>
                                              <p class="email_add_0">barnes@gmail.com</p>
                                              <ul>
                                                <li><a href="#" onclick="editContact(0)">Edit</a></li>
                                                <li><a href="#" onclick="deleteContact(0)">Delete</a></li>
                                                <li><a href="#" onclick="history(0)">History</a></li>
                                                <li><a href="#" onclick="printContact(0)" data-bs-toggle="modal" data-bs-target="#printModal">Print</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                          <div class="email-general">
                                            <h6 class="mb-3">General</h6>
                                            <ul>
                                              <li>Name <span class="font-primary first_name_0">Bucky</span></li>
                                              <li>Gender <span class="font-primary">Male</span></li>
                                              <li>Birthday<span class="font-primary"> <span class="birth_day_0">18</span><span class="birth_month_0 ms-1">May</span><span class="birth_year_0 ms-1">1994</span></span></li>
                                              <li>Personality<span class="font-primary personality_0">Cool</span></li>
                                              <li>City<span class="font-primary city_0">moline acres</span></li>
                                              <li>Mobile No<span class="font-primary mobile_num_0">+0 1800 76855</span></li>
                                              <li>Email Address <span class="font-primary email_add_0">barnes@gmail.com </span></li>
                                              <li>Website<span class="font-primary url_add_0">www.test.com</span></li>
                                              <li>Interest<span class="font-primary interest_0">photography</span></li>
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="tab-pane contact-tab-1 tab-content-child fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <div class="profile-mail">
                                          <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_1" src="assets/images/user/8.jpg" alt="">
                                            <input class="updateimg" type="file" name="img" onchange="readURL(this,1)">
                                            <div class="media-body mt-0">
                                              <h5><span class="first_name_1">Comeren </span><span class="last_name_1">Diaz</span></h5>
                                              <p class="email_add_1">comeren@gmail.com</p>
                                              <ul>
                                                <li><a href="#" onclick="editContact(1)">Edit</a></li>
                                                <li><a href="#" onclick="deleteContact(1)">Delete</a></li>
                                                <li><a href="#" onclick="history(1)">History</a></li>
                                                <li><a href="#" onclick="printContact(1)" data-bs-toggle="modal" data-bs-target="#printModal">Print</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                          <div class="email-general">
                                            <h6 class="mb-3">General</h6>
                                            <ul>
                                              <li>Name <span class="font-primary first_name_1">Comeren</span></li>
                                              <li>Gender <span class="font-primary">Female</span></li>
                                              <li>Birthday<span class="font-primary"> <span class="birth_day_1">7</span><span class="birth_month_1 ms-1">Feb</span><span class="birth_year_1 ms-1">1995</span></span></li>
                                              <li>Personality<span class="font-primary personality_1">Cool</span></li>
                                              <li>City<span class="font-primary city_1">Delhi</span></li>
                                              <li>Mobile No<span class="font-primary mobile_num_1">+0 1800 55812</span></li>
                                              <li>Email Address <span class="font-primary email_add_1">comeren@gmail.com</span></li>
                                              <li>Website<span class="font-primary url_add_1">www.cometest@.com</span></li>
                                              <li>Interest<span class="font-primary interest_1">sports</span></li>
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="tab-pane contact-tab-2 tab-content-child fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                        <div class="profile-mail">
                                          <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_2" src="assets/images/user/1.jpg" alt="">
                                            <input class="updateimg" type="file" name="img" onchange="readURL(this,2)">
                                            <div class="media-body mt-0">
                                              <h5> <span class="first_name_2">Issa </span><span class="last_name_2">Bell</span></h5>
                                              <p class="email_add_2">issabell@gmail.com</p>
                                              <ul>
                                                <li><a href="#" onclick="editContact(2)">Edit</a></li>
                                                <li><a href="#" onclick="deleteContact(2)">Delete</a></li>
                                                <li><a href="#" onclick="history(2)">History</a></li>
                                                <li><a href="#" onclick="printContact(2)" data-bs-toggle="modal" data-bs-target="#printModal">Print</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                          <div class="email-general">
                                            <h6 class="mb-3">General</h6>
                                            <ul>
                                              <li>Name <span class="font-primary first_name_2">Issa</span></li>
                                              <li>Gender <span class="font-primary">Male</span></li>
                                              <li>Birthday<span class="font-primary"> <span class="birth_day_2">20</span><span class="birth_month_2 ms-1">Jul</span><span class="birth_year_2 ms-1">1993</span></span></li>
                                              <li>Personality<span class="font-primary personality_2">Cool</span></li>
                                              <li>City<span class="font-primary city_2">Mumbai</span></li>
                                              <li>Mobile No<span class="font-primary mobile_num_2">+0 1800 87412</span></li>
                                              <li>Email Address <span class="font-primary email_add_2">issabell@gmail.com</span></li>
                                              <li>Website<span class="font-primary url_add_2">www.belltest@.com</span></li>
                                              <li>Interest<span class="font-primary interest_2">cooking</span></li>
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="tab-pane contact-tab-3 tab-content-child fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                        <div class="profile-mail">
                                          <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_3" src="assets/images/user/14.png" alt="">
                                            <input class="updateimg" type="file" name="img" onchange="readURL(this,3)">
                                            <div class="media-body mt-0">
                                              <h5> <span class="first_name_3">Andew </span><span class="last_name_3">Jon</span></h5>
                                              <p class="email_add_3">andewjon@gmail.com</p>
                                              <ul>
                                                <li><a href="#" onclick="editContact(3)">Edit</a></li>
                                                <li><a href="#" onclick="deleteContact(3)">Delete</a></li>
                                                <li><a href="#" onclick="history(3)">History</a></li>
                                                <li><a href="#" onclick="printContact(3)" data-bs-toggle="modal" data-bs-target="#printModal">Print</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                          <div class="email-general">
                                            <h6 class="mb-3">General</h6>
                                            <ul>
                                              <li>Name <span class="font-primary first_name_3">Andew</span></li>
                                              <li>Gender <span class="font-primary">Male</span></li>
                                              <li>Birthday<span class="font-primary"> <span class="birth_day_3">25</span><span class="birth_month_3 ms-1">Aug</span><span class="birth_year_3 ms-1">1996</span></span></li>
                                              <li>Personality<span class="font-primary personality_3">Cool</span></li>
                                              <li>City<span class="font-primary city_3">Amreli</span></li>
                                              <li>Mobile No<span class="font-primary mobile_num_3">+0 1800 79877</span></li>
                                              <li>Email Address <span class="font-primary email_add_3">andewjon@gmail.com</span></li>
                                              <li>Website<span class="font-primary url_add_3">www.test@.com</span></li>
                                              <li>Interest<span class="font-primary interest_3">photography</span></li>
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="tab-pane contact-tab-4 tab-content-child fade" id="v-pills-contact1" role="tabpanel" aria-labelledby="v-pills-contact1-tab">
                                        <div class="profile-mail">
                                          <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_4" src="assets/images/user/5.jpg" alt="">
                                            <input class="updateimg" type="file" name="img" onchange="readURL(this,4)">
                                            <div class="media-body mt-0">
                                              <h5> <span class="first_name_4">Jason </span><span class="last_name_4">Borne</span></h5>
                                              <p class="email_add_4">jasonb@gmail.com</p>
                                              <ul>
                                                <li><a href="#" onclick="editContact(4)">Edit</a></li>
                                                <li><a href="#" onclick="deleteContact(4)">Delete</a></li>
                                                <li><a href="#" onclick="history(4)">History</a></li>
                                                <li><a href="#" onclick="printContact(4)" data-bs-toggle="modal" data-bs-target="#printModal">Print</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                          <div class="email-general">
                                            <h6 class="mb-3">General</h6>
                                            <ul>
                                              <li>Name <span class="font-primary first_name_4">Jason</span></li>
                                              <li>Gender <span class="font-primary">Male</span></li>
                                              <li>Birthday<span class="font-primary"> <span class="birth_day_4">30</span><span class="birth_month_4 ms-1">Oct</span><span class="birth_year_4 ms-1">1992</span></span></li>
                                              <li>Personality<span class="font-primary personality_4">Cool</span></li>
                                              <li>City<span class="font-primary city_4">Delhi</span></li>
                                              <li>Mobile No<span class="font-primary mobile_num_4">+0 1800 11547</span></li>
                                              <li>Email Address <span class="font-primary email_add_4">jasonb@gmail.com</span></li>
                                              <li>Website<span class="font-primary url_add_4">www.jason@.com</span></li>
                                              <li>Interest<span class="font-primary interest_4">photography</span></li>
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="tab-pane contact-tab-5 tab-content-child fade" id="v-pills-contact8" role="tabpanel" aria-labelledby="v-pills-contact1-tab">
                                        <div class="profile-mail">
                                          <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_5" src="assets/images/avtar/11.jpg" alt="">
                                            <input class="updateimg" type="file" name="img" onchange="readURL(this,5)">
                                            <div class="media-body mt-0">
                                              <h5> <span class="first_name_5">Monty  </span><span class="last_name_5">Carlo</span></h5>
                                              <p class="email_add_5">monty@gmail.com</p>
                                              <ul>
                                                <li><a href="#" onclick="editContact(5)">Edit</a></li>
                                                <li><a href="#" onclick="deleteContact(5)">Delete</a></li>
                                                <li><a href="#" onclick="history(5)">History</a></li>
                                                <li><a href="#" onclick="printContact(5)" data-bs-toggle="modal" data-bs-target="#printModal">Print</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                          <div class="email-general">
                                            <h6 class="mb-3">General</h6>
                                            <ul>
                                              <li>Name <span class="font-primary first_name_5">Monty</span></li>
                                              <li>Gender <span class="font-primary">Male</span></li>
                                              <li>Birthday<span class="font-primary"> <span class="birth_day_5">12</span><span class="birth_month_5 ms-1">Nov</span><span class="birth_year_5 ms-1">1994</span></span></li>
                                              <li>Personality<span class="font-primary personality_5">Cool</span></li>
                                              <li>City<span class="font-primary city_5">Amreli</span></li>
                                              <li>Mobile No<span class="font-primary mobile_num_5">+0 1800 87944</span></li>
                                              <li>Email Address <span class="font-primary email_add_5">monty@gmail.com</span></li>
                                              <li>Website<span class="font-primary url_add_5">www.mon@.com</span></li>
                                              <li>Interest<span class="font-primary interest_5">sports</span></li>
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="tab-pane contact-tab-6 tab-content-child fade" id="v-pills-contact9" role="tabpanel" aria-labelledby="v-pills-contact8-tab">
                                        <div class="profile-mail">
                                          <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_6" src="assets/images/avtar/16.jpg" alt="">
                                            <input class="updateimg" type="file" name="img" onchange="readURL(this,6)">
                                            <div class="media-body mt-0">
                                              <h5> <span class="first_name_6">Brock </span><span class="last_name_6">Lee</span></h5>
                                              <p class="email_add_6">lee@gmail.com</p>
                                              <ul>
                                                <li><a href="#" onclick="editContact(6)">Edit</a></li>
                                                <li><a href="#" onclick="deleteContact(6)">Delete</a></li>
                                                <li><a href="#" onclick="history(6)">History</a></li>
                                                <li><a href="#" onclick="printContact(6)" data-bs-toggle="modal" data-bs-target="#printModal">Print</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                          <div class="email-general">
                                            <h6 class="mb-3">General</h6>
                                            <ul>
                                              <li>Name <span class="font-primary first_name_6">Brock</span></li>
                                              <li>Gender <span class="font-primary">Male</span></li>
                                              <li>Birthday<span class="font-primary"> <span class="birth_day_6">8</span><span class="birth_month_6 ms-1">Dec</span><span class="birth_year_6 ms-1">1992</span></span></li>
                                              <li>Personality<span class="font-primary personality_6">Cool</span></li>
                                              <li>City<span class="font-primary city_6">Ahemdabad</span></li>
                                              <li>Mobile No<span class="font-primary mobile_num_6">+0 1800 58712</span></li>
                                              <li>Email Address <span class="font-primary email_add_6">lee@gmail.com</span></li>
                                              <li>Website<span class="font-primary url_add_6">www.lee.com</span></li>
                                              <li>Interest<span class="font-primary interest_6">photography             </span></li>
                                            </ul>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="contact-editform ps-0">
                                      <form>
                                        <div class="row g-2">
                                          <div class="mt-0 mb-3 col-md-12">
                                            <label>Name</label>
                                            <div class="row">
                                              <div class="col-sm-6">
                                                <input class="form-control" id="first_name" type="text" required="" placeholder="First Name" value="first_name">
                                              </div>
                                              <div class="col-sm-6">   
                                                <input class="form-control" id="last_name" type="text" required="" placeholder="Last Name" value="last_name">
                                              </div>
                                            </div>
                                          </div>
                                          <div class="mt-0 mb-3 col-md-12">
                                            <label>Email Address</label>
                                            <input class="form-control" id="email_add" type="text" required="" autocomplete="off">
                                          </div>
                                          <div class="mt-0 mb-3 col-md-12">
                                            <label>Phone</label>
                                            <div class="row">
                                              <div class="col-sm-6">
                                                <input class="form-control" id="mobile_num" type="number" required="" autocomplete="off">
                                              </div>
                                              <div class="col-sm-6"> 
                                                <select class="form-control"> 
                                                  <option>Mobile</option>
                                                  <option>Work </option>
                                                  <option>Others </option>
                                                </select>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row g-2 more-data"> 
                                          <div class="mt-0 mb-3 col-md-12">
                                            <label>URLS</label>
                                            <div class="row">
                                              <div class="col-lg-6 col-sm-6">
                                                <input class="form-control" id="url_add" type="text" required="">
                                              </div>
                                              <div class="col-lg-4 col-sm-6">   
                                                <select class="js-example-basic-single">
                                                  <option value="pw">Personal web address</option>
                                                  <option value="cw">Company web address</option>
                                                  <option value="fb">Fabebook URL</option>
                                                  <option value="tw">Twitter URL</option>
                                                </select>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="mt-0 mb-3 col-md-12">
                                            <label>Personal</label>
                                            <div class="d-block">
                                              <label class="me-3" for="edo-ani">
                                                <input class="radio_animated" id="edo-ani" type="radio" name="rdo-ani" checked=""><span>Male</span>
                                              </label>
                                              <label for="edo-ani1">
                                                <input class="radio_animated" id="edo-ani1" type="radio" name="rdo-ani"><span>Female</span>
                                              </label>
                                            </div>
                                          </div>
                                          <div class="mt-0 mb-3 col-md-12">
                                            <div class="row">
                                              <div class="col-lg-2 col-sm-4">
                                                <select class="form-control" id="birth_day">
                                                  <option class="f-w-600">Day</option>
                                                  <option>01</option>
                                                  <option>02</option>
                                                  <option>03</option>
                                                  <option>04</option>
                                                  <option>05</option>
                                                  <option>06</option>
                                                  <option>07</option>
                                                  <option>08</option>
                                                  <option>09</option>
                                                  <option>10</option>
                                                  <option>11</option>
                                                  <option>12</option>
                                                  <option>13</option>
                                                  <option>14</option>
                                                  <option>15</option>
                                                  <option>16</option>
                                                  <option>17</option>
                                                  <option>18</option>
                                                  <option>19</option>
                                                  <option>20</option>
                                                  <option>21</option>
                                                  <option>22</option>
                                                  <option>23</option>
                                                  <option>24</option>
                                                  <option>25</option>
                                                  <option>26</option>
                                                  <option>27</option>
                                                  <option>28</option>
                                                  <option>29</option>
                                                  <option>30</option>
                                                  <option>31</option>
                                                </select>
                                              </div>
                                              <div class="col-lg-3 col-sm-4">
                                                <select class="form-control" id="birth_month">
                                                  <option class="f-w-600">Month</option>
                                                  <option>January</option>
                                                  <option>February</option>
                                                  <option>March</option>
                                                  <option>April</option>
                                                  <option>May</option>
                                                  <option>June</option>
                                                  <option>July</option>
                                                  <option>August</option>
                                                  <option>September</option>
                                                  <option>October</option>
                                                  <option>November</option>
                                                  <option>December</option>
                                                </select>
                                              </div>
                                              <div class="col-lg-3 col-sm-4">
                                                <input class="form-control" id="birth_year" type="text">
                                              </div>
                                            </div>
                                          </div>
                                          <div class="mt-0 mb-3 col-md-12">
                                            <div class="row">
                                              <div class="col-sm-6">
                                                <label>Personality</label>
                                                <input class="form-control" id="personality" type="text" required="" autocomplete="off">
                                              </div>
                                              <div class="col-sm-6">
                                                <label>Interest</label>
                                                <input class="form-control" id="interest" type="text" required="" autocomplete="off">
                                              </div>
                                            </div>
                                          </div>
                                          <div class="mb-3 col-md-12">
                                            <label>Home Address</label>
                                            <div class="row">
                                              <div class="col-12">
                                                <div class="mb-2">
                                                  <input class="form-control" type="text" placeholder="Address">
                                                </div>
                                              </div>
                                              <div class="col-sm-6">
                                                <div class="mb-2">
                                                  <input class="form-control" id="city" type="text" placeholder="City">
                                                </div>
                                              </div>
                                              <div class="col-sm-6">
                                                <div class="mb-2">
                                                  <input class="form-control" type="text" placeholder="State">
                                                </div>
                                              </div>
                                              <div class="col-sm-6">
                                                <div>
                                                  <input class="form-control" type="text" placeholder="Country">
                                                </div>
                                              </div>
                                              <div class="col-sm-6">
                                                <div>
                                                  <input class="form-control" type="text" placeholder="Pin Code">
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div><a class="ps-0 edit-information" href="#">Edit more information</a>
                                        <button class="btn btn-secondary update-contact" type="button">Save</button>
                                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="fade tab-pane" id="pills-organization" role="tabpanel" aria-labelledby="pills-organization">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h5>Organization</h5><span class="f-14 pull-right mt-0">10 Contacts</span>
                              </div>
                              <div class="card-body p-0">
                                <div class="row list-persons">
                                  <div class="col-xl-4 xl-50 col-md-5">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab1" role="tablist" aria-orientation="vertical"><a class="nav-link active" id="v-pills-iduser-tab" data-bs-toggle="pill" href="#v-pills-iduser" role="tab" aria-controls="v-pills-iduser" aria-selected="true">
                                        <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" src="assets/images/user/user.png" alt="">
                                          <div class="media-body">
                                            <h6 class="f-w-600">Mark jecno</h6>
                                            <p>markjecno@gmail.com </p>
                                          </div>
                                        </div></a><a class="nav-link" id="v-pills-iduser1-tab" data-bs-toggle="pill" href="#v-pills-iduser1" role="tab" aria-controls="v-pills-iduser1" aria-selected="false"> 
                                        <div class="media"> <img class="img-50 img-fluid m-r-20 rounded-circle" src="assets/images/user/3.jpg" alt="">
                                          <div class="media-body">
                                            <h6>Jason Borne</h6>
                                            <p>jasonb@gmail.com</p>
                                          </div>
                                        </div></a><a class="nav-link" id="v-pills-iduser2-tab" data-bs-toggle="pill" href="#v-pills-iduser2" role="tab" aria-controls="v-pills-iduser2" aria-selected="false">
                                        <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" src="assets/images/user/4.jpg" alt="">
                                          <div class="media-body">
                                            <h6>Sarah Loren</h6>
                                            <p>barnes@gmail.com</p>
                                          </div>
                                        </div></a><a class="nav-link" id="v-pills-iduser3-tab" data-bs-toggle="pill" href="#v-pills-iduser3" role="tab" aria-controls="v-pills-iduser3" aria-selected="false">
                                        <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" src="assets/images/user/10.jpg" alt="">
                                          <div class="media-body">
                                            <h6>Andew Jon</h6>
                                            <p>andrewj@gmail.com</p>
                                          </div>
                                        </div></a></div>
                                  </div>
                                  <div class="col-xl-8 xl-50 col-md-7">
                                    <div class="tab-content" id="v-pills-tabContent1">
                                      <div class="tab-pane fade show active" id="v-pills-iduser" role="tabpanel" aria-labelledby="v-pills-iduser-tab">
                                        <div class="profile-mail">
                                          <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_5" src="assets/images/user/user.png" alt="">
                                            <div class="media-body mt-0">
                                              <h5><span class="first_name_5">Mark </span><span class="last_name_5">jecno</span></h5>
                                              <p class="email_add_5">markjecno@gmail.com</p>
                                              <ul>
                                                <li><a href="#" onclick="printContact(5)" data-bs-toggle="modal" data-bs-target="#printModal">Print</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                          <div class="email-general">
                                            <h6>General</h6>
                                            <p>Email Address: <span class="font-primary email_add_5">markjecno@gmail.com</span></p>
                                            <div class="gender">
                                              <h6>Personal</h6>
                                              <p>Gender: <span>Male</span></p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="tab-pane fade" id="v-pills-iduser1" role="tabpanel" aria-labelledby="v-pills-iduser1-tab">
                                        <div class="profile-mail">
                                          <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_6" src="assets/images/user/3.jpg" alt="">
                                            <div class="media-body mt-0">
                                              <h5><span class="first_name_6">Jason </span><span class="last_name_6">Borne</span></h5>
                                              <p class="email_add_6">jasonb@gmail.com</p>
                                              <ul>
                                                <li><a href="#" onclick="printContact(6)" data-bs-toggle="modal" data-bs-target="#printModal">Print</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                          <div class="email-general">
                                            <h6>General</h6>
                                            <p>Email Address: <span class="font-primary email_add_6">jasonb@gmail.com</span></p>
                                            <div class="gender">
                                              <h6>Personal</h6>
                                              <p>Gender: <span>Male</span></p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="tab-pane fade" id="v-pills-iduser2" role="tabpanel" aria-labelledby="v-pills-iduser2-tab">
                                        <div class="profile-mail">
                                          <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_7" src="assets/images/user/4.jpg" alt="">
                                            <div class="media-body mt-0">
                                              <h5> <span class="first_name_7">Sarah </span><span class="last_name_7">Loren</span></h5>
                                              <p class="email_add_7">barnes@gmail.com</p>
                                              <ul>
                                                <li><a href="#" onclick="printContact(7)" data-bs-toggle="modal" data-bs-target="#printModal">Print</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                          <div class="email-general">
                                            <h6>General</h6>
                                            <p>Email Address: <span class="font-primary email_add_7">barnes@gmail.com</span></p>
                                            <div class="gender">
                                              <h6>Personal</h6>
                                              <p>Gender: <span>Female</span></p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="tab-pane fade" id="v-pills-iduser3" role="tabpanel" aria-labelledby="v-pills-iduser3-tab">
                                        <div class="profile-mail">
                                          <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_8" src="assets/images/user/10.jpg" alt="">
                                            <div class="media-body mt-0">
                                              <h5> <span class="first_name_8">Andew </span><span class="last_name_8">Jon</span></h5>
                                              <p class="email_add_8">andrewj@gmail.com</p>
                                              <ul>
                                                <li><a href="#" onclick="printContact(8)" data-bs-toggle="modal" data-bs-target="#printModal">Print</a></li>
                                              </ul>
                                            </div>
                                          </div>
                                          <div class="email-general">
                                            <h6>General</h6>
                                            <p>Email Address: <span class="font-primary email_add_8">andrewj@gmail.com</span></p>
                                            <div class="gender">
                                              <h6>Personal</h6>
                                              <p>Gender: <span>Female</span></p>
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
                          <div id="right-history">
                            <div class="modal-header p-20">
                              <h6 class="modal-title w-100">Contact History<span class="pull-right"><a class="closehistory" href="#"><i class="icofont icofont-close"></i></a></span></h6>
                            </div>
                            <div class="history-details">
                              <div class="text-center"><i class="icofont icofont-ui-edit"> </i>
                                <p>Contact has not been modified yet.</p>
                              </div>
                              <div class="media"> <i class="icofont icofont-star me-3"></i>
                                <div class="media-body mt-0"> 
                                  <h6 class="mt-0">Contact Created</h6>
                                  <p class="mb-0">Contact is created via mail </p><span class="f-12">Sep 10, 2019 4:00</span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal fade modal-bookmark" id="printModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content"> 
                                <div class="modal-header">
                                  <h5 class="modal-title">Print preview</h5>
                                  <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body list-persons"> 
                                  <div class="profile-mail pt-0" id="DivIdToPrint">
                                    <div class="media"> <img class="img-50 img-fluid m-r-20 rounded-circle" id="updateimg" src="assets/images/user/2.png" alt="">
                                      <div class="media-body mt-0">
                                        <h5> <span id="printname">Bucky</span><span id="printlast">Barnes </span></h5>
                                        <p id="printmail">barnes@gmail.com</p>
                                      </div>
                                    </div>
                                    <div class="email-general">
                                      <h6>General</h6>
                                      <p>Email Address: <span class="font-primary" id="mailadd">barnes@gmail.com   </span></p>
                                    </div>
                                  </div>
                                  <button class="btn btn-secondary" id="btnPrint" type="button" onclick="printDiv();">Print</button>
                                  <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
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
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">Copyright 2024 © Riho theme by pixelstrap  </p>
              </div>
            </div>
          </div>
        </footer>
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
    <script src="assets/js/notify/bootstrap-notify.min.js"></script>
    <!-- calendar js-->
    <script src="assets/js/sweet-alert/sweetalert.min.js"></script>
    <script src="assets/js/select2/select2.full.min.js"></script>
    <script src="assets/js/select2/select2-custom.js"></script>
    <script src="assets/js/form-validation-custom.js"></script>
    <script src="assets/js/bookmark/jquery.validate.min.js"></script>
    <script src="assets/js/contacts/custom.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <script src="assets/js/theme-customizer/customizer.js"></script>
  </body>
</html>