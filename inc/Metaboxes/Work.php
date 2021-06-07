<?php

namespace Metaboxes;

class Work extends Metabox
{
    protected static $post_type = 'work';
    
    public function render_metabox( $post ) 
    {
        $fields = [
            [
                'id'    => 'sort',
                'tag'   => 'input',
                'type'  => 'number',
                'label' => __( 'Порядок секции', 'pf' ),
            ],
            [
                'id'    => 'link',
                'tag'   => 'input',
                'type'  => 'text',
                'placeholder' => 'www.example.com',
                'label' => __( 'Ссылка на работу', 'pf' ),
            ],
        ];
        
        $this->show_metabox( $post, $fields );
    }
}