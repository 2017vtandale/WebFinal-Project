var loginbut = document.getElementById('loginbut');
var food = document.getElementById('foodname');
var user = document.getElementsByClassName("user")[0].id;
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
var myFood = function(){
  var fooddb = this.id;
  window.location = "./main.addFood.php?dbnum="+fooddb+"&user="+user;
}
