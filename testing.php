<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title></title><script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $.getJSON("chart_json.php", function (result) {

                var chart = new CanvasJS.Chart("chartContainer", {
                    data: [
                        {
                            dataPoints: result
                        }
                    ]
                });

                chart.render();
            });
        });
    </script>
</head>
<body>

    <div id="chartContainer" style="width: 800px; height: 380px;"></div>

</body>
</html>