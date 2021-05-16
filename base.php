<?php 
//a file required in all the pages
//requiring config.php and config.php is database connection.
session_start();
require_once 'config.php';
//if not set and not true, redirect to index.php
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: index.php");
      exit;
  }
  //present page of the website
  //gets the name of the url using server script name.
  $sitePage = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);


  //collects the values of that user.
  $userinfo = $_SESSION["userinfo"];

  $name = ucwords($userinfo->name);

