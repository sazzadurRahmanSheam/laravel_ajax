@extends('layout.master')
@section('title','Add Record')

@section('content')
	<div class="col-md-12">



		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="studentsList-tab" data-toggle="tab" href="#studentsList" role="tab" aria-controls="studentsList" aria-selected="true">Students List</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="add-tab" data-toggle="tab" href="#add" role="tab" aria-controls="add" aria-selected="false">Add Record</a>
			</li>
		</ul>

		<div class="tab-content" id="myTabContent">

			<div class="tab-pane fade show active" id="studentsList" role="tabpanel" aria-labelledby="studentsList-tab">
				
				<div id="message"></div>

				<table class="table table-bordered table-sm">
					<thead>
						<tr>
						<th>No</th>
						<th>First Name</th>
						<th>Last name</th>
						<th>Action</th>
						</tr>
					</thead>
					<tbody id="bodyData">

					</tbody>  
				</table>

			</div>

			<div class="tab-pane fade" id="add" role="tabpanel" aria-labelledby="add-tab">


				<h1 class="text-info" id="form_heading">Student Entry</h1>
				<form method="post" id="studentRecordEntry">
					@csrf
					<input type="hidden" name="work_function" id="work_function" value="insert">
					<input type="hidden" name="ID" id="ID" value="">
					<div class="form-group row">
						<label for="firstName" class="col-sm-2 col-form-label">First Name <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter Your Name" >
						</div>
					</div>
					<div class="form-group row">
						<label for="lastName" class="col-sm-2 col-form-label">Last Name <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Your Name" >
						</div>
					</div>
					<button type="submit" id="butsave" class="btn btn-success">Submit</button>
				</form>

			</div>
			
		</div>

		

	</div>
@endsection

@section('addScript')
	<script type="text/javascript">
		jQuery(document).ready(function() {
			


			$('#butsave').on('click', function(event) {
				event.preventDefault();
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});

				var formData = $('#studentRecordEntry').serialize();
				if ($('#firstName').val() == "") {
					alert("First name Rquired");
					$("#firstName").focus();
				}
				else if($('#lastName').val() == ""){
					alert("Last name Rquired");
					$("#lastName").focus();
				}
				else{
					$.ajax({
						url: '/laravel_ajax/student/store',
						type: 'post',
						//dataType: "json",
						data: formData,
						cache: false,
						success: function(response){
							var response = JSON.parse(response);
							$("#message").html(response['successMessage']);
							$('#studentsList-tab').trigger('click');
							$("#studentRecordEntry").trigger("reset");
							$("#add-tab").html("Add Record");

							getData();		
						}
					});
				}
			});
		

			

		});


		function getData(){
			$.ajax({
            url: "/laravel_ajax/student/show",
            //type: "POST",
            // data:{ 
            //     _token:'{{ csrf_token() }}'
            // },
            cache: false,
            dataType: 'json',
            success: function(response){
                // console.log(response);
                var data = response.data;
                var tableData = '';
                var i=1;
                $.each(data,function(index,row){
                    //var editUrl = "";//url+'/'+row.id+"/edit"
                    tableData+="<tr>"
                    tableData+="<td>"+ i++ +"</td><td>"+row.firstName+"</td><td>"+row.lastName+"</td>"
                    +"<td><button class='btn btn-info' onclick='edit("+row.id+")'>Edit</button>" 
                    +"<button class='btn btn-danger deletess' onclick='deletess("+row.id+")' style='margin-left:20px;'>Delete</button></td>";
                     tableData+="</tr>";
                    
                 })
                 $("#bodyData").html(tableData);
            }
        });

		}
		getData();


	//delete
	function deletess(id){
		var deleteId = id;

		$.ajax({
		 	url: '/laravel_ajax/student/delete/'+deleteId,
		
		 	cache: false,
		 	success: function(response){
		 		var response = JSON.parse(response);
				$("#message").html(response['deleteMessage']);
		 		getData();
		 	}
		 });
	}

	function edit(id){
		var editId = id;
		$.ajax({
			url: '/laravel_ajax/student/edit/'+editId,
			success: function(response){
		 		var response = JSON.parse(response);
				var data = response.data;
				//console.log(data['id']);
				$("#studentRecordEntry").trigger("reset");
				$('#add-tab').trigger('click');
				$("#firstName").val(data['firstName']);
				$("#lastName").val(data['lastName']);
				$("#form_heading").html("Student Modify");
				$("#butsave").html("Update");
				$("#work_function").val("update");
				$("#add-tab").html("update");
				$("#ID").val(data['id']);
		 	}
		});
	}

	</script>
@endsection