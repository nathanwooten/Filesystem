<?php

namespace nathanwooten\Filesystem\Functions;

use function strpos;

function strpos_( $haystack, $needle ) {

	return strpos( strtolower( $haystack ), strtolower( $needle ) );

}
