<?php
/*
*
* Debug mode:
* Toggles if the errors are displayed or hidden
* 0 = errors are not displayed(Production value)
* 1 = display errors
*/
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*
* Index.php is just place to set various configration options.
* After setting the config options, we load another file core.php
* which actually set the ball rolling
*/
require_once('app/core.php');


//BONJOUR!
