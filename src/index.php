<?php

if ( ! defined( 'DS' ) ) define( 'DS', DIRECTORY_SEPARATOR );

use nathanwooten\Autoloader\Autoloader;

global $autoloader;

global $library_dir_name;
global $functions_dir_name;

////////// edit here

$filesystem_namespace = 'nathanwooten\Filesystem';
$filesystem_dir = dirname( __FILE__ ) . DS;

$library_dir_name = isset( $library_dir_name ) ? $library_dir_name : 'library';
$functions_dir_name = isset( $functions_dir_name ) ? $functions_dir_name : 'Functions';

	$filter_namespace = 'nathanwooten\Filter';
	$filter_dir = ABSPATH . $library_dir_name . 'Filter' . DS . 'src' . DS;

//////////

if ( ! empty( $functions_dir_name ) ) {
	$functions_dir_name .= DS;
}

if ( ! defined( 'AUTOLOADER' ) ) {
	require_once ABSPATH . $library_dir_name . DS . 'Autoloader' . DS . 'index.php';
} else {
	require_once AUTOLOADER;
}

$autoloader = isset( $autoloader ) ? $autoloader : new Autoloader;
	$autoloader->set( $filesystem_namespace, $filesystem_dir );
		$autoloader->set( $filter_namespace, $filter_dir );

$functions_dir = $filesystem_dir . $functions_dir_name;
var_dump( $functions_dir );
if ( ! is_readable( $functions_dir ) ) {
	throw new Exception( 'Unreadable functions directory' );
}

	$scan = scandir( $functions_dir );
	foreach ( $scan as $item ) {

		$path = $functions_dir . $item;

		if ( is_file( $path ) ) {
			$result = require_once $path;
			if ( ! $result ) {
				throw new Exception( 'Required lib file not available: ' . $path );
			}
		}
	}

return 1;
