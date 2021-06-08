<?php

namespace PostColumns;

class Work
{
    private $post_type = 'work';

    public function __construct() {
        add_action( "manage_{$this->post_type}_posts_columns", [ $this, 'manage_posts_columns' ] );
        add_action( "manage_{$this->post_type}_posts_custom_column", [ $this, 'manage_posts_custom_column' ], 10, 2 );
        add_filter( "manage_edit-{$this->post_type}_sortable_columns", [ $this, 'manage_edit_sortable_columns' ] );
        add_action( 'pre_get_posts', [ $this, 'orderby_column' ] );
    }

    public function manage_posts_columns( $columns ) {
        $new_columns = [
            'sort'       => __( 'Порядок секции', 'pf' ),
            'screenshot' => __( 'Скриншот', 'pl' ),
            'link'       => __( 'Ссылка', 'pl' ),
        ];
        
        return array_slice( $columns, 0, 1 ) + $new_columns + $columns;    
    }

    public function manage_posts_custom_column( $column_name, $post_ID ) {
        switch( $column_name ) {
            case 'sort':
                ?>
                    <a href="//<?= get_post_meta( $post_ID, $column_name, true ) ?>">
                        <?= get_post_meta( $post_ID, $column_name, true ) ?>
                    </a>
                <?php
                break;
            case 'screenshot':
                ?>
                    <?php if( has_post_thumbnail() ) : ?>
                        <a href="<?= get_edit_post_link() ?>">
                            <?php the_post_thumbnail( 'thumbnail' ) ?>
                        </a>
                    <?php endif ?>
                <?php
                break;
            case 'link':
                ?>
                    <a target="_blank" href="//<?= get_post_meta( $post_ID, $column_name, true ) ?>">
                        <?= get_post_meta( $post_ID, $column_name, true ) ?>
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