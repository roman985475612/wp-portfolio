<?php

namespace Metaboxes;

class Resume extends Metabox
{
    protected static $post_type = 'resume';
    
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
                'id'    => 'date_start',
                'tag'   => 'input',
                'type'  => 'date',
                'label' => __( 'Дата начала', 'pf' ),
            ],
            [
                'id'    => 'date_end',
                'tag'   => 'input',
                'type'  => 'date',
                'label' => __( 'Дата окончания', 'pf' ),
            ],
            [
                'id'    => 'utility',
                'tag'   => 'input',
                'type'  => 'text',
                'description' => __( 'Введите должностные обязанности разделенные ";"', 'pf' ),
                'label' => __( 'Должностные обязанности', 'pf' ),
            ],
            [
                'id'    => 'position',
                'tag'   => 'input',
                'type'  => 'text',
                'label' => __( 'Должность', 'pf' ),
            ],
        ];
        
        $this->show_metabox( $post, $fields );
    }
}