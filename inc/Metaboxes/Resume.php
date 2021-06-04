<?php

namespace Metaboxes;

class Resume
{
    private static $post_type = 'resume';

    public function __construct()
    {
        add_action( 'add_meta_boxes', [ $this, 'add_metabox' ] );
        add_action( 'save_post', [ $this, 'save_metabox' ] );
    }

    public function add_metabox() 
    {
        add_meta_box( 
            self::$post_type . '_metabox', 
            __( 'Дополнительные поля', 'pf' ),
            [ $this, 'render_metabox' ], 
            self::$post_type, 
            'normal', 
            'low'  
        );
    }
    
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
                'id'    => 'position',
                'tag'   => 'input',
                'type'  => 'text',
                'label' => __( 'Должность', 'pf' ),
            ],
        ];
		?>
		<table class="form-table">
            <tbody>
                <?php foreach( $fields as $field ) : ?>
                    <tr>
                        <th scope="row">
                            <label for="<?php echo self::$post_type . '_' . $field['id'] ?>"><?php echo $field['label'] ?></label>
                        </th>
                        <td>
                            <?php if( $field['tag'] == 'input' ) : ?>
                                <input 
                                    name="<?= self::$post_type . '[' . $field['id'] . ']' ?>" 
                                    type="<?= $field['type'] ?>" 
                                    id="<?= self::$post_type . '_' . $field['id'] ?>" 
                                    value="<?= get_post_meta( $post->ID, $field['id'], 1 ) ?? '' ?>" 
                                    placeholder="<?= $field['placeholder'] ?? '' ?>" 
                                    class="regular-text"
                                    style="width:100%"
                                    <?php if( isset( $field['disabled'] ) && $field['disabled'] ) : ?>
                                        disabled
                                    <?php endif ?>
                                >
                            <?php elseif( $field['tag'] == 'textarea' ) : ?>
                                <textarea 
                                    name="<?php echo self::$post_type . '[' . $field['id'] . ']' ?>" 
                                    id="<?php echo self::$post_type . '_' . $field['id'] ?>"
                                    class="metavalue" 
                                    rows="2"
                                    style="width:100%"
                                ><?= get_post_meta( $post->ID, $field['id'], 1 ) ?? '' ?></textarea>
                            <?php elseif( $field['tag'] == 'select' ) : ?>
                                <label for="<?php echo self::$post_type . '_' . $field['id'] ?>">
                                    <select 
                                        name="<?php echo self::$post_type . '[' . $field['id'] . ']' ?>" 
                                        id="<?php echo self::$post_type . '_' . $field['id'] ?>"
                                    >
                                        <option>...</option>
                                        <?php foreach( $field['options'] as $key => $value ) : ?>
                                            <option 
                                                value="<?php echo $key ?>"
                                                <?php selected( $key, get_post_meta( $post->ID, $field['id'], 1 ) ) ?>
                                            >
                                                <?= get_post_meta( $post->ID, $field['id'], 1 ) ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </label>
                            <?php endif ?>
                            <br>
                            <?php if( isset( $field['description'] ) ) : ?>
                                <span class="description"><?php echo $field['description'] ?></span>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
		</table>
		<?php
    }

    public function save_metabox( $post_id ) 
    {
		if ( wp_is_post_autosave( $post_id ) )
			return;

        if ( isset( $_POST[self::$post_type] ) && is_array( $_POST[self::$post_type] ) ) {
            $_POST[self::$post_type] = array_map( 'sanitize_text_field', $_POST[self::$post_type] );
        
            foreach( $_POST[self::$post_type] as $key => $value ){
                if( empty($value) ){
                    delete_post_meta( $post_id, $key );
                    continue;
                }
                update_post_meta( $post_id, $key, $value );
            }    
        }
	}
}