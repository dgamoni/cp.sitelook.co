<?php
/**
 * WP Bootstrap Starter Child Sitelook functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_Bootstrap_Starter_Sitelook
 */

/**
 * Enqueue scripts and styles.
 */
function wp_bootstrap_starter_sitelook_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'wp-bootstrap-starter-bootstrap-sitelook-css', get_stylesheet_directory_uri() . '/assets/css/basic-styles.css', array('wp-bootstrap-starter-bootstrap-css') );
}
add_action( 'wp_enqueue_scripts', 'wp_bootstrap_starter_sitelook_enqueue_styles' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wp_bootstrap_starter_sitelook_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Top Left Menu', 'wp-bootstrap-starter-sitelook' ),
        'id'            => 'top-left-menu',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter-sitelook' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Top Right Social', 'wp-bootstrap-starter-sitelook' ),
        'id'            => 'top-right-social',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter-sitelook' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Top Right Search', 'wp-bootstrap-starter-sitelook' ),
        'id'            => 'top-right-search',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter-sitelook' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'User Menu', 'wp-bootstrap-starter-sitelook' ),
        'id'            => 'user-menu',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter-sitelook' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Newsletter', 'wp-bootstrap-starter-sitelook' ),
        'id'            => 'footer-newsletter',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter-sitelook' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Social', 'wp-bootstrap-starter-sitelook' ),
        'id'            => 'footer-4',
        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter-sitelook' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_widget('sitelook_sidebar_social');
}
add_action( 'widgets_init', 'wp_bootstrap_starter_sitelook_widgets_init' );


/**
 * Get Featured image for page
 */
function wp_bootstrap_starter_sitelook_featured_image() {
    global $wp;  
    $page_url = $wp->request;

    if (in_array($page_url, array("blog", "resources")) || strpos($page_url, 'blog/page') !== false) {
        $id = get_queried_object_id ();
        $style = "";

        // Check if the post/page has featured image
        if ( has_post_thumbnail( $id ) ) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
            $url = $image[0];
            $style = ' style="background: url(' . $url . ') center center no-repeat; background-size: cover;"';
        }
        $title = get_the_title($id);

        echo '<section id="site-header-image"' . $style. '><h2>' . $title . '</h2>';

        if ($page_url == "resources") {
            echo '<a href="/blog" class="btn transparent">Articles</a><a href="/books" class="btn transparent">Books</a><a href="/courses" class="btn transparent">Courses</a>';
        }

        echo '</section>';

        //echo '<header class="site-header-image" style="background-image: url(' . $url . ');><h2>' . $title . '</h2></header>';
    }
    return "";
}


function wp_bootstrap_starter_sitelook_get_excerpt($limit, $source = null){

    if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));
    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
    $excerpt = strip_shortcodes($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $limit);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
    $excerpt = $excerpt.'...';
//    $excerpt = $excerpt.'... <a href="'.get_permalink($post->ID).'">more</a>';
    return $excerpt;
}

if ( ! function_exists( 'wp_bootstrap_starter_sitelook_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function wp_bootstrap_starter_sitelook_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() )
    );

    $posted_on = sprintf(
        esc_html_x( '%s', 'post date', 'wp-bootstrap-starter-sitelook' ),
        '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );

    $byline = sprintf(
        esc_html_x( 'by %s', 'post author', 'wp-bootstrap-starter-sitelook' ),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author_meta('first_name') ) . ' ' . esc_html( get_the_author_meta('last_name') ) . '</a></span>'
    );

    echo '<span class="byline"> ' . $byline . '</span><br><span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
}
endif;

/**
 * Get Blog tags
 */
if ( ! function_exists( 'wp_bootstrap_starter_sitelook_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function wp_bootstrap_starter_sitelook_entry_footer() {
    // Hide category and tag text for pages.
    if ( 'post' === get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( esc_html__( ', ', 'wp-bootstrap-starter' ) );
        if ( $categories_list && wp_bootstrap_starter_categorized_blog() ) {
            printf( '<span class="cat-links">' . esc_html__( '%1$s', 'wp-bootstrap-starter' ) . '</span>', $categories_list ); // WPCS: XSS OK.
        }

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html__( ', ', 'wp-bootstrap-starter' ) );
        if ( $tags_list ) {
            printf( ' | <span class="tags-links">' . esc_html__( 'Tagged %1$s', 'wp-bootstrap-starter' ) . '</span>', $tags_list ); // WPCS: XSS OK.
        }
    }


    edit_post_link(
        sprintf(
            /* translators: %s: Name of current post */
            esc_html__( 'Edit %s', 'wp-bootstrap-starter' ),
            the_title( '<span class="screen-reader-text">"', '"</span>', false )
        ),
        ' | <span class="edit-link">',
        '</span>'
    );
}
endif;


/**************************************************************************************/
/**
 * Sidebar social network widget
 */
 class sitelook_sidebar_social extends WP_Widget {
    public $social_icons = array('fa fa-facebook'=>'Facebook',
                          'fa fa-flickr'=>'Flickr',
                          'fa fa-instagram'=>'Instagram',
                          'fa fa-google-plus'=>'Google +',
                          'fa fa-youtube'=>'YouTube',
                          'fa fa-linkedin'=>'LinkedIn',
                          'fa fa-pinterest'=>'Pinterest',
                          'fa fa-twitter'=>'Twitter',
                          'fa fa-tumblr'=>'Tumblr',
                          'fa fa-digg'=>'Digg',
                          'fa fa-rss'=>'RSS',
                          );

    function sitelook_sidebar_social() {
        $widget_ops = array( 'classname' => 'sitelook_sidebar_social', 'description' => __( 'Display sidebar social network.', 'sitelook' ) );
        $control_ops = array( 'width' => 350, 'height' =>250 ); 
        parent::WP_Widget( false, $name = __( 'Sitelook: Social Network', 'sitelook' ), $widget_ops, $control_ops);
    }

    function form( $instance ) {       
        for($i=0;$i<11;$i++){
            $defaults['social_icon_'.$i] = '';
            $defaults['social_link_'.$i] = '';
        }
        $instance = wp_parse_args( (array) $instance, $defaults ); 
        
        for($i=0;$i<11;$i++){
        ?>
             
            <p>
             <label for="<?php echo $this->get_field_id( 'social_icon_'.$i  ); ?>"><?php _e('Social Icon', 'sitelook'); ?>:</label>
                 <select id="<?php echo $this->get_field_id( 'social_icon_'.$i ); ?>" name="<?php echo $this->get_field_name( 'social_icon_'.$i  ); ?>">
               <?php 
            
               foreach($this->social_icons as $key=>$val){
                   $selected = '';
                  if( $instance[ 'social_icon_'.$i ] == $key) $selected = 'selected="selected"';
                   ?>
               <option   value="<?php echo $key;?>" <?php echo $selected ;?>><?php echo esc_attr($val);?></option>
               <?php }?>
                </select>
                </p>
                 <p>
                   <label for="<?php echo $this->get_field_id( 'social_link_'.$i  ); ?>"><?php _e('Social Link', 'sitelook'); ?>:</label>
                <input id="<?php echo $this->get_field_id( 'social_link_'.$i   ); ?>" name="<?php echo $this->get_field_name(  'social_link_'.$i   ); ?>" value="<?php echo esc_url($instance[ 'social_link_'.$i ]); ?>" class="" /> 
                </p>
                
                
            <?php
        }
    }
    
     function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
         
            for($i=0;$i<11;$i++){
             $instance[ 'social_icon_'.$i] =  esc_attr($new_instance['social_icon_'.$i]) ;
             $instance[ 'social_link_'.$i] =  esc_url_raw($new_instance['social_link_'.$i ]) ;
            }

            return $instance;
        }

        function widget( $args, $instance ) {
            extract( $args );

            echo $before_widget;
            echo '<div class="widget-sns"><h3 class="widget-title">Social</h3>';
            for($i=0;$i<11; $i++){
                        $social_icon = esc_attr($instance['social_icon_'.$i]);
                        $social_name = $this->social_icons[$social_icon];
                        $social_link = esc_url($instance['social_link_'.$i]);
                        if($social_link !=""){
                        echo '<a href="'.$social_link.'" target="_blank"><i class="'.$social_icon.'"></i><span class="social-name">'.$social_name.'</span> </a>';
                        }
                }
        
            echo '</div>';
            echo $after_widget;
        }
 }
/**************************************************************************************/


function show_loggedin_function( $atts ) {

global $current_user, $user_login;
      get_currentuserinfo();
add_filter('widget_text', 'do_shortcode');
if ($user_login) 
return 'Welcome, ' . $current_user->display_name . '!';
else
return '<a href="' . wp_login_url() . ' ">Login</a>';

}
add_shortcode( 'show_loggedin_as', 'show_loggedin_function' );


// load core functions
require_once get_stylesheet_directory() . '/core/load.php';

?>