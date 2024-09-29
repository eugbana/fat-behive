<?php

class Books_Templates
{
    public function __construct()
    {
        add_filter( 'template_include', [$this, 'book_archive_template'], 999);
    }

    public function book_archive_template( $template ) {
        if ( is_post_type_archive( 'dt_book' ) ) {
            $plugin_template = DT_BOOKS_PLUGIN_DIR . 'templates/archive-dt_book.php';
            if ( file_exists( $plugin_template ) ) {
                return $plugin_template;
            }
        }
        return $template;
    }
}