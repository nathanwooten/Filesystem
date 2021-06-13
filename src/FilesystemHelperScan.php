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

		$scan = array_values( $scan );

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

	public function structure( $directory, $filters = [ 'nathanwooten\Filesystem\FilesystemFilterDirectoryNot', 'nathanwooten\Filesystem\FilesystemFilterDots' ], ) {





	}

	public function structure(
		$readable,
		$filters = [
			'nathanwooten\Filesystem\FilesystemFilterDirectoryNot',
			'nathanwooten\Filesystem\FilesystemFilterDots'
		],
		array $structure = null, 
		int $level = 0
	) {

		if ( ! is_readable( $this->implode( $readable ) ) ) {
			throw new OutOfBoundsException( 'Readable must exists and respond to file_get_contents' );
		}

		$dirs = array_values( $this->scan( $readable, $filters ) );

		++$level;

		if ( ! empty( $dirs ) ) {

			$structure = $current = empty( $structure ) ? [] : current( $values );

			$scan = $dirs;
			foreach ( $dirs as $key => $dir ) {

				$norm = $this->normalize( $readable );
				if ( is_array( $norm ) ) {
					$norm = implode( '', $norm );
				}

				array_shift( $current );
				$contents = $this->structure( $norm . $dir, $filters, $current, $level );

				$structure[ $dir ] = $contents;
				if ( count( $dirs ) -1 === $key ) {
					--$level;
					for ( $i = -1; $i < $level; ++$i ) {

						$parent = array_search( $structure, ;
					}


				}
			}

		}

var_dump( $return );

		return $return;

	}

}
