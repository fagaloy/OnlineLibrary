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
  <title>Manage Books</title>
</head>

<body>
    <!-- Navigation -->
 <?php include('includes/navbar.html') ?>
  <br>
  <div class="container">
    <div class="row">
      <div class="col-md-12 card">
        <div>
          <div class="head-title">
            <br>
            <h4 style="font-size: 25"class="text-center"><i class="fas fa-book"></i> Books Data Table</h4>
            <hr>
          </div>  
          <br>
          <table id="multi_login" class="table table-striped">
            <thead class="bg-secondary text-white">
              <tr class="text-center" style="font-size: 15">
                <th>Book ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Genre</th>
                <th>Status</th>
                <th>Borrower</th>
                <th>Command</th>
              </tr>
            </thead>
            <tbody>

            <?php

              $sql = "SELECT * FROM issue_book";
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
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['borrower']; ?></td>
                <td>
                  <button type="button" class="btn btn-info viewBtn"> <i class="fas fa-eye"> View</i></button>
                  <button  type="button" class="btn btn-success addBtn"> <i class="fas fa-edit"> Issue</i></button>
                  <button  type="button" class="btn btn-danger deleteBtn"> <i class="fas fa-share"> Return</i></button>
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
  <!-- VIEW MODAL -->
  <div class="modal fade" id="viewModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title">View Book Information</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>ID:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewId"></div>
            </div>
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
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>Status:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewStatus"></div>
            </div>
            <div class="col-sm-5 col-xs-6 tital " >
              <strong>Borrower:</strong>
            </div>
            <div class="col-sm-7 col-xs-6 ">
              <div id="viewBorrower"></div>
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
  <div class="modal fade" id="addModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">Issue Book</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="book-transaction.php" method="POST">
            <div class="form-group">
              <input readonly type="hidden" name="updateId" id="updateId" class="form-control" maxlength="50"
                required>
            </div>            
            <div class="form-group">
              <input readonly type="hidden" name="updateTitle" id="updateTitle" class="form-control" maxlength="50"
                required>
            </div>
            <div class="form-group">
              <input readonly type="hidden" name="updateAuthor" id="updateAuthor" class="form-control"  maxlength="50"
                required>
            </div>
            <div class="form-group">
              <input readonly type="hidden" name="updatePublisher" id="updatePublisher" class="form-control"maxlength="50"
                required>
            </div>
            <div class="form-group">
              <input readonly type="hidden" name="updateGenre" id="updateGenre" class="form-control" maxlength="50" required>
            </div>
                        <div class="form-group">  
              <select class="form-control" name="status" id="status">
                <option value ="Approved">Accept</option>
                <option value ="Declined">Decline</option>
              </select>

            </div>
                        <div class="form-group">
              <input type="hidden" name="borrower" id="borrower" class="form-control" maxlength="50"
                required>
            </div>
              <label for="title">Approve Request?</label>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" name="sendData">Approve</button>
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
          <h5 class="modal-title" id="exampleModalLabel">Return Book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="issue-book-return.php" method="POST">

          <div class="modal-body">

            <input type="hidden" name="deleteId" id="deleteId">

            <h4>Are you sure want to return?</h4>

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
      $('.addBtn').on('click', function(){

        $('#addModal').modal('show');

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
        $('#status').val(data[5]); 
        $('#borrower').val(data[6]);      
      

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
        $('#viewId').text(data[0]);
        $('#viewTitle').text(data[1]);
        $('#viewAuthor').text(data[2]);
        $('#viewPublisher').text(data[3]);
        $('#viewGenre').text(data[4]);
        $('#viewStatus').text(data[5]);
        $('#viewBorrower').text(data[6]);     

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
    </script></body>

</html>