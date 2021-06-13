<?php

namespace nathanwooten\Filesystem;

class FilesystemHelperIsA
{

	public function isA( $data, $alias ) {

		return is_a( $data, __NAMESPACE__ . '\\' . 'Filesystem' . $alias );

	}

}
