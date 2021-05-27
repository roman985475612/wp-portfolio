<?php 
    get_header();

    get_template_part( 'template-parts/section', 'home' ); 
    
    get_template_part( 'template-parts/section', 'resume' );

    get_template_part( 'template-parts/section', 'work' ); 
    
    get_template_part( 'template-parts/section', 'contact' ); 

    get_footer();
?>