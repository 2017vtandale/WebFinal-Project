<?php
  function redirect($url, $statusCode = 303)
  {
   echo('<script>
   window.location = "'.$url.'";
   </script>');
  }

  $host="host=ec2-54-235-84-244.compute-1.amazonaws.com";
  $dbname="dbname=d1ovq05vs2aqii";
  $user="user=nxamshinupbnkg";
  $port="port=5432";
  $password="password=758dac437d2f27d11f6431307baf1bf13569730baa40b8c86cdb77291cb8aea8";
  $db = pg_pconnect($host." ".$dbname." ".$user." ".$port." ".$password);
  echo("I'm Here");
  $user = htmlspecialchars($_POST["user"]);
  $pw = htmlspecialchars($_POST["pw"]);
  $pw = htmlspecialchars($_POST["pw1"]);
  echo($pw." ".$pw1);
  if($pw==$pw1){
    $query = "INSERT INTO login VALUES('$user','$pw')";
    $ret = pg_query($query);
    if(!$ret){
    }
    else{
      echo("We Made it");
      //redirect("../login/login.html",false);
    }
  }
  else{
    //redirect("./index.html",false);
  }
?>
