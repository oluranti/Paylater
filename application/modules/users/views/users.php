<?php $this->load->module('admintemplate'); ?>
<?php $this->load->module('users'); ?>
<?php $this->load->module('companies'); ?>
<link href="<?php echo $this->template->get_asset(); ?>/js/datepicker/lib/themes/default.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $this->template->get_asset(); ?>/js/datepicker/lib/themes/default.date.css" rel="stylesheet" type="text/css" />
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
							<a class="btn btn-info" href="#" data-target="#AddUser" data-toggle="modal" title="Add User">
										<i class="icon-plus icon-white"></i>                                           
									</a>
                                    <a class="btn btn-warning" href="#" data-target="#ImportUsers" data-toggle="modal" title="Import Users from CSV">
										<i class="icon-upload icon-white"></i>                                           
									</a>
                                    <a class="btn btn-success" href="<?php echo base_url('users/downloaduserlinks') ?>" title="Download User Links as CSV">
										<i class="icon-download-alt icon-white"></i>                                         
									</a>
                                    <a class="btn btn-inverse" href="<?php echo base_url('users/downloadactiveuserscsv') ?>" title="Download Users Excel Sheet">
										<i class="icon-download icon-white"></i>                                         
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
                                  <th>Email</th>
                                  <th>Unique ID</th>
								  <th>Registration Date &amp; Time</th>
                                  <th>Status</th>
                                  <th><a href="<?php echo base_url('users/viewactiveusers'); ?>" class="btn btn-info btn-block">View Only Registered Users</a>
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
                                <td class="center"><?php echo $user->uniqueid; ?></td>
                                <td class="center"><?php if(!empty($user->date)){echo $this->users->formattime($user->date); } ?></td>
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
<div class="modal-body printthis<?php echo $user->id; ?>">
            <table class="table table-striped">
            <thead><tr><th colspan="4">User Unique ID: <?php echo @$user->uniqueid;  ?></th></tr></thead>
            <tbody>
            <tr>
            <td>Title</td>
            <td><?php echo @$user->title;  ?></td>
            <td>First Name</td>
            <td><?php echo @$user->firstname;  ?></td>
            </tr>
            <tr>
            <td>Last Name</td>
            <td><?php echo @$user->lastname;  ?></td>
            <td>Gender</td>
            <td><?php echo @$user->gender;  ?></td>
            </tr>
            <tr>
            <td>Marital Status</td>
            <td><?php echo @$user->maritalstatus;  ?></td>
            <td>Date of Birth</td>
            <td><?php echo @$user->dateofbirth;  ?></td>
            </tr>
            <tr>
            <td>Email Address</td>
            <td><?php echo @$user->email;  ?></td>
            <td>Home Address</td>
            <td><?php echo @$user->homeaddress; ?></td>
            </tr>
            <tr>
            <td>Residential status</td>
            <td><?php echo @$user->residentialstatus; ?></td>
            <td>How Long Have You Lived Here?</td>
            <td><?php echo @$user->howlonglived; ?></td>
            </tr>
            <tr>
            <td>Telephone Number</td>
            <td><?php echo @$user->telephonenumber; ?></td>
            <td>Alternative Contact Number</td>
            <td><?php echo @$user->alternativecontactnumber; ?></td>
            </tr>
            <tr>
            <td>Employment Type</td>
            <td><?php echo @$user->employmenttype; ?></td>
            <td>Length of Employment</td>
            <td><?php  echo @$user->employmentlength; ?></td>
            </tr>
            <tr>
            <td>Name of Employer/Business</td>
            <td><?php echo @$user->nameofemployer; ?></td>
            <td>Office/Business Address</td>
            <td><?php echo @$user->officeaddress; ?></td>
            </tr>
            <tr>
            <td>Monthly Income</td>
            <td><?php echo @$user->monthlyincome; ?></td>
            <td>Number of Dependants</td>
            <td><?php echo @$user->noofdependants; ?></td>
            </tr>
            <tr>
            <td>What type of account do you use?</td>
            <td><?php echo @$user->bankaccounttype; ?></td>
            <td>Select Your Bank</td>
            <td><?php echo @$user->bank; ?></td>
            </tr>
            <tr>
            <td>Do You Currently Have Loan(s) With Any Other Bank or Financial Institution?</td>
            <td><?php echo @$user->doyouhaveloans; ?></td>
            <td>If Yes Please Input Total Value of Loan(s)</td>
            <td><?php echo @$user->loanvalue; ?></td>
            </tr>
            <tr>
            <td colspan="2">When can we contact you on phone?</td>
            <td colspan="2"><?php echo @$user->contacttime; ?></td>
            
            </tr>
            </tbody>
            </table>
          </div>
          <script>
          $(document).ready(function(){
            $('.printnow<?php echo $user->id; ?>').click(function(e){
                e.preventDefault();
            $('.printthis<?php echo $user->id; ?>').printElement();   
        });
          }
          
          );
          </script>
          <div class="modal-footer">
          <button class="btn btn-primary printnow<?php echo $user->id; ?>">Print</button>
            <button data-dismiss="modal" class="btn">Close</button>
            </div>
</div>

<!-- Edit User -->
<div id="EditUser<?php echo $user->id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="EditUser<?php echo $user->id; ?>Label" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 id="EditUser<?php echo $user->id; ?>Label">Edit User</h3>
  </div>
<div class="modal-body">
          
          <form role="form" action="<?php echo base_url('users/updateuser'); ?>" method="post" id="edituser">
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
            <label for="maritalstatus">Marital Status</label>
            <select name="maritalstatus" class="form-control" id="maritalstatus">
            	<option <?php if(@$user->maritalstatus == "Married"){ echo 'selected = "yes"'; } ?> value="Married">Married</option>
            	<option <?php if(@$user->maritalstatus == "Single"){ echo 'selected = "yes"'; } ?> value="Single">Single</option>
            	<option <?php if(@$user->maritalstatus == "Divorced"){ echo 'selected = "yes"'; } ?> value="Divorced">Divorced</option>
            	<option <?php if(@$user->maritalstatus == "Widowed"){ echo 'selected = "yes"'; } ?> value="Widowed">Widowed</option>
            	<option <?php if(@$user->maritalstatus == "Separated"){ echo 'selected = "yes"'; } ?> value="Separated">Separated</option>
            </select>
          </div>
          <div class="form-group">
            <label for="dateofbirth">Date of Birth</label>
            <input type="text" class="form-control" name="dateofbirth" id="dateofbirth" placeholder="Date of Birth" value="<?php echo @$user->dateofbirth; ?>" />
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
            <label for="residentialstatus">Residential status</label>
            <select name="residentialstatus" class="form-control" id="residentialstatus">
            <option <?php if(@$user->residentialstatus == "House Owner"){ echo 'selected = "yes"'; } ?> value="House Owner">House Owner</option>
            <option <?php if(@$user->residentialstatus == "Rented"){ echo 'selected = "yes"'; } ?> value="Rented">Rented</option>
            <option <?php if(@$user->residentialstatus == "Family House"){ echo 'selected = "yes"'; } ?> value="Family House">Family House</option>
            <option <?php if(@$user->residentialstatus == "Living With Friend(s)"){ echo 'selected = "yes"'; } ?> value="Living With Friend(s)">Living With Friend(s)</option>
            <option <?php if(@$user->residentialstatus == "Temporary Accommodation"){ echo 'selected = "yes"'; } ?> value="Temporary Accommodation">Temporary Accommodation</option>
            </select>
          </div>
          <div class="form-group">
            <label for="howlonglived">How Long Have You Lived Here?</label>
            <select name="howlonglived" class="form-control" id="howlonglived">
            <option <?php if(@$user->howlonglived == "Less Than 1 Year"){ echo 'selected = "yes"'; } ?> value="Less Than 1 Year">Less Than 1 Year</option>
            <option <?php if(@$user->howlonglived == "1 - 3 Years"){ echo 'selected = "yes"'; } ?> value="1 - 3 Years">1 - 3 Years</option>
            <option <?php if(@$user->howlonglived == "3 - 5 Years"){ echo 'selected = "yes"'; } ?> value="3 - 5 Years">3 - 5 Years</option>
            <option <?php if(@$user->howlonglived == "More Than 5 Years"){ echo 'selected = "yes"'; } ?> value="More Than 5 Years">More Than 5 Years</option>
            </select>
          </div>
          <div class="form-group">
            <label for="telephonenumber">Telephone Number</label>
            <input type="text" class="form-control" name="telephonenumber" id="telephonenumber" placeholder="07087654321" value="<?php echo @$user->telephonenumber; ?>" />
          </div>
          <div class="form-group">
            <label for="alternativecontactnumber">Alternative Contact Number</label>
            <input type="text" class="form-control" name="alternativecontactnumber" id="alternativecontactnumber" value="<?php echo @$user->alternativecontactnumber; ?>" placeholder="08012345678" class=" number"  />
          </div>
          <div class="form-group">
            <label for="employmenttype">Employment Type</label>
            <select name="employmenttype" class="form-control" id="employmenttype">
            <option <?php if(@$user->employmenttype == "Self-Employed"){ echo 'selected = "yes"'; } ?> value="Self-Employed">Self-Employed</option>
            <option <?php if(@$user->employmenttype == "Salary Employee"){ echo 'selected = "yes"'; } ?> value="Salary Employee">Salary Employee</option>
            <option <?php if(@$user->employmenttype == "Student"){ echo 'selected = "yes"'; } ?> value="Student">Student</option>
            <option <?php if(@$user->employmenttype == "Unemployed"){ echo 'selected = "yes"'; } ?> value="Unemployed">Unemployed</option>
            
            </select>
          </div>
          <div class="form-group">
            <label for="employmentlength">Length of Employment</label>
            <select name="employmentlength" class="form-control" id="employmentlength">
            <option <?php if(@$user->employmentlength == "Less Than 1 Year"){ echo 'selected = "yes"'; } ?> value="Less Than 1 Year">Less Than 1 Year</option>
            <option <?php if(@$user->employmentlength == "1 - 2 Years"){ echo 'selected = "yes"'; } ?> value="1 - 2 Years">1 - 2 Years</option>
            <option <?php if(@$user->employmentlength == "2 - 5 Years"){ echo 'selected = "yes"'; } ?> value="2 - 5 Years">2 - 5 Years</option>
            <option <?php if(@$user->employmentlength == "More Than 5 Years"){ echo 'selected = "yes"'; } ?> value="More Than 5 Years">More Than 5 Years</option>
            </select>
          </div>
          <div class="form-group">
            <label for="nameofemployer">Name of Employer/Business</label>
            <?php 
            $rawcompanies = $this->companies->read(); 
            $foo = 0;
            $comma = ",";
            ?>
            <input type="text" class="form-control" name="nameofemployer" value="<?php echo @$user->nameofemployer; ?>" id="nameofemployer" placeholder="Name of Employer/Business"  data-provide="typeahead" data-source="[<?php foreach($rawcompanies->result() as $company){ $foo++; if($foo > 1){ echo $comma; }?>&quot;<?php echo $company->company; ?>&quot;<?php } ?>]"  />
          </div>
          <div class="form-group">
            <label for="officeaddress">Office/Business Address</label>
            <textarea class="form-control" name="officeaddress" id="officeaddress" placeholder="Office/Business Address"><?php echo @$user->officeaddress; ?></textarea>
          </div>
          <div class="form-group">
            <label for="monthlyincome">Monthly Income</label>
            <input type="text" class="form-control" name="monthlyincome" id="monthlyincome" value="<?php echo @$user->monthlyincome; ?>" placeholder="Monthly Income" autocomplete="off"  />

          </div>
          <div class="form-group">
            <label for="noofdependants">Number of Dependants</label>
            <select name="noofdependants" class="form-control" id="noofdependants">
            <option <?php if(@$user->noofdependants == 0){ echo 'selected = "yes"'; } ?> value="0">0</option>
            <option <?php if(@$user->noofdependants == 1){ echo 'selected = "yes"'; } ?> value="1">1</option>
            <option <?php if(@$user->noofdependants == 2){ echo 'selected = "yes"'; } ?> value="2">2</option>
            <option <?php if(@$user->noofdependants == 3){ echo 'selected = "yes"'; } ?> value="3">3</option>
            <option <?php if(@$user->noofdependants == 4){ echo 'selected = "yes"'; } ?> value="4">4</option>
            <option <?php if(@$user->noofdependants == 5){ echo 'selected = "yes"'; } ?> value="5">5</option>
            <option <?php if(@$user->noofdependants == 6){ echo 'selected = "yes"'; } ?> value="6">6</option>
            <option <?php if(@$user->noofdependants == 7){ echo 'selected = "yes"'; } ?> value="7">7</option>
            <option <?php if(@$user->noofdependants == 8){ echo 'selected = "yes"'; } ?> value="8">8</option>
            <option <?php if(@$user->noofdependants == 9){ echo 'selected = "yes"'; } ?> value="9">9</option>
            <option <?php if(@$user->noofdependants == 10){ echo 'selected = "yes"'; } ?> value="10">10</option>
            <option <?php if(@$user->noofdependants == "More Than 10"){ echo 'selected = "yes"'; } ?> value="More Than 10">More Than 10</option>
            </select>
          </div>
          <div class="form-group">
            <label for="bankaccounttype">What type of account do you use?</label>
            <select name="bankaccounttype" class="form-control" id="bankaccounttype"  >
            <option <?php if(@$user->bankaccounttype == "Current"){ echo 'selected = "yes"'; } ?> value="Current">Current</option>
            <option <?php if(@$user->bankaccounttype == "Savings"){ echo 'selected = "yes"'; } ?> value="Savings">Savings</option>
            <option <?php if(@$user->bankaccounttype == "None"){ echo 'selected = "yes"'; } ?> value="None">None</option>
            </select> 
          </div>
          <div class="form-group">
            <label for="bank">Select Your Bank</label>
            <select name="bank" class="form-control" id="bank">
            <option <?php if(@$user->bank == "Access Bank"){ echo 'selected = "yes"'; } ?> value="Access Bank">Access Bank</option>
            <option <?php if(@$user->bank == "Citibank"){ echo 'selected = "yes"'; } ?> value="Citibank">Citibank</option>
            <option <?php if(@$user->bank == "Diamond Bank"){ echo 'selected = "yes"'; } ?> value="Diamond Bank">Diamond Bank</option>
            <option <?php if(@$user->bank == "Ecobank Nigeria"){ echo 'selected = "yes"'; } ?> value="Ecobank Nigeria">Ecobank Nigeria</option>
            <option <?php if(@$user->bank == "Enterprise Bank Limited"){ echo 'selected = "yes"'; } ?> value="Enterprise Bank Limited">Enterprise Bank Limited</option>
            <option <?php if(@$user->bank == "Fidelity Bank Nigeria"){ echo 'selected = "yes"'; } ?> value="Fidelity Bank Nigeria">Fidelity Bank Nigeria</option>
            <option <?php if(@$user->bank == "First Bank of Nigeria"){ echo 'selected = "yes"'; } ?> value="First Bank of Nigeria">First Bank of Nigeria</option>
            <option <?php if(@$user->bank == "First City Monument Bank"){ echo 'selected = "yes"'; } ?> value="First City Monument Bank">First City Monument Bank</option>
            <option <?php if(@$user->bank == "Guaranty Trust Bank"){ echo 'selected = "yes"'; } ?> value="Guaranty Trust Bank">Guaranty Trust Bank</option>
            <option <?php if(@$user->bank == "Heritage Bank Plc"){ echo 'selected = "yes"'; } ?> value="Heritage Bank Plc">Heritage Bank Plc</option>
            <option <?php if(@$user->bank == "Jaiz Bank Plc"){ echo 'selected = "yes"'; } ?> value="Jaiz Bank Plc">Jaiz Bank Plc</option>
            <option <?php if(@$user->bank == "Keystone Bank Limited"){ echo 'selected = "yes"'; } ?> value="Keystone Bank Limited">Keystone Bank Limited</option>
            <option <?php if(@$user->bank == "Mainstreet Bank Limited"){ echo 'selected = "yes"'; } ?> value="Mainstreet Bank Limited">Mainstreet Bank Limited</option>
            <option <?php if(@$user->bank == "Savannah Bank"){ echo 'selected = "yes"'; } ?> value="Savannah Bank">Savannah Bank</option>
            <option <?php if(@$user->bank == "Skye Bank"){ echo 'selected = "yes"'; } ?> value="Skye Bank">Skye Bank</option>
            <option <?php if(@$user->bank == "Stanbic IBTC Bank Nigeria Limited"){ echo 'selected = "yes"'; } ?> value="Stanbic IBTC Bank Nigeria Limited">Stanbic IBTC Bank Nigeria Limited</option>
            <option <?php if(@$user->bank == "Standard Chartered Bank"){ echo 'selected = "yes"'; } ?> value="Standard Chartered Bank">Standard Chartered Bank</option>
            <option <?php if(@$user->bank == "Sterling Bank"){ echo 'selected = "yes"'; } ?> value="Sterling Bank">Sterling Bank</option>
            <option <?php if(@$user->bank == "Union Bank of Nigeria"){ echo 'selected = "yes"'; } ?> value="Union Bank of Nigeria">Union Bank of Nigeria</option>
            <option <?php if(@$user->bank == "United Bank for Africa"){ echo 'selected = "yes"'; } ?> value="United Bank for Africa">United Bank for Africa</option>
            <option <?php if(@$user->bank == "Unity Bank Plc"){ echo 'selected = "yes"'; } ?> value="Unity Bank Plc">Unity Bank Plc</option>
            <option <?php if(@$user->bank == "Wema Bank"){ echo 'selected = "yes"'; } ?> value="Wema Bank">Wema Bank</option>
            <option <?php if(@$user->bank == "Zenith Bank"){ echo 'selected = "yes"'; } ?> value="Zenith Bank">Zenith Bank</option>
            </select> 
          </div>
          <div class="form-group">
            <label for="doyouhaveloans">Do You Currently Have Loan(s) With Any Other Bank or Financial Institution?</label>
            <select name="doyouhaveloans" class="form-control" id="doyouhaveloans">
            <option <?php if(@$user->doyouhaveloans == "Yes"){ echo 'selected = "yes"'; } ?> value="Yes">Yes</option>
            <option <?php if(@$user->doyouhaveloans == "No"){ echo 'selected = "yes"'; } ?> value="No">No</option>
            </select> 
          </div>
          <div class="form-group">
            <label for="loanvalue">If Yes Please Input Total Value of Loan(s)</label>
            <input type="text" class="form-control" name="loanvalue" value="<?php echo @$user->loanvalue; ?>" id="loanvalue" placeholder="Please Input Total Value of Loan(s)" autocomplete="off" /> 
          </div>
          <div class="form-group">
            <label for="contacttime">When can we contact you on phone?</label>
            <select name="contacttime" class="form-control" id="contacttime" >
            <option value="">Select...</option>
            <option <?php if(@$user->contacttime == "Weekdays 9 am - 12 noon"){ echo 'selected = "yes"'; } ?> value="Weekdays 9 am - 12 noon">Weekdays 9 am - 12 noon</option>
            <option <?php if(@$user->contacttime == "Weekdays 12 noon - 3 pm"){ echo 'selected = "yes"'; } ?> value="Weekdays 12 noon - 3 pm">Weekdays 12 noon - 3 pm</option>
            <option <?php if(@$user->contacttime == "Weekdays 3 pm - 6 pm"){ echo 'selected = "yes"'; } ?> value="Weekdays 3 pm - 6 pm">Weekdays 3 pm - 6 pm</option>
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
    <script>
$(document).ready(function(){
    
    /*$('#edituser').validate({ 
        rules: { 
            telephonenumber: { 
                required: true, 
                number: true, 
                maxlength: 11,
                minlength: 11
                },
            monthlyincome: { 
                required: true, 
                number: true
                },
            loanvalue: {
                number: true
                },
            alternativecontactnumber: { 
                required: true, 
                number: true, 
                maxlength: 11,
                minlength: 11
                }, 
                agree: { 
                    required: true 
                    } 
                    } 
                    });*/
    
  $('#edituser #dateofbirth').pickadate({
    today: '',
    clear: 'Clear selection',
     selectYears: 100,
     selectMonths: true
});
  
}

);
</script>
<script src="<?php echo $this->template->get_asset(); ?>/js/jquery.printElement.js"></script>
<script src="<?php echo $this->template->get_asset(); ?>/js/datepicker/lib/picker.js"></script>
<script src="<?php echo $this->template->get_asset(); ?>/js/datepicker/lib/picker.date.js"></script>
<script src="<?php echo $this->template->get_asset(); ?>/js/datepicker/lib/legacy.js"></script>