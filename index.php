<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart of Last 20 US Dollar Quotes</title>
    <!-- Load Plotly.js into the DOM -->
    <script src='https://cdn.plot.ly/plotly-2.5.1.min.js'></script>
</head>
<body>
    <?php
    $url = "http://api.nbp.pl/api/exchangerates/rates/a/usd/last/20/?format=json";
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    $result = json_decode($response);
    
    // Initialize arrays for chart data
    $dates = [];
    $rates = [];
    
    // Extract dates and rates from API data
    foreach ($result->rates as $rate) {
        $dates[] = $rate->effectiveDate;
        $rates[] = $rate->mid;
    }
    ?>
    
    <div id="myDiv"><!-- Plotly chart will be drawn inside this DIV --></div>
    
    <script>
        var trace = {
            x: <?php echo json_encode($dates); ?>,
            y: <?php echo json_encode($rates); ?>,
            type: 'scatter',
            mode: 'lines+markers',
            marker: {color: 'blue'},
            line: {shape: 'spline'}
        };
        
        var data = [trace];
        
        var layout = {
            title: 'Last 20 US Dollar Quotes',
            xaxis: {title: 'Date'},
            yaxis: {title: 'Exchange Rate'}
        };
        
        Plotly.newPlot('myDiv', data, layout);
    </script>
</body>
</html>

