<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Bhumi</title>
    <link  rel="shortcut icon" type="image/png" href="../images/logo/white.png">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.css">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/bootstrapcss/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/team.css">
    <link rel="stylesheet" href="slick-1.8.1/slick/slick-theme.css">
    <link rel="stylesheet" href="slick-1.8.1/slick/slick.css">

</head>

<body>

    <?php
    include('include/header.php');
    include('include/db_connection.php');
    ?>

    <!--------- Start hero Section --------->
    <div class="overlay-black w-100 slider-banner1 position-relative">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-12 ">
                    <div class="text-white">
                        <h1 class="mb-4"><span class="">Find</span><br>
                            Your dream house</h1>
                        <form method="GET" action="properties.php">
                            <div class="row">
                                <div class="col-md-6 col-lg-2">
                                    <div class="form-group">
                                        <select class="form-control" name="type">
                                            <option value="">Select Type</option>
                                            <option value="Apartment">Apartment</option>
                                            <option value="Flat">Flat</option>
                                            <option value="House">House</option>
                                            <option value="Villa">Villa</option>
                                            <option value="Land">Land</option>
                                            <option value="Futsal">Futsal</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2">
                                    <div class="form-group">
                                        <select class="form-control" name="status">
                                            <option value="">Select Status</option>
                                            <option value="Rent">Rent</option>
                                            <option value="Sale">Sale</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="municipality" placeholder="Enter Municipality" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-2">
                                    <div class="form-group">
                                        <button type="submit" name="filter" class="btn btn-primary w-100">Search Property</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------- End hero Section --------->


    <!--------- Start about Section --------->

    <div class="about-section" id="about-section">
        <div class="container">
            <h1 class="section-common-heading">Services E-Bhumi</h1>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-6 mb-4">
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="div-about">
                        <div class="icon">
                            <i class="fa-brands fa-sellsy fa-3x"></i>
                        </div>
                        <h3 class="section-common-title">LIST PROPERTY FOR SELL</h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="div-about">
                        <div class="icon">
                            <i class="fa-solid fa-building fa-3x"></i>
                        </div>
                        <h3 class="section-common-title">LIST PROPERTY FOR RENT</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                </div>
            </div>
        </div>
    </div>
    <!--------- End about Section --------->

    <!--------- Start recent Section --------->
    <div class="recent-section">
        <div class="container">
            <h1 class="section-common-heading">Recent Property</h1>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="view-all d-flex justify-content-end ">
                        <a href="properties.php"><button class="view-all-btn">View All</button></a>
                    </div>


                    <div class="pre-next mt-1 d-flex justify-content-end gap-5"><button class="prev-button">
                            <i class="fa-solid fa-circle-arrow-left"></i>
                        </button>
                        <button class="next-button">
                            <i class="fa-solid fa-circle-arrow-right"></i>
                        </button>
                    </div>
                    <div class="property-slider">
                        <?php
                        $query = "SELECT * FROM properties WHERE is_active=1 and is_deleted=0 ORDER BY registered_date DESC LIMIT 20";
                        $result = mysqli_query($conn, $query);
                        if (!$result) {
                            die("Database Query Failed.");
                        } else {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $property_id = $row['_id'];
                                $query = "SELECT * FROM property_images WHERE property_id=$property_id and is_thumbnail=1 and is_deleted=0";
                                $image_result = mysqli_query($conn, $query);
                                $property_image = mysqli_fetch_assoc($image_result);
                        ?>
                                <a href="propertydetail.php?id=<?php echo $property_id; ?>">
                                    <div class="property">
                                        <?php
                                        if ($property_image) {
                                        ?>
                                            <img src="<?php echo $property_image['file_path']; ?>" height="200px">
                                        <?php
                                        } else {
                                        ?>
                                            <img src="images/property/default.jpg" alt="Blank Default Image" height="200px">
                                        <?php
                                        }
                                        ?>
                                        <span class="status"><?php echo 'For '. ucfirst($row['status']); ?></span>
                                        <h1 class="price"><?php echo 'Rs. '. $row['price']; ?></h1>
                                        <div class="property-discription">
                                            <h2 class="property-type"><?php echo ucfirst($row['type']); ?></h2>
                                            <div class="location-date">
                                                <div class="location">
                                                    <div class="footer-icon">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                    </div>
                                                    <h3 class="location"><?php echo ucfirst($row['municipality']) . '-' . $row['ward_no'] . ',' . ucfirst($row['district']); ?></h3>
                                                </div>
                                                <div class="date">
                                                    <div class="footer-icon">
                                                        <i class="fa-solid fa-calendar-days"></i>
                                                    </div>
                                                    <h3 class="date">
                                                        <?php
                                                        $postTime = new Datetime($row['registered_date']);
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
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="property-feature">
                                                <div class="container">
                                                    <div class="row">
                                                        <p class="land col-3"><?php echo $row['land_area'] . ' ' . ucfirst($row['land_unit']); ?></p>
                                                        <p class="face col-3"><?php echo ucfirst($row['view']); ?></p>
                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <div class="row">
                                                        <p class="land col-3">Land</p>
                                                        <p class="view col-3">View</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                        <?php
                            }
                        }
                        ?>
                    </div>


                </div>

            </div>
        </div>
    </div>

    <!--------- End recent Section --------->



    <!--------- Start calculator Section --------->

    <div class="calculator-section">
        <div class="container">
            <h1 class="section-common-heading">Calculator For Land Unit</h1>
        </div>
        <div class="container d-flex justify-content-center ">
            <div class="calculator">
                <div class="d-flex justify-content-center gap-5">
                    <input id="unit1" type="number" class="form-control" placeholder="Enter Unit Value">
                    <select id="unitType1" class="form-select" aria-label="Select Land Unit">
                        <option selected>Select Land Unit</option>
                        <option value="anna">Anna</option>
                        <option value="sqft">Sqft</option>
                        <option value="katha">Katha</option>
                    </select>
                </div>

                <label for="" class="d-flex justify-content-center">To</label>

                <div class="d-flex justify-content-center gap-5">
                    <input id="unit2" type="number" class="form-control" placeholder="Enter Unit Value">
                    <select id="unitType2" class="form-select" aria-label="Select Land Unit">
                        <option selected>Select Land Unit</option>
                        <option value="anna">Anna</option>
                        <option value="sqft">Sqft</option>
                        <option value="katha">Katha</option>
                    </select>
                </div>
            </div>

        </div>
    </div>

    <!--------- End calculator Section --------->

    <div class="developer-section" id="developer-section">
        <div class="container">
            <h1 class="section-common-heading">Meet our Team</h1>
            <h2 class="deal">Designing & Developing Digital Destinations for the Real Estate World</h2>
        </div>

        <div class="container">
            <div class="row">
                <?php
                $query = "SELECT * FROM teams";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("Database Query Failed.");
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="div-about">
                                <div class="icon">
                                    <img src="<?php echo $row['file_path']; ?>" alt="">
                                </div>
                                <h3 class="section-common-title"><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></h3>
                                <div class="social-media ">
                                    <a href="<?php echo $row['social_link']; ?>"><i class="fa-brands fa-facebook"></i></a>
                                </div>
                                <p class="section-common-sub-title"><?php echo $row['description']; ?></p>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
       
    </div>
    <?php
    include('include/footer.php');
    ?>
    <?php
    include('chat.php');
    ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/slickcarousel/slick.min.js"></script>
    <script src="fontawesome-free-6.5.1-web/js/fontawesome.js"></script>
    <script src="js/bootstrapjs/bootstrap.min.js"></script>
    <script src="slick-1.8.1/slick/slick.js"></script>
    <script src="slick-1.8.1/slick/slick.min.js"></script>
    <script src="js/js.js"></script>


    <script>
        // Function to update the current date and time
        function updateDateTime() {
            // Get the current date and time
            var currentDate = new Date();

            // Format the date and time
            var options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                timeZoneName: 'short'
            };
            var formattedDateTime = currentDate.toLocaleDateString(undefined, options);

            // Set the formatted date and time in the HTML element
            document.getElementById("currentDateTime").textContent = formattedDateTime;
        }

        // Call the function to update date and time initially
        updateDateTime();

        // Update the date and time every second
        setInterval(updateDateTime, 1000);


        // Assuming propertiesArray is an array containing properties retrieved from the backend
        // var propertiesArray = [...]; 
        // Your array of properties

        // Limit the properties to 20
        // var limitedProperties = propertiesArray.slice(0, 20); 


        $('.property-slider').slick({
            dots: true,
            infinite: false,
            speed: 900,
            slidesToShow: 4,
            slidesToScroll: 2,
            prevArrow: $('.prev-button'),
            nextArrow: $('.next-button'),
            responsive: [{
                    breakpoint: 1402,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }

            ]
        });
    </script>



    <script>
        // Function to perform the conversion
        function convertUnits() {
            // Get input values and unit types
            let value1 = parseFloat(document.getElementById("unit1").value);
            let unitType1 = document.getElementById("unitType1").value;
            let unitType2 = document.getElementById("unitType2").value;

            // Conversion rates for different units (for example purposes only)
            const conversionRates = {
                "anna": {
                    "sqft": 435.6,
                    "katha": 0.033
                },
                "sqft": {
                    "anna": 0.0023,
                    "katha": 0.000023
                },
                "katha": {
                    "anna": 30.3,
                    "sqft": 43560
                }
            };

            // Perform the conversion
            let convertedValue;
            if (value1 && unitType1 !== "Select Land Unit" && unitType2 !== "Select Land Unit") {
                convertedValue = value1 * conversionRates[unitType1][unitType2];
                // Update the second input field with the converted value
                document.getElementById("unit2").value = convertedValue.toFixed(2);
            } else {
                // If input values or unit types are not valid, reset the second input field
                document.getElementById("unit2").value = "";
            }
        }

        // Event listeners to trigger the conversion on input change
        document.getElementById("unit1").addEventListener("input", convertUnits);
        document.getElementById("unitType1").addEventListener("change", convertUnits);
        document.getElementById("unitType2").addEventListener("change", convertUnits);
    </script>



</body>

</html>