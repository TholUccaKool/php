<?php
session_start();
$_SESSION['UserID'] = $_POST['UserID'];
$_SESSION['UserRole'] = $_POST['UserRole'];
$_SESSION['UserEmail'] = $_POST['UserEmail'];
echo json_encode(['success' => true]);
?>