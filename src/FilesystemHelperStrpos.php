<?php

namespace nathanwooten\Filesystem;

class FilesystemHelperStrpos
{

	public function strpos_( $dir, $string )
	{

		return strpos( strtolower( $dir ), strtolower( $string ) );

	}

}
