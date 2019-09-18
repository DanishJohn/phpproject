 <?php
  include 'connection.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ajax Update</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<br/>
<br/>
<br/>
<br/>
  <h2>Ajax Update</h2>
  <p>Update user info with Jquery Ajax:</p>            
  <table class="table">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
          $table  = mysqli_query($connection ,'SELECT * FROM user');
          while($row  = mysqli_fetch_array($table)){ ?>
              <tr id="<?php echo $row['id']; ?>">
                <td data-target="firstName"><?php echo $row['firstName']; ?></td>
                <td data-target="lastName"><?php echo $row['lastName']; ?></td>
                <td data-target="email"><?php echo $row['email']; ?></td>
                <td><a href="#" data-role="update" data-id="<?php echo $row['id'] ;?>">Update</a></td>
              </tr>
         <?php }
       ?>
       
    </tbody>
  </table>

  
</div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" id="firstName" class="form-control">
              </div>
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" id="lastName" class="form-control">
              </div>

               <div class="form-group">
                <label>Email</label>
                <input type="text" id="email" class="form-control">
              </div>
                <input type="hidden" id="userId" class="form-control">


          </div>
          <div class="modal-footer">
            <a href="#" id="save" class="btn btn-primary pull-right">Update</a>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

</body>

<script>
  $(document).ready(function(){

    //  append values in input fields
      $(document).on('click','a[data-role=update]',function(){
            var id  = $(this).data('id');
            var firstName  = $('#'+id).children('td[data-target=firstName]').text();
            var lastName  = $('#'+id).children('td[data-target=lastName]').text();
            var email  = $('#'+id).children('td[data-target=email]').text();

            $('#firstName').val(firstName);
            $('#lastName').val(lastName);
            $('#email').val(email);
            $('#userId').val(id);
            $('#myModal').modal('toggle');
      });

      // now create event to get data from fields and update in database 

       $('#save').click(function(){
          var id  = $('#userId').val(); 
         var firstName =  $('#firstName').val();
          var lastName =  $('#lastName').val();
          var email =   $('#email').val();

          $.ajax({
              url      : 'connection.php',
              method   : 'post', 
              data     : {firstName : firstName , lastName: lastName , email : email , id: id},
              success  : function(response){
                            // now update user record in table 
                             $('#'+id).children('td[data-target=firstName]').text(firstName);
                             $('#'+id).children('td[data-target=lastName]').text(lastName);
                             $('#'+id).children('td[data-target=email]').text(email);
                             $('#myModal').modal('toggle'); 

                         }
          });
       });
  });
</script>
</html>
