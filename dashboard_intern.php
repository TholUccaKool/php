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
    if ($_GET['page'] == 'home') {
        $_SESSION['ShowDashboard'] = 'Dashboard';
    } elseif ($_GET['page'] == 'manage_shows') {
        $_SESSION['ShowDashboard'] = 'ManageShows';
    } elseif ($_GET['page'] == 'edm') {
        $_SESSION['ShowDashboard'] = 'Edm';
    } elseif ($_GET['page'] == 'whatsApp') {
        $_SESSION['ShowDashboard'] = 'WhatsApp';
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
    <meta name="description" content="Riho admin is super flexible, powerful, clean & modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Riho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>PLAYInc</title>
    <!-- jQuery moved to head to ensure it loads before scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
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
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/date-picker.css">
    <!-- Add Dropzone CSS for Create Show form -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/dropzone.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
    <!-- This is for EDM -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/quill.snow.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/datatables.css">
    <!-- Bootstrap CSS (already present, for primary/danger classes) -->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">
    <!-- Custom styles for table, detail view, margin fix, and underline removal -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        .detail-view {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .detail-view div {
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        /* Margin fix for page-body */
        .page-body {
            margin-left: 250px;
        }
        @media (max-width: 991px) {
            .page-body {
                margin-left: 0;
            }
        }
        /* Remove underline from sidebar links */
        .sidebar-link {
            text-decoration: none !important;
            border-bottom: none !important;
        }
        .sidebar-link:hover,
        .sidebar-link:focus {
            text-decoration: none !important;
            border-bottom: none !important;
        }
        .sidebar-links {
            padding-left: 10px;
        }
        .sidebar-list {
            margin-left: 0; /* Ensure no extra left margin */
        }
    </style>
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
                                <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                            </div>
                            <div class="Typeahead-menu"></div>
                        </div>
                    </div>
                </form>
                <div class="header-logo-wrapper col-auto p-0">
                    <div class="logo-wrapper"><a href="dashboard.php"><img class="img-fluid for-light" src="assets/images/logo/client_logo.png" alt="logo-light"><img class="img-fluid for-dark" src="assets/images/logo/client_logo.png" alt="logo-dark"></a></div>
                    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
                </div>
                <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
                    <div>
                        <a class="toggle-sidebar" href="#"><i class="iconly-Category icli"></i></a>
                        <div class="d-flex align-items-center gap-2">
                            <?php if (strtolower($userRole) === "admin"): ?>
                                <h4 class="f-w-600">Welcome Dexter!</h4><img class="mt-0" src="assets/images/hand.gif" alt="hand-gif">
                            <?php elseif (strtolower($userRole) === "freelancer"): ?>
                                <h4 class="f-w-600">Welcome Dilton!</h4><img class="mt-0" src="assets/images/hand.gif" alt="hand-gif">
                            <?php elseif (strtolower($userRole) === "agency"): ?>
                                <h4 class="f-w-600">Welcome Whoever You Are Mr Agency!!</h4><img class="mt-0" src="assets/images/hand.gif" alt="hand-gif">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="welcome-content d-xl-block d-none"><span class="text-truncate col-12">Welcome to PLAYInc!</span></div>
                </div>
                <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
                    <ul class="nav-menus">
                        <li>
                            <div class="mode"><i class="moon" data-feather="moon"></i></div>
                        </li>
                        <li class="profile-nav onhover-dropdown">
                            <div class="media profile-media"><img class="b-r-10" src="assets/images/dashboard/profile.png" alt="">
                                <div class="media-body d-xxl-block d-none box-col-none">
                                    <div class="d-flex align-items-center gap-2"><span>Alex Mora</span><i class="middle fa fa-angle-down"></i></div>
                                    <p class="mb-0 font-roboto">Admin</p>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li><a href="user-profile.html"><i data-feather="user"></i><span>My Profile</span></a></li>
                                <li><a class="btn btn-pill btn-outline-primary btn-sm" href="login.html">Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page Header Ends -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div class="logo-wrapper">
        <a href="index.html"><img class="img-fluid" src="assets/images/logo/logo.png" alt=""></a>
        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"></i></div>
    </div>
    <div class="logo-icon-wrapper">
        <a href="index.html"><img class="img-fluid" src="assets/images/logo/logo-icon.png" alt=""></a>
    </div>
    <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
            <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn">
                    <a href="index.html"><img class="img-fluid" src="assets/images/logo/logo-icon.png" alt="logo-icon"></a>
                    <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                </li>
                <li class="pin-title sidebar-main-title">
                    <div><h6>Pinned</h6></div>
                </li>
                <?php if (strtolower($userRole) === "admin"): ?>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="?page=home">
                            <svg class="stroke-icon"><use href="assets/svg/icon-sprite.svg#stroke-home"></use></svg>
                            <svg class="fill-icon"><use href="assets/svg/icon-sprite.svg#fill-home"></use></svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="?page=manage_shows">
                            <svg class="stroke-icon"><use href="assets/svg/icon-sprite.svg#stroke-project"></use></svg>
                            <svg class="fill-icon"><use href="assets/svg/icon-sprite.svg#fill-project"></use></svg>
                            <span>Manage Shows</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="?page=edm">
                            <svg class="stroke-icon"><use href="assets/svg/icon-sprite.svg#stroke-email"></use></svg>
                            <svg class="fill-icon"><use href="assets/svg/icon-sprite.svg#fill-email"></use></svg>
                            <span>EDM</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="?page=whatsApp">
                            <svg class="stroke-icon"><use href="assets/svg/icon-sprite.svg#stroke-chat"></use></svg>
                            <svg class="fill-icon"><use href="assets/svg/icon-sprite.svg#fill-chat"></use></svg>
                            <span>WhatsApp</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="contacts.php">
                            <svg class="stroke-icon"><use href="assets/svg/icon-sprite.svg#stroke-contact"></use></svg>
                            <svg class="fill-icon"><use href="assets/svg/icon-sprite.svg#fill-contact"></use></svg>
                            <span>School Information</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="calendar-basic.php">
                            <svg class="stroke-icon"><use href="assets/svg/icon-sprite.svg#stroke-calendar"></use></svg>
                            <svg class="fill-icon"><use href="assets/svg/icon-sprite.svg#fill-calender"></use></svg>
                            <span>Calendar</span>
                        </a>
                    </li>
                <?php elseif (strtolower($userRole) === "freelancer"): ?>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="?page=home">
                            <svg class="stroke-icon"><use href="assets/svg/icon-sprite.svg#stroke-home"></use></svg>
                            <svg class="fill-icon"><use href="assets/svg/icon-sprite.svg#fill-home"></use></svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="edit-profile.php">
                            <svg class="stroke-icon"><use href="assets/svg/icon-sprite.svg#stroke-user"></use></svg>
                            <svg class="fill-icon"><use href="assets/svg/icon-sprite.svg#fill-user"></use></svg>
                            <span>Settings</span>
                        </a>
                    </li>
                <?php elseif (strtolower($userRole) === "agency"): ?>
                    <!-- Add agency-specific sidebar items if needed -->
                <?php endif; ?>
            </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
</div>
<!-- Page Sidebar Ends-->
            <!-- Page Sidebar Ends-->
            <!-- Page Content Start-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <h4><?php 
                                    if ($_SESSION['ShowDashboard'] == 'ViewDetails') {
                                        echo 'Booking Details';
                                    } elseif ($_SESSION['ShowDashboard'] == 'ManageShows') {
                                        echo 'Manage Shows';
                                    } elseif ($_SESSION['ShowDashboard'] == 'Edm') {
                                        echo 'Letter Box';
                                    } elseif ($_SESSION['ShowDashboard'] == 'WhatsApp') {
                                        echo 'Group Chat';
                                    } else {
                                        echo 'Dashboard';
                                    }
                                ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row size-column">
                        <?php if ($_SESSION['ShowDashboard'] == 'Dashboard'): ?>
                            <?php include 'components/view_all_booking.php'; ?>
                        <?php elseif ($_SESSION['ShowDashboard'] == 'ManageShows'): ?>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0 card-no-border">
                <h4>All Shows</h4>
                <span>View all shows below. Click "View Details" to see more information about a specific show, or click "Add Show" to create a new show.</span>
                <div class="text-end">
                    <button id="addShowButton" class="btn btn-primary">Add Show</button>
                </div>
            </div>
            <div class="card-body">
                <div id="viewShowContainer">
                    <p>Loading shows…</p>
                </div>
            </div>
        </div>
        <div id="createShowContainer" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <div class="form theme-form">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label>Project Title</label>
                                    <input class="form-control" type="text" placeholder="Project name *">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label>Client name</label>
                                    <input class="form-control" type="text" placeholder="Name client or company name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label>Project Rate</label>
                                    <input class="form-control" type="text" placeholder="Enter project Rate">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label>Project Type</label>
                                    <select class="form-select">
                                        <option>Hourly</option>
                                        <option>Fix price</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label>Priority</label>
                                    <select class="form-select">
                                        <option>Low</option>
                                        <option>Medium</option>
                                        <option>High</option>
                                        <option>Urgent</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label>Project Size</label>
                                    <select class="form-select">
                                        <option>Small</option>
                                        <option>Medium</option>
                                        <option>Big</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label>Starting date</label>
                                    <input class="datepicker-here form-control" type="text" data-language="en">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label>Ending date</label>
                                    <input class="datepicker-here form-control" type="text" data-language="en">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label>Enter some Details</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea4" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label>Upload project file</label>
                                    <form class="dropzone" id="singleFileUpload" action="/upload.php">
                                        <div class="dz-message needsclick"><i class="icon-cloud-up"></i>
                                            <h6 class="f-w-600">Drop files here or click to upload.</h6><span class="note needsclick">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="text-end">
                                    <a class="btn btn-success me-3" href="#">Add</a>
                                    <a class="btn btn-danger" href="#" id="cancelAddShow">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to set session and redirect for View Details
        function setShowSessionAndRedirect(showId) {
        $.ajax({
            url: 'setSession.php',
            method: 'POST',
            data: {
                ShowDashboard: 'ViewShowDetails',
                SelectedShowID: showId
            },
            dataType: 'text',
            success: function(response) {
                if (response.trim() === 'success') {
                    window.location.href = 'dashboard.php';
                } else {
                    console.error('Session set failed:', response);
                    alert('Failed to set session: ' + response);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX error:', textStatus, errorThrown);
                alert('Error communicating with server. Please check the console and try again.');
            }
        });
    }


    $(document).ready(function() {
        // Load shows table
        $.ajax({
            url: 'https://apiplayinc.spacegap.net/index.php',
            method: 'POST',
            data: { function: 'displayAllShow' },
            dataType: 'json'
        })
        .done(function(data) {
            if (!data || data.length === 0) {
                $('#viewShowContainer').html('<p>No shows found.</p>');
                return;
            }

            const columns = ['ShowID', 'ShowName', 'ShowDuration', 'ShowAgeGroup', 'ShowShortDescription', 'ShowDescription'];

            let html = '<div class="table-responsive theme-scrollbar custom-scrollbar">';
            html += '<table class="display" id="showsTable" style="width:100%">';
            html += '<thead><tr>';
            columns.forEach(col => {
                html += `<th>${col}</th>`;
            });
            html += '<th>Action</th></tr></thead><tbody>';

            data.forEach(row => {
                html += '<tr>';
                columns.forEach(col => {
                    html += `<td>${row[col] ?? '-'}</td>`;
                });
                html += `<td><a href="#" onclick="setShowSessionAndRedirect(${row.ShowID})">View Details</a></td>`;
                html += '</tr>';
            });

            html += '</tbody></table></div>';
            $('#viewShowContainer').html(html);

            // Initialize DataTable for better table functionality
            $('#showsTable').DataTable({
                responsive: true,
                scrollX: true,
                ordering: true,
                language: {
                    emptyTable: "No shows found."
                }
            });
        })
        .fail(function(jq, textStatus) {
            $('#viewShowContainer').html(
                `<p style="color:red;">Error loading shows: ${textStatus}</p>`
            );
        });

        // Toggle Add Show form
        $('#addShowButton').on('click', function() {
            $('#viewShowContainer').hide();
            $('#addShowButton').hide();
            $('#createShowContainer').show();
            $('.page-title h4').text('Create Show');
        });

        // Cancel Add Show
        $('#cancelAddShow').on('click', function(e) {
            e.preventDefault();
            $('#createShowContainer').hide();
            $('#viewShowContainer').show();
            $('#addShowButton').show();
            $('.page-title h4').text('Manage Shows');
        });

        // Function to set session and redirect for View Details
    });
    </script>
                        <?php elseif ($_SESSION['ShowDashboard'] == 'ViewDetails' && isset($_SESSION['SelectedBookingID'])): ?>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header pb-0 card-no-border">
                                        <h4>Details for Booking ID: <?php echo $_SESSION['SelectedBookingID']; ?></h4>
                                        <span>View detailed information about the selected booking below.</span>
                                    </div>
                                    <div class="card-body">
                                        <div id="bookingDetailsContainer">
                                            <p>Loading booking details…</p>
                                        </div>
                                        <div id="createSlotSection" style="margin-top: 20px;">
                                            <h5>Additional Information</h5>
                                            <div class="row g-3">
                                                <div class="col-md-3">
                                                    <label for="numberOfRoles" class="form-label">Number of Roles</label>
                                                    <input type="number" class="form-control" id="numberOfRoles" placeholder="Enter number of roles" min="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="venue" class="form-label">Venue</label>
                                                    <input type="text" class="form-control" id="venue" placeholder="Enter venue">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="timeToReport" class="form-label">Time to Report</label>
                                                    <input type="time" class="form-control" id="timeToReport" placeholder="Select time">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="remarks" class="form-label">Remarks</label>
                                                    <input type="text" class="form-control" id="remarks" placeholder="Enter remarks">
                                                </div>
                                            </div>
                                            <div style="margin-top: 20px;">
                                                <button id="createSlotButton" class="btn btn-primary" disabled>Create Slot</button>
                                                <div id="createSlotResult" style="margin-top: 10px;"></div>
                                            </div>
                                        </div>
                                        <!-- Date Selection Boxes (Hidden Initially) -->
                                        <div id="dateSelectionContainer" style="display: none; margin-top: 20px;">
                                            <h5>Select a Date for the Slot</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-body text-center">
                                                            <h6>First Date</h6>
                                                            <p id="firstDate"></p>
                                                            <button class="btn btn-success select-date-btn" data-date-type="email">Select This Date</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-body text-center">
                                                            <h6>Alternative Date</h6>
                                                            <p id="alternativeDate"></p>
                                                            <button class="btn btn-success select-date-btn" data-date-type="alternative">Select This Date</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Bootstrap Modal for Error Message -->
                                        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="errorModalLabel">Error</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p id="errorMessage"></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a id="addSchoolLink" href="#" target="_blank" class="btn btn-primary" style="display:none;">Add School</a>
                                                        <a id="addTeacherLink" href="#" target="_blank" class="btn btn-primary" style="display:none;">Add Teacher</a>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            $(document).ready(function() {
                                let schoolID = null;
                                let teacherID = null;
                                let emailDateTime = null;
                                let alternativeDateTime = null;

                                // Load Booking Details
                                $.ajax({
                                    url: 'https://apiplayinc.spacegap.net/index.php',
                                    method: 'POST',
                                    data: { 
                                        function: 'LoadEmailBookingOneResult',
                                        bookingId: <?= $_SESSION['SelectedBookingID']; ?>
                                    },
                                    dataType: 'json'
                                })
                                .done(function(data) {
                                    if (!data || data.length === 0) {
                                        $('#bookingDetailsContainer').html('<p>No details found for this Booking ID.</p>');
                                        $('#createSlotButton').prop('disabled', true);
                                        return;
                                    }

                                    const row = data[0];
                                    const columnsToShow = [
                                        'BookingDetails_NameOfSchool',
                                        'BookingDetails_Address',
                                        'BookingDetails_AudienceSize',
                                        'BookingDetails_ShowName',
                                        'BookingDetails_ContactPerson',
                                        'BookingDetails_ContactNumber',
                                        'BookingDetails_EmailDateTime',
                                        'BookingDetails_AlternativeDateAndTime',
                                        'BookingDetails_Remark'
                                    ];

                                    let details = '<div class="detail-view">';
                                    columnsToShow.forEach(function(colName) {
                                        let value = row[colName] || '-';
                                        if (colName === 'BookingDetails_NameOfSchool') {
                                            const schoolCellId = `schoolCheck_${Math.random().toString(36).substring(2, 10)}`;
                                            details += `<div><strong>${colName.replace('BookingDetails_', '').replace(/([A-Z])/g, ' $1').trim()}:</strong> ${value}<br><small id="${schoolCellId}" style="color:gray;">Checking school...</small></div>`;
                                        }
                                        else if (colName === 'BookingDetails_ContactNumber') {
                                            const contactCellId = `teacherCheck_${Math.random().toString(36).substring(2, 10)}`;
                                            details += `<div><strong>${colName.replace('BookingDetails_', '').replace(/([A-Z])/g, ' $1').trim()}:</strong> ${value}<br><small id="${contactCellId}" style="color:gray;">Checking teacher...</small></div>`;
                                        }
                                        else {
                                            details += `<div><strong>${colName.replace('BookingDetails_', '').replace(/([A-Z])/g, ' $1').trim()}:</strong> ${value}</div>`;
                                        }
                                        // Store date values
                                        if (colName === 'BookingDetails_EmailDateTime') {
                                            emailDateTime = value;
                                        }
                                        if (colName === 'BookingDetails_AlternativeDateAndTime') {
                                            alternativeDateTime = value;
                                        }
                                    });
                                    details += '</div>';
                                    $('#bookingDetailsContainer').html(details);

                                    // Populate date selection boxes
                                    $('#firstDate').text(emailDateTime || '-');
                                    $('#alternativeDate').text(alternativeDateTime || '-');

                                    // Check School Availability
                                    $.post('https://apiplayinc.spacegap.net/index.php', {
                                        function: 'CheckSchoolAvailability',
                                        SchoolName: row['BookingDetails_NameOfSchool'] || ''
                                    }, function(response) {
                                        const schoolCellId = $(`[id^=schoolCheck_]`).attr('id');
                                        const result = response.exists
                                            ? '<span style="color:green;">✅ School Recorded</span>'
                                            : '<span style="color:red;">❌ School Not Found</span>';
                                        $(`#${schoolCellId}`).html(result);
                                        if (response.exists && response.SchoolID) {
                                            schoolID = response.SchoolID;
                                            $.post('setSession.php', { SchoolID: response.SchoolID });
                                        } else {
                                            $.post('setSession.php', { SchoolID: '' });
                                        }
                                        checkCreateSlotButton();
                                    }, 'json');

                                    // Check Teacher Availability
                                    $.post('https://apiplayinc.spacegap.net/index.php', {
                                        function: 'CheckTeacherAvailability',
                                        ContactNumber: row['BookingDetails_ContactNumber'] || ''
                                    }, function(response) {
                                        const contactCellId = $(`[id^=teacherCheck_]`).attr('id');
                                        const result = response.exists
                                            ? '<span style="color:green;">✅ Teacher Recorded</span>'
                                            : '<span style="color:red;">❌ Teacher Not Found</span>';
                                        $(`#${contactCellId}`).html(result);
                                        if (response.exists && response.TeacherID) {
                                            teacherID = response.TeacherID;
                                            $.post('setSession.php', { TeacherID: response.TeacherID });
                                        } else {
                                            $.post('setSession.php', { TeacherID: '' });
                                        }
                                        checkCreateSlotButton();
                                    }, 'json');
                                })
                                .fail(function(jqXHR, textStatus) {
                                    $('#bookingDetailsContainer').html(`<p style="color:red;">Error loading booking details: ${textStatus}</p>`);
                                    $('#createSlotButton').prop('disabled', true);
                                });

                                // Check if Create Slot button should be enabled
                                function checkCreateSlotButton() {
                                    if (schoolID && teacherID) {
                                        $('#createSlotButton').prop('disabled', false);
                                    } else {
                                        $('#createSlotButton').prop('disabled', true);
                                    }
                                }

                                // Handle Create Slot Button Click
                                $('#createSlotButton').on('click', function() {
                                    if (!schoolID || !teacherID) {
                                        $('#errorMessage').text('School or Teacher not found in the system.');
                                        if (!schoolID) {
                                            $('#addSchoolLink').attr('href', 'contacts.php?add=school&name=' + encodeURIComponent($('[id^=schoolCheck_]').prev().text()));
                                            $('#addSchoolLink').show();
                                        } else {
                                            $('#addSchoolLink').hide();
                                        }
                                        if (!teacherID) {
                                            $('#addTeacherLink').attr('href', 'contacts.php?add=teacher&name=' + encodeURIComponent($('[id^=teacherCheck_]').prev().text()) + '&number=' + encodeURIComponent($('[id^=teacherCheck_]').prev().text()));
                                            $('#addTeacherLink').show();
                                        } else {
                                            $('#addTeacherLink').hide();
                                        }
                                        $('#errorModal').modal('show');
                                        return;
                                    }

                                    // Show date selection boxes
                                    $('#dateSelectionContainer').show();
                                    $('#createSlotButton').prop('disabled', true);
                                });

                                // Handle Date Selection
                                $('.select-date-btn').on('click', function() {
                                    const dateType = $(this).data('date-type');
                                    const selectedDate = dateType === 'email' ? emailDateTime : alternativeDateTime;

                                    const payload = {
                                        function: 'InsertBookingSlot',
                                        BookingSlot_SchoolID: schoolID,
                                        BookingSlot_TeacherID: teacherID,
                                        BookingSlot_BookingDetailID: <?= json_encode($_SESSION['SelectedBookingID'] ?? '') ?>,
                                        BookingSlot_DateTime: selectedDate,
                                        BookingSlot_BookingStatus: 'New Show'
                                    };

                                    $.post('https://apiplayinc.spacegap.net/index.php', payload, function(res) {
                                        if (res.success && res.BookingSlotID) {
                                            $('#createSlotResult').html('<span style="color:green;">✅ Booking Slot Created. ID: ' + res.BookingSlotID + '</span>');
                                            $('#dateSelectionContainer').hide();
                                        } else {
                                            $('#createSlotResult').html('<span style="color:red;">❌ Failed to create booking slot: ' + (res.error || 'Unknown error') + '</span>');
                                            $('#createSlotButton').prop('disabled', false);
                                            $('#dateSelectionContainer').show();
                                        }
                                    }, 'json').fail(function() {
                                        $('#createSlotResult').html('<span style="color:red;">❌ Network or server error.</span>');
                                        $('#createSlotButton').prop('disabled', false);
                                        $('#dateSelectionContainer').show();
                                    });
                                });
                            });
                            </script>
                            <?php elseif ($_SESSION['ShowDashboard'] == 'ViewShowDetails' && isset($_SESSION['SelectedShowID'])): ?>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0 card-no-border">
                <h4>Details for Show ID: <?php echo htmlspecialchars($_SESSION['SelectedShowID']); ?></h4>
                <span>View detailed information about the selected show below, including cast and roles.</span>
            </div>
            <div class="card-body">
                <div id="showDetailsContainer">
                    <p>Loading show details…</p>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        const showId = <?php echo json_encode($_SESSION['SelectedShowID']); ?>;

        // Load show details
        $.ajax({
            url: 'https://apiplayinc.spacegap.net/index.php',
            method: 'POST',
            data: { function: 'displayShowDetails', ShowID: showId },
            dataType: 'json',
            success: function(data) {
                if (!data || data.length === 0) {
                    $('#showDetailsContainer').html('<p>No details found for this show.</p>');
                    return;
                }
                const show = data[0];
                let html = '<div class="detail-view">';
                html += `<div><strong>Show ID:</strong> ${show.ShowID || '-'}</div>`;
                html += `<div><strong>Show Name:</strong> ${show.ShowName || '-'}</div>`;
                html += `<div><strong>Duration:</strong> ${show.ShowDuration || '-'}</div>`;
                html += `<div><strong>Age Group:</strong> ${show.ShowAgeGroup || '-'}</div>`;
                html += `<div><strong>Short Description:</strong><br>${show.ShowShortDescription || '-'}</div>`;
                html += `<div><strong>Description:</strong><br>${show.ShowDescription || '-'}</div>`;
                html += '</div>';
                $('#showDetailsContainer').html(html);

                // Fetch actors
                $.ajax({
                    url: 'https://apiplayinc.spacegap.net/index.php',
                    method: 'POST',
                    data: { function: 'displayShowActors', ShowID: showId },
                    dataType: 'json',
                    success: function(actors) {
                        let actorHtml = '<h5>Cast & Roles</h5>';

                        if (!actors || actors.length === 0) {
                            actorHtml += '<p>No actors found for this show.</p>';
                        } else {
                            actorHtml += `
                                <div class="table-responsive theme-scrollbar custom-scrollbar">
                                    <table class="display" id="actorsTable" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Role Type</th>
                                                <th>Description</th>
                                                <th>Fee</th>
                                                <th>Notes</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                            `;
                            actors.forEach(actor => {
                                actorHtml += `
                                    <tr>
                                        <td>${actor.ShowActorRoleType || '-'}</td>
                                        <td>${actor.ShowActorRoleDescription || '-'}</td>
                                        <td>${actor.ShowActorFee || '-'}</td>
                                        <td>${actor.ShowActorNotes || '-'}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" onclick="deleteActor(${actor.ShowActorID})">Delete</button>
                                            <button class="btn btn-sm btn-warning" onclick="editActor(${actor.ShowActorID})">Edit</button>
                                        </td>
                                    </tr>`;
                            });
                            actorHtml += '</tbody></table></div>';
                        }

                        // Add Actor button
                        actorHtml += `
                            <div style="margin-top:15px;">
                                <button id="addActorButton" class="btn btn-success">Add Actor</button>
                            </div>`;

                        $('#showDetailsContainer').append(actorHtml);

                        // Initialize DataTable for actors table
                        $('#actorsTable').DataTable({
                            responsive: true,
                            scrollX: true,
                            ordering: true,
                            language: {
                                emptyTable: "No actors found."
                            }
                        });
                    },
                    error: function(_, textStatus) {
                        $('#showDetailsContainer').append(
                            `<p style="color:red;">Error loading cast: ${textStatus}</p>`
                        );
                    }
                });
            },
            error: function(_, textStatus) {
                $('#showDetailsContainer').html(
                    `<p style="color:red;">Error loading show details: ${textStatus}</p>`
                );
            }
        });

        // Edit Actor
        function editActor(actorId) {
            $.post('setSession.php', {
                ShowDashboard: 'EditActorForShow',
                SelectedActorID: actorId
            }, function(resp) {
                if (resp.trim() === 'success') {
                    window.location.href = 'dashboard.php';
                } else {
                    alert('Could not open edit form: ' + resp);
                }
            });
        }

        // Delete Actor
        function deleteActor(actorId) {
            if (!confirm('Are you sure you want to delete this actor role?')) return;
            $.post(
                'https://apiplayinc.spacegap.net/index.php',
                { function: 'deleteShowActor', ShowActorID: actorId },
                function(res) {
                    if (res.success) {
                        window.location.reload();
                    } else {
                        alert('Error deleting actor: ' + (res.error || 'Unknown'));
                    }
                },
                'json'
            ).fail(function() {
                alert('Network error while attempting delete.');
            });
        }

        // Add Actor
        $(document).on('click', '#addActorButton', function() {
            $.post('setSession.php', {
                ShowDashboard: 'AddActorForShow',
                SelectedShowID: showId
            }, function(response) {
                if (response.trim() === 'success') {
                    window.location.href = 'dashboard.php';
                } else {
                    alert('Failed to switch to Add Actor view: ' + response);
                }
            });
        });
    });
    </script>
    <?php elseif ($_SESSION['ShowDashboard'] == 'AddActorForShow'): ?>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0 card-no-border">
                <h4>Add Actor(s) to Show ID: <?php echo htmlspecialchars($_SESSION['SelectedShowID']); ?></h4>
                <span>Fill in the details below to add actors to the show.</span>
            </div>
            <div class="card-body">
                <div id="addActorFormContainer">
                    <form id="addActorForm">
                        <input type="hidden" name="ShowActorShowID" value="<?php echo htmlspecialchars($_SESSION['SelectedShowID']); ?>">
                        <div class="mb-3">
                            <label for="actorCount" class="form-label">How many actors to add?</label>
                            <select id="actorCount" class="form-select" style="width: auto;">
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div id="actorFields"></div>
                        <button id="insertActorButton" type="submit" class="btn btn-primary">Insert All Actors</button>
                    </form>
                    <div id="actorInsertResult" style="margin-top:10px;"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(function() {
        function renderActorFields(count) {
            const container = $('#actorFields').empty();
            for (let i = 0; i < count; i++) {
                container.append(`
                    <fieldset class="mb-3" style="padding:15px; border:1px solid #ddd; border-radius:5px;">
                        <legend>Actor ${i+1}</legend>
                        <div class="mb-2">
                            <label class="form-label">Role Type:</label>
                            <input type="text" name="ShowActorRoleType[]" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Description:</label>
                            <textarea name="ShowActorRoleDescription[]" class="form-control" required></textarea>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Fee:</label>
                            <input type="number" step="0.01" name="ShowActorFee[]" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Notes:</label>
                            <textarea name="ShowActorNotes[]" class="form-control"></textarea>
                        </div>
                    </fieldset>
                `);
            }
        }

        renderActorFields(1);

        $('#actorCount').on('change', function() {
            renderActorFields($(this).val());
        });

        $('#addActorForm').on('submit', function(e) {
            e.preventDefault();
            const payload = $(this).serializeArray();
            payload.push({ name: 'function', value: 'InsertShowActor' });

            $.post(
                'https://apiplayinc.spacegap.net/index.php',
                payload,
                function(res) {
                    if (res.success) {
                        $('#actorInsertResult').html(
                            `<span style="color:green;">✅ Inserted actor IDs: ${res.insertedIDs.join(', ')}</span>`
                        );
                    } else {
                        $('#actorInsertResult').html(
                            `<span style="color:red;">❌ Error: ${res.error || 'Unknown'}</span>`
                        );
                    }
                },
                'json'
            ).fail(function() {
                $('#actorInsertResult').html(
                    '<span style="color:red;">❌ Network or server error.</span>'
                );
            });
        });
    });
    </script>
                        <?php elseif ($_SESSION['ShowDashboard'] == 'Edm'): ?>
                            <div class="email-wrap email-main-wrapper">
                                <div class="row">
                                    <div class="col-xxl-3 col-xl-4 box-col-12">
                                        <div class="md-sidebar"> 
                                            <a class="btn btn-primary md-sidebar-toggle" href="javascript:void(0)">email filter</a>
                                            <div class="md-sidebar-aside job-left-aside custom-scrollbar">
                                                <div class="email-left-aside">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="email-app-sidebar">
                                                                <button class="btn btn-primary emailbox" type="button" data-bs-toggle="modal" data-bs-target="#compose_mail"><i class="fa fa-plus"></i>Compose Email</button>
                                                                <ul class="nav nav-pills main-menu email-category" id="email-pills-tab" role="tablist">
                                                                    <li class="nav-item"><a class="nav-link active" id="inbox-pill-tab" data-bs-toggle="pill" href="#inbox-pill" role="tab" aria-controls="inbox-pill" aria-selected="false">
                                                                        <svg class="stroke-icon"><use href="assets/svg/icon-sprite.svg#inbox"></use></svg>
                                                                        <div>Inbox<span class="badge">12</span></div></a></li>
                                                                    <li class="nav-item"><a class="nav-link" id="sent-pill-tab" data-bs-toggle="pill" href="#sent-pill" role="tab" aria-controls="sent-pill" aria-selected="false">
                                                                        <svg class="stroke-icon"><use href="assets/svg/icon-sprite.svg#sent"></use></svg>Sent</a></li>
                                                                    <li class="nav-item"><a class="nav-link" id="starred-pill-tab" data-bs-toggle="pill" href="#starred-pill" role="tab" aria-controls="starred-pill" aria-selected="false">
                                                                        <svg class="stroke-icon"><use href="assets/svg/icon-sprite.svg#star"></use></svg>Starred</a></li>
                                                                    <li class="nav-item"><a class="nav-link" id="draft-pill-tab" data-bs-toggle="pill" href="#draft-pill" role="tab" aria-controls="draft-pill" aria-selected="false">
                                                                        <svg class="stroke-icon"><use href="assets/svg/icon-sprite.svg#draft"></use></svg>Draft</a></li>
                                                                    <li class="nav-item"><a class="nav-link" id="trash-pill-tab" data-bs-toggle="pill" href="#trash-pill" role="tab" aria-controls="trash-pill" aria-selected="false">
                                                                        <svg class="stroke-icon"><use href="assets/svg/icon-sprite.svg#trash"></use></svg>Trash</a></li>
                                                                    <li class="nav-item"><a class="nav-link" id="work-pill-tab" data-bs-toggle="pill" href="#work-pill" role="tab" aria-controls="work-pill" aria-selected="false">
                                                                        <svg class="stroke-icon stroke-primary"><use href="assets/svg/icon-sprite.svg#pintag"></use></svg>Work</a></li>
                                                                    <li class="nav-item"><a class="nav-link" id="private-pill-tab" data-bs-toggle="pill" href="#private-pill" role="tab" aria-controls="private-pill" aria-selected="false">
                                                                        <svg class="stroke-icon stroke-warning"><use href="assets/svg/icon-sprite.svg#pintag"></use></svg>Private</a></li>
                                                                    <li class="nav-item"><a class="nav-link" id="support-pill-tab" data-bs-toggle="pill" href="#support-pill" role="tab" aria-controls="support-pill" aria-selected="false">
                                                                        <svg class="stroke-icon stroke-success"><use href="assets/svg/icon-sprite.svg#pintag"></use></svg>Support</a></li>
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
                                                                    <svg class="stroke-icon"><use href="assets/svg/icon-sprite.svg#mail"></use></svg><span class="f-w-600">Important </span></a></li>
                                                                <li class="nav-item"><a class="nav-link" data-bs-toggle="pill" href="#!" role="tab" aria-selected="false">
                                                                    <svg class="stroke-icon"><use href="assets/svg/icon-sprite.svg#goal"></use></svg><span class="f-w-600">Social</span></a></li>
                                                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="pill" href="#!" role="tab" aria-selected="false">
                                                                    <svg class="stroke-icon"><use href="assets/svg/icon-sprite.svg#tread"></use></svg><span class="f-w-600">Promotion</span></a></li>
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
                                                                        <label class="col-sm-2 col-form-label" for="composeFrom">School</label>
                                                                        <div class="col-sm-10">
                                                                            <select class="col-12 h-100 rounded-2" name="school" id="schoolList">
                                                                                <option value="" selected disabled>Select an option</option>
                                                                                <option value="">School 1</option>
                                                                            </select>
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
                                                                        <svg class="important-mail active"><use href="assets/svg/icon-sprite.svg#fill-star"></use></svg>
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
                                                                        <svg class="important-mail"><use href="assets/svg/icon-sprite.svg#fill-star"></use></svg>
                                                                        <div class="rounded-border"><img class="img-fluid" src="assets/images/user/3.png" alt="user"></div>
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
                                                                <!-- Add more <li> elements as needed, or fetch dynamically via AJAX -->
                                                            </ul>
                                                        </div>
                                                        <div class="mail-pagination">
                                                            <button class="pagination-button" id="prev-button" aria-label="Previous page" title="Previous page"><</button>
                                                            <div class="pagination-index" id="pagination-numbers"></div>
                                                            <button class="pagination-button" id="next-button" aria-label="Next page" title="Next page">></button>
                                                        </div>
                                                    </div>
                                                    <!-- Add other tab panes (sent-pill, starred-pill, etc.) if needed -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php elseif ($_SESSION['ShowDashboard'] == 'WhatsApp'): ?>
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
                                                        Add to favorites</a></div>
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
                                                <div class="msg-text">Hey, I'm looking to redesign my website. Can you help me? 😄</div>
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
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>
            <!-- Page Content Ends-->
        </div>
    </div>
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
    <script src="assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="assets/js/datepicker/date-picker/datepicker.custom.js"></script>
    <!-- Add Dropzone JS for Create Show form -->
    <script src="assets/js/dropzone/dropzone.js"></script>
    <script src="assets/js/dropzone/dropzone-script.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <!-- DataTables JS -->
    <script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
    <!-- Optional: If datatable_advance.js contains necessary customizations -->
    <script src="assets/js/datatable/datatable_advance.js"></script>
    <!-- Shared booking table script and sidebar highlight -->
    <script>
        $(document).ready(function() {
            // Existing code for simplebar initialization
            if (typeof $.fn.simplebar !== 'undefined') {
                $('#simple-bar').each(function() {
                    new SimpleBar(this);
                });
            }

            // Highlight the active sidebar item
            const currentPage = '<?php echo $_SESSION['ShowDashboard']; ?>'.toLowerCase();
            $('.sidebar-list').removeClass('active'); // Remove active class from all items
            $('.sidebar-link').each(function() {
                const href = $(this).attr('href');
                let pageToMatch = '';
                if (currentPage === 'dashboard') {
                    pageToMatch = '?page=home';
                } else if (currentPage === 'manageshows' || currentPage === 'viewshowdetails' || currentPage === 'addactorforshow') {
                    pageToMatch = '?page=manage_shows';
                } else if (currentPage === 'edm') {
                    pageToMatch = '?page=edm';
                }
                if (href === pageToMatch) {
                    $(this).closest('.sidebar-list').addClass('active');
                }
            });
        });
    </script>
</body>
</html>