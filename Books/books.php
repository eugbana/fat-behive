<?php
/*
Plugin Name: Book Custom Post Type
Description: A plugin to create a custom post type for books, with a custom taxonomy and meta box.
Version: 1.0
Author: Dominic Ugbana
Text Domain: dt_books
*/





class Book_Post_Type {

  

    public function __construct() {
        $this->define_constants();
        $this->load_dependencies();
        $this->register_hooks();
    }

  
    private function define_constants() {
        if (!defined('DT_BOOKS_PLUGIN_DIR')) {
            define('DT_BOOKS_PLUGIN_DIR', plugin_dir_path(__FILE__));
        }
    }

   
    private function load_dependencies() {
        require_once DT_BOOKS_PLUGIN_DIR . 'inc/Books_Templates.php';
        require_once DT_BOOKS_PLUGIN_DIR . 'inc/Books_CPT.php';
        require_once DT_BOOKS_PLUGIN_DIR . 'inc/Genre_Tax.php';
        require_once DT_BOOKS_PLUGIN_DIR . 'inc/Books_Meta_Box.php';
        require_once DT_BOOKS_PLUGIN_DIR . 'inc/Filters.php';

        new Books_Templates();
        new Books_CPT();
        new Genre_Tax();
        new Books_Meta_Box();
        new Filters();
    }

    
    
    private function register_hooks() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
    }

    public function enqueue_styles() {
        if ($this->should_enqueue_styles()) {
            wp_enqueue_style('book-styles', plugin_dir_url(__FILE__) . 'assets/css/book-styles.css');
        }
    }


     
    private function should_enqueue_styles() {
        return is_post_type_archive('dt_book') || is_singular('dt_book');
    }
}


new Book_Post_Type();
