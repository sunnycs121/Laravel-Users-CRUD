<!DOCTYPE html>
<html>
<head>
    <title>The Athletic - Update User</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/671161211a.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                The Athletic Subscriber - Update
            </div>
            <div class="card-body">
                <div class="form-group">
                    @if (!$response['error'])
                        <form name="edit-user-form" id="edit-user-form">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" id="user_id" name="user_id" class="form-control" value="{{ $response['data']->id }}">
                                <label for="number">Name</label>
                                <input type="text" id="user_name" name="user_name" class="form-control" required="" value="{{ $response['data']->name }}">
                                <label for="number">Email</label>
                                <input type="email" id="user_email" name="user_email" class="form-control" required="" value="{{ $response['data']->email }}">
                            </div>
                            <button type="button" id="edit_user" class="btn btn-primary">Update</button>
                        </form>
                    @else
                        Error: {{ $response['message'] }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    <script type='text/javascript'>
    $(document).ready(function(){

        // Upon click on Edit button
        // $('#edit_user').on('click','.editDetails',function(){
        $("#edit_user").click(function(data){

            var id = $('#user_id').val();
            var name = $('#user_name').val();
            var email = $('#user_email').val();
            var data = {'id': id, 'name': name, 'email': email};
            // console.log(data);
            // return;
            $.ajax({
                url: 'api/users/'+id,
                type: 'put',
                data: data,
                contentType: "application/json",
                success: function(response){
                    $('#tblempinfo tbody').html(response);
                },
                error: function(response) { 
                    $('#tblempinfo tbody').html('Error updating user');
                }
            });
        });

    });
    </script>
</body>
</html>
