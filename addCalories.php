<?php

   //Function that converts a PHP array to a literal PostGres array
   function to_pg_array($set) {
      settype($set, 'array'); // can be called with a scalar or array
      $result = array();
      foreach ($set as $t) {
         if (is_array($t)) {
            $result[] = to_pg_array($t);
         }
         else {
            $t = str_replace('"', '\\"', $t); // escape double quote
            if (! is_numeric($t)) // quote only non-numeric values
                $t = '"' . $t . '"';
            $result[] = $t;
        }
   }
   return '{' . implode(",", $result) . '}'; // format
   }



   $date = $_REQUEST["date"];
   $cals = $_REQUEST["cals"];
   $userID = $_REQUEST["userID"];
   $host="host=ec2-54-235-84-244.compute-1.amazonaws.com";
   $dbname="dbname=d1ovq05vs2aqii";
   $user="user=nxamshinupbnkg";
   $port="port=5432";
   $password="password=758dac437d2f27d11f6431307baf1bf13569730baa40b8c86cdb77291cb8aea8";
   $db = pg_pconnect($host." ".$dbname." ".$user." ".$port." ".$password);

   //date and cals will be inserted into database with format
   // date:cals      i.e.     0121:1000
   $input = $date . ":" . $cals;

   // Read current array
   $query = "SELECT * FROM CalorieDataSet(userID, data) WHERE userID='$userID'";
   $ret = pg_query($query);
   if(!$ret){
      echo(pg_last_error($db));
   }
   else{
      print_r(pg_fetch_all($ret));
   }

   $finalArr = to_pg_array(array($input));
   $query = "INSERT INTO CalorieDataSet(userID, data) VALUES ('$userID','$finalArr')";
   $ret = pg_query($query);
   if(!$ret){
      echo(pg_last_error($db));
   }
   else{
      echo("successfully added row");
   }

 ?>