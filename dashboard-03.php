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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Riho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities." />
    <meta name="keywords" content="admin template, Riho admin template, dashboard template, flat admin template, responsive admin template, web app" />
    <meta name="author" content="pixelstrap" />
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon" />
    <title>Riho - Premium Admin Template</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css" />
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/icofont.css" />
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/themify.css" />
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/flag-icon.css" />
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/feather-icon.css" />
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/slick.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/scrollbar.css" />
    <!-- Range slider css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/rangeslider/rSlider.min.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/animate.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/prism.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/fullcalender.css" />
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css" />
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
    <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen" />
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css" />
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
                  <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Riho .." name="q" title="" autofocus />
                  <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading... </span></div>
                  <i class="close-search" data-feather="x"></i>
                </div>
                <div class="Typeahead-menu"></div>
              </div>
            </div>
          </form>
          <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper">
              <a href="index.html"><img class="img-fluid for-light" src="../assets/images/logo/logo_dark.png" alt="logo-light" /><img class="img-fluid for-dark" src="../assets/images/logo/logo.png" alt="logo-dark" /></a>
            </div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
          </div>
          <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
            <div>
              <a class="toggle-sidebar" href="#"> <i class="iconly-Category icli"> </i></a>
              <div class="d-flex align-items-center gap-2">
                <h4 class="f-w-600">Welcome Alex</h4>
                <img class="mt-0" src="../assets/images/hand.gif" alt="hand-gif" />
              </div>
            </div>
            <div class="welcome-content d-xl-block d-none"><span class="text-truncate col-12">Here’s what’s happening with your store today. </span></div>
          </div>
          <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus">
              <li class="d-md-block d-none">
                <div class="form search-form mb-0">
                  <div class="input-group">
                    <span class="input-icon">
                      <svg>
                        <use href="../assets/svg/icon-sprite.svg#search-header"></use>
                      </svg>
                      <input class="w-100" type="search" placeholder="Search"
                    /></span>
                  </div>
                </div>
              </li>
              <li class="d-md-none d-block">
                <div class="form search-form mb-0">
                  <div class="input-group">
                    <span class="input-show">
                      <svg id="searchIcon">
                        <use href="../assets/svg/icon-sprite.svg#search-header"></use>
                      </svg>
                      <div id="searchInput">
                        <input type="search" placeholder="Search" /></div
                    ></span>
                  </div>
                </div>
              </li>
              <li class="onhover-dropdown">
                <svg>
                  <use href="../assets/svg/icon-sprite.svg#star"></use>
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
                                  <div class="bookmark-icon"><i data-feather="file-text"></i></div>
                                  <span>Forms</span>
                                </div>
                              </div>
                              <div class="col-4 text-center">
                                <div class="bookmark-content">
                                  <div class="bookmark-icon"><i data-feather="user"></i></div>
                                  <span>Profile</span>
                                </div>
                              </div>
                              <div class="col-4 text-center">
                                <div class="bookmark-content">
                                  <div class="bookmark-icon"><i data-feather="server"></i></div>
                                  <span>Tables</span>
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
                              <input type="text" placeholder="search..." />
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
                    <use href="../assets/svg/icon-sprite.svg#notification-header"></use></svg
                  ><span class="badge rounded-pill badge-secondary">4 </span>
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
                          <li class="nav-item p-0"><a class="nav-link active" id="pills-aboutus-tab" data-bs-toggle="pill" href="#pills-aboutus" role="tab" aria-controls="pills-aboutus" aria-selected="true">All(3)</a></li>
                          <li class="nav-item p-0"><a class="nav-link" id="pills-blog-tab" data-bs-toggle="pill" href="#pills-blog" role="tab" aria-controls="pills-blog" aria-selected="false"> Messages</a></li>
                          <li class="nav-item p-0"><a class="nav-link" id="pills-contactus-tab" data-bs-toggle="pill" href="#pills-contactus" role="tab" aria-controls="pills-contactus" aria-selected="false"> Cart </a></li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                          <div class="tab-pane fade show active" id="pills-aboutus" role="tabpanel" aria-labelledby="pills-aboutus-tab">
                            <div class="user-message">
                              <div class="cart-dropdown notification-all">
                                <ul>
                                  <li class="pr-0 pl-0 pb-3 pt-3">
                                    <div class="media">
                                      <img class="img-fluid b-r-5 me-3 img-60" src="../assets/images/other-images/receiver-img.jpg" alt="" />
                                      <div class="media-body">
                                        <a class="f-light f-w-500" href="../template/product.html">Men Blue T-Shirt</a>
                                        <div class="qty-box">
                                          <div class="input-group">
                                            <span class="input-group-prepend"> <button class="btn quantity-left-minus" type="button" data-type="minus" data-field="">-</button></span> <input class="form-control input-number" type="text" name="quantity" value="1" /><span class="input-group-prepend"> <button class="btn quantity-right-plus" type="button" data-type="plus" data-field="">+</button></span>
                                          </div>
                                        </div>
                                        <h6 class="font-primary">$695.00</h6>
                                      </div>
                                      <div class="close-circle">
                                        <a class="bg-danger" href="#"><i data-feather="x"></i></a>
                                      </div>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                              <ul>
                                <li>
                                  <div class="user-alerts">
                                    <img class="user-image rounded-circle img-fluid me-2" src="../assets/images/dashboard/user/5.jpg" alt="user" />
                                    <div class="user-name">
                                      <div>
                                        <h6><a class="f-w-500 f-14" href="../template/user-profile.html">Floyd Miles</a></h6>
                                        <span class="f-light f-w-500 f-12">Sir, Can i remove part in des...</span>
                                      </div>
                                      <div>
                                        <svg>
                                          <use href="../assets/svg/icon-sprite.svg#more-vertical"></use>
                                        </svg>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                                <li>
                                  <div class="user-alerts">
                                    <img class="user-image rounded-circle img-fluid me-2" src="../assets/images/dashboard/user/6.jpg" alt="user" />
                                    <div class="user-name">
                                      <div>
                                        <h6><a class="f-w-500 f-14" href="../template/user-profile.html">Dianne Russell</a></h6>
                                        <span class="f-light f-w-500 f-12">So, what is my next work ?</span>
                                      </div>
                                      <div>
                                        <svg>
                                          <use href="../assets/svg/icon-sprite.svg#more-vertical"></use>
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
                                    <div class="user-alerts flex-shrink-0"><img class="rounded-circle img-fluid img-40" src="../assets/images/dashboard/user/3.jpg" alt="user" /></div>
                                    <div class="flex-grow-1">
                                      <div class="common-space user-id w-100">
                                        <div class="common-space w-100"><a class="f-w-500 f-12" href="../template/private-chat.html">Robert D. Hambly</a></div>
                                      </div>
                                      <div><span class="f-w-500 f-light f-12">Hello Miss...😊</span></div>
                                    </div>
                                    <span class="f-light f-w-500 f-12">44 sec</span>
                                  </div>
                                </li>
                                <li class="notification d-flex w-100 justify-content-between align-items-center">
                                  <div class="d-flex w-100 notification-data justify-content-center align-items-center gap-2">
                                    <div class="user-alerts flex-shrink-0"><img class="rounded-circle img-fluid img-40" src="../assets/images/dashboard/user/7.jpg" alt="user" /></div>
                                    <div class="flex-grow-1">
                                      <div class="common-space user-id w-100">
                                        <div class="common-space w-100"><a class="f-w-500 f-12" href="../template/private-chat.html">Courtney C. Strang</a></div>
                                      </div>
                                      <div><span class="f-w-500 f-light f-12">Wishing You a Happy Birthday Dear.. 🥳🎊</span></div>
                                    </div>
                                    <span class="f-light f-w-500 f-12">52 min</span>
                                  </div>
                                </li>
                                <li class="notification d-flex w-100 justify-content-between align-items-center">
                                  <div class="d-flex w-100 notification-data justify-content-center align-items-center gap-2">
                                    <div class="user-alerts flex-shrink-0"><img class="rounded-circle img-fluid img-40" src="../assets/images/dashboard/user/5.jpg" alt="user" /></div>
                                    <div class="flex-grow-1">
                                      <div class="common-space user-id w-100">
                                        <div class="common-space w-100"><a class="f-w-500 f-12" href="../template/private-chat.html">Raye T. Sipes</a></div>
                                      </div>
                                      <div><span class="f-w-500 f-light f-12">Hello Dear!! This Theme Is Very beautiful</span></div>
                                    </div>
                                    <span class="f-light f-w-500 f-12">48 min</span>
                                  </div>
                                </li>
                                <li class="notification d-flex w-100 justify-content-between align-items-center">
                                  <div class="d-flex w-100 notification-data justify-content-center align-items-center gap-2">
                                    <div class="user-alerts flex-shrink-0"><img class="rounded-circle img-fluid img-40" src="../assets/images/dashboard/user/6.jpg" alt="user" /></div>
                                    <div class="flex-grow-1">
                                      <div class="common-space user-id w-100">
                                        <div class="common-space w-100"><a class="f-w-500 f-12" href="../template/private-chat.html">Henry S. Miller</a></div>
                                      </div>
                                      <div><span class="f-w-500 f-light f-12">You’re older today than yesterday, happy birthday!</span></div>
                                    </div>
                                    <span class="f-light f-w-500 f-12">3 min</span>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="tab-pane fade" id="pills-contactus" role="tabpanel" aria-labelledby="pills-contactus-tab">
                            <div class="cart-dropdown mt-4">
                              <ul>
                                <li class="pr-0 pl-0 pb-3">
                                  <div class="media">
                                    <img class="img-fluid b-r-5 me-3 img-60" src="../assets/images/other-images/cart-img.jpg" alt="" />
                                    <div class="media-body">
                                      <a class="f-light f-w-500" href="../template/product.html">Furniture Chair for Home</a>
                                      <div class="qty-box">
                                        <div class="input-group">
                                          <span class="input-group-prepend"> <button class="btn quantity-left-minus" type="button" data-type="minus" data-field="">-</button></span> <input class="form-control input-number" type="text" name="quantity" value="1" /><span class="input-group-prepend"> <button class="btn quantity-right-plus" type="button" data-type="plus" data-field="">+</button></span>
                                        </div>
                                      </div>
                                      <h6 class="font-primary">$500</h6>
                                    </div>
                                    <div class="close-circle">
                                      <a class="bg-danger" href="#"><i data-feather="x"></i></a>
                                    </div>
                                  </div>
                                </li>
                                <li class="pr-0 pl-0 pb-3 pt-3">
                                  <div class="media">
                                    <img class="img-fluid b-r-5 me-3 img-60" src="../assets/images/other-images/receiver-img.jpg" alt="" />
                                    <div class="media-body">
                                      <a class="f-light f-w-500" href="../template/product.html">Men Cotton Blend Blue T-Shirt</a>
                                      <div class="qty-box">
                                        <div class="input-group">
                                          <span class="input-group-prepend"> <button class="btn quantity-left-minus" type="button" data-type="minus" data-field="">-</button></span> <input class="form-control input-number" type="text" name="quantity" value="1" /><span class="input-group-prepend"> <button class="btn quantity-right-plus" type="button" data-type="plus" data-field="">+</button></span>
                                        </div>
                                      </div>
                                      <h6 class="font-primary">$695.00</h6>
                                    </div>
                                    <div class="close-circle">
                                      <a class="bg-danger" href="#"><i data-feather="x"></i></a>
                                    </div>
                                  </div>
                                </li>
                                <li class="mb-3 total">
                                  <a href="../template/checkout.html">
                                    <h6 class="mb-0">Order Total :<span class="f-right">$1195.00 </span></h6></a
                                  >
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="card-footer pb-0 pr-0 pl-0">
                            <div class="text-center">
                              <a class="f-w-700" href="private-chat.html"> <button class="btn btn-primary" type="button" title="btn btn-primary">Check all</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="profile-nav onhover-dropdown">
                <div class="media profile-media">
                  <img class="b-r-10" src="../assets/images/dashboard/profile.png" alt="" />
                  <div class="media-body d-xxl-block d-none box-col-none">
                    <div class="d-flex align-items-center gap-2"><span>Alex Mora </span><i class="middle fa fa-angle-down"> </i></div>
                    <p class="mb-0 font-roboto">Admin</p>
                  </div>
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <li>
                    <a href="user-profile.html"><i data-feather="user"></i><span>My Profile</span></a>
                  </li>
                  <li>
                    <a href="letter-box.html"><i data-feather="mail"></i><span>Inbox</span></a>
                  </li>
                  <li>
                    <a href="edit-profile.html"> <i data-feather="settings"></i><span>Settings</span></a>
                  </li>
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
          <script class="empty-template" type="text/x-handlebars-template">
            <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
          </script>
        </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
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
                  <h4>Project Management</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use></svg
                      ></a>
                    </li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Project-Management</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row size-column">
              <div class="col-xxl-12 box-col-12">
                <div class="row">
                  <div class="col-12">
                    <div class="row mb-4">
                      <div class="col-xl col-sm-6">
                        <div class="card o-hidden small-widget m-xl-0">
                          <div class="card-body total-project border-b-primary border-2">
                            <span class="f-light f-w-500 f-14">Total Project</span>
                            <div class="project-details">
                              <div class="project-counter">
                                <h2 class="f-w-600">1,523</h2>
                                <span class="f-12 f-w-400">(This month)</span>
                              </div>
                              <div class="product-sub bg-primary-light">
                                <svg class="invoice-icon">
                                  <use href="../assets/svg/icon-sprite.svg#color-swatch"></use>
                                </svg>
                              </div>
                            </div>
                            <ul class="bubbles">
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl col-sm-6">
                        <div class="card o-hidden small-widget m-xl-0">
                          <div class="card-body total-Progress border-b-warning border-2">
                            <span class="f-light f-w-500 f-14">In Progress</span>
                            <div class="project-details">
                              <div class="project-counter">
                                <h2 class="f-w-600">836</h2>
                                <span class="f-12 f-w-400">(This month) </span>
                              </div>
                              <div class="product-sub bg-warning-light">
                                <svg class="invoice-icon">
                                  <use href="../assets/svg/icon-sprite.svg#tick-circle"></use>
                                </svg>
                              </div>
                            </div>
                            <ul class="bubbles">
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl col-sm-6">
                        <div class="card o-hidden small-widget m-xl-0">
                          <div class="card-body total-Complete border-b-secondary border-2">
                            <span class="f-light f-w-500 f-14">Complete</span>
                            <div class="project-details">
                              <div class="project-counter">
                                <h2 class="f-w-600">475</h2>
                                <span class="f-12 f-w-400">(This month) </span>
                              </div>
                              <div class="product-sub bg-secondary-light">
                                <svg class="invoice-icon">
                                  <use href="../assets/svg/icon-sprite.svg#add-square"></use>
                                </svg>
                              </div>
                            </div>
                            <ul class="bubbles">
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl col-sm-6">
                        <div class="card o-hidden small-widget m-xl-0">
                          <div class="card-body total-upcoming">
                            <span class="f-light f-w-500 f-14">Upcoming</span>
                            <div class="project-details">
                              <div class="project-counter">
                                <h2 class="f-w-600">189</h2>
                                <span class="f-12 f-w-400">(This month) </span>
                              </div>
                              <div class="product-sub bg-light-light">
                                <svg class="invoice-icon">
                                  <use href="../assets/svg/icon-sprite.svg#edit-2"></use>
                                </svg>
                              </div>
                            </div>
                            <ul class="bubbles">
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                              <li class="bubble"></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl col-sm-6">
                        <div class="card add-project-link m-0 h-100">
                          <!-- <div class="categories"></div> -->
                          <div class="categories-content h-100"><span class="text-truncate col-12 f-12 d-block mb-2">Let’s add work to your space</span><a href="projectcreate.html">+Add Project </a></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- project Statistics -->
                  <!-- <div class="col-md-6">
                    <div class="card">
                      <div class="card-header card-no-border total-revenue">
                        <h4>Project Statistics</h4>
                        <div class="sales-chart-dropdown-select">
                          <div class="card-header-right-icon">
                            <div class="dropdown">
                              <button class="btn dropdown-toggle dropdown-toggle-store" id="dropdownMenuButtonStore" data-bs-toggle="dropdown" aria-expanded="false">This Week</button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonStore"><a class="dropdown-item" href="#">This Day</a><a class="dropdown-item" href="#">This Month</a><a class="dropdown-item" href="#">This year</a></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-body pt-0">
                        <div class="statistics">
                          <div id="statisticschart"></div>
                        </div>
                      </div>
                    </div>
                  </div> -->
                  <!-- Today Works -->
                  <!-- <div class="col-md-6">
                    <div class="card">
                      <div class="card-header card-no-border total-revenue">
                        <h4>Today Work</h4>
                        <a href="product.html">View All </a>
                      </div>
                      <div class="card-body pt-0">
                        <div class="today-work-table table-responsive custom-scrollbar">
                          <table class="today-working-table w-100">
                            <tbody>
                              <tr>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">App Design</span><a class="f-w-500 f-14" href="product.html">NFT Illustration...</a></td>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">Assigned to</span><a class="f-w-500 f-14" href="product.html">Cody Fisher</a></td>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">Days Left</span><a class="f-w-500 f-14" href="product.html">02</a></td>
                                <td class="text-end">
                                  <div class="badge-light-primary product-sub badge rounded-pill"><span>High</span></div>
                                </td>
                              </tr>
                              <tr>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">App Design</span><a class="f-w-500 f-14" href="product.html">NFT Illustration...</a></td>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">Arlene McCoy</span><a class="f-w-500 f-14" href="product.html">Assigned to</a></td>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">Days Left</span><a class="f-w-500 f-14" href="product.html">12</a></td>
                                <td class="text-end">
                                  <div class="badge-light-primary product-sub badge rounded-pill"><span>High</span></div>
                                </td>
                              </tr>
                              <tr>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">Web Design</span><a class="f-w-500 f-14" href="product.html">Appron’s 3D Co...</a></td>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">Assigned to</span><a class="f-w-500 f-14" href="product.html">Kristin Watson</a></td>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">Days Left</span><a class="f-w-500 f-14" href="product.html">12</a></td>
                                <td class="text-end">
                                  <div class="badge-light-warning product-sub badge rounded-pill"><span>Medium</span></div>
                                </td>
                              </tr>
                              <tr>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">Desktop App</span><a class="f-w-500 f-14" href="product.html">Rental Car</a></td>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">Assigned to</span><a class="f-w-500 f-14" href="product.html">Darlene Robertson</a></td>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">Days Left</span><a class="f-w-500 f-14" href="product.html">05</a></td>
                                <td class="text-end">
                                  <div class="badge-light-secondary product-sub badge rounded-pill"><span>low</span></div>
                                </td>
                              </tr>
                              <tr>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">Template Design</span><a class="f-w-500 f-14" href="product.html">E-commerce</a></td>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">Assigned to</span><a class="f-w-500 f-14" href="product.html">Wade Warren</a></td>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">Days Left</span><a class="f-w-500 f-14" href="product.html">31</a></td>
                                <td class="text-end">
                                  <div class="badge-light-primary product-sub badge rounded-pill"><span>High</span></div>
                                </td>
                              </tr>
                              <tr>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">App Design</span><a class="f-w-500 f-14" href="product.html">Food Delivery</a></td>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">Assigned to</span><a class="f-w-500 f-14" href="product.html">Smith John</a></td>
                                <td><span class="f-w-500 f-light d-block f-12 mb-1">Days Left</span><a class="f-w-500 f-14" href="product.html">20</a></td>
                                <td class="text-end">
                                  <div class="badge-light-warning product-sub badge rounded-pill"><span>Medium</span></div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div> -->
                  <div class="col-xl-12 ps-3">
                    <div class="row g-2">
                      <div class="card col-xl-9">
                        <div class="card-header card-no-border total-revenue">
                          <h4>Important Project List</h4>
                          <a class="d-none d-sm-block" href="product.html">View All</a>
                        </div>
                        <div class="card-body pt-0 row important-project">
                          <div class="col-xl-4 col-md-6 box-col-6">
                            <div class="projectlist-card">
                              <div class="projectlist">
                                <div class="project-data">
                                  <img class="nft-img img-fluid" src="../assets/images/dashboard-2/category/1.png" alt="nft" />
                                  <div><a class="f-14 f-w-500 d-block" href="product.html">Net Banking App</a><span class="f-light f-12 f-w-500">Client: Jordan</span></div>
                                </div>
                                <span class="badge rounded-pill badge-primary bg-light-primary">7 Days Left</span>
                              </div>
                              <div class="project-date"><span class="f-light f-12 f-w-500">10 Oct, 2024 </span><span class="f-light f-12 f-w-500">15 Nov, 2024 </span></div>
                              <div class="range_4">
                                <div class="slider-container">
                                  <div class="slider_thumb range-slider_thumb"></div>
                                  <div class="range-slider_line">
                                    <div class="slider_line range-slider_line-fill"></div>
                                  </div>
                                  <input class="slider_input range-slider_input" type="range" value="50;" min="0" max="100" />
                                </div>
                              </div>
                              <div class="project-comment">
                                <div class="avatar-showcase">
                                  <div class="avatars">
                                    <div class="customers d-inline-block avatar-group">
                                      <ul>
                                        <li class="d-inline-block"><img class="img-25 rounded-circle" src="../assets/images/user/18.png" alt="" /></li>
                                        <li class="d-inline-block"><img class="img-25 rounded-circle" src="../assets/images/user/15.png" alt="" /></li>
                                        <li class="d-inline-block"><img class="img-25 rounded-circle" src="../assets/images/user/19.png" alt="" /></li>
                                        <li class="d-inline-block"><img class="img-25 rounded-circle" src="../assets/images/user/17.png" alt="" /></li>
                                        <li class="d-inline-block">
                                          <p class="rounded-circle bg-light">+2</p>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="project-comment-icon">
                                  <div class="project-link">
                                    <svg>
                                      <use href="../assets/svg/icon-sprite.svg#messages-2"></use></svg
                                    ><span>18 </span>
                                  </div>
                                  <div class="project-link">
                                    <svg>
                                      <use href="../assets/svg/icon-sprite.svg#paperclip"></use></svg
                                    ><span>2 </span>
                                  </div>
                                </div>
                              </div>
                              <div class="project-meeting-details">
                                <div class="project-meeting"><span class="f-light f-12 f-w-500">Last Meeting</span><span class="f-light f-12 f-w-500">Next Meeting </span></div>
                                <div class="project-meeting-time"><a class="f-14 f-w-500" href="calendar-basic.html">2 Nov 23,10:00 AM</a><a class="f-14 f-w-500" href="calendar-basic.html">8 Nov 23,09:45 AM</a></div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-6 box-col-6">
                            <div class="projectlist-card">
                              <div class="projectlist">
                                <div class="project-data">
                                  <img class="nft-img img-fluid" src="../assets/images/dashboard-2/category/2.png" alt="nft" />
                                  <div><a class="f-14 f-w-500 d-block" href="product.html">NFT Website</a><span class="f-light f-12 f-w-500">Client : Albert Flores</span></div>
                                </div>
                                <span class="badge rounded-pill badge-primary bg-light-primary">24 Days Left</span>
                              </div>
                              <div class="project-date"><span class="f-light f-12 f-w-500">15 Oct, 2024</span><span class="f-light f-12 f-w-500">01 Dec, 2024</span></div>
                              <div class="range_4">
                                <div class="slider-container">
                                  <div class="slider_thumb range-slider_thumb"></div>
                                  <div class="range-slider_line">
                                    <div class="slider_line range-slider_line-fill"></div>
                                  </div>
                                  <input class="slider_input range-slider_input" type="range" value="78" min="0" max="100" />
                                </div>
                              </div>
                              <div class="project-comment">
                                <div class="avatar-showcase">
                                  <div class="avatars">
                                    <div class="customers d-inline-block avatar-group">
                                      <ul>
                                        <li class="d-inline-block"><img class="img-25 rounded-circle" src="../assets/images/user/24.png" alt="" /></li>
                                        <li class="d-inline-block"><img class="img-25 rounded-circle" src="../assets/images/user/21.png" alt="" /></li>
                                        <li class="d-inline-block"><img class="img-25 rounded-circle" src="../assets/images/user/23.png" alt="" /></li>
                                        <li class="d-inline-block"><img class="img-25 rounded-circle" src="../assets/images/user/22.png" alt="" /></li>
                                        <li class="d-inline-block">
                                          <p class="rounded-circle bg-light">+5</p>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="project-comment-icon">
                                  <div class="project-link">
                                    <svg>
                                      <use href="../assets/svg/icon-sprite.svg#messages-2"></use></svg
                                    ><span>18</span>
                                  </div>
                                  <div class="project-link">
                                    <svg>
                                      <use href="../assets/svg/icon-sprite.svg#paperclip"></use></svg
                                    ><span>2 </span>
                                  </div>
                                </div>
                              </div>
                              <div class="project-meeting-details">
                                <div class="project-meeting"><span class="f-light f-12 f-w-500">Last Meeting</span><span class="f-light f-12 f-w-500">Next Meeting </span></div>
                                <div class="project-meeting-time"><a class="f-14 f-w-500" href="calendar-basic.html"> 2 Nov 23,10:00 AM</a><a class="f-14 f-w-500" href="calendar-basic.html">8 Nov 23,09:45 AM</a></div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-4 box-col-none marketing-app-card">
                            <div class="projectlist-card">
                              <div class="projectlist">
                                <div class="project-data">
                                  <img class="nft-img img-fluid" src="../assets/images/dashboard-2/category/3.png" alt="nft" />
                                  <div><a class="f-14 f-w-500 d-block" href="product.html">Marketing App </a><span class="f-light f-12 f-w-500">Client : Jane Cooper </span></div>
                                </div>
                                <span class="badge rounded-pill badge-primary bg-light-primary">31 Days Left</span>
                              </div>
                              <div class="project-date"><span class="f-light f-12 f-w-500">01 Nov, 2024 </span><span class="f-light f-12 f-w-500">18 Dec, 2024 </span></div>
                              <div class="range_4">
                                <div class="slider-container">
                                  <div class="slider_thumb range-slider_thumb"></div>
                                  <div class="range-slider_line">
                                    <div class="slider_line range-slider_line-fill"></div>
                                  </div>
                                  <input class="slider_input range-slider_input" type="range" value="35" min="0" max="100" />
                                </div>
                              </div>
                              <div class="project-comment">
                                <div class="avatar-showcase">
                                  <div class="avatars">
                                    <div class="customers d-inline-block avatar-group">
                                      <ul>
                                        <li class="d-inline-block"><img class="img-25 rounded-circle" src="../assets/images/user/25.png" alt="" /></li>
                                        <li class="d-inline-block"><img class="img-25 rounded-circle" src="../assets/images/user/26.png" alt="" /></li>
                                        <li class="d-inline-block"><img class="img-25 rounded-circle" src="../assets/images/user/27.png" alt="" /></li>
                                        <li class="d-inline-block"><img class="img-25 rounded-circle" src="../assets/images/user/28.png" alt="" /></li>
                                        <li class="d-inline-block">
                                          <p class="rounded-circle bg-light">+8</p>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="project-comment-icon">
                                  <div class="project-link">
                                    <svg>
                                      <use href="../assets/svg/icon-sprite.svg#messages-2"></use></svg
                                    ><span class="f-light f-12 f-w-500">20</span>
                                  </div>
                                  <div class="project-link">
                                    <svg>
                                      <use href="../assets/svg/icon-sprite.svg#paperclip"></use></svg
                                    ><span class="f-light f-12 f-w-500">7</span>
                                  </div>
                                </div>
                              </div>
                              <div class="project-meeting-details">
                                <div class="project-meeting"><span class="f-light f-12 f-w-500">Last Meeting</span><span class="f-light f-12 f-w-500">Next Meeting </span></div>
                                <div class="project-meeting-time"><a class="f-14 f-w-500" href="calendar-basic.html">6 Nov 23,2:56 PM</a><a class="f-14 f-w-500" href="calendar-basic.html">10 Nov 23, 7:12 AM</a></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3">
                        <div class="card recent-order">
                          <div class="card-header card-no-border total-revenue">
                            <h4 class="m-0">Top Client List</h4>
                            <div class="header-top"></div>
                            <a href="product.html">View All </a>
                          </div>
                          <div class="card-body pt-0">
                            <div class="client-list-table table-responsive custom-scrollbar">
                              <table class="order-table w-100">
                                <tbody>
                                  <tr>
                                    <td class="client-list">
                                      <div class="user-id">
                                        <div class="avatars me-2">
                                          <div class="avatar">
                                            <img class="img-50 rounded-circle" src="../assets/images/user/29.png" alt="#" />
                                            <div class="status status-dnd bg-warning"></div>
                                          </div>
                                        </div>
                                        <div class="product-sub"><a class="f-14 f-w-500" href="user-profile.pug">Jenny Bell</a><span class="d-block f-light f-w-500">India</span></div>
                                      </div>
                                      <div class="user-comment w-100">
                                        <div class="product-sub"><a class="f-14 f-w-500" href="user-profile.pug">jennybell@gmail.com</a><span class="d-block f-light f-w-500">+84 342 556 555 </span></div>
                                        <div class="product-sub">
                                          <svg class="invoice-icon">
                                            <use href="../assets/svg/icon-sprite.svg#messages-3"></use>
                                          </svg>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="client-list">
                                      <div class="user-id">
                                        <div class="avatars me-2">
                                          <div class="avatar">
                                            <img class="img-50 rounded-circle" src="../assets/images/user/30.png" alt="#" />
                                            <div class="status status-dnd bg-warning"></div>
                                          </div>
                                        </div>
                                        <div class="product-sub"><a class="f-14 f-w-500" href="user-profile.pug">Albert Flores</a><span class="d-block f-light f-w-500">UK</span></div>
                                      </div>
                                      <div class="user-comment w-100">
                                        <div class="product-sub"><a class="f-14 f-w-500" href="user-profile.pug">albert78@gmail.com</a><span class="d-block f-light f-w-500">+77 445 551 629</span></div>
                                        <div class="product-sub">
                                          <svg class="invoice-icon">
                                            <use href="../assets/svg/icon-sprite.svg#messages-3"></use>
                                          </svg>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="client-list">
                                      <div class="user-id">
                                        <div class="avatars me-2">
                                          <div class="avatar">
                                            <img class="img-50 rounded-circle" src="../assets/images/user/33.png" alt="#" />
                                            <div class="status status-dnd bg-warning"></div>
                                          </div>
                                        </div>
                                        <div class="product-sub"><a class="f-14 f-w-500" href="user-profile.pug">Jane Cooper</a><span class="d-block f-light f-w-500">London</span></div>
                                      </div>
                                      <div class="user-comment w-100">
                                        <div class="product-sub"><a class="f-14 f-w-500" href="user-profile.pug">jane145@gmail.com</a><span class="d-block f-light f-w-500">+56 955 510 831</span></div>
                                        <div class="product-sub">
                                          <svg class="invoice-icon">
                                            <use href="../assets/svg/icon-sprite.svg#messages-3"></use>
                                          </svg>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="client-list">
                                      <div class="user-id">
                                        <div class="avatars me-2">
                                          <div class="avatar"><img class="img-50 rounded-circle" src="../assets/images/user/31.png" alt="#" /></div>
                                        </div>
                                        <div class="product-sub"><a class="f-14 f-w-500" href="user-profile.pug">Devon Lane</a><span class="d-block f-light f-w-500">America</span></div>
                                      </div>
                                      <div class="user-comment w-100">
                                        <div class="product-sub"><a class="f-14 f-w-500" href="user-profile.pug">devom796@gmail.com</a><span class="d-block f-light f-w-500">+56 955 570 095</span></div>
                                        <div class="product-sub">
                                          <svg class="invoice-icon">
                                            <use href="../assets/svg/icon-sprite.svg#messages-3"></use>
                                          </svg>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="client-list">
                                      <div class="user-id">
                                        <div class="avatars me-2">
                                          <div class="avatar"><img class="img-50 rounded-circle" src="../assets/images/user/32.png" alt="#" /></div>
                                        </div>
                                        <div class="product-sub"><a class="f-14 f-w-500" href="user-profile.pug">Cody Fisher</a><span class="d-block f-light f-w-500">Canada</span></div>
                                      </div>
                                      <div class="user-comment w-100">
                                        <div class="product-sub"><a class="f-14 f-w-500" href="user-profile.pug">cody7895@gmail.com</a><span class="d-block f-light f-w-500">+226 795 552 31</span></div>
                                        <div class="product-sub">
                                          <svg class="invoice-icon">
                                            <use href="../assets/svg/icon-sprite.svg#messages-3"></use>
                                          </svg>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xxl-12">
                    <div class="card recent-order">
                      <div class="card-header card-no-border total-revenue">
                        <h4 class="m-0">All Project Table</h4>
                        <div class="header-top"></div>
                        <a href="product.html">View All </a>
                      </div>
                      <div class="card-body pt-0">
                        <div class="project-table table-responsive custom-scrollbar">
                          <table class="order-table project-table w-100">
                            <thead>
                              <tr>
                                <th>Project Name</th>
                                <th>Client Name</th>
                                <th>End Date</th>
                                <th>Assigned to</th>
                                <th>Status</th>
                                <th>Progress</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <div class="project-comment d-flex gap-2">
                                    <div class="radial-chart-wrap">
                                      <div class="widgetsChart" id="widgetsChart1"></div>
                                    </div>
                                    <div>
                                      <a class="f-w-500 f-14" href="product.html">Pet App Design</a>
                                      <div class="project-comment-icon">
                                        <div class="project-link">
                                          <svg>
                                            <use href="../assets/svg/icon-sprite.svg#messages-2"></use></svg
                                          ><span class="f-w-500 f-light f-12">20</span>
                                        </div>
                                        <div class="project-link">
                                          <svg>
                                            <use href="../assets/svg/icon-sprite.svg#paperclip"></use></svg
                                          ><span class="f-w-500 f-light f-12">7</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="product-sub"><a class="f-w-500 f-14" href="product.html">Darrell Steward</a><span class="f-w-500 f-light f-12 d-block">darrells@example.com</span></div>
                                </td>
                                <td>
                                  <div class="product-sub"><a class="f-w-500 f-14" href="product.html">15 Nov, 2024</a><span class="f-w-500 f-light f-12 d-block">8 Days Left</span></div>
                                </td>
                                <td>
                                  <div class="product-sub"><a class="f-w-500 f-14" href="product.html">Team Roha</a><span class="f-w-500 f-light f-12 d-block">12 Member</span></div>
                                </td>
                                <td>
                                  <div class="txt-primary d-flex gap-2 align-items-center justify-content-center"><span class="pending bg-primary"></span><span class="f-w-500 f-13 txt-primary">Active</span></div>
                                </td>
                                <td>
                                  <div class="product-sub">
                                    <div class="dropdown">
                                      <div id="dropdownMenuButtonicon11" data-bs-toggle="dropdown" aria-expanded="false" role="menu">
                                        <svg class="invoice-icon">
                                          <use href="../assets/svg/icon-sprite.svg#more-horizontal"></use>
                                        </svg>
                                      </div>
                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonicon11"><span class="dropdown-item">Last Month</span><span class="dropdown-item">Last Week</span><span class="dropdown-item">Last Day </span></div>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="project-comment d-flex gap-2">
                                    <div class="radial-chart-wrap">
                                      <div class="widgetsChart" id="widgetsChart2"></div>
                                    </div>
                                    <div>
                                      <a class="f-w-500 f-14" href="product.html">Chain Desktop App</a>
                                      <div class="project-comment-icon">
                                        <div class="project-link">
                                          <svg>
                                            <use href="../assets/svg/icon-sprite.svg#messages-2"></use></svg
                                          ><span class="f-w-500 f-light f-12">20</span>
                                        </div>
                                        <div class="project-link">
                                          <svg>
                                            <use href="../assets/svg/icon-sprite.svg#paperclip"></use></svg
                                          ><span class="f-w-500 f-light f-12">7</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="product-sub"><a class="f-w-500 f-14" href="product.html">Eleanor Pena</a><span class="f-w-500 f-light f-12 d-block">pena12@example.com</span></div>
                                </td>
                                <td>
                                  <div class="product-sub"><a class="f-w-500 f-14" href="product.html">20 Nov, 2024</a><span class="f-w-500 f-light f-12 d-block">13 Days Left</span></div>
                                </td>
                                <td>
                                  <div class="product-sub"><a class="f-w-500 f-14" href="product.html">Team Suresh</a><span class="f-w-500 f-light f-12 d-block">10 Member</span></div>
                                </td>
                                <td>
                                  <div class="txt-warning d-flex gap-2 align-items-center justify-content-center"><span class="pending bg-warning"></span><span class="f-w-500 f-13 txt-warning">On Hold</span></div>
                                </td>
                                <td>
                                  <div class="product-sub">
                                    <div class="dropdown">
                                      <div id="dropdownMenuButtonicon12" data-bs-toggle="dropdown" aria-expanded="false" role="menu">
                                        <svg class="invoice-icon">
                                          <use href="../assets/svg/icon-sprite.svg#more-horizontal"></use>
                                        </svg>
                                      </div>
                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonicon12"><span class="dropdown-item">Last Month</span><span class="dropdown-item">Last Week</span><span class="dropdown-item">Last Day </span></div>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="project-comment d-flex gap-2">
                                    <div class="radial-chart-wrap">
                                      <div class="widgetsChart" id="widgetsChart3"></div>
                                    </div>
                                    <div>
                                      <a class="f-w-500 f-14" href="product.html">Business Web Design</a>
                                      <div class="project-comment-icon">
                                        <div class="project-link">
                                          <svg>
                                            <use href="../assets/svg/icon-sprite.svg#messages-2"></use></svg
                                          ><span class="f-w-500 f-light f-12">20</span>
                                        </div>
                                        <div class="project-link">
                                          <svg>
                                            <use href="../assets/svg/icon-sprite.svg#paperclip"></use></svg
                                          ><span class="f-w-500 f-light f-12">7</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="product-sub"><a class="f-w-500 f-14" href="product.html">Robert Fox</a><span class="f-w-500 f-light f-12 d-block">foxxxx8s@example.com</span></div>
                                </td>
                                <td>
                                  <div class="product-sub"><a class="f-w-500 f-14" href="product.html">22 Nov, 2024</a><span class="f-w-500 f-light f-12 d-block">15 Days Left</span></div>
                                </td>
                                <td>
                                  <div class="product-sub"><a class="f-w-500 f-14" href="product.html">Team Liza</a><span class="f-w-500 f-light f-12 d-block">7 Member</span></div>
                                </td>
                                <td>
                                  <div class="txt-secondary d-flex gap-2 align-items-center justify-content-center"><span class="pending bg-secondary"></span><span class="f-w-500 f-13 txt-secondary">Pending</span></div>
                                </td>
                                <td>
                                  <div class="product-sub">
                                    <div class="dropdown">
                                      <div id="dropdownMenuButtonicon13" data-bs-toggle="dropdown" aria-expanded="false" role="menu">
                                        <svg class="invoice-icon">
                                          <use href="../assets/svg/icon-sprite.svg#more-horizontal"></use>
                                        </svg>
                                      </div>
                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonicon13"><span class="dropdown-item">Last Month</span><span class="dropdown-item">Last Week</span><span class="dropdown-item">Last Day </span></div>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="project-comment d-flex gap-2">
                                    <div class="radial-chart-wrap">
                                      <div class="widgetsChart" id="widgetsChart4"></div>
                                    </div>
                                    <div>
                                      <a class="f-w-500 f-14" href="product.html">NFT App Design</a>
                                      <div class="project-comment-icon">
                                        <div class="project-link">
                                          <svg>
                                            <use href="../assets/svg/icon-sprite.svg#messages-2"></use></svg
                                          ><span class="f-w-500 f-light f-12">20</span>
                                        </div>
                                        <div class="project-link">
                                          <svg>
                                            <use href="../assets/svg/icon-sprite.svg#paperclip"></use></svg
                                          ><span class="f-w-500 f-light f-12">7</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="product-sub"><a class="f-w-500 f-14" href="product.html">Arlene McCoy</a><span class="f-w-500 f-light f-12 d-block">arlene78@example.com</span></div>
                                </td>
                                <td>
                                  <div class="product-sub"><a class="f-w-500 f-14" href="product.html">28 Nov, 2024</a><span class="f-w-500 f-light f-12 d-block">21 Days Left</span></div>
                                </td>
                                <td>
                                  <div class="product-sub"><a class="f-w-500 f-14" href="product.html">Team Sulekha</a><span class="f-w-500 f-light f-12 d-block">9 Member</span></div>
                                </td>
                                <td>
                                  <div class="txt-primary d-flex gap-2 align-items-center justify-content-center"><span class="pending bg-primary"></span><span class="f-w-500 f-13 txt-primary">Active</span></div>
                                </td>
                                <td>
                                  <div class="product-sub">
                                    <div class="dropdown">
                                      <div id="dropdownMenuButtonicon14" data-bs-toggle="dropdown" aria-expanded="false" role="menu">
                                        <svg class="invoice-icon">
                                          <use href="../assets/svg/icon-sprite.svg#more-horizontal"></use>
                                        </svg>
                                      </div>
                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonicon14"><span class="dropdown-item">Last Month</span><span class="dropdown-item">Last Week</span><span class="dropdown-item">Last Day </span></div>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <div class="project-comment d-flex gap-2">
                                    <div class="radial-chart-wrap">
                                      <div class="widgetsChart" id="widgetsChart5"></div>
                                    </div>
                                    <div>
                                      <a class="f-w-500 f-14" href="product.html">Digital Avtar Web Design</a>
                                      <div class="project-comment-icon">
                                        <div class="project-link">
                                          <svg>
                                            <use href="../assets/svg/icon-sprite.svg#messages-2"></use></svg
                                          ><span class="f-w-500 f-light f-12">20</span>
                                        </div>
                                        <div class="project-link">
                                          <svg>
                                            <use href="../assets/svg/icon-sprite.svg#paperclip"></use></svg
                                          ><span class="f-w-500 f-light f-12">7</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="product-sub"><a class="f-w-500 f-14" href="product.html">Courtney Henry</a><span class="f-w-500 f-light f-12 d-block">henry45@example.com</span></div>
                                </td>
                                <td>
                                  <div class="product-sub"><a class="f-w-500 f-14" href="product.html">2 Dec, 2024</a><span class="f-w-500 f-light f-12 d-block">25 Days Left</span></div>
                                </td>
                                <td>
                                  <div class="product-sub"><a class="f-w-500 f-14" href="product.html">Team Shreena</a><span class="f-w-500 f-light f-12 d-block">12 Member</span></div>
                                </td>
                                <td>
                                  <div class="txt-primary d-flex gap-2 align-items-center justify-content-center"><span class="pending bg-primary"></span><span class="f-w-500 f-13 txt-primary">Active</span></div>
                                </td>
                                <td>
                                  <div class="product-sub">
                                    <div class="dropdown">
                                      <div id="dropdownMenuButtonicon15" data-bs-toggle="dropdown" aria-expanded="false" role="menu">
                                        <svg class="invoice-icon">
                                          <use href="../assets/svg/icon-sprite.svg#more-horizontal"></use>
                                        </svg>
                                      </div>
                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonicon15"><span class="dropdown-item">Last Month</span><span class="dropdown-item">Last Week</span><span class="dropdown-item">Last Day </span></div>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- time line -->
                  <!-- <div class="col-xl-7 box-col-6">
                    <div class="card">
                      <div class="card-header card-no-border total-revenue">
                        <h4>Time Line</h4>
                      </div>
                      <div class="card-body pt-0">
                        <div class="overflow-auto theme-scrollbar custom-scrollbar">
                          <div class="timeline-calendar custom-scrollbar">
                            <div class="custom-calendar" id="calendar-container">
                              <div class="time-line" id="calendar"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> -->
                </div>
              </div>
              <!-- <div class="col-xxl-3 d-xxl-block d-none activity-group box-col-none h-25">

                <div class="row">
                  <div class="col-xl-12">
                    <div class="card">
                      <div class="card-header card-no-border total-revenue"> 
                        <h4>Activity Log  </h4>
                        <div class="sales-chart-dropdown-select">
                          <div class="card-header-right-icon online-store"> 
                            <div class="dropdown">  
                              <button class="btn dropdown-toggle dropdown-toggle-store" id="dropdownMenuButtondown" data-bs-toggle="dropdown" aria-expanded="false">Employee  </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtondown"><a class="dropdown-item" href="#">All  </a><a class="dropdown-item" href="#">Employee</a><a class="dropdown-item" href="#">Client </a></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-body pt-0">
                        <div class="activity-log-card"> 
                          <ul> 
                            <li class="activity-log">
                              <div class="d-flex align-items-start gap-2"><img class="activity-log-img rounded-circle img-fluid me-2" src="../assets/images/user/26.png" alt="user"/>
                                <div> 
                                  <div class="common-space user-id">
                                    <h6> <a class="f-w-500 f-12" href="user-profile.html">Jenny Wilson</a></h6><span class="f-light f-w-500 f-12">Today 10:45 AM</span>
                                  </div>
                                  <div class="d-flex mb-2"><span class="f-light f-w-500 f-12">Commented on : </span><a class="f-w-500 f-12" href="blog.html"> NFT App</a></div><span class="f-light f-w-500 f-12 d-block">This smithe design looks great!! but this page as i mention belove.</span><a class="f-12 f-w-500 username" href="user-profile.html"></a>
                                </div>
                              </div>
                            </li>
                            <li class="activity-log">
                              <div class="d-flex align-items-start gap-2"><img class="activity-log-img rounded-circle img-fluid me-2" src="../assets/images/user/34.png" alt="user"/>
                                <div> 
                                  <div class="common-space user-id">
                                    <h6> <a class="f-w-500 f-12" href="user-profile.html">Darlene Robertson</a></h6><span class="f-light f-w-500 f-12">Today 10:43 AM</span>
                                  </div>
                                  <div class="d-flex mb-2"><span class="f-light f-w-500 f-12">Shared File to : </span><a class="f-w-500 f-12" href="blog.html">Barkha</a></div><span class="f-light f-w-500 f-12 d-block">Food Delivery App figma &amp; Ai file shared to a .zip file to make it easier to send.</span><a class="f-12 f-w-500 username" href="user-profile.html"></a>
                                </div>
                              </div>
                            </li>
                            <li class="activity-log">
                              <div class="d-flex align-items-start gap-2"><img class="activity-log-img rounded-circle img-fluid me-2" src="../assets/images/user/35.png" alt="user"/>
                                <div> 
                                  <div class="common-space user-id">
                                    <h6> <a class="f-w-500 f-12" href="user-profile.html">Seema Joshi</a></h6><span class="f-light f-w-500 f-12">Today 10:42 AM</span>
                                  </div>
                                  <div class="d-flex mb-2"><span class="f-light f-w-500 f-12">Meeting : </span><a class="f-w-500 f-12" href="blog.html">Eva Website</a></div><span class="f-light f-w-500 f-12 d-block">You can send the AI file as attachment service and share a download link.</span><a class="f-12 f-w-500 username" href="user-profile.html">@barkha_singh</a>
                                </div>
                              </div>
                            </li>
                            <li class="activity-log">
                              <div class="d-flex align-items-start gap-2"><img class="activity-log-img rounded-circle img-fluid me-2" src="../assets/images/user/44.png" alt="user"/>
                                <div> 
                                  <div class="common-space user-id">
                                    <h6> <a class="f-w-500 f-12" href="user-profile.html">Elara Winter</a></h6><span class="f-light f-w-500 f-12">Today 06:45 AM</span>
                                  </div>
                                  <div class="d-flex mb-2"><span class="f-light f-w-500 f-12">Meeting : </span><a class="f-w-500 f-12" href="blog.html">Eva Website</a></div><span class="f-light f-w-500 f-12 d-block">Metting about next page design of eva website.</span><a class="f-12 f-w-500 username" href="user-profile.html"></a>
                                </div>
                              </div>
                            </li>
                            <li class="activity-log">
                              <div class="d-flex align-items-start gap-2"><img class="activity-log-img rounded-circle img-fluid me-2" src="../assets/images/user/38.png" alt="user"/>
                                <div> 
                                  <div class="common-space user-id">
                                    <h6> <a class="f-w-500 f-12" href="user-profile.html">Arya Shwanno</a></h6><span class="f-light f-w-500 f-12">Today 05:51 AM</span>
                                  </div>
                                  <div class="d-flex mb-2"><span class="f-light f-w-500 f-12">Add new screen :</span><a class="f-w-500 f-12" href="blog.html">Pet App</a></div><span class="f-light f-w-500 f-12 d-block">Make sure your AI file is  cloud storage like Google Drive or Dropbox.</span><a class="f-12 f-w-500 username" href="user-profile.html"></a>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-12 col-md-6"> 
                    <div class="card"> 
                      <div class="card-header card-no-border total-revenue card-title-underline">
                        <h4>Message</h4><a href="product.html">+ New Message </a>
                      </div>
                      <div class="card-body pt-0">
                        <div class="user-message"> 
                          <ul> 
                            <li>
                              <div class="activity-log"><img class="activity-log-img rounded-circle img-fluid me-2" src="../assets/images/user/39.png" alt="user"/>
                                <div class="status bg-warning"></div>
                                <div class="activity-name">
                                  <div>
                                    <h6> <a class="f-w-500 f-14" href="user-profile.html">Maren Ross</a></h6><span class="f-light f-w-500 f-12 ">Hey, What’s today update ?</span>
                                  </div>
                                  <div class="product-sub">
                                    <div class="dropdown">
                                      <div id="dropdownMenuButtonicon21" data-bs-toggle="dropdown" aria-expanded="false" role="menu">
                                        <svg class="invoice-icon">
                                          <use href="../assets/svg/icon-sprite.svg#more-vertical"></use>
                                        </svg>
                                      </div>
                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonicon21"><span class="dropdown-item">Last Month</span><span class="dropdown-item">Last Week</span><span class="dropdown-item">Last Day  </span></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="activity-log"><img class="activity-log-img rounded-circle img-fluid me-2" src="../assets/images/user/40.png" alt="user"/>
                                <div class="status bg-undefined"></div>
                                <div class="activity-name">
                                  <div>
                                    <h6> <a class="f-w-500 f-14" href="user-profile.html">Brooklyn Simmons</a></h6><span class="f-light f-w-500 f-12 ">I know it will work.</span>
                                  </div>
                                  <div class="product-sub">
                                    <div class="dropdown">
                                      <div id="dropdownMenuButtonicon22" data-bs-toggle="dropdown" aria-expanded="false" role="menu">
                                        <svg class="invoice-icon">
                                          <use href="../assets/svg/icon-sprite.svg#more-vertical"></use>
                                        </svg>
                                      </div>
                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonicon22"><span class="dropdown-item">Last Month</span><span class="dropdown-item">Last Week</span><span class="dropdown-item">Last Day  </span></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="activity-log"><img class="activity-log-img rounded-circle img-fluid me-2" src="../assets/images/user/41.png" alt="user"/>
                                <div class="status bg-warning"></div>
                                <div class="activity-name">
                                  <div>
                                    <h6> <a class="f-w-500 f-14" href="user-profile.html">Floyd Miles</a></h6><span class="f-light f-w-500 f-12 ">Sir, Can remove part in des...</span>
                                  </div>
                                  <div class="product-sub">
                                    <div class="dropdown">
                                      <div id="dropdownMenuButtonicon23" data-bs-toggle="dropdown" aria-expanded="false" role="menu">
                                        <svg class="invoice-icon">
                                          <use href="../assets/svg/icon-sprite.svg#more-vertical"></use>
                                        </svg>
                                      </div>
                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonicon23"><span class="dropdown-item">Last Month</span><span class="dropdown-item">Last Week</span><span class="dropdown-item">Last Day  </span></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="activity-log"><img class="activity-log-img rounded-circle img-fluid me-2" src="../assets/images/user/42.png" alt="user"/>
                                <div class="status bg-undefined"></div>
                                <div class="activity-name">
                                  <div>
                                    <h6> <a class="f-w-500 f-14" href="user-profile.html">Dianne Russell</a></h6><span class="f-light f-w-500 f-12 ">So, what is my next work ?</span>
                                  </div>
                                  <div class="product-sub">
                                    <div class="dropdown">
                                      <div id="dropdownMenuButtonicon24" data-bs-toggle="dropdown" aria-expanded="false" role="menu">
                                        <svg class="invoice-icon">
                                          <use href="../assets/svg/icon-sprite.svg#more-vertical"></use>
                                        </svg>
                                      </div>
                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonicon24"><span class="dropdown-item">Last Month</span><span class="dropdown-item">Last Week</span><span class="dropdown-item">Last Day  </span></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="activity-log"><img class="activity-log-img rounded-circle img-fluid me-2" src="../assets/images/user/43.png" alt="user"/>
                                <div class="status bg-warning"></div>
                                <div class="activity-name">
                                  <div>
                                    <h6> <a class="f-w-500 f-14" href="user-profile.html">Darlene Robertson</a></h6><span class="f-light f-w-500 f-12 ">Can we add that here ?</span>
                                  </div>
                                  <div class="product-sub">
                                    <div class="dropdown">
                                      <div id="dropdownMenuButtonicon25" data-bs-toggle="dropdown" aria-expanded="false" role="menu">
                                        <svg class="invoice-icon">
                                          <use href="../assets/svg/icon-sprite.svg#more-vertical"></use>
                                        </svg>
                                      </div>
                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonicon25"><span class="dropdown-item">Last Month</span><span class="dropdown-item">Last Week</span><span class="dropdown-item">Last Day  </span></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="activity-log"><img class="activity-log-img rounded-circle img-fluid me-2" src="../assets/images/user/44.png" alt="user"/>
                                <div class="status bg-undefined"></div>
                                <div class="activity-name">
                                  <div>
                                    <h6> <a class="f-w-500 f-14" href="user-profile.html">Jenny Wilson</a></h6><span class="f-light f-w-500 f-12 ">Hey, What’s today update ?</span>
                                  </div>
                                  <div class="product-sub">
                                    <div class="dropdown">
                                      <div id="dropdownMenuButtonicon26" data-bs-toggle="dropdown" aria-expanded="false" role="menu">
                                        <svg class="invoice-icon">
                                          <use href="../assets/svg/icon-sprite.svg#more-vertical"></use>
                                        </svg>
                                      </div>
                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonicon26"><span class="dropdown-item">Last Month</span><span class="dropdown-item">Last Week</span><span class="dropdown-item">Last Day  </span></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="activity-log"><img class="activity-log-img rounded-circle img-fluid me-2" src="../assets/images/user/45.png" alt="user"/>
                                <div class="status bg-warning"></div>
                                <div class="activity-name">
                                  <div>
                                    <h6> <a class="f-w-500 f-14" href="user-profile.html">Ralph Edwards</a></h6><span class="f-light f-w-500 f-12 ">ok, send it.</span>
                                  </div>
                                  <div class="product-sub">
                                    <div class="dropdown">
                                      <div id="dropdownMenuButtonicon28" data-bs-toggle="dropdown" aria-expanded="false" role="menu">
                                        <svg class="invoice-icon">
                                          <use href="../assets/svg/icon-sprite.svg#more-vertical"></use>
                                        </svg>
                                      </div>
                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonicon28"><span class="dropdown-item">Last Month</span><span class="dropdown-item">Last Week</span><span class="dropdown-item">Last Day  </span></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="activity-log"><img class="activity-log-img rounded-circle img-fluid me-2" src="../assets/images/user/15.png" alt="user"/>
                                <div class="status bg-warning"></div>
                                <div class="activity-name">
                                  <div>
                                    <h6> <a class="f-w-500 f-14" href="user-profile.html">Ronald Richards</a></h6><span class="f-light f-w-500 f-12 ">Thank you !!!</span>
                                  </div>
                                  <div class="product-sub">
                                    <div class="dropdown">
                                      <div id="dropdownMenuButtonicon29" data-bs-toggle="dropdown" aria-expanded="false" role="menu">
                                        <svg class="invoice-icon">
                                          <use href="../assets/svg/icon-sprite.svg#more-vertical"></use>
                                        </svg>
                                      </div>
                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonicon29"><span class="dropdown-item">Last Month</span><span class="dropdown-item">Last Week</span><span class="dropdown-item">Last Day  </span></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="activity-log"><img class="activity-log-img rounded-circle img-fluid me-2" src="../assets/images/user/47.png" alt="user"/>
                                <div class="status bg-undefined"></div>
                                <div class="activity-name">
                                  <div>
                                    <h6> <a class="f-w-500 f-14" href="user-profile.html">Courtney Henry</a></h6><span class="f-light f-w-500 f-12 ">No, you’ve to do one more variant.</span>
                                  </div>
                                  <div class="product-sub">
                                    <div class="dropdown">
                                      <div id="dropdownMenuButtonicon30" data-bs-toggle="dropdown" aria-expanded="false" role="menu">
                                        <svg class="invoice-icon">
                                          <use href="../assets/svg/icon-sprite.svg#more-vertical"></use>
                                        </svg>
                                      </div>
                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonicon30"><span class="dropdown-item">Last Month</span><span class="dropdown-item">Last Week</span><span class="dropdown-item">Last Day  </span></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-12 col-md-6">
                    <div class="card overflow-hidden"> 
                      <div class="card-body pt-0 project-ideas-card">
                        <div class="project-card">
                          <div><span class="f-22 f-w-500 text-center">Get more ideas for your important project</span>
                            <div class="btn-showcase text-center"> <a href="pricing.html"> 
                                <button class="btn btn-pill btn-outline-primary-2x b-r-8 active">Upgrade Now</button></a></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">Copyright 2024 © Riho theme by pixelstrap</p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- latest jquery-->
    <script src="../assets/js/jquery.min.js"></script>
    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="../assets/js/scrollbar/simplebar.js"></script>
    <script src="../assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="../assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="../assets/js/sidebar-menu.js"></script>
    <script src="../assets/js/sidebar-pin.js"></script>
    <script src="../assets/js/slick/slick.min.js"></script>
    <script src="../assets/js/slick/slick.js"></script>
    <script src="../assets/js/header-slick.js"></script>
    <script src="../assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="../assets/js/chart/apex-chart/stock-prices.js"></script>
    <!-- Range Slider js-->
    <script src="../assets/js/range-slider/rSlider.min.js"></script>
    <script src="../assets/js/rangeslider/rangeslider.js"></script>
    <script src="../assets/js/prism/prism.min.js"></script>
    <script src="../assets/js/clipboard/clipboard.min.js"></script>
    <script src="../assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="../assets/js/counter/jquery.counterup.min.js"></script>
    <script src="../assets/js/counter/counter-custom.js"></script>
    <script src="../assets/js/custom-card/custom-card.js"></script>
    <!-- calendar js-->
    <script src="../assets/js/calendar/fullcalender.js"></script>
    <script src="../assets/js/calendar/custom-calendar.js"></script>
    <script src="../assets/js/dashboard/dashboard_2.js"></script>
    <script src="../assets/js/animation/wow/wow.min.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="../assets/js/script.js"></script>
    <!-- <script src="../assets/js/theme-customizer/customizer.js"></script> -->
    <script>
      new WOW().init();
    </script>
  </body>
</html>
