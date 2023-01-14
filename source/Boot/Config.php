<?php

/**
 * DATABASE
 */
if (strpos($_SERVER['HTTP_HOST'], "localhost") !== false) {
    define("CONF_DB_HOST", "localhost");
    define("CONF_DB_USER", "root");
    define("CONF_DB_PASS", "");
    define("CONF_DB_NAME", "nbkarchitects");
} else {
    define("CONF_DB_HOST", "mysql.nbkarchitects.com");
    define("CONF_DB_USER", "nbkarchitects");
    define("CONF_DB_PASS", "Renata123");
    define("CONF_DB_NAME", "nbkarchitects");
}

/**
 * PROJECT URLs
 */
define("CONF_URL_BASE", "https://www.nbkarchitects.com");
define("CONF_URL_TEST", "http://www.localhost/nbk");

/**
 * SITE
 */
define("CONF_SITE_NAME", "NBK Architects");
define("CONF_SITE_EMAIL", "contact@nbkarchitects.com");
define("CONF_SITE_EMAIL_ERROR", "error@nbkarchitects.com");
define("CONF_SITE_TITLE", "NBK Architects");
define("CONF_SITE_DESC", "NBK Architects");
define("CONF_SITE_LANG", "en");
define("CONF_SITE_DOMAIN", "nbkarchitects.com");
define("CONF_SITE_ADDR_STREET", "");
define("CONF_SITE_ADDR_NUMBER", "");
define("CONF_SITE_ADDR_COMPLEMENT", "");
define("CONF_SITE_ADDR_CITY", "");
define("CONF_SITE_ADDR_STATE", "");
define("CONF_SITE_ADDR_ZIPCODE", "");

/**
 * ASSETS
 */
define("CONF_ASSETS_DIR", "/shared/assets/");

/**
 * SOCIAL
 */
define("CONF_SOCIAL_TWITTER_CREATOR", "@");
define("CONF_SOCIAL_TWITTER_PUBLISHER", "@");
define("CONF_SOCIAL_FACEBOOK_APP", "000");
define("CONF_SOCIAL_FACEBOOK_PAGE", "pagename");
define("CONF_SOCIAL_FACEBOOK_AUTHOR", "author");
define("CONF_SOCIAL_GOOGLE_PAGE", "000");
define("CONF_SOCIAL_GOOGLE_AUTHOR", "000");
define("CONF_SOCIAL_INSTAGRAM_PAGE", "insta");
define("CONF_SOCIAL_YOUTUBE_PAGE", "youtube");

/**
 * DATES
 */
define("CONF_DATE_APP", "Y-m-d H:i:s");
define("CONF_DATE_BR", "d/m/Y H:i:s");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);

/**
 * VIEW
 */
define("CONF_VIEW_PATH", __DIR__ . "/../../shared/views");
define("CONF_VIEW_EXT", "php");
define("CONF_VIEW_THEME", "web");
define("CONF_VIEW_ADMIN", "adm");

/**
 * UPLOAD
 */
define("CONF_UPLOAD_DIR", "storage");
define("CONF_UPLOAD_IMAGE_DIR", "images");
define("CONF_UPLOAD_FILE_DIR", "files");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

/**
 * MAIL
 */
//Kinghost
define("CONF_MAIL_HOST", "smtp.uni5.net");
define("CONF_MAIL_PORT", "587");
define("CONF_MAIL_USER", "contact@nbkarchitects.com");
define("CONF_MAIL_PASS", "Renata$123");
define("CONF_MAIL_SENDER", ["name" => "NBK Architects", "address" => "contact@nbkarchitects.com"]);
define("CONF_MAIL_SUPPORT", "support@nbkarchitects.com");
define("CONF_MAIL_OPTION_LANG", "en");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");
