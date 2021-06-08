<?php

namespace Metaboxes;

class Order extends Metabox
{
    protected static $post_type = 'orders';
    
    public function render_metabox( $post ) 
    {
        $fields = [
            [
                'id'          => 'date',
                'value'       => date( "F j, Y, g:i a", strtotime( $post->post_date ) ),
                'tag'         => 'input',
                'type'        => 'text',
                'disabled'    => true,
                'label'       => __( 'Дата заявки', 'pf' ),
            ],
            [
                'id'          => 'name',
                'tag'         => 'input',
                'type'        => 'text',
                'disabled'    => true,
                'label'       => __( 'Имя клиента', 'pf' ),
            ],
            [
                'id'          => 'email',
                'tag'         => 'input',
                'type'        => 'text',
                'disabled'    => true,
                'label'       => __( 'Email клиента', 'pf' ),
            ],
            [
                'id'          => 'msg',
                'tag'         => 'textarea',
                'disabled'    => true,
                'label'       => __( 'Сообщение клиента', 'pf' ),
                'placeholder' => __( 'Сообщение клиента', 'pf' ),
            ],
            [
                'id'          => 'comment',
                'tag'         => 'textarea',
                'label'       => __( 'Комментарий', 'pf' ),
                'placeholder' => __( 'Комментарий', 'pf' ),
            ],
            [
                'id'          => 'status',
                'tag'         => 'select',
                'options'     => [
                    'new'        => __( 'Новая заявка', 'pf' ),
                    'done'       => __( 'Заявка обработана', 'pf' ),
                    'processing' => __( 'Требуется уточнение', 'pf' ),
                ],
                'label'       => __( 'Статус заявки', 'pf' ),
                'placeholder' => __( 'Статус заявки', 'pf' ),
            ],
         ];

        $this->show_metabox( $post, $fields );
    }
}