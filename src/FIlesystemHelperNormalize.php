<?php

namespace nathanwooten\Filesystem;

class FilesystemHelperNormalize
{

	public function normalize( $normalize )
	{

		$normalized = null;

		if ( ! is_array( $normalize ) ) {
			$normalized = '';
		} else {
			$normalized = [];
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
			$normalized = implode( '', $normalize );
		} else {
			$normalized = $normalize;
		}

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

	public function hasExtension( $file )
	{

		$pos = strpos( $file, '.' );

		if ( false !== $pos ) {
			$sepPos = strpos( $file, DIRECTORY_SEPARATOR );

			if ( $pos > $sepPos ) {
				return true;
			}
		}

		return false;

	}

}
