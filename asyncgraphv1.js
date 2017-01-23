// Created by Sishaar Rao
// This is an aynchronous creation of a graph utilizing Chart.js

/**
 * Get the current URL.
 *
 * @param {function(string)} callback - called when the data from the
 *    database is retrieved and ready to be graphed
 */



function createGraph() {
   var ctx = document.getElementById("myChart").getContext("2d");
      var myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
              datasets: [{
                  label: "My First dataset",
                  data: [1, 2, 3, 2, 1, 2, 3, 4, 5, 4]
              }]
          },
          options: {}
      });
}

document.addEventListener('DOMContentLoaded', function() {
    //Get Data (callback function)
    //   Display data on graph --> end

    //User ID, pulling Test Data
    var userID = 1;


});
