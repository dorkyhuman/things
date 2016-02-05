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
define('DB_NAME', 'herecopyDBcgudg');

/** MySQL database username */
define('DB_USER', 'herecopyDBcgudg');

/** MySQL database password */
define('DB_PASSWORD', 'TNCvFI9twn');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'Q{^crBM$r,QjA3I${*Pj<AjyI7Q^3<TnEXL+;eTi2Lui+Ib{*2iypexHa#+;at');
define('SECURE_AUTH_KEY',  'P.t*HW~l+6Ht*L2Hw#Od#5_HS-]ShOCO-|NdKo-GS-hwFV@>VBRs@JV!ozNY,0cJY');
define('LOGGED_IN_KEY',    ',j<7n^um+LeT.6mat6PEu<XLe;E6t_Sla]Dth+DWL+;eSm5PD-:dSl5K-p_KeS_1');
define('NONCE_KEY',        '$UIuiyET*;TjIu<Tj6Lx]*Pi2#6eyH6P*2<Xq;.6m*LAT.6]Tm6{Eu<$Lb2L9p.S');
define('AUTH_SALT',        ']q.THa1K9p_-KdW#91atD5OHx]aSlC5O~w[ZOl5[Gpd-K9W#-:hVpkZsC4N@v[Ysk');
define('SECURE_AUTH_SALT', 'YEq.TjX<AjXqAUIy{bQjaui;Hx]*Pi{*;eyH6P*2<9SL+;eWp2#Dti*PDW]*2ph-K');
define('LOGGED_IN_SALT',   'B^QBM3@jUBM7,vcTAM6.qbI3E,AbHT6.;+eqXAL{yfmTAI+.qepW9L2+#taiP;+.');
define('NONCE_SALT',       'L_t*eL2E;+iPaH5_;-lS9K1~epWD]5_pWhOC[5_oVhS8!lwdK1D[wdpWK0C[zgNZG');

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
define('WP_DEBUG', false);define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
