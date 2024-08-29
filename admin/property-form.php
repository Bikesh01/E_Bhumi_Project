<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Property</title>
    <link  rel="shortcut icon" type="image/png" href="../images/logo/white.png">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.css">
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/bootstrapcss/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/summit-property.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .btn-warning{
            background-color: #ffc107;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        </style>
</head>

<body>
    <?php
    include('../include/db_connection.php');
    if (!isset($_SESSION['_id'])) {
        header("Location: login.php");
    } else {
        if (isset($_GET['ref']) && isset($_GET['id'])) {
            if ($_GET['ref'] == 'update') {
                $method = $_GET['ref'];
                $id = $_GET['id'] ?? null;
                $url = 'submit-property.php?ref=' . $method . '&id=' . $id;
            } else {
                $id = null;
                $url = 'submit-property.php';
            }
        } else {
            $id = null;
            $url = 'submit-property.php';
        }
    }
    ?>

    <!--------- Start banner Section --------->
    <div class="banner">
        <div class="container">
            <div class="banner-content">
                <h1 class="banner-heading"><?php if (isset($method)) {
                                                echo ucfirst($method);
                                            } else {
                                                echo 'Submit';
                                            }; ?> Property</h1>
                <div class="banner-title">
                    <h2>Home>>><span><?php if (isset($method)) {
                                            echo ucfirst($method);
                                        } else {
                                            echo 'Submit';
                                        }; ?> Property</span></h2>
                </div>
            </div>
        </div>

    </div>
    <!--------- End banner Section --------->



    <!--------- Start Summit Property Section --------->
    <div class="summit-section">
        <form id="submitForm" method="POST" action="submit-property.php" enctype="multipart/form-data">
            <div class="container">
                <div class="container">
                    <label class="heading">Basic Information</label>
                    <div class="row mt-5">
                        <div class="d-flex col-lg-11 col-md-6 justify-content-start align-items-center">
                            <label for="" class="col-lg-1">Title*</label>
                            <div class="col-lg-12">
                                <input type="text" id="title" name="title" class="form-control" value="<?php echo $title ?? ''; ?>" placeholder="Enter Title" required>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="row mt-5">
                                <label for="" class="col-lg-3">Property Type*</label>
                                <div class="col-lg-9">
                                    <select id="type" class="form-control" name="type" required>
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
                            <div id="rentSaleSection" class="row mt-5">
                                <label for="" class="col-lg-3">Rent/Sale*</label>
                                <div class="col-lg-9">
                                    <select id="status" class="form-control" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="Rent">Rent</option>
                                        <option value="Sale">Sale</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <label for="" class="col-lg-3">No. of Bathroom</label>
                                <div class="col-lg-9">
                                    <input type="number" class="form-control" id="bathroom" name="bathroom" value="<?php echo $num_bathroom ?? ''; ?>" min="0" max="5" maxlength="1">
                                </div>
                            </div>
                            <div class="row mt-5">
                                <label for="" class="col-lg-3">No. of Kitchen</label>
                                <div class="col-lg-9">
                                    <input type="number" class="form-control" id="kitchen" name="kitchen" value="<?php echo $num_kitchen ?? ''; ?>" min="0" max="5" maxlength="1">
                                </div>
                            </div>
                            <div class="row mt-5">
                                <label for="" class="col-lg-3">No. of Bedroom</label>
                                <div class="col-lg-9">
                                    <input type="number" class="form-control" id="bedroom" name="bedroom" value="<?php echo $num_bedroom ?? ''; ?>" min="0" max="5" maxlength="1">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="row mt-5">
                                <label for="" class="col-lg-3">BHK</label>
                                <div class="col-lg-9">
                                    <select id="bhk" class="form-control" name="bhk">
                                        <option value="">Select BHK</option>
                                        <option value="1 BHK">1 BHK</option>
                                        <option value="2 BHK">2 BHK</option>
                                        <option value="3 BHK">3 BHK</option>
                                        <option value="4 BHK">4 BHK</option>
                                        <option value="5 BHK">5 BHK</option>
                                        <option value="1,2 BHK">1,2 BHK</option>
                                        <option value="2,3 BHK">2,3 BHK</option>
                                        <option value="2,3,4 BHK">2,3,4 BHK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <label for="" class="col-lg-3">Land Area*</label>
                                <div class="col-lg-9">
                                    <input type="number" id="land-area" name="land_area" class="form-control" placeholder="Eg 3.5" step="0.01">
                                </div>
                            </div>
                            <div class="row mt-5">
                                <label for="" class="col-lg-3">Unit*</label>
                                <div class="col-lg-9">
                                    <select id="landUnit" name="land_unit" class="form-control">
                                        <option value="" disabled selected>Select Unit</option>
                                        <option value="Aana">Aana</option>
                                        <option value="Sqrt">Sqrft</option>
                                        <option value="Khatha">Khatha</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <label for="" class="col-lg-3">Year Build</label>
                                <div class="col-lg-9">
                                    <input type="number" id="yearBuild" name="year_build" class="form-control" placeholder="YYYY" step="1" value="<?php echo $year_build ?? ''; ?>" min="1900" max="2099" maxlength="4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <label class="heading">Price & Location</label>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 mt-4">
                                <div class="row  mt-5">
                                    <label for="" class="col-lg-3">Price*</label>
                                    <div class="col-lg-9">
                                        <input type="number" id="price" name="price" class="form-control" placeholder="122312" step="0.1" value="<?php echo $price ?? ''; ?>" required>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <label for="" class="col-lg-3">Province*</label>
                                    <div class="col-lg-9">
                                        <select id="province" name="province" class="form-control" required>
                                            <option value="" disabled selected>Select Province</option>
                                            <option value="Koshi">Koshi</option>
                                            <option value="Madhesh">Madhesh</option>
                                            <option value="Bagmati">Bagmati</option>
                                            <option value="Gandaki">Gandaki</option>
                                            <option value="Lumbini">Lumbini</option>
                                            <option value="Karnali">Karnali</option>
                                            <option value="Sudurpashchim">Sudurpashchim</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <label for="" class="col-lg-3">District*</label>
                                    <div class="col-lg-9">
                                        <input type="text" id="district" name="district" class="form-control" placeholder="Enter District" value="<?php echo $district ?? ''; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mt-4">
                                <div class="row mt-5">
                                    <label for="" class="col-lg-3">View*</label>
                                    <div class="col-lg-9">
                                        <select id="view" class="form-control" name="view" required>
                                            <option value="">Select View</option>
                                            <option value="East">East</option>
                                            <option value="West">West</option>
                                            <option value="North">North</option>
                                            <option value="South">South</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row mt-5">
                                    <label for="" class="col-lg-3">Municipality*</label>
                                    <div class="col-lg-9">
                                        <input type="text" id="municipality" name="municipality" class="form-control" placeholder="Enter Municipality" value="<?php echo $municipality ?? ''; ?>" required>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <label for="" class="col-lg-3">Tole*</label>
                                    <div class="col-lg-9">
                                        <input type="text" id="tole" name="tole" class="form-control" placeholder="Enter Tole" value="<?php echo $tole ?? ''; ?>" required>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <label for="" class="col-lg-3">Ward No*</label>
                                    <div class="col-lg-9">
                                        <input type="number" id="wardNo" name="ward_no" class="form-control" placeholder="Enter Ward No." value="<?php echo $ward_no ?? ''; ?>" min="1" max="16" maxlength="2" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (!isset($method)) {
                ?>
                    <div class="container">
                        <label class="heading">Image</label>
                        <div class="contaienr">
                            <div class="row">
                                <div class="col-lg-6 mt-4">
                                    <div class="row mt-5">
                                        <label for="" class="col-lg-3">Thumbnail*</label>
                                        <div class="col-lg-9">
                                            <input type="file" name="thumbnail" accept="image/jpeg, image/jpg" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 nt-4">
                                    <div class="row mt-5">
                                        <label for="" class="col-lg-3">Images* (Max 5)</label>
                                        <div class="col-lg-9">
                                            <input type="file" name="other_image[]" multiple accept="image/jpeg, image/jpg" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } ?>
                <div class="container">
                    <label class="heading">Description</label>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row mt-5">
                                    <div class="form-group ">
                                        <textarea id="description" name="description" class="form-control" rows="5" placeholder="Type Description" maxlength="500" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row mt-5 mb-5 d-flex justify-center justify-content-center">
                        <button class="btn btn-primary" name="sub" value="Submit" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--------- End Submit Property Section --------->
    <?php
    include('include/footer.php');
    ?>

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
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="window.location.reload();">Close</button>
                </div>
            </div>
        </div>
    </div>
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
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
        $(document).ready(function() {
            $('#submitForm').submit(function(event) {
                event.preventDefault();
                // var formData = $(this).serialize();
                var formData = new FormData(this);
                $.ajax({
                    url: '<?php echo $url; ?>',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success === false) {
                            var modalTitle = document.querySelector('#errorModal .modal-title');
                            var modalBody = document.querySelector('#errorModal .modal-body');
                            var button = document.querySelector('#errorModal .modal-footer .btn');
                            console.error(response);
                            if (reponse.method === ''){
                                modalTitle.className = 'modal-title text-warning display-5 fw-bold';
                                modalTitle.innerHTML = 'Warning!';
                                button.className = 'btn btn-warning';
                                var messageToUpdate = "Image couldn't be uploaded, Entry successfull...";
                                modalBody.innerHTML = '<p class="display-6>' + messageToUpdate + '</p>';
                            }
                            $('#errorModal').modal('show');
                        } else {
                            var modalBody = document.querySelector('#successModal .modal-body');
                            if (response.method === 'updated') {
                                var messageToUpdate = "Property Updated Successfully!";
                                modalBody.innerHTML = '<p class="display-6">' + messageToUpdate + '</p>';
                            } else {
                                var messageToUpdate = "Property Added Successfully!";
                                modalBody.innerHTML = '<p class="display-6">' + messageToUpdate + '</p>';
                            }
                            console.log(response);
                            $('#successModal').modal('show');
                            $('#submitForm')[0].reset();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr, status, error);
                        $('#errorModal').modal('show');
                    }
                });
            });
        });
        $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('id')) {
                $.ajax({
                    url: 'get-property.php?id=<?php echo $id; ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.success === true) {
                            data = response.data;
                            $('#title').val(data.title);
                            var typeToSelect = data.type;
                            for (var i = 0; i < type.options.length; i++) {
                                if (type[i].value === typeToSelect) {
                                    type.options[i].selected = true;
                                }
                            }
                            var statusToSelect = data.status;
                            var status = document.getElementById('status');
                            for (var i = 0; i < status.options.length; i++) {
                                if (status[i].value === statusToSelect) {
                                    status.options[i].selected = true;
                                }
                            }
                            $('#bathroom').val(data.num_bathroom);
                            $('#kitchen').val(data.num_kitchen);
                            $('#bedroom').val(data.num_bedroom);
                            var bhkToSelect = data.bhk;
                            for (var i = 0; i < bhk.options.length; i++) {
                                if (bhk[i].value === bhkToSelect) {
                                    bhk.options[i].selected = true;
                                }
                            }
                            $('#land-area').val(data.land_area);
                            landUnit = document.getElementById('landUnit');
                            var landUnitToSelect = data.land_unit;
                            for (var i = 0; i < landUnit.options.length; i++) {
                                if (landUnit[i].value === landUnitToSelect) {
                                    landUnit[i].selected = true;
                                }
                            }
                            $('#yearBuild').val(data.year_build);
                            $('#price').val(data.price);

                            var viewToSelect = data.view;
                            for (var i = 0; i < view.options.length; i++) {
                                if (view[i].value === viewToSelect) {
                                    view[i].selected = true;
                                }
                            }

                            var provinceToSelect = data.province;
                            for (var i = 0; i < province.options.length; i++) {
                                if (province[i].value === provinceToSelect) {
                                    province[i].selected = true;
                                }
                            }

                            $('#municipality').val(data.municipality);
                            $('#district').val(data.district);
                            $('#tole').val(data.tole);
                            $('#wardNo').val(data.ward_no);
                            $('#description').val(data.description);
                        } else {
                            $('#errorModal').modal('show');
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#errorModal').modal('show');
                    }
                });
            }
        });
    </script>
</body>

</html>