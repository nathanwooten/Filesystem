<?php

namespace nathanwooten\Filesystem\Functions;

function has_extension( $item )
{

	//notice the reverse, this means than pos should be lower than sepPos
	$item = strrev( $item );

	$pos = strpos( $item, '.' );

	if ( false !== $pos ) {
		$separatorPos = strpos( $item, DIRECTORY_SEPARATOR );

		if ( false === $separatorPos ) {
			return true;
		}

		if ( $pos < $separatorPos ) {
			return true;
		}
	}

	return false;

}
