<?php

namespace PostColumns;

class Resume
{
    private $post_type = 'resume';

    public function __construct()
    {
        add_action( "manage_{$this->post_type}_posts_columns", [ $this, 'manage_posts_columns' ] );
        add_action( "manage_{$this->post_type}_posts_custom_column", [ $this, 'manage_posts_custom_column' ], 10, 2 );
    }

    public function manage_posts_columns( $columns )
    {
        $new_columns = [
            'position'   => __( 'Должность', 'pl' ),
            'date_start' => __( 'Дата начала', 'pl' ),
            'date_end'   => __( 'Дата окончания', 'pl' ),
        ];
        
        return array_slice( $columns, 0, 2 ) + $new_columns + $columns;    
    }

    public function manage_posts_custom_column( $column_name, $post_ID )
    {
        switch( $column_name ) {
            case 'position':
            case 'date_start':
            case 'date_end':
                ?>
                    <a href="<?php echo get_edit_post_link() ?>">
                        <?php echo get_post_meta( $post_ID, $column_name, true ) ?>
                    </a>
                <?php
                break;
            }
        return $column_name;
    }
}