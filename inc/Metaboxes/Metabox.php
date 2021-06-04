<?php

namespace Metaboxes;

abstract class Metabox
{
    protected static $post_type;

    public function __construct()
    {
        add_action( 'add_meta_boxes', [ $this, 'add_metabox' ] );
        add_action( 'save_post', [ $this, 'save_metabox' ] );
    }

    public function add_metabox() 
    {
        add_meta_box( 
            static::$post_type . '_metabox', 
            __( 'Дополнительные поля', 'pf' ),
            [ $this, 'render_metabox' ], 
            static::$post_type, 
            'normal', 
            'low'  
        );
    }
    
    abstract public function render_metabox( $post ); 

    protected function show_metabox( $post, $fields )
    {
		?>
		<table class="form-table">
            <tbody>
                <?php foreach( $fields as $field ) : ?>
                    <tr>
                        <th scope="row">
                            <label for="<?php echo static::$post_type . '_' . $field['id'] ?>"><?php echo $field['label'] ?></label>
                        </th>
                        <td>
                            <?php if( $field['tag'] == 'input' ) : ?>
                                <input 
                                    name="<?= static::$post_type . '[' . $field['id'] . ']' ?>" 
                                    type="<?= $field['type'] ?>" 
                                    id="<?= static::$post_type . '_' . $field['id'] ?>" 
                                    value="<?= $field['value'] ?? get_post_meta( $post->ID, $field['id'], 1 ) ?>" 
                                    placeholder="<?= $field['placeholder'] ?? '' ?>" 
                                    class="regular-text"
                                    style="width:100%"
                                    <?php if( isset( $field['disabled'] ) && $field['disabled'] ) : ?>
                                        disabled
                                    <?php endif ?>
                                >
                            <?php elseif( $field['tag'] == 'textarea' ) : ?>
                                <textarea 
                                    name="<?php echo static::$post_type . '[' . $field['id'] . ']' ?>" 
                                    id="<?php echo static::$post_type . '_' . $field['id'] ?>"
                                    class="metavalue" 
                                    rows="2"
                                    style="width:100%"
                                    <?php if( isset( $field['disabled'] ) && $field['disabled'] ) : ?>
                                        disabled
                                    <?php endif ?>
                                ><?= $field['value'] ?? get_post_meta( $post->ID, $field['id'], 1 ) ?></textarea>
                            <?php elseif( $field['tag'] == 'select' ) : ?>
                                <label for="<?php echo static::$post_type . '_' . $field['id'] ?>">
                                    <select 
                                        name="<?php echo static::$post_type . '[' . $field['id'] . ']' ?>" 
                                        id="<?php echo static::$post_type . '_' . $field['id'] ?>"
                                    >
                                        <?php foreach( $field['options'] as $key => $value ) : ?>
                                            <option 
                                                value="<?= $key ?>"
                                                <?php selected( $key, $field['value'] ?? '' ) ?>
                                            >
                                                <?= $value ?>
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

        if ( isset( $_POST[static::$post_type] ) && is_array( $_POST[static::$post_type] ) ) {
            $_POST[static::$post_type] = array_map( 'sanitize_text_field', $_POST[static::$post_type] );
        
            foreach( $_POST[static::$post_type] as $key => $value ){
                if( empty($value) ){
                    delete_post_meta( $post_id, $key );
                    continue;
                }
                update_post_meta( $post_id, $key, $value );
            }    
        }
	}
}