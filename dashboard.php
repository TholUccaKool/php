<?php
session_start();

var_dump($_GET['page']);

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
        if (strtolower($userRole) === 'freelancer') {
            $_SESSION['ShowDashboard'] = 'FreelancerDashboard';
        } else {
            $_SESSION['ShowDashboard'] = 'Dashboard';
        }
    } elseif ($_GET['page'] == 'manage_shows') {
        $_SESSION['ShowDashboard'] = 'ManageShows';
    } elseif ($_GET['page'] == 'edm') {
        $_SESSION['ShowDashboard'] = 'Edm';
    } elseif ($_GET['page'] == 'whatsApp') {
        $_SESSION['ShowDashboard'] = 'WhatsApp';
    } elseif ($_GET['page'] == 'school_information') {
        $_SESSION['ShowDashboard'] = 'SchoolInformation';
    } elseif ($_GET['page'] == 'calendar') {
        $_SESSION['ShowDashboard'] = 'Calendar';
    } elseif ($_GET['page'] == 'admin_ynm') {
        $_SESSION['ShowDashboard'] = 'AdminYNM';
    }
    
} elseif (!isset($_SESSION['ShowDashboard'])) {
    if (strtolower($userRole) === 'freelancer') {
        $_SESSION['ShowDashboard'] = 'FreelancerDashboard';
    } else {
        $_SESSION['ShowDashboard'] = 'Dashboard';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'components/dashboard_head.php'; ?>
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
        <!-- Page Header -->
        <?php include 'components/dashboard_page_header.php'; ?>
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
                                <?php include 'components/admin_sidebar.php'; ?>
                            <?php elseif (strtolower($userRole) === "freelancer"): ?>
                                <?php include 'components/freelancer_sidebar.php'; ?>
                            <?php elseif (strtolower($userRole) === "agency"): ?>
                                <!-- Add agency-specific sidebar items if needed -->
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                </nav>
            </div>
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
                                    } elseif ($_SESSION['ShowDashboard'] == 'SchoolInformation') {
                                        echo 'School Information';
                                    } elseif ($_SESSION['ShowDashboard'] == 'FreelancerDashboard') {
                                        echo 'Dashboard';
                                    } elseif ($_SESSION['ShowDashboard'] == 'Calendar') {
                                        echo 'Calendar';
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
                        <?php
                        if ($_SESSION['ShowDashboard'] == 'Dashboard') {
                            // View Teachers' Booking Table (Admin)
                            include 'components/view_all_booking.php';
                        } elseif ($_SESSION['ShowDashboard'] == 'FreelancerDashboard') {
                            // Freelancer Dashboard
                            include 'components/freelancer_slot_booking.php';
                        } elseif ($_SESSION['ShowDashboard'] == 'ManageShows') {
                            // View All Shows from Client Table
                            include 'components/manage_shows.php';
                        } elseif ($_SESSION['ShowDashboard'] == 'ViewDetails' && isset($_SESSION['SelectedBookingID'])) {
                            // View Specific Teachers Booking Details
                            include 'components/view_booking_details.php';
                        } elseif ($_SESSION['ShowDashboard'] == 'ViewShowDetails' && isset($_SESSION['SelectedShowID'])) {
                            // View Specific Show Details From Client
                            include 'components/view_show_details.php';
                        } elseif ($_SESSION['ShowDashboard'] == 'AddActorForShow') {
                            // Admin to Add Actors and Roles
                            include 'components/add_actor_and_role.php';
                        } elseif ($_SESSION['ShowDashboard'] == 'Edm') {
                            // Admin to EDM (send show details to teachers through EDM)
                            include 'components/edm.php';
                        } elseif ($_SESSION['ShowDashboard'] == 'WhatsApp') {
                            // WhatsApp
                            include 'components/whatsapp.php';
                        } elseif ($_SESSION['ShowDashboard'] == 'SchoolInformation') {
                            // School Information
                            include 'components/school_information.php';
                            // Added This
                        } elseif ($_SESSION['ShowDashboard'] == 'AdminYNM') {
                            include 'components/freelance.php';
                            // I added this
                        } elseif ($_SESSION['ShowDashboard'] == 'Calendar') {
                            // Calendar
                            include 'components/calendar.php';
                        }
                        ?>
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
                if (currentPage === 'dashboard' || currentPage === 'freelancerdashboard') {
                    pageToMatch = '?page=home';
                } else if (currentPage === 'manageshows' || currentPage === 'viewshowdetails' || currentPage === 'addactorforshow') {
                    pageToMatch = '?page=manage_shows';
                } else if (currentPage === 'edm') {
                    pageToMatch = '?page=edm';
                } else if (currentPage === 'whatsapp') {
                    pageToMatch = '?page=whatsApp';
                } else if (currentPage === 'schoolinformation') {
                    pageToMatch = '?page=school_information';
                }
                if (href === pageToMatch) {
                    $(this).closest('.sidebar-list').addClass('active');
                }
            });
        });
    </script>
</body>
</html>