<?php
/**
 * WP-Bonusly-API (https://bonus.ly/api)
 *
 * @package WP-Bonusly-API
 */

/*
* Plugin Name: WP Bonusly API
* Plugin URI: https://github.com/wp-api-libraries/wp-bonusly-api
* Description: Perform API requests to Bonusly in WordPress.
* Author: imFORZA
* Version: 1.0.0
* Author URI: https://www.imforza.com
* GitHub Plugin URI: https://github.com/wp-api-libraries/wp-bonusly-api
* GitHub Branch: master
*/

/* Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Check if class exists. */
if ( ! class_exists( 'BonuslyAPI' ) ) {

	/**
	 * BonuslyAPI API Class.
	 */
	class DBonuslyAPI {

		/**
		 * Bonusly API Key
		 *
		 * @var string
		 */
		static private $api_key;

		/**
		 * BaseAPI Endpoint
		 *
		 * @var string
		 * @access protected
		 */
		protected $base_uri = 'https://bonus.ly/api/v1/';


		/**
		 * __construct function.
		 *
		 * @access public
		 * @return void
		 */
		public function __construct( $api_key ) {

			static::$api_key = $api_key;
		}

		/**
		 * Fetch the request from the API.
		 *
		 * @access private
		 * @param mixed $request Request URL.
		 * @return $body Body.
		 */
		private function fetch( $request ) {

			$response = wp_remote_get( $request );
			$code = wp_remote_retrieve_response_code( $response );

			if ( 200 !== $code ) {
				return new WP_Error( 'response-error', sprintf( __( 'Server response code: %d', 'text-domain' ), $code ) );
			}

			$body = wp_remote_retrieve_body( $response );

			return json_decode( $body );

		}

		/**
		 * Get Bonuses.
		 *
		 * @access public
		 * @return void
		 */
		function get_bonuses() {

			$request = $this->base_uri . 'bonuses?access_token=' . static::$api_key;

			return $this->fetch( $request );

		}

		/**
		 * Get Users.
		 *
		 * @access public
		 * @return void
		 */
		function get_users() {

			$request = $this->base_uri . 'users?access_token=' . static::$api_key;

			return $this->fetch( $request );

		}

		/**
		 * Get Company Info.
		 *
		 * @access public
		 * @return void
		 */
		function get_company_info() {

			$request = $this->base_uri . 'companies/show?access_token=' . static::$api_key;

			return $this->fetch( $request );

		}

	}
}
