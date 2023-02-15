<!DOCTYPE html>
<html>
<head>
    <title>The Athletic - Display Users</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" >
    <script src="https://kit.fontawesome.com/671161211a.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" ></script>
</head>
<body>
    <div class="container mt-4">

        <!-- Modal -->
        <div class="modal fade" id="empModal" >
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <!-- <h4 class="modal-title">Subscriber Info</h4> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <table class="w-100" id="tblempinfo">
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-center font-weight-bold">
                The Athletic Subscribers
            </div>
            <div class="card-body">
                <div class="form-group">
                    <!-- Hassan Farooq -->
                    @if (!$response['error'])
                        <table id='empTable'>
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date Created</th>
                                <th>Actions</th>
                            </tr>
                            @foreach ($response['data'] as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ date('m/d/Y h:i A', strtotime($user->dateCreated)) }}</td>
                                    <td>
                                        <!-- <a href="/users/{{ $user->id }}">
                                            <i class="fa-regular fa-eye"></i>
                                        <a> -->
                                        <button class='btn btn-info viewDetails' data-id='{{ $user->id }}'>View</button>
                                        <button class='btn btn-info editDetails' data-id='{{ $user->id }}'>Edit</button>
                                        <button class='btn btn-info deleteUser' data-id='{{ $user->id }}'>Delete</button>
                                        <!-- <button data-toggle="modal" data-target="#demoModal" type="button"><i class="fa-regular fa-pen-to-square"></i></button> -->
                                        <!-- <i class="fa-regular fa-pen-to-square"></i> -->
                                        <!-- <i class="fa-solid fa-trash-can"></i> -->
                                    </td>
                                </tr>
                            @endforeach
                            <!-- Modal Example Start-->
			<!-- <div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria- 
            labelledby="demoModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="demoModalLabel">Modal Example - 
                             Websolutionstuff</h5>
								<button type="button" class="close" data-dismiss="modal" aria- 
                                label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
								Welcome, Websolutionstuff !!
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data- 
                            dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Save 
                                changes</button>
						</div>
					</div>
				</div>
			</div> -->
	 <!-- Modal Example End-->
                        </table>
                    @else
                        Error: {{ $response['message'] }}
                    @endif
                </div>
                <!-- <form name="total-amount-form" id="total-amount-form" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="number">Amount</label>
                        <input type="number" id="amount" name="amount" step="any" class="form-control" required="">
                    </div>
                    <button type="submit" class="btn btn-primary">Get Coins Combination</button>
                </form> -->
                @isset($change)
                    {{ dd($change) }}
                @endisset
            </div>
        </div>
    </div>

    <!-- Script -->
    <script type='text/javascript'>
    $(document).ready(function(){

        // Upon click on View button
        $('#empTable').on('click','.viewDetails',function(){
            var empid = $(this).attr('data-id');

            if(empid > 0){

                // AJAX request
                var url = "{{ route('getUser',[':empid']) }}";
                url = url.replace(':empid',empid);

                // Empty modal data
                $('#tblempinfo tbody').empty();

                console.log(empid);
                $.ajax({
                    url: url,
                    // dataType: 'json',
                    success: function(response){
                        // Add employee details
                        $('#tblempinfo tbody').html(response);

                        // Display Modal
                        $('#empModal').modal('show'); 
                    }
                });
            }
        });

        // Upon click on Edit button
        $('#empTable').on('click','.editDetails',function(){
            var empid = $(this).attr('data-id');

            if(empid > 0){

                // AJAX request
                var url = "{{ route('editUser',[':empid']) }}";
                url = url.replace(':empid',empid);

                // Empty modal data
                $('#tblempinfo tbody').empty();

                console.log(empid);
                $.ajax({
                    url: url,
                    // dataType: 'json',
                    success: function(response){
                        // Add employee details
                        $('#tblempinfo tbody').html(response);

                        // Display Modal
                        $('#empModal').modal('show'); 
                    }
                });
            }
        });

    });
    </script>
</body>
</html>
