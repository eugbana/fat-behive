<?php

class Books_Meta_Box
{
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
        add_action('save_post', [$this, 'save_meta_box']);
        add_filter('the_content', [$this, 'display_book_author']);
    }

    public function display_book_author($content)
    {
        if (is_singular('dt_book')) {
            $author_name = get_post_meta(get_the_ID(), '_author_name', true);
            if(!empty($author_name)) {
                $author = '<div style="color: #3C4257;font-size: 14px;line-height: 20px;margin: 10px 0px;padding-top: 10px;border-top: 1px solid #ddd;text-align: right;font-weight: bold;" class="book-author">' . __('Author:', 'dt_books') . ' ' . $author_name . '</div>';
                $content .= $author;
            }
        }
        return $content;
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