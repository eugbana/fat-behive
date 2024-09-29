<?php

class Books_Meta_Box
{
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
        add_action('save_post', [$this, 'save_meta_box']);
    }

    public function add_meta_boxes() {
        add_meta_box(
            'book_details_meta_box',
            'Book Details',
            [$this, 'render_meta_box'],
            'dt_book',
            'side',
            'default'
        );
    }

    public function render_meta_box($post) {
        $author_name = get_post_meta($post->ID, '_author_name', true);
        ?>
        <label style="font-weight: bold;display: inline-block;margin-bottom: 10px;" for="author_name">Author Name:</label>
        <input style="width: 100%" type="text" id="author_name" name="author_name" value="<?php echo esc_attr($author_name); ?>" />
        <?php
    }

    public function save_meta_box($post_id) {
        if (array_key_exists('author_name', $_POST)) {
            update_post_meta($post_id, '_author_name', sanitize_text_field($_POST['author_name']));
        }
    }

}