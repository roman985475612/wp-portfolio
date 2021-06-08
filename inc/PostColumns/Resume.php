<?php

namespace PostColumns;

class Resume
{
    private $post_type = 'resume';

    public function __construct() {
        add_action( "manage_{$this->post_type}_posts_columns", [ $this, 'manage_posts_columns' ] );
        add_action( "manage_{$this->post_type}_posts_custom_column", [ $this, 'manage_posts_custom_column' ], 10, 2 );
        add_filter( "manage_edit-{$this->post_type}_sortable_columns", [ $this, 'manage_edit_sortable_columns' ] );
        add_action( 'pre_get_posts', [ $this, 'orderby_column' ] );
    }

    public function manage_posts_columns( $columns ) {
        $new_columns = [
            'sort'       => __( 'Порядок секции', 'pf' ),
            'position'   => __( 'Должность', 'pl' ),
            'date_start' => __( 'Дата начала', 'pl' ),
            'date_end'   => __( 'Дата окончания', 'pl' ),
        ];
        
        return array_slice( $columns, 0, 2 ) + $new_columns + $columns;    
    }

    public function manage_posts_custom_column( $column_name, $post_ID ) {
        switch( $column_name ) {
            case 'sort':
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

    public function manage_edit_sortable_columns( $columns ) {
        $columns['sort'] = 'sort';
        return $columns;
    }
    
    public function orderby_column( $query ) {
        if( ! is_admin() )
            return;
     
        $orderby = $query->get( 'orderby' );
     
        if( 'sort' == $orderby ) {
            $query->set('meta_key', 'sort');
            $query->set('orderby', 'meta_value_num');
        }
    }
}