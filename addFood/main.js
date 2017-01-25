var loginbut = document.getElementById('loginbut');
var food = document.getElementById('foodname');
loginbut.onclick = function(){
  console.log(food.value);
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText)
        document.getElementById('Foods').innerHTML = this.responseText;
      }
    }
    xhttp.open("GET", "./getFood.php?food="+food.value, true);
    xhttp.send();
}
var itembut = document.getElementById('itembut');
itembut.onclick= function(){
  //upload to database and redirect to dashboard
}
