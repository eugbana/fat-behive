<?php
get_header(); ?>

<main id="main" class="site-main" role="main">
    <?php
    $term = get_queried_object(); 
    ?>

    <h1>Books in Genre: <?php echo esc_html($term->name); ?></h1>

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('medium'); ?>
                    </a>
                <?php endif; ?>
                <?php the_excerpt(); ?>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No books found in this genre.</p>
    <?php endif; ?>

</main>

<?php get_footer(); ?>
