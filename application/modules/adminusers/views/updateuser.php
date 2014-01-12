    <?php $this->load->module('template'); ?>
    <section>
        <button type="button" class="btn btn-warning btn-lg register" data-toggle="modal" data-target="#myModal">CLICK HERE TO REGISTER</button>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Get Started</h4>
          </div>
          <div class="modal-body">
          
          <form role="form" id="formregister">
          <div class="form-group">
            <label for="title">Title</label>
            <select name="title" class="form-control" id="title">
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Miss">Miss</option>
            <option value="Master">Master</option>
            </select>
          </div>
          <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" />
          </div>
          <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" />
          </div>
          <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control" id="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            </select>
          </div>
          <div class="form-group">
            <label for="dateofbirth">Date of Birth</label>
            <input type="date" class="form-control" name="dateofbirth" id="dateofbirth" placeholder="mm/dd/yyyy" />
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
          <div class="form-group">
            <label for="alternativecontactnumber">Alternative Contact Number</label>
            <input type="text" class="form-control" name="alternativecontactnumber" id="alternativecontactnumber" placeholder="08012345678" class="required number"  />
          </div>
          <div class="form-group">
            <label for="employmenttype">Employment Type</label>
            <select name="employmenttype" class="form-control" id="employmenttype">
            <option value="Self-Employed">Self-Employed</option>
            <option value="Unemployed">Unemployed</option>
            <option value="Salary Employee">Salary Employee</option>
            </select>
          </div>
          <div class="form-group">
            <label for="nameofemployer">Name of Employer/Business</label>
            <input type="text" class="form-control" name="nameofemployer" id="nameofemployer" placeholder="Name of Employer/Business" autocomplete="off" />
          </div>
          <div class="form-group">
            <label for="officeaddress">Office/Business Address</label>
            <textarea class="form-control" name="officeaddress" id="officeaddress" placeholder="Office/Business Address"></textarea>
          </div>
          <div class="form-group">
            <label for="monthlyincome">Monthly Income</label>
            <select name="monthlyincome" class="form-control" id="monthlyincome">
            <option value="10000 - 50000">10000 - 59999</option>
            <option value="60000 - 100000">60000 - 99999</option>
            <option value="100000 - 999999">100000 - 999999</option>
            <option value="1000000 and Above">1000000 and Above</option>
            </select>
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox" value="I Agree" name="agree" id="agree" /> I agree to the <a href="#" data-toggle="modal" data-target="#TC">terms and conditions.</a>
            </label>
          </div>
            
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button></form>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <!-- Modal -->
<div class="modal fade" id="TC" tabindex="-1" role="dialog" aria-labelledby="TCLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="TCLabel">Terms and Conditions</h4>
      </div>
      <div class="modal-body">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in mi et ipsum feugiat consequat. Morbi nisi nisl, rutrum id iaculis vel, iaculis id odio. Nullam quis est vel arcu vulputate pellentesque. Maecenas hendrerit vitae nulla non eleifend. Proin a luctus odio, laoreet tincidunt nisl. Nullam venenatis elit et tellus molestie, sed iaculis tortor interdum. Morbi eu lacus mauris. Quisque non aliquam quam. Nam feugiat nunc vehicula, facilisis enim eget, elementum lectus. Morbi arcu lectus, tempus in consequat sit amet, porttitor at eros. Integer lacinia velit eget varius rhoncus. Nam semper eget nulla in blandit.

Ut bibendum ante quis lorem sagittis ullamcorper. Proin convallis mollis neque, at mollis eros pellentesque posuere. Nam viverra risus eget enim tincidunt semper. Phasellus lacinia, elit et commodo adipiscing, eros felis dapibus sem, ut sollicitudin ligula arcu id ante. Duis pretium pharetra quam vel eleifend. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec id turpis vitae ante convallis blandit. Ut ac dolor vel velit posuere gravida. Donec tellus orci, porttitor id felis quis, lobortis iaculis quam. Quisque euismod congue sem, ac bibendum mi tempus nec. In molestie consectetur nisl, nec iaculis dui convallis et. Fusce id velit ac ipsum varius lobortis id in elit. Aenean sed sollicitudin ante. Aliquam erat volutpat. Nam nec metus neque.

Proin gravida orci in est viverra, id aliquam felis porttitor. Donec non arcu accumsan, dapibus augue vel, tincidunt ligula. Donec posuere ut mi et rutrum. Fusce vulputate nisl quis eros tempor vestibulum. Aenean consequat purus at quam varius, nec porta dolor laoreet. Fusce egestas augue felis. Suspendisse felis dolor, commodo non felis non, scelerisque rutrum enim. Mauris ac arcu ac justo scelerisque posuere nec ac purus. Suspendisse ut enim aliquet, ultrices dolor vel, auctor arcu. Mauris pharetra, massa sed gravida aliquet, tortor sapien convallis dolor, sit amet vehicula lorem magna ut nisl. Quisque non tortor metus. Donec et commodo metus. Praesent augue erat, condimentum a libero at, porta pellentesque metus.

Nunc pretium, enim at suscipit sodales, neque nisi mollis massa, a semper risus odio pulvinar erat. Nam felis magna, congue non viverra in, dapibus et erat. Curabitur sed arcu sit amet elit vulputate pretium ut fermentum leo. Quisque a odio et mi rutrum pretium quis sed tellus. Sed et sapien leo. Aliquam risus orci, sodales vel enim eget, sodales ullamcorper enim. In iaculis ante risus, eu aliquet nisl aliquam sit amet. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed metus tortor, facilisis sed neque nec, facilisis vehicula risus. Phasellus auctor felis mollis felis venenatis pharetra.

Fusce tempor eget tellus vel adipiscing. Nunc ultrices cursus massa. Sed adipiscing malesuada purus, non sodales enim imperdiet ac. Mauris auctor accumsan purus, at malesuada mi congue sed. Nulla facilisi. Donec et rutrum libero. Fusce pellentesque, mauris at rhoncus bibendum, massa nunc sollicitudin neque, vitae fermentum risus sapien id risus. Nam facilisis nunc non diam sollicitudin eleifend. Vestibulum quis turpis pretium, pulvinar magna ut, fermentum urna. Vivamus blandit felis ut leo iaculis, nec aliquet quam blandit. Donec id nulla id nulla dictum tincidunt. Etiam euismod luctus nisl, nec vehicula sem laoreet vulputate. Ut vehicula dolor nec metus condimentum, in cursus felis interdum. Vivamus faucibus egestas turpis vel iaculis. Suspendisse accumsan ante vel mauris ultricies, sollicitudin interdum velit luctus.

Praesent molestie fringilla erat, id commodo libero congue quis. Duis arcu ligula, faucibus in mollis at, gravida varius risus. Ut semper, metus quis aliquam sagittis, tellus sem viverra enim, eget dignissim nunc sapien eleifend felis. Duis non orci non elit rutrum rhoncus. Donec posuere, turpis sit amet lobortis commodo, nulla mi dapibus lacus, ac fermentum tellus libero eu nibh. Praesent sed massa egestas, facilisis lectus ut, venenatis odio. Nulla placerat arcu non posuere porttitor. Nunc placerat urna nec massa tincidunt, id eleifend ligula pretium. Vivamus non massa nec velit mattis tempor in eget odio. In lacinia tellus a metus sollicitudin placerat. Pellentesque consectetur, tortor at gravida tincidunt, leo augue dignissim turpis, non interdum tellus nibh vitae metus. Ut venenatis ante a nisl molestie consectetur.

Praesent eu fermentum leo. Nullam viverra dui eget pharetra aliquam. Cras augue magna, dapibus in tincidunt ut, accumsan id diam. Etiam condimentum consequat dictum. Vivamus vulputate sem et pulvinar venenatis. Integer non odio elit. Ut hendrerit ipsum ac tristique aliquam. Sed nunc mauris, iaculis eget venenatis sit amet, malesuada sit amet nibh. Morbi laoreet lorem nec commodo facilisis. In ultrices justo purus, ut auctor massa vulputate in. Donec consequat leo ac volutpat ultrices.

Quisque vitae sagittis augue. Mauris fermentum sapien ante, quis rutrum metus rutrum non. Sed orci erat, porttitor at augue a, malesuada dignissim tortor. Cras a quam id libero tempor vehicula. Pellentesque id tincidunt mi, in sagittis nisl. Nunc magna purus, condimentum sed dolor a, consectetur aliquam justo. Duis vitae justo felis. Suspendisse quis tempus arcu. In mollis orci id turpis ornare, sed volutpat urna eleifend. In pharetra iaculis facilisis. Donec scelerisque tellus quis vulputate interdum. Curabitur porta lacus a aliquam pharetra. Etiam cursus sit amet nulla sit amet fermentum. Curabitur suscipit pulvinar nulla, ut vehicula lacus rhoncus non.

Maecenas consequat egestas nisi et dictum. Donec sit amet dui metus. Curabitur mollis neque sit amet tortor porta, eu condimentum mauris iaculis. Phasellus nec felis non erat commodo placerat. Fusce ipsum lectus, sollicitudin sed ipsum id, commodo convallis augue. Mauris suscipit iaculis libero, nec porttitor mauris porta et. Mauris fringilla condimentum porta. Nulla facilisi. Cras lectus nibh, tincidunt sed nulla nec, lobortis laoreet purus. Donec eu felis sapien. Maecenas molestie nunc quis tortor sollicitudin, ac venenatis ipsum porta. Proin a diam nisi. Suspendisse ac orci tellus. Praesent venenatis nisi nunc, ac tempor lectus tincidunt in.

Morbi id euismod odio. Nam orci nulla, interdum vel orci in, semper lacinia eros. Pellentesque vel nisl eu nisi venenatis mollis et sit amet risus. Vivamus vel mauris eget nulla scelerisque ornare sed ut leo. Nam et odio sem. Nulla facilisi. Integer imperdiet dapibus tortor sit amet accumsan. Suspendisse fringilla urna et augue iaculis scelerisque. Cras mi ipsum, aliquet a eleifend nec, eleifend a nisl. Ut et urna ac nisi blandit mattis vel sed nibh.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
$(document).ready(function(){
    $('#formregister').validate({ rules: { alternativecontactnumber: { required: true, number: true, maxlength: 11}, agree: { required: true } } });
});
</script>