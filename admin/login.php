<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link  rel="shortcut icon" type="image/png" href="../images/logo/white.png">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/bootstrapcss/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrapcss/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <style>
        
        .box-box {
padding: 60px;

 
}


    </style>
</head>
<body>
<?php
    session_start();
    include('../include/db_connection.php');
    if (isset($_SESSION['_id'])) {
        header("Location: dashboard.php");
        exit();
    }
    else if(isset($_SESSION['_id'])) {
        header("Location: ../index.php");
        exit();
    }

    // Initialize error messages and fields
    $email_error = $email_value = $password_error = $password_value  = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email_value = isset($_POST['email']) ? $_POST['email'] : '';
        $password_value = isset($_POST['password']) ? $_POST['password'] : '';

        // Retrieve form data
        $email = $email_value;
        $password = $password_value;

        // SQL query to check if the email exists in the database
        $check_email_query = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($check_email_query);

        // Email exists, check the password
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row["password"];

            if (password_verify($password, $hashed_password)) {
                $user_id = $row['_id'];
                $_SESSION['_id'] = $user_id;
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['role'] = $row['role'];
                $query = "SELECT * FROM user_images WHERE user_id='$user_id'";
                $image_result = mysqli_query($conn, $query);
                $user_image = mysqli_fetch_assoc($image_result);
                if ($user_image) {
                    $user_image_path = $user_image['file_path'];
                } else {
                $user_image_path ="images/users/default.jpg";
                }
                $_SESSION['image_path'] = $user_image_path;
                $conn->close();
                header("Location: dashboard.php");
                exit();
            } else {
                // Password is incorrect
                $password_error = "Incorrect password.";
            }
            } else {
                // Email does not exist
                $email_error = "Invalid email.";
            }
        }
        // Close the database connection
        $conn->close();
?>
 <!--------- Start login Section --------->
 <div class="login-section">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="box-wrap">
                    <div class="box-box">
                        <h1 class="text-center">Login</h1>
                        <h3 class="text-center">Access our Dashboard</h3>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control <?php echo $email_error ? 'error' : ''; ?>" placeholder="Your Email"  value="<?php echo $email_value; ?>" required>
                                <?php if ($email_error) echo "<span class='text-danger'>$email_error</span>"; ?>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control  <?php echo $password_error ? 'error' : ''; ?>" placeholder="Your Password" value="<?php echo $password_value; ?>" required>
                                <?php if ($password_error) echo "<span class='text-danger'>$password_error</span>"; ?>
                            </div>

                            <div class="login d-flex justify-content-center">
                            <button class="btn btn-primary" name="login" value="Login" type="submit">Login</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




 
    <script src="../js/jquery.min.js"></script>

<script src="../js/popper.min.js"></script>
<script src="../fontawesome-free-6.5.1-web/js/fontawesome.js"></script>
<script src="../js/bootstrapjs/bootstrap.min.js"></script>
<script src="js/js.js"></script>    
</body>
</html>