<?php

namespace Metaboxes;

class Progress extends Metabox
{
    protected static $post_type = 'progress';

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
                'id'       => 'valuenow',
                'tag'      => 'input',
                'type'     => 'number',
                'label'    => __( 'Прогресс (число от 1 до 100)', 'pf' ),
            ],
       ];
       
       $this->show_metabox( $post, $fields );
	}
}