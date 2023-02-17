<?php


namespace Mcget\Three;


use Exception;

class AlphaVantageWrapper
{

    /**
     * @var string
     */
    private string $apiKey;

    /**
     * AlphaVantageWrapper constructor.
     * @param string $apiKey
     */
    public function __construct(
        string $apiKey
    ){
        $this->apiKey = $apiKey;
    }

    /**
     * @param string $stockCode
     * @return StockInformationDTO
     * @throws Exception
     */
    public function getStockInformationByStockCode(string $stockCode):StockInformationDTO{

        $url = $this->getTargetUrl($stockCode, $this->apiKey);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Accept: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $fp = fopen(dirname(__FILE__).'/../logs/errorlog.txt', 'w');
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_STDERR, $fp);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response= curl_exec($curl);

        if($response === false){
            $errorNumber = curl_errno($curl);
            $errorMessage = htmlspecialchars(curl_error($curl));

            curl_close($curl);

            throw new Exception("Curl threw an error: " . $errorNumber . " error message: " . $errorMessage);
        }

        curl_close($curl);

        return $this->parseAlphaVantageResponse($response);
    }

    /**
     * @param string $stockCode
     * @param string $apiKey
     * @return string
     */
    private function getTargetUrl(string $stockCode, string $apiKey) :string{
        return "https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol={$stockCode}&apikey={$apiKey}";
    }

    /**
     * @param string $response
     * @return StockInformationDTO
     */
    private function parseAlphaVantageResponse(string $response){
        return new StockInformationDTO($response);
    }
}