<?php
add_action('wp_footer','appreciate_disable_btn',700);
function appreciate_disable_btn() {
if ( !is_user_logged_in() ) {
	?>
	<script type="text/javascript">
            jQuery(document).ready(function(){
				jQuery("#appreciate_upvote, #appreciate_downvote").hover(function() {
        jQuery(this).css('cursor','not-allowed').attr('title', '');
    }, function() {
        jQuery(this).css('cursor','auto');
    });
				jQuery( "#appreciate_upvote, #appreciate_downvote" ).click(function(e) {
					e.preventDefault();
				



				});
				jQuery("#appreciate_upvote").addClass('appreciate_dim');
            jQuery("#appreciate_downvote").addClass('appreciate_dim');
            jQuery("#appreciate_upvote").off('click');
            jQuery("#appreciate_downvote").off('click');
			});
			</script>
	<?php 
	}
}
add_shortcode('display__voting','display_voting_sc');
function display_voting_sc() {
	ob_start();
	echo '<i class="bi bi-caret-up-fill"></i>';
	global $post;
	$post_id = $post->ID;
	$post_id = intval($post_id);
	//echo $post_id.' my new id';
	//$get_the_id               = intval( get_the_ID() );
	$get_the_id               = intval( $post_id );
	$get_total_vote           = appreciate_total_vote( $get_the_id );
	$cuid                     = get_current_user_id();
	$appreciate_my_vote_status = appreciate_vote_status( $get_the_id, $cuid );
	$get_post_type = __(get_post_type($get_the_id),APPRECIATE);
	$after_content = '';
	$active_class             = '';
	if ( $appreciate_my_vote_status == 'appreciate_downvote' && $get_total_vote !== 0 ) {
		$active_class = ' downvote-on';
	} elseif ( $appreciate_my_vote_status == 'appreciate_upvote' && $get_total_vote !== 0 ) {
		$active_class = ' upvote-on';
	}
	//if ( $get_post_type =='post') {
	$after_content = 'voting:<div id="appreciate_wrapper" class="upvote">
    <a class="upvote' . $active_class . '" id="appreciate_upvote"> <i class="fa fa-caret-up fa-sort-asc" aria-hidden="true"></i> </a><div>
    <span class="count" id="appreciate_vote_count">' . $get_total_vote . '</span>
    <span class="count" id="appreciate_vote_result"></span>  </div>
	<a class="downvote' . $active_class . '" id="appreciate_downvote"><i class="fa fa-caret-down fa-sort-desc" aria-hidden="true"></i></a>
    <a class="star" style="display:none"></a>
</div>';
	//}

	/* $fullcontent = $content . $after_content;

	 return $fullcontent; */
	 echo $after_content;
$content = ob_get_contents();
ob_end_clean();
return $content;

}



// Define AJAX URL
function myplugin_ajaxurl() {

	echo '<script type="text/javascript">
            var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '";
          </script>';
}
 add_action( 'wp_head', 'myplugin_ajaxurl' );

 // The Javascript
function add_this_script_footer(){ ?>
 <script>
 jQuery(document).ready(function($) {
	 var get_user_id = "<?php echo get_current_user_id(); ?>";
	 var get_current_pid = "<?php echo get_the_id(); ?>";
	 // This is the variable we are passing via AJAX
	 // This does the ajax request (The Call).
 
	 $( "#appreciate_upvote, #appreciate_downvote" ).click(function() {
		var appreciate_current_click_vote = $(this).attr("id");
		var appreciate_status = "<?php echo appreciate_vote_status( get_the_id(), get_current_user_id() ); ?>";
	   $.ajax({
		   url: ajaxurl, // Since WP 2.8 ajaxurl is always defined and points to admin-ajax.php
		   data: {
			   'action':'cpm_ajax_ajax_request', // This is our PHP function below
			   'type' : appreciate_current_click_vote, // This is the variable we are sending via AJAX
			   'user_id' : get_user_id,
			   'page_id' : get_current_pid,
               'vote_status' : appreciate_status
		   },
           beforeSend: function() {
        // setting a timeout
        $("#appreciate_vote_count").remove();
        $('#appreciate_vote_result').text('loading');
    },
		   success:function(data) {
        
			if( appreciate_current_click_vote == 'appreciate_downvote' ) {
                $(".downvote").toggleClass("downvote-on");
				$(".upvote").removeClass("upvote-on");
				
			}

			if( appreciate_current_click_vote == 'appreciate_upvote' ) {
				$(".downvote").removeClass("downvote-on");
                $(".upvote").toggleClass("upvote-on");
                
			}

        

	   // This outputs the result of the ajax request (The Callback)
			 
             
              $("#appreciate_vote_result").html(data);
            
             
		   },
        
		   error: function(errorThrown){
			   window.alert(errorThrown+' my error ');
		   }
	   });
	 });
 });
 </script>
	<?php
}
 add_action( 'wp_footer', 'add_this_script_footer' );

 // The PHP
function cpm_ajax_ajax_request() {

		   // Check the nonce - security
	   // check_ajax_referer( 'thumbs-rating-nonce', 'nonce' );

	   global $wpdb;

	   // Get the POST values

	   $post_ID                   = intval( $_REQUEST['page_id'] );
	   $type_of_vote              = intval( $_REQUEST['type'] );
	   $appreciate_current_user_id = intval( $_REQUEST['user_id'] );
	// The $_REQUEST contains all the data sent via AJAX from the Javascript call
	if ( isset( $_REQUEST ) ) {
		$appreciate_get_vote_type = $_REQUEST['type'];
		// This bit is going to process our fruit variable into an Apple
	
		 appreciate_my_vote( $post_ID, $appreciate_current_user_id, $appreciate_get_vote_type );
		$appreciate_total_votes = appreciate_total_vote( $post_ID );
        echo intval($appreciate_total_votes);
	}
  
	// Always die in functions echoing AJAX content
	die();
}
 // This bit is a special action hook that works with the WordPress AJAX functionality.
 add_action( 'wp_ajax_cpm_ajax_ajax_request', 'cpm_ajax_ajax_request' );
 add_action( 'wp_ajax_nopriv_cpm_ajax_ajax_request', 'cpm_ajax_ajax_request' );

