<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\{

	FilesystemTraitFactory,
	FilesystemTraitIsA

};

use Exception;

class FilesystemHelperNormalize
{

	use FilesystemTraitFactory;
	use FilesystemTraitIsA;

//consider making normalize work on directory objects as well

	public function normalize( $normalize, $to = null )
	{

		$normalized = null;

		if ( ! $this->isA( $normalize, 'Directory' ) ) {

			$type = getType( $normalize );
			if ( 'array' === $type ) {
				$normalized = '';
			} elseif ( 'string' === $type ) {
				$normalized = [];
			} else {
				throw new Exception( 'Unknown type' );
			}

		} else {

			$processed = $this->normalize( $normalized->getInput() );
			$normalized->setInput( $processed );
			return $normalized;

		}

		$normalize = (array) $normalize;
		$replace = $this->getReplace();
		$separator = $this->getSeparator();

		foreach ( $normalize as $key => $norm ) {

			if ( ! $this->hasExtension( $norm ) ) {
				$norm = rtrim( $norm, implode( '', $replace ) ) . $separator;
			}

			$norm = str_replace( $replace, $separator, $norm );

			if ( false === strpos( $norm, $separator ) ) {
				continue;
			}

			$norm = ltrim( $norm, $separator );

			$normalize[ $key ] = $norm;
		}

		if ( is_string( $normalized ) ) {
			if ( ! $to || 'array' !== $to ) {
				$normalize = implode( '', $normalize );
			}
		} elseif ( is_array( $normalized ) ) {
			if ( $to && 'string' === $to ) {
				$normalize = implode( '', $normalize );
			}
		}

		$normalized = $normalize;

		return $normalized;

	}

	public function getReplace()
	{

		return [ '\\', '/' ];

	}

	public function getSeparator()
	{

		return DIRECTORY_SEPARATOR;

	}

}
