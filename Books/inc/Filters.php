<?php

class Filters
{
    public function __construct()
    {
        add_action('pre_get_posts', [$this, 'filter_books_by_genre']);
    }

    public function filter_books_by_genre( $query ) {
        if (!is_admin() && $query->is_main_query() && is_post_type_archive('dt_book')) {
            if (isset($_GET['genre']) && !empty($_GET['genre'])) {
                $genre_slug = sanitize_text_field($_GET['genre']);

                $query->set('tax_query', [
                    [
                        'taxonomy' => 'dt_genre',
                        'field' => 'slug',
                        'terms' => $genre_slug,
                    ]
                ]);
            }
        }
    }

}