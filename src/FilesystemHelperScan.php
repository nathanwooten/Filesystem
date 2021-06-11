<?php

namespace nathanwooten\Filesystem;

use nathanwooten\Filesystem\{

	FilesystemFilterDirectory,
	FilesystemFilterInterface,
	FilesystemTraitImplode,
	FilesystemTraitNormalize

};

use Exception;
use OutOfBoundsException;

class FilesystemHelperScan
{

	use FilesystemTraitExplode;
	use FilesystemTraitImplode;
	use FilesystemTraitNormalize;

	public function scan( $readable, array $filters = [] ) {

		$scan = [];

		if ( is_array( $readable ) ) {
			$readable = $this->implode( $readable );
		}

		if ( ! is_readable( $readable ) ) {

			throw new Exception( 'Not readable for scan' );
		}

		foreach ( scandir( $readable ) as $key => $item ) {

			$item = $this->apply( $item, $filters );

			if ( $item ) {
				$scan[ $key ] = $item;
			}
		}

		return $scan;

	}

	public function apply( $item, array $filters )
	{

		if ( empty( $item ) ) {
			return;
		}

		foreach ( $filters as $filter ) {

			if ( is_string( $filter ) ) {
				if ( ! class_exists( $filter ) || ! in_array( __NAMESPACE__ . '\\' . 'FilesystemFilterInterface', class_implements( $filter ) ) ) {

					throw new OutOfBoundsException( 'Invalid filter' );
				}
				$filter = new $filter;
			}

			$item = $filter( $item );
		}

		return $item;

	}

	public function iterateScan(
		$readable,
		$filters = [
			'nathanwooten\Filesystem\FilesystemFilterDirectoryNot',
			'nathanwooten\Filesystem\FilesystemFilterDots'
		],
		$iteration = []
	) {

		$dirs = $this->scan( $readable, $filters );

		$rArray = $this->explode( $readable );

		foreach ( $dirs as $key => $dir ) {

			$norm = $this->normalize( $readable );
			if ( is_array( $norm ) ) {
				$norm = implode( '', $norm );
			}

			$childReadable = $norm . $dir;
var_dump( $childReadable );
			$it = $this->iterateScan( $childReadable, $filters );

		}

		$list = $iteration;
		return $list;

	}


}
