<?php
// Ensure session is started (already handled in dashboard.php, but included for completeness)
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
?>

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h4>School Information</h4>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                            <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Apps</li>
                    <li class="breadcrumb-item active">School Information</li>
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
                <div class="md-sidebar"><a class="btn btn-primary md-sidebar-toggle" href="javascript:void(0)">School filter</a>
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
                                                <button class="btn-primary btn-block btn-mail w-100" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="me-2" data-feather="users"></i> New School</button>
                                                <div class="modal fade modal-bookmark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title f-w-500" id="exampleModalLabel">Add School</h5>
                                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                                                                    <div class="row g-2">
                                                                        <div class="mb-3 col-md-12 mt-0">
                                                                            <label for="con-name">School Name</label>
                                                                            <div class="row">
                                                                                <div class="col-sm-6">
                                                                                    <input class="form-control" id="con-name" type="text" required="" placeholder="School Name" autocomplete="off">
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <input class="form-control" id="con-last" type="text" required="" placeholder="Branch Name" autocomplete="off">
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
                                                                                        <option>Office</option>
                                                                                        <option>Mobile</option>
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
                                            <li><a id="pills-personal-tab" data-bs-toggle="pill" href="#pills-personal" role="tab" aria-controls="pills-personal" aria-selected="true"><span class="title"> Primary Schools</span></a></li>
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
                                            <li><a class="show" id="pills-organization-tab" data-bs-toggle="pill" href="#pills-organization" role="tab" aria-controls="pills-organization" aria-selected="false"><span class="title"> Secondary Schools</span></a></li>
                                            <li><a href="#"><span class="title">International Schools</span></a></li>
                                            <li><a href="#"><span class="title">Favorites</span></a></li>
                                            <li><a href="#"><span class="title">Special Needs</span></a></li>
                                            <li><a href="#"><span class="title">Public</span></a></li>
                                            <li><a href="#"><span class="title">Private</span></a></li>
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
                                            <h5 class="f-w-600">Primary Schools</h5><span class="f-14 pull-right mt-0">5 Schools</span>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="row list-persons" id="addcon">
                                                <div class="col-xl-4 xl-50 col-md-5">
                                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                        <a class="contact-tab-0 nav-link active" id="v-pills-user-tab" data-bs-toggle="pill" onclick="activeDiv(0)" href="#v-pills-user" role="tab" aria-controls="v-pills-user" aria-selected="true">
                                                            <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle update_img_0" src="assets/images/user/2.png" alt="">
                                                                <div class="media-body">
                                                                    <h6><span class="first_name_0">Sunrise </span><span class="last_name_0">Primary</span></h6>
                                                                    <p class="email_add_0">sunrise@gmail.com</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="contact-tab-1 nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" onclick="activeDiv(1)" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                                            <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle update_img_1" src="assets/images/user/8.jpg" alt="">
                                                                <div class="media-body">
                                                                    <h6><span class="first_name_1">Greenview </span><span class="last_name_1">Primary</span></h6>
                                                                    <p class="email_add_1">greenview@gmail.com</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="contact-tab-2 nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" onclick="activeDiv(2)" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                                            <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle update_img_2" src="assets/images/user/1.jpg" alt="">
                                                                productively                                                                <div class="media-body">
                                                                    <h6><span class="first_name_2">Maple </span><span class="last_name_2">Primary</span></h6>
                                                                    <p class="email_add_2">maple@gmail.com</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="contact-tab-3 nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" onclick="activeDiv(3)" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                                            <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle update_img_3" src="assets/images/user/14.png" alt="">
                                                                <div class="media-body">
                                                                    <h6><span class="first_name_3">Oakwood </span><span class="last_name_3">Primary</span></h6>
                                                                    <p class="email_add_3">oakwood@gmail.com</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="contact-tab-4 nav-link" id="v-pills-contact1-tab" data-bs-toggle="pill" onclick="activeDiv(4)" href="#v-pills-contact1" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                                            <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle update_img_4" src="assets/images/user/5.jpg" alt="">
                                                                <div class="media-body">
                                                                    <h6><span class="first_name_4">Riverdale </span><span class="last_name_4">Primary</span></h6>
                                                                    <p class="email_add_4">riverdale@gmail.com</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8 xl-50 col-md-7">
                                                    <div class="tab-content" id="v-pills-tabContent">
                                                        <div class="tab-pane contact-tab-0 tab-content-child fade show active" id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-user-tab">
                                                            <div class="profile-mail">
                                                                <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_0" src="assets/images/user/2.png" alt="">
                                                                    <input class="updateimg" type="file" name="img" onchange="readURL(this,0)">
                                                                    <div class="media-body mt-0">
                                                                        <h5><span class="first_name_0">Sunrise </span><span class="last_name_0">Primary</span></h5>
                                                                        <p class="email_add_0">sunrise@gmail.com</p>
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
                                                                        <li>School Name <span class="font-primary first_name_0">Sunrise Primary</span></li>
                                                                        <li>Type <span class="font-primary">Public</span></li>
                                                                        <li>Established<span class="font-primary"> <span class="birth_day_0">1990</span></span></li>
                                                                        <li>Principal<span class="font-primary personality_0">John Doe</span></li>
                                                                        <li>City<span class="font-primary city_0">Moline Acres</span></li>
                                                                        <li>Phone<span class="font-primary mobile_num_0">+0 1800 76855</span></li>
                                                                        <li>Email Address <span class="font-primary email_add_0">sunrise@gmail.com</span></li>
                                                                        <li>Website<span class="font-primary url_add_0">www.sunriseprimary.com</span></li>
                                                                        <li>Specialization<span class="font-primary interest_0">STEM</span></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane contact-tab-1 tab-content-child fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                                            <div class="profile-mail">
                                                                <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_1" src="assets/images/user/8.jpg" alt="">
                                                                    <input class="updateimg" type="file" name="img" onchange="readURL(this,1)">
                                                                    <div class="media-body mt-0">
                                                                        <h5><span class="first_name_1">Greenview </span><span class="last_name_1">Primary</span></h5>
                                                                        <p class="email_add_1">greenview@gmail.com</p>
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
                                                                        <li>School Name <span class="font-primary first_name_1">Greenview</span></li>
                                                                        <li>Type <span class="font-primary">Private</span></li>
                                                                        <li>Established<span class="font-primary"> <span class="birth_day_1">1985</span></span></li>
                                                                        <li>Principal<span class="font-primary personality_1">Jane Smith</span></li>
                                                                        <li>City<span class="font-primary city_1">Delhi</span></li>
                                                                        <li>Phone<span class="font-primary mobile_num_1">+0 1800 55812</span></li>
                                                                        <li>Email Address <span class="font-primary email_add_1">greenview@gmail.com</span></li>
                                                                        <li>Website<span class="font-primary url_add_1">www.greenviewprimary.com</span></li>
                                                                        <li>Specialization<span class="font-primary interest_1">Arts</span></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane contact-tab-2 tab-content-child fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                                            <div class="profile-mail">
                                                                <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_2" src="assets/images/user/1.jpg" alt="">
                                                                    <input class="updateimg" type="file" name="img" onchange="readURL(this,2)">
                                                                    <div class="media-body mt-0">
                                                                        <h5><span class="first_name_2">Maple </span><span class="last_name_2">Primary</span></h5>
                                                                        <p class="email_add_2">maple@gmail.com</p>
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
                                                                        <li>School Name <span class="font-primary first_name_2">Maple</span></li>
                                                                        <li>Type <span class="font-primary">Public</span></li>
                                                                        <li>Established<span class="font-primary"> <span class="birth_day_2">1995</span></span></li>
                                                                        <li>Principal<span class="font-primary personality_2">Robert Brown</span></li>
                                                                        <li>City<span class="font-primary city_2">Mumbai</span></li>
                                                                        <li>Phone<span class="font-primary mobile_num_2">+0 1800 87412</span></li>
                                                                        <li>Email Address <span class="font-primary email_add_2">maple@gmail.com</span></li>
                                                                        <li>Website<span class="font-primary url_add_2">www.mapleprimary.com</span></li>
                                                                        <li>Specialization<span class="font-primary interest_2">Sports</span></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane contact-tab-3 tab-content-child fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                                            <div class="profile-mail">
                                                                <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_3" src="assets/images/user/14.png" alt="">
                                                                    <input class="updateimg" type="file" name="img" onchange="readURL(this,3)">
                                                                    <div class="media-body mt-0">
                                                                        <h5><span class="first_name_3">Oakwood </span><span class="last_name_3">Primary</span></h5>
                                                                        <p class="email_add_3">oakwood@gmail.com</p>
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
                                                                        <li>School Name <span class="font-primary first_name_3">Oakwood</span></li>
                                                                        <li>Type <span class="font-primary">Private</span></li>
                                                                        <li>Established<span class="font-primary"> <span class="birth_day_3">1988</span></span></li>
                                                                        <li>Principal<span class="font-primary personality_3">Alice Johnson</span></li>
                                                                        <li>City<span class="font-primary city_3">Amreli</span></li>
                                                                        <li>Phone<span class="font-primary mobile_num_3">+0 1800 79877</span></li>
                                                                        <li>Email Address <span class="font-primary email_add_3">oakwood@gmail.com</span></li>
                                                                        <li>Website<span class="font-primary url_add_3">www.oakwoodprimary.com</span></li>
                                                                        <li>Specialization<span class="font-primary interest_3">Science</span></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane contact-tab-4 tab-content-child fade" id="v-pills-contact1" role="tabpanel" aria-labelledby="v-pills-contact1-tab">
                                                            <div class="profile-mail">
                                                                <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_4" src="assets/images/user/5.jpg" alt="">
                                                                    <input class="updateimg" type="file" name="img" onchange="readURL(this,4)">
                                                                    <div class="media-body mt-0">
                                                                        <h5><span class="first_name_4">Riverdale </span><span class="last_name_4">Primary</span></h5>
                                                                        <p class="email_add_4">riverdale@gmail.com</p>
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
                                                                        <li>School Name <span class="font-primary first_name_4">Riverdale</span></li>
                                                                        <li>Type <span class="font-primary">Public</span></li>
                                                                        <li>Established<span class="font-primary"> <span class="birth_day_4">1992</span></span></li>
                                                                        <li>Principal<span class="font-primary personality_4">Michael Lee</span></li>
                                                                        <li>City<span class="font-primary city_4">Delhi</span></li>
                                                                        <li>Phone<span class="font-primary mobile_num_4">+0 1800 11547</span></li>
                                                                        <li>Email Address <span class="font-primary email_add_4">riverdale@gmail.com</span></li>
                                                                        <li>Website<span class="font-primary url_add_4">www.riverdaleprimary.com</span></li>
                                                                        <li>Specialization<span class="font-primary interest_4">Mathematics</span></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="contact-editform ps-0">
                                                        <form>
                                                            <div class="row g-2">
                                                                <div class="mt-0 mb-3 col-md-12">
                                                                    <label>School Name</label>
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <input class="form-control" id="first_name" type="text" required="" placeholder="School Name" value="school_name">
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <input class="form-control" id="last_name" type="text" required="" placeholder="Branch Name" value="branch_name">
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
                                                                                <option>Office</option>
                                                                                <option>Mobile</option>
                                                                                <option>Others</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-0 mb-3 col-md-12">
                                                                    <label>Address</label>
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
                                                                <div class="mt-0 mb-3 col-md-12">
                                                                    <label>Establishment Year</label>
                                                                    <input class="form-control" id="birth_year" type="text" placeholder="Year">
                                                                </div>
                                                                <div class="mt-0 mb-3 col-md-12">
                                                                    <label>Principal</label>
                                                                    <input class="form-control" id="principal" type="text" required="" autocomplete="off">
                                                                </div>
                                                                <div class="mt-0 mb-3 col-md-12">
                                                                    <label>Specialization</label>
                                                                    <input class="form-control" id="specialization" type="text" required="" autocomplete="off">
                                                                </div>
                                                            </div>
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
                                            <h5>Secondary Schools</h5><span class="f-14 pull-right mt-0">3 Schools</span>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="row list-persons">
                                                <div class="col-xl-4 xl-50 col-md-5">
                                                    <div class="nav flex-column nav-pills" id="v-pills-tab1" role="tablist" aria-orientation="vertical">
                                                        <a class="nav-link active" id="v-pills-iduser-tab" data-bs-toggle="pill" href="#v-pills-iduser" role="tab" aria-controls="v-pills-iduser" aria-selected="true">
                                                            <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" src="assets/images/user/user.png" alt="">
                                                                <div class="media-body">
                                                                    <h6 class="f-w-600">Horizon Secondary</h6>
                                                                    <p>horizon@gmail.com</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="nav-link" id="v-pills-iduser1-tab" data-bs-toggle="pill" href="#v-pills-iduser1" role="tab" aria-controls="v-pills-iduser1" aria-selected="false">
                                                            <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" src="assets/images/user/3.jpg" alt="">
                                                                <div class="media-body">
                                                                    <h6>Starlight Secondary</h6>
                                                                    <p>starlight@gmail.com</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <a class="nav-link" id="v-pills-iduser2-tab" data-bs-toggle="pill" href="#v-pills-iduser2" role="tab" aria-controls="v-pills-iduser2" aria-selected="false">
                                                            <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" src="assets/images/user/4.jpg" alt="">
                                                                <div class="media-body">
                                                                    <h6>Crestwood Secondary</h6>
                                                                    <p>crestwood@gmail.com</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-xl-8 xl-50 col-md-7">
                                                    <div class="tab-content" id="v-pills-tabContent1">
                                                        <div class="tab-pane fade show active" id="v-pills-iduser" role="tabpanel" aria-labelledby="v-pills-iduser-tab">
                                                            <div class="profile-mail">
                                                                <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_5" src="assets/images/user/user.png" alt="">
                                                                    <div class="media-body mt-0">
                                                                        <h5><span class="first_name_5">Horizon </span><span class="last_name_5">Secondary</span></h5>
                                                                        <p class="email_add_5">horizon@gmail.com</p>
                                                                        <ul>
                                                                            <li><a href="#" onclick="printContact(5)" data-bs-toggle="modal" data-bs-target="#printModal">Print</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="email-general">
                                                                    <h6>General</h6>
                                                                    <p>School Name: <span class="font-primary email_add_5">Horizon Secondary</span></p>
                                                                    <p>Type: <span>Public</span></p>
                                                                    <p>Established: <span>1980</span></p>
                                                                    <p>Principal: <span>David Wilson</span></p>
                                                                    <p>City: <span>Ahemdabad</span></p>
                                                                    <p>Phone: <span>+0 1800 58712</span></p>
                                                                    <p>Email Address: <span class="font-primary">horizon@gmail.com</span></p>
                                                                    <p>Website: <span>www.horizonsecondary.com</span></p>
                                                                    <p>Specialization: <span>Technology</span></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="v-pills-iduser1" role="tabpanel" aria-labelledby="v-pills-iduser1-tab">
                                                            <div class="profile-mail">
                                                                <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_6" src="assets/images/user/3.jpg" alt="">
                                                                    <div class="media-body mt-0">
                                                                        <h5><span class="first_name_6">Starlight </span><span class="last_name_6">Secondary</span></h5>
                                                                        <p class="email_add_6">starlight@gmail.com</p>
                                                                        <ul>
                                                                            <li><a href="#" onclick="printContact(6)" data-bs-toggle="modal" data-bs-target="#printModal">Print</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="email-general">
                                                                    <h6>General</h6>
                                                                    <p>School Name: <span class="font-primary email_add_6">Starlight Secondary</span></p>
                                                                    <p>Type: <span>Private</span></p>
                                                                    <p>Established: <span>1990</span></p>
                                                                    <p>Principal: <span>Emma Davis</span></p>
                                                                    <p>City: <span>Delhi</span></p>
                                                                    <p>Phone: <span>+0 1800 66432</span></p>
                                                                    <p>Email Address: <span class="font-primary">starlight@gmail.com</span></p>
                                                                    <p>Website: <span>www.starlightsecondary.com</span></p>
                                                                    <p>Specialization: <span>Literature</span></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="v-pills-iduser2" role="tabpanel" aria-labelledby="v-pills-iduser2-tab">
                                                            <div class="profile-mail">
                                                                <div class="media"><img class="img-100 img-fluid m-r-20 rounded-circle update_img_7" src="assets/images/user/4.jpg" alt="">
                                                                    <div class="media-body mt-0">
                                                                        <h5><span class="first_name_7">Crestwood </span><span class="last_name_7">Secondary</span></h5>
                                                                        <p class="email_add_7">crestwood@gmail.com</p>
                                                                        <ul>
                                                                            <li><a href="#" onclick="printContact(7)" data-bs-toggle="modal" data-bs-target="#printModal">Print</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="email-general">
                                                                    <h6>General</h6>
                                                                    <p>School Name: <span class="font-primary email_add_7">Crestwood Secondary</span></p>
                                                                    <p>Type: <span>Public</span></p>
                                                                    <p>Established: <span>1985</span></p>
                                                                    <p>Principal: <span>Sarah Thompson</span></p>
                                                                    <p>City: <span>Mumbai</span></p>
                                                                    <p>Phone: <span>+0 1800 77543</span></p>
                                                                    <p>Email Address: <span class="font-primary">crestwood@gmail.com</span></p>
                                                                    <p>Website: <span>www.crestwoodsecondary.com</span></p>
                                                                    <p>Specialization: <span>History</span></p>
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
                                        <h6 class="modal-title w-100">School History<span class="pull-right"><a class="closehistory" href="#"><i class="icofont icofont-close"></i></a></span></h6>
                                    </div>
                                    <div class="history-details">
                                        <div class="text-center"><i class="icofont icofont-ui-edit"></i>
                                            <p>School has not been modified yet.</p>
                                        </div>
                                        <div class="media"><i class="icofont icofont-star me-3"></i>
                                            <div class="media-body mt-0">
                                                <h6 class="mt-0">School Created</h6>
                                                <p class="mb-0">School is created via admin panel</p><span class="f-12">Sep 10, 2019 4:00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade modal-bookmark" id="printModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Print Preview</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body list-persons">
                                                <div class="profile-mail pt-0" id="DivIdToPrint">
                                                    <div class="media"><img class="img-50 img-fluid m-r-20 rounded-circle" id="updateimg" src="assets/images/user/2.png" alt="">
                                                        <div class="media-body mt-0">
                                                            <h5><span id="printname">Sunrise</span><span id="printlast">Primary</span></h5>
                                                            <p id="printmail">sunrise@gmail.com</p>
                                                        </div>
                                                    </div>
                                                    <div class="email-general">
                                                        <h6>General</h6>
                                                        <p>School Name: <span class="font-primary" id="mailadd">Sunrise Primary</span></p>
                                                        <p>Type: <span>Public</span></p>
                                                        <p>Established: <span>1990</span></p>
                                                        <p>Principal: <span>John Doe</span></p>
                                                        <p>City: <span>Moline Acres</span></p>
                                                        <p>Phone: <span>+0 1800 76855</span></p>
                                                        <p>Email Address: <span class="font-primary">sunrise@gmail.com</span></p>
                                                        <p>Website: <span>www.sunriseprimary.com</span></p>
                                                        <p>Specialization: <span>STEM</span></p>
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