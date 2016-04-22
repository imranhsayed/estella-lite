<?php

/**
 * Would generate the widget for recent post.
 * Though wordpress already has recent post widget available by default,
 * this widget do just a little extra by showing featured images as well
 *
 * @package estella
 * @since Supenova 1.0.1
 */

add_action('widgets_init', 'estella_register_recent_posts');

function estella_register_recent_posts() {
    register_widget('estella_recent_posts');
}

//function register_estella_recent_posts()

class estella_recent_posts extends WP_Widget
{

    function estella_recent_posts() {

        WP_Widget::__construct('estella_recentposts',
        __('Recent Posts estella', 'estella'),
        $widget_opts = array(
        'classname' => 'estella',
        'description' => __('This widget will show recent posts with date and featured image', 'estella')
        ),

         $control_opts = array(
        'width' => 250,
        'height' => 350,
        'id_base' => 'estella_recentposts')
         );
    }


    //function estella_recent_posts()

    function widget($arg, $instance) {
        extract($arg, EXTR_SKIP);

        /* Our variables from the widget settings. */

        $title = (isset($instance['title'])) ? apply_filters('widget_title', $instance['title']) : __('Recent posts', 'estella');

        $number = (isset($instance['number'])) ? $instance['number'] : '';

        echo $before_widget;
        echo $before_title . $title . $after_title;

        $recent_posts = new WP_Query(array('showposts' => $number,));
?>

<div id="recent_posts" class="widget_recent_posts estella_recent_posts" >

<ul class="slides clear" >

<?php
        while ($recent_posts->have_posts()):
            $recent_posts->the_post(); ?>

<li>

<div class="aside-post-img ">

           <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail('side-thumb');
            }
            else {

                //To display the default image in aside recent posts
                $img_url = esc_url(get_template_directory_uri() . '/images/default.png');

                echo "<img src={$img_url} >";
            }
?>
</div>

<div class="post-title-date ">
<a href="<?php
            echo get_permalink() ?>" rel="bookmark" title="<?php
            the_title_attribute(); ?>">
<?php
            the_title_attribute(); ?>
</a>
<?php
            echo wpautop(wp_html_excerpt(get_the_content(), 100, '...')); ?><!-- displays few lines of content on recent post widget -->
<span><?php
            the_time(get_option('date_format')); ?></span>
</div>



</li>

<?php
        endwhile; ?>

<!-- to reset custom loop -->
<?php
        wp_reset_postdata(); ?>


</ul><!-- .slides -->

</div><!-- #recent_posts -->

        <!--OUTPUT ENDS -->

        <?php
        echo $after_widget; ?>

<?php
    }

    // function widget

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        /* Strip tags for title and name to remove HTML (important for text inputs). */

        $instance['title'] = strip_tags($new_instance['title']);

        $instance['number'] = strip_tags($new_instance['number']);

        return $instance;
    }

    // function update

    //dashboard form

    function form($instance) {

        $defaults = array('title' => 'Recent posts', 'number' => 5);

        $instance = wp_parse_args((array)$instance, $defaults);

        //Widget Title: Text Input

        echo '<p>';

        echo '<label for="' . $this->get_field_id('title') . '">' . __('Title:', 'estella') . '</label>';

        echo '<input id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" value="' . esc_attr($instance['title']) . '" style="width:90%;" />';

        echo '</p>';

        //Number of posts

        echo '<p>';

        echo '<label for="' . $this->get_field_id('number') . '">' . __('Number of posts to show:', 'estella') . '</label>';

        echo '<input id="' . $this->get_field_id('number') . '" name="' . $this->get_field_name('number') . '" value="' . esc_attr($instance['number']) . '" size="3" />';

        echo '</p>';
    }

    // function form

}

//class estella_recent_posts extends WP_Widget
