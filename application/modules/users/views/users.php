<?php $this->load->module('admintemplate'); ?>

<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Users</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Users</h2>
					<div class="box-icon">
							<a class="btn btn-primary" href="#" data-target="#AddUser" data-toggle="modal" title="Add User">
										<i class="icon-plus icon-white"></i>                                           
									</a>
                                    <a class="btn btn-primary" href="#" data-target="#ImportUsers" data-toggle="modal" title="Import Users from CSV">
										<i class="icon-upload icon-white"></i>                                           
									</a>
                                    <a class="btn btn-primary" href="<?php echo base_url('users/downloaduserlinks') ?>" title="Download User Links as CSV">
										<i class="icon-download-alt icon-white"></i>                                         
									</a>
						</div>
					</div>
					<div class="box-content">
                    
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
                                    <th>#</th>
								  <th>First Name</th>
								  <th>Last Name</th>
                                  <th>Email</th><!--
                                  <th>Home Address</th>
								  <th>Telephone Number</th>-->
                                  <th>Status</th>
                                  <th>&nbsp;
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
								
								<td class="center"><?php echo $user->firstname; ?></td>
								<td class="center"><?php echo $user->lastname; ?></td>
								<td class="center"><?php echo $user->email; ?></td>
                                <!--<td class="center"><?php echo $user->homeaddress; ?></td>
                                <td class="center"><?php echo $user->telephonenumber; ?></td>-->
                                <td class="center"><span class="label label-warning"><?php echo $user->status; ?></span></td>
                                <td class="center">
                                <a class="btn btn-inverse" href="#" data-target="#UserLink<?php echo $user->id; ?>" data-toggle="modal" title="Copy User Link">
										<i class="icon-share icon-white"></i>                                          
									</a>
									<a class="btn btn-success" href="#" data-target="#ViewUser<?php echo $user->id; ?>" data-toggle="modal" title="View User">
										<i class="icon-zoom-in icon-white"></i>                                           
									</a>
									<a class="btn btn-info" href="#" data-target="#EditUser<?php echo $user->id; ?>" data-toggle="modal" title="Edit User">
										<i class="icon-edit icon-white"></i>                                         
									</a>
									<a class="btn btn-danger" href="<?php echo base_url('users/deleteuser') ?>/<?php echo $user->id; ?>" title="Delete User">
										<i class="icon-trash icon-white"></i>
									</a>
								</td>
							</tr>
<?php $c++;
 }
else: ?>
<tr>
<td colspan="8">
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
 
 <!-- User Link -->
<div id="UserLink<?php echo $user->id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="UserLink<?php echo $user->id; ?>Label" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 id="UserLink<?php echo $user->id; ?>Label">Users Link</h3>
  </div>
<div class="modal-body">
          
          <form role="form" action="<?php echo base_url('users/updateuser'); ?>" method="post">
          
          <div class="form-group">
            <label for="firstname">Link</label>
            <input type="text" class=" span12 form-control" id="selecttext"  value="<?php echo @$user->link; ?>"  />
          </div>
         
            
          </div>
          <div class="modal-footer">
            <button data-dismiss="modal" class="btn">Close</button>
            </div>
</div>
<!-- View User -->
<div id="ViewUser<?php echo $user->id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="ViewUser<?php echo $user->id; ?>Label" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 id="ViewUser<?php echo $user->id; ?>Label">View User</h3>
  </div>
<div class="modal-body">
          
          <form role="form" action="<?php echo base_url('users/updateuser'); ?>" method="post">
          <div class="form-group">
            <label for="title">Title</label>
            <select name="title" class="form-control" id="title" disabled>
            <option <?php if(@$user->title == "Mr"){ echo 'selected = "yes"'; } ?> value="Mr">Mr</option>
            <option <?php if(@$user->title == "Mrs"){ echo 'selected = "yes"'; } ?> value="Mrs">Mrs</option>
            <option <?php if(@$user->title == "Miss"){ echo 'selected = "yes"'; } ?> value="Miss">Miss</option>
            <option <?php if(@$user->title == "Master"){ echo 'selected = "yes"'; } ?> value="Master">Master</option>
            </select>
          </div>
          <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" value="<?php echo @$user->firstname; ?>" disabled />
          </div>
          <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" value="<?php echo @$user->lastname; ?>" disabled />
          </div>
          <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control" id="gender" disabled >
            <option <?php if(@$user->gender == "Male"){ echo 'selected = "yes"'; } ?> value="Male">Male</option>
            <option <?php if(@$user->gender == "Female"){ echo 'selected = "yes"'; } ?> value="Female">Female</option>
            </select>
          </div>
          <div class="form-group">
            <label for="dateofbirth">Date of Birth</label>
            <input type="date" class="form-control" name="dateofbirth" id="dateofbirth" placeholder="mm/dd/yyyy" value="<?php echo @$user->dateofbirth; ?>" disabled />
          </div>
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="name@email.com" value="<?php echo @$user->email; ?>" disabled />
          </div>
          <div class="form-group">
            <label for="homeaddress">Home Address</label>
            <textarea class="form-control" name="homeaddress" id="homeaddress" placeholder="Home Address" disabled><?php echo @$user->homeaddress; ?></textarea>
          </div>
          <div class="form-group">
            <label for="telephonenumber">Telephone Number</label>
            <input type="text" class="form-control" name="telephonenumber" id="telephonenumber" placeholder="07087654321" value="<?php echo @$user->telephonenumber; ?>" disabled />
          </div>
          <div class="form-group">
            <label for="alternativecontactnumber">Alternative Contact Number</label>
            <input type="text" class="form-control" name="alternativecontactnumber" id="alternativecontactnumber" value="<?php echo @$user->alternativecontactnumber; ?>" placeholder="08012345678" class="required number" disabled />
          </div>
          <div class="form-group">
            <label for="employmenttype">Employment Type</label>
            <select name="employmenttype" class="form-control" id="employmenttype" disabled>
            <option <?php if(@$user->employmenttype == "Self-Employed"){ echo 'selected = "yes"'; } ?> value="Self-Employed">Self-Employed</option>
            <option <?php if(@$user->employmenttype == "Unemployed"){ echo 'selected = "yes"'; } ?> value="Unemployed">Unemployed</option>
            <option <?php if(@$user->employmenttype == "Salary Employee"){ echo 'selected = "yes"'; } ?> value="Salary Employee">Salary Employee</option>
            </select>
          </div>
          <div class="form-group">
            <label for="nameofemployer">Name of Employer/Business</label>
            <input type="text" class="form-control" name="nameofemployer" id="nameofemployer" value="<?php echo @$user->nameofemployer; ?>" placeholder="Name of Employer/Business" autocomplete="off" disabled />
          </div>
          <div class="form-group">
            <label for="officeaddress">Office/Business Address</label>
            <textarea class="form-control" name="officeaddress" id="officeaddress" placeholder="Office/Business Address" disabled><?php echo @$user->officeaddress; ?></textarea>
          </div>
          <div class="form-group">
            <label for="monthlyincome">Monthly Income</label>
            <select name="monthlyincome" class="form-control" id="monthlyincome" disabled>
            <option <?php if(@$user->monthlyincome == "10000 - 59999"){ echo 'selected = "yes"'; } ?>  value="10000 - 50000">10000 - 59999</option>
            <option <?php if(@$user->monthlyincome == "60000 - 100000"){ echo 'selected = "yes"'; } ?> value="60000 - 100000">60000 - 99999</option>
            <option <?php if(@$user->monthlyincome == "100000 - 999999"){ echo 'selected = "yes"'; } ?> value="100000 - 999999">100000 - 999999</option>
            <option <?php if(@$user->monthlyincome == "1000000 and Above"){ echo 'selected = "yes"'; } ?> value="1000000 and Above">1000000 and Above</option>
            </select>
          </div>
            
          </div>
          <div class="modal-footer">
            <button data-dismiss="modal" class="btn">Close</button></form>
            </div>
</div>

<!-- Edit User -->
<div id="EditUser<?php echo $user->id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="EditUser<?php echo $user->id; ?>Label" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 id="EditUser<?php echo $user->id; ?>Label">Edit User</h3>
  </div>
<div class="modal-body">
          
          <form role="form" action="<?php echo base_url('users/updateuser'); ?>" method="post">
          <div class="form-group">
            <label for="title">Title</label>
            <select name="title" class="form-control" id="title">
            <option <?php if(@$user->title == "Mr"){ echo 'selected = "yes"'; } ?> value="Mr">Mr</option>
            <option <?php if(@$user->title == "Mrs"){ echo 'selected = "yes"'; } ?> value="Mrs">Mrs</option>
            <option <?php if(@$user->title == "Miss"){ echo 'selected = "yes"'; } ?> value="Miss">Miss</option>
            <option <?php if(@$user->title == "Master"){ echo 'selected = "yes"'; } ?> value="Master">Master</option>
            </select>
          </div>
          <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" value="<?php echo @$user->firstname; ?>" />
          </div>
          <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" value="<?php echo @$user->lastname; ?>" />
          </div>
          <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control" id="gender">
            <option <?php if(@$user->gender == "Male"){ echo 'selected = "yes"'; } ?> value="Male">Male</option>
            <option <?php if(@$user->gender == "Female"){ echo 'selected = "yes"'; } ?> value="Female">Female</option>
            </select>
          </div>
          <div class="form-group">
            <label for="dateofbirth">Date of Birth</label>
            <input type="date" class="form-control" name="dateofbirth" id="dateofbirth" placeholder="mm/dd/yyyy" value="<?php echo @$user->dateofbirth; ?>" />
          </div>
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="name@email.com" value="<?php echo @$user->email; ?>" />
          </div>
          <div class="form-group">
            <label for="homeaddress">Home Address</label>
            <textarea class="form-control" name="homeaddress" id="homeaddress" placeholder="Home Address"><?php echo @$user->homeaddress; ?></textarea>
          </div>
          <div class="form-group">
            <label for="telephonenumber">Telephone Number</label>
            <input type="text" class="form-control" name="telephonenumber" id="telephonenumber" placeholder="07087654321" value="<?php echo @$user->telephonenumber; ?>" />
          </div>
          <div class="form-group">
            <label for="alternativecontactnumber">Alternative Contact Number</label>
            <input type="text" class="form-control" name="alternativecontactnumber" id="alternativecontactnumber" value="<?php echo @$user->alternativecontactnumber; ?>" placeholder="08012345678" class="required number"  />
          </div>
          <div class="form-group">
            <label for="employmenttype">Employment Type</label>
            <select name="employmenttype" class="form-control" id="employmenttype">
            <option <?php if(@$user->employmenttype == "Self-Employed"){ echo 'selected = "yes"'; } ?> value="Self-Employed">Self-Employed</option>
            <option <?php if(@$user->employmenttype == "Unemployed"){ echo 'selected = "yes"'; } ?> value="Unemployed">Unemployed</option>
            <option <?php if(@$user->employmenttype == "Salary Employee"){ echo 'selected = "yes"'; } ?> value="Salary Employee">Salary Employee</option>
            </select>
          </div>
          <div class="form-group">
            <label for="nameofemployer">Name of Employer/Business</label>
            <input type="text" class="form-control" name="nameofemployer" id="nameofemployer" value="<?php echo @$user->nameofemployer; ?>" placeholder="Name of Employer/Business" autocomplete="off" />
          </div>
          <div class="form-group">
            <label for="officeaddress">Office/Business Address</label>
            <textarea class="form-control" name="officeaddress" id="officeaddress" placeholder="Office/Business Address"><?php echo @$user->officeaddress; ?></textarea>
          </div>
          <div class="form-group">
            <label for="monthlyincome">Monthly Income</label>
            <select name="monthlyincome" class="form-control" id="monthlyincome">
            <option <?php if(@$user->monthlyincome == "10000 - 59999"){ echo 'selected = "yes"'; } ?>  value="10000 - 50000">10000 - 59999</option>
            <option <?php if(@$user->monthlyincome == "60000 - 100000"){ echo 'selected = "yes"'; } ?> value="60000 - 100000">60000 - 99999</option>
            <option <?php if(@$user->monthlyincome == "100000 - 999999"){ echo 'selected = "yes"'; } ?> value="100000 - 999999">100000 - 999999</option>
            <option <?php if(@$user->monthlyincome == "1000000 and Above"){ echo 'selected = "yes"'; } ?> value="1000000 and Above">1000000 and Above</option>
            </select>
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
            <h4 class="modal-title" id="AddUserLabel">Add User</h4>
          </div>
          <div class="modal-body">
          
          <form role="form" action="<?php echo base_url('users/adduser'); ?>" method="post" >
          
          <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" />
          </div>
          <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" />
          </div>
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="name@email.com" />
          </div>
          <div class="form-group">
            <label for="homeaddress">Home Address</label>
            <textarea class="form-control" name="homeaddress" id="homeaddress" placeholder="Home Address"></textarea>
          </div>
          <div class="form-group">
            <label for="telephonenumber">Telephone Number</label>
            <input type="text" class="form-control" name="telephonenumber" id="telephonenumber" placeholder="07087654321" />
          </div>
            
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Add User</button></form>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <!-- Import Users From CSV -->
    <div class="modal fade" id="ImportUsers" tabindex="-1" role="dialog" aria-labelledby="ImportUsersLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="ImportUsersLabel">Import Users from a CSV File</h4>
          </div>
          <div class="modal-body">
          <span class="text-info">Note: The CSV must contain fullname of the user in the first column (first name and last name separated by space) and the users email in the second column </span>
          <?php echo form_open_multipart('users/importusers');?>

            <input type="file" name="userfile" />

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Import Users</button></form>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->