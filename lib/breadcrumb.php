<?php
function estella_breadcrumb () {

    // Settings
    $separator  = __( '&gt;', 'estella' );
    $id         = 'breadcrumbs';
    $class      = 'breadcrumbs';
    $home_title = esc_attr__('Homepage', 'estella');

    // Get the query & post information
    global $post,$wp_query;
    $category = get_the_category();

    // Build the breadcrums
    echo '<ul id="' . $id . '" class="' . $class . '">';

    // Do not display on the homepage
    if ( !is_front_page() ) {

        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . esc_url( get_home_url() ) . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';

        if ( is_single() ) {

            // Single post (Only display the first category)
            echo '<li class="item-cat item-cat-' . $category[0]->term_id . ' item-cat-' . $category[0]->category_nicename . '"><a class="bread-cat bread-cat-' . $category[0]->term_id . ' bread-cat-' . $category[0]->category_nicename . '" href="' . esc_url(get_category_link($category[0]->term_id )) . '" title="' . esc_attr( $category[0]->cat_name ) . '">' . sprintf( __( '%s' , 'estella') , $category[0]->cat_name ) . '</a></li>';
            echo '<li class="separator separator-' . $category[0]->term_id . '"> ' . $separator . ' </li>';
            echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . esc_attr( get_the_title() ) . '">' . __( get_the_title(), 'estella' ) . '</span></li>';

        } else if ( is_category() ) {

            // Category page
            echo '<li class="item-current item-cat-' . $category[0]->term_id . ' item-cat-' . $category[0]->category_nicename . '"><strong class="bread-current bread-cat-' . $category[0]->term_id . ' bread-cat-' . $category[0]->category_nicename . '">' . sprintf( __( '%s' , 'estella'), $category[0]->cat_name ) . '</strong></li>';

        } else if ( is_page() ) {

            // Standard page
            if( $post->post_parent ){
                $parents= false;
                // If child page, get parents
                $anc = get_post_ancestors( $post->ID );

                // Get parents in the right order
                $anc = array_reverse($anc);

                // Parent page loop
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . esc_url( get_permalink($ancestor) ) . '" title="' . esc_attr( get_the_title($ancestor) ) . '">' . sprintf( __( '%s', 'estella' ) , get_the_title($ancestor) ) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }

                // Display parent pages
                echo $parents;

                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . esc_attr( get_the_title() ) . '"> ' . __( get_the_title(), 'estella' ) . '</strong></li>';

            } else {

                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . __( get_the_title(), 'estella' ) . '</strong></li>';

            }

        } else if ( is_tag() ) {

            // Tag page

            // Get tag information
            $term_id = get_query_var('tag_id');
            $taxonomy = 'post_tag';
            $args ='include=' . $term_id;
            $terms = get_terms( $taxonomy, $args );

            // Display the tag name
            echo '<li class="item-current item-tag-' . $terms[0]->term_id . ' item-tag-' . $terms[0]->slug . '"><strong class="bread-current bread-tag-' . $terms[0]->term_id . ' bread-tag-' . $terms[0]->slug . '">' . sprintf( __( '%s', 'estella' ), $terms[0]->name ) . '</strong></li>';

        } elseif ( is_day() ) {

            // Day archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '" title="' . esc_attr( get_the_time('Y') ) . '">' . __( get_the_time('Y'), 'estella' ) . __( 'Archives', 'estella' ) . '</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . esc_url( get_month_link( get_the_time('Y') ), get_the_time('m') ) . '" title="' . esc_attr( get_the_time('M') ) . '">' . sprintf( __( '%s', 'estella' ), get_the_time('M') ) .  __( 'Archives', 'estella' ) . '</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';

            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . __( get_the_time('jS'), 'estella' ) . ' ' . __( get_the_time('M'), 'estella' ) . __( 'Archives', 'estella' ) . '</strong></li>';

        } else if ( is_month() ) {

            // Month Archive

            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . esc_url( get_year_link( get_the_time('Y') ) ) . '" title="' . esc_attr( get_the_time('Y') ) . '">' . __( get_the_time('Y'), 'estella' ) . __( 'Archives', 'estella' ) . '</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';

            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . __( get_the_time('m'),'estella' ) . '" title="' . esc_attr( get_the_time('M') ) . '">' . __( get_the_time('M'), 'estella' ) . __( 'Archives', 'estella' ) . '</strong></li>';

        } else if ( is_year() ) {

            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . __( get_the_time('Y'), 'estella' ) . __( 'Archives', 'estella' ) . '</strong></li>';

        } else if ( is_author() ) {

            // Auhor archive

            // Get the author information
            global $author;
            $userdata = get_userdata( $author );

            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . esc_attr($userdata->display_name) . '">' . __( 'Author: ', 'estella' ) . $userdata->display_name . '</strong></li>';

        } else if ( get_query_var('paged') ) {

            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . esc_attr( get_query_var('paged') ) . '">'.__('Page', 'estella') . ' ' . __( get_query_var('paged'), 'estella' ) . '</strong></li>';

        } else if ( is_search() ) {

            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . esc_attr( get_search_query() ) . '">' . __('Search results for: ', 'estella' ) . __( get_search_query(), 'estella' ) . '</strong></li>';

        } elseif ( is_404() ) {

            // 404 page
            echo '<li>' . __( 'Error 404', 'estella' ) . '</li>';
        }

    }

    echo '</ul>';

}
?>