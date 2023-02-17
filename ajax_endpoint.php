<?php

require __DIR__ . '/vendor/autoload.php';
use Mcget\Three\Config;
use Mcget\Three\DbSingleton;

$config = new Config();

$apiKey = $config->getAPIKey();
$avWrapper = new \Mcget\Three\AlphaVantageWrapper($config->getAPIKey());

$dbConnection = DbSingleton::getInstance(
    $config->getDbHost(),
    $config->getDbPort(),
    $config->getDbUser(),
    $config->getDbPass(),
    $config->getDbName(),
);



$stockCode = $_GET['stockCode'] ?? null;

if(is_string($stockCode) && strlen($stockCode)){
    $stockInformationDTO = $avWrapper->getStockInformationByStockCode($stockCode);
    $stockInformationRepository = new \Mcget\Three\StockInformationRepository($dbConnection);
    $stockInformationRepository->saveStockInformationDTO($stockInformationDTO);
    $responseData = json_encode($stockInformationDTO->getRaw());
    http_response_code(200);
} else {
    $responseData = json_encode([]);
    http_response_code(400);
}


//Set response headers
header('Content-Type: application/json');

echo $responseData;
