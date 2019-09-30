
<h1>Employee Lists</h1>
<button id="btn_add" class="btn btn-success">Add New</button>
<br/><br/>
<div id="alert_success" class="alert alert-success" role="alert" style="display:none;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<br/>
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <td>ID</td>
                <td>Employee Name</td>
                <td>Address</td>
                <td>Created at</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody id="showdata">
            
        </tbody>
    </table>

<!-- Add Modal -->
<div id="add_modal" class="modal fade" id="exampleModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <form id="emp_form" action="" method="POST">
                    <div class="form-group row">
                        <label for="emp_name" class="col-sm-3 col-form-label">Employee Name</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="emp_name" name="emp_name" placeholder="Emplyee Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="emp_address" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="emp_address" name="emp_address" placeholder="Address">
                        </div>
                    </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btn_save" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Update Modal -->
<div id="edit_modal" class="modal fade" id="exampleModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <form id="edit_form" action="" method="POST">
                <input type="hidden" name="emp_id" id="emp_id" value="0">
                    <div class="form-group row">
                        <label for="edit_emp_name" class="col-sm-3 col-form-label">Employee Name</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_emp_name" name="edit_emp_name" placeholder="Emplyee Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="edit_emp_address" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_emp_address" name="edit_emp_address" placeholder="Address">
                        </div>
                    </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btn_edit" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>
<!-- DleteModal -->
<div id="delete_modal" class="modal fade" id="exampleModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you want to delete this record?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btn_delete" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>
    <script>
		$(document).ready(function() {
            showAllEmployee();

            $('#btn_add').click(function(){
                $('#add_modal').modal('show');
                $('#add_modal').find('.modal-title').text('Add New Employee');
                $('#emp_form').attr('action','<?php echo base_url();?>employee/addEmployee');
            });

            //add new employee
            $('#btn_save').click(function(){
                var url = $('#emp_form').attr('action');
                var data = $('#emp_form').serialize();
                var emp_name = $('#emp_name').val();
                var emp_address = $('#emp_address').val();
                var valid='';
                if(emp_name ==''){
                    $('#emp_name').addClass('is-invalid');
                }else{
                    $('#emp_name').removeClass('is-invalid');
                    valid +='1';
                }
                if(emp_address==''){
                    $('#emp_address').addClass('is-invalid');
                }else{
                    $('#emp_address').removeClass('is-invalid');
                    valid +='2';
                }
                if(valid=='12'){
                    $.ajax({
                        type : 'ajax',
                        method : 'post',
                        url : url,
                        data : {emp_name:emp_name,emp_address:emp_address},
                        async : false,
                        dataType : 'json',
                        success : function(response){
                            if(response.success){
                                $('#add_modal').modal('hide');
                                $('#emp_form')[0].reset();
                                $('#alert_success').html('Employee added Successfully').fadeIn().delay(4000).fadeOut('slow');
                                showAllEmployee();
                            }else{
                                alert('Error');
                            }
                            
                        },
                        error : function(){
                            alert('Could nat add data');
                        }
                    });
                }
            });

            //display all employees
            function showAllEmployee(){
                $.ajax({
                    type  : 'ajax',
                    url   : '<?php echo base_url();?>employee/showAllEmployee',
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        console.log(data);
                        var html = '';
                        var i,n;
                        var no=1;
                        for(i=0; i<data.length; i++){
                            n=no++;
                            html += '<tr>'+
                                '<td>'+n+'</td>'+
                                '<td>'+data[i].emp_name+'</td>'+
                                '<td>'+data[i].address+'</td>'+
                                '<td>'+data[i].created_at+'</td>'+
                                '<td>'+
                                    '<a href="javascript:;" class="btn btn-info item-edit" data="'+data[i].id+'">Edit</a>'+
                                    '<a href="javascript:;" class="btn btn-danger item-delete" data="'+data[i].id+'">Delete</a>'+
                                '</td>'+
                            '</tr>';
                        }
                        $('#showdata').html(html);
                    },
                    error : function(){
                        alert('Could not get Data from Database');
                    }
                });
            }

            //edit
            $('#showdata').on('click','.item-edit',function(){
                    var id = $(this).attr('data');
                    $('#edit_modal').modal('show');
                    $('#edit_modal').find('.modal-title').text('Edit Employee');
                    $('#edit_form').attr('action','<?php echo  base_url();?>employee/updateEmployee');
                    $.ajax({
                        type : 'ajax',
                        method : 'get',
                        url : '<?php echo  base_url();?>employee/editEmployee',
                        data :{id:id},
                        async : false,
                        dataType : 'json',
                        success : function(data){
                            $('input[name=edit_emp_name]').val(data.emp_name);
                            $('input[name=edit_emp_address]').val(data.address);
                            $('input[name=emp_id]').val(data.id);
                        },
                        error : function(){
                            alert('Could not edit data');
                        }
                    });
            });
            $('#btn_edit').click(function(){
                var url = $('#edit_form').attr('action');

                var emp_id = $('#emp_id').val();
                var emp_name = $('#edit_emp_name').val();
                var emp_address = $('#edit_emp_address').val();
                var valid='';
                if(emp_name ==''){
                    $('#edit_emp_name').addClass('is-invalid');
                }else{
                    $('#edit_emp_name').removeClass('is-invalid');
                    valid +='1';
                }
                if(emp_address==''){
                    $('#edit_emp_address').addClass('is-invalid');
                }else{
                    $('#edit_emp_address').removeClass('is-invalid');
                    valid +='2';
                }
                if(valid=='12' && emp_id != ''){
                    $.ajax({
                        type : 'ajax',
                        method : 'post',
                        url : url,
                        data : {emp_id:emp_id,emp_name:emp_name,emp_address:emp_address},
                        async : false,
                        dataType : 'json',
                        success : function(response){
                            console.log(response);
                            if(response.success){
                                $('#edit_modal').modal('hide');
                                $('#edit_form')[0].reset();
                                $('#alert_success').html('Employee updated Successfully').fadeIn().delay(4000).fadeOut('slow');
                                showAllEmployee();
                            }else{
                                alert('Error');
                            }
                            
                        },
                        error : function(){
                            alert('Could not update data');
                        }
                    });
                }
            });

            //Delete
            $('#showdata').on('click','.item-delete',function(){
                var emp_id = $(this).attr('data');
                $('#delete_modal').modal('show');
                $('#btn_delete').unbind().click(function(){
                    $.ajax({
                        type : 'ajax',
                        method : 'get',
                        async : false,
                        url : '<?php echo  base_url();?>employee/deleteEmployee',
                        data : {emp_id:emp_id},
                        dataType : 'json',
                        success : function(response){
                            if(response.success){
                                $('#delete_modal').modal('hide');
                                $('#alert_success').html('Employee Deleted Successfully').fadeIn().delay(4000).fadeOut('slow');
                                showAllEmployee();  
                            }else{
                                alert('Error');
                            }

                        },
                        error : function(){
                            alert('Error Deleting');
                        }
                    });
                });
            });
	     });
</script>