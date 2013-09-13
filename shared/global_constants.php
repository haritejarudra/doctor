<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
/****************************************************************************
 * result types:
 * OBIB_ASSOC - associative array result type
 * OBIB_NUM - numeric array result type
 * OBIB_BOTH - both assoc and numeric array result type
 ****************************************************************************
 */
//define("OBIB_LOCK_NAME","uclock");
//define("OBIB_LOCK_TIMEOUT","200");
define("OBIB_ASSOC","1");
define("OBIB_NUM","2");
define("OBIB_BOTH","3");
define("OBIB_LOCALE","en");

/****************************************************************************
 * search types:
 * OBIB_SEARCH_TITLE
 * OBIB_SEARCH_AUTHOR
 * OBIB_SEARCH_SUBJECT
 ****************************************************************************
 */
define("OBIB_SEARCH_BARCODE","1");
define("OBIB_SEARCH_TITLE","2");
define("OBIB_SEARCH_AUTHOR","3");
define("OBIB_SEARCH_SUBJECT","4");
define("OBIB_SEARCH_NAME","5");
define("OBIB_SEARCH_CALLNO","6");
define("OBIB_SEARCH_KEYWORD","7");
define("OBIB_SEARCH_LOCATION","8");

/****************************************************************************
 *  Misc. system constants
 ****************************************************************************
 */
define("OBIB_CODE_VERSION","0.7.1");
define("OBIB_LATEST_DB_VERSION","0.7.1");
define("OBIB_DEFAULT_STATUS","in");
define("OBIB_STATUS_IN","in");
define("OBIB_STATUS_OUT","out");
define("OBIB_STATUS_ON_LOAN","ln");
define("OBIB_STATUS_ON_ORDER","ord");
define("OBIB_STATUS_SHELVING_CART","crt");
define("OBIB_STATUS_ON_HOLD","hld");
define("OBIB_MBR_CLASSIFICATION_JUVENILE","j");
define("OBIB_DEMO_FLG",false);
define("OBIB_HIGHLIGHT_I18N_FLG",false);
define("OBIB_SEARCH_MAXPAGES",20);

define("OBIB_MYSQL_DATETIME_TYPE","datetime");
define("OBIB_MYSQL_DATETIME_FORMAT","Y-m-d H:i:s");
define("OBIB_MYSQL_DATE_TYPE","date");
define("OBIB_MYSQL_DATE_FORMAT","Y-m-d");

define("OBIB_BARCODE_RE", '/^[A-Za-z0-9._\/\-]+$/');

define("OBIB_LOCALE_ROOT","../locale");

# Not fully implemented yet.
define("DB_TABLENAME_PREFIX", "");

/*********************************************************************************
 *
 *                           A T T E N T I O N !
 *
 *  ||  Please modify the following database connection variables to match  ||
 *  \/  the MySQL database and user that you have created for OpenBiblio.   \/
 *********************************************************************************
 */
define("OBIB_HOST",     "localhost");
define("OBIB_DATABASE", "peoples_doctor");
define("OBIB_USERNAME", "root");
define("OBIB_PWD",      "");

/*********************************************************************************
 *  /\                                                                      /\
 *  ||                                                                      ||
 *********************************************************************************
 */

?>
