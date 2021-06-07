<?php
function dd( $data ) {
	$dt = print_r( $data, 1 );
	if( is_string( $dt ) ) {
		$dt = htmlspecialchars( $dt );
	}
	?>
		<div class="alert alert-warning" role="alert">
			<pre><?php print_r( $dt ) ?></pre>
		</div>
	<?php
}

function showDate( $str, $format ) {
    if ( ( $timestamp = strtotime( $str ) ) === false ) {
        return "Строка ($str) недопустима";
    } else {
        return date( $format, $timestamp );
    }
}
