<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add property</title>
  <link  rel="shortcut icon" type="image/png" href="../images/logo/white.png">
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
 ?>


  <div class="container">

  <?php
    // include('menu-navbar.php');
    if (!isset($_SESSION['_id']) || $_SESSION['role'] == 'user' || $_SESSION['role'] == 'agent') {
      header("Location: login.php");
      exit();
  }
    ?>

    <div class="row">
      <div class="col-md-12">
        <div class="main">
          <div class="heading">
            <h1 class="heading-title">Property</h1>
            <h2 class="heading-sub-title">Dashboard / Property</h2>
          </div>

          <div class="card-filter">
            <div class="col-sm-12 ">
              <div class="card-header">
                <h1 class="card-header-List">Add Property Detail</h1>
              </div>
              <div class="summit-section">
                <div class="container">
                  <div class="container">
                    <label class="heading">Basic Information</label>


                    <div class="row mt-5">
                      <div class=" d-flex col-lg-12  col-md-6">
                        <label for="" class="col-lg-2">Title</label>
                        <div class="col-lg-9">
                          <input type="text" placeholder="Enter Title">
                        </div>
                      </div>
                      <div class="col-lg-6 mt-4">
                        <div class="row  mt-5">
                          <label for="" class="col-lg-3">Property Type</label>
                          <div class="col-lg-9">
                            <select class="form-control" name="type">
                              <option value="">Select Type</option>
                              <option value="apartment">Apartment</option>
                              <option value="flat">Flat</option>
                              <option value="house">House</option>
                              <option value="house">Villa</option>
                              <option value="house">Land</option>
                              <option value="house">Futsal</option>

                            </select>
                          </div>
                        </div>
                        <div class="row mt-5">
                          <label for="" class="col-lg-3">Selling Type</label>
                          <div class="col-lg-9">
                            <select class="form-control" name="stype">
                              <option value="">Select Status</option>
                              <option value="rent">Rent</option>
                              <option value="sale">Sale</option>
                            </select>
                          </div>
                        </div>
                        <div class="row mt-5">
                          <label for="" class="col-lg-3">Bathroom</label>
                          <div class="col-lg-9">
                            <select id="bathroom">
                              <option value="" disabled selected>Select Bathroom</option>
                            </select>
                          </div>
                        </div>
                        <div class="row mt-5">
                          <label for="" class="col-lg-3">Kitchen</label>
                          <div class="col-lg-9">
                            <select id="kitchenroom">
                              <option value="" disabled selected>Select Kitchen</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 mt-4">

                        <div class="row mt-5">
                          <label for="" class="col-lg-3">BHK</label>
                          <div class="col-lg-9">
                            <select class="form-control" name="stype">
                              <option value="">Select BHK</option>
                              <option value="rent">1 BHK</option>
                              <option value="sale">2 BHK</option>
                              <option value="sale">3 BHK</option>
                              <option value="sale">4 BHK</option>
                              <option value="sale">5 BHK</option>
                              <option value="sale">1,2 BHK</option>
                              <option value="sale">2,3 BHK</option>
                              <option value="sale">2,3,4 BHK</option>
                            </select>
                          </div>
                        </div>
                        <div class="row mt-5">
                          <label for="" class="col-lg-3">Land Area</label>
                          <div class="col-lg-9">
                            <input type="number" placeholder="Eg 3.5">
                          </div>
                        </div>
                        <div class="row mt-5">
                          <label for="" class="col-lg-3">Unit</label>
                          <div class="col-lg-9">
                            <select id="unit">
                              <option value="" disabled selected>Select Unit</option>
                              <option value="Aana">Aana</option>
                              <option value="Sqrt">Sqrft</option>
                              <option value="khatha">Khatha</option>
                            </select>
                          </div>
                        </div>



                        <div class="row mt-5">
                          <label for="" class="col-lg-3">Year Build</label>
                          <div class="col-lg-9">
                            <select id="year">
                              <option value="" disabled selected>Select Year</option>
                            </select>
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
                            <label for="" class="col-lg-3">Price</label>
                            <div class="col-lg-9">
                              <input type="text" placeholder="Eg RS 122312">
                            </div>
                          </div>
                          <div class="row mt-5">
                            <label for="" class="col-lg-3">Provience</label>
                            <div class="col-lg-9">
                              <select id="province">
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
                            <label for="" class="col-lg-3">District</label>
                            <div class="col-lg-9">
                              <input type="text" placeholder="Enter District">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                          <div class="row mt-5">
                            <label for="" class="col-lg-3">View</label>
                            <div class="col-lg-9">
                              <select class="form-control" name="stype">
                                <option value="">Select View</option>
                                <option value="rent">East</option>
                                <option value="sale">West</option>
                                <option value="sale">North</option>
                                <option value="sale">South</option>
                              </select>
                            </div>
                          </div>


                          <div class="row mt-5">
                            <label for="" class="col-lg-3">Municipality</label>
                            <div class="col-lg-9">
                              <input type="text" placeholder="Enter Municipality">
                            </div>
                          </div>
                          <div class="row mt-5">
                            <label for="" class="col-lg-3">Tole</label>
                            <div class="col-lg-9">
                              <input type="text" placeholder="Enter Tole">
                            </div>
                          </div>
                          <div class="row mt-5">
                            <label for="" class="col-lg-3">Ward No</label>
                            <div class="col-lg-9">
                              <select id="ward">
                                <option value="" disabled selected>Select Ward No</option>
                              </select>
                            </div>
                          </div>
                        </div>


                      </div>
                    </div>
                  </div>
                  <div class="container">
                    <label class="heading">Image & Status</label>
                    <div class="contaienr">
                      <div class="row">
                        <div class="col-lg-6 mt-4">
                          <div class="row  mt-5">
                            <label for="" class="col-lg-3">Image</label>
                            <div class="col-lg-9">
                              <input type="file" name="aimage">
                            </div>
                          </div>
                          <div class="row  mt-5">
                            <label for="" class="col-lg-3">Image 1</label>
                            <div class="col-lg-9">
                              <input type="file" name="aimage1">
                            </div>
                            <div class="row  mt-5">
                              <label for="" class="col-lg-3">Status </label>
                              <div class="col-lg-9">
                                <select class="form-control" name="stype">
                                  <option value="">Select Status</option>
                                  <option value="rent">Availabe</option>
                                  <option value="sale">Sold</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                          <div class="row  mt-5">
                            <label for="" class="col-lg-3">Image 2</label>
                            <div class="col-lg-9">
                              <input type="file" name="aimage2">
                            </div>
                          </div>
                          <div class="row  mt-5">
                            <label for="" class="col-lg-3">Image 3</label>
                            <div class="col-lg-9">
                              <input type="file" name="aimage3">
                            </div>
                            <div class="row mt-5">
                              <label for="latitude" class="col-lg-3">Latitude</label>
                              <div class="col-lg-9">
                                <input type="text" id="latitude" name="latitude">
                              </div>

                            </div>

                            <div class="row mt-5">
                              <label for="longitude" class="col-lg-3">Longitude</label>
                              <div class="col-lg-9">
                                <input type="text" id="longitude" name="longitude">
                              </div>
                            </div>

                          </div>
                        </div>

                      </div>

                    </div>


                  </div>

                  <div class="container">
                    <label class="heading">Description</label>
                    <div class="container">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="row mt-5">
                            <div class="form-group ">
                              <textarea name="message" class="form-control" rows="5" placeholder="Type Description"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="container">
                    <div class="row mt-5 mb-5 d-flex justify-center justify-content-center    ">
                      <button class="btn btn-primary">Submit</button>
                    </div>
                  </div>
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