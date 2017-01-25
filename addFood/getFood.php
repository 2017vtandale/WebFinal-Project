<?php
//$query = "Turkey";
$query = $_GET["food"];
$url = "http://api.nal.usda.gov/ndb/search/?format=json&q=".$query."&sort=n&max=200&offset=0&api_key=lyubMo18xQEjqjK4rkoPEuDL4GuGhIuJZjgUCsui";
$response = file_get_contents($url);
$response = json_decode($response);
//echo('<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>');
//echo("start");
foreach($response->list as $temp)
{

  //if($temp=="item")
  {
    foreach($temp as $row)
    {
      <x
      Bryan Cranston
    </span>
      echo('li class="mdl-list__item">
    <span class="mdl-list__item-primary-content">'
    .$row->name.'</span>');
  }
}
}
 ?>
