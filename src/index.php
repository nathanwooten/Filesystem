<?php

$namespace = 'nathanwooten\Filesystem';
$dir = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;

spl_autoload_register( function ( $qualified ) use ( $namespace, $dir ) {

  $file = str_replace( $namespace, $dir, $qualified );

  if ( file_exists( $file ) ) {
    require_once $file;
  }

} );

$fdir . 'functions' . DIRECTORY_SEPARATOR;
if ( ! is_readable( $fdir ) ) {
  return false;  
}
$scan = scandir( $fdir );
foreach ( $scan as $item ) {
  if ( is_file( $item ) ) {
    require_once $fdir . $item;
  }
  
}

return true;
