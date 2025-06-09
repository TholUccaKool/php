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
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/emoji/uikit.min.css">
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
                  <h4>Group Chat</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Chat</li>
                    <li class="breadcrumb-item active"> Group Chat</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row g-0">
              <div class="col-xxl-3 col-xl-4 col-md-5 box-col-5">
                <div class="left-sidebar-wrapper card">
                  <div class="left-sidebar-chat">
                    <div class="input-group"><span class="input-group-text"><i class="search-icon text-gray" data-feather="search"></i></span>
                      <input class="form-control" type="text" placeholder="Search here..">
                    </div>
                  </div>
                  <div class="advance-options"> 
                    <ul class="nav border-tab" id="chat-options-tab" role="tablist">
                      <li class="nav-item"><a class="nav-link active f-w-600" id="chats-tab" data-bs-toggle="tab" href="#chats" role="tab" aria-controls="chats" aria-selected="true">Chats</a></li>
                      <li class="nav-item"><a class="nav-link f-w-600" id="contacts-tab" data-bs-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false">Contacts</a></li>
                    </ul>
                    <div class="tab-content" id="chat-options-tabContent"> 
                      <div class="tab-pane fade show active" id="chats" role="tabpanel" aria-labelledby="chats-tab">
                        <div class="common-space"> 
                          <p>Recent chats</p>
                          <div class="header-top"><a class="btn badge-light-primary f-w-500" href="#!"><i class="fa fa-plus"></i></a></div>
                        </div>
                        <ul class="chats-user">
                          <li class="common-space">
                            <div class="chat-time">
                              <div class="active-profile"><img class="img-fluid rounded-circle" src="assets/images/avtar/3.jpg" alt="user">
                                <div class="status bg-success"></div>
                              </div>
                              <div> <span>Cameron Williamson</span>
                                <p>Hey, How are you?</p>
                              </div>
                            </div>
                            <div>
                              <p>2 min </p>
                              <div class="badge badge-light-success">15</div>
                            </div>
                          </li>
                          <li class="common-space">
                            <div class="chat-time">
                              <div class="active-profile"><img class="img-fluid rounded-circle" src="assets/images/avtar/11.jpg" alt="user">
                                <div class="status bg-success"></div>
                              </div>
                              <div> <span>Esther Howard</span>
                                <p>Thanks for reply</p>
                              </div>
                            </div>
                            <div>
                              <p>7:30 PM</p>
                            </div>
                          </li>
                          <li class="common-space">
                            <div class="chat-time">
                              <div class="active-profile"><img class="img-fluid rounded-circle" src="assets/images/avtar/7.jpg" alt="user">
                                <div class="status bg-success"></div>
                              </div>
                              <div> <span>Jane Cooper</span>
                                <p>Hey, What's up?</p>
                              </div>
                            </div>
                            <div>
                              <p>1:10 PM</p>
                            </div>
                          </li>
                          <li class="common-space">
                            <div class="chat-time">
                              <div class="active-profile"><img class="img-fluid rounded-circle" src="assets/images/avtar/16.jpg" alt="user">
                                <div class="status bg-success"></div>
                              </div>
                              <div> <span>Ronald Richards</span>
                                <p>I'm ready</p>
                              </div>
                            </div>
                            <div>
                              <p>13:10 PM</p>
                            </div>
                          </li>
                          <li class="common-space">
                            <div class="chat-time">
                              <div class="active-profile"><img class="img-fluid rounded-circle" src="assets/images/avtar/4.jpg" alt="user">
                                <div class="status bg-warning"></div>
                              </div>
                              <div> <span>Darlene Robertson</span>
                                <p>Hey, How are you?</p>
                              </div>
                            </div>
                            <div>
                              <p>1:30 PM</p>
                            </div>
                          </li>
                          <li class="common-space">
                            <div class="chat-time">
                              <div class="active-profile"><img class="img-fluid rounded-circle" src="assets/images/blog/comment.jpg" alt="user">
                                <div class="status bg-warning"></div>
                              </div>
                              <div> <span>Darrell Steward</span>
                                <p>What's going on?</p>
                              </div>
                            </div>
                            <div>
                              <p>2:10 PM</p>
                            </div>
                          </li>
                          <li class="common-space">
                            <div class="chat-time">
                              <div class="active-profile"><img class="img-fluid rounded-circle" src="assets/images/blog/4.jpg" alt="user">
                                <div class="status bg-success"></div>
                              </div>
                              <div> <span>Theresa Webb</span>
                                <p>What's up?</p>
                              </div>
                            </div>
                            <div>
                              <p>1:50 AM</p>
                            </div>
                          </li>
                          <li class="common-space">
                            <div class="chat-time">
                              <div class="active-profile"><img class="img-fluid rounded-circle" src="assets/images/blog/12.png" alt="user">
                                <div class="status bg-warning"></div>
                              </div>
                              <div> <span>Floyd Miles</span>
                                <p>Are you sure?</p>
                              </div>
                            </div>
                            <div>
                              <p>5:14 PM</p>
                            </div>
                          </li>
                          <li class="common-space">
                            <div class="chat-time">
                              <div class="active-profile"><img class="img-fluid rounded-circle" src="assets/images/blog/9.jpg" alt="user">
                                <div class="status bg-warning"></div>
                              </div>
                              <div> <span>Annette Black</span>
                                <p>Thanks</p>
                              </div>
                            </div>
                            <div>
                              <p>1:50 PM</p>
                            </div>
                          </li>
                        </ul>
                      </div>
                      <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                        <div class="common-space"> 
                          <p>Contacts</p>
                          <div class="header-top"><a class="btn badge-light-primary f-w-500" href="#!"><i class="fa fa-plus"></i></a></div>
                        </div>
                        <div class="search-contacts">
                          <input class="form-control" type="text" placeholder="Name and phone number">
                          <svg> 
                            <use href="assets/svg/icon-sprite.svg#stroke-search"></use>
                          </svg><i class="mic-search" data-feather="mic"></i>
                        </div>
                        <div class="contact-wrapper">
                          <p>A </p>
                          <ul class="border-0">
                            <li class="common-space">
                              <div class="chat-time"><img class="img-fluid rounded-circle" src="assets/images/avtar/3.jpg" alt="user">
                                <div> <span>Andres Williamson</span>
                                  <p>191-900-5689</p>
                                </div>
                              </div>
                              <div class="contact-edit">
                                <svg class="dropdown-toggle" role="menu" data-bs-toggle="dropdown" aria-expanded="false">
                                  <use href="assets/svg/icon-sprite.svg#menubar"></use>
                                </svg>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#!">View details</a><a class="dropdown-item" href="#!">
                                     Send messages</a><a class="dropdown-item" href="#!">
                                     Add to favorites</a></div>
                              </div>
                            </li>
                          </ul>
                          <p>B</p>
                          <ul class="border-0">
                            <li class="common-space">
                              <div class="chat-time"><img class="img-fluid rounded-circle" src="assets/images/blog/comment.jpg" alt="user">
                                <div> <span>Britlin Weed</span>
                                  <p>698-781-5581</p>
                                </div>
                              </div>
                              <div class="contact-edit">
                                <svg class="dropdown-toggle" role="menu" data-bs-toggle="dropdown" aria-expanded="false">
                                  <use href="assets/svg/icon-sprite.svg#menubar"></use>
                                </svg>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#!">View details</a><a class="dropdown-item" href="#!">
                                     Send messages</a><a class="dropdown-item" href="#!">
                                     Add to favorites</a></div>
                              </div>
                            </li>
                            <li class="common-space">
                              <div class="chat-time">
                                <div class="custom-name bg-light-secondary">
                                  <p class="txt-secondary f-w-500">BD</p>
                                </div>
                                <div> <span>Brendra Dixit</span>
                                  <p>589-789-2563</p>
                                </div>
                              </div>
                              <div class="contact-edit">
                                <svg class="dropdown-toggle" role="menu" data-bs-toggle="dropdown" aria-expanded="false">
                                  <use href="assets/svg/icon-sprite.svg#menubar"></use>
                                </svg>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#!">View details</a><a class="dropdown-item" href="#!">
                                     Send messages</a><a class="dropdown-item" href="#!">
                                     Add to favorites</a></div>
                              </div>
                            </li>
                          </ul>
                          <p>C </p>
                          <ul class="border-0">
                            <li class="common-space">
                              <div class="chat-time"><img class="img-fluid rounded-circle" src="assets/images/blog/14.png" alt="user">
                                <div> <span>Cody Fisher</span>
                                  <p>983-333-4545</p>
                                </div>
                              </div>
                              <div class="contact-edit">
                                <svg class="dropdown-toggle" role="menu" data-bs-toggle="dropdown" aria-expanded="false">
                                  <use href="assets/svg/icon-sprite.svg#menubar"></use>
                                </svg>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#!">View details</a><a class="dropdown-item" href="#!">
                                     Send messages</a><a class="dropdown-item" href="#!">
                                     Add to favorites</a></div>
                              </div>
                            </li>
                            <li class="common-space">
                              <div class="chat-time">
                                <div class="position-relative custom-name bg-light-success">
                                  <p class="txt-success f-w-500">CE</p>
                                </div>
                                <div> <span>Clifford Evans</span>
                                  <p>321-456-7878</p>
                                </div>
                              </div>
                              <div class="contact-edit">
                                <svg class="dropdown-toggle" role="menu" data-bs-toggle="dropdown" aria-expanded="false">
                                  <use href="assets/svg/icon-sprite.svg#menubar"></use>
                                </svg>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#!">View details</a><a class="dropdown-item" href="#!">
                                     Send messages</a><a class="dropdown-item" href="#!">
                                     Add to favorites  </a></div>
                              </div>
                            </li>
                            <li class="common-space">
                              <div class="chat-time">
                                <div class="custom-name bg-light-warning">
                                  <p class="txt-warning f-w-500">CW </p>
                                </div>
                                <div> <span>Cameron Williamson</span>
                                  <p>369-852-7417</p>
                                </div>
                              </div>
                              <div class="contact-edit">
                                <svg class="dropdown-toggle" role="menu" data-bs-toggle="dropdown" aria-expanded="false">
                                  <use href="assets/svg/icon-sprite.svg#menubar"></use>
                                </svg>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#!">View details</a><a class="dropdown-item" href="#!">
                                     Send messages</a><a class="dropdown-item" href="#!">
                                     Add to favorites</a></div>
                              </div>
                            </li>
                          </ul>
                          <p>D</p>
                          <ul class="border-0">
                            <li class="common-space">
                              <div class="chat-time"><img class="img-fluid rounded-circle" src="assets/images/blog/12.png" alt="user">
                                <div> <span>Darlene Robertson</span>
                                  <p>231-279-1001</p>
                                </div>
                              </div>
                              <div class="contact-edit">
                                <svg class="dropdown-toggle" role="menu" data-bs-toggle="dropdown" aria-expanded="false">
                                  <use href="assets/svg/icon-sprite.svg#menubar"></use>
                                </svg>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#!">View details</a><a class="dropdown-item" href="#!">
                                     Send messages</a><a class="dropdown-item" href="#!">
                                     Add to favorites</a></div>
                              </div>
                            </li>
                            <li class="common-space">
                              <div class="chat-time"><img class="img-fluid rounded-circle" src="assets/images/user/3.png" alt="user">
                                <div> <span>Dianne Russell</span>
                                  <p>569-789-1002</p>
                                </div>
                              </div>
                              <div class="contact-edit">
                                <svg class="dropdown-toggle" role="menu" data-bs-toggle="dropdown" aria-expanded="false">
                                  <use href="assets/svg/icon-sprite.svg#menubar"></use>
                                </svg>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#!">View details</a><a class="dropdown-item" href="#!">
                                     Send messages</a><a class="dropdown-item" href="#!">
                                     Add to favorites</a></div>
                              </div>
                            </li>
                            <li class="common-space">
                              <div class="chat-time"><img class="img-fluid rounded-circle" src="assets/images/user/6.jpg" alt="user">
                                <div> <span>Darrell Steward</span>
                                  <p>200-300-1030</p>
                                </div>
                              </div>
                              <div class="contact-edit">
                                <svg class="dropdown-toggle" role="menu" data-bs-toggle="dropdown" aria-expanded="false">
                                  <use href="assets/svg/icon-sprite.svg#menubar"></use>
                                </svg>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#!">View details</a><a class="dropdown-item" href="#!">
                                     Send messages</a><a class="dropdown-item" href="#!">
                                     Add to favorites</a></div>
                              </div>
                            </li>
                          </ul>
                          <p>E </p>
                          <ul class="border-0">
                            <li class="common-space">
                              <div class="chat-time"><img class="img-fluid rounded-circle" src="assets/images/user/1.jpg" alt="user">
                                <div> <span>Emily Collins</span>
                                  <p>100-555-7032</p>
                                </div>
                              </div>
                              <div class="contact-edit">
                                <svg class="dropdown-toggle" role="menu" data-bs-toggle="dropdown" aria-expanded="false">
                                  <use href="assets/svg/icon-sprite.svg#menubar"></use>
                                </svg>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#!">View details</a><a class="dropdown-item" href="#!">
                                     Send messages</a><a class="dropdown-item" href="#!">
                                     Add to favorites</a></div>
                              </div>
                            </li>
                          </ul>
                          <p>F </p>
                          <ul class="border-0">
                            <li class="common-space">
                              <div class="chat-time"><img class="img-fluid rounded-circle" src="assets/images/user/2.jpg" alt="user">
                                <div> <span>Fiona Cooper</span>
                                  <p>362-778-1919</p>
                                </div>
                              </div>
                              <div class="contact-edit">
                                <svg class="dropdown-toggle" role="menu" data-bs-toggle="dropdown" aria-expanded="false">
                                  <use href="assets/svg/icon-sprite.svg#menubar"></use>
                                </svg>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#!">View details</a><a class="dropdown-item" href="#!">
                                     Send messages</a><a class="dropdown-item" href="#!">
                                     Add to favorites</a></div>
                              </div>
                            </li>
                            <li class="common-space">
                              <div class="chat-time">
                                <div class="custom-name bg-light-danger">
                                  <p class="txt-danger f-w-500">FG</p>
                                </div>
                                <div> <span>Freya Grayson</span>
                                  <p>589-789-2563</p>
                                </div>
                              </div>
                              <div class="contact-edit">
                                <svg class="dropdown-toggle" role="menu" data-bs-toggle="dropdown" aria-expanded="false">
                                  <use href="assets/svg/icon-sprite.svg#menubar"></use>
                                </svg>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#!">View details</a><a class="dropdown-item" href="#!">
                                     Send messages</a><a class="dropdown-item" href="#!">
                                     Add to favorites</a></div>
                              </div>
                            </li>
                          </ul>
                          <p>G</p>
                          <ul class="border-0"> 
                            <li class="common-space">
                              <div class="chat-time">
                                <div class="custom-name bg-light-warning">
                                  <p class="txt-warning f-w-500">GE</p>
                                </div>
                                <div> <span>Gabriel Evans</span>
                                  <p>963-147-5024</p>
                                </div>
                              </div>
                              <div class="contact-edit">
                                <svg class="dropdown-toggle" role="menu" data-bs-toggle="dropdown" aria-expanded="false">
                                  <use href="assets/svg/icon-sprite.svg#menubar"></use>
                                </svg>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#!">View details</a><a class="dropdown-item" href="#!">
                                     Send messages</a><a class="dropdown-item" href="#!">
                                     Add to favorites   </a></div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-9 col-xl-8 col-md-7 box-col-7">
                <div class="card right-sidebar-chat">
                  <div class="right-sidebar-title">
                    <div class="common-space"> 
                      <div class="chat-time group-chat">
                        <ul> 
                          <li><img class="img-fluid rounded-circle" src="assets/images/avtar/16.jpg" alt="user"></li>
                          <li><img class="img-fluid rounded-circle" src="assets/images/avtar/4.jpg" alt="user"></li>
                          <li><img class="img-fluid rounded-circle" src="assets/images/avtar/7.jpg" alt="user"></li>
                          <li><img class="img-fluid rounded-circle" src="assets/images/avtar/11.jpg" alt="user"></li>
                          <li><img class="img-fluid rounded-circle" src="assets/images/avtar/4.jpg" alt="user"></li>
                          <li><img class="img-fluid rounded-circle" src="assets/images/blog/comment.jpg" alt="user"></li>
                          <li><img class="img-fluid rounded-circle" src="assets/images/avtar/7.jpg" alt="user"></li>
                          <li> 
                            <div class="custom-name profile-count light-background">
                              <p class="f-w-500">9+</p>
                            </div>
                          </li>
                        </ul>
                        <div> <span class="f-w-600">Meeting Department</span>
                          <p>35 Members</p>
                        </div>
                      </div>
                      <div class="d-flex gap-2">
                        <div class="contact-edit chat-alert"><i class="icon-info-alt"></i></div>
                        <div class="contact-edit chat-alert">
                          <svg class="dropdown-toggle" role="menu" data-bs-toggle="dropdown" aria-expanded="false">
                            <use href="assets/svg/icon-sprite.svg#menubar"></use>
                          </svg>
                          <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#!">View details</a><a class="dropdown-item" href="#!">
                               Send messages</a><a class="dropdown-item" href="#!">
                               Add to favorites</a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="right-sidebar-Chats"> 
                    <div class="msger">
                      <div class="msger-chat">
                        <div class="msg left-msg">
                          <div class="msg-img"></div>
                          <div class="msg-bubble">
                            <div class="msg-info">
                              <div class="msg-info-name">Theresa Webb</div>
                              <div class="msg-info-time">01:14 PM</div>
                            </div>
                            <div class="msg-text">Hey, I'm looking to redesign my website. Can you help me? &#x1F604;</div>
                          </div>
                        </div>
                        <div class="msg right-msg">
                          <div class="msg-img"></div>
                          <div class="msg-bubble">
                            <div class="msg-info">
                              <div class="msg-info-name">Darrell Steward</div>
                              <div class="msg-info-time">12:14 PM</div>
                            </div>
                            <div class="msg-text"> Absolutely! I'd be happy to assist you.</div>
                          </div>
                        </div>
                        <div class="msg right-msg">
                          <div class="msg-img"></div>
                          <div class="msg-bubble">
                            <div class="msg-info">
                              <div class="msg-info-name">Darrell Steward</div>
                              <div class="msg-info-time">12:14 PM</div>
                            </div>
                            <div class="msg-text">What kind of design aesthetic are you aiming for?</div>
                          </div>
                        </div>
                        <div class="msg left-msg">
                          <div class="msg-img"></div>
                          <div class="msg-bubble">
                            <div class="msg-info">
                              <div class="msg-info-name">Theresa Webb</div>
                              <div class="msg-info-time">01:14 PM</div>
                            </div>
                            <div class="msg-text">I want a clean and modern look with a focus on user experience.</div>
                          </div>
                        </div>
                        <div class="msg right-msg">
                          <div class="msg-img"></div>
                          <div class="msg-bubble">
                            <div class="msg-info">
                              <div class="msg-info-name">Darrell Steward</div>
                              <div class="msg-info-time">12:14 PM</div>
                            </div>
                            <div class="msg-text">Great!  Do you have any specific color schemes in mind?</div>
                          </div>
                        </div>
                        <div class="msg left-msg">
                          <div class="msg-img"></div>
                          <div class="msg-bubble">
                            <div class="msg-info">
                              <div class="msg-info-name">Theresa Webb</div>
                              <div class="msg-info-time">01:14 PM</div>
                            </div>
                            <div class="msg-text">I'm thinking of using a combination of blues and grays.</div>
                          </div>
                        </div>
                        <div class="msg right-msg">
                          <div class="msg-img"></div>
                          <div class="msg-bubble">
                            <div class="msg-info">
                              <div class="msg-info-name">Darrell Steward</div>
                              <div class="msg-info-time">12:14 PM</div>
                            </div>
                            <div class="msg-text">Excellent choice! Those colors can definitely create a professional.</div>
                          </div>
                        </div>
                      </div>
                      <form class="msger-inputarea">
                        <div class="dropdown-form dropdown-toggle" role="main" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-plus"></i>
                          <div class="chat-icon dropdown-menu dropdown-menu-start">
                            <div class="dropdown-item mb-2">
                              <svg> 
                                <use href="assets/svg/icon-sprite.svg#camera"></use>
                              </svg>
                            </div>
                            <div class="dropdown-item">
                              <svg> 
                                <use href="assets/svg/icon-sprite.svg#attchment"></use>
                              </svg>
                            </div>
                          </div>
                        </div>
                        <input class="msger-input two uk-textarea" type="text" placeholder="Type Message here..">
                        <div class="open-emoji">
                          <div class="second-btn uk-button"></div>
                        </div>
                        <button class="msger-send-btn" type="submit"><i class="fa fa-location-arrow"></i></button>
                      </form>
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
    <script src="assets/js/common-chat.js"></script>
    <script src="assets/js/emoji-js/uikit.min.js"></script>
    <script src="assets/js/emoji-js/custom-emoji.js"></script>
    <script src="assets/js/emoji-js/custom-emojis.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <script src="assets/js/theme-customizer/customizer.js"></script>
  </body>
</html>