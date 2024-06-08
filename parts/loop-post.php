<!-- BEGIN of Post -->
<article class="one-article card col-4 mb-4 border-0 post-<?php the_ID(); ?>">
    <?php the_post_thumbnail('large', array('class' => 'img-responsive', 'alt' => 'Card image cap')); ?>

    <div class="one-article__body card-body">
        <div class="one-article__txt mb-1">
            <h5 class="card-title">
                <?php the_title();?>
            </h5>

            <p class="card-text">
                <?php echo wp_trim_words(get_the_content(), 25); ?>
            </p>
        </div>

        <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php _e('Read more', 'default'); ?></a>
    </div>
</article>
<!-- END of Post -->