<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Magic_Customize' ) ) :

	/**
	 * The main Magic_Customize class
	 */
	class Magic_Customize {

		public function __construct() {
		}
	}
endif;

return new Magic_Customize();
