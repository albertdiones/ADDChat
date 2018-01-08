<?php
/**
 * Created by PhpStorm.
 * @author albert
 * Date: 1/7/18
 * Time: 11:54 PM
 */
require 'config.php';
error_reporting(E_ALL);
ini_set('display_errors',1);
require 'includes/framework/init.php';


add::current_controller()->execute();


