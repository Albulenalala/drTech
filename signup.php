<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
    <title>Sign Up</title>
</head>
<body>
    <center>
        <div class="container">
            <form action="" method="POST">
                <table border="0">
                    <tr>
                        <td colspan="2">
                            <p class="header-text">Let's Get Started</p>
                            <p class="sub-text">Add Your Personal Details to Continue</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td">
                            <label for="fname" class="form-label">First Name: </label>
                            <input type="text" name="fname" class="input-text" placeholder="First Name" required>
                        </td>
                        <td class="label-td">
                            <label for="lname" class="form-label">Last Name: </label>
                            <input type="text" name="lname" class="input-text" placeholder="Last Name" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="address" class="form-label">Address: </label>
                            <input type="text" name="address" class="input-text" placeholder="Address" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="nic" class="form-label">NIC: </label>
                            <input type="text" name="nic" class="input-text" placeholder="NIC Number" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="label-td" colspan="2">
                            <label for="dob" class="form-label">Date of Birth: </label>
                            <input type="date" name="dob" class="input-text" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="reset" value="Reset" class="login-btn btn-primary-soft btn">
                        </td>
                        <td>
                            <input type="submit" value="Next" class="login-btn btn-primary btn">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <br>
                            <label for="" class="sub-text" style="font-weight: 280;">Already have an account? </label>
                            <a href="login.php" class="hover-link1 non-style-link">Login</a>
                            <br><br><br>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </center>

    <?php
    session_start();
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');
    $_SESSION["date"] = $date;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION["personal"] = array(
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'address' => $_POST['address'],
            'nic' => $_POST['nic'],
            'dob' => $_POST['dob']
        );

        // Redirect to create-account.php after form submission
        header("location: create-account.php");
        exit(); // Stop further script execution
    }
    ?>

</body>
</html>
