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
    <div class="page-wrapper default-wrapper" id="pageWrapper">
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
      <div class="page-body-wrapper default-menu default-menu">
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
                  <h4>Project List </h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Project</li>
                    <li class="breadcrumb-item active">Project List</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid"> 
            <div class="row project-cards">
              <div class="col-md-12 project-list">
                <div class="card">
                  <div class="row">
                    <div class="col-md-6">
                      <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i data-feather="target"></i>All</a></li>
                        <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"><i data-feather="info"></i>Doing</a></li>
                        <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><i data-feather="check-circle"></i>Done</a></li>
                      </ul>
                    </div>
                    <div class="col-md-6">                    
                      <div class="form-group mb-0 me-0"></div><a class="btn btn-primary" href="projectcreate.html"> <i data-feather="plus-square"> </i>Create New Project</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="tab-content" id="top-tabContent">
                      <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                        <div class="row">
                          <div class="col-xxl-4 col-lg-6 box-col-6"> 
                            <div class="project-box b-light1-primary"> <span class="badge badge-primary">Doing</span>
                              <h5 class="f-w-500">Endless admin Design</h5>
                              <div class="d-flex"><img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1">
                                  <p>Themeforest, australia </p>
                                </div>
                              </div>
                              <p>Endless Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details"> 
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 font-primary">12 </div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 font-primary">5</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 font-primary">7</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+10 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>70% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width: 70%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-4 col-lg-6 box-col-6"> 
                            <div class="project-box b-light1-success"><span class="badge badge-success">Done</span>
                              <h5 class="f-w-500">Universal admin Design </h5>
                              <div class="d-flex"> <img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1"> 
                                  <p>Envato, australia</p>
                                </div>
                              </div>
                              <p>Universal Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details">
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 text-success">24</div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 text-success">24</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 text-success">40</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+3 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>100% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-success" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-4 col-lg-6 box-col-6"> 
                            <div class="project-box b-light1-success"><span class="badge badge-success">Done</span>
                              <h5 class="f-w-500">Poco admin Design</h5>
                              <div class="d-flex"><img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1">
                                  <p>Envato, australia</p>
                                </div>
                              </div>
                              <p>Poco Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details">
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 text-success">40</div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 text-success">40</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 text-success">20</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+2 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>100% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-success" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-4 col-lg-6 box-col-6">
                            <div class="project-box b-light1-success"><span class="badge badge-success">Done</span>
                              <h5 class="f-w-500">Universal admin Design</h5>
                              <div class="d-flex"><img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1">
                                  <p>Envato, australia</p>
                                </div>
                              </div>
                              <p>Universal Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details">
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 text-success">24</div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 text-success">24</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 text-success">40</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+3 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>100% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-success" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-4 col-lg-6 box-col-6">
                            <div class="project-box b-light1-primary"><span class="badge badge-primary">Doing</span>
                              <h5 class="f-w-500">Zeta admin Design</h5>
                              <div class="d-flex"><img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1">
                                  <p>Themeforest, australia</p>
                                </div>
                              </div>
                              <p>Zeta Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details">
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 font-primary">12 </div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 font-primary">5</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 font-primary">7</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+10 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>70% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width: 70%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-4 col-lg-6 box-col-6"> 
                            <div class="project-box b-light1-success"><span class="badge badge-success">Done</span>
                              <h5 class="f-w-500">Poco admin Design</h5>
                              <div class="d-flex"><img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1">
                                  <p>Envato, australia</p>
                                </div>
                              </div>
                              <p>Poco Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details">
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 text-success">40</div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 text-success">40</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 text-success">20</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+2 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>100% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-success" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                        <div class="row">
                          <div class="col-xxl-4 col-lg-6 box-col-6"> 
                            <div class="project-box b-light1-primary"><span class="badge badge-primary">Doing</span>
                              <h5 class="f-w-500">Endless admin Design</h5>
                              <div class="d-flex"><img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1">
                                  <p>Themeforest, australia</p>
                                </div>
                              </div>
                              <p>Endless Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details">
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 font-primary">12 </div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 font-primary">5</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 font-primary">7</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+10 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>70% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width: 70%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-4 col-lg-6 box-col-6">
                            <div class="project-box b-light1-primary"><span class="badge badge-primary">Doing</span>
                              <h5 class="f-w-500">Universal admin Design</h5>
                              <div class="d-flex"> <img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1">
                                  <p>Envato, australia</p>
                                </div>
                              </div>
                              <p>Universal Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details">
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 font-primary">24</div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 font-primary">24</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 font-primary">40</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+3 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>100% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-primary" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-4 col-lg-6 box-col-6"> 
                            <div class="project-box b-light1-primary"><span class="badge badge-primary">Doing</span>
                              <h5 class="f-w-500">Poco admin Design</h5>
                              <div class="d-flex"><img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1">
                                  <p>Envato, australia</p>
                                </div>
                              </div>
                              <p>poco Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details">
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 font-primary">40</div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 font-primary">40</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 font-primary">20</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+2 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>100% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-primary" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-4 col-lg-6 box-col-6"> 
                            <div class="project-box b-light1-primary"><span class="badge badge-primary">Doing</span>
                              <h5 class="f-w-500">Tivo admin Design</h5>
                              <div class="d-flex"><img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1">
                                  <p>Envato, australia</p>
                                </div>
                              </div>
                              <p>Tivo Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details">
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 font-primary">24</div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 font-primary">24</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 font-primary">40</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+3 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>100% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-primary" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-4 col-lg-6 box-col-6"> 
                            <div class="project-box b-light1-primary"><span class="badge badge-primary">Doing</span>
                              <h5 class="f-w-500">Enzo admin Design</h5>
                              <div class="d-flex"><img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1">
                                  <p>Themeforest, australia</p>
                                </div>
                              </div>
                              <p>Enzo Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details">
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 font-primary">12 </div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 font-primary">5</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 font-primary">7</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+10 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>70% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width: 70%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-4 col-lg-6 box-col-6"> 
                            <div class="project-box b-light1-primary"><span class="badge badge-primary">Doing</span>
                              <h5 class="f-w-500">Xolo admin Design</h5>
                              <div class="d-flex"><img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1">
                                  <p>Envato, australia</p>
                                </div>
                              </div>
                              <p>Xolo Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details">
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 font-primary">40</div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 font-primary">40</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 font-primary">20</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+2 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>100% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-primary" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                        <div class="row">
                          <div class="col-xxl-4 col-lg-6 box-col-6"> 
                            <div class="project-box b-light1-success"><span class="badge badge-success">Done</span>
                              <h5 class="f-w-500">Endless admin Design</h5>
                              <div class="d-flex"><img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1">
                                  <p>Themeforest, australia</p>
                                </div>
                              </div>
                              <p>Endless Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details">
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 text-success">12 </div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 text-success">5</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 text-success">7</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+10 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>70% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-success progress-bar-striped" role="progressbar" style="width: 70%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-4 col-lg-6 box-col-6">
                            <div class="project-box b-light1-success"><span class="badge badge-success">Done</span>
                              <h5 class="f-w-500">Universal admin Design</h5>
                              <div class="d-flex"><img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1">
                                  <p>Envato, australia</p>
                                </div>
                              </div>
                              <p>Universal Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details">
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 text-success">24</div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 text-success">24</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 text-success">40</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+3 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>100% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-success" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-4 col-lg-6 box-col-6"> 
                            <div class="project-box b-light1-success"><span class="badge badge-success">Done</span>
                              <h5 class="f-w-500">Poco admin Design</h5>
                              <div class="d-flex"><img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1">
                                  <p>Envato, australia</p>
                                </div>
                              </div>
                              <p>poco Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details">
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 text-success">40</div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 text-success">40</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 text-success">20</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+2 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>100% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-success" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-4 col-lg-6 box-col-6">
                            <div class="project-box b-light1-success"><span class="badge badge-success">Done</span>
                              <h5 class="f-w-500">Universal admin Design</h5>
                              <div class="d-flex"><img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1">
                                  <p>Envato, australia</p>
                                </div>
                              </div>
                              <p>Universal Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details">
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 text-success">24</div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 text-success">24</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 text-success">40</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+3 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>100% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-success" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-4 col-lg-6 box-col-6"> 
                            <div class="project-box b-light1-success"><span class="badge badge-success">Done</span>
                              <h5 class="f-w-500">Endless admin Design</h5>
                              <div class="d-flex"><img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1">
                                  <p>Themeforest, australia</p>
                                </div>
                              </div>
                              <p>Endless Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details">
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 text-success">12 </div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 text-success">5</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 text-success">7</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+10 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>70% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-success progress-bar-striped" role="progressbar" style="width: 70%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-4 col-lg-6 box-col-6"> 
                            <div class="project-box b-light1-success"><span class="badge badge-success">Done</span>
                              <h5 class="f-w-500">Poco admin Design</h5>
                              <div class="d-flex"><img class="img-20 me-1 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title="">
                                <div class="flex-grow-1">
                                  <p>Envato, australia</p>
                                </div>
                              </div>
                              <p>poco Admin is a full featured, multipurpose, premium bootstrap admin template.</p>
                              <div class="row details">
                                <div class="col-6"><span>Issues </span></div>
                                <div class="col-6 text-success">40</div>
                                <div class="col-6"> <span>Resolved</span></div>
                                <div class="col-6 text-success">40</div>
                                <div class="col-6"> <span>Comment</span></div>
                                <div class="col-6 text-success">20</div>
                              </div>
                              <div class="customers">
                                <ul>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/3.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/5.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block"><img class="img-30 rounded-circle" src="assets/images/user/1.jpg" alt="" data-original-title="" title=""></li>
                                  <li class="d-inline-block ms-2">
                                    <p class="f-12">+2 More</p>
                                  </li>
                                </ul>
                              </div>
                              <div class="project-status mt-4">
                                <div class="d-flex mb-0">
                                  <p>100% </p>
                                  <div class="flex-grow-1 text-end"><span>Done</span></div>
                                </div>
                                <div class="progress" style="height: 5px">
                                  <div class="progress-bar-animated bg-success" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
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
    <!-- calendar js-->
    <script src="assets/js/typeahead/handlebars.js"></script>
    <script src="assets/js/typeahead/typeahead.bundle.js"></script>
    <script src="assets/js/typeahead/typeahead.custom.js"></script>
    <script src="assets/js/typeahead-search/handlebars.js"></script>
    <script src="assets/js/typeahead-search/typeahead-custom.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <script src="assets/js/theme-customizer/customizer.js"></script>
  </body>
</html>