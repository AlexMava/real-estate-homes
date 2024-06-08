<?php function boroughs_callback()
{
    ob_start();
    $terms = get_terms([
        'taxonomy' => 'property-borough',
        'hide_empty' => true,
    ]); ?>

    <div class="boroughs-widget">
        <?php foreach ($terms as $term) : ?>
            <a href="<?php echo get_term_link($term); ?>" class="btn btn-secondary" data-slug="<?php echo $term->slug; ?>"><?php echo $term->name; ?></a>
        <?php endforeach; ?>
    </div>

    <?php $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_shortcode('boroughs', 'boroughs_callback');

function houses_search_callback()
{
    ob_start(); ?>

    <form class="form-inline d-flex">
        <div class="form-group col-3">
            <label for="inputSearch" class="sr-only">Search</label>
            <input type="text" class="form-control" id="inputSearch" placeholder="Search">
        </div>

        <button class="js-ajax-request btn btn-primary mx-2">Go</button>
    </form>

    <?php $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_shortcode('houses_search', 'houses_search_callback');

?>