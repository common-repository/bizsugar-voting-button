<?php

/*
Plugin Name: BizSugar.com Vote Button
Version: 1.4
Plugin URI: http://www.bizsugar.com/tools.php
Author URI: http://www.bizsugar.com
Author: BizSugar

Description: Adds BizSugar Vote button to your WordPress blog posts. See installation instructions to learn about all features of this plugin.

SEE INSTALLATIONS INSTRUCTIONS TO LEARN ABOUT ALL FEATURES OF THIS PLUGIN

*/

$message = "";

if (!function_exists('smbsugar_request_handler')) {
    function smbsugar_request_handler() {
        global $message;

        if ($_POST['smbsugar_action'] == "update options") {
            $smbsugar_align_v = $_POST['smbsugar_align_sl'];

   			update_option("smbsugar_box_align", $smbsugar_align_v);

			if($_POST['smbsugar_home'] == "on") update_option('smbsugar_display_home', "checked=on");
        	else update_option('smbsugar_display_home', "");

        	if($_POST['smbsugar_page'] == "on") update_option('smbsugar_display_page', "checked=on");
        	else update_option('smbsugar_display_page', "");

        	if($_POST['smbsugar_post'] == "on") update_option('smbsugar_display_post', "checked=on");
        	else update_option('smbsugar_display_post', "");

        	if($_POST['smbsugar_cat'] == "on") update_option('smbsugar_display_cat', "checked=on");
        	else update_option('smbsugar_display_cat', "");

        	if($_POST['smbsugar_archive'] == "on") update_option('smbsugar_display_archive', "checked=on");
        	else update_option('smbsugar_display_archive', "");

   			update_option("smbsugar_button", $_POST['smbsugar_button']);

            $message = '<br clear="all" /> <div id="message" class="updated fade"><p><strong>Options saved. </strong></p></div>';
        }
    }
}

if(!function_exists('smbsugar_add_menu')) {
    function smbsugar_add_menu () {
        add_options_page("BizSugar Vote Options", "BizSugar", 8, basename(__FILE__), "smbsugar_displayOptions");
    }
}

if (!function_exists('smbsugar_displayOptions')) {
    function smbsugar_displayOptions() {

        global $message;
        echo $message;

		print('<div class="wrap">');
		print('<h2>BizSugar Voting Button Options</h2>');

        print ('<form name="smbsugar_form" action="'. get_bloginfo("wpurl") . '/wp-admin/options-general.php?page=wp-bizsugar-vote.php' .'" method="post">');
?>
<table class="form-table">
	<tr valign="top">
		<th scope="row">Align</th>
		<td>
        <select name="smbsugar_align_sl" id="smbsugar_align_sl">
			<option value="Top Left"   <?php if (get_option("smbsugar_box_align") == "Top Left") echo " selected"; ?> >Top Left</option>
			<option value="Top Right"   <?php if (get_option("smbsugar_box_align") == "Top Right") echo " selected"; ?> >Top Right</option>
			<option value="Bottom Left"  <?php if (get_option("smbsugar_box_align") == "Bottom Left") echo " selected"; ?> >Bottom Left</option>
			<option value="Bottom Right"  <?php if (get_option("smbsugar_box_align") == "Bottom Right") echo " selected"; ?> >Bottom Right</option>
			<option value="None"  <?php if (get_option("smbsugar_box_align") == "None") echo " selected"; ?> >None</option>
		</select>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">Display BizSugar on...</th>
		<td>
			<INPUT TYPE=CHECKBOX NAME="smbsugar_home" <?php echo get_option('smbsugar_display_home'); ?> /> Home Page<br />
			<INPUT TYPE=CHECKBOX NAME="smbsugar_page" <?php echo get_option('smbsugar_display_page'); ?> /> Static Pages<br />
			<INPUT TYPE=CHECKBOX NAME="smbsugar_post" <?php echo get_option('smbsugar_display_post'); ?> /> Post Pages<br />
			<INPUT TYPE=CHECKBOX NAME="smbsugar_cat" <?php echo get_option('smbsugar_display_cat'); ?> /> Category Pages<br />
			<INPUT TYPE=CHECKBOX NAME="smbsugar_archive" <?php echo get_option('smbsugar_display_archive'); ?> /> Archive Pages<br /><br />
		</td>
	</tr>
	<tr>
		<th scope="row">Which BizSugar button would you like to use?</th>
		<td>
			<fieldset>
				<label style="display:block;text-align:center;width:120px;"><input type="radio" name="smbsugar_button" value="1" <?php if(get_option('smbsugar_button') == '1') : ?>checked="checked"<?php endif; ?> /><br /><img src="http://www.bizsugar.com/templates/sugar/images/evb_examples/vote-demo-blue.gif" alt="" style="margin:10px 0 0 0;" /></label><br />
				<label style="display:block;text-align:center;width:120px;"><input type="radio" name="smbsugar_button" value="2" <?php if(get_option('smbsugar_button') == '2') : ?>checked="checked"<?php endif; ?> /><br /><img src="http://www.bizsugar.com/templates/sugar/images/evb_examples/vote-demo-silver.gif" style="margin:10px 0 0 0;" alt="" /></label><br />
				<label style="display:block;text-align:center;width:120px;"><input type="radio" name="smbsugar_button" value="3" <?php if(get_option('smbsugar_button') == '3') : ?>checked="checked"<?php endif; ?> /><br /><img src="http://www.bizsugar.com/templates/sugar/images/evb_examples/evb3example1.gif" alt="" /></label><br />
				<label style="display:block;text-align:center;width:120px;"><input type="radio" name="smbsugar_button" value="4" <?php if(get_option('smbsugar_button') == '4') : ?>checked="checked"<?php endif; ?> /><br /><img src="http://www.bizsugar.com/templates/sugar/images/evb_examples/evb2example2.png" style="margin:10px 0 0 0;" alt="" /></label>
			</fieldset>
		</td>
	</tr>
</table>
<p class="submit">
<input class="button-primary" type="submit" value="Save Changes" name="Submit"/>
</p>	
<input type="hidden" name="smbsugar_action" value="update options" />
</form>
<h2>Adding the Button through PHP (optional)</h2>
<p>
  To deactivate the automatic integration of the BizSugar button, just make sure that all of the checkboxes in the "Display BizSugar on..." section are unchecked.
</p>
<p>
  Add the following Code:<br /><br />
  &lt;?php if (function_exists('smbsugar_add_button')) smbsugar_add_button($id, $type, $align);?&gt;
</p>
<style>
  ul.bizsugar-admin-php {
    padding:0 0 0 40px;
    list-style:disc;
  }
  ul.bizsugar-admin-php ul{
    list-style: circle;
    padding:0 0 0 40px;
  }
</style>
<ul class="bizsugar-admin-php">
  <li>$id (optional) - The page ID of the past you would like to make the button for.  If an ID is not provided, $post->ID will be used.</li>
  <li>
    $type (optional) - The type of button that you would like to use:
    <ul>
      <li>$type = 1 - <img src="http://www.bizsugar.com/templates/sugar/images/evb_examples/vote-demo-blue.gif" height="25" alt="" style="margin:10px 0 0 0;" /></li>
      <li>$type = 2 - <img src="http://www.bizsugar.com/templates/sugar/images/evb_examples/vote-demo-silver.gif" height="25" style="margin:10px 0 0 0;" alt="" /></li>
      <li>$type = 3 - <img src="http://www.bizsugar.com/templates/sugar/images/evb_examples/evb3example1.gif" style="margin: 0 0 -10px 0;"  alt="" /></li>
      <li>$type = 4 - <img src="http://www.bizsugar.com/templates/sugar/images/evb_examples/evb2example2.png" style="margin:0 0 -10px 0;" alt="" /></li>
    </ul>
  </li>
  <li>$align (optional) - The 'left' or 'right' alignment of the button.</li>
</ul>
<p>
  Version 1.4<br />
  <a href="http://www.bizsugar.com">http://www.bizsugar.com</a>
</p>
</div>
<?php
    }
}

if (!function_exists('smbsugar_bizsugarhtml')) {
	function smbsugar_bizsugarhtml($float,$button_url,$pid="") {
		if($pid == ""){
      global $wp_query;
		$post = $wp_query->post;
     	$id = $post->ID;
		$permalink = get_permalink($id);
        $title = urlencode($post->post_title);
    }else{
      $id = $pid;
      $permalink = get_permalink($pid);
      $title = urlencode(get_the_title($pid));
    }
    
		$bizsugarhtml = <<<CODE

<!-- FINE TUNE BUTTON POSITION FOR METHOD A AND B HERE -->
    <span style="margin-top: 10px;
				 margin-right: 10px;
				 margin-bottom: 10px;
				 margin-left: 10px; 
				 
				 float: $float;">

	<script type="text/javascript">
	submit_url = "$permalink";
	</script>
    <script type="text/javascript" src="http://www.bizsugar.com/$button_url"></script>
	</span>
CODE;
	return  $bizsugarhtml;
	}
}


if (!function_exists('smbsugar_addbutton')) {
	function smbsugar_addbutton($content) {
	 global $wp_query;
	  if(!$wp_query->is_feed){
  		$smbsugar_display = true;
  		if(is_home() && !get_option('smbsugar_display_home') == 'checked=on')
             $smbsugar_display = false;
       	if(is_page() && !get_option('smbsugar_display_page') == 'checked=on')
             $smbsugar_display = false;
       	if(is_single() && !get_option('smbsugar_display_post') == 'checked=on')
             $smbsugar_display = false;
       	if(is_category() && !get_option('smbsugar_display_cat') == 'checked=on')
             $smbsugar_display = false;
       	if(is_archive() && !get_option('smbsugar_display_archive') == 'checked=on' && !is_category())
             $smbsugar_display = false;
  
  		if(get_option('smbsugar_button') == '2') {
  			$button_url = "evb/button-b-2.php";
  		} else if (get_option('smbsugar_button') == '3') {
  			$button_url = "evb3/button.php";
  		} else if (get_option('smbsugar_button') == '4') {
  			$button_url = "evb5/button-b.php";
  		} else {
  			$button_url = "evb/button-2.php";
  		}
  		
  		if($smbsugar_display === true) {
      		if(! preg_match('|<!--bizsugar-->|', $content)) {
      		    $smbsugar_align = get_option("smbsugar_box_align");
      		    if ($smbsugar_align) {
                      switch ($smbsugar_align) {
                          case "Top Left":
          		              return smbsugar_bizsugarhtml("left",$button_url).$content;
                                break;
                          case "Top Right":
          		              return smbsugar_bizsugarhtml("Right",$button_url).$content;
                                break;
                          case "Bottom Left":
          		              return $content.smbsugar_bizsugarhtml("left",$button_url);
                                break;
                          case "Bottom Right":
          		              return $content.smbsugar_bizsugarhtml("right",$button_url);
                                break;
                          case "None":
          		              return $content;
                                break;
                          default:
          		              return smbsugar_bizsugarhtml("left",$button_url).$content;
                                break;
                      }
                  } else {
          		      return smbsugar_bizsugarhtml("left",$button_url).$content;
                  }
  
      		} else {
                    return str_replace('<!--bizsugar-->', smbsugar_bizsugarhtml("",$button_url), $content);
              }
          } else {
  			return $content;
          }
    }else{
      return $content;
    }
	}
}

if (!function_exists('smbsugar_add_button')) {
  function smbsugar_add_button($id="",$type=1, $align=""){
    if($type == '2') {
			$button_url = "evb/button-b-2.php";
		} else if ($type == '3') {
			$button_url = "evb3/button.php";
		} else if ($type == '4') {
			$button_url = "evb5/button-b.php";
		} else {
			$button_url = "evb/button-2.php";
		}
		echo smbsugar_bizsugarhtml($align, $button_url, $id);
  }
}

if (!function_exists('show_bizsugar')) {
	function show_bizsugar($float = "left") {
        global $post;
		$permalink = get_permalink($post->ID);
		echo <<<CODE

<!-- FINE TUNE BUTTON POSITION FOR METHOD C HERE -->
    <span style="margin-top: 10px;
				 margin-right: 10px;
				 margin-bottom: 10px;
				 margin-left: 10px; 
				 
				 float: $float;" class="bizsugar-button">

	<script type="text/javascript">
	submit_url = "$permalink";
	</script>
    <script type="text/javascript" src="http://www.bizsugar.com/evb/button.php"></script>
	</span>
CODE;
    }
}

add_filter('the_content', 'smbsugar_addbutton', 999);
add_action('admin_menu', 'smbsugar_add_menu');
add_action('init', 'smbsugar_request_handler');

?>
