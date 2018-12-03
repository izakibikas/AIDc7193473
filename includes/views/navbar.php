<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #e3f2fd;">
  <div class="container">
    <a class="navbar-brand" href="<?php echo url('index.php') ?>">Events</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo url('index.php') ?>">Home
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo url('about.php') ?>">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo url('contact.php') ?>">Contact</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <?php
        if(admin()){
          ?>
          <li class="nav-item">
            <strong>
              <a class="nav-link" href="<?php echo url('admin_panel.php') ?>">Admin Panel</a>
            </strong>
          </li>
          <?php
        }
        ?>
        <?php
        if(guest()){
          ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo url('login.php') ?>">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo url('register.php') ?>">Register</a>
          </li>
          <?php
        }
        else{
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <strong>Events</strong>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo url('event_add.php') ?>">Add Event</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?php echo url('event_my.php') ?>">My Events</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <strong><?php echo user('name'); ?></strong>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo url('profile.php') ?>">Profile</a>
              <a class="dropdown-item" href="<?php echo url('change_password.php') ?>">Change Password</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?php echo url('logout.php') ?>">Logout</a>
            </div>
          </li>
          <?php
        }
        ?>
      </ul>
    </div>
  </div>
</nav>