<?php
$host="host=ec2-54-235-84-244.compute-1.amazonaws.com";
$dbname="dbname=d1ovq05vs2aqii";
$user="user=nxamshinupbnkg";
$port="port=5432";
$password="password=758dac437d2f27d11f6431307baf1bf13569730baa40b8c86cdb77291cb8aea8";
$db = pg_pconnect($host." ".$dbname." ".$user." ".$port." ".$password);
$isuser = false;
//$query = "CREATE TABLE Login(user varchar(255) , pass varchar(255) )";
//$query = "CREATE TABLE login(username varchar(255), userpass varchar(255)  )";
$query = "SELECT * FROM login";
$ret = pg_query($query);
$user = htmlspecialchars($_POST["user"]);
$pw = htmlspecialchars($_POST["pw"]);
if(!$ret){
echo(pg_last_error($db));
}
else{
  while ($row = pg_fetch_row($ret)) {
    $isuser = $row[0]==$user && $row[1]==$pw;
    if($isuser){
      header("Location: ../home.html");
    }
  }
  if($isuser){
    header("Location: ./login.html");
  }
}
  ?>
