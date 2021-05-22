<?php
  include('connection.php');
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
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/webstyle.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <title>PHP and MySQL CRUD</title>
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
               <div class="col-md-3 float-left add-new-button">
            <a href="http://localhost/Library/admin/index.php" class="btn btn-primary btn-block">
              <i class="fas fa-user"></i> Manage Users
            </a>
          </div>
    </div>
  </nav>
  <br><br><br>
<form>
  <div class="container">
    <div class="row">
      <div class="col-md-12 card">
        <div>
          <div class="head-title">
            <h4 class="text-center">Book Data Tables</h4>
            <hr>
          </div>
          <div class="col-md-3 float-left add-new-button">
            <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addModal">
              <i class="fas fa-plus"></i> Add New Book
            </a>
          </div>
          <div class="col-md-3 float-left add-new-button">
            <a href="pdf.php" target="_blank" class="btn btn-success btn-block">
              <i class="fas fa-print"></i> Print
            </a>
          </div>
          <br><br><br>
          <table id="multi_login" class="table table-striped">
            <thead class="bg-secondary text-white">
              <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Genre</th>
                <th>View</th>
                <th>Update</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>

            <?php

              $sql = "SELECT * FROM books";
              $result = mysqli_query($conn, $sql);

            if($result)
            {
              while($row = mysqli_fetch_assoc($result)){
            ?>
              <tr>
                <td><?php echo $row['book_id']; ?></td>
                <td><?php echo $row['book_title']; ?></td>
                <td><?php echo $row['book_author']; ?></td>
                <td><?php echo $row['book_publisher']; ?></td>
                <td><?php echo $row['book_genre']; ?></td>
                <td>
                  <button type="button" class="btn btn-info viewBtn"> <i class="fas fa-eye"></i> View </button>
                </td>
                <td>
                  <button type="button" class="btn btn-warning updateBtn"> <i class="fas fa-edit"></i> Update </button>
                </td>
                <td>
                  <button type="button" class="btn btn-danger deleteBtn"> <i class="fas fa-trash-alt"></i> Delete </button>
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
  <div class="modal fade" id="addModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Add New Book</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="insert.php" method="POST">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="book_title" class="form-control" placeholder="Enter book title" maxlength="50"
                required>
            </div>
            <div class="form-group">
              <label for="title">Author</label>
              <input type="text" name="book_author" class="form-control" placeholder="Enter book author " maxlength="50"
                required>
            </div>
            <div class="form-group">
              <label for="title">Publisher</label>
              <input type="text" name="book_publisher" class="form-control" placeholder="Enter book publisher" maxlength="50"
                required>
            </div>
            <div class="form-group">
              <label for="title">Genre</label>
              <input type="text" name="book_genre" class="form-control" placeholder="Enter book genre" maxlength="50" required>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="insertData">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

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
              <strong>Title:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewTitle"></div>
            </div>
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>Author:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewAuthor"></div>
            </div>
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>Publisher:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewPublisher"></div>
            </div>
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>Genre:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewGenre"></div>
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
              <label for="title">Title</label>
              <input type="text" name="updateTitle" id="updateTitle" class="form-control" placeholder="Enter book title" maxlength="50"
                required>
            </div>
            <div class="form-group">
              <label for="title">Author</label>
              <input type="text" name="updateAuthor" id="updateAuthor" class="form-control" placeholder="Enter book author" maxlength="50"
                required>
            </div>
            <div class="form-group">
              <label for="title">Publisher</label>
              <input type="text" name="updatePublisher" id="updatePublisher" class="form-control" placeholder="Enter book publisher" maxlength="50"
                required>
            </div>
            <div class="form-group">
              <label for="title">Genre</label>
              <input type="text" name="updateGenre" id="updateGenre" class="form-control" placeholder="Enter book genre" maxlength="50" required>
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
        <form action="delete.php" method="POST">

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
        $('#updateTitle').val(data[1]);
        $('#updateAuthor').val(data[2]);
        $('#updatePublisher').val(data[3]);
        $('#updateGenre').val(data[4]);     

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

        $('#viewTitle').text(data[1]);
        $('#viewAuthor').text(data[2]);
        $('#viewPublisher').text(data[3]);
        $('#viewGenre').text(data[4]);
        $('#viewDesignation').text(data[5]);      

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