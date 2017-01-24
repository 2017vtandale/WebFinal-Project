var pg = require('pg');
var connectionString = "postgres://nxamshinupbnkg:758dac437d2f27d11f6431307baf1bf13569730baa40b8c86cdb77291cb8aea8@ec2-54-235-84-244.compute-1.amazonaws.com:5432/d1ovq05vs2aqii";
var pgClient = new pg.Client(connectionString);
pgClient.connect();
var query = client.query(
  'CREATE TABLE items(id SERIAL PRIMARY KEY, text VARCHAR(40) not null, complete BOOLEAN)');
query.on('end', () => { client.end(); });
var login = document.getElementById('loginbut');
var username = document.getElementById('username');
var pw = document.getElementById('userpass');
login.onclick = function(){
  un = username.value;
  pw = pw.value;
};
