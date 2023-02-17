<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
    </style>
    <title>Michael McGettrick Three Tech Test</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>
<?php

use Mcget\Three\Config;
use Mcget\Three\DbSingleton;

require __DIR__ . '/vendor/autoload.php';

$config = new Config();

?>

<h3>Get Stock Information</h3>
<form id>
    <input id="stock-code-input"/>
    <button id="get-price-button">Get Price</button>
</form>
<ul id="get-price-output">

</ul>

<h3>Your config:</h3>
<?php
    echo "Using API key: "  . $config->getAPIKey();
?>
<h3>Recent transactions:</h3>
<table>
    <tr>
        <th>Symbol</th>
        <th>High</th>
        <th>Low</th>
        <th>Price</th>
    </tr>
<?php

    $dbConnection = DbSingleton::getInstance(
        $config->getDbHost(),
        $config->getDbPort(),
        $config->getDbUser(),
        $config->getDbPass(),
        $config->getDbName(),
    );

    $stockInformationRepo = new \Mcget\Three\StockInformationRepository($dbConnection);

    $recentTransactions = $stockInformationRepo->getRecentStockInformation();

    $test= "";

    foreach($recentTransactions as $recentTransaction){
        echo "<tr>";
        echo "<td>{$recentTransaction['symbol']}</td>";
        echo "<td>{$recentTransaction['high']}</td>";
        echo "<td>{$recentTransaction['low']}</td>";
        echo "<td>{$recentTransaction['price']}</td>";
        echo "</tr>";
    }
?>

</table>

</body>

<script>

    let triggerAjaxCall = () =>{
        console.log('Ajax triggered');
        console.log(event);
        let stockCode = $('#stock-code-input').val();
        $.ajax({
            url: "/ajax_endpoint.php?stockCode="+stockCode, //you can also pass get parameters
            dataType: 'json',	//dataType you expect in the response from the server
            timeout: 2000
        }).done(function (data, textStatus, jqXHR) {
            $('#get-price-output').html('');
            Object.keys(data).forEach(function(key) {
                $('#get-price-output').append("<li>"+key+": "+data[key]+"</li>");
            });
        }).fail(function (jqXHR, textStatus, errorThrown) {
            $('#get-price-output').html('An error occurred');
        });
    }

    $('#get-price-button').click((event)=>{
        event.preventDefault();
        triggerAjaxCall();
    });
</script>
</html>


