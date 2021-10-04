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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bela-pijamas' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         ')=2>Ebx]drtrS_`2ia ^uwC0!h[n1nZ%,Aa67:R!$ygmrG-F`}rQ>^D|w1U%;6QW' );
define( 'SECURE_AUTH_KEY',  '3qU!q0.c.t0X0b9:4#YquY)$Ai2=FzIYd1P<v`H1|Y!Y2g&j{Htjtf.[]0B@7:2i' );
define( 'LOGGED_IN_KEY',    '7M-&$05>(E+`EbuL~FVO14(`$q7=1>%(+z72aN~uMmsnBhPNWCs9ctHr&5X6=H9m' );
define( 'NONCE_KEY',        'QJ,+~ukvPmP5_o-?I6/Ig...$%7kLOUpb2j,DClGD?oqs%)F2vK5j?vW|fTl?iJv' );
define( 'AUTH_SALT',        '&bb>L-LqN^b?9*~Na$q:1QV;H:~OyI++R6q|GO,-gxb~G}EUb7*^[Ijj8yr6hZ;4' );
define( 'SECURE_AUTH_SALT', '?vwN2N0E;DqOMVkMLfk9AuDZYuv@<xL@x8W[KcGyD0+-d[(@Fz&.Ke@@e1P:+m!I' );
define( 'LOGGED_IN_SALT',   'l`? Dn2GU~i4-SG3^&!{s!7d{r>^bq)Q6<&**-0IIa)/$f{|RUDH`eY:v>.G(,hd' );
define( 'NONCE_SALT',       'XCr>{P>!vXYP(%R&AjeRju09b)ZY*Xj>/F6.>4+T @6cx&m.FWR4?A*B2Gp-et[A' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
