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
   $query = "SELECT * FROM CalorieDataSet WHERE userID='$userID'";
   $ret = pg_query($query);
   $finalArr = [];
   if(!$ret){
      echo(pg_last_error($db));
      //if this fails for some reason, assume that the
      //row does not exist
      $finalArr = to_pg_array(array($input));
   }
   else{
      //push new input onto currently existing data
      $arr = pg_fetch_all($ret);
      print_r($arr);
      print_r($arr[0] . "<br />");
      print_r($arr[0][data] . "<br />");
      $finalArr = $arr[0][data];
      print_r($finalArr);
      $finalArr.push($input);
      //delete that row from the table
      $query = "DELETE FROM CalorieDataSet WHERE userID='$userID'";
      $ret = pg_query($query);
      if(!$ret){
         echo(pg_last_error($db));
      }
      else{
         echo("successfully deleted rows");
      }


   }

   //Insert new row back into table
   $query = "INSERT INTO CalorieDataSet(userID, data) VALUES ('$userID','$finalArr')";
   $ret = pg_query($query);
   if(!$ret){
      echo(pg_last_error($db));
   }
   else{
      echo("successfully added row");
   }

 ?>
