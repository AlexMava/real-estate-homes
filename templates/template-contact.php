<?php
/**
 * Template Name: Contact
 */

get_header(); ?>

<main class="main-contact">
    <section class="the-content">
        <div class="container">
            <div class="row p-3">
                <div class="col-12">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) :
                            the_post(); ?>
                            <article <?php post_class('entry'); ?>>
                                <h1 class="page-title entry__title"><?php the_title(); ?></h1>
                                <?php if (has_post_thumbnail()) : ?>
                                    <div title="<?php the_title_attribute(); ?>" class="entry__thumb">
                                        <?php the_post_thumbnail('large'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="entry__content">
                                    <?php the_content('', true); ?>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
