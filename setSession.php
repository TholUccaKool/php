<?php
session_start();

// Set SchoolID
if (isset($_POST['SchoolID'])) {
    $_SESSION['SchoolID'] = $_POST['SchoolID'];
}

// Set TeacherID
if (isset($_POST['TeacherID'])) {
    $_SESSION['TeacherID'] = $_POST['TeacherID'];
}

// Set ShowDashboard only
if (isset($_POST['ShowDashboard']) && !isset($_POST['bookingId']) && !isset($_POST['SelectedSlotTime']) && !isset($_POST['SelectedShowID'])) {
    $_SESSION['ShowDashboard'] = $_POST['ShowDashboard'];
    echo "success";
    exit;
}

// Set SelectedBookingID and redirect to ViewDetails
if (isset($_POST['bookingId'])) {
    $_SESSION['SelectedBookingID'] = $_POST['bookingId'];
    $_SESSION['ShowDashboard'] = 'ViewDetails';
    session_write_close();
    echo "success";
    exit;
}

// Set slot time with dashboard redirection
if (isset($_POST['ShowDashboard']) && isset($_POST['SelectedSlotTime'])) {
    $_SESSION['ShowDashboard'] = $_POST['ShowDashboard'];
    $_SESSION['SelectedSlotTime'] = $_POST['SelectedSlotTime'];
    echo "success";
    exit;
}

// Set SelectedShowID and ShowDashboard for ViewShowDetails or AddActorForShow
if (isset($_POST['ShowDashboard']) && isset($_POST['SelectedShowID'])) {
    $_SESSION['ShowDashboard'] = $_POST['ShowDashboard'];
    $_SESSION['SelectedShowID'] = $_POST['SelectedShowID'];
    echo "success";
    exit;
}

// Set SelectedActorID and ShowDashboard for EditActorForShow
if (isset($_POST['ShowDashboard']) && isset($_POST['SelectedActorID'])) {
    $_SESSION['ShowDashboard'] = $_POST['ShowDashboard'];
    $_SESSION['SelectedActorID'] = $_POST['SelectedActorID'];
    echo "success";
    exit;
}

// If nothing matches
echo "fail";
?>