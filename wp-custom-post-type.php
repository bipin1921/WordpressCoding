<?php
/*
  Plugin Name: WordPress Custom Post Type
  Description: This is a simple plugin for purpose of learning about wordpress CPT
  Version: 1.0.0
  Author: Bipin
 */


/**
 * Register a custom post type called "book".
 */
function cpt_book() {
    $labels = array(
        'name'                  => __( 'Books'),
        'singular_name'         => __( 'Book'),
        'menu_name'             => __( 'Books'),
        'name_admin_bar'        => __( 'Book'),
        'add_new'               => __( 'Add New'),
        'add_new_item'          => __( 'Add New Book'),
        'new_item'              => __( 'New Book'),
        'edit_item'             => __( 'Edit Book'),
        'view_item'             => __( 'View Book'),
        'all_items'             => __( 'All Books'),
        'search_items'          => __( 'Search Books'),
        'parent_item_colon'     => __( 'Parent Books:'),
        'not_found'             => __( 'No books found.'),
        'not_found_in_trash'    => __( 'No books found in Trash.'),
        'featured_image'        => __( 'Book Cover Image'),
        'set_featured_image'    => __( 'Set cover image'),
        'remove_featured_image' => __( 'Remove cover image'),
        'use_featured_image'    => __( 'Use as cover image'),
        'archives'              => __( 'Book archives'),
        'insert_into_item'      => __( 'Insert into book'),
        'uploaded_to_this_item' => __( 'Uploaded to this book'),
        'filter_items_list'     => __( 'Filter books list'),
        'items_list_navigation' => __( 'Books list navigation'),
        'items_list'            => __( 'Books list'),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'book' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );
 
    register_post_type( 'book', $args );
}
 
add_action( 'init', 'cpt_book' );

/**
* Register a Custom Metabox called "Publisher Details" for custom post type called "Book".
**/

 function cpt_register_metabox(){
	add_meta_box("cpt-id","Publisher Details","cpt_metabox_callback","book","side","high");
 }
 add_action("add_meta_boxes","cpt_register_metabox");
 
/**
* Callback funnction for Custom Metabox. Also rendering/fetching data from database.
**/
 function cpt_metabox_callback($post){
	?>
	<p>
		<label>Name: </label>
		<?php $name = get_post_meta($post->ID,"cpt_mtbox_publisher_name",true) ?>
	</p>
	<p>	
		<input type="text" value="<?php echo $name; ?>" name="txtPublisherName" placeholder="Name of Publisher" />
	</p>
	<p>
		<label>Email: </label>
		<?php $email = get_post_meta($post->ID,"cpt_mtbox_publisher_email",true) ?>
	</p>
	<p>	
		<input type="email" value="<?php echo $email; ?>"  name="txtPublisherEmail" placeholder="Email ID of Publisher" />
	</p>
	
	<?php
 }
/**
*  Saving Metabox values into database.
**/
 function cpt_save_metabox_values($post_id, $post){
	
	$txtPublisherName = isset($_POST['txtPublisherName']) ? $_POST['txtPublisherName'] : "";
	$txtPublisherEmail = isset($_POST['txtPublisherEmail']) ? $_POST['txtPublisherEmail'] : "";
 
	update_post_meta($post_id,"cpt_mtbox_publisher_name",$txtPublisherName);
	update_post_meta($post_id,"cpt_mtbox_publisher_email",$txtPublisherEmail);
 }
 add_action("save_post","cpt_save_metabox_values",10,2);

/**
*  Create Custom Taxonomy "Book Category" for CPT Book.
**/
 
function custom_book_category_tax() {
    register_taxonomy(
        'book_category', 'book', array(
        'label' => __('Book Category'),
        'rewrite' => array('slug' => 'book_category'),
        'hierarchical' => true,
            )
    );
}
add_action('init', 'custom_book_category_tax');
