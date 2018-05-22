<?php

######################################################################################
# adilbo™ Software                                                                   #
#              _   _   _              ____        ___ _                              #
#    __ _  ___| |_| | | |___   ___™  / ___|  ___ / __| |_  _     _  __ _ _ __  ___   #
#   / _` |/ __  | | | |  __ \ / _ \  \___ \ / _ \| _|| __/| | _ | |/ _` | '__|/ __\  #
#  | (_| | (__| | | |_| |__) | (_) |  ___) | (_) | | | |_ | || || | (_| | |  |  _|   #
#   \__,_|\___,_|_|___|_,___/ \___/  |____/ \___/|_|  \__| \_____/ \__,_|_|   \___/  #
#                                                                                    #
# Copyright - 2016 http://adilbo.com - all rights reserved - Alle Rechte vorbehalten #
######################################################################################'
# PHP HUB - FUNCTION AUTOLOADER - Version 1.0.0 www.semver.org - Release: 19.04.2016 #
######################################################################################

error_reporting(E_ALL & ~E_NOTICE &  ~E_STRICT); // PRODUCTION
#error_reporting(E_ALL & ~E_NOTICE);             // DEVELOPMENT

class hub {

  # SETUP

  // Make it TRUE to output debug info in 'log/hub.txt'
  const PHPHUB_DEBUG = TRUE; // FALSE or TRUE
  
  // Make it TRUE to output debug info in single line
  const PHPHUB_LOG_SINGLE_LINE = FALSE; // FALSE or TRUE

  #------------------------------------------------------------------#
  #---------- there is nothing to change beyond this line! ----------#
  #------------------------------------------------------------------#
 
  // Relative directory where the functions are located
  const PHPHUB_LIB_FOLDER = 'lib';    // LEAVE THIS AS IS

  // The namespace of the functions
  const PHPHUB_NAMESPACE = '';        // LEAVE THIS AS IS  

  # MAGIC METHODS
  
 public function __construct() {} // prevent creating a new instance
  private function __wakeup() {}      // prevent unserializing
  private function __clone() {}       // prevent cloning

  # HELPER
  
  // ADD NAMESPACE TO FUNCTION-NAME
  protected static function function_name($function) {
    return self::PHPHUB_NAMESPACE . '\\' . $function;
  }

  // ADD PATH TO FILE
  protected static function path($function_name) {
    return dirname(__FILE__) . '/' . self::PHPHUB_LIB_FOLDER . '/' . $function_name . '.php';
  }

  # MAIN

  // LOAD FUNCTION (if not defined)
  public static function __callStatic($function, $args) {
    $btr_function = self::function_name($function); // ADD NAMESPACE TO FUNCTION-NAME
    if (!function_exists($btr_function)) { // (if not exist)
	  // LOG HANDLING
      self::log_var('Start', date('Y-m-d H:i:s'));
      $bt = debug_backtrace(1);
      self::log_var('File: '.basename($bt[0]['file']).' ', 'in Line: '.$bt[0]['line']);
      self::log_var('Autoload', $btr_function);
      // LOAD FUNCTION FILE IF EXISTS (or throw exception)
      if (!self::load_dirs($function) or !function_exists($btr_function)) {
        $dir = dirname(self::path($function));
        $dir = str_replace(dirname(__FILE__), '', $dir);
        self::log_var('Not found', "Raising an exception\n");
        throw new Exception(
          "\n\n\n\n======> ".
          "Function ".self::PHPHUB_LIB_FOLDER."$btr_function.php could not be found on $dir".
          " <======\n\n\n\n"
        );
      }
    }
    return call_user_func_array($btr_function, $args);
  }

  # SEARCH FUNCTION FILE

  // TRY SUB-DIR (replace first '_' with '/' in function name)
  protected static function load_dirs($function_name) {
    do {
      $function_name_temp = $function_name;
      self::log_file($function_name);
      if (file_exists(self::path($function_name))) {
        self::log_var('Found', "Loading direkt...\n");
        require_once(self::path($function_name));
        return TRUE;
      }
      $function_name_temp = preg_replace('#_#', '/', $function_name_temp, 1); // REPLACE ONLY FIRST MATCH
      if (file_exists(self::path($function_name_temp))) {
        self::log_var('Found', "Loading from selected folder name...\n");
        require_once(self::path($function_name_temp));
        return TRUE;
      }
      if (self::load_folder($function_name)) {
        return TRUE;
      }
      if (self::load_files($function_name)) {
        return TRUE;
      }
    } while ($function_name != $function_name_temp);
    return FALSE;
  }

  // TRY DIFFERENT FILENAME (remove all after last '_' in function name and use as file name)
  protected static function load_files($function_name) {
    $function_name_temp = $function_name;
    $function_name = preg_replace('/_[^_]*$/', '', $function_name);
    while ($function_name != $function_name_temp) {
      self::log_file($function_name);
      if (file_exists(self::path($function_name))) {
        self::log_var('Found', "Loading from different file name...\n");
        require_once(self::path($function_name));
        return TRUE;
      }
      $function_name_temp = $function_name;
      $function_name = preg_replace('/_[^_]*$/', '', $function_name);
    }
    return FALSE;
  }

  // TRY FUNCTION-NAME FOLDER (remove all after last '_' in function name and use as dir name)
  protected static function load_folder($function_name) {
    $function_name_temp = $function_name;
    $function_name = preg_replace('/_[^_]*$/', '', $function_name);
    $function_name = $function_name.'/'.$function_name;
    while ($function_name != $function_name_temp) {
      self::log_file($function_name);
      if (file_exists(self::path($function_name))) {
        self::log_var('Found', "Loading from different folder name...\n");
        require_once(self::path($function_name));
        return TRUE;
      }
      $function_name_temp = $function_name;
      $function_name = preg_replace('/_[^_]*$/', '', $function_name);
    }
    return FALSE;
  }

  # LOG HANDLING
  
  // LOG FILE WRITING
  public static function log($comment ='', $var) {
    $log_file = dirname(__FILE__).'/log/hub.txt';
    $content = "\n$comment: " . print_r($var, true);
    if(self::PHPHUB_LOG_SINGLE_LINE == true)$content="$comment: ".print_r($var,true);// 1 LINE PER ENTRY
    file_put_contents($log_file, $content, FILE_APPEND);
  }

  // LOG PARAMTER
  protected static function log_var($comment='', $var) {
    if (!self::PHPHUB_DEBUG) return;
    self::log($comment, $var);
  }

  // LOG TRIED LOAD ORDER
  protected static function log_file($file_name, $comment='Trying') {
    if (!self::PHPHUB_DEBUG) return;
    $log_file = self::path($file_name);
    $log_file = str_replace(dirname(__FILE__), '', $log_file);
    self::log($comment, $log_file);
  }
  
  // end of class

}

/* EOF - end of file */
