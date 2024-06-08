<!-- BEGIN of Property -->
<article class="one-property card col-4 mb-4 border-0 post-<?php the_ID(); ?>">
    <?php if (get_the_post_thumbnail()) :
        the_post_thumbnail('large', array('class' => 'img-responsive', 'alt' => 'Card image cap'));
    else : ?>
        <img src="<?php echo get_stylesheet_directory_uri() . '/images/placeholder-vector.jpg';?>" alt="">
    <?php endif; ?>

    <div class="one-article__body card-body">
        <div class="one-article__txt mb-1">
            <h5 class="card-title">
                <?php the_title();?>
            </h5>

            <p class="card-text">
                <?php echo wp_trim_words(get_the_content(), 25); ?>
            </p>
        </div>

        <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php _e('View Details', 'default'); ?></a>
    </div>
</article>
<!-- END of Post -->