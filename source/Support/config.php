<?php

/**
 * DATABASE
 */

define("CONF_DB_HOST", "db");
define("CONF_DB_USER", "root");
define("CONF_DB_PASS", "a654321");
define("CONF_DB_NAME", "php");

/**
 * URLS
 */
define("CONF_URL_TEST", "http://www.localhost/fsphp-site");
define("CONF_URL_BASE", "http://www.cafecontrol.com.br");
define("CONF_URL_ADMIN", "/admin");
define("CONF_URL_ERROR", CONF_URL_BASE . "/404");


/**
 * DATES
 */
define("CONF_DATE_BR", "d/m.Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

/**
 * SESSION
 */
define("CONF_SES_PATH", __DIR__."/../../storage/sessions");

/**
 * MESSAGES
 */
define("CONF_MESSAGE_CLASS", "trigger");
define("CONF_MESSAGE_INFO", "info");
define("CONF_MESSAGE_SUCCESS", "success");
define("CONF_MESSAGE_WARNING", "warning");
define("CONF_MESSAGE_ERROR", "error");


/**
 * PASSWORD
 */

define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTIONS", ["cost" => 10]);

/**
 * EMAIL
 */
define("CONF_MAIL_HOST", "mailcatcher");
define("CONF_MAIL_PORT", 25);
define("CONF_MAIL_USER", "");
define("CONF_MAIL_PASS", "");
define("CONF_MAIL_SENDER", ["name" => "Danilo Marques", "address" => "marquesdanilocarlos@gmail.com"]);

define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");

/**
 * VIEW
 */

define("CONF_VIEW_PATH", __DIR__ . "/../../shared/views");
define("CONF_VIEW_THEME", __DIR__ . "cafecontrol");
define("CONF_VIEW_EXT", "php");

/**
 * UPLOAD
 */

define("CONF_UPLOAD_DIR", "../storage");
define("CONF_UPLOAD_IMAGE_DIR", "image");
define("CONF_UPLOAD_FILE_DIR", "file");
define("CONF_UPLOAD_MEDIA_DIR", "media");

/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

/**
 * SEO SITE
 */

define("CONF_SITE_NAME", "Upinside");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "upinside.com.br");


/**
 * SEO SOCIAL
 */

define("CONF_SOCIAL_TWITTER_CREATOR", "@marquesdaniloc");
define("CONF_SOCIAL_TWITTER_PUBLISHER", "@marquesdaniloc");
define("CONF_SOCIAL_FACEBOOK_APP", "356464859317524");
define("CONF_SOCIAL_FACEBOOK_PAGE", "danilo.carlosmarques");
define("CONF_SOCIAL_FACEBOOK_AUTHOR", "danilo.carlosmarques");