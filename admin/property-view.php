<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Proerty view</title>
  <link  rel="shortcut icon" type="image/png" href="../images/logo/white.png">
  <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.css">
  <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/fontawesome.min.css">
  <link rel="stylesheet" href="../css/bootstrapcss/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrapcss/bootstrap.css">
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/entry-filter.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>


<body>

  <?php
  include('top-nav.php');
  include('../include/db_connection.php');
  if (!isset($_SESSION['_id']) || $_SESSION['role'] == 'user' || $_SESSION['role'] == 'agent') {
    header("Location: login.php");
    exit();
  }

  $filter = intval($_GET['filter'] ?? 5);
  if (isset($_GET['status']) || isset($_GET['type']) || !isset($_GET['filter'])) {
    if (isset($_GET['status'])) {
      $type = null;
      $status = $ref = $_GET['status'];
      $query = "SELECT * FROM properties WHERE status=? and is_active=1 LIMIT $filter";
    } else if (isset($_GET['type'])) {
      $status = null;
      $type = $ref = $_GET['type'];
      $query = "SELECT * FROM properties WHERE type=? and is_active=1 LIMIT $filter";
    } else {
      $type =  $status = null;
      $query = "SELECT * FROM properties WHERE is_active=1 LIMIT $filter";
    }
  } else {
    header("Location: 404.php");
    die("Database Query Failed.");
    exit();
  }

  try {
    $stmt = mysqli_prepare($conn, $query);
    $listing = $ref ?? "Property";
  } catch (Exception $e) {
    echo $e;
    // header("Location: 404.php");
    die("Database Query Failed.");
    exit();
  }
  ?>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="main">
          <div class="heading">
            <h1 class="heading-title">Property</h1>
            <h2 class="heading-sub-title"><a href="dashboard.php">Dashboard</a> / <?php echo ucfirst($listing) ?></h2>
          </div>

          <div class="card-filter">
            <div class="col-sm-12 ">
              <div class="card-header">
                <h1 class="card-header-List"><?php echo ucfirst($listing) ?> View</h1>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-sm-6 ">
                      <div class="show-entries">
                        <span>show</span>
                        <select name="show" id="show-filters">
                          <option value="5">5</option>
                          <option value="10">10</option>
                          <option value="20">20</option>
                          <option value="50">50</option>
                          <option value="80">80</option>
                          <option value="100">100</option>
                        </select>
                        <span>entries</span>
                      </div>

                    </div>
                    <div class="col-sm-6 text-end">
                      <div class="search-filter">
                        <label for="searchInput">Search:</label>
                        <input type="search" id="searchInput">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col"></th>
                          <th scope="col">Id</th>
                          <th scope="col">Title</th>
                          <th scope="col">Description</th>
                          <th scope="col">Type</th>
                          <th scope="col">BHK</th>
                          <th scope="col">Selling Type</th>
                          <th scope="col">Bedroom</th>
                          <th scope="col">Bathroom</th>
                          <th scope="col">Kitchen</th>
                          <th scope="col">Land Area</th>
                          <th scope="col">Land Unit</th>
                          <th scope="col">Price</th>
                        </tr>
                      </thead>
                      <tbody id="table-body">
                        <?php
                        if ($stmt) {
                          if (isset($ref)) {
                            mysqli_stmt_bind_param($stmt, "s", $ref);
                          }
                          mysqli_stmt_execute($stmt);
                          $result = mysqli_stmt_get_result($stmt);
                          if (!$result) {
                            header("Location: 404.php");
                            die("Database Query Failed.");
                          } else {
                            if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                  <td class="collapsible-row gap-1">
                                    <button class="toggle-btn">+</button>
                                  </td>
                                  <td><?php echo $row['_id']; ?></td>
                                  <td><?php echo ucfirst($row['title']); ?></td>
                                  <td><?php echo ucfirst($row['description']); ?></td>
                                  <td><?php echo ucfirst($row['type']); ?></td>
                                  <td><?php echo $row['bhk']; ?></td>
                                  <td><?php echo ucfirst($row['status']); ?></td>
                                  <td><?php echo $row['num_bedroom']; ?></td>
                                  <td><?php echo $row['num_bathroom']; ?></td>
                                  <td><?php echo $row['num_kitchen']; ?></td>
                                  <td class="area"><?php echo $row['land_area']; ?></td>
                                  <td><?php echo ucfirst($row['land_unit']); ?></td>
                                  <td class="price"><?php echo $row['price']; ?></td>
                                </tr>
                                <tr class="collapsible-content">
                                  <td colspan="12">
                                    <ul>
                                      <li><label for="build-date">Year Build: </label><?php echo $row['year_build']; ?></li>
                                      <li><label for="">View: </label><?php echo ucfirst($row['view']); ?></li>
                                      <li><label for="">Province: </label><?php echo ucfirst($row['province']); ?></li>
                                      <li><label for="">Municipality: </label><?php echo ucfirst($row['municipality']); ?></li>
                                      <li><label for="">District: </label><?php echo ucfirst($row['district']); ?></li>
                                      <li><label for="">Tole: </label><?php echo ucfirst($row['tole']); ?></li>
                                      <li><label for="">Ward No: </label><?php echo $row['ward_no']; ?></li>
                                      <?php
                                      $property_id = $row['_id'];
                                      $query = "SELECT * FROM property_images WHERE property_id=$property_id and is_deleted=0";
                                      $image_result = mysqli_query($conn, $query);
                                      if ($image_result && mysqli_num_rows($image_result) > 0) {
                                        $property_images = mysqli_fetch_all($image_result, MYSQLI_ASSOC);
                                        foreach ($property_images as $key => $property_image) {
                                      ?>
                                          <li><label>Image <?php echo $key; ?>: </label><img src="<?php echo $property_image['file_path']; ?>"></li>
                                      <?php
                                        }
                                      }
                                      ?>
                                      <li><label><a href="property-form.php">Edit</a></label></li>
                                      <li> <button type="button" class="btn btn-lg delete-users btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete" value="Delete" data-propertyid="<?php echo $property_id; ?>" data-table="properties">
                                          Delete
                                        </button></li>
                                    </ul>
                                  </td>
                                </tr>
                        <?php
                              }
                            }
                          }
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


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

    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../fontawesome-free-6.5.1-web/js/fontawesome.js"></script>
    <script src="../js/bootstrapjs/bootstrap.min.js"></script>
    <script src="js/js.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var ref = '<?php if ($status) {
                      echo $status;
                    } else if ($type) {
                      echo $type;
                    } else {
                      echo '';
                    } ?>';
        var isStatus = '<?php if ($status) {
                          echo true;
                        } else {
                          echo false;
                        }; ?>'
        var selectElement = document.getElementById('show-filters');
        selectElement.addEventListener('change', function(event) {
          filterProperties(event, isStatus, ref);
        });
      });

      function deleteEntry(propertyId, table) {
        $.ajax({
          url: 'delete-entry.php',
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

      // Function to filter table rows based on search input
      function filterTableRows() {
        var input = document.getElementById('searchInput');
        var filter = input.value.toUpperCase();
        var tableBody = document.getElementById('table-body');
        var rows = tableBody.getElementsByTagName('tr');

        // Loop through all table rows
        for (var i = 0; i < rows.length; i++) {
          var cells = rows[i].getElementsByTagName('td');
          var found = false;

          // Check each cell in the row for a match with the search query
          for (var j = 0; j < cells.length; j++) {
            var cell = cells[j];
            if (cell) {
              var textValue = cell.textContent || cell.innerText;
              // Check if the cell value contains the search query
              if (textValue.toUpperCase().indexOf(filter) > -1) {
                found = true;
                break; // If found, no need to search further
              }
            }
          }

          // Toggle row display based on search result
          if (found) {
            rows[i].style.display = ''; // Show row
          } else {
            rows[i].style.display = 'none'; // Hide row
          }
        }
      }

      // Attach event listener to search input field to trigger filtering
      document.getElementById('searchInput').addEventListener('keyup', filterTableRows);
    </script>



</body>

</html>