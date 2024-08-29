<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link  rel="shortcut icon" type="image/png" href="images/logo/white.png">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.css">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/bootstrapcss/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/myaccount.css">
    <style>
        .btn-danger {
            background-color: #dc3545;
        }
    </style>

</head>

<body>
    <?php
    include('include/header.php');
    include('include/db_connection.php');
    if (!isset($_SESSION['_id'])) {
        header("Location: login.php");
    } else {
        $id = $_SESSION['_id'];
        $query = "SELECT * FROM users WHERE _id = $id";
        $result = mysqli_query($conn, $query);
        if ($user_data = mysqli_fetch_assoc($result)) {
            $user_id = $user_data['_id'];
            $full_name = $user_data['first_name'] . $user_data['last_name'];
            $user_email = $user_data['email'];
            $phone_number = $user_data['phone_number'];
            $query = "SELECT * FROM user_images WHERE user_id = $user_id";
            $result = mysqli_query($conn, $query);
            if($user_image = mysqli_fetch_assoc($result)){
                $image_path = $user_image['file_path'];
            }
            $image_path = $image_path ?? 'images\users\default.jpg';
            $registered_date = $user_data['registered_date'];
        } else {
            die();
        }
    }
    ?>

    <!--------- Start banner Section --------->
    <div class="banner">
        <div class="container">
            <div class="banner-content">
                <h1 class="banner-heading">My Account</h1>
                <div class="banner-title">
                    <h2>Home>>><span>My Account</span></h2>
                </div>
            </div>
        </div>

    </div>
    <!--------- End banner Section --------->

    <!--------- Start My Account Section --------->
    <div class="contact-section mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container">
                        <div class="row d-flex align-items-center gap-5">
                            <div class="col-lg-4 order-md-1 order-1 order-lg-3">
                                <div class="myaccount p-5">
                                    <img class="rounded-5" src="<?php echo $image_path; ?>" width="100px" height="50px">
                                </div>
                            </div>
                            <div class="col-lg-4 mt-5 order-md-1 order-lg-3">
                                <div class="row p-2 mt-2">
                                    <label class="text-dark">Name: <?php echo $full_name; ?></label>
                                </div>
                                <div class="row p-2 mt-2">
                                    <label class="text-dark">Email: <?php echo $user_email; ?></label>
                                </div>
                                <div class="row p-2 mt-2">
                                    <label class="text-dark">Phone: <?php echo $phone_number; ?></label>
                                </div>
                                <div class="row p-2 mt-2">
                                    <label class="text-dark">Account Created: 
                                        <?php
                                        $postTime = new Datetime($registered_date);
                                        $currentTime = new Datetime();
                                        $interval = $currentTime->diff($postTime);
                                        if ($interval->y > 0) {
                                            echo $interval->y . "year" . ($interval->y > 1 ? "s" : "") . " ago";
                                        } elseif ($interval->m > 0) {
                                            echo $interval->m . " month" . ($interval->m > 1 ? "s" : "") . " ago";
                                        } elseif ($interval->d > 0) {
                                            echo $interval->d . " day" . ($interval->d > 1 ? "s" : "") . " ago";
                                        } elseif ($interval->h > 0) {
                                            echo $interval->h . " hour" . ($interval->h > 1 ? "s" : "") . " ago";
                                        } elseif ($interval->i > 0) {
                                            echo $interval->i . " minute" . ($interval->i > 1 ? "s" : "") . " ago";
                                        } else {
                                            echo "Just now";
                                        }
                                        ?>
                                    </label>
                                </div>
                                <div class="row p-2 mt-4">
                                    <button class="btn btn-danger btn-lg mt-3" name="logout" onclick="window.location.href='include/logout.php'">Logout</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!--------- End My Account Section --------->

    <?php
    include('include/footer.php');
    ?>
 <?php
    include('chat.php');
    ?>

    <!-- </div>  -->

    <script src="js/jquery.min.js"></script>

    <script src="js/popper.min.js"></script>
    <script src="fontawesome-free-6.5.1-web/js/fontawesome.js"></script>
    <script src="js/bootstrapjs/bootstrap.min.js"></script>
    <script src="js/js.js"></script>
</body>

</html>