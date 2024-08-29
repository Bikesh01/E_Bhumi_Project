<?php session_start(); ?>
<nav class="navbar sticky-top">
  <div class="container">
    <div class="row w-100">
      <div class="col-lg-3">
        <a href="dashboard.php"><img src="../images/logo/logo.png" alt="" height="50"></a>
      </div>
      <div class="col-lg-6 d-flex justify-content-center align-items-center">
        <h1 class="display-1 fw-bold">Dashboard</h1>
      </div>
      <div class="col-lg-3 d-flex justify-content-end align-items-center">
      <button class="btn btn-danger btn-lg mt-3" name="logout" onclick="window.location.href='logout.php'">Logout</button>
      </div>
    </div>
  </div>
</nav>
