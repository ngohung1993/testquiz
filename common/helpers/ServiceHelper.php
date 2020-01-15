<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 7/11/2018
 * Time: 8:19 PM
 */

namespace common\helpers;

class ServiceHelper {

	/**
	 * @return array
	 */
	public static function get_browser() {

		$u_agent  = $_SERVER['HTTP_USER_AGENT'];
		$b_name   = 'Unknown';
		$platform = 'Unknown';
		$version  = null;
		$ub       = null;

		if ( preg_match( '/linux/i', $u_agent ) ) {
			$platform = 'linux';
		} elseif ( preg_match( '/macintosh|mac os x/i', $u_agent ) ) {
			$platform = 'mac';
		} elseif ( preg_match( '/windows|win32/i', $u_agent ) ) {
			$platform = 'windows';
		}

		if ( preg_match( '/MSIE/i', $u_agent ) && ! preg_match( '/Opera/i', $u_agent ) ) {
			$b_name = 'Internet Explorer';
			$ub     = 'MSIE';
		} elseif ( preg_match( '/Firefox/i', $u_agent ) ) {
			$b_name = 'Mozilla Firefox';
			$ub     = 'Firefox';
		} elseif ( preg_match( '/Chrome/i', $u_agent ) ) {
			$b_name = 'Google Chrome';
			$ub     = 'Chrome';
		} elseif ( preg_match( '/Safari/i', $u_agent ) ) {
			$b_name = 'Apple Safari';
			$ub     = 'Safari';
		} elseif ( preg_match( '/Opera/i', $u_agent ) ) {
			$b_name = 'Opera';
			$ub     = 'Opera';
		} elseif ( preg_match( '/Netscape/i', $u_agent ) ) {
			$b_name = 'Netscape';
			$ub     = 'Netscape';
		}

		$known   = array( 'Version', $ub, 'other' );
		$pattern = '#(?<browser>' . join( '|', $known ) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

		preg_match_all( $pattern, $u_agent, $matches );

		$i = count( $matches['browser'] );

		if ( $i != 1 ) {
			if ( strripos( $u_agent, 'Version' ) < strripos( $u_agent, $ub ) ) {
				$version = $matches['version'][0];
			} else {
				$version = $matches['version'][1];
			}
		} else {
			$version = $matches['version'][0];
		}

		if ( $version == null || $version == '' ) {
			$version = '?';
		}

		return array(
			'userAgent' => $u_agent,
			'name'      => $b_name,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'   => $pattern
		);
	}

	/**
	 * @return array
	 */
	public static function get_logs() {

		$time    = date( 'Y-m-d H:i:s', time() + 7 * 3600 );
		$browser = self::get_browser();
		$ip      = $_SERVER['REMOTE_ADDR'];

		return [ 'time' => $time, 'browser' => $browser['name'] . '(' . $browser['version'] . ')', 'ip' => $ip ];
	}

}