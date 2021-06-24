<?php

namespace nathanwooten\Filesystem\Functions;

function get_namespace( $append = false )
{

	$namespace = __NAMESPACE__;
	if ( $append ) {
		$namespace .= '\\';
	}

	return $namespace;

}
