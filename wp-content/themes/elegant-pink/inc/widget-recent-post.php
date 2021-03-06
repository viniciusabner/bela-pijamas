<?php
/**
 * Widget Recent Post
 *
 * @package Elegant_Pink
 */
 
// register Elegant_Pink_Recent_Post widget
function elegant_pink_register_recent_post_widget() {
    register_widget( 'Elegant_Pink_Recent_Post' );
}
add_action( 'widgets_init', 'elegant_pink_register_recent_post_widget' );
 
 /**
 * Adds Elegant_Pink_Recent_Post widget.
 */
class Elegant_Pink_Recent_Post extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'elegant_pink_recent_post', // Base ID
			__( 'RARA: Recent Post', 'elegant-pink' ), // Name
			array( 'description' => __( 'A Recent Post Widget', 'elegant-pink' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	   
        $title      = ! empty( $instance['title'] ) ? strip_tags( $instance['title'] ) : __( 'Recent Posts', 'elegant-pink' );
        $num_post   = ! empty( $instance['num_post'] ) ? absint($instance['num_post']) : 3 ;
        $show_thumb = ! empty( $instance['show_thumbnail'] ) ? esc_attr( $instance['show_thumbnail'] ) : '';
        $show_date  = ! empty( $instance['show_postdate'] ) ? esc_attr( $instance['show_postdate'] ) : '';
        
        $qry = new WP_Query( array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'posts_per_page'        => $num_post,
            'ignore_sticky_posts'   => true
        ) );
        if( $qry->have_posts()){
            echo $args['before_widget'];
            echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $args['after_title'];
            ?>
            <ul>
                <?php 
                while( $qry->have_posts() ){
                    $qry->the_post(); ?>
                    <li>
                        <?php 
                        if( $show_thumb ){ ?>
                            <a href="<?php the_permalink();?>" class="post-thumbnail">
                                <?php
                                if ( has_post_thumbnail() ) {                                
                                    the_post_thumbnail( 'elegant-pink-post-thumb' );
                                }else{
                                    elegant_pink_get_fallback_svg( 'elegant-pink-post-thumb' );
                                } ?>
                            </a><?php
                        } ?>
						<header class="entry-header">
							<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
							<?php if( $show_date ){?>
                                <span class="posted-on"><a href="<?php the_permalink(); ?>"><time datetime="<?php echo esc_attr( get_the_date('Y-m-d') ); ?>"><?php echo esc_html( get_the_date('j F Y') ); ?></time></a></span>
                            <?php }?>
						</header>                        
                    </li>        
                <?php    
                }
                wp_reset_postdata();
            ?>
            </ul>
            <?php
            echo $args['after_widget'];   
        }  
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
        
        $title          = ! empty( $instance['title'] ) ? strip_tags( $instance['title'] ) : __( 'Recent Posts', 'elegant-pink' );	
        $num_post       = ! empty( $instance['num_post'] ) ? absint($instance['num_post']) : 3 ;
        $show_thumbnail = ! empty( $instance['show_thumbnail'] ) ? esc_attr( $instance['show_thumbnail'] ) : '';
        $show_postdate  = ! empty( $instance['show_postdate'] ) ? esc_attr( $instance['show_postdate'] ) : '';
        
        ?>
		
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'elegant-pink' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'num_post' ) ); ?>"><?php esc_html_e( 'Number of Posts', 'elegant-pink' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'num_post' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'num_post' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $num_post ); ?>" />
		</p>
        
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_thumbnail' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_thumbnail ); ?>/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>"><?php esc_html_e( 'Show Post Thumbnail', 'elegant-pink' ); ?></label>
		</p>
        
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'show_postdate' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_postdate' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_postdate ); ?>/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_postdate' ) ); ?>"><?php esc_html_e( 'Show Post Date', 'elegant-pink' ); ?></label>
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		
        $instance = array();
		
        $instance['title']          = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : __( 'Recent Posts', 'elegant-pink' );
        $instance['num_post']       = ! empty( $new_instance['num_post'] ) ? absint($new_instance['num_post']) : 3 ;        
        $instance['show_thumbnail'] = ! empty( $new_instance['show_thumbnail'] ) ? absint( $new_instance['show_thumbnail'] ) : '';
        $instance['show_postdate']  = ! empty( $new_instance['show_postdate'] ) ? absint( $new_instance['show_postdate'] ) : '';
		
        return $instance;
	}

} // class Elegant_Pink_Recent_Post 