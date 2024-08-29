<?php
session_start();
?>
<div class="main-nav secondary-nav hover-primary-nav py-2">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
          <a aria-label="logo" class="navbar-brand position-relative" href="index.php">
            <img class="nav-logo" src="images/logo/logo.png" width="150">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav gap-4 mr-auto">
              <li class="nav-item "> <a class="nav-link" href="index.php">Home</a></li>
              <li class="nav-item"> <a class="nav-link" href="agent.php">Agent</a> </li>
              <li class="nav-item"> <a class="nav-link" href="properties.php">Properties</a> </li>
              <?php
              if (isset($_SESSION['_id'])) {
              ?>
                <li class="nav-item"> <a class="nav-link" href="feedback.php">Feedback</a> </li>
              <?php
              }
              ?>
            </ul>


            <div class=" nav-right ml-auto d-flex  gap-4">
              <?php
              if (!isset($_SESSION['_id'])) {
                echo '<a class="nav-link" href="login.php">Login</a>
                        <a class="btn btn-primary register" href="register.php">Register</a>';
              } else {
                $username = $_SESSION['first_name'];
                echo '<div class="user-name">
                          <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle user" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fa-solid fa-user "></i>' . $username . '</a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="submitproperty.php">Submit Property</a></li>
                              <li><a class="dropdown-item" href="mypropertylist.php">Property List</a></li>
                              <li><a class="dropdown-item" href="myaccount.php">My Account</a></li>
                              <li><a class="dropdown-item" href="include/logout.php">Logout</a></li>
                            </ul>
                          </div>
                        </div>';
              }
              ?>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
</div>