<?php

function custom_meta_box_markup($object)
{
	wp_nonce_field(basename(__FILE__), "meta-box-nonce");

	?>
	<div>


		<label for="meta-box-dropdown">Choose number of stars</label>
		<select name="meta-box-dropdown">
			<?php
			$option_values = array('&#9734;', '&#9734;&#9734;', '&#9734;&#9734;&#9734;', '&#9734;&#9734;&#9734;&#9734;', '&#9734;&#9734;&#9734;&#9734;&#9734;');

			foreach($option_values as $key => $value)
			{
				if($value == get_post_meta($object->ID, "meta-box-dropdown", true))
				{
					?>
					<option selected><?php echo $value; ?></option>
					<?php
				}
				else
				{
					?>
					<option><?php echo $value; ?></option>
					<?php
				}
			}
			?>
		</select>

	</div>
	<?php
}

function add_custom_meta_box()
{
add_meta_box("demo-meta-box", "Set Post Rating", "custom_meta_box_markup", "post", "side", "high", null);
}

add_action("add_meta_boxes", "add_custom_meta_box");

function save_custom_meta_box($post_id, $post, $update)
{
	if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
		return $post_id;

	if(!current_user_can("edit_post", $post_id))
		return $post_id;

	if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
		return $post_id;

	$slug = "post";
	if($slug != $post->post_type)
		return $post_id;

	$meta_box_text_value = "";
	$meta_box_dropdown_value = "";
	$meta_box_checkbox_value = "";



	if(isset($_POST["meta-box-dropdown"]))
	{
		$meta_box_dropdown_value = $_POST["meta-box-dropdown"];
	}
	update_post_meta($post_id, "meta-box-dropdown", $meta_box_dropdown_value);


}

add_action("save_post", "save_custom_meta_box", 10, 3);