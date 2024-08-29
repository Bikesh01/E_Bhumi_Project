<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Property Details</title>
  <link  rel="shortcut icon" type="image/png" href="images/logo/white.png">
  <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.css">
  <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/fontawesome.min.css">
  <link rel="stylesheet" href="css/bootstrapcss/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/banner.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/propertydetail.css">
  <link rel="stylesheet" href="slick-1.8.1/slick/slick-theme.css">
  <link rel="stylesheet" href="slick-1.8.1/slick/slick.css">
  <style>
    .carousel-container {
      display: flex;
      overflow-x: auto;
      scrollbar-width: none;
      -ms-overflow-style: none;
    }

    .carousel-container::-webkit-scrollbar {
      display: none;
    }

    .carousel {
      width: 100%;
      flex: 0 0 auto;
      margin-right: 10px;
      overflow: hidden;
    }

    .carousel-inner {
      white-space: nowrap;
      animation: scrollImages 10s linear infinite;
    }

    .carousel-item {
      display: inline-block;
      margin-right: 10px;
    }

    .carousel img {
      max-width: 100%;
    }
  </style>
</head>

<body>
  <?php
  include('include/header.php');
  include('include/db_connection.php');
  if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $p_id = intval($_GET['id']);
    $query = "SELECT * FROM properties WHERE _id = $p_id";
    $result = mysqli_query($conn, $query);
    $property_data = mysqli_fetch_assoc($result);
  }
  if (!$property_data) {
    header("Location: 404.php");
    die("Database Query Failed.");
  }
  ?>

  <!--------- Start banner Section --------->
  <div class="banner">
    <div class="container">
      <div class="banner-content">
        <h1 class="banner-heading">Property Details</h1>
        <div class="banner-title">
          <h2>Home>>><span>Property Details</span></h2>
        </div>
      </div>
    </div>

  </div>
  <!--------- End banner Section --------->

  <!--------- Start Property Details Section --------->
  <div class="property-detail-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
          <div class="left-side">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <?php
                $property_id = $property_data['_id'];
                $query = "SELECT * FROM property_images WHERE property_id=$property_id and is_deleted=0";
                $image_result = mysqli_query($conn, $query);
                if ($image_result && mysqli_num_rows($image_result) > 0) {
                  $first = true;
                  while ($property_image = mysqli_fetch_assoc($image_result)) {
                ?>
                    <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
                      <img src="<?php echo $property_image['file_path']; ?>" class="d-block w-100">
                    </div>
                <?php
                    $first = false;
                  }
                }
                ?>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>

            <div class="mt-5">
              <div class="row">
                <div class="col-lg-6">
                  <div class=""><span class="status"><?php echo 'For ' . ucfirst($property_data['status']); ?></span></div>
                </div>

                <div class="col-lg-6  text-end">
                  <div class="price"><?php echo 'Rs ' . $property_data['price']; ?></div>
                </div>
              </div>
            </div>
            <div class="mt-5">
              <div class="row">
                <div class="col-lg-6">
                  <div class=""><span class="title"><?php echo ucfirst($property_data['title']); ?></span></div>
                </div>

                <div class="col-lg-6  text-end">
                  <div class="price-n">Price</div>
                </div>
              </div>
            </div>
            <div class="mt-5">
              <div class="row">
                <div class="col-lg-12">
                  <div class="property-feature">
                    <div class="container">
                      <div class="row ">
                        <p class="land col-3"><?php echo $property_data['land_area'] . ' ' . ucfirst($property_data['land_unit']); ?></p>
                        <p class="road col-3"><?php echo ucfirst($property_data['view']); ?></p>
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
            </div>
            <div class="mt-5">
              <div class="row">
                <div class="col-lg-12">
                  <h1 class="description-heading">Description</h1>
                  <div class="description">
                    <?php echo ucfirst($property_data['description']); ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-5">
              <div class="row">
                <div class="col-lg-12">
                  <h1 class="feature">Feature</h1>
                  <div class="col-lg-12">
                    <div class="row mt-5">
                      <div class="col-lg-6 gap-5">
                        <ul>
                          <li class="col-lg-12 feature-title">Bathroom: <span><?php echo $property_data['num_bathroom']; ?></span></li>
                          <li class="col-lg-12 feature-title">Kitchen: <span><?php echo $property_data['num_kitchen']; ?></span></li>
                          <li class="col-lg-12 feature-title">Kitchen: <span><?php echo $property_data['num_bedroom']; ?></span></li>
                          <li class="col-lg-12 feature-title">Property Type: <span><?php echo ucfirst($property_data['type']); ?></span></li>
                          <li class="col-lg-12 feature-title">Province: <span><?php echo ucfirst($property_data['province']); ?></span></li>
                          <li class="col-lg-12 feature-title">Municipality: <span><?php echo ucfirst($property_data['municipality']); ?></span></li>
                        </ul>
                      </div>
                      <div class="col-lg-6 gap-5">
                        <ul>
                          <li class="col-lg-12 feature-title">Year Build: <span><?php echo $property_data['year_build']; ?></span></li>
                          <li class="col-lg-12 feature-title">District: <span><?php echo ucfirst($property_data['district']); ?></span></li>
                          <li class="col-lg-12 feature-title">Tole: <span><?php echo ucfirst($property_data['tole']); ?></span></li>
                          <li class="col-lg-12 feature-title">Ward: <span><?php echo $property_data['ward_no']; ?></span></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

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
          </div>
        </div>
      </div>
      <div class="col-lg-2">
      </div>
    </div>

  </div>

  <!--------- End Property Details Section --------->

  <?php
  include('include/footer.php');
  ?>


  <!-- </div>  -->

  <script src="js/jquery.min.js"></script>

  <script src="js/popper.min.js"></script>
  <script src="js/slickcarousel/slick.min.js"></script>
  <script src="fontawesome-free-6.5.1-web/js/fontawesome.js"></script>
  <script src="js/bootstrapjs/bootstrap.min.js"></script>
  <script src="slick-1.8.1/slick/slick.js"></script>
  <script src="slick-1.8.1/slick/slick.min.js"></script>
  <script src="js/js.js"></script>
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
  <script>
    $(document).ready(function() {
      $('.carousel').slick({
        slidesToShow: 1, // Number of slides to show at once
        slidesToScroll: 1, // Number of slides to scroll at once
        autoplay: true, // Autoplay
        autoplaySpeed: 2000, // Autoplay speed in milliseconds
        infinite: true, // Infinite loop
        arrows: false, // Hide default navigation arrows
      });

      // Custom previous button click event
      $('.prev-button').click(function() {
        $('.carousel').slick('slickPrev');
      });

      // Custom next button click event
      $('.next-button').click(function() {
        $('.carousel').slick('slickNext');
      });
    });
  </script>

<?php
    include('chat.php');
    ?>
</body>

</html>