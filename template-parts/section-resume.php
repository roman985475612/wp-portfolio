<div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
    <?php foreach( $args['posts'] as $post ) : ?>
        <div class="col">
            <div class="card">
                <div class="card-header"><?= get_post_meta( $post->ID, 'position', true ) ?></div>
                <div class="card-body">
                    <h4 class="card-title"><?= $post->post_title ?></h4>
                    <p class="card-text"><?= $post->post_content ?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <?php
                        $utilities = explode( ';', get_post_meta( $post->ID, 'utility', true ) );
                        foreach( $utilities as $utility ) :
                    ?>
                        <li class="list-group-item"><?= trim( $utility ) ?></li>
                    <?php endforeach ?>
                </ul>
                <div class="card-footer text-muted">
                    Dates:
                    <?= showDate( get_post_meta( $post->ID, 'date_start', true ), 'm.Y' ) ?> -
                    <?= showDate( get_post_meta( $post->ID, 'date_end', true ), 'm.Y' ) ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
