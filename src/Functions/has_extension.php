<?php

namespace nathanwooten\Filesystem\Functions;

function has_extension( $file )
{

	//notice the reverse, this means than pos should be lower than sepPos
	$file = strrev( $file );

	$pos = strpos( $file, '.' );

	if ( false !== $pos ) {
		$separatorPos = strpos( $file, DIRECTORY_SEPARATOR );

		if ( false === $separatorPos ) {
			return true;
		}

		if ( $pos < $separatorPos ) {
			return true;
		}
	}

	return false;

}
