<?php

$namespace = 'nathanwooten\Filesystem';
$dir = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;

spl_autoload_register( function ( $qualified ) {

  $file = str_replace( $namespace, $dir, $qualified );

  if ( file_exists( $file ) ) {
    require_once $file;
  }

} );
