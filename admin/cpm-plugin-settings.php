<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


?>

<div class="cpm-plugin-wrap">
	<div class="header-wrap">
		<div class="row">
			<div class="logo-wrap col-md-4">
				<img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/logo.png'; ?>" alt="logo" class="logo">
				<div class="title">
					<h1><?php _e( 'Appreciate Plugin Settings', 'Cpm_Plugin' ); ?></h1>
					<p>
						<a href="codepixelzmedia.com"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/cpm-logo.png'; ?>" alt="cpm-logo" class="cpm-logo"></a>
					</p>
				</div>
			</div>

			<div class="addbanner-wrap col-md-4">
				<img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/addbanner.jpg'; ?>" alt="addbanner" class="addbanner">
			</div>

			<div class="btn-wrap col-md-4">
				<a href="#" class="cpm-btn dashicons-before dashicons-heart">support</a>
				<a href="#" class="cpm-btn btn2 dashicons-before dashicons-star-filled">Rate us</a>
			</div>
		</div>
	</div>

	<div class="body-wrap">
		<div id="tabs-wrap" class="tabs-wrap">

			<ul class="tab-menu">
				<li class="nav-tab"><a href="#general" class="dashicons-before dashicons-editor-alignleft"><?php _e( 'General', 'Cpm_Plugin' ); ?></a></li>
				<!-- <li class="nav-tab"><a href="#options" class="dashicons-before dashicons-admin-generic"><?php // _e( 'Options', 'Cpm_Plugin' ); ?></a></li>
				<li class="nav-tab"><a href="#advanced" class="dashicons-before dashicons-admin-settings"><?php // _e( 'Advanced', 'Cpm_Plugin' ); ?></a></li>
				<li class="nav-tab"><a href="#extra" class="dashicons-before dashicons-admin-tools"><?php // _e( 'Extras', 'Cpm_Plugin' ); ?></a></li> -->
			</ul>

			<div class="tab-content">
				<div id="general">
					<h2 class="tab-title">Welcome To Appreciate Plugin Settings</h2>
					<p>This is a ramdom settings form.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis rem facere doloribus delectus, reiciendis ipsum itaque placeat, eveniet perferendis vel molestiae impedit magnam. Sapiente, distinctio. Laboriosam accusamus odio architecto minus.</p>

					<form action="">
						<div class="form-group">
							<label for="">Upvote Message</label>
							<div class="form-control-wrap">
								<input class="form-control" type="text" value="Thanks. Your vote is registered." onfocus="this.placeholder=''" onblur="this.placeholder='Name'">
							</div>
						</div>
						<div class="form-group">
							<label for="">Down-Vote Message</label>
							<div class="form-control-wrap">
								<input class="form-control" type="text" value="Thanks. Your vote is registered. onfocus="this.placeholder=''" onblur="this.placeholder='Email'">
							</div>
						</div>
					   <!--  <div class="form-group">
							<label for="">Subject</label>
							<div class="form-control-wrap">
								<input class="form-control" type="text" placeholder="Subject" onfocus="this.placeholder=''" onblur="this.placeholder='Subject'">
							</div>
						</div> -->

					  <!--   <div class="form-group">
							<label for="">Message</label>
							<div class="form-control-wrap">
								<textarea class="form-control" placeholder="Message" onfocus="this.placeholder=''" onblur="this.placeholder='Message'"></textarea>
							</div>
						</div> -->

						<div class="form-group">
							<label for="">Where To Display? </label>
							<div class="form-control-wrap">
								<select class="cpm-multiselect form-control" name="multi_select[]" multiple="multiple">
								<?php appreciate_display_all_post_type(); ?>
								</select>


							</div>
						</div>


						<div class="form-group">
							<label for="">Display Position</label>
							<div class="form-control-wrap">
								<select name="cc" id="cc" class="cpm_basic_single_select form-control">
									<option value="Nepal">Before Content</option>
									<option value="England">After Content</option>
								
								
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="">Select Icon Type</label>
							<div class="form-control-wrap">
								<select class="cpm_single_select form-control" name="single_select">
									<option value="AL">Heart</option>
									<option value="WY">Arrow</option>
									<option value="WY">Thumbs Up</option>
									<option value="WY">Star</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="">Enable</label>
							<div class="form-control-wrap">
								<div class="checkbox-wrap custom">
									<input type="checkbox">
									<span class="custom-checkbox"></span>
								</div>
							</div>
						</div>
	
						<div class="form-group">
							<input type="submit" value="Save Change" class="cpm-btn submit">
						</div>
					</form>

				 <!--    <div class="success-box">
						This is a success message
					</div>

					<div class="error-box">
						This is an error message
					</div>

					<div class="info-box">
						This is an info message
					</div>

					<div class="warning-box">
						This is a warning message
					</div> -->

					<hr>

			

				</div>

		   
			</div>
		</div>

	
	</div>

	<div class="footer-wrap">
		<div class="row">
			<div class="creator col-md-3">
				<span>Proudly Created by</span>
				<a href="codepixelzmedia.com"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/cpm-logo.png'; ?>" alt="cpm-logo" class="cpm-logo"></a>
			</div>

			<div class="col-md-6">
				<ul class="footer-nav">
					<li><a href="#">Free Plugins</a></li>
					<li><a href="#">Membership</a></li>
					<li><a href="#">Support</a></li>
					<li><a href="#">Docs</a></li>
					<li><a href="#">Terms of Service</a></li>
					<li><a href="#">Privacy Policy</a></li>
				</ul>
			</div>

			<div class="copyright col-md-3">
				<span>All rights reserved</span>
				&copy; <?php echo date( 'Y' ); ?>
			</div>
		</div>
	</div>

</div>
<div class="clear"></div>
