<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link  rel="shortcut icon" type="image/png" href="../images/logo/white.png">
  <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.css">
  <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/fontawesome.min.css">
  <link rel="stylesheet" href="../css/bootstrapcss/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrapcss/bootstrap.css">
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/entry-filter.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <style>
    .add-users {
      width: 50px;
      border: none;
      font-size: 1.8rem;
    }

    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  </style>

</head>


<body>

  <?php
  include('top-nav.php');
  include('../include/db_connection.php');
  if (!isset($_SESSION['_id']) || $_SESSION['role'] == 'user' || $_SESSION['role'] == 'agent') {
    header("Location: login.php");
    exit();
  } else {
    $logged_role = $_SESSION['role'];
  }
  if ($_SESSION['role'] == $_GET['role']) {
    header("Location: ../404.php");
    exit();
  }

  $filter = intval($_GET['filter'] ?? 5);

  if (!isset($_GET['role'])) {
    header("Location: ../404.php");
    die("Database Query Failed.");
    exit();
  } else {
    $role = $_GET['role'];
    $query = "SELECT * FROM users WHERE is_deleted=0 and role = ? LIMIT $filter";
  }

  $valid_roles = array("user", "agent", "admin");
  try {
    $stmt = mysqli_prepare($conn, $query);
    if (in_array($role, $valid_roles)) {
      $listing = $role;
    } else {
      header("Location: 404.php");
      die("Database Query Failed.");
      exit();
    }
  } catch (Exception) {
    header("Location: 404.php");
    die("Database Query Failed.");
    exit();
  }
  ?>

  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="main">
          <div class="heading">
            <h1 class="heading-title"><?php echo ucfirst($listing) ?></h1>
            <h2 class="heading-sub-title"><a href="dashboard.php">Dashboard</a> / <?php echo ucfirst($listing) ?></h2>
          </div>

          <div class="card-filter">
            <div class="col-sm-12 ">
              <div class="card-header">
                <h1 class="card-header-List"><?php echo ucfirst($listing) ?> List</h1>
                <button type="button" class="btn add-users">
                  <a href="register.php">
                    <i class="fa-solid fa-user-plus"></i>
                  </a>
                </button>
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
                          <th scope="col">Id</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Phone</th>
                          <th scope="col">Image</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody id="table-body">
                        <?php
                        if ($stmt) {
                          mysqli_stmt_bind_param($stmt, "s", $role);
                          mysqli_stmt_execute($stmt);
                          $result = mysqli_stmt_get_result($stmt);
                          if (!$result) {
                            header("Location: 404.php");
                            die("Database Query Failed.");
                          } else {
                            if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                $user_id = $row['_id'];
                                $query = "SELECT * FROM user_images WHERE user_id=$user_id and is_deleted=0";
                                $image_result = mysqli_query($conn, $query);
                                $user_image = mysqli_fetch_assoc($image_result);
                                $user_id = $row['_id'];
                        ?>
                                <tr>
                                  <td><?php echo $user_id; ?></td>
                                  <td><?php echo $row['first_name'] . ' ' . $row['last_name'];  ?></td>
                                  <td><?php echo $row['email']; ?></td>
                                  <td><?php echo $row['country_code'] . $row['phone_number']; ?></td>
                                  <td>
                                    <?php
                                    if ($user_image) {
                                    ?>
                                      <img src="<?php echo '../' . $user_image['file_path']; ?>">
                                    <?php
                                    } else {
                                    ?>
                                      <img src="../images/users/default.jpg" alt="Blank Default Image">
                                    <?php
                                    }
                                    ?>
                                  </td>
                                  <td class="text-primary fw-normal">
                                    <button type="button" class="btn btn-lg delete-users btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete" value="Delete" data-userid="<?php echo $user_id; ?>" data-table="users">
                                      Delete
                                    </button>
                                  </td>
                                </tr>
                              <?php
                              }
                            } else { ?>
                              <tr>
                                <td colspan="6">No records found</td>
                              </tr>
                        <?php
                            }
                          }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <!-- <div class="row showing-enteries">
                <div class="col-sm-6">
                  Showning 1 Out of 2 enteries
                </div>
                <div class="col-sm-6 text-end">
                  <button><i class="fa-solid fa-angles-left"></i></button>
                  1
                  <button><i class="fa-solid fa-angles-right"></i></button>
                </div>
              </div> -->
              <div class="row">
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
                        <button type="button" class="btn btn-lg btn-danger" onclick="deleteEntry($('#confirmDelete').data('userid'), $('#confirmDelete').data('table'))">Delete</button>
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
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var role = '<?php echo $role; ?>';
        var selectElement = document.getElementById('show-filters');
        selectElement.addEventListener('change', function(event) {
          filterUsers(event, role);
        });
      });

      function deleteEntry(userId, table) {
        $.ajax({
          url: 'delete-entry.php',
          method: 'POST',
          data: {
            table: table,
            id: userId
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

      // function addEntry() {
      //   var formData = $('#addUsersForm').serialize();
      //   // Make an AJAX request to add the user
      //   $.ajax({
      //     url: 'add-entry.php',
      //     method: 'POST',
      //     data: formData,
      //     success: function(response) {
      //       console.log(response);
      //       if (response.success === false) {
      //         $('#emailError').text(response.errors.email);
      //         $('#passwordError').text(response.errors.password);
      //         $('#rePasswordError').text(response.errors.re_password);
      //         $('#PhoneError').text(response.errors.phone);
      //         $('#addUsers').modal('show');
      //       } else {
      //         // window.location.reload();
      //         $('#addUsersForm')[0].reset();
      //         $('#addUsers').modal('hide');
      //       }
      //     },
      //     error: function(xhr, status, error) {
      //       console.error(error);
      //     }
      //   });
      // }

      // Event listener for delete modal show event
      $('#confirmDelete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('userid');
        var table = button.data('table');
        $('#confirmDelete').data('userid', id);
        $('#confirmDelete').data('table', table);
      });

      // $(document).ready(function() {
      //   $('#addUsersForm').submit(function(event) {
      //     // Prevent the default form submission
      //     event.preventDefault();
      //     addEntry();
      //   });
      // });

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