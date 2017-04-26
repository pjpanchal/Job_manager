<?php
/* Job Custom Post type */
add_action('init', 'job_register');
function job_register() {
	$labels = array(
		'name' => _x('Jobs', 'post type general name'),
		'singular_name' => _x('Job', 'post type singular name'),
		'add_new' => _x('Add New', 'review'),
		'add_new_item' => __('Add New Job'),
		'edit_item' => __('Edit Job'),
		'new_item' => __('New Job'),
		'view_item' => __('View Job'),
		'search_items' => __('Search Job'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => 'dashicons-images-alt',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','thumbnail','editor')
	  ); 
	register_post_type( 'job' , $args );
}
// Custom Taxonomy
function add_console_taxonomies() {
	register_taxonomy('category', 'job', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Job Category', 'taxonomy general name' ),
			'singular_name' => _x( 'Job-Category', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Job-Categories' ),
			'all_items' => __( 'All Job-Categories' ),
			'parent_item' => __( 'Parent Job-Category' ),
			'parent_item_colon' => __( 'Parent Job-Category:' ),
			'edit_item' => __( 'Edit Job-Category' ),
			'update_item' => __( 'Update Job-Category' ),
			'add_new_item' => __( 'Add New Job-Category' ),
			'new_item_name' => __( 'New Job-Category Name' ),
			'menu_name' => __( 'Job Categories' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'category', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
add_action( 'init', 'add_console_taxonomies', 0 );

// Custom Taxonomy
function add_industry_taxonomies() {
	register_taxonomy('Industry', 'job', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Industry ', 'taxonomy general name' ),
			'singular_name' => _x( 'Industry', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Industry' ),
			'all_items' => __( 'All Industry' ),
			'parent_item' => __( 'Parent Industry' ),
			'parent_item_colon' => __( 'Parent Industry:' ),
			'edit_item' => __( 'Edit Industry' ),
			'update_item' => __( 'Update Industry' ),
			'add_new_item' => __( 'Add New Industry' ),
			'new_item_name' => __( 'New Industry Name' ),
			'menu_name' => __( 'Industry ' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'Industry', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the Industry base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
add_action( 'init', 'add_industry_taxonomies', 0 );


// Custom Taxonomy Location
function add_location_taxonomies() {
	register_taxonomy('location', 'job', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Location ', 'taxonomy general name' ),
			'singular_name' => _x( 'Location', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Location' ),
			'all_items' => __( 'All Location' ),
			'parent_item' => __( 'Parent Location' ),
			'parent_item_colon' => __( 'Parent Location:' ),
			'edit_item' => __( 'Edit Location' ),
			'update_item' => __( 'Update Location' ),
			'add_new_item' => __( 'Add New Location' ),
			'new_item_name' => __( 'New Location Name' ),
			'menu_name' => __( 'Location ' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'location', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the Location base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
add_action( 'init', 'add_location_taxonomies', 0 );

add_action( 'admin_init', 'my_admin_samplepost' );
function my_admin_samplepost() {
    add_meta_box( 'samplepost_meta_box', 'Job Details', 'display_job_meta_box','job', 'normal', 'high' );
}
function display_job_meta_box( $job ) {
    ?>
    <table width="100%" class="celebs_form">
		<tr>
            <td>Educational Details </td>
            <td><input type="text"  name="meta[education]"  value="<?php echo esc_html( get_post_meta( $job->ID, 'education', true ) );?>"  />
			<td>Openings </td>
            <td><input type="text"  name="meta[openings]"  value="<?php echo esc_html( get_post_meta( $job->ID, 'openings', true ) );?>"  data-validation-length="max10" required  data-validation="number length"/>
            </td></tr>

		<tr>
            <td>Salary Range </td>
            <td><input type="text"  name="meta[salary_range]"  value="<?php echo esc_html( get_post_meta( $job->ID, 'salary_range', true ) );?>"  /></td>
			<td>Duration </td>
            <td><input type="text"  name="meta[duration]"  value="<?php echo esc_html( get_post_meta( $job->ID, 'duration', true ) );?>"  /></td>
        </tr>

		<tr>
            <td>Company Job ID </td>
            <td><input type="text"  name="meta[company_job_ID]"  value="<?php echo esc_html( get_post_meta( $job->ID, 'company_job_ID', true ) );?>"  /></td>
			 <td>Notice Period </td>
            <td><input type="text"  name="meta[notice_period]"  value="<?php echo esc_html( get_post_meta( $job->ID, 'notice_period', true ) );?>"  /></td>
        </tr>		
		<tr>

        </tr>				
		<tr>
            <td>Recruiter </td>
            <td><input type="text"  name="meta[recruiter]"  value="<?php echo esc_html( get_post_meta( $job->ID, 'recruiter', true ) );?>"  /></td>
            <td>	Owner </td>
            <td><input type="text"  name="meta[owner]"  value="<?php echo esc_html( get_post_meta( $job->ID, 'owner', true ) );?>"  />
            </td>			
        </tr>							
			<tr>
            <td>	Created </td>
            <td><input type="text"  name="meta[created]"  value="<?php echo esc_html( get_post_meta( $job->ID, 'created', true ) );?>"  />
            </td>
        </tr>						
    </table>
<?php 
}
add_action( 'save_post', 'add_samplepost_fields', 10, 2 );
function add_samplepost_fields( $samplepost_id, $job ) {
    if ( $job->post_type == 'job' ) {
        if ( isset( $_POST['meta'] ) ) {
            foreach( $_POST['meta'] as $key => $value ){
                update_post_meta( $samplepost_id, $key, $value );
            }
        }
    }
}
?>
