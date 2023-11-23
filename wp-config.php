<?php

/**

 * The base configuration for WordPress

 *

 * The wp-config.php creation script uses this file during the installation.

 * You don't have to use the web site, you can copy this file to "wp-config.php"

 * and fill in the values.

 *

 * This file contains the following configurations:

 *

 * * Database settings

 * * Secret keys

 * * Database table prefix

 * * ABSPATH

 *

 * @link https://wordpress.org/documentation/article/editing-wp-config-php/

 *

 * @package WordPress

 */


// ** Database settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'bitnami_wordpress' );


/** Database username */

define( 'DB_USER', 'bn_wordpress' );


/** Database password */

define( 'DB_PASSWORD', 'f4dbea7271a3d58c0262cf08b268a7b142a6039916cfde9bd61f5fabf150fd50' );


/** Database hostname */

define( 'DB_HOST', '127.0.0.1:3306' );


/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );


/** The database collate type. Don't change this if in doubt. */

define( 'DB_COLLATE', '' );


/**#@+

 * Authentication unique keys and salts.

 *

 * Change these to different unique phrases! You can generate these using

 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.

 *

 * You can change these at any point in time to invalidate all existing cookies.

 * This will force all users to have to log in again.

 *

 * @since 2.6.0

 */

define( 'AUTH_KEY',         ';+%vR|;$m396(z-30xKn~~!sodfHjK[WR_PTIrE^a/@YyP7Cr23bZUY.btpbO@w1' );

define( 'SECURE_AUTH_KEY',  'fuJb{e2|l-M*j(A/!N2B.yH*]nNF:Tc 8D62Xc1l#nTa]2XnCe#Qk9S?cK}P5{VX' );

define( 'LOGGED_IN_KEY',    'MM8qy6{zyIyHG `$q8~,<4ZS4n32fju41YRx%0&y3We*?5v&v](&m8#/@zSr9]5d' );

define( 'NONCE_KEY',        'l%v;2b#HM0BG!]@3S]2yRwUwOYnD33c_b)Q|/t6HilG^-=4`M2O5bqNjZ-b~:S_H' );

define( 'AUTH_SALT',        ',k4E$Qsx_vv`mSf>SNy+&?6uA25^ve;&sTC#*zg9{DWZt;rB%6Qn>?hFfRYL}Rur' );

define( 'SECURE_AUTH_SALT', 'ka7Q+hf%^E2]ZI/<%Dye6:$QAJd46qR7j|L$vnX2c^v,<TJ,@_V7t ?O6~NuW@=`' );

define( 'LOGGED_IN_SALT',   'l2sKRSQtccrBI ,YgZ H%xN_9GAyYgX?Q4c @Ww9)IxacDbkN{jQM^hz3#e!aNus' );

define( 'NONCE_SALT',       'a_@-_czsuZ_X|gx{GN*e)pa(=g{ys^QW_kUho,>M-(Mk!sJ]>Cn2w<=IY:R7Bfg+' );


/**#@-*/


/**

 * WordPress database table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix = 'wp_';


/**

 * For developers: WordPress debugging mode.

 *

 * Change this to true to enable the display of notices during development.

 * It is strongly recommended that plugin and theme developers use WP_DEBUG

 * in their development environments.

 *

 * For information on other constants that can be used for debugging,

 * visit the documentation.

 *

 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/

 */

define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
