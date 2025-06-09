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
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/quill.snow.css">
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
                  <h4>Letter Box</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Email</li>
                    <li class="breadcrumb-item active"> Letter Box</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="email-wrap email-main-wrapper">
              <div class="row">
                <div class="col-xxl-3 col-xl-4 box-col-12">
                  <div class="md-sidebar"> <a class="btn btn-primary md-sidebar-toggle" href="javascript:void(0)">email filter</a>
                    <div class="md-sidebar-aside job-left-aside custom-scrollbar">
                      <div class="email-left-aside">
                        <div class="card">
                          <div class="card-body">
                            <div class="email-app-sidebar">
                              <button class="btn btn-primary emailbox" type="button" data-bs-toggle="modal" data-bs-target="#compose_mail"><i class="fa fa-plus"></i>Compose Email</button>
                              <ul class="nav nav-pills main-menu email-category" id="email-pills-tab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="inbox-pill-tab" data-bs-toggle="pill" href="#inbox-pill" role="tab" aria-controls="inbox-pill" aria-selected="false">
                                    <svg class="stroke-icon">
                                      <use href="assets/svg/icon-sprite.svg#inbox"></use>
                                    </svg>
                                    <div>Inbox<span class="badge">12</span></div></a></li>
                                <li class="nav-item"><a class="nav-link" id="sent-pill-tab" data-bs-toggle="pill" href="#sent-pill" role="tab" aria-controls="sent-pill" aria-selected="false">
                                    <svg class="stroke-icon">
                                      <use href="assets/svg/icon-sprite.svg#sent"></use>
                                    </svg>Sent</a></li>
                                <li class="nav-item"><a class="nav-link" id="starred-pill-tab" data-bs-toggle="pill" href="#starred-pill" role="tab" aria-controls="starred-pill" aria-selected="false">
                                    <svg class="stroke-icon">
                                      <use href="assets/svg/icon-sprite.svg#star"></use>
                                    </svg>Starred</a></li>
                                <li class="nav-item"><a class="nav-link" id="draft-pill-tab" data-bs-toggle="pill" href="#draft-pill" role="tab" aria-controls="draft-pill" aria-selected="false">
                                    <svg class="stroke-icon">
                                      <use href="assets/svg/icon-sprite.svg#draft"></use>
                                    </svg>Draft</a></li>
                                <li class="nav-item"><a class="nav-link" id="trash-pill-tab" data-bs-toggle="pill" href="#trash-pill" role="tab" aria-controls="trash-pill" aria-selected="false">
                                    <svg class="stroke-icon">
                                      <use href="assets/svg/icon-sprite.svg#trash"></use>
                                    </svg>Trash</a></li>
                                <li class="nav-item"><a class="nav-link" id="work-pill-tab" data-bs-toggle="pill" href="#work-pill" role="tab" aria-controls="work-pill" aria-selected="false">
                                    <svg class="stroke-icon stroke-primary">
                                      <use href="assets/svg/icon-sprite.svg#pintag"></use>
                                    </svg>Work</a></li>
                                <li class="nav-item"><a class="nav-link" id="private-pill-tab" data-bs-toggle="pill" href="#private-pill" role="tab" aria-controls="private-pill" aria-selected="false">
                                    <svg class="stroke-icon stroke-warning">
                                      <use href="assets/svg/icon-sprite.svg#pintag"></use>
                                    </svg>Private</a></li>
                                <li class="nav-item"><a class="nav-link" id="support-pill-tab" data-bs-toggle="pill" href="#support-pill" role="tab" aria-controls="support-pill" aria-selected="false">
                                    <svg class="stroke-icon stroke-success">
                                      <use href="assets/svg/icon-sprite.svg#pintag"></use>
                                    </svg>Support</a></li>
                                <li class="nav-item"><a class="nav-link btn" data-bs-toggle="modal" data-bs-target="#label-pill" href="#!"><i class="fa fa-plus"></i>Add Label</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xxl-9 col-xl-8 box-col-12">
                  <div class="email-right-aside">
                    <div class="card email-body email-list">
                      <div class="mail-header-wrapper">
                        <div class="mail-header">
                          <div class="form-check form-check-inline">
                            <input class="form-check-input checkbox-primary" id="emailCheckboxA" type="checkbox" value="option1">
                            <label class="form-check-label" for="emailCheckboxA"></label>
                            <ul class="email-tabs nav" role="tablist">
                              <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#!" role="tab" aria-selected="true">
                                  <svg class="stroke-icon">
                                    <use href="assets/svg/icon-sprite.svg#mail"></use>
                                  </svg><span class="f-w-600">Important </span></a></li>
                              <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#!" role="tab" aria-selected="false">
                                  <svg class="stroke-icon">
                                    <use href="assets/svg/icon-sprite.svg#goal"></use>
                                  </svg><span class="f-w-600">Social</span></a></li>
                              <li class="nav-item"><a class="nav-link active" data-bs-toggle="pill" href="#!" role="tab" aria-selected="false">
                                  <svg class="stroke-icon">
                                    <use href="assets/svg/icon-sprite.svg#tread"></use>
                                  </svg><span class="f-w-600">Promotion</span></a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="mail-body"> 
                          <div class="mail-search d-flex-align-items-center"> 
                            <input class="form-control" type="text" placeholder="Search..."><i class="fa fa-search"></i>
                          </div>
                          <div class="light-square"><i class="fa fa-refresh"></i></div>
                          <div class="light-square"> <i class="fa fa-trash"></i></div>
                          <div class="light-square dropdown-toggle" role="main" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></div>
                          <ul class="dropdown-menu dropdown-block dropdown-menu-end">
                            <li> <a class="dropdown-item" href="#!">All</a></li>
                            <li> <a class="dropdown-item" href="#!">None</a></li>
                            <li> <a class="dropdown-item" href="#!">Read</a></li>
                            <li> <a class="dropdown-item" href="#!">Unread</a></li>
                            <li> <a class="dropdown-item" href="#!">Starred</a></li>
                            <li> <a class="dropdown-item" href="#!">Unstarred</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="modal fade" id="compose_mail" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title fs-5">Compose Message</h3>
                              <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body compose-modal">
                              <form>
                                <div class="row mb-3">
                                  <label class="col-sm-2 col-form-label" for="composeFrom">From :</label>
                                  <div class="col-sm-10">
                                    <input class="form-control" id="composeFrom" type="email">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label class="col-sm-2 col-form-label" for="composeTo">To :</label>
                                  <div class="col-sm-10">
                                    <input class="form-control" id="composeTo" type="email">
                                    <div class="add-bcc">
                                      <div class="d-flex gap-2"><a class="btn" data-bs-toggle="collapse" href="#collapseCc" role="button" aria-expanded="false" aria-controls="collapseCc">Cc </a><a class="btn" data-bs-toggle="collapse" href="#collapseBcc" role="button" aria-expanded="false" aria-controls="collapseBcc">Bcc</a></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="collapse row mb-3" id="collapseCc"> 
                                  <label class="col-sm-2 col-form-label" for="composeCc">Cc:</label>
                                  <div class="col-sm-10">
                                    <input class="form-control" id="composeCc" type="email">
                                  </div>
                                </div>
                                <div class="collapse row mb-3" id="collapseBcc"> 
                                  <label class="col-sm-2 col-form-label" for="composeBcc">Bcc:</label>
                                  <div class="col-sm-10">
                                    <input class="form-control" id="composeBcc" type="email">
                                  </div>
                                </div>
                                <div class="row mb-3">
                                  <label class="col-sm-2 col-form-label" for="composeSubject">Subject :</label>
                                  <div class="col-sm-10">
                                    <input class="form-control" id="composeSubject" type="email">
                                  </div>
                                </div>
                                <div class="toolbar-box">
                                  <div id="toolbar1">
                                    <button class="ql-bold">Bold </button>
                                    <button class="ql-italic">Italic </button>
                                    <button class="ql-underline">underline</button>
                                    <button class="ql-strike">Strike </button>
                                    <button class="ql-list" value="ordered">List </button>
                                    <button class="ql-list" value="bullet"> </button>
                                    <button class="ql-indent" value="-1"> </button>
                                    <button class="ql-indent" value="+1"></button>
                                    <button class="ql-link"></button>
                                    <button class="ql-image"></button>
                                  </div>
                                  <div id="editor1"></div>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-light" type="button">Save as draft</button>
                              <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Send</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-content" id="email-pills-tabContent">
                        <div class="tab-pane fade show active" id="inbox-pill" role="tabpanel" aria-labelledby="inbox-pill-tab">
                          <div class="mail-body-wrapper"> 
                            <ul id="paginated-list" data-current-page="1" aria-live="polite">
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxB" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxB"></label>
                                  </div>
                                  <svg class="important-mail active">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border"><img class="img-fluid" src="assets/images/dashboard/user/6.jpg" alt="user"></div>
                                  <p>Marvin McKinney</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>New comments on MSR2024 draft presentation - <span>New Here's a list of all the topic challenges...</span></span>
                                    <div class="badge badge-light-primary">new</div>
                                  </div>
                                  <div class="email-timing"><span>2:30 PM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxC" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxC"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border"><img class="img-fluid" src="assets/images/user/3.png  " alt="user"></div>
                                  <p>Brooklyn Simmons</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Confirm your booking id -<span> A collection of textile samples lay spread out on the table - Samsa was a travelling salesman..</span></span>
                                    <div class="badge badge-light-primary">deadline</div>
                                  </div>
                                  <div class="email-timing"><span>7:50 AM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxD" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxD"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border">
                                    <div>
                                      <p class="txt-primary">EH</p>
                                    </div>
                                  </div>
                                  <p>Esther Howard</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Confirm your booking id -<span>craft beer labore wes anderson cred nesciunt sapiente ea proident...</span></span>
                                    <div class="badge badge-light-success">work</div>
                                  </div>
                                  <div class="email-timing"><span>1:00 PM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxE" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxE"></label>
                                  </div>
                                  <svg class="important-mail active">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border">
                                    <div class="circle-success">
                                      <p class="txt-success">CW</p>
                                    </div>
                                  </div>
                                  <p>Cameron Williamson</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Very fiction Link  -<span>Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</span></span></div>
                                  <div class="email-timing"><span>5 Day ago</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxF" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxF"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border"><img class="img-fluid" src="assets/images/user/6.jpg  " alt="user"></div>
                                  <p>Ronald Richards</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Confirm your booking id -<span>Confirm your booking id - A collection of textile samples lay spread out on the table - Samsa was a travelling salesman..</span></span>
                                    <div class="badge badge-light-light">Update.Zip</div>
                                  </div>
                                  <div class="email-timing"><span>7 April</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxG" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxG"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border"><img class="img-fluid" src="assets/images/user/10.jpg  " alt="user"></div>
                                  <p>Darlene Robertson</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Promotion Mail  -<span>Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda ...</span></span>
                                    <div class="badge badge-light-light">Import File..</div>
                                  </div>
                                  <div class="email-timing"><span>04 April</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxH" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxH"></label>
                                  </div>
                                  <svg class="important-mail active">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border"><img class="img-fluid" src="assets/images/user/12.png " alt="user"></div>
                                  <p>Jacob Jones</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Welcome to our new office  -<span>A collection of textile samples lay spread out on the table - Samsa was a travelling salesman..</span></span></div>
                                  <div class="email-timing"><span>01 April</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxI" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxI"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border"><img class="img-fluid" src="assets/images/user/3.png  " alt="user"></div>
                                  <p>Ralph Edwards</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Your Order #224820098 has been Confirmed-<span>A collection of textile samples lay spread out on the table...</span></span></div>
                                  <div class="email-timing"><span>1:00 PM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxJ" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxJ"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border"><img class="img-fluid" src="assets/images/user/6.jpg  " alt="user"></div>
                                  <p>Ronald Richards</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Confirm your booking id -<span>Confirm your booking id - A collection of textile samples lay spread out on the table - Samsa was a travelling salesman..</span></span>
                                    <div class="badge badge-light-light">Update.Zip</div>
                                  </div>
                                  <div class="email-timing"><span>7 April</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxK" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxK"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border">
                                    <div class="circle-success">
                                      <p class="txt-success">WT</p>
                                    </div>
                                  </div>
                                  <p>William Turner</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Very fiction Link  -<span>Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</span></span></div>
                                  <div class="email-timing"><span>5 Day ago</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxL" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxL"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border"><img class="img-fluid" src="assets/images/user/12.png  " alt="user"></div>
                                  <p>Jacob Jones</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Welcome to our new office  -<span>A collection of textile samples lay spread out on the table - Samsa was a travelling salesman..</span></span></div>
                                  <div class="email-timing"><span>01 April</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxM" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxM"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border"><img class="img-fluid" src="assets/images/user/3.png  " alt="user"></div>
                                  <p>Ralph Edwards</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Your Order #224820098 has been Confirmed-<span>A collection of textile samples lay spread out on the table...</span></span></div>
                                  <div class="email-timing"><span>1:00 PM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                            </ul>
                          </div>
                          <div class="mail-pagination">
                            <button class="pagination-button" id="prev-button" aria-label="Previous page" title="Previous page">&lt;</button>
                            <div class="pagination-index" id="pagination-numbers"></div>
                            <button class="pagination-button" id="next-button" aria-label="Next page" title="Next page">&gt;</button>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="sent-pill" role="tabpanel" aria-labelledby="sent-pill-tab">
                          <div class="mail-body-wrapper"> 
                            <ul>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxN" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxN"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border"><img class="img-fluid" src="assets/images/user/14.png  " alt="user"></div>
                                  <p>Brooklyn Simmons</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Confirm your booking id -<span> A collection of textile samples lay spread out on the table - Samsa was a travelling salesman..</span></span>
                                    <div class="badge badge-light-primary">new</div>
                                  </div>
                                  <div class="email-timing"><span>7:50 AM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxO" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxO"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border"><img class="img-fluid" src="assets/images/dashboard/user/6.jpg" alt="user"></div>
                                  <p>Marvin McKinney</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>New comments on MSR2024 draft presentation - <span>New Here's a list of all the topic challenges...</span></span></div>
                                  <div class="email-timing"><span>2:30 PM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxP" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxP"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border">
                                    <div>
                                      <p class="txt-primary">EH</p>
                                    </div>
                                  </div>
                                  <p>Esther Howard</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Confirm your booking id -<span>craft beer labore wes anderson cred nesciunt sapiente ea proident...</span></span>
                                    <div class="badge badge-light-primary">new</div>
                                    <div class="badge badge-light-success">Task</div>
                                  </div>
                                  <div class="email-timing"><span>1:00 PM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxQ" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxQ"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border">
                                    <div class="circle-success">
                                      <p class="txt-success">JW</p>
                                    </div>
                                  </div>
                                  <p>Jack Williamson</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Very fiction Link  -<span>Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</span></span></div>
                                  <div class="email-timing"><span>5 Day ago</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="starred-pill" role="tabpanel" aria-labelledby="starred-pill-tab">
                          <div class="mail-body-wrapper"> 
                            <ul>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxR" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxR"></label>
                                  </div>
                                  <svg class="important-mail active">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border"><img class="img-fluid" src="assets/images/dashboard/user/6.jpg" alt="user"></div>
                                  <p>Marvin McKinney</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>New comments on MSR2024 draft presentation - <span>New Here's a list of all the topic challenges...</span></span>
                                    <div class="badge badge-light-primary">new</div>
                                  </div>
                                  <div class="email-timing"><span>2:30 PM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxS" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxS"></label>
                                  </div>
                                  <svg class="important-mail active">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border"><img class="img-fluid" src="assets/images/user/3.png  " alt="user"></div>
                                  <p>Brooklyn Simmons</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Confirm your booking id -<span> A collection of textile samples lay spread out on the table - Samsa was a travelling salesman..</span></span>
                                    <div class="badge badge-light-primary">new</div>
                                  </div>
                                  <div class="email-timing"><span>7:50 AM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxT" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxT"></label>
                                  </div>
                                  <svg class="important-mail active">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border">
                                    <div class="circle-success">
                                      <p class="txt-success">CW</p>
                                    </div>
                                  </div>
                                  <p>Cameron Williamson</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Very fiction Link  -<span>Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</span></span></div>
                                  <div class="email-timing"><span>5 Day ago</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="draft-pill" role="tabpanel" aria-labelledby="draft-pill-tab">
                          <div class="mail-body-wrapper"> 
                            <ul>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxU" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxU"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border"><img class="img-fluid" src="assets/images/user/3.png  " alt="user"></div>
                                  <p>Ralph Edwards</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Your Order #224820098 has been Confirmed-<span>A collection of textile samples lay spread out on the table...</span></span></div>
                                  <div class="email-timing"><span>1:00 PM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxV" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxV"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border"><img class="img-fluid" src="assets/images/user/6.jpg  " alt="user"></div>
                                  <p>Ronald Richards</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Confirm your booking id -<span>Confirm your booking id - A collection of textile samples lay spread out on the table - Samsa was a travelling salesman..</span></span>
                                    <div class="badge badge-light-light">Update.Zip</div>
                                  </div>
                                  <div class="email-timing"><span>7 April</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxW" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxW"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border"><img class="img-fluid" src="assets/images/user/12.png  " alt="user"></div>
                                  <p>Jacob Jones</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Welcome to our new office  -<span>A collection of textile samples lay spread out on the table - Samsa was a travelling salesman..</span></span></div>
                                  <div class="email-timing"><span>01 April</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="trash-pill" role="tabpanel" aria-labelledby="trash-pill-tab">
                          <div class="mail-body-wrapper"> 
                            <ul>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxX" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxX"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border">
                                    <div>
                                      <p class="txt-primary">EH</p>
                                    </div>
                                  </div>
                                  <p>Esther Howard</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Confirm your booking id -<span>craft beer labore wes anderson cred nesciunt sapiente ea proident...</span></span>
                                    <div class="badge badge-light-secondary">offer</div>
                                  </div>
                                  <div class="email-timing"><span>1:00 PM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxY" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxY"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border">
                                    <div class="circle-success">
                                      <p class="txt-success">CH</p>
                                    </div>
                                  </div>
                                  <p>Cameron Hill</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Very fiction Link  -<span>Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</span></span></div>
                                  <div class="email-timing"><span>5 Day ago</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckboxZ" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckboxZ"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border">
                                    <div>
                                      <p class="txt-primary">EH</p>
                                    </div>
                                  </div>
                                  <p>Esther Howard</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Confirm your booking id -<span>craft beer labore wes anderson cred nesciunt sapiente ea proident...</span></span>
                                    <div class="badge badge-light-primary">new</div>
                                    <div class="badge badge-light-success">Task</div>
                                  </div>
                                  <div class="email-timing"><span>1:00 PM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckbox0" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckbox0"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border">
                                    <div class="circle-success">
                                      <p class="txt-success">CW</p>
                                    </div>
                                  </div>
                                  <p>Cameron Williamson</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Very fiction Link  -<span>Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</span></span></div>
                                  <div class="email-timing"><span>5 Day ago</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="work-pill" role="tabpanel" aria-labelledby="work-pill-tab">
                          <div class="mail-body-wrapper"> 
                            <ul>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckbox77" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckbox77"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border">
                                    <div>
                                      <p class="txt-primary">EH</p>
                                    </div>
                                  </div>
                                  <p>Esther Howard</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Confirm your booking id -<span>craft beer labore wes anderson cred nesciunt sapiente ea proident...</span></span>
                                    <div class="badge badge-light-primary">new</div>
                                    <div class="badge badge-light-success">Task</div>
                                  </div>
                                  <div class="email-timing"><span>1:00 PM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckbox22" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckbox22"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border"><img class="img-fluid" src="assets/images/user/3.png  " alt="user"></div>
                                  <p>Brooklyn Simmons</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Confirm your booking id -<span> A collection of textile samples lay spread out on the table - Samsa was a travelling salesman..</span></span>
                                    <div class="badge badge-light-primary">deadline</div>
                                  </div>
                                  <div class="email-timing"><span>7:50 AM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckbox33" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckbox33"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border">
                                    <div>
                                      <p class="txt-primary">EV</p>
                                    </div>
                                  </div>
                                  <p>Esther Voward</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Confirm your booking id -<span>craft beer labore wes anderson cred nesciunt sapiente ea proident...</span></span>
                                    <div class="badge badge-light-primary">new</div>
                                    <div class="badge badge-light-success">work</div>
                                  </div>
                                  <div class="email-timing"><span>1:00 PM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="private-pill" role="tabpanel" aria-labelledby="private-pill-tab">
                          <div class="mail-body-wrapper"> 
                            <ul>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckbox44" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckbox44"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border">
                                    <div>
                                      <p class="txt-primary">AD</p>
                                    </div>
                                  </div>
                                  <p>Asther Dolly</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Confirm your booking id -<span>craft beer labore wes anderson cred nesciunt sapiente ea proident...</span></span>
                                    <div class="badge badge-light-primary">new</div>
                                    <div class="badge badge-light-success">Task</div>
                                  </div>
                                  <div class="email-timing"><span>1:00 PM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="support-pill" role="tabpanel" aria-labelledby="support-pill-tab">
                          <div class="mail-body-wrapper"> 
                            <ul>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckbox55" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckbox55"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border">
                                    <div>
                                      <p class="txt-primary">EH</p>
                                    </div>
                                  </div>
                                  <p>Esther Howard</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Confirm your booking id -<span>craft beer labore wes anderson cred nesciunt sapiente ea proident...</span></span>
                                    <div class="badge badge-light-primary">new</div>
                                    <div class="badge badge-light-success">Task</div>
                                  </div>
                                  <div class="email-timing"><span>1:00 PM</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                              <li class="inbox-data">
                                <div class="inbox-user">
                                  <div class="form-check form-check-inline m-0">
                                    <input class="form-check-input checkbox-primary" id="emailCheckbox66" type="checkbox" value="option1">
                                    <label class="form-check-label" for="emailCheckbox66"></label>
                                  </div>
                                  <svg class="important-mail">
                                    <use href="assets/svg/icon-sprite.svg#fill-star"></use>
                                  </svg>
                                  <div class="rounded-border">
                                    <div class="circle-success">
                                      <p class="txt-success">CW</p>
                                    </div>
                                  </div>
                                  <p>Cameron Williamson</p>
                                </div>
                                <div class="inbox-message">
                                  <div class="email-data"><span>Very fiction Link  -<span>Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</span></span></div>
                                  <div class="email-timing"><span>5 Day ago</span></div>
                                  <div class="email-options"><i class="fa fa-envelope-o envelope-1 show"></i><i class="fa fa-envelope-open-o envelope-2 hide"></i><i class="fa fa-trash-o trash-3"></i><i class="fa fa-print"></i></div>
                                </div>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="modal fade" id="label-pill" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title fs-5">Add Label</h3>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form>
                                  <div class="row g-sm-3 g-2 custom-input">
                                    <label class="col-sm-2 col-form-label" for="Label_Modal">Label Name :</label>
                                    <div class="col-sm-10">
                                      <input class="form-control" id="Label_Modal" type="email">
                                    </div>
                                    <label class="col-sm-2 col-form-label" for="Email_Modal">Email :</label>
                                    <div class="col-sm-10">
                                      <input class="form-control" id="Email_Modal" type="email">
                                    </div>
                                    <label class="form-label col-sm-2" for="exampleColorInput">Label Color :</label>
                                    <div class="col-sm-2 col-2">
                                      <input class="form-control form-control-color" id="exampleColorInput" type="color" value="#006666" title="Choose your color">
                                    </div>
                                  </div>
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="button">Add</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card email-body email-read">
                      <div class="mail-header-wrapper header-wrapper1">
                        <div class="mail-header1">
                          <div class="light-square"> 
                            <svg class="btn-email">
                              <use href="assets/svg/icon-sprite.svg#back-arrow"></use>
                            </svg>
                          </div><span class="f-w-600">Interview Mail</span>
                        </div>
                        <div class="mail-body1"> 
                          <div class="light-square" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Achieve">
                            <svg> 
                              <use href="assets/svg/icon-sprite.svg#sms"></use>
                            </svg>
                          </div>
                          <div class="light-square" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Bookmark">
                            <svg class="bookmark-box">
                              <use href="assets/svg/icon-sprite.svg#stroke-bookmark"></use>
                            </svg>
                          </div>
                          <div class="light-square" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Spam">
                            <svg> 
                              <use href="assets/svg/icon-sprite.svg#spam"></use>
                            </svg>
                          </div>
                          <div class="light-square" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Trash">
                            <svg class="stroke-danger">
                              <use href="assets/svg/icon-sprite.svg#mail-trash"></use>
                            </svg>
                          </div>
                          <div class="light-square" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Settings">
                            <svg>
                              <use href="assets/svg/icon-sprite.svg#setting"></use>
                            </svg>
                          </div>
                        </div>
                      </div>
                      <div class="mail-body-wrapper"> 
                        <div class="user-mail-wrapper">
                          <div class="user-title">
                            <div> 
                              <div class="rounded-border"> <img class="img-fluid" src="assets/images/user/12.png" alt="user"></div>
                              <div class="dropdown-subtitle">
                                <p>Jacob Jones</p>
                                <div class="onhover-dropdown">
                                  <button class="btn p-0 dropdown-button">To me <i data-feather="chevron-down"> </i></button>
                                  <div class="inbox-security onhover-show-div">
                                    <p>From: <span>jones &lt;jacobjones3@gmail.com&gt;</span></p>
                                    <p>to: <span>donut.horry@gmail.com</span></p>
                                    <p>reply-to:<span>&lt;jacobjones3@gmail.com&gt;</span></p>
                                    <p>date: <span>Jul 13, 2024, 7:10 AM</span></p>
                                    <p>subject: <span>Important Account Security Update</span></p>
                                    <p>security: <span>standard encryption (TLS)</span></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="inbox-options"> <span>Friday 07 Apr (4 hours ago)</span>
                              <div class="light-square"> 
                                <svg class="important-mail">
                                  <use href="assets/svg/icon-sprite.svg#mail-star"></use>
                                </svg>
                              </div>
                              <div class="light-square" onclick="myFunction()">
                                <svg> 
                                  <use href="assets/svg/icon-sprite.svg#print"></use>
                                </svg>
                              </div>
                              <div class="light-square btn-group">
                                <div class="dropdown-toggle" role="main" data-bs-toggle="dropdown" aria-expanded="false">
                                  <svg>
                                    <use href="assets/svg/icon-sprite.svg#menubar"></use>
                                  </svg>
                                </div>
                                <div class="dropdown-menu dropdown-block"><a class="dropdown-item" href="#!"><i class="fa fa-mail-reply"></i>Reply</a><a class="dropdown-item" href="#!"> <i class="fa fa-mail-forward"></i>Forward</a></div>
                              </div>
                            </div>
                          </div>
                          <div class="user-body">
                            <p>Dear Customer,</p>
                            <p>We regret to notify you that an unauthorized attempt was made to access your account. Our system discovered suspicious activity, and we acted right away to safeguard your personal data.</p>
                            <p>Please change your login information by clicking the following link in order to safeguard your account:</p>
                            <p>Please be aware that your account may be temporarily suspended if no action is taken within 24 hours. We urge you to take immediate action to prevent any inconvenience.</p>
                            <p>We sincerely apologize for any inconvenience this may cause and thank you for your immediate attention to this matter.</p>
                            <div class="mail-subcontent">
                              <p>Yours faithfully,</p>
                              <p>Account Security Team</p>
                            </div>
                          </div>
                          <div class="user-footer"> 
                            <div> 
                              <svg> 
                                <use href="assets/svg/icon-sprite.svg#attchment"></use>
                              </svg><span class="f-light">Attachments</span>
                            </div>
                            <div class="d-inline-block">
                              <div class="attchment-file common-flex">
                                <div class="common-flex align-items-center"><img src="assets/images/email-template/pdfs.png" alt="pdf">
                                  <div class="d-block"> 
                                    <p>Offer_Letter.pdf</p>
                                    <p>200KB</p>
                                  </div>
                                </div><a href="assets/pug/pages/template/text_file.txt" download> <i class="fa fa-download f-light"></i></a>
                              </div>
                            </div>
                            <div class="toolbar-box">
                              <div id="toolbar">
                                <button class="ql-bold">Bold </button>
                                <button class="ql-italic">Italic </button>
                                <button class="ql-underline">underline</button>
                                <button class="ql-strike">Strike </button>
                                <button class="ql-list" value="ordered">List </button>
                                <button class="ql-list" value="bullet"> </button>
                                <button class="ql-indent" value="-1"> </button>
                                <button class="ql-indent" value="+1"></button>
                                <button class="ql-link"></button>
                                <button class="ql-image"></button>
                              </div>
                              <div id="editor"> </div>
                            </div>
                          </div>
                          <div class="send-btn"> 
                            <button class="btn btn-primary">Send<i class="fa fa-paper-plane"> </i></button>
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
    <script src="assets/js/letter-box/custom-mail-pagination.js"></script>
    <script src="assets/js/letter-box/custom-usermail.js"></script>
    <script src="assets/js/editors/quill.js"></script>
    <script src="assets/js/editors/custom-quill.js"></script>
    <script src="assets/js/print.js"></script>
    <script src="assets/js/tooltip-init.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <script src="assets/js/theme-customizer/customizer.js"></script>
  </body>
</html>