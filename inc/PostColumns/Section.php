<?php

namespace PostColumns;

class Section
{
    private $post_type = 'section';

    public function __construct()
    {
        add_action( "manage_{$this->post_type}_posts_columns", [ $this, 'manage_posts_columns' ] );
        add_action( "manage_{$this->post_type}_posts_custom_column", [ $this, 'manage_posts_custom_column' ], 10, 2 );
    }

    public function manage_posts_columns( $columns )
    {
        $new_columns = [
            'section' => __( 'Код секции', 'pl' ),
            'icon'    => __( 'Класс иконки', 'pl' ),
            'color'   => __( 'Класс фона', 'pl' ),
        ];
        
        return array_slice( $columns, 0, 2 ) + $new_columns + $columns;    
    }

    public function manage_posts_custom_column( $column_name, $post_ID )
    {
        if( $column_name == 'section'
            || $column_name == 'icon'
            || $column_name == 'color' ) {
            ?>
                <a href="<?php echo get_edit_post_link() ?>">
                    <?php echo get_post_meta( $post_ID, $column_name, true ) ?>
                </a>
            <?php
        }
        return $column_name;
    }
}