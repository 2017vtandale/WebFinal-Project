<?php
$host="host=ec2-54-83-49-44.compute-1.amazonaws.com";
$dbname="dbname=d5ri1a2h6r334q";
$user="user=wyvigddvdlnsdi";
$port="port=5432";
$password="password=085b65180ffaae50a448d5fc2935f7ef9c49bab3c0b0a3761ce7714e7642a50d";
   $db = pg_pconnect($host." ".$dbname." ".$user." ".$port." ".$password);

   /*
      Create Data Table
   */
   $query = "CREATE TABLE CalorieDataSet(userID integer, data text[])";

   $ret = pg_query($query);
   if(!$ret){
      echo(pg_last_error($db));
   }
   else{
      echo("success");
   }

 ?>
