<?php
require('session.php');
Session::init(); 
require('functions.php');
require('inflector.php');
require('set.php');
require('router.php');
require ROOT.DS.'configs'.DS.'routes.php';
require('request.php');
require('controller.php');
require(ROOT.DS.'controllers'.DS.'app_controller.php');
require('model.php');
require(ROOT.DS.'lib'.DS.'configmagik'.DS.'class.ConfigMagik.php');
require(ROOT.DS.'lib'.DS.'file_and_dir.php');
require('dispatcher.php');