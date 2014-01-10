<?php $this->load->module('template'); ?>
<div class="users">
<h1 class="heading">Users</h1>
<table class="table table-hover">
<thead>
<tr>
<th>#</th>
<th>First Name</th>
<th>Last Name</th>
<th>Company Name</th>
<th>Number of Restaurant Locations</th>
<th>Username</th>
<th>Email</th>
<th>Phone Number</th>
<th>User Type</th>
<th><button class="btn btn-inverse" class="btn" data-target="#AddUser" data-toggle="modal" title="Add New User"><i class=" icon-plus-sign icon-white"></i></button></th>
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
<tr style="text-transform: capitalize;">
<td><?php echo $c; ?></td>
<td><?php echo $user->firstname; ?></td>
<td><?php echo $user->lastname; ?></td>
<td><?php echo $user->companyname; ?></td>
<td><?php echo $user->noresturants; ?></td>
<td style="text-transform: lowercase;"><?php echo $user->username; ?></td>
<td style="text-transform: lowercase;"><?php echo $user->email; ?></td>
<td><?php echo $user->phonenumber; ?></td>
<td><?php echo $user->usertype; ?></td>
<td>
<?php if($user->usertype != "administrator"){ ?><a href="<?php echo base_url('users/downloaduserform/'.$user->username) ?>" target="_blank" class="btn" title="Download Form"><i class="icon-download"></i></a> <?php } ?>
<?php if($user->usertype != "administrator"){ ?><a href="<?php echo $user->userform; ?>" class="btn" target="_blank" title="View Form"><i class="icon-search"></i></a> <?php } ?>
<?php if($user->usertype != "administrator" && $user->usertype == "inactive"){ ?><a href="#" data-target="#ApproveUser<?php echo $user->id; ?>" data-toggle="modal" class="btn btn-success" title="Approve User"><i class="icon-ok"></i></a> <?php } ?>
<!--<button class="btn btn-success" class="btn" data-target="#User<?php echo $user->id; ?>" data-toggle="modal"><i class="icon-search"></i> View User</button>-->
<button class="btn btn-warning" data-target="#EditUser<?php echo $user->id; ?>" data-toggle="modal" title="Edit User"><i class="icon-edit"></i></button>
<a href="<?php echo base_url('users/deleteuser') ?>/<?php echo $user->id; ?>" class="btn btn-danger" title="Delete User"><i class="icon-trash"></i></a></td>
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
<div class="pagination pagination-right"><?php if(isset($pagenavi)){ echo $pagenavi; } ?></div>
<?php 
foreach($users->result() as $user){
 ?>
<!-- Approve User -->
<div id="ApproveUser<?php echo $user->id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="ApproveUser<?php echo $user->id; ?>Label" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 id="ApproveUser<?php echo $user->id; ?>Label">Approve <?php echo $user->companyname; ?> </h3>
  </div>
  <div class="modal-body">
  <p class="text-info"><span class="label label-info">Create a spreadsheet on Google Drive for this user and paste the link to the spreadsheet below.</span></p>
    <form method="post" name="adduser" enctype="multipart" action="<?php echo base_url('users/approveuser') ?>">
    
    
    <div class="control-group">
        <label class="control-label" for="name">Spreadsheet Name</label>
        <div class="controls"><input type="text" name="name" class="span5" /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="link">Spreadsheet Link</label>
        <div class="controls"><input type="text" name="link" class="span5" /></div>
    </div>

    <input type="hidden" name="userid" value="<?php echo $user->id; ?>" />
  </div>
  <div class="modal-footer">
 <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Approve</button>
  </div></form>
</div>

<!-- Edit User -->
<div id="EditUser<?php echo $user->id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="EditUser<?php echo $user->id; ?>Label" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 id="EditUser<?php echo $user->id; ?>Label">Edit User</h3>
  </div>
  <div class="modal-body">
   <!-- <form method="post" name="adduser" enctype="multipart" action="<?php echo base_url('users/updateuser'); ?>"> -->
    <?php echo form_open_multipart('users/updateuser');?>
    <!--<div class="control-group">
        <label class="control-label" for="avi">Upload Avatar</label>
        <div class="controls"><input type="file" name="userfile" /></div>
    </div>-->
    
    <div class="control-group">
        <label class="control-label" for="firstname">First Name</label>
        <div class="controls"><input type="text" name="firstname" value="<?php echo $user->firstname; ?>" class="span5" /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="lastname">Last Name</label>
        <div class="controls"><input type="text" name="lastname" value="<?php echo $user->lastname; ?>" class="span5" /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="companyname">Company Name</label>
        <div class="controls"><input type="text" name="companyname" value="<?php echo $user->companyname; ?>" class="span5" /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="noresturants">Number of Restaurant Locations</label>
        <div class="controls"><input type="text" name="noresturants" value="<?php echo $user->noresturants; ?>" class="span5" /></div>
    </div>
    
    
    <div class="control-group">
        <label class="control-label" for="username">Username</label>
        <div class="controls"><input type="text" name="username" value="<?php echo $user->username; ?>" class="span5" /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="email">E-mail</label>
        <div class="controls"><input type="text" name="email" value="<?php echo $user->email; ?>" class="span5" /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="phonenumber">Phone Number</label>
        <div class="controls"><input type="text" name="phonenumber" value="<?php echo $user->phonenumber; ?>" class="span5" /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="password">Password</label>
        <div class="controls addpassword"><button type="button" class="btn btn-inverse showpassword"><i class="icon-pencil icon-white"></i> Change Password</button></div>
    </div>
    <div class="control-group">
        <label class="control-label" for="usertype">User Type</label>
        <div class="controls">
        <select name="usertype">
        <option value="administrator">Make Administrator</option>
        <option value="regular">Approved Reqular User</option>
        <option value="inactive">Disapprove User</option>
        </select>
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $user->id; ?>" />

    
  </div>
  <div class="modal-footer">
 <button type="submit" class="btn btn-success"><i class="icon-edit"></i> Update</button>
  </div></form>
</div>
<script>
$(document).ready(function(){
    $('.showpassword').click(function(e){
        e.preventDefault();
        $(this).parents('.addpassword').html('<input type="password" name="password" value="<?php echo $user->password; ?>" class="span5 addpasswordfield" />');
    });
});
</script>
<?php } ?>
<!-- Add User -->
<div id="AddUser" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="AddUserLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 id="AddUserLabel">Add User</h3>
  </div>
  <div class="modal-body">
   <!-- <form method="post" name="adduser" enctype="multipart" action="<?php echo base_url('users/adduser'); ?>"> -->
    <?php echo form_open_multipart('users/adduser');?>
    <div class="control-group">
        <label class="control-label" for="userfile">Upload User Form</label>
        <div class="controls"><input type="file" name="userfile" /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="firstname">First Name</label>
        <div class="controls"><input type="text" name="firstname" class="span5" /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="lastname">Last Name</label>
        <div class="controls"><input type="text" name="lastname" class="span5" /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="companyname">Company Name</label>
        <div class="controls"><input type="text" name="companyname" class="span5" /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="noresturants">Number of Restaurant Locations</label>
        <div class="controls"><input type="text" name="noresturants" class="span5" /></div>
    </div>
    <div class="control-group">
        <label class="control-label" for="username">Username</label>
        <div class="controls"><input type="text" name="username" class="span5" /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="email">E-mail</label>
        <div class="controls"><input type="text" name="email" class="span5" /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="phonenumber">Phone Number</label>
        <div class="controls"><input type="text" name="phonenumber" class="span5" /></div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="password">Password</label>
        <div class="controls"><input type="password" name="password" class="span5" /></div>
    </div>
    <div class="control-group">
        <label class="control-label" for="usertype">User Type</label>
        <div class="controls">
        <select name="usertype">
        <option value="administrator">Make Administrator</option>
        <option value="regular">Approved Regular User</option>
        </select>
        </div>
    </div>

    
  </div>
  <div class="modal-footer">
 <button type="submit" class="btn btn-success"><i class="icon-plus"></i> Add</button>
  </div></form>
</div>
</div>