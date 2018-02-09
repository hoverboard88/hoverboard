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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'wordpress');

/** MySQL hostname */
define('DB_HOST', 'database');

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
define('AUTH_KEY',         'e>G@#.ywZ|{,9jY9uZPVM4I9bJhrW>0t<G.HK76U|s7D&ors)eahH~*avv:1rwq.');
define('SECURE_AUTH_KEY',  'X3W3=(=c28aV#DOH[6edPdn]t~ewr3PeaH#s;LJTRm1r~Kmai>Z?b14]{jGEyFdK');
define('LOGGED_IN_KEY',    'khx!Y!|)<umb%kZ$.,o}/x{9d%b}^r>#4WLtYyc% |!yj3Fl+*.tmpMwc-kqE2&#');
define('NONCE_KEY',        '>OCrGiE-6So/H:+J(X=F(%8LM2bUS-xLz)Jr.l*hCw|8i0i9m$]93&2jyu0LZ7%9');
define('AUTH_SALT',        ')#m;ex|(I-P!:;$c));iso4t6LS7$HlQ&naUbYLY&<jdETIB-3`HY0Q.hBHo#A[d');
define('SECURE_AUTH_SALT', '!Zq)y?77K_4twOFf]_~6bu. p:p`?>$>4)f!}x$?_n+^8O&-#-tN2Vo%3A~U5JVd');
define('LOGGED_IN_SALT',   'W7_XvmkERYaXk(t+Sv7Tw>hT >SM_XtQ[K`zY|y}PtUJ)%IM?,G U_75C}e]GfQa');
define('NONCE_SALT',       'l_A*1Wfa8g)i[M&1,ki$>pvd}@xK/^>7lViEB7P)VLFrtgqv!N]C)m#&J@=&M@_:');

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
