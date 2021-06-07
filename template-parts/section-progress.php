<h4><?php echo $args['skill']->post_title ?></h4>
<div class="progress mb-3" style="height: 20px;">
    <div 
        class="progress-bar" 
        role="progressbar" 
        style="width: <?= get_post_meta( $args['skill']->ID, 'valuenow', true ) ?>%" 
        aria-valuenow="<?= get_post_meta( $args['skill']->ID, 'valuenow', true ) ?>" 
        aria-valuemin="0" 
        aria-valuemax="100"
    ><?= get_post_meta( $args['skill']->ID, 'valuenow', true ) ?>%</div>
</div>
