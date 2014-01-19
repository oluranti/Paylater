    <?php $this->load->module('admintemplate'); ?>
    		<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
			<!-- content ends -->
			</div><!--/#content.span10-->
		<?php } ?>
		</div><!--/fluid-row-->
		<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
		
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>

		<footer>
			<p class="pull-left">&copy; <a href="http://paylater.one-cred.com" target="_blank">PayLater</a> <?php echo date('Y') ?></p>
		</footer>
		<?php } ?>

	</div><!--/.fluid-container-->

	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	
	<!-- jQuery UI -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/bootstrap-button.js"></script>

	<!-- autocomplete library -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/bootstrap-typeahead.js"></script>

	<!-- library for cookie management -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/jquery.cookie.js"></script>

	<!-- data table plugin -->
	<script src='<?php echo $this->admintemplate->get_asset(); ?>/js/jquery.dataTables.min.js'></script>



	<!-- select or dropdown enhancer -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/jquery.uniform.min.js"></script>

	<!-- rich text editor library -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/jquery.noty.js"></script>

	<!-- autogrowing textarea plugin -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/jquery.autogrow-textarea.js"></script>

	<!-- history.js for cross-browser state change on ajax -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/jquery.history.js"></script>
	<!-- application script for Charisma demo -->
	<script src="<?php echo $this->admintemplate->get_asset(); ?>/js/charisma.js"></script>
	

	
</body>
</html>