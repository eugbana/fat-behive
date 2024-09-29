<?php
get_header(); ?>

<main id="main" class="site-main" role="main">

    <div class="container">
        <h1><?php esc_html_e('Books Archive', 'dt_books'); ?></h1>

        <form method="get" action="" class="genre-filter">
            <?php
            $terms = get_terms(['taxonomy' => 'dt_genre']);
            if ($terms && !is_wp_error($terms)) :
                ?>
                <select name="genre" onchange="this.form.submit()">
                    <option value=""><?php esc_html_e('Select Genre', 'dt_books'); ?></option>
                    <?php foreach ($terms as $term) : ?>
                        <option value="<?php echo $term->slug; ?>" <?php selected($term->slug, get_query_var('genre')); ?>>
                            <?php echo $term->name; ?> (<?php echo $term->count; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
        </form>

        <?php if (have_posts()) : ?>
            <div class="books-grid">
                <?php while (have_posts()) : the_post();
                    $author = get_post_meta(get_the_ID(), '_author_name', true);
                    $title = get_the_title();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="thumbnail">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <?php
                        if (!empty($author)) {
                            echo '<p class="author">' . esc_html($author) . '</p>';
                        }
                        ?>
                    </article>
                <?php endwhile; ?>
            </div>

        <?php else : ?>
            <div class="books-not-found">
                <p>No books found.</p>
            </div>
        <?php endif; ?>

    </div>

</main>

<?php get_footer(); ?>

