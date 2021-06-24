<?php

namespace nathanwooten\Filesystem\Functions;

function is_name( $mixed ) {

	if ( is_string( $mixed ) ) {

		if ( false === strpos( $mixed, DIRECTORY_SEPARATOR ) ) {
			return true;
		}

	} elseif ( is_array( $mixed ) && 1 === count( $mixed ) ) {

		$string = current( $mixed );
		return is_name( $string );
	}

	return false;

}
