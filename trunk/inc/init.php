<?php

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "Tomorrow");
define("DB_NAME", "inventario");

define('TABLE_PREFIX', 'dvd_');
define('SITE_URL', 'http://localhost/rinventory/');

define('TBL_CUSTOMER', TABLE_PREFIX . 'cliente');
define('TBL_COLOR', TABLE_PREFIX . 'color');
define('TBL_DEPARTMENT', TABLE_PREFIX . 'departament');
define('TBL_FOR', TABLE_PREFIX . 'for');
define('TBL_ITEM', TABLE_PREFIX . 'item');
define('TBL_ITEM_TYPE', TABLE_PREFIX . 'type_item');
define('TBL_LOT', TABLE_PREFIX . 'lote');
define('TBL_MARKER', TABLE_PREFIX . 'marker');
define('TBL_PACKAGE', TABLE_PREFIX . 'paquete');
define('TBL_USER', TABLE_PREFIX . 'user');
define('TBL_USER_ONLINE', TABLE_PREFIX . 'user_online');
define('TBL_VELOCITY', TABLE_PREFIX . 'velocity');
define('TBL_PURCHASE', TABLE_PREFIX . 'purchase');
define('TBL_PURCHASE_DETAIL', TABLE_PREFIX . 'purchase_detail');
define('TBL_PURCHASE_PAYMENT', TABLE_PREFIX . 'purchase_payment');

define('SB_BREADCRUMB', '&raquo;');
define('SB_CURRENCY', 'Bs. ');

/**
 * This boolean constant controls whether or
 * not the script keeps track of active users
 * and active guests who are visiting the site.
 */
define("TRACK_VISITORS", false);

/**
 * Timeout Constants - these constants refer to
 * the maximum amount of time (in minutes) after
 * their last page fresh that a user and guest
 * are still considered active visitors.
 */
define("USER_TIMEOUT", 10);
define("GUEST_TIMEOUT", 5);

/**
 * Cookie Constants - these are the parameters
 * to the setcookie function call, change them
 * if necessary to fit your website. If you need
 * help, visit www.php.net for more info.
 * <http://www.php.net/manual/en/function.setcookie.php>
 */
define("COOKIE_EXPIRE", 60*60*24*100);  //100 days by default
define("COOKIE_PATH", "/");  //Avaible in whole domain

/**
 * Special Names and Level Constants - the admin
 * page will only be accessible to the user with
 * the admin name and also to those users at the
 * admin user level. Feel free to change the names
 * and level constants as you see fit, you may
 * also add additional level specifications.
 * Levels must be digits between 0-9.
 */
define("ADMIN_NAME", "admin");
define("GUEST_NAME", "Guest");
define("ADMIN_LEVEL", 9);
define("USER_LEVEL",  1);
define("GUEST_LEVEL", 0);

/**
 * Email Constants - these specify what goes in
 * the from field in the emails that the script
 * sends to users, and whether to send a
 * welcome email to newly registered users.
 */
define("EMAIL_FROM_NAME", "YourName");
define("EMAIL_FROM_ADDR", "youremail@address.com");
define("EMAIL_WELCOME", false);
?>