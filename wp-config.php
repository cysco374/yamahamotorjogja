<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/u9809956/public_html/hondamotorjogja.com/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
// define('DB_NAME', 'u9809956_hndamtr');
define('DB_NAME', 'hndamtr');

/** MySQL database username */
// define('DB_USER', 'u9809956_cysco');
define('DB_USER', 'cysco');

/** MySQL database password */
// define('DB_PASSWORD', 'prakoso374');
define('DB_PASSWORD', 'cpx374');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'k|A*44|N-B[u/,aeVmqT)@K;!az-M*z(N`:n%kowxBt{~o-z_+hca`6EVW+m!+?/');
define('SECURE_AUTH_KEY',  'LxtadR59A?Vh|g!j+{*XI[!yq{/>Ek-mnFY~#&cEvD80lRnbc~a.{s:*!;gNoB;z');
define('LOGGED_IN_KEY',    ';m+OVV:AIW]7M1=-,?S8Cz0+f8_fkP:SHK!V+6NHK{-`Fw:s8YJ:r[h}-.Q{]JEE');
define('NONCE_KEY',        'N$|0V-_MSg*=VdNHB||0H/|uH-1LB16s%Y:.V>Q|PZT}t9G;PG?PM|wsxN]WD/ 3');
define('AUTH_SALT',        '#@~%Hv{a_V*ifQ7{*K-M.yu_R:$_~WJT+ba*)A#Z[pRq*,xI) (3j**?VWX3i9&[');
define('SECURE_AUTH_SALT', 'sLc;<_-m?^7+bh;TW4VPPNY,7;-:(}}u$yNks0qV~HA(21bbxD>0cUpsHr]PDM#!');
define('LOGGED_IN_SALT',   '3EUi.K-E#)DULY+NZu)*Wm2Sda};O2e,I>8uQ<xPZ#9:eDZr:xU/`OG%|?l:164%');
define('NONCE_SALT',       '>#i*btMUb+2Aal@q%B(DVaPMI==XUf$Qn6@|F]*{s(%MmbIGi0a5CffOyt!*m=Tm');

/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ym_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
