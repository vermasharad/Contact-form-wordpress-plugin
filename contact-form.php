<?php
/**
 * Plugin Name: Contact Form
 * Author: Sharad Verma
 * Version: 1.0.0
 * Description: Contact Form Plugin
 * Tags: contact-form, blogvault
 */
add_action('admin_menu', 'custom_menu');
add_action('admin_menu', 'process_form_setting');

function custom_menu() { 
	add_menu_page( 
		'Contact-Us', 
		'Contact-Us', 
		'manage_options', 
		'menu_slug', 
		'contact_form', 
		'dashicons-media-spreadsheet' 
	);
}
function process_form_setting()
{
	register_setting('contact_form_group','contact_form_name');
	if(isset($_POST['action']) && current_user_can('manage_options')){
		update_option('cf-Name', sanitize_text_field($_POST['cf-Name']));
		update_option('cf-Email', sanitize_text_field($_POST['cf-Email']));
		update_option('cf-Message', sanitize_text_field($_POST['cf-Message']));
	}
}
function contact_form()
{
?>
	<div class = "wrap">
		<h1>Contact Form</h1>
		<?php settings_errors(); ?>
		<form action = "options.php" method = "post">
		<?php settings_fields('contact_form_group'); ?>
		<label>Name: <input type = "text" name = "cf-Name" pattern = "[a-zA-Z ]+" required placeholder = "your name"/></label></br>
		<label>Email: <input type = "email" name = "cf-Email" required placeholder = "abc@gmail.com"/></label></br>
		<label>Message: <input type = "text" name = "cf-Message" required placeholder = "Your message goes here"/></label></br>
		<input type = "submit" name = "cf-submitted" value = "Send"/>
	</form>
</div>
<?php
}
?>