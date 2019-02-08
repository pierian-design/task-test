<?php
/**
* Plugin Name: Test Plugin
* Plugin URI: 
* Description: Test plugin for Taras Chornyy
* Version: 1.0
* Author: Vladimir Ermakov
* Author URI: https://www.upwork.com/fl/vladimirermakov7
**/


/**
 * register task post type
 */
function wptest_custom_post_type() {
	register_post_type( 'wptest_task',    	
		array(
			'labels' => array(
				'name' => __( 'Tasks', 'wptest' ),
				'singular_name' => __( 'Task', 'wptest' ),
				'menu_name' => __( 'Tasks', 'wptest' ),
				'name_admin_bar' => __( 'Task', 'wptest' ),
				'add_new_item' => __( 'Add New Task', 'wptest' ),
				'new_item' => __( 'New Task', 'wptest' ),
				'edit_item' => __( 'Edit Task', 'wptest' ),
				'view_item' => __( 'View Task', 'wptest' ),
				'all_items' => __( 'All Tasks', 'wptest' ),
				'search_items' => __( 'Search Tasks', 'wptest' ),
				'parent_item_colon' => __( 'Parent Tasks:', 'wptest' ),
				'not_found' => __( 'No Tasks found.', 'wptest' ),
				'not_found_in_trash' => __( 'No Tasks found in Trash.', 'wptest' ),
				'featured_image' => __( 'Task Cover Image', 'wptest' ),
				'archives' => __( 'Task archives', 'wptest' ),
				'insert_into_item' => __( 'Insert into Task', 'wptest' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Task', 'wptest' ),
				'filter_items_list' => __( 'Filter Tasks list', 'wptest' ),
				'items_list_navigation' => __( 'Tasks list navigation', 'wptest' ),
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'wptest-tasks' ),
		)
	);
}
add_action('init', 'wptest_custom_post_type');


/**
 * register task type taxonomy
 */
function wptest_custom_taxonomy() {
	register_taxonomy(
		'wptest_tasktypes',
		'wptest_task',
		array(
			'labels' => array(
				'name' => __( 'Task Types', 'wptest' ),
				'singular_name' => __( 'Task Type', 'wptest' ),
				'search_items' => __( 'Search Task Types', 'wptest' ),
				'all_items'	=> __( 'All Task Types', 'wptest' ),
				'parent_item' => __( 'Parent Task Type', 'wptest' ),
				'parent_item_colon' => __( 'Parent Task Type:', 'wptest' ),
				'edit_item' => __( 'Edit Task Type', 'wptest' ),
				'update_item' => __( 'Update Task Type', 'wptest' ),
				'add_new_item' => __( 'Add New Task Type', 'wptest' ),
				'new_item_name'	=> __( 'New Task Type Name', 'wptest' ),
				'separate_items_with_commas' => __( 'Separate Task Types with commas', 'wptest' ),
				'add_or_remove_items' => __( 'Add or remove Task Types', 'wptest' ),
				'choose_from_most_used' => __( 'Choose from the most used Task Types', 'wptest' ),
				'not_found' => __( 'No Task Types found.', 'wptest' ),
				'menu_name'	=> __( 'Task Types', 'wptest' ),
			),
			'rewrite' => array( 'slug' => 'task-types' ),
			'hierarchical' => true,
		)
	);
}
add_action( 'init', 'wptest_custom_taxonomy' );


/**
 * register meta boxes
 */
function wptest_register_meta_boxes() {
	add_meta_box( 'wptest', __( 'Task Custom Field', 'wptest' ), 'wptest_display_callback', 'wptest_task' );
}
add_action( 'add_meta_boxes', 'wptest_register_meta_boxes' );

//meta box display callback.
function wptest_display_callback( $post ) {
	include plugin_dir_path( __FILE__ ) . './form.php';
}

//save meta box content.
function wptest_save_meta_box( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( $parent_id = wp_is_post_revision( $post_id ) ) {
		$post_id = $parent_id;
	}
	$fields = [
		'wptest_start_date',
		'wptest_due_date',
		'wptest_priority',
	];
	foreach ( $fields as $field ) {
		if ( array_key_exists( $field, $_POST ) ) {
			update_post_meta( $post_id, $field, sanitize_text_field( $_POST[$field] ) );
		}
	}
}
add_action( 'save_post', 'wptest_save_meta_box' );


/**
 * enqueue styles for plugin
 */
function add_plugin_stylesheet() {
	wp_enqueue_style( 'test', plugins_url( '/css/style.css', __FILE__ ) );
}
add_action( 'admin_print_styles', 'add_plugin_stylesheet' );