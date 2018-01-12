<?php
/*
Plugin Name: RPG Roles
Description: Removes standard roles and adds custom roles
Version: 1.0.0
Author: Valtech Ltd
Author URI: http://www.valtech.co.uk
Copyright: Valtech Ltd
Text Domain: rpgroles
Domain Path: /lang
*/

if(!defined('ABSPATH')) exit; //EXIT IF ACCESSED DIRECTLY

if(!class_exists('rpgroles')):

class rpgroles{

	var $version = '1.0.0';
	var $settings = array();
	
	function __construct(){
		/* DO NOTHING HERE - ENSURE ONLY INITIALIZED ONCE */
	}

	function initialize(){
		$this->settings = array(
			'name'				=> __('RPG Roles', 'rpgroles'),
			'version'			=> $this->version,
		);

		//REGISTER ACTIONS
		add_action('init', array( $this, 'add_roles'));
	}

	function add_roles(){
		//REMOVE OOTB ROLES
		remove_role('subscriber');
		remove_role('editor');
		remove_role('contributor');
		remove_role('author');

		//DEFINE CAPABILITIES
		$contentAuthorCaps = array(
			'read'						=> true,
			'edit_pages'				=> true
		);

		$contentApproverCaps = array(
			'read'						=> true,
			'edit_pages'				=> true,
			'edit_others_pages'			=> true,
			'publish_pages'				=> true,
			'read_private_pages'		=> true,
			'delete_pages'				=> true,
			'delete_private_pages'		=> true,
			'delete_published_pages'	=> true,
			'delete_others_pages'		=> true,
			'edit_private_pages'		=> true,
			'edit_published_pages'		=> true,
			'upload_files'				=> true,
		);

		$contentPublisherCaps = array(
			'read'						=> true,
			'edit_pages'				=> true,
			'edit_others_pages'			=> true,
			'publish_pages'				=> true,
			'read_private_pages'		=> true,
			'delete_pages'				=> true,
			'delete_private_pages'		=> true,
			'delete_published_pages'	=> true,
			'delete_others_pages'		=> true,
			'edit_private_pages'		=> true,
			'edit_published_pages'		=> true,
			'upload_files'				=> true,
		);

		$contentAdminCaps = array(
			'read'						=> true,
			'edit_dashboard'			=> true,
			'edit_pages'				=> true,
			'edit_others_pages'			=> true,
			'publish_pages'				=> true,
			'read_private_pages'		=> true,
			'delete_pages'				=> true,
			'delete_private_pages'		=> true,
			'delete_published_pages'	=> true,
			'delete_others_pages'		=> true,
			'edit_private_pages'		=> true,
			'edit_published_pages'		=> true,
			'upload_files'				=> true,
			'manage_rpgsnippets'		=> true,
			'create_roles'				=> true,
			'create_users'				=> true,
			'delete_roles'				=> true,
			'delete_users'				=> true,
			'edit_roles'				=> true,
			'edit_users'				=> true,
			'list_roles'				=> true,
			'list_users'				=> true,
			'promote_users'				=> true,
			'remove_users'				=> true,
		);

		$contentSnippets = array(
			'manage_rpgsnippets'		=> true,
			'read'						=> true,
		);

		//CREATE CUSTOM ROLES
		add_role('content_author', __('Content Author'), $contentAuthorCaps);
		add_role('content_approver', __('Content Approver'), $contentApproverCaps);
		add_role('content_publisher', __('Content Publisher'), $contentPublisherCaps);
		add_role('content_admin', __('Content Admin'), $contentAdminCaps);
		add_role('content_snippets', __('Content Snippets'), $contentSnippets);
	}
}

function rpgroles() {
	global $rpgroles;
	
	if( !isset($rpgroles)) {
		$rpgroles = new rpgroles();
		$rpgroles->initialize();
	}
	
	return $rpgroles;
}

//KICK OFF
rpgroles();

endif;
?>