<?php

namespace nathanwooten\Filesystem;

class FilesystemHelperExplode
{

	use FilesystemTraitNormalize;
	use FilesystemTraitSeparator;

	public function explode( $string, $separator = DIRECTORY_SEPARATOR )
	{

		if ( is_array( $string ) ) return $string;

		$separator = $this->getSeparator( $separator );

		return explode( $separator, trim( $this->normalize( $string ), $separator ) );

	}

}
