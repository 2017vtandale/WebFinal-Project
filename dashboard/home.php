
<!DOCTYPE HTML>
<!-- Created by Sishaar Rao -->
<html>

<head>
    <title>Web App Final Project</title>

    <!-- CDN for Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link rel="stylesheet" href="style.css">


    <!-- Script for Async Graph Creation
    <script src="asyncgraphv1.js"></script>
    -->
    <script>
        /*
         *   Script used to create UI offline, because repeatedly
         *   pushing to Heroku can be a pain. This generates a generic
         *   graph offline.
         */

         /*

        document.addEventListener('DOMContentLoaded', function createGraph() {
            var today = new Date();
            var todayDate = (today.getMonth() + 1) + '-' + today.getDate();
            var dateLabels = [];
            for (i = 9; i >= 0; i--) {
                dateLabels.push((today.getMonth() + 1) + '-' + (today.getDate() - i));
            }
            var ctx = document.getElementById("calorieChart").getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dateLabels,
                    datasets: [{
                        label: "Calorie",
                        data: [1050, 1100, 1200, 1300, 1200, 1300, 1500, 1400, 1100, 1200],
                    }]
                },
                options: {}
            });

            var ctx = document.getElementById("proteinChart").getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dateLabels,
                    datasets: [{
                        label: "Protein",
                        data: [1050, 1100, 1200, 1300, 1200, 1300, 1500, 1400, 1100, 1200],
                    }]
                },
                options: {}
            });
            var ctx = document.getElementById("carbChart").getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dateLabels,
                    datasets: [{
                        label: "Carb",
                        data: [1050, 1100, 1200, 1300, 1200, 1300, 1500, 1400, 1100, 1200],
                    }]
                },
                options: {}
            });
            var ctx = document.getElementById("fatChart").getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dateLabels,
                    datasets: [{
                        label: "Faṯ",
                        data: [1050, 1100, 1200, 1300, 1200, 1300, 1500, 1400, 1100, 1200],
                    }]
                },
                options: {}
            });
        });
        */
    </script>

    <script type="text/javascript">
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
                    var dataSet = this.responseText.split('.');
                    callback(dataSet);
                }
            };

            var today = new Date();
            var currDate = (today.getMonth()+1)+today.getDate();

            xmlhttp.open("GET", "https://webfinal-project.herokuapp.com/dashboard/displayCals.php?userID="+userID+"&currDate="+currDate, true);
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

            var today = new Date();
            var todayDate = (today.getMonth()+1)+'-'+today.getDate();
            var dateLabels = [];
            for(i = 9; i >= 0; i--){
              dateLabels.push((today.getMonth()+1)+'-'+(today.getDate()-i));
            }
            var ctx = document.getElementById("calorieChart").getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dateLabels,
                    datasets: [{
                        label: "Calorie Count",
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
            var userID = <?php echo(json_encode($$_GET['user'])); ?>;

            getData(userID, function(dataSet) {
                createGraph(dataSet);
            }, function(errorMessage) {
                renderStatus('Error: ' + errorMessage);
            });

        });

    </script>



</head>

<body>
    <div class="jumbotron text-center">
        <h1>Welcome User: <?php
        echo($_GET["user"]);?>
      </h1>
        <p>Last updated: </p>
    </div>

    <div class="row">
        <div id="chart-box" class="col-sm-6">
            <canvas id="calorieChart"></canvas>
        </div>
        <div id="chart-box" class="col-sm-6">
            <canvas id="proteinChart"></canvas>
        </div>
        <div id="chart-box" class="col-sm-6">
            <canvas id="carbChart"></canvas>
        </div>
        <div id="chart-box" class="col-sm-6">
            <canvas id="fatChart"></canvas>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Calories</th>
                        <th>Macros</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Generic Table Information -->
                    <tr>
                        <td>1/20</td>
                        <td>1050</td>
                        <td>200</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="addCalories" class="col-sm-3">
            <h2>Add Calorie Data</h2>
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="control-label" for="email">Date:</label>
                    <input type="date" class="form-control" id="date" placeholder="Enter Date">
                </div>
                <div class="form-group">
                    <label class="control-label" for="calories">Calorie Intake:</label>
                    <input type="calories" class="form-control" id="calories" placeholder="Enter Caloric Intake">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </form>
        </div>
        <div class="col-sm-1"></div>
        <div id="addMacros" class="col-sm-3">
            <h2>Add Macros Data</h2>
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="control-label" for="email">Date:</label>
                    <input type="date" class="form-control" id="date2" placeholder="Enter Date">
                </div>
                <div class="form-group">
                    <label class="control-label" for="macros">Macro Intake:</label>
                    <input type="macros" class="form-control" id="macros" placeholder="Enter Macro Intake">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Submit</button>

                </div>
            </form>
        </div>
        <div class="col-sm-1"></div>
    </div>


    <div id=status></div>
</body>

</html>
