<?php


namespace Mcget\Three;


use PDO;

class StockInformationRepository
{
    /**
     * @var PDO
     */
    private PDO $dbConnection;

    /**
     * StockInformationRepository constructor.
     * @param PDO $dbConnection
     */
    public function __construct(PDO $dbConnection){
        $this->dbConnection = $dbConnection;
    }

    /**
     *
     *
     * @param StockInformationDTO $stockInformationDTO
     * @return bool
     */
    public function saveStockInformationDTO(StockInformationDTO $stockInformationDTO):void{

        $sql = "INSERT INTO stock_quotes (symbol, high, low, price) VALUES (?, ?, ?, ?)";
        $statement = $this->dbConnection->prepare($sql);

        $statement->execute([
            $stockInformationDTO->getSymbol(),
            $stockInformationDTO->getHigh(),
            $stockInformationDTO->getLow(),
            $stockInformationDTO->getPrice()
        ]);

        $lastId = $this->dbConnection->lastInsertId();

    }


    /**
     * @return array
     */
    public function getRecentStockInformation():array{

        $sql = "SELECT * FROM stock_quotes ORDER BY id DESC LIMIT 5";
        $returnData = $this->dbConnection->query($sql)->fetchAll();
        //TODO:: Use some kind of model or domain object for this

        return $returnData ?? [];
    }

}