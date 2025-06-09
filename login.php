<?php
// Start the session and set the cookie path to root
session_set_cookie_params([
    'path' => '/', // Make session cookie accessible across all directories
    'httponly' => true // Enhance security
]);
session_start();

// Debug: Log the session ID to confirm it's consistent
error_log("Session ID in login.php: " . session_id());
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
    <title>Riho - Premium Admin Template</title>
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
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
    <!-- Custom CSS for OTP alignment -->
    <style>
        .login-main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 400px; /* Ensure enough height for centering */
            padding: 20px;
        }
        .authenticate {
            width: 100%;
            max-width: 350px; /* Slightly narrower for better balance */
            text-align: center;
        }
        .authenticate h4 {
            margin-bottom: 10px;
        }
        .authenticate span {
            display: block;
            margin-bottom: 5px;
        }
        .otp-form {
            margin-top: 20px;
        }
        .otp-form h5 {
            margin-bottom: 15px;
            font-size: 16px;
        }
        .otp-generate {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-bottom: 25px;
        }
        .code-input {
            width: 40px !important;
            height: 40px !important;
            text-align: center;
            background-color: #fff !important;
            border: 1px solid #ced4da !important;
            border-radius: 4px !important;
            font-size: 16px;
            padding: 0 !important;
            line-height: 40px;
        }
        .code-input:focus {
            outline: none;
            border-color: #007bff !important;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3) !important;
        }
        .otp-form .btn-primary {
            width: 260px; /* Matches 6 inputs (40px each) + 5 gaps (10px each) */
            margin-bottom: 20px;
        }
        .otp-form .text-center {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">    
                <div class="login-card login-dark">
                    <div>
                        <div>
                            <a class="logo" href="dashboard.php">
                                <img class="img-fluid for-dark" src="assets/images/logo/client_logo.png" alt="looginpage">
                                <img class="img-fluid for-light" src="assets/images/logo/client_logo.png" alt="looginpage">
                            </a>
                        </div>
                        <div class="login-main"> 
                            <div id="emailSection">
                                <form id="emailForm" class="theme-form">
                                    <h4>Sign in to account</h4>
                                    <p>Enter your email</p>
                                    <div class="form-group">
                                        <label class="col-form-label">Email Address</label>
                                        <input class="form-control" type="email" id="email" name="email" required placeholder="Test@gmail.com" autofocus>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="text-end mt-3">
                                            <button class="btn btn-primary btn-block w-100" type="submit">Get OTP</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="otpSection" style="display: none;">
                                <div class="authenticate">
                                    <h4>Verification code</h4>
                                    <span>We've sent a verification code to</span>
                                    <span id="userEmailDisplay"></span>
                                    <form id="otpForm" class="otp-form">
                                        <h5>Your OTP Code here:</h5>
                                        <div class="otp-generate">
                                            <input class="code-input" type="text" maxlength="1" required autofocus>
                                            <input class="code-input" type="text" maxlength="1" required>
                                            <input class="code-input" type="text" maxlength="1" required>
                                            <input class="code-input" type="text" maxlength="1" required>
                                            <input class="code-input" type="text" maxlength="1" required>
                                            <input class="code-input" type="text" maxlength="1" required>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Verify</button>
                                        <div class="text-center"> 
                                            <span>Not received your code? </span>
                                            <span><a href="javascript:void(0)" id="resendOtp">Resend</a></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- latest jquery-->
        <script src="assets/js/jquery.min.js"></script>
        <!-- Bootstrap js-->
        <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
        <!-- feather icon js-->
        <script src="assets/js/icons/feather-icon/feather.min.js"></script>
        <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
        <!-- Theme js-->
        <script src="assets/js/script.js"></script>
        <script>
            // Debug: Confirm script version
            console.log("Running updated OTP script v10");

            // Debug: Log the current URL to confirm the script's location
            console.log("Current script location:", window.location.href);

            // Initialize Feather icons
            if (typeof feather !== 'undefined') {
                feather.replace();
            }

            // Auto-focus next OTP input field
            const otpInputs = document.querySelectorAll('.code-input');
            otpInputs.forEach((input, index) => {
                input.addEventListener('input', () => {
                    if (input.value.length === 1 && index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }
                });
                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && input.value.length === 0 && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                });
            });

            // Handle email form submission
            document.getElementById("emailForm").addEventListener("submit", async function (e) {
                e.preventDefault();
                console.log("Email form submitted");

                const email = document.getElementById("email").value;
                const formData = new FormData();
                formData.append("email", email);
                formData.append("doCheckFunction", "LoginCheckEmail");

                try {
                    const response = await fetch("https://apiplayinc.spacegap.net/test.php", {
                        method: "POST",
                        body: formData
                    });

                    const result = await response.json();
                    console.log("Email Submission Response:", result);

                    if (result.success === true && result.message === "OTP inserted and email sent") {
                        alert("OTP sent to your email.");
                        // Update the email display in the OTP section
                        document.getElementById("userEmailDisplay").textContent = email;
                        document.getElementById("emailSection").style.display = "none";
                        document.getElementById("otpSection").style.display = "block";
                    } else {
                        alert(result.message || "Email not found.");
                    }
                } catch (error) {
                    console.error("Email Submission Error:", error);
                    alert("An error occurred. Please try again.");
                }
            });

            // Handle OTP form submission
            document.getElementById("otpForm").addEventListener("submit", async function (e) {
                e.preventDefault();
                console.log("OTP form submitted");

                const email = document.getElementById("email").value;
                const otp = Array.from(otpInputs).map(input => input.value).join('');

                // Debug: Log the email and OTP being sent
                console.log("Email sent for OTP verification:", email);
                console.log("OTP sent for verification:", otp);

                // Ensure email and OTP are not empty
                if (!email || !otp || otp.length !== 6) {
                    console.log("Validation failed: Email or OTP is invalid.");
                    alert("Please ensure all OTP fields are filled and email is valid.");
                    otpInputs.forEach(input => input.value = "");
                    otpInputs[0].focus();
                    return;
                }

                const formData = new FormData();
                formData.append("email", email);
                formData.append("otp", otp);
                formData.append("doCheckFunction", "LoginCheckOTP");

                try {
                    const response = await fetch("https://apiplayinc.spacegap.net/test.php", {
                        method: "POST",
                        body: formData
                    });
                    const result = await response.json();
                    console.log("OTP Verification Response:", result);

                    if (result.success === true) {
                        console.log("OTP verification successful, storing session...");
                        const sessionData = new FormData();
                        sessionData.append("UserID", result.UserID);
                        sessionData.append("UserRole", result.UserRole);
                        sessionData.append("UserEmail", email);

                        const sessionResponse = await fetch("store_session.php", {
                            method: "POST",
                            body: sessionData
                        });
                        const sessionResult = await sessionResponse.json();
                        console.log("Session Storage Response:", sessionResult);

                        // Redirect to dashboard.php
                        console.log("Redirecting to dashboard.php");
                        window.location.href = "dashboard.php";
                    } else {
                        console.log("OTP verification failed:", result.message);
                        const message = result.message || "Invalid or expired OTP.";
                        // Check if the OTP is expired or invalid, and automatically request a new OTP
                        if (message.toLowerCase().includes("expired") || message.toLowerCase().includes("invalid")) {
                            alert("The OTP is " + message.toLowerCase() + ". Requesting a new OTP...");
                            // Automatically trigger the Resend OTP functionality
                            document.getElementById("resendOtp").click();
                        } else {
                            alert(message + " Please try again or request a new OTP.");
                            console.log("Keeping OTP section visible...");
                            otpInputs.forEach(input => input.value = "");
                            otpInputs[0].focus();
                        }
                    }
                } catch (error) {
                    console.error("OTP Check Error:", error);
                    alert("An error occurred during OTP verification. Please try again or request a new OTP.");
                    // Keep the OTP section visible for another attempt
                    console.log("Error occurred, keeping OTP section visible...");
                    otpInputs.forEach(input => input.value = "");
                    otpInputs[0].focus();
                }
            });

            // Handle Resend OTP
            document.getElementById("resendOtp").addEventListener("click", async function (e) {
                e.preventDefault();
                console.log("Resend OTP clicked");

                const email = document.getElementById("email").value;
                if (!email) {
                    alert("Email not found. Please go back and enter your email again.");
                    document.getElementById("otpSection").style.display = "none";
                    document.getElementById("emailSection").style.display = "block";
                    return;
                }

                const formData = new FormData();
                formData.append("email", email);
                formData.append("doCheckFunction", "LoginCheckEmail");

                try {
                    const response = await fetch("https://apiplayinc.spacegap.net/test.php", {
                        method: "POST",
                        body: formData
                    });
                    const result = await response.json();
                    console.log("Resend OTP Response:", result);

                    if (result.success === true && result.message === "OTP inserted and email sent") {
                        alert("A new OTP has been sent to your email.");
                        otpInputs.forEach(input => input.value = "");
                        otpInputs[0].focus();
                    } else {
                        alert(result.message || "Failed to resend OTP. Please try again.");
                    }
                } catch (error) {
                    console.error("Resend OTP Error:", error);
                    alert("An error occurred while resending the OTP. Please try again.");
                }
            });
        </script>
    </div>
</body>
</html>