<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Property List</title>
    <link  rel="shortcut icon" type="image/png" href="images/logo/white.png">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.css">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/bootstrapcss/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/mypropertylist.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    }
    ?>

    <!--------- Start banner Section --------->
    <div class="banner">
        <div class="container">
            <div class="banner-content">
                <h1 class="banner-heading">My Property List</h1>
                <div class="banner-title">
                    <h2>Home>>><span>My Property List</span></h2>
                </div>
            </div>
        </div>

    </div>
    <!--------- End banner Section --------->

    <!--------- Start My Property List Section --------->
    <div class="propertylist-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row gap-1">

                        <div class="col-lg-5 bg-primary">
                            <label for="">Property</label>
                        </div>
                        <div class="col-lg-1  bg-primary">
                            <label for="">BHK</label>
                        </div>
                        <div class="col-lg-2  bg-primary">
                            <label for="">Added Date</label>
                        </div>
                        <div class="col-lg-1 bg-primary">
                            <label for="">Status</label>
                        </div>
                        <div class="col-lg-1 bg-primary">
                            <label for="">Update</label>
                        </div>
                        <div class="col-lg-1 bg-primary ">
                            <label for="">Delete</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="row gap-1">
                        <?php
                        $user_id = $_SESSION['_id'];
                        $query = "SELECT * FROM properties WHERE posted_by_id=$user_id and is_active=1 and is_deleted=0 ORDER BY registered_date DESC";
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
                                <div class="col-lg-5 bg-secondary  d-flex align-items-center p-4 gap-2">
                                    <?php
                                    if ($property_image) {
                                    ?>
                                        <img src="<?php echo $property_image['file_path']; ?>" width="200px" height="150px">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="images/property/default.jpg" alt="Blank Default Image" width="200px" height="150px">
                                    <?php
                                    }
                                    ?>
                                    <div class="detail d-flex flex-column  align-items-center gap-4">
                                        <h1 for="">Title: <?php echo ucfirst($row['title']); ?></h1>
                                        <h1 for="">Location: <?php echo ucfirst($row['tole']) . ' ' . ucfirst($row['ward_no']); ?></h1>
                                        Price: <h1 class="price" for="">Price: <?php echo $row['price']; ?></h1>
                                    </div>
                                </div>
                                <div class="col-lg-1 bg-secondary d-flex align-items-center">
                                    <label for=""><?php echo $row['bhk']; ?></label>
                                </div>
                                <div class="col-lg-2 bg-secondary d-flex align-items-center">
                                    <label for="">
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
                                    </label>
                                </div>
                                <div class="col-lg-1 bg-secondary d-flex align-items-center">
                                    <label for=""><?php echo ucfirst($row['status']); ?></label>
                                </div>
                                <div class="col-lg-1 bg-secondary d-flex justify-content-center align-items-center">
                                    <button class="btn btn-primary btn-lg" for="" onclick="window.location.href='submitproperty.php?ref=update&id=<?php echo $property_id; ?>'">Update</button>
                                </div>
                                <div class="col-lg-1 bg-secondary d-flex align-items-center">
                                    <button type="button" class="btn btn-lg delete-property btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete" value="Delete" data-propertyid="<?php echo $property_id; ?>" data-table="properties">
                                        Delete
                                    </button>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------- End My Property List Section --------->

    <?php
    include('include/footer.php')
    ?>

    <!-- Delete Modal -->
    <div class="modal fade" id="confirmDelete" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger display-5 fw-bold">Confirm Delete?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="display-6">This will delete the entry.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-lg btn-danger" onclick="deleteEntry($('#confirmDelete').data('propertyid'), $('#confirmDelete').data('table'))">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- </div>  -->

    <script src="js/jquery.min.js"></script>

    <script src="js/popper.min.js"></script>
    <script src="fontawesome-free-6.5.1-web/js/fontawesome.js"></script>
    <script src="js/bootstrapjs/bootstrap.min.js"></script>
    <script src="js/js.js"></script>
    <script>
        function deleteEntry(propertyId, table) {
            $.ajax({
                url: 'admin/delete-entry.php',
                method: 'POST',
                data: {
                    table: table,
                    id: propertyId
                },
                success: function(response) {
                    console.log(response);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Event listener for delete modal show event
        $('#confirmDelete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('propertyid');
            var table = button.data('table');
            $('#confirmDelete').data('propertyid', id);
            $('#confirmDelete').data('table', table);
        });
    </script>

<?php
    include('chat.php');
    ?>
</body>

</html>