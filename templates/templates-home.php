<?php
/**
 * Template Name: Home Page
 */
get_header(); ?>

    <!-- BEGIN of main content -->
    <main class='main main-home'>
        <?php $arg = array(
            'post_type' => 'post',
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'posts_per_page' => 3
        );
        $the_query = new WP_Query($arg);
        if ($the_query->have_posts()) : ?>
            <section class="blog-news">
                <div class="container">
                    <div class="row pt-5 pb-5">
                        <h2><?php _e('Last News', 'default'); ?></h2>
                    </div>

                    <div class="row p-3">
                        <?php while ($the_query->have_posts()) :
                            $the_query->the_post(); ?>
                            <?php get_template_part('parts/loop', 'post'); ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </section>
        <?php endif;
        wp_reset_query(); ?>

        <?php $posts_per_page = get_option('posts_per_page');
        $arg = array(
            'post_type' => 'property',
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'posts_per_page' => $posts_per_page,
        );
        $the_query = new WP_Query($arg);
        if ($the_query->have_posts()) : ?>
            <section class="blog-news">
                <div class="container">
                    <div class="row pt-5 pb-5">
                        <h2><?php _e('Properties for Sale', 'default'); ?></h2>
                    </div>

                    <div class="row pt-2 pb-2">
                        <?php echo do_shortcode('[boroughs]'); ?>
                    </div>

                    <div class="row pt-2 pb-2">
                        <?php echo do_shortcode('[houses_search]'); ?>
                    </div>

                    <div class="js-property-box">
                        <div class="row p-3">
                            <?php while ($the_query->have_posts()) :
                                $the_query->the_post(); ?>
                                <?php get_template_part('parts/loop', 'property'); ?>
                            <?php endwhile; ?>
                        </div>

                        <?php $max_num_pages = $the_query->max_num_pages;
                        if ($max_num_pages > 1) : ?>
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <?php for ($i = 1; $i <= $max_num_pages; $i++) : ?>
                                        <li class="page-item">
                                            <a class="js-page-link js-ajax-request page-link <?php echo $i == $page_number ? 'active' : '';?>" href="#" data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </nav>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif;
        wp_reset_query(); ?>

    </main>
    <!-- END of main content -->

<?php get_footer(); ?>
