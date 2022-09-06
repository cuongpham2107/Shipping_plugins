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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hoctap' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
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
define( 'AUTH_KEY',         '6U#2U?~0UF^-W-)Wd3 bwQ%{U{DVO;]0P(>ii1vO}S,ehUE.T3B;Rb{l)+*;8,}j' );
define( 'SECURE_AUTH_KEY',  'I}d}gGAjjjrBq-HK~QT@7#i-Wbm~6R_+ubJJ_lx$2WvU I8I.WZI/Dd?es8<}KQ-' );
define( 'LOGGED_IN_KEY',    'R`y,7F78h>PboJ@ol5N~L)3k^9A(P2Kz/kKAsOn6~3NB0.ox(!snsQqT{B`RZcBN' );
define( 'NONCE_KEY',        'Z18a>678G~Y$&N/,[{ @x/eCDISxt}_aO`[C#WbYaN({k?|dosn6vGwJv;g>+w;^' );
define( 'AUTH_SALT',        '-l1myTuo!.f1YC43EE[~ANU)T>MBD={WES7dY[}@OEpw9@Sk3o}2pxz%Ea4SC[`n' );
define( 'SECURE_AUTH_SALT', 'pf7REv61]0o~).]eJVV(R&hzgH,CWrR*7D9vjiM*b5Y-T3~K$ow!}AU[7% ^#GU2' );
define( 'LOGGED_IN_SALT',   'OCUgAHg}f:D=O(XHAx{_T86T[r;{Uq;zXKYq+`p/jl/.$Pg:xH&ia;X^z<dE&)(}' );
define( 'NONCE_SALT',       'nnj<s)hd<Gonv)28]:Ul=c@?1:rws?t|?Q.iw/lFQ?he tV?>ep`~:@5n[q=Y4GT' );

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
