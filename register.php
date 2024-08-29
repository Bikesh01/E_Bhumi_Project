<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    
    <link  rel="shortcut icon" type="image/png" href="images/logo/white.png">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.css">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/bootstrapcss/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/login.css">
<style>
    .login-section{
        align-items: top;
    }
    .box-wrap{
        width: 800px;
    }
    .box-box {
        width: 800px;
    }
</style>
</head>

<body>
    <?php

    include('include/header.php');
    include('include/db_connection.php');

    if (isset($_SESSION['_id'])) {
        header("Location: index.php");
        exit();
    }

    // Initialize error messages
    $password_error = $first_name_error = $last_name_error = $phone_error =  $email_error = $re_enter_password_error = "";
    // Initialize default values
    $first_name_value = $last_name_value = $email_value = $role_value = "";
    $max_file_size = 25 * 1024 * 1024;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $country_code = $_POST["country_code"];
        $phone_number = $_POST["phone_number"];
        $password = $_POST["password"];
        $re_enter_password = $_POST["re_enter_password"];
        $role = $_POST["utype"];
        $registered_date = (new DateTime())->format('Y-m-d\TH:i:s\Z');

        // Check if passwords match
        if ($password !== $re_enter_password) {
            $re_enter_password_error = "Passwords do not match.";
        }

        if (!preg_match("/^\d{10}$/", $phone_number)) {
            $phone_error = "Phone number should be a 10-digit number.";
        }

        // Check if the password contains spaces
        if (strpos($password, ' ') !== false) {
            $password_error = "Password should not contain spaces.";
        }

        // Check if the email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email address.";
        }

        // Check if the email is already registered
        $check_email_query = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($check_email_query);

        if ($result->num_rows > 0) {
            $email_error = "Email address is already registered.";
        }

        if (empty($full_name_error) && empty($email_error) && empty($password_error) && empty($re_enter_password_error)) {
            // Hash the password before storing it in the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // SQL query to insert user data into the database
            $sql = "INSERT INTO users (first_name, last_name, email, country_code, phone_number, password, role, registered_date) VALUES ('$first_name', '$last_name' , '$email', '$country_code' ,'$phone_number', '$hashed_password', '$role', '$registered_date')";

            // Execute the query
            if ($conn->query($sql) === TRUE) {
                $user_id = mysqli_insert_id($conn);
                // Handle file Upload
                if ($_FILES['uimage']['error'] === UPLOAD_ERR_OK) {
                    if ($_FILES['uimage']['size'] <= $max_file_size) {
                        $tmp_file_path = $_FILES['uimage']['tmp_name'];
                        $upload_dir = "images/users/";
                        $file_name = uniqid() . '_' . basename($_FILES['uimage']['name']);
                        $upload_file = $upload_dir . $file_name;

                        if (move_uploaded_file($tmp_file_path, $upload_file)) {
                            $full_path = $upload_file;
                            if ($full_path) {
                                $image_hash = hash_file('sha256', $full_path);
                                $sql = "INSERT INTO user_images (file_name, file_path, image_hash, user_id) VALUES ('$file_name', '$full_path', '$image_hash', '$user_id')";
                                $result = $conn->query($sql);
                                if ($result) {
                                    // Redirect to the login page
                                    header("Location: login.php");
                                    exit();
                                }
                            }
                        }
                    }
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Set the values for the input fields
        $first_name_value = htmlspecialchars($first_name);
        $last_name_value = htmlspecialchars($last_name);
        $email_value = htmlspecialchars($email);
        $role_value = $role;

        // Close the database connection
        $conn->close();
    }
    ?>

    <!--------- Start banner Section --------->
    <div class="banner">
        <div class="container">
            <div class="banner-content">
                <h1 class="banner-heading">Register</h1>
                <div class="banner-title">
                    <h2>Home>>><span>Register</span></h2>
                </div>
            </div>
        </div>

    </div>
    <!--------- End banner Section --------->

    <!--------- Start register Section --------->
    <div class="login-section">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="box-wrap">
                    <div class="box-box">
                        <h1 class="text-center">Register</h1>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                           <div class="row ">
                            
                           <div class="form-group  col-md-6  d-flex flex-column align-items-center">
                               <div class=" d-flex justify-content-center"> 
                                <label   class="text-start" for="first_name">First Name</label>
                               <span class="required-field    text-danger">*</span></div>
                                <input type="text" name="first_name" class="form-control" placeholder="Ram" pattern="[A-Za-z\s]+" value="<?php echo isset($first_name_value) ? $first_name_value : ''; ?>" minlength="3" maxlength="10" required>
                            </div>

                            <div class="form-group col-md-6  d-flex flex-column align-items-center">
                               <div class=""> <label for="last_name">Last Name</label><span class="required-field   text-danger">*</span></div>
                                <input type="text" name="last_name" class="form-control" placeholder="Dahal" pattern="[A-Za-z\s]+" value=" <?php echo isset($last_name_value) ? $last_name_value : ''; ?>" minlength="2" maxlength="15" required>
                            </div>

                            <div class="form-group col-md-6  d-flex flex-column align-items-center">
                               <div class=" d-flex justify-content-center"> <label  class="text-start" for="email">Email</label><span class="required-field   text-danger">*</span></div>
                                <input type="email" name="email" class="form-control <?php echo $email_error ? 'error' : ''; ?>" placeholder="xyz@gmail.com" value="<?php echo isset($email_value) ? $email_value : ''; ?>" required>
                                <?php if ($email_error) echo "<span class='text-danger'>$email_error</span>"; ?>
                            </div>
                            <div class="form-group col-md-6  d-flex flex-column align-items-center">
                                <div class="phone-number-group">
                                    <div class=""><input class="form-control border border-0 country-code" type="text" id="country-code" name="country_code" value="+977" readonly>
                                    <input type="tel" name="phone_number" class="form-control <?php echo $phone_error ? 'error' : ''; ?>" placeholder="Your Phone" maxlength="10" required>
                                    <?php if ($phone_error) echo "<span class='text-danger'>$phone_error</span>"; ?></div>
                                </div>
                            </div>
                            <div class="form-group col-md-6  d-flex flex-column align-items-center">
                               <div class=" d-flex justify-content-center">
                                 <label class="text-start"  for="password">Password</label>
                               <span class="required-field  text-danger">*</span></div>
                                <input type="password" name="password" class="form-control <?php echo $password_error ? 'error' : ''; ?>" placeholder="Enter Password" minlength="6" maxlength="12" required>
                                <?php if ($password_error) echo "<span class='text-danger'>$password_error</span>"; ?>
                            </div>

                            <div class="form-group col-md-6  d-flex flex-column align-items-center">
                               <div class="d-flex justify-content-center"> <label for="re_enter_password">Re-enter Password</label><span class="required-field text-danger">*</span></div>
                                <input type="password" id="re_enter_password" name="re_enter_password" class="form-control <?php echo $re_enter_password_error ? 'error' : ''; ?>" placeholder="Confirm Password" required>
                                <?php if ($re_enter_password_error) echo "<span class='text-danger'>$re_enter_password_error</span>"; ?>
                            </div>

                            <div class="form-check-inline col-md-12  d-flex flex-column align-items-center">
                                <label class="form-check-label radiog">
                                    <input type="radio" class="form-check-input " name="utype" value="user" checked>
                                    User
                                </label>
                            </div>
                            <div class="form-check-inline col-md-12  d-flex flex-column align-items-center ">
                                <label class="form-check-label radiog">
                                    <input type="radio" class="form-check-input" name="utype" value="agent">
                                    Agent
                                </label>
                            </div>

                            <div class="form-group  d-flex flex-column align-items-center">
                                <label class="col-form-label"><b>User Image</b></label>
                                <input class="form-control " name="uimage" type="file" accept="image/jpeg, image/jpg">
                            </div>
                           </div>
                            <div class="registerbtn d-flex justify-content-center">
                                <button class="btn btn-primary" name="reg" value="Register" type="submit">Register</button>
                            </div>

                        </form>
                        <div class="text-center dont-have">Already have an account? <a href="login.php">Login</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------- End register Section --------->

    <?php
    include('include/footer.php')
    ?>


    <!-- </div>  -->

    <script src="js/jquery.min.js"></script>

    <script src="js/popper.min.js"></script>
    <script src="fontawesome-free-6.5.1-web/js/fontawesome.js"></script>
    <script src="js/bootstrapjs/bootstrap.min.js"></script>
    <script src="js/js.js"></script>
</body>

</html>