<?php

namespace nathanwooten\Filesystem\Functions;

use nathanwooten\Filter\Filter;

use Exception;

function get_filter( $filter )
{

	if ( ! $filter instanceof Filter ) {

		if ( is_string( $filter ) ) {

			if ( class_exists( $filter ) && in_array( 'nathanwooten\Filter\Filter', class_implements( $filter ) ) ) {

				$filter = new $filter;

			} else {

				$filter = 'nathanwooten\Filter\Filter' . $filter;

				if ( class_exists( $filter ) && in_array( 'nathanwooten\Filter\Filter', class_implements( $filter ) ) ) {

					$filter = new $filter;

				} else {

					throw new Exception( 'Can not make object from class: ' . $filter );
				}
			}
		} else {

			throw new Exception( 'Unknown filter type' );
		}

	}

	return $filter;

}
