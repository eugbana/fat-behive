<?php

class Genre_Tax
{
    public function __construct()
    {
        add_action('init', [$this, 'register_taxonomy']);
    }

    public function register_taxonomy() {
        $labels = [
            'name' => 'Genres',
            'singular_name' => 'Genre',
            'search_items' => 'Search Genres',
            'all_items' => 'All Genres',
            'edit_item' => 'Edit Genre',
            'update_item' => 'Update Genre',
            'add_new_item' => 'Add New Genre',
            'new_item_name' => 'New Genre Name',
            'menu_name' => 'Genres',
        ];

        $args = [
            'labels' => $labels,
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_quick_edit' => true,
            'show_admin_column' => true,
            'rewrite' => ['slug' => 'genre'],
        ];

        register_taxonomy('dt_genre', 'dt_book', $args);
    }

}