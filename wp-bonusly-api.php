<?php
/**
 * WP-Bonusly-API
 * https://bonusly.gelato.io/docs/
 *
 * @link https://bonus.ly/api API Docs
 * @link https://bonusly.gelato.io/docs/ API Docs on Gelato.io
 * @package WP-API-Libraries\WP-Bonusly-API
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
	 *
	 * @link https://bonus.ly/api API Docs
	 * @link https://bonusly.gelato.io/docs/ API Docs on Gelato.io
	 */
	class BonuslyAPI {

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
				return new WP_Error( 'response-error', sprintf( __( 'Server response code: %d', 'wp-bonusly-api' ), $code ) );
			}

			$body = wp_remote_retrieve_body( $response );

			return json_decode( $body );

		}

		/* ANALYTICS. */


		/**
		 * get_analytics_standouts function.
		 *
		 * @access public
		 * @param string $role (default: '') Role
		 * @param string $value (default: '') Value
		 * @param string $limit (default: '') Limit
		 * @param string $period (default: '') Period
		 * @return void
		 */
		public function get_analytics_standouts( $role = '', $value = '', $limit = '', $period = '' ) {

			$request = $this->base_uri . 'analytics/standouts' . static::$api_key;

			return $this->fetch( $request );

		}


		/**
		 * get_analytics_trends function.
		 *
		 * @access public
		 * @return void
		 */
		public function get_analytics_trends() {

			$request = $this->base_uri . 'analytics/trends' . static::$api_key;

			return $this->fetch( $request );

		}

		/* API KEYS. */


		/**
		 * get_apikeys function.
		 *
		 * @access public
		 * @param string $user_id (default: '')
		 * @return void
		 */
		public function get_apikeys( $user_id = '' ) {

		}

		/**
		 * add_apikey function.
		 *
		 * @access public
		 * @param mixed $label
		 * @param string $read_only (default: '')
		 * @param string $user_id (default: '')
		 * @return void
		 */
		public function add_apikey( $label, $read_only = '', $user_id = '' ) {

		}

		/**
		 * delete_apikey function.
		 *
		 * @access public
		 * @param mixed $apikey_id
		 * @return void
		 */
		public function delete_apikey( $apikey_id ) {

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

		/**
		 * get_bonuses_rss_feed function.
		 *
		 * @access public
		 * @return void
		 */
		function get_bonuses_rss_feed() {

			return 'https://bonus.ly/api/v1/bonuses.atom?access_token=' . static::$api_key;
		}

		/* BONUSES. */

		function create_bonus( $data ) {

		}

	}
}
