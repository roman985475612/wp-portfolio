<?php

namespace PostColumns;

class Work
{
    private $post_type = 'work';

    public function __construct()
    {
        add_action( "manage_{$this->post_type}_posts_columns", [ $this, 'manage_posts_columns' ] );
        add_action( "manage_{$this->post_type}_posts_custom_column", [ $this, 'manage_posts_custom_column' ], 10, 2 );
    }

    public function manage_posts_columns( $columns )
    {
        $new_columns = [
            'screenshot' => __( 'Скриншот', 'pl' ),
            'link'       => __( 'Ссылка', 'pl' ),
        ];
        
        return array_slice( $columns, 0, 1 ) + $new_columns + $columns;    
    }

    public function manage_posts_custom_column( $column_name, $post_ID )
    {
        switch( $column_name ) {
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
}