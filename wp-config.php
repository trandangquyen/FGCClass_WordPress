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
if($_SERVER["SERVER_NAME"]==="localhost") {
	define('WP_SITEURL', 'http://localhost:8080/FGCClass_WordPress');
	define('WP_HOME', WP_SITEURL);
	define('DB_NAME', 'wordpress_fgc');

	/** MySQL database username */
	define('DB_USER', 'root');

	/** MySQL database password */
	define('DB_PASSWORD', '');

	/** MySQL hostname */
	define('DB_HOST', 'localhost');
}elseif($_SERVER["SERVER_NAME"]==="192.168.1.79"){
    define('WP_SITEURL', 'http://192.168.1.79:8080/FGCClass_WordPress');
    define('WP_HOME', WP_SITEURL);
    define('DB_NAME', 'wordpress_fgc');

    /** MySQL database username */
    define('DB_USER', 'root');

    /** MySQL database password */
    define('DB_PASSWORD', '');

    /** MySQL hostname */
    define('DB_HOST', 'localhost');

}elseif(strpos($_SERVER["SERVER_NAME"], 'dangquyen.wdev.fgct.net') !== false) {
	define('WP_SITEURL', 'http://dangquyen.wdev.fgct.net/FGCClass_WordPress/');
	define('WP_HOME', WP_SITEURL);
	define('DB_NAME', 'dangquyen_fgcclass');

	/** MySQL database username */
	define('DB_USER', 'dangquyen');

	/** MySQL database password */
	define('DB_PASSWORD', 'quyen.1987');

	/** MySQL hostname */
	define('DB_HOST', 'localhost');
} else {
	define('WP_SITEURL', 'https://fgcquiz.herokuapp.com');
	define('WP_HOME', WP_SITEURL);
	/** The name of the database for WordPress */
	//define('DB_NAME', 'd8v202ntiov39f'); // psql
	define('DB_NAME', 'heroku_d345e83fb3204bb'); // cleardb

	/** MySQL database username */
	//define('DB_USER', 'nxuqrnffdmrlhf'); // psql
	define('DB_USER', 'b0f9023be667b4'); // cleardb

	/** MySQL database password */
	//define('DB_PASSWORD', 'bac61678c83f6737b5bcc36b6edb5a3b8c11b29d1efe09664a8a5b8c27111b04'); // psql
	define('DB_PASSWORD', '87a70f51'); // cleardb

	/** MySQL hostname */
	//define('DB_HOST', 'ec2-50-19-218-160.compute-1.amazonaws.com:5432'); // psql
	define('DB_HOST', 'us-cdbr-iron-east-03.cleardb.net');
}
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
define('AUTH_KEY',         'uw9qXLF)(L(v}.48U>G2jyh,LAj_0rlR&K&Z#@z[_jLfWMyz303;#vs!LX:S~x/]');
define('SECURE_AUTH_KEY',  'k8$h6P$EzPtQ*-6kA|)aWOWXt!eYDJZQYfcK,<jcI&Bwb;%-!;iwbdI~}IM.!7`B');
define('LOGGED_IN_KEY',    '7P>t#||Y=((i1p]DZB^DK!o/D?_V[&w{DyG2`L!`qJa ?#X&(e,Q jfAW#uS~9D&');
define('NONCE_KEY',        '<.Ldmt<_lmC2x3R[IQ.Lt`{YmIgPJ$Ym;u#F~`>@_q]V9+0=O`iejV8jf0gXw#xz');
define('AUTH_SALT',        '0;wp-8M7xew^}{>$5:Zoc(Z<$?y`Ouo|$C bJP?*LqTDyO][NFC[$2/C63$ul?{D');
define('SECURE_AUTH_SALT', '!7*3}{gSq8)BtGN<]%dDD$*a{14x[GWA(j:_0l2!~Y?Lu,Z@UV>^uphbJj2!6zQV');
define('LOGGED_IN_SALT',   ':YFU!AsBkZWrMgp~[+S/qcggWb!lumA~]?0F6li<8G4]sNTz!*{K5VVPZFZt&ID.');
define('NONCE_SALT',       '2E(b# yrql$L5`6p/af_FV;E-jj7rG15GNQxvid2mW++ N;e|4/pp%:k(2MA6H-<');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
