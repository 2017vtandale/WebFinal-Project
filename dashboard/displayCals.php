<?php
   include("myDate.php");
   $userID = $_REQUEST["userID"];
   $date = $_REQUEST["currDate"];
   $host="host=ec2-54-83-49-44.compute-1.amazonaws.com";
   $dbname="dbname=d5ri1a2h6r334q";
   $user="user=wyvigddvdlnsdi";
   $port="port=5432";
   $password="password=085b65180ffaae50a448d5fc2935f7ef9c49bab3c0b0a3761ce7714e7642a50d";
   $db = pg_pconnect($host." ".$dbname." ".$user." ".$port." ".$password);

   $query = "SELECT * FROM CalorieDataSet WHERE userID='$userID'";
   $ret = pg_query($query);
   if(!$ret){
      echo(pg_last_error($db));
   }
   else{
      $dataArr = pg_fetch_all($ret);
      print_r($dataArr);
      /*
      Each item in dataArr is another entry where mydate = date, and mycals = cals
      Goal is to create array of the ten items sorted chronologically
      with the most recent 10 days being the ten spots in the array.

      Example of what $dataArr looks like:

      Array ( [0] => Array ( [userid] => 1 [mydate] => 121 [mycals] => 1000 )
      [1] => Array ( [userid] => 1 [mydate] => 122 [mycals] => 1000 )
      [2] => Array ( [userid] => 1 [mydate] => 123 [mycals] => 1100 ) )

      */

      $currDate = new myDate();
      echo($date . "\n");
      $currDate->set_day(substr($date, strlen($date)-2, strlen($date)-1));
      $currDate->set_month(substr($date, 0, strlen($date)-2));
      echo("Date: " . $currDate->get_month() . ", " . $currDate->get_day());

   }
 ?>
