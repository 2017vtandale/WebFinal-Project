<?php
   $host="host=ec2-54-235-84-244.compute-1.amazonaws.com";
   $dbname="dbname=d1ovq05vs2aqii";
   $user="user=nxamshinupbnkg";
   $port="port=5432";
   $password="password=758dac437d2f27d11f6431307baf1bf13569730baa40b8c86cdb77291cb8aea8";
   $db = pg_pconnect($host." ".$dbname." ".$user." ".$port." ".$password);

   /*
      Add Test Data
   */
   $query = "SELECT * FROM TestDataSet";

   $ret = pg_query($query);
   if(!$ret){
      echo(pg_last_error($db));
   }
   else{
      echo("<table>");
      while ($row = pg_fetch_row($ret)) {
           echo("<tr><td>Data".$row."</td></tr>");
      }
      echo("</table>");
   }

 ?>