<?php

namespace nathanwooten\Filesystem\Functions;

function qualify( $alias ) {

	$qualified = getNamespace( true ) . getPackage() . $alias;
	if ( ! class_exists( $qualified ) ) {
		throw new Exception( 'Qualified does not exist' );
	}

	return $qualified;

}