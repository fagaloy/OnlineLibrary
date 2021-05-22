  <link rel="stylesheet" type="text/css" href="uacss/dropdown.css">
    <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
    integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
    integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

  <style>
  .header {
    background: rgba(255,100,100,0.5);
  }
  button[name=register_btn] {
    background: #003366;
  }
  </style>
  <div class="header">
          <h1>
        <i class="ace-icon fa fa-user green"></i>
            <span>Admin Profile</span>
      </h1>
  </div>
  <div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

    <!-- logged in user information -->
    <div class="profile_info">
      <img src="uacss/images/admin_profile.png"  >
      <div class="pull-left">
        <?php  if (isset($_SESSION['user'])) : ?>
          <strong><?php echo $_SESSION['user']['firstname']; ?></strong>
          <strong><?php echo $_SESSION['user']['lastname']; ?></strong> 
          <small>
        <i  style="color: rgb(0,0,0);">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 

          </small>
          <br>  
        <a  href="home.php?logout='1'" style="color: red;">
              <i class="fas fa-exit" ></i>Logout
              </a>


        <?php endif ?>
      </div>
    <br><br>

      <div class="pull-l<br>eft">
        <?php  if (isset($_SESSION['user'])) : ?> 
          <b  style="color: rgb(0,0,0);">Username: </b> <?php echo $_SESSION['user']['username']; ?>
          <br> 
          <b  style="color: rgb(0,0,0);">Name: </b> <?php echo $_SESSION['user']['firstname']; ?>
          <?php echo $_SESSION['user']['lastname']; ?>
          <br>
          <b  style="color: rgb(0,0,0);">Gender: </b> <?php echo $_SESSION['user']['gender']; ?>
          <br>
          <b  style="color: rgb(0,0,0);">Email: </b> <?php echo $_SESSION['user']['email']; ?>
          <br>
          <b  style="color: rgb(0,0,0);">User Type: </b><?php echo $_SESSION['user']['user_type']; ?>
          <br>
          <b  style="color: rgb(0,0,0);">Password: </b><?php echo $_SESSION['user']['password']; ?>
          <small> 
        <?php endif ?>

</div>
  </div>