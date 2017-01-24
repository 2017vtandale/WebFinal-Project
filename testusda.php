<?php
$query = $_GET["query"];
$url = "http://api.nal.usda.gov/ndb/search/?format=json&q=".$query."&sort=n&max=200&offset=0&api_key=lyubMo18xQEjqjK4rkoPEuDL4GuGhIuJZjgUCsui";
$response = file_get_contents($url);
echo($response);
$response = json_decode($response);

 ?>
