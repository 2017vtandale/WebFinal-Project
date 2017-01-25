var loginbut = document.getElementById('loginbut');
var food = document.getElementById('foodname');
loginbut.onclick = function(){
  console.log(food.value);
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {
        console.log(this.response.Text)
        document.getElementById('foods').innerHTML = this.responseText;
        //console.log("I got the text");
      }
    }
    xhttp.open("GET", "https://webfinal-project.herokuapp.com/addFood/getFood.php?food="+food.value, true);
    xhttp.send();
}
