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
    'git_border_top_color'
);
foreach ($options as $option) {
	if (get_option($option)) delete_option($option);
}

// delete plugin options
// delete_option('git_guid');
// delete_option('git_username');
// delete_option('git_password');
// delete_option('git_installed_page');
// delete_option('git_restricted_pages');
// delete_option('git_card_background_color');
// delete_option('git_text_color');
// delete_option('git_label_color');
// delete_option('git_link_color');
// delete_option('git_link_hover_color');
// delete_option('git_loading_icon_color');
// delete_option('git_border_color');
// delete_option('git_border_top_color');



