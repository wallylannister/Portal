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
define( 'DB_NAME', 'portal' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '@V0:k<^JF: oj&s@(nPKv|;b~0[~l,/5Y29n VrCMcCH1]_wR>7F21(6Q#eEyxe2' );
define( 'SECURE_AUTH_KEY',  'K3U6SBo>KCh$Y`hdfX]bnPKMr`ZVv+u^uQ14ptnD`}%deC`g( rh&I{=4u%&-rxd' );
define( 'LOGGED_IN_KEY',    'uck9k)}dXF,-Z[I cz46Eu!naKH]&.B8oWlbj%pd41#[R3FT.AW502_L]x2++)-T' );
define( 'NONCE_KEY',        'b@J/HJe#0]UTts1`/<[/o.{wz@~sgdj=Q.eD7RW@>o@.eKvgn=n}.hkIIg%4$T_Y' );
define( 'AUTH_SALT',        '@U0c3=[JfG_gQcCmGyu9b,}rs<X)D#q^UZ%GU^DTHO_3sy:mE64J#(|<#E?rP4Vb' );
define( 'SECURE_AUTH_SALT', '/by(d-s:7l;9~|z](R2Y,S2uarE=8BKIXRlUo5,D`J]eAw4DJ%qp6vz+O1jQ9[]T' );
define( 'LOGGED_IN_SALT',   'oM.OTC2FTh0*^1SwN8{XWs1:>C>vh1BJ8HQH/iwdmg@?}[_#kAm)4?NY[TvxO?]]' );
define( 'NONCE_SALT',       'Z!%h&QUR&+/4k?ZsvS^*pD55io{m->I,6rQpT=W.f.@+%Z-Xaq<f21rU<!kn $=f' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'p_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
