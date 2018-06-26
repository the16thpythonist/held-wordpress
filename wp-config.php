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
//define('DB_HOST', 'localhost');
define('DB_HOST', 'mariadb');
/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');
/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('WP_MEMORY_LIMIT', '512M');
define('FS_METHOD', 'direct');
//define('WP_HOME', 'http://localhost/tmp/ufo');
//define('WP_SITEURL', 'http://localhost/tmp/ufo');
define('WP_HOME', 'http://held-wordpress-web.kaas.kit.edu');
define('WP_SITEURL', 'http://held-wordpress-web.kaas.kit.edu');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^$-j-^#m|U/^v8d_+5yt6y`e3/CP5|$=1Y&mh$M[E?<`U6d_~urQ0h@./<m}NREg');
define('SECURE_AUTH_KEY',  '2W8jpeZriXa@*yl?7H`)lVo)yDpTT}B?Mj-<ev)*pH,$XXC(IRJBbCKBYvsIc4E%');
define('LOGGED_IN_KEY',    'B-VXI[Di[G]}9evv~%Ltq:PdnYvW&V%158|s^[[FgY=^!f#osWh&aJA<v0I2$Y>+');
define('NONCE_KEY',        '9P}(YoKIyfs?m@i,aq6zSC+`5/]T?1b!l+!w8rl,vAF/:%to7gT)(tUxFrgJpJNj');
define('AUTH_SALT',        'A|z;5SVvNT5Zpq$1_b-[iZ:$@#Om7LS^yD}`/c#{$pI(q70arbQ*`DSHxc)Z$XoS');
define('SECURE_AUTH_SALT', '2q0a=ic!GjkYV= jP|$LUoF^X+ML;ZgV;&.#`kp#uvsRI{P :ss$U`w2(|y#NQxj');
define('LOGGED_IN_SALT',   '[GH.e0]79W`<-hXjWu#d?:@DwnXCPO1BNmsbo:X;&O_VG(KGQ-YHFsv$K%VWTjjZ');
define('NONCE_SALT',       '56~:+hG3({,[UD%D>x!cI.[))pMpWIf9{pTf=u^b|Zv)Bn]Y]f^dqT xp[Q+9d|M');
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
define('WP_DEBUG', true);
set_time_limit(60 * 60 * 12);
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
