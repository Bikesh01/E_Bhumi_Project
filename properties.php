<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties</title>
    <link  rel="shortcut icon" type="image/png" href="../images/logo/white.png">
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
    include('include/db_connection.php');
    if(isset($_GET['type']) && isset($_GET['status']) && isset($_GET['municipality'])){
        $type = $_GET['type'];
        $status = $_GET['status'];
        $municipality = $_GET['municipality'];
    }
    ?>

    <!--------- Start banner Section --------->
    <div class="banner">
        <div class="container">
            <div class="banner-content">
                <h1 class="banner-heading">Properties</h1>
                <div class="banner-title">
                    <h2>Home>>><span>Properties</span></h2>
                </div>
            </div>
        </div>

    </div>
    <!--------- End banner Section --------->

    <!--------- Start Properties Section --------->

    <!--------- Start recent Section --------->
    <div class="recent-section">
        <div class="container">
            <h1 class="section-common-heading">Recent Property</h1>
        </div>


        <div class="container">
            <div class="row" id="propertyRow">
                <?php
                if (isset($type) || isset($status) || isset($municipality)) {
                    $query = "SELECT * FROM properties WHERE is_active = 1 AND is_deleted = 0";
                    if (!empty($type)) {
                        $query .= " AND type = '$type'";
                    }
                    if (!empty($status)) {
                        $query .= " AND status = '$status'";
                    }
                    if (!empty($municipality)) {
                        $query .= " AND municipality LIKE '%$municipality%'";
                    }
                    $query .= " ORDER BY registered_date DESC";
                } 
                else {
                    $query = "SELECT * FROM properties WHERE is_active=1 and is_deleted=0 ORDER BY registered_date DESC";
                }
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("Database Query Failed.");
                } else {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $property_id = $row['_id'];
                            $query = "SELECT * FROM property_images WHERE property_id=$property_id and is_thumbnail=1";
                            $image_result = mysqli_query($conn, $query);
                            $property_image = mysqli_fetch_assoc($image_result);
                ?> <div class="col-lg-3 col-md-6">
                                <a href="propertydetail.php?id=<?php echo $property_id; ?>">
                                    <div class="property">
                                        <?php
                                        if ($property_image) {
                                        ?>
                                            <img src="<?php echo $property_image['file_path']; ?>" height="250px">
                                        <?php
                                        } else {
                                        ?>
                                            <img src="images/property/default.jpg" alt="Blank Default Image" height="250px">
                                        <?php
                                        }
                                        ?>
                                        <span class="status"><?php echo 'For ' . ucfirst($row['status']); ?></span>
                                        <h1 class="price"><?php echo $row['price']; ?></h1>
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
                            </div>
                <?php
                        }
                    } else {
                        echo "<p class='display-6 fw-bold text-danger'>No Data Found</p>";
                    }
                }
                ?>

            </div>
        </div>

    </div>
    <!--------- End recent Section --------->
    <!--------- End Properties Section --------->

    <?php
    include('include/footer.php');
    ?>


    <!-- </div>  -->

    <script src="js/jquery.min.js"></script>

    <script src="js/popper.min.js"></script>
    <script src="fontawesome-free-6.5.1-web/js/fontawesome.js"></script>
    <script src="js/bootstrapjs/bootstrap.min.js"></script>
    <script src="js/js.js"></script>
    <script>
        const properties = <?php echo $properties_data; ?>

        const propertyRow = document.getElementById('propertyRow');

        // Function to generate HTML for each property
        function generatePropertyHTML(property) {
            return `
        <div class="col-lg-3 col-md-6">
            <div class="property">
                <a href="propertydetail.php"><img src="${property.image_1}" alt=""></a>
                <span class="status">${property.p_status}</span>
                <h1 class="price">${property.price}</h1>
                <div class="property-discription">
                    <a href="propertydetail.php">
                        <h2 class="property-type">${property.type}</h2>
                    </a>
                    <div class="location-date">
                        <div class="location">
                            <div class="footer-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <h3 class="location">${property.municipality}</h3>
                        </div>
                        <?php
                        $postTime = new Datetime($row['added_date']);
                        $currentTime = new Datetime();

                        $interval = $currentTime->diff($postTime);

                        if ($interval->y > 0) {
                            $date = $interval->y . "year" . ($interval->y > 1 ? "s" : "") . " ago";
                        } elseif ($interval->m > 0) {
                            $date = $interval->m . " month" . ($interval->m > 1 ? "s" : "") . " ago";
                        } elseif ($interval->d > 0) {
                            $date = $interval->d . " day" . ($interval->d > 1 ? "s" : "") . " ago";
                        } elseif ($interval->h > 0) {
                            $date = $interval->h . " hour" . ($interval->h > 1 ? "s" : "") . " ago";
                        } elseif ($interval->i > 0) {
                            $date = $interval->i . " minute" . ($interval->i > 1 ? "s" : "") . " ago";
                        } else {
                            $date = "Just now";
                        }
                        ?>
                        <div class="date">
                            <div class="footer-icon">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                            <h3 class="date"><?php echo $date; ?></h3>
                        </div>
                    </div>
                    <div class="property-feature">
                        <div class="container">
                            <div class="row">
                                <p class="land col-3">${property.land_area} ${property.unit}</p>
                                <p class="view col-3">${property.view}</p>
                            </div>
                            <div class="row">
                                <p class="land col-3">Land</p>
                                <p class="view col-3">View</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        }

        // Function to append properties to the property container
        function appendPropertiesToContainer() {
            let row = document.createElement('div');
            row.classList.add('row');
            properties.forEach((property, index) => {
                if (index % 4 === 0 && index !== 0) {
                    // Start a new row for every fourth property
                    propertyContainer.appendChild(row);
                    row = document.createElement('div');
                    row.classList.add('row');
                }
                const propertyHTML = generatePropertyHTML(property);
                row.innerHTML += propertyHTML;
            });
            // Append the last row if it's not empty
            if (row.children.length > 0) {
                propertyContainer.appendChild(row);
            }
        }

        // Initial load of properties
        appendPropertiesToContainer();

        // Function to check if user has scrolled to the bottom of the page
        function isBottomOfPage() {
            return (window.innerHeight + window.scrollY) >= document.body.offsetHeight;
        }

        // Function to handle scroll event
        function handleScroll() {
            if (isBottomOfPage()) {
                // Append more properties when user reaches the bottom of the page
                appendPropertiesToContainer();
            }
        }

        // Add scroll event listener
        window.addEventListener('scroll', handleScroll);
    </script>

<?php
    include('chat.php');
    ?>
</body>

</html>