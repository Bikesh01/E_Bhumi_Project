<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  
  <link rel="shortcut icon" type="image/png" href="../images/logo/white.png">
  <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.css">
  <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/fontawesome.min.css">
  <link rel="stylesheet" href="../css/bootstrapcss/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrapcss/bootstrap.css">
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <?php
  include('top-nav.php');
  if (!isset($_SESSION['_id']) || $_SESSION['role'] == 'user' || $_SESSION['role'] == 'agent') {
    header("Location: login.php");
    exit();
  } else {
    $id = $_SESSION['_id'];
    $first_name = $_SESSION['first_name'];
    $role = $_SESSION['role'];
    $image_path = $_SESSION['image_path'];
  }
  ?>
  <div class="container">
    <?php
    include('../include/db_connection.php');
    $roles = explode('_', $role);
    $role = null;
    foreach ($roles as $index => $value) {
      $role .= ucfirst($value);
    }
    $user_query = "SELECT
                    SUM(CASE WHEN role = 'admin' and is_active = 1 THEN 1 ELSE 0 END) AS total_admins,
                    SUM(CASE WHEN role = 'user' and is_active = 1 THEN 1 ELSE 0 END) AS total_users,
                    SUM(CASE WHEN role = 'agent' and is_active = 1 THEN 1 ELSE 0 END) AS total_agents
                    FROM users WHERE is_active=1 and is_deleted=0";
    $deleted_user_query = "SELECT
                              COUNT(*) AS total_users_deleted
                              FROM users WHERE is_active=0 and is_deleted=1";
    if ($user_result = mysqli_query($conn, $user_query)) {
      $user_data = mysqli_fetch_assoc($user_result);
      $total_users = $user_data['total_users'];
      $total_agents = $user_data['total_agents'];
      if ($role != "admin") {
        $total_admins = $user_data['total_admins'];
      }
    } else {
      $total_users = 0;
      $total_agents = 0;
    }
    $deleted_user_result = mysqli_query($conn, $deleted_user_query);
    if ($user_deleted = mysqli_fetch_assoc($deleted_user_result)) {
      $total_users_deleted = $user_deleted['total_users_deleted'];
    } else {
      $total_users_deleted = 0;
    }

    $property_query = "SELECT
                        COUNT(*) AS total_properties,
                        SUM(CASE WHEN type = 'Apartment' THEN 1 ELSE 0 END) AS total_apartments,
                        SUM(CASE WHEN type = 'House' THEN 1 ELSE 0 END) AS total_houses,
                        SUM(CASE WHEN type = 'Land' THEN 1 ELSE 0 END) AS total_lands,
                        SUM(CASE WHEN type = 'Flat' THEN 1 ELSE 0 END) AS total_flats,
                        SUM(CASE WHEN status = 'Sale' THEN 1 ELSE 0 END) AS total_sales,
                        SUM(CASE WHEN status = 'Rent' THEN 1 ELSE 0 END) AS total_rents
                        FROM properties WHERE is_active=1 and is_deleted=0";
    $deleted_property_query = "SELECT
                                COUNT(*) AS total_properties_deleted
                                FROM properties WHERE is_active=0 and is_deleted=1";
    $property_result = mysqli_query($conn, $property_query);
    if ($property_data = mysqli_fetch_assoc($property_result)) {
      $total_properties = $property_data['total_properties'];
      $total_apartments = $property_data['total_apartments'];
      $total_houses = $property_data['total_houses'];
      $total_lands = $property_data['total_lands'];
      $total_flats = $property_data['total_flats'];
      $total_sales = $property_data['total_sales'];
      $total_rents = $property_data['total_rents'];
    } else {
      $total_properties = 0;
      $total_apartments = 0;
      $total_houses = 0;
      $total_lands = 0;
      $total_flats = 0;
      $total_sales = 0;
      $total_rents = 0;
    }
    $deleted_property_result = mysqli_query($conn, $deleted_property_query);
    if ($property_deleted = mysqli_fetch_assoc($deleted_property_result)) {
      $total_properties_deleted = $property_deleted['total_properties_deleted'];
    } else {
      $total_properties_deleted = 0;
    }
    $property_images_query = "SELECT COUNT(*) AS total_property_images FROM property_images WHERE is_deleted=0";
    $property_images_result = mysqli_query($conn, $property_images_query);
    if ($property_images = mysqli_fetch_assoc($property_images_result)) {
      $total_property_images = $property_images['total_property_images'];
    } else {
      $total_property_images = 0;
    }
    $user_image_query = "SELECT COUNT(*) AS total_user_images FROM user_images WHERE is_deleted=0";
    $user_images_result = mysqli_query($conn, $user_image_query);
    if ($user_images = mysqli_fetch_assoc($user_images_result)) {
      $total_user_images = $user_images['total_user_images'];
    } else {
      $total_user_images = 0;
    }
    ?>
    <div class="row">
      <div class="col-md-12 p-0">
        <div class="main">
          <div class="heading col-md-12">
            <div class="row d-flex align-items-center mb-3">
              <div class="left col-md-1 align-items-center">
                <img src="<?php echo '../' . $image_path; ?>" height="80px" width="80px" style="border-radius: 50%;" alt="profile picture">
              </div>
              <div class="left col-md-11">
                <h1 class="heading-title"> Welcome <?php echo $first_name . ' / ' . $role; ?>!</h1>
              </div>
            </div>
          </div>
          <div class="col-md-12 ">
            <div class="row">
              <?php
              if ($role != "Admin") { ?>
                <div class="col-md-3">
                  <a href="user-list.php?role=admin">
                    <div class="tile">
                      <span class="register-tile-icon"><i class="fa-solid fa-users"></i></span>
                      <h2 class="tile-number"><?php echo $total_admins; ?></h2>
                      <h2 class="tile-title">Admins</h2>
                    </div>
                  </a>
                </div>
              <?php
              }
              ?>
              <div class="col-md-3">
                <a href="user-list.php?role=user">
                  <div class="tile">
                    <span class="register-tile-icon"><i class="fa-solid fa-users"></i></span>
                    <h2 class="tile-number"><?php echo $total_users; ?></h2>
                    <h2 class="tile-title">Users</h2>
                  </div>
                </a>
              </div>
              <div class="col-md-3">
                <a href="user-list.php?role=agent">
                  <div class="tile">
                    <span class="agent-tile-icon"><i class="fa-solid fa-user-tie"></i></span>
                    <h2 class="tile-number"><?php echo $total_agents; ?></h2>
                    <h2 class="tile-title">Agents</h2>
                  </div>
                </a>
              </div>
              <div class="col-md-3">
                <a href="property-view.php">
                  <div class="tile">
                    <span class="property-tile-icon"><i class="fa-solid fa-house-crack"></i></span>
                    <h2 class="tile-number"><?php echo $total_properties; ?></h2>
                    <h2 class="tile-title">Properties</h2>
                  </div>
                </a>
              </div>
              <div class="col-md-3">
                <a href="property-view.php?status=sale">
                  <div class="tile">
                    <span class="sale-tile-icon"><i class="fa-solid fa-rupee-sign"></i></span>
                    <h2 class="tile-number"><?php echo $total_sales; ?></h2>
                    <h2 class="tile-title">On Sales</h2>
                  </div>
                </a>
              </div>
              <div class="col-md-3">
                <a href="property-view.php?status=rent">
                  <div class="tile">
                    <span class="rent-tile-icon"><i class="fa-solid fa-handshake"></i></span>
                    <h2 class="tile-number"><?php echo $total_rents; ?></h2>
                    <h2 class="tile-title">On Rents</h2>
                  </div>
                </a>
              </div>
              <div class="col-md-3">
                <a href="property-view.php?type=apartment">
                  <div class="tile">
                    <span class="appartment-tile-icon"><i class="fa-solid fa-building"></i></span>
                    <h2 class="tile-number"><?php echo $total_apartments; ?></h2>
                    <h2 class="tile-title">Apartments</h2>
                  </div>
                </a>
              </div>
              <div class="col-md-3">
                <a href="property-view.php?type=house">
                  <div class="tile">
                    <span class="house-tile-icon"><i class="fa-solid fa-house"></i></span>
                    <h2 class="tile-number"><?php echo $total_houses; ?></h2>
                    <h2 class="tile-title">Houses</h2>
                  </div>
                </a>
              </div>
              <div class="col-md-3">
                <a href="property-view.php?type=land">
                  <div class="tile">
                    <span class="land-tile-icon"><i class="fa-solid fa-panorama"></i></span>
                    <h2 class="tile-number"><?php echo $total_lands; ?></h2>
                    <h2 class="tile-title">Lands</h2>
                  </div>
                </a>
              </div>
              <div class="col-md-3">
                <a href="property-view.php?type=flat">
                  <div class="tile">
                    <span class="flat-tile-icon"><i class="fa-solid fa-table-cells"></i></span>
                    <h2 class="tile-number"><?php echo $total_flats; ?></h2>
                    <h2 class="tile-title">Flats</h2>
                  </div>
                </a>
              </div>
              <div class="col-md-3" style="opacity: 0.5; user-select: none;">
                <div class="tile">
                  <span class="flat-tile-icon"><i class="fa-solid fa-table-cells"></i></span>
                  <h2 class="tile-number"><?php echo $total_property_images; ?></h2>
                  <h2 class="tile-title">Property Images</h2>
                </div>
              </div>
              <div class="col-md-3" style="opacity: 0.5; user-select: none;">
                <div class="tile">
                  <span class="flat-tile-icon"><i class="fa-solid fa-table-cells"></i></span>
                  <h2 class="tile-number"><?php echo $total_user_images; ?></h2>
                  <h2 class="tile-title">User Images</h2>
                </div>
              </div>
              <div class="col-md-3" style="opacity: 0.5; user-select: none;">
                <div class="tile">
                  <span class="flat-tile-icon"><i class="fa-solid fa-table-cells"></i></span>
                  <h2 class="tile-number"><?php echo $total_properties_deleted; ?></h2>
                  <h2 class="tile-title">Properties Removed</h2>
                </div>
              </div>
              <div class="col-md-3" style="opacity: 0.5; user-select: none;">
                <div class="tile">
                  <span class="flat-tile-icon"><i class="fa-solid fa-table-cells"></i></span>
                  <h2 class="tile-number"><?php echo $total_users_deleted; ?></h2>
                  <h2 class="tile-title">All Users Removed</h2>
                </div>
              </div>
            </div>
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