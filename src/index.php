<?php

if ( ! defined( 'AUTOLOADER' ) ) {
	require_once ABSPATH . 'library' . DIRECTORY_SEPARATOR . 'Autoloader' . DIRECTORY_SEPARATOR . 'index.php';
} else {
	require_once AUTOLOADER;
}

global $autoloader;

$namespace = 'nathanwooten\Filesystem';
$dir = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;

$autoloader->set( $namespace, $dir );

//////////

$fdir = $dir . 'Functions' . DIRECTORY_SEPARATOR;
if ( ! is_readable( $fdir ) ) {
  return false;  
}

$scan = scandir( $fdir );
foreach ( $scan as $item ) {
  $path = $fdir . $item;
  if ( is_file( $path ) ) {
    $result = require_once $path;
	if ( ! $result ) {
		throw new Exception;
	}
  }
}

return true;
