<?php
  include('connection1.php');
  include('functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
    integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
    integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="uacss/design.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

  <title>Manage Users</title>
</head>

<body>
    <!-- Navigation -->
 <?php include('includes/navbar.html') ?>
  <br>
  <div class="container">
    <div class="row">
      <div class="col-md-15 card">
        <div>
<div class="head-title">
  <br>
            <h4 style="font-size: 25"class="text-center"><i class="fas fa-user"></i> Users Data Table</h4>
            <hr>
          </div>
          <div class="col-md-3 float-left add-new-button">
            <a href="create_user.php" class="btn btn-primary btn-block">
              <i class="fas fa-plus"></i> Add New User
            </a>
          </div>
          <br><br><br>
          <table id="multi_login" class="table table-striped">
            <thead class="bg-secondary text-white">
              <tr >
                <th>User ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Password</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

            <?php

              $sql = "SELECT * FROM users";
              $result = mysqli_query($conn, $sql);

            if($result)
            {
              while($row = mysqli_fetch_assoc($result)){
            ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['firstname']; ?></td>
                <td><?php echo $row['lastname']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['user_type']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td>
                  <button type="button" class="btn btn-info viewBtn"> <i class="fas fa-eye"></i></button>

                  <button type="button" class="btn btn-warning updateBtn"> <i class="fas fa-edit"></i></button>

                  <button type="button" class="btn btn-danger deleteBtn"> <i class="fas fa-trash-alt"></i></button>
                </td>
              </tr>
            <?php
              }
            }else{
              echo "<script> alert('No Record Found');</script>";
            }
          ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- MODALS -->

  <!-- ADD RECORD MODAL -->

  <!-- VIEW MODAL -->
  <div class="modal fade" id="viewModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title">View Record Information</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>Username:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewUsername"></div>
            </div>
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>First Name:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewFirstname"></div>
            </div>
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>Last Name:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewLastname"></div>
            </div>
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>Gender:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewGender"></div>
            </div> 
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>Email:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewEmail"></div>
            </div>
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>User Type:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewUsertype"></div>
            </div> 
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>Password:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewPassword"></div>
            </div>           
          </div>
          <br>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

 
  <!-- UPDATE MODAL -->
  <div class="modal fade" id="updateModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">Edit Record</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="update.php" method="POST">
            <input type="hidden" name="updateId" id="updateId">
            <div class="form-group">
              <label for="title">Userame</label>
              <input type="text" name="updateUsername" id="updateUsername" class="form-control" placeholder="Enter Username" maxlength="50"
                required>
            </div>

            <div class="form-group">
              <label for="title">First Name</label>
              <input type="text" name="updateFirstname" id="updateFirstname" class="form-control" placeholder="Enter First Name" maxlength="50"
                required>
            </div>
            <div class="form-group">
              <label for="title">Last Name</label>
              <input type="text" name="updateLastname" id="updateLastname" class="form-control" placeholder="Enter Last Name" maxlength="50"
                required>
            </div>
            <div class="form-group">
              <label for="title">Gender</label>
              <input type="text" name="updateGender" id="updateGender" class="form-control" placeholder="Enter Gender" maxlength="50"
                required>
            </div>
            <div class="form-group">
              <label for="title">Email</label>
              <input type="text" name="updateEmail" id="updateEmail" class="form-control" placeholder="Enter Email" maxlength="50" required>
            </div>
            <div class="form-group">
              <label for="title">Usertype</label>
              <input type="text" name="updateUsertype" id="updateUsertype" class="form-control" placeholder="Enter Usertype" maxlength="50"
                required>
            </div>
            <div class="form-group">
              <label for="title">Password</label>
              <input type="text" name="updatePassword" id="updatePassword" class="form-control" placeholder="Enter Password" maxlength="50"
                required>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="updateData">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- DELETE MODAL -->
  <div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="user-delete.php" method="POST">

          <div class="modal-body">

            <input type="hidden" name="deleteId" id="deleteId">

            <h4>Are you sure want to delete?</h4>

          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary" name="deleteData">Yes</button>
        </div>

        </form>
      </div>
    </div>
  </div>

  <script src="http://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
    integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
    crossorigin="anonymous"></script>
  <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>

  <script>
    $(document).ready(function () {
      $('.updateBtn').on('click', function(){

        $('#updateModal').modal('show');

        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#updateId').val(data[0]);
        $('#updateUsername').val(data[1]);
        $('#updateFirstname').val(data[2]);
        $('#updateLastname').val(data[3]);
        $('#updateGender').val(data[4]);
        $('#updateEmail').val(data[5]);
        $('#updateUsertype').val(data[6]);
        $('#updatePassword').val(data[7]);    

        });
        
    });
  </script>

  <script>
    $(document).ready(function () {
      $('.viewBtn').on('click', function(){

        $('#viewModal').modal('show');

        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#viewUsername').text(data[1]);
        $('#viewFirstname').text(data[2]);
        $('#viewLastname').text(data[3]);
        $('#viewGender').text(data[4]);
        $('#viewEmail').text(data[5]);
        $('#viewUsertype').text(data[6]);
        $('#viewPassword').text(data[7]);       

        });
    
    });
  </script>

  <script>
    $(document).ready(function () {
      $('.deleteBtn').on('click', function(){

        $('#deleteModal').modal('show');
        
        // Get the table row data.
        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#deleteId').val(data[0]);

        });
    
    });
  </script>
      <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
      $(document).ready( function () {
           $('#multi_login').DataTable();
          } );
    </script>
</body>

</html>