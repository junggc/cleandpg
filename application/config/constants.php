<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/* 실서버용 */
define('MID0', 'cdtestwiz0');
define('WEB_KEY', 'cjJyNFdoM2xpd3hxVUdqWUR3Ukt1Zz09');
define('MIDB', 'cdtestwizb'); // 상점아이디 빌링
define('BIL_KEY', 'dFMrendCK2NzN2FnOVNjZzdFWnJOUT09'); // 웹결제 사인키
define('INILITE_KEY', 'b3NEOW9aamtydUlLVS9ITUpUU05HQT09'); // 이니라이트 키 
define('BIL_INI_API_KEY', 'hOztYhJRg1PZcs3o');  // 이니 api 키
define('BIL_INI_API_IV', 'GBu8wGb0dzfZkB==');    // 이니 api iv
define('WEB_INI_API_KEY', 'JwHbLaPbqCvt9Mov');
define('WEB_INI_API_IV', 'MzPDbOddbuEp28==');
/* 실서버용 */
/* 개발서버용 */
//define('WEB_INI_API_IV', 'W2KLNKra6Wxc1P==');
//define('MID0', 'INIpayTest');
//define('WEB_KEY', 'SU5JTElURV9UUklQTEVERVNfS0VZU1RS');
//define('MIDB', 'INIBillTst');
//define('BIL_KEY', 'SU5JTElURV9UUklQTEVERVNfS0VZU1RS');
/* 개발서버용 */

define('RETURN_URL', '/payment/payment_result');
define('RETURN_URL_MO', '/payment/payment_result_mo');
define('RETURN_URL2', '/payment/change_result');
define('RETURN_URL_MO2', '/payment/change_result_mo');
define('NOTI_URL', '/payment/vbank_complete');
define('NOTI_URL_MO', '/payment/vbank_complete_mo');
define('BILL_URL', 'https://iniapi.inicis.com/api/v1/billing');
define('REFUND_URL', 'https://iniapi.inicis.com/api/v1/refund');

define('KAKAO_BASE_URL','https://kapi.kakao.com');
define('KAKAO_CID_EASYPAY', 'TC0ONETIME'); //  CTB5VLWLAZ <실서버용>
define('KAKAO_CID_SUBSCRIP', 'TCSUBSCRIP'); // 	CTB5VS23LS <실서버용>

define('CDN_URL', 'https://jchxmduxhqmv7754513.cdn.ntruss.com/');
define('OBJ_URL', 'https://kr.object.ncloudstorage.com');
define('OBJ_ACCESS_KEY', 'rointwqlpBcvKiHawXqU');
define('OBJ_SECRET_KEY', 'RRqYkKEJhPkDC50rba2IAF9gyEi5YG538ZWXspr5');
define('OBJ_BUCKET', 'cld-buket');

define('DATA_PATH', '/var/www/data');