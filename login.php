<!DOCTYPE html>
<html lang="en">
<head>
       <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
    <?php
    // Start the session
    session_start();

    // Clear session variables
    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";

    // Set timezone and date
    date_default_timezone_set('Asia/Kolkata');
    $_SESSION["date"] = date('Y-m-d');

    // Display errors for debugging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Import database connection
    include("connection.php");

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['useremail'];
        $password = $_POST['userpassword'];

        $result = $database->query("SELECT * FROM webuser WHERE email='$email'");
        
        if ($result->num_rows === 1) {
            $utype = $result->fetch_assoc()['usertype'];
            $checker = null;

            if ($utype == 'p') {
                $checker = $database->query("SELECT * FROM patient WHERE pemail='$email' AND ppassword='$password'");
                $redirect = 'patient/index.php';
            } elseif ($utype == 'a') {
                $checker = $database->query("SELECT * FROM admin WHERE aemail='$email' AND apassword='$password'");
                $redirect = 'admin/index.php';
            } elseif ($utype == 'd') {
                $checker = $database->query("SELECT * FROM doctor WHERE docemail='$email' AND docpassword='$password'");
                $redirect = 'doctor/index.php';
            }

            if ($checker && $checker->num_rows === 1) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = $utype;
                header('Location: ' . $redirect);
                exit();
            } else {
                $error = '<label class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid email or password</label>';
            }
        } else {
            $error = '<label class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We can\'t find any account for this email.</label>';
        }
    }
    ?>

    <center>
        <div class="container">
            <p class="header-text">Welcome Back!</p>
            <div class="form-body">
                <p class="sub-text">Login with your details to continue</p>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="useremail" class="form-label">Email:</label>
                        <input type="email" id="useremail" name="useremail" class="input-text" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <label for="userpassword" class="form-label">Password:</label>
                        <input type="password" id="userpassword" name="userpassword" class="input-text" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <?php echo $error; ?>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Login" class="login-btn btn-primary btn">
                    </div>
                </form>
                <div class="form-group">
                    <label class="sub-text" style="font-weight: 280;">Don't have an account?</label>
                    <a href="signup.php" class="hover-link1 non-style-link">Sign Up</a>
                </div>
            </div>
        </div>
    </center>
</body>
</html>
