<div class="row my-5 gallery">
    <?php foreach( $args['posts'] as $post ) : ?>
        <div class="col-md-4">
            <a href="<?= get_the_post_thumbnail_url( $post->ID, 'full' ) ?>">
                <img 
                    src="<?= get_the_post_thumbnail_url( $post->ID, 'full' ) ?>"
                    class="img-thumbnail"
                >
            </a>
        </div>
    <?php endforeach ?>
</div>
