<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\{

	FilesystemTraitNormalize,
	FilesystemTraitSeparator,

};

class FilesystemHelperImplode
{

	use FilesystemTraitNormalize;
	use FilesystemTraitSeparator;

	public function implode( $array, $separator = '', $normal = false )
	{

		if ( is_string( $array ) ) return $array;

		if ( '' === $separator ) {
			$separator = null;
		}

		if ( ! $normal ) {
			$array = $this->normalize( $array, $separator );
		}

		$imploded = implode( $separator, $array );
		return $imploded;

	}

}
