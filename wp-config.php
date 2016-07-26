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
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'devpub123/');

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
define('AUTH_KEY',         'e7RvuX-xRtlh)#*r!b4K{(6YlH7XzQ)y`D?gtR(mhg:z?S84L,WNc*r%a,3u-^2L');
define('SECURE_AUTH_KEY',  'IyZ_ue=5w|``z]58+#;&cIwX}J8:o248-Rc3 o0SPgEo{!R]AJ>0IF-kxaYl$q$2');
define('LOGGED_IN_KEY',    '$q:%7B5?HA}iEpkPP^LkCjQwP7xr@TC{WFYhuM#ZMr#{*>e.[Cb$ pGmosZg(I_[');
define('NONCE_KEY',        'B>gAZvn#+@l!v-Na+[7$@@st0:*$NI,k*tM@bxQCx7lK*aq?[d&[#4|3~Y903<&x');
define('AUTH_SALT',        'Uw$YXTt =T6Ii|>Z*Z$ZRY#+uV`&_JicDy64{?V<-SQY{7[L9Xuho~$RFte~Nv$n');
define('SECURE_AUTH_SALT', '>b-K:W|!oX8]=h-UAJ.Pa^N|}%PJy$xXNR2t}I>S1ZM@.h_p?wSGe#dP8z8PL5=_');
define('LOGGED_IN_SALT',   '.XV0B*Kk#iZeSr3bR55IiY!D/Rv+v/yT]+c]9{iVDa)Q;MVb}OBfHK:q!`_{4,oY');
define('NONCE_SALT',       'EMd[wv75hFM *@p#S=[*Y[z^c`HE?=fDfq |4j>Rv~i.nW,m#Z}*qx$jU31VRfcd');

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
