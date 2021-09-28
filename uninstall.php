<?php // exit if uninstall constant is not defined
if (!defined('WP_UNINSTALL_PLUGIN')) exit;


// delete plugin options
$options = array(
	'git_guid',
    'git_username',
    'git_password',
    'git_installed_page',
    'git_restricted_pages',
    'git_card_background_color',
    'git_text_color',
    'git_label_color',
    'git_link_color',
    'git_link_hover_color',
    'git_loading_icon_color',
    'git_border_color',
    'git_border_top_color',
    'git_active_medlemsmatrikel',
    'git_login_button_color',
    'git_login_button_text_color',
    'git_login_label_color',
    'git_login_heading_color',
    'git_login_input_border_color',
    'git_login_input_border_active_color',
);
foreach ($options as $option) {
	if (get_option($option)) delete_option($option);
}