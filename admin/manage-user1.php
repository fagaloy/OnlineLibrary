<?php  

include('includes/navbar.html') 
 ?>
<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="dist/bootstrap.min.css" type="text/css" media="all">
<link href="dist/jquery.bootgrid.css" rel="stylesheet" />
<script src="dist/jquery-1.11.1.min.js"></script>
<script src="dist/bootstrap.min.js"></script>
<script src="dist/jquery.bootgrid.min.js"></script>
  <link rel="stylesheet" type="text/css" href="uacss/design1.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
    integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
 <title>Users List</title>   
</head>
<br>
<body>
	<div class="container">
      <div class="">
        <div class="col-sm-25">
		<div class="well clearfix">
			            <h4 style="font-size: 25" class="text-center"><i class="fas fa-user"></i> Users Data Table</h4>
			            <hr>
         <div class="col-md-3 float-left add-new-button">
            <a href="create_user.php" class="btn btn-primary btn">
              <i class="fas fa-plus"></i> Add New User
            </a>
          </div>
		<table id="user_grid" class="table table-condensed table-hover table-striped" width="60%" cellspacing="0" data-toggle="bootgrid">
			<thead>
				<tr style="font-size: 15">
					<th data-column-id="id" data-type="numeric" data-identifier="true">User ID</th>
					<th data-column-id="username">Username</th>
                    <th data-column-id="firstname">First Name</th>
                    <th data-column-id="lastname">Last Name</th>
					<th data-column-id="gender">Gender</th>
					<th data-column-id="email">Email</th>
					<th data-column-id="user_type">User Type</th>
					<th data-column-id="password">Password</th>
					<th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
				</tr>
			</thead>
		</table>
    </div>
      </div>
    </div>


<div id="edit_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Employee</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="frm_edit">
				<input type="hidden" value="edit" name="action" id="action">
				<input type="hidden" value="0" name="edit_id" id="edit_id">
                  <div class="form-group">
                    <label for="username" class="control-label">Username:</label>
                    <input type="text" class="form-control" id="edit_username" name="edit_username"/>
                  </div>
                  <div class="form-group">
                    <label for="firstname" class="control-label">First Name:</label>
                    <input type="text" class="form-control" id="edit_firstname" name="edit_firstname"/>
                  </div>
                <div class="form-group">
                    <label for="lastname" class="control-label">Last Name:</label>
                    <input type="text" class="form-control" id="edit_lastname" name="edit_lastname"/>
                  </div>
                  <div class="form-group">
                    <label for="gender" class="control-label">Gender:</label>
                    <input type="text" class="form-control" id="edit_gender" name="edit_gender"/>
                  </div>
				  <div class="form-group">
                    <label for="email" class="control-label">Email:</label>
                    <input type="text" class="form-control" id="edit_email" name="edit_email"/>
                  </div>
                  	<div class="form-group">
                    <label for="user_type" class="control-label">User Type:</label>
                    <input type="text" class="form-control" id="edit_user_type" name="edit_user_type"/>
                  </div>
                  	<div class="form-group">
                    <label for="password" class="control-label">Password:</label>
                    <input type="text" class="form-control" id="edit_password" name="edit_password"/>
                  </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btn_edit" class="btn btn-primary">Save</button>
            </div>
			</form>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
$( document ).ready(function() {
	var grid = $("#user_grid").bootgrid({
		ajax: true,
		rowSelect: true,
		post: function ()
		{
			/* To accumulate custom parameter with the request object */
			return {
				id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
			};
		},
		
		url: "user-response.php",
		formatters: {
		        "commands": function(column, row)
		        {
		            return "<button type=\"button\" class=\"btn btn-warning command-edit\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></button> " + 
		                "<button type=\"button\" class=\"btn btn-danger command-delete\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
		        }
		    }
   }).on("loaded.rs.jquery.bootgrid", function()
{
    /* Executes after data is loaded and rendered */
    grid.find(".command-edit").on("click", function(e)
    {
        //alert("You pressed edit on row: " + $(this).data("row-id"));
			var ele =$(this).parent();
			var g_id = $(this).parent().siblings(':first').html();
            var g_name = $(this).parent().siblings(':nth-of-type(2)').html();
console.log(g_id);
                    console.log(g_name);

		//console.log(grid.data());//
		$('#edit_model').modal('show');
					if($(this).data("row-id") >0) {
							
                                // collect the data
                                $('#edit_id').val(ele.siblings(':first').html()); // in case we're changing the key
                                $('#edit_username').val(ele.siblings(':nth-of-type(2)').html());
                                $('#edit_firstname').val(ele.siblings(':nth-of-type(3)').html());
                                $('#edit_lastname').val(ele.siblings(':nth-of-type(4)').html());
                                $('#edit_gender').val(ele.siblings(':nth-of-type(5)').html());
                                $('#edit_email').val(ele.siblings(':nth-of-type(6)').html());
                                $('#edit_user_type').val(ele.siblings(':nth-of-type(7)').html());
                                $('#edit_password').val(ele.siblings(':nth-of-type(8)').html());
					} else {
					 alert('Now row selected! First select row, then click edit button');
					}
    }).end().find(".command-delete").on("click", function(e)
    {
	
		var conf = confirm('Delete ' + $(this).data("row-id") + ' items?');
					alert(conf);
                    if(conf){
                                $.post('user-response.php', { id: $(this).data("row-id"), action:'delete'}
                                    , function(){
                                        // when ajax returns (callback), 
										$("#user_grid").bootgrid('reload');
                                }); 
								//$(this).parent('tr').remove();
								//$("#user_grid").bootgrid('remove', $(this).data("row-id"))
                    }
    });
});

function ajaxAction(action) {
				data = $("#frm_"+action).serializeArray();
				$.ajax({
				  type: "POST",  
				  url: "user-response.php",  
				  data: data,
				  dataType: "json",       
				  success: function(response)  
				  {
					$('#'+action+'_model').modal('hide');
					$("#user_grid").bootgrid('reload');
				  }   
				});
			}
			
			$( "#command-add" ).click(function() {
			  $('#add_model').modal('show');
			});
			$( "#btn_add" ).click(function() {
			  ajaxAction('add');
			});
			$( "#btn_edit" ).click(function() {
			  ajaxAction('edit');
			});
});
</script>
