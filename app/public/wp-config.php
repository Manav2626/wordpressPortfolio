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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          'Z)|<0-Yu2!M?{oz:O]zEC^!n9hI[,V`4;)YPT29oiu|Ua<10@SwS=>z!mRRPJgcc' );
define( 'SECURE_AUTH_KEY',   'n;l8xFOPG&))~`e8ce:Z7`xzFt)m4[%/IdLqBmgol1|f/2<`<mAJ.7!5qq9nC :7' );
define( 'LOGGED_IN_KEY',     'fy/<o^~XCdaUQrjPYXTsFsJxe:ZX5+UjAmg-pz.ZSIC!T%6wR=?8PFgz&nrc/fz!' );
define( 'NONCE_KEY',         ')H&x70lOo#)%.4aMtI#:Agcgrc=!LjY`k^^(Wi_Yas2>r0GuDu0xAPo8XsixJ}TL' );
define( 'AUTH_SALT',         '&Tb,2Fkn>OwKo9F9wP,iFpz;WL?@y[]mZ&Gs@d/kF hcDJAf{&2f~skc|p^(Y8<^' );
define( 'SECURE_AUTH_SALT',  '7M%YgvZC2?SmdD^Kupb-?=E7?[|4;0Wi?<n!ka=h^A;Y.e*W],GL:*lG!untGkH0' );
define( 'LOGGED_IN_SALT',    '~Lx$xAg(3?3GCVE:C*!rZn#1Z_,UK0V@WM{?x`<E<Ok<Bmvc;}!}:vaK([2N2R#&' );
define( 'NONCE_SALT',        'ex{a;TVq!%Vz3lSX}Bm@A5!J?S3PBq=Cu;f{a^n.p>Wh:r}y/:irVjktkg9Er7Tk' );
define( 'WP_CACHE_KEY_SALT', '-j4!ZxT?K@a7`-xP)a(g#RpxYd7#uzrYn&:f()Fvf}jk9M0f854S:$$QlU0}F<>(' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
