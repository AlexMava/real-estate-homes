<?php
/**
 * Single Property Page
 *
 */
get_header(); ?>
    <main class="main__single-property">
        <?php global $post;
        if (!$post->post_parent) :
            $property_name = get_field('property_name') ?: get_the_title();
            $property_location = get_field('property_location');
            $property_floors = get_field('property_floors');
            $property_wall = get_field('property_wall');
            $property_eco = get_field('property_eco');
            $property_image = get_field('property_image');?>

            <section class="house-detailed">
                <div class="container">
                    <div class="row p-3">
                        <div class="col-12">
                            <h1><?php echo $property_name; ?></h1>
                        </div>

                        <div class="col-12 mb-4">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="">
                                    <?php the_post_thumbnail('large'); ?>
                                </div>
                            <?php else : ?>
                                <div class="">
                                    <?php echo wp_get_attachment_image($property_image['id'], 'full_hd') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <ul class="list-group col-5">
                            <?php if ($property_location) : ?>
                                <li class="list-group-item">
                                    <?php echo __('Location: ', 'default') . $property_location; ?>
                                </li>
                            <?php endif; ?>

                            <?php if ($property_floors) : ?>
                                <li class="list-group-item">
                                    <?php echo __('Number of floors: ', 'default') . $property_floors; ?>
                                </li>
                            <?php endif; ?>

                            <?php if ($property_wall) : ?>
                                <li class="list-group-item">
                                    <?php echo __('Walls: ', 'default') . $property_wall; ?>
                                </li>
                            <?php endif; ?>

                            <?php if ($property_eco) : ?>
                                <li class="list-group-item">
                                    <?php echo __('Eco: ', 'default') . $property_eco; ?>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($post->post_parent) :
            $flat_space = get_field('flat_space');
            $flat_bedrooms = get_field('flat_bedrooms');
            $flat_balcony = get_field('balcony');
            $flat_bathroom = get_field('flat_bathroom');
            $flat_image = get_field('flat_image');?>

            <section class="flat-detailed">
                <div class="container">
                    <div class="row p-3">
                        <div class="col-12">
                            <h1><?php the_title(); ?></h1>
                        </div>

                        <div class="col-12 mb-4">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="">
                                    <?php the_post_thumbnail('large'); ?>
                                </div>
                            <?php else : ?>
                                <div class="">
                                    <?php echo wp_get_attachment_image($flat_image['id'], 'full_hd') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <ul class="list-group col-5">
                            <li class="list-group-item">
                                <?php echo __('House: ', 'default') . get_the_title( $post->post_parent ); ?>
                            </li>

                            <?php if ($flat_space) : ?>
                                <li class="list-group-item">
                                    <?php echo __('Living Space: ', 'default') . $flat_space . ' m2'; ?>
                                </li>
                            <?php endif; ?>

                            <?php if ($flat_bedrooms) : ?>
                                <li class="list-group-item">
                                    <?php echo __('Total Bedrooms: ', 'default') . $flat_bedrooms; ?>
                                </li>
                            <?php endif; ?>

                            <?php if ($flat_balcony) : ?>
                                <li class="list-group-item">
                                    <?php echo __('Balcony: ', 'default') . $flat_balcony; ?>
                                </li>
                            <?php endif; ?>

                            <?php if ($flat_bathroom) : ?>
                                <li class="list-group-item">
                                    <?php echo __('Bathroom: ', 'default') . $flat_bathroom; ?>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </main>

<?php get_footer(); ?>