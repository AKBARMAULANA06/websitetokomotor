<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark bg-primary shadow-sm">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button">
              <i class="fas fa-bars"></i>
          </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
          <a href="/" class="nav-link">Home</a>
      </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
      <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button" title="Fullscreen">
              <i class="fas fa-expand-arrows-alt"></i>
          </a>
      </li>
      <li class="nav-item">
          <a href="/logout" class="nav-link" title="Logout">
              <i class="fas fa-sign-out-alt"></i> Logout
          </a>
      </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Optional: Add some custom CSS for further styling -->
<style>
  .navbar {
      transition: background-color 0.3s ease;
  }

  .navbar:hover {
      background-color: #0056b3; /* Darker shade on hover */
  }

  .nav-link {
      color: #ffffff !important; /* White text for links */
      transition: color 0.3s ease;
  }

  .nav-link:hover {
      color: #ffd700 !important; /* Gold color on hover */
  }

  .nav-link i {
      margin-right: 5px; /* Space between icon and text */
  }
</style>