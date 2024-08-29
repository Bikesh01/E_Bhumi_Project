<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link  rel="shortcut icon" type="image/png" href="images/logo/white.png">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.css">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/bootstrapcss/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="css/footer.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .btn-warning {
            background-color: #FFC107;
        }
    </style>
</head>

<body>
    <?php
    include('include/header.php');
    include('include/db_connection.php');

    if (!isset($_SESSION['_id'])) {
        header("Location: login.php");
        exit();
    }
    ?>
    <!--------- Start banner Section --------->
    <div class="banner">
        <div class="container">
            <div class="banner-content">
                <h1 class="banner-heading">Feedback</h1>
                <div class="banner-title">
                    <h2>Home>>><span>Feedback</span></h2>
                </div>
            </div>
        </div>

    </div>
    <!--------- End banner Section --------->

    <!--------- Start contact Section --------->
    <div class="contact-section mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 bg-contact">
                    <div class="contact-info">
                        <h3 class="">Feedback</h3>
                    </div>
                    <ul>
                        <li class="">
                            <div class="contact-address">
                                <div class="footer-icon d-flex ">

                                    <i class="fa-solid fa-envelope fa-1.5x "></i>
                                    <h5>Address</h5>
                                </div>
                            </div>
                            <span>Itahari-20, Sunsari, Provience-1</span>
                        </li>

                        <li class="">
                            <div class="call-us">
                                <div class="footer-icon d-flex">

                                    <i class="fa-solid fa-phone-volume fa-1.5x  text-white"></i>
                                    <h5>Call Us</h5>
                                </div>
                                <span>+9824330782</span>
                            </div>
                        </li>

                        <li class="">
                            <div class="email-address">
                                <div class="footer-icon d-flex">

                                    <i class="fa-solid fa-envelope fa-1.5x text-white"></i>
                                    <h5>Email-address</h5>
                                </div>
                                <span>ebhumi@gmail.com</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-7">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2>Get In Touch</h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <form id="feedbackForm" class="w-100" method="post">
                                    <div class="row">
                                        <div class="row mb-4">
                                            <div class="form-group col-lg-12">
                                                <input type="email" name="email" class="form-control" placeholder="Email Address">
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <input type="text" name="subject" class="form-control" placeholder="Subject" maxlength="20">
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group ">
                                                    <textarea name="message" class="form-control" rows="5" placeholder="Type Comments..." maxlength="500"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" id="submitForm" value="send message" name="send" class="btn btn-primary">Send Message</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------- End feedback Section --------->

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success display-5 fw-bold" id="successModalLabel">Success!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="display-6">Your message has been sent successfully.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('include/footer.php')
    ?>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger display-5 fw-bold" id="errorModalLabel">Error!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="display-6">There was an error processing your request. Please try again later.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>

    <script src="js/popper.min.js"></script>
    <script src="fontawesome-free-6.5.1-web/js/fontawesome.js"></script>
    <script src="js/bootstrapjs/bootstrap.min.js"></script>
    <script src="js/js.js"></script>
    <script>
        $(document).ready(function() {
            $('#feedbackForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: 'submit-feedback.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        if (response.success === false) {
                            $('#errorModal').modal('show');
                            console.error(xhr.responseText);
                        } else {
                            $('#successModal').modal('show');
                            $('#feedbackForm')[0].reset();
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#errorModal').modal('show');
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

<?php
    include('chat.php');
    ?>
</body>

</html>