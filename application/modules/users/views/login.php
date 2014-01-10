    <?php $this->load->module('template'); ?>
<div class="container">
<div class="register-page">

<div class="row-fluid">
                       
                        <div class="span4 offset8 homes">
                        <div class="hhead">
                        <h1 class="header">Supply </h1>
                        <h1 class="header">made easy</h1>
                        </div>
                        <p class="headerp">We deliver your supplies to you at great price.<br />Click below to download registration form,<br />Fill the form and get started.</p>
                                                
                        <a href="<?php echo base_url('users/downloadform') ?>" target="_blank" class="btn btn-primary btn-large btn-block homebtn">Download Registration Form</a>
                        <button class="btn btn-primary btn-large btn-block homebtn" data-target="#myModal" data-toggle="modal" role="button">Get Started</button>
                        
                        </div> 
                        <!-- Register -->
                        <!-- Modal -->
                        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 id="myModalLabel">Get Started</h3>
                          </div>
                          <div class="modal-body">
                            <form class="form-horizontal" name="register" enctype="multipart/form-data" method="post" action="<?php echo base_url('users/adduser') ?>">
                                        
                                        <fieldset title="Upload Form">
                                            <legend class="hide">Upload Completed Form</legend>
                                            <div class="formSep control-group">
                                                <label for="userfile" class="control-label"><span><i class="icon-upload"></i> Select Scanned Form:</span></label>
                                                <div class="controls">
                                                    <input type="file" name="userfile" id="userfile" class="required" />
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset title="Personal info">
                                            <legend class="hide">Fill personal details</legend>
                                            <p class="warning">By filling in the form below and clicking the "Register" button, you accept and agree to <a href="#TM" data-toggle="modal">Terms of Service</a>.</p>
                                            <div class="formSep control-group">
                                                <label for="firstname" class="control-label">First Name:</label>
                                                <div class="controls">
                                                    <input type="text" name="firstname" id="firstname" class="required" value="<?php echo @$firstname; ?>" />
                                                </div>
                                            </div>
                                            <div class="formSep control-group">
                                                <label for="lastname" class="control-label">Last Name:</label>
                                                <div class="controls">
                                                    <input type="text" name="lastname" id="lastname" class="required" value="<?php echo @$lastname; ?>" />
                                                </div>
                                            </div>
                                            <div class="formSep control-group">
                                                <label for="companyname" class="control-label">Company Name:</label>
                                                <div class="controls">
                                                    <input type="text" name="companyname" id="companyname" class="required" value="<?php echo @$firstname; ?>" />
                                                </div>
                                            </div>
                                            <div class="formSep control-group">
                                                <label for="noresturants" class="control-label">Number of Restaurant Locations:</label>
                                                <div class="controls">
                                                    <input type="text" name="noresturants" id="noresturants" class="required" value="<?php echo @$firstname; ?>" />
                                                </div>
                                            </div>
                                            <div class="formSep control-group">
                                                <label for="email" class="control-label">Email:</label>
                                                <div class="controls">
                                                    <input type="email" name="email" id="email" class="required email" value="<?php echo @$email; ?>" />
                                                    <p class="muted">The e-mail address is not made public and will only be used if you wish to receive a new password.</p>
                                                </div>
                                            </div>
                                            <div class="formSep control-group">
                                                <label for="phonenumber" class="control-label">Phone Number:</label>
                                                <div class="controls">
                                                    <input type="text" name="phonenumber" id="phonenumber" class="required number" value="<?php echo @$phonenumber; ?>" />
                                                </div>
                                            </div>
                                            <div class="formSep control-group">
                                                <label for="username" class="control-label">Choose Your Username:</label>
                                                <div class="controls">
                                                    <input type="text" name="username" id="username" class="required" value="<?php echo @$username; ?>" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="password" class="control-label">Password:</label>
                                                <div class="controls">
                                                    <input type="password" name="password" id="password" class="required" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label for="cpassword" class="control-label">Confirm Password:</label>
                                                <div class="controls">
                                                    <input type="password" name="cpassword" id="cpassword" class="required" />
                                                </div>
                                            </div>
                                        </fieldset>
                                        
                                   
                          </div>
                          <div class="modal-footer">
                          <p class="text-info">You will get an email when your account is approved.</p>
                            <button type="submit" class="finish btn btn-primary"><i class="icon-ok icon-white"></i> Get Started</button>
                            
                          </div> 
                          </form>
                          <script>
                            $(document).ready(function(){
                              $('form#validate_wizard').validate({
                                rules : {
                                    password : {
                                        required: true,
                                        minlength : 6
                                    },
                                    cpassword : {
                                        required: true,
                                        minlength : 6,
                                        equalTo : "#password"
                                    }
                                }
                                }
                                );  
                            });
                            
                            </script>
                        </div>
                        <!-- Login -->
                        <div id="myLogin" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myLoginLabel" aria-hidden="true">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 id="myLoginLabel">Log In</h3>
                          </div>
                          <div class="modal-body">
                            <p class="muted">Please, Enter Your Username and Password to Proceed to Your Dashboard</p>
                        <form class="form-horizontal" method="post" name="login" action="<?php echo base_url('users/login') ?>">
                          <div class="control-group">
                            <label class="controls-label" for="inputUsername">Username</label>
                            <div class="control">
                              <input type="text" id="inputUsername" placeholder="Username" name="username" class="input-block-level" />
                            </div>
                          </div>
                          <div class="control-group">
                            <label class="controls-label" for="inputPassword">Password</label>
                            <div class="control">
                              <input type="password" id="inputPassword" placeholder="Password" name="password" class="input-block-level" />
                            </div>
                          </div>
                          
                        
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Log In</button>
                          </div>
                          </form>
                        </div>
                                                
                    </div>
                    <div id="TM" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="TMLabel" aria-hidden="true">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 id="TMLabel">Terms and Conditions</h3>
                      </div>
                      <div class="modal-body">
                        <p>Nulla sollicitudin pulvinar enim, vitae mattis velit venenatis vel. Nullam dapibus est quis lacus tristique consectetur. Morbi posuere vestibulum neque, quis dictum odio facilisis placerat. Sed vel diam ultricies tortor egestas vulputate. Aliquam lobortis felis at ligula elementum volutpat. Ut accumsan sollicitudin neque vitae bibendum. Suspendisse id ullamcorper tellus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum at augue lorem, at sagittis dolor. Curabitur lobortis justo ut urna gravida scelerisque. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam vitae ligula elit. Pellentesque tincidunt mollis erat ac iaculis. Morbi odio quam, suscipit at sagittis eget, commodo ut justo. Vestibulum auctor nibh id diam placerat dapibus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse vel nunc sed tellus rhoncus consectetur nec quis nunc. Donec ultricies aliquam turpis in rhoncus. Maecenas convallis lorem ut nisl posuere tristique. Suspendisse auctor nibh in velit hendrerit rhoncus. Fusce at libero velit. Integer eleifend sem a orci blandit id condimentum ipsum vehicula. Quisque vehicula erat non diam pellentesque sed volutpat purus congue. Duis feugiat, nisl in scelerisque congue, odio ipsum cursus erat, sit amet blandit risus enim quis ante. Pellentesque sollicitudin consectetur risus, sed rutrum ipsum vulputate id. Sed sed blandit sem. Integer eleifend pretium metus, id mattis lorem tincidunt vitae. Donec aliquam lorem eu odio facilisis eu tempus augue volutpat.</p>
                      </div>
                      <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                      </div>
                    </div>
</div>

</div>