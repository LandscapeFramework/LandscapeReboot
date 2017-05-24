<?php namespace Landscape\Interfaces\Database;

interface iDatabase
{
  public static function isConnected();
  public static function connect($url, $user=null, $pass=null, $options=null);
  public static function disconnect();
  public static function getHandle(); // Should return a PDO (compatible) handle
}



?>
