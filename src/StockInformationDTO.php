<?php


namespace Mcget\Three;


class StockInformationDTO
{

    const OBJECT_NAME_KEY = 'Global Quote';
    const PRICE_KEY = '05. price';
    const LOW_KEY = '04. low';
    const HIGH_KEY = '03. high';
    const SYMBOL_KEY = '01. symbol';


    private string $symbol = '';
    private float $high = 0.0;
    private float $low = 0.0;
    private float $price = 0.0;
    private array $rawData = [];

    public function __construct(string $stockInformation){
        $stockInformationArray = json_decode($stockInformation, true);
        $stockInformationDataArray = $stockInformationArray[self::OBJECT_NAME_KEY];
        $this->symbol = $stockInformationDataArray[self::SYMBOL_KEY];
        $this->high = $stockInformationDataArray[self::HIGH_KEY];
        $this->low = $stockInformationDataArray[self::LOW_KEY];
        $this->price = $stockInformationDataArray[self::PRICE_KEY];

        $this->rawData = $stockInformationDataArray;
    }

    public function getSymbol():string{
        return $this->symbol;
    }

    public function getHigh():float{
        return $this->high;
    }

    public function getLow():float{
        return $this->low;
    }

    public function getPrice():float{
        return $this->price;
    }

    public function getRaw():array{
        return $this->rawData;
    }
}