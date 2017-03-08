<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'admin_backup');

/** MySQL database username */
define('DB_USER', 'a2zbackupdb');

/** MySQL database password */
define('DB_PASSWORD', 'a2zonline@123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'a7P8WJ8KptOqK4T18USdNG8qvaVRJe67ZDnY9Iqd9SKawQHBaEET4Tht9ZDL6ZTa');

define('SECURE_AUTH_KEY',  'FtM2tkySQ02ueVjvGq8EpodQRZS21CpIpW5RcPL6Zt6IImnbLRPne3M9rUO82gFT');

define('LOGGED_IN_KEY',    'rR2Vc2kbFBrjc579Y1sFi7FbIWWwYojLB4H7R298QaCVOSYfYRdzv05X2EmnFxJF');

define('NONCE_KEY',        'AeKoFeCa4kAojBCMxx3oHsxbVjcIzPuQlf1PkRSZVl4mXDoYc9o9aBxi5wWPlApf');

define('AUTH_SALT',        'Q6PNTvTbEdvjigelMrzhSE7swDBdWMRZWCeEGEvZJbUGYJDuNcP2crYcUfScFgpJ');

define('SECURE_AUTH_SALT', 'KGLvkK69H6lTo3Fp7kstMgheGsCcKi8gcYUIcwTJafztS1g5sGaRjNqqKtjbozJW');

define('LOGGED_IN_SALT',   'uXTQFSv1f3Ht3Vs7K0ZddwbAMPIllU44EsZATXsqWYCeHL7Ihv5yk6VWGlCHbisg');

define('NONCE_SALT',       'gQFqrVPCHDsjTLfDqL2KevCZtQFjSAX59eYZSN7xp75jYVaYqW0TCzql973HVhGg');



/**

 * Other customizations.

 */

define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0755);
//define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');
//DEFINE('WP_TEMP_DIR','../../tmp')



/**

 * Turn off automatic updates since these are managed upstream.

 */

define('AUTOMATIC_UPDATER_DISABLED', true);



/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');