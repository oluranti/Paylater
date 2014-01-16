<?php $this->load->module('admintemplate'); ?>

<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Admin Users</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Admin Users</h2>
                        <div class="box-icon">
					<a class="btn btn-primary" href="#" data-target="#AddUser" data-toggle="modal" title="Add User">
										<i class="icon-plus icon-white"></i>                                          
									</a>
                                    </div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
                                    <th>#</th>
								  <th>username</th>
								  <th>
                                    &nbsp;
                                    </th>
							  </tr>
						  </thead>   
						  <tbody>
<?php 
if(isset($c)){
    $c = $c;
}else{
    $c = 1;
}

$usercount = count($users->result());
if($usercount > 0):
foreach($users->result() as $user){
 ?>
							<tr>
                                <td><?php echo $c; ?></td>
								<td class="center"><?php echo $user->username; ?></td>
                                <td class="center">
									<a class="btn btn-info" href="#" data-target="#EditUser<?php echo $user->id; ?>" data-toggle="modal" title="Edit User">
										<i class="icon-edit icon-white"></i>                                     
									</a>
									<a class="btn btn-danger" href="<?php echo base_url('adminusers/deleteuser') ?>/<?php echo $user->id; ?>" title="Delete User">
										<i class="icon-trash icon-white"></i>
									</a>
								</td>
							</tr>
<?php $c++;
 }
else: ?>
<tr>
<td colspan="3">
<div class="alert">
I could not find any user on the database. Try Adding One.
</div>
</td>
</tr>
<?php endif
 ?>
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
            <div class="pagination pagination-center"><?php if(isset($pagenavi)){ echo $pagenavi; } ?></div>
      
<?php 
foreach($users->result() as $user){
 ?>


<!-- Edit User -->
<div id="EditUser<?php echo $user->id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="EditUser<?php echo $user->id; ?>Label" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 id="EditUser<?php echo $user->id; ?>Label">Edit User</h3>
  </div>
<div class="modal-body">
          
          <form role="form" action="<?php echo base_url('adminusers/updateuser'); ?>" method="post">
          
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" value="<?php echo @$user->username; ?>"   />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" value="<?php echo @$user->password; ?>"   />
          </div>
          
          <input type="hidden" name="id" value="<?php echo @$user->id; ?>" />
            
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update User</button></form>
            </div>
</div>

<?php } ?>




      
<!-- Add User -->
<div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="AddUserLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="AddUserLabel">Add Admin User</h4>
          </div>
          <div class="modal-body">
          
          <form role="form" action="<?php echo base_url('adminusers/adduser'); ?>" method="post" >
          
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" value="<?php echo @$username; ?>"   />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" value="<?php echo @$password; ?>"   />
          </div>
            
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Add Admin User</button></form>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->