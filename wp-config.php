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
define('DB_NAME', 'wp_b2b-e-commerce');
define('FS_METHOD','direct');
/** MySQL database username */
define('DB_USER', 'psuser');

/** MySQL database password */
define('DB_PASSWORD', 'internet2014');

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
define('AUTH_KEY',         'o,2XmAGj*0&iw{at`%MAk=A/t7PwMN5@EuH6l&Xi3f1{wAl~uOHQ=w=V)|%z4.g|');
define('SECURE_AUTH_KEY',  'qKa`X*p[x]xo1ho<(k*1.)v[?7|vWsFQ~,<E*lq2M,a<Uy<&Ik9VfT> jN[_{n@5');
define('LOGGED_IN_KEY',    '&j}&W( iuN?%;.T=}Ir0|#FK|J+iotPbgE5wd[X<CEO>M#S*2b]ff e}_PJQazi?');
define('NONCE_KEY',        'EI_UdonS;pIV2CB7RkMVu{N,DJQ5/?K#6sAHBw4,7HIc 2ybnfaU>SHN/()ZP))x');
define('AUTH_SALT',        '!by&wC5EYqlk(xm],lLF.p%flA%e%m<!O-4ec@?W2lo6~OiOWGW5D5psDj]p_{iF');
define('SECURE_AUTH_SALT', '+];=p:B-M.&ys;nhEbtPDofa;zV:mOg&S@==9V)89}k)XUjzFuenZk6UgYTyqC[S');
define('LOGGED_IN_SALT',   'kB;U.4pQohJT]*yq8Ml*I7`}p^ x$GhS+v&<!1?j3;7;~dE8RC1OJvs5m3Hq_qf[');
define('NONCE_SALT',       'RL_9&wu;aM@A&[.,*vh4`#/X)=u0_rv~yN|uEZenVh_ywz[_,g!-GtX4a2,I$`pw');

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
