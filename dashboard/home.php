
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
    <!-- Script for Async Graph Creation -->
    <script src="asyncgraphv1.js"></script>
    <script>
        /*
         *   Script used to create UI offline, because repeatedly
         *   pushing to Heroku can be a pain. This generates a generic
         *   graph offline.
         */
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
                        label: "Calorie Count",
                        data: [1050, 1100, 1200, 1300, 1200, 1300, 1500, 1400, 1100, 1200],
                    }]
                },
                options: {}
            });

            var ctx = document.getElementById("macroChart").getContext("2d");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dateLabels,
                    datasets: [{
                        label: "Macro Count",
                        data: [1050, 1100, 1200, 1300, 1200, 1300, 1500, 1400, 1100, 1200],
                    }]
                },
                options: {}
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
            <canvas id="macroChart"></canvas>
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