<?php if(!defined('ABSPATH')) die(); ?>
<select class="full-parent" size="3">
    <?php
    $pricingTableList = new WP_Query( array( 'post_type' => 'wbr-pricing-table', 'post_status' => 'publish', 'posts_per_page' => -1, 'caller_get_posts'=> 1 ) );
    if( $pricingTableList->have_posts() ) {
        while ( $pricingTableList->have_posts() ) {
            $pricingTableList->the_post();
            echo '<option value="' . $pricingTableList->post->ID . '">' . get_the_title() . '</option>';
        }
    }
    wp_reset_postdata();
    ?>
</select>