<?php

class Books_Templates {
    public function __construct() {
        add_filter('template_include', [$this, 'load_book_archive_template'], 999);
    }

    public function load_book_archive_template($template) {
        if (!$this->is_dt_book_archive()) {
            return $template;
        }

        $plugin_template = $this->get_book_archive_template();

        return file_exists($plugin_template) ? $plugin_template : $template;
    }

   
    private function is_dt_book_archive() {
        return is_post_type_archive('dt_book');
    }

    
    private function get_book_archive_template() {
        return DT_BOOKS_PLUGIN_DIR . 'templates/archive-dt_book.php';
    }
}

