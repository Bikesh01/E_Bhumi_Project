<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link  rel="shortcut icon" type="image/png" href="../images/logo/white.png">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/bootstrapcss/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrapcss/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<style>
    .box-box {
        width: 900px;
        padding: 40px;
    }
</style>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['_id']) || $_SESSION['role'] == 'user' || $_SESSION['role'] == 'agent') {
        header("Location: login.php");
        exit();
    } else {
        $logged_role = $_SESSION['role'];
        $_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];
    }

    // Include database connection
    include('../include/db_connection.php');
    $errors = [];
    $password_error = $phone_error =  $email_error = $re_password_error = "";
    // Check if the form fields are set and not empty
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $max_file_size = 25 * 1024 * 1024;

        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $country_code = $_POST["country_code"];
        $phone_number = $_POST["phone_number"];
        $password = $_POST["password"];
        $re_password = $_POST["re_password"];
        $role = $_POST["utype"];
        $registered_date = (new DateTime())->format('Y-m-d\TH:i:s\Z');

        // Check if passwords match
        if ($password !== $re_password) {
            $re_password_error = "Passwords do not match.";
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

        if (empty($phone_error) && empty($email_error) && empty($password_error) && empty($re_password_error)) {
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
                                    if (isset($_SERVER['previous_page'])){
                                        header("Location: " . $_SESSION['previous_page']);
                                    } else {
                                        header("Location: " . $_SERVER['HTTP_REFERER']);
                                    }
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
        // Close the database connection
        $conn->close();
    }
    ?>

    <!--------- Start register Section --------->
    <div class="login-section">
        <div class="container">
            <div class="row">
                <div class="box-wrap">
                    <div class="box-box d-flex flex-column align-items-center">
                        <h1 class="text-center">Register</h1>

                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                            <div class="row">
                                <div class="form-group mt-5 col-lg-6 d-flex justify-content-center">
                                   
                                    <input type="text" name="first_name" class="form-control" placeholder="Your First Name" pattern="[A-Za-z\s]+" value="<?php echo isset($first_name_value) ? $first_name_value : ''; ?>" minlength="3" maxlength="10" required>
                                </div>
                                <div class="form-group mt-5 col-lg-6 d-flex justify-content-center">
                                    <input type="text" name="last_name" class="form-control" placeholder="Your Last Name" pattern="[A-Za-z\s]+" value="<?php echo isset($last_name_value) ? $last_name_value : ''; ?>" minlength="2" maxlength="15" required>
                                </div>
                                <div class="form-group mt-2 col-lg-6 d-flex justify-content-center">
                                    <input type="email" name="email" class="form-control  <?php echo $email_error ? 'error' : ''; ?>" placeholder="Your Email" value="<?php echo isset($email_value) ? $email_value : ''; ?>" required>
                                    <?php if ($email_error) echo "<span class='text-danger'>$email_error</span>"; ?>
                                </div>
                                <div class="phone-number-group col-lg-6 d-flex justify-content-center">
                                    <div class="country-code ">
                                        <input class="form-control" type="text" name="country_code" value="+977" readonly>
                                    </div>
                                    <div class="phone-number">
                                        <input type="tel" name="phone_number" class="form-control <?php echo $phone_error ? 'error' : ''; ?>" placeholder="Your Phone" maxlength="10" required>
                                        <?php if ($phone_error) echo "<span class='text-danger' >$phone_error</span>"; ?>
                                    </div>
                                </div>
                                <div class="form-group mt-5 col-lg-6 d-flex justify-content-center">
                                    <input type="password" name="password" class="form-control <?php echo $password_error ? 'error' : ''; ?>" placeholder="Enter Password" minlength="6" maxlength="12" required>
                                    <?php if ($password_error) echo "<span class='text-danger'>$password_error</span>"; ?>
                                </div>
                                <div class="form-group mt-5 col-lg-6 d-flex justify-content-center">
                                    <input type="password" id="re_password" name="re_password" class="form-control <?php echo $re_enter_password_error ? 'error' : ''; ?>" placeholder="Confirm Password" minlength="6" maxlength="12" required>
                                    <?php if ($re_password_error) echo "<spanclass='text-danger' >$re_password_error</spanclass=>"; ?>
                                </div>
                            </div>
                           <div class=" d-flex justify-content-center">
                           <div class="form-check-inline  ">
                                <label class="form-check-label radiog">
                                    <input type="radio" class="form-check-input " name="utype" value="user" checked>
                                    User
                                </label>
                            </div>
                            <div class="form-check-inline  ">
                                <label class="form-check-label radiog">
                                    <input type="radio" class="form-check-input" name="utype" value="agent">
                                    Agent
                                </label>
                            </div>
                            <?php if ($logged_role != "admin") {
                                ?>
                                <div class="form-check-inline ">
                                    <label class="form-check-label radiog">
                                        <input type="radio" class="form-check-input" name="utype" value="admin">
                                        Admin
                                    </label>
                                </div>
                            <?php
                            }
                            ?>
                           </div>
                            <div class="form-group mt-3 col-lg-12 d-flex justify-content-center">
                                <input type="file" name="uimage" class="form-control" accept="image/jpeg, image/jpg">
                            </div>
                            <div class="registerbtn d-flex justify-content-center col-lg-12">
                                <button class="btn btn-primary" name="reg" value="Register" type="submit">Register</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------- End register   Section --------->






    <script src="../js/jquery.min.js"></script>

    <script src="../js/popper.min.js"></script>
    <script src="../fontawesome-free-6.5.1-web/js/fontawesome.js"></script>
    <script src="../js/bootstrapjs/bootstrap.min.js"></script>
    <script src="js/js.js"></script>
</body>

</html>