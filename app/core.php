<?php
/*
* In Core.php we load bunch of other files
* After that, start out application by creating new instance of 
* controller class. 
* That's it. That's all this file does
*/

/*
* Load Class loads the html template from html folder.
* it does on based on filename which is passed as argument
*/
require_once('load.php');

/*
* model class is usally used to handle database acess.
* basically its datasource for our other class.
* Currently, its empty. Feel free to place database connection code in Model
* This is where it should go
*/
require_once('model.php');

/*
* Controller Class is the main glue between model & views
* All requests from user are routed to controller
* Then its job of controller to decide which view or model to load 
* Basically controller is THE GUY which everyone on what to do
*/
require_once('controller.php');

/*
* Start our app
* As we are done including needed files, lets start
* Fires up new instance of Controller class from controller.php
*/
new Controller();
