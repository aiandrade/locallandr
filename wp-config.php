<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '6jt-7WL*gt`meo @0y?(,trj~#[#aZszDMT2Y+@M49:ZziR*W,4j-s4p6#g3_#,1');
define('SECURE_AUTH_KEY',  'c>v}5oCbo|jEEo.yE1nuHT6.u`u#PNPJneVSG~y><d^GDs~=PF?J/w+O+PQd7/Ra');
define('LOGGED_IN_KEY',    ']JI<bZJx70N$;nZxykBYVt`6< $:?`XeB,y`-8<)eu)pfR$I[E#C(x!I[Qo(~Ffv');
define('NONCE_KEY',        'b%(/BYsw)j U_69~HdEuqh5HR]4hUfu1[)vhF-yM3$yc4XjaP{p-{8vyFLr^ORsA');
define('AUTH_SALT',        '@TwwgeK$U8r{[kbXAc=EP$aoH%W.B,z~5:I|RH~NDV,-GZiD4_2>DfJ!Fb_!^mcA');
define('SECURE_AUTH_SALT', '!TxR,{}{DN!`f|KGyKaW@p.5hx_|k/#D)L:F{xG3=0Bq,L.i8J0U}K=QGYfe-`(}');
define('LOGGED_IN_SALT',   '=:{0;Kb:c2EQfGKa^l:[|(goh%ac?5gAb{uPhT53QU-T{.Q~+$V&%N]!u,`lcVC}');
define('NONCE_SALT',       'Cs`$D<%QFyFHa9ibk&0fY1#)9~ui|o*pe.@(8[wyT=fFa+%`K0)>A* pnFpmx!Ol');

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
