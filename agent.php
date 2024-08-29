<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent</title>
    <link  rel="shortcut icon" type="image/png" href="images/logo/white.png">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.css">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/bootstrapcss/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="css/footer.css">
</head>

<body>
    <?php
    include('include/header.php');
    include('include/db_connection.php')
    ?>
    ?>


    <!--------- Start banner Section --------->
    <div class="banner">
        <div class="container">
            <div class="banner-content">
                <h1 class="banner-heading">Agent</h1>
                <div class="banner-title">
                    <h2>Home>>><span>Agent</span></h2>
                </div>
            </div>
        </div>

    </div>
    <!--------- End banner Section --------->




    <!--------- Start agent Section --------->

    <div class="developer-section">
        <div class="container">
            <h1 class="section-common-heading">Agents Of E-Bhumi</h1>
            <h2 class="deal">A home is more than just a place to live; it's where memories are made and dreams are realized.</h2>


        </div>

        <div class="container ">
            <div class="row">
                <?php
                $query = "SELECT * FROM teams";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("Database Query Failed.");
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col-lg-4">
                            <div class="div-about">
                                <div class="icon">
                                    <img src="<?php echo $row['file_path']; ?>" alt="">
                                </div>
                                <h3 class="section-common-title"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></h3>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <!--------- End agent Section --------->
    <?php
    include('include/footer.php')
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