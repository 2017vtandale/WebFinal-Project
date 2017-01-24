// Created by Sishaar Rao
// This is an aynchronous creation of a graph utilizing Chart.js
//  pulling data from db

/**
 *
 * @param {function(string)} callback - called when the data from the
 *    database is retrieved and ready to be graphed
 *
 * @param {function(string)} errorCallback - error in the function, hopefully
 *    it's just an internet connection error
 *
 * @param {function(int, string, string)} getData - the AJAX call that returns
 *    and parses the data from the db given a userID
 *
 */


function getData(userID, callback, errorCallback) {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var dataSet = this.responseText.split('-');
            callback(dataSet);
        }
    };
    xmlhttp.open("GET", "https://webfinal-project.herokuapp.com/displayDataDB.php", true);
    xmlhttp.send();
    xmlhttp.onerror = function() {
      errorCallback('Network error.');
  };
}

/**
 *
 * @param {function(array)} createGraph - asynchronous method once the dataSet is
 *    retrieved used to plot the data
 *
 */

function createGraph(dataSet) {
    renderStatus(dataSet);
    var ctx = document.getElementById("myChart").getContext("2d");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
            datasets: [{
                label: "My First dataset",
                data: dataSet,
            }]
        },
        options: {}
    });
}

function renderStatus(statusText) {
    document.getElementById('status').textContent = statusText;
}


document.addEventListener('DOMContentLoaded', function() {
    //Get Data (callback function)
    //   Display data on graph --> end

    //User ID, pulling Test Data
    var userID = 1;

    getData(userID, function(dataSet) {
        createGraph(dataSet);
    }, function(errorMessage) {
        renderStatus('Error: ' + errorMessage);
    });

});
