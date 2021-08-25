<?php

class CurrencyRateRepository
{
    private $conn;
    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "root", "assignment");
        if ($this->conn->connect_errno) {
            echo "Failed to connect to MySQL: " . $this->conn->connect_error;
            exit();
        }
    }

    public function __destruct()
    {
        $this->conn->close();
    }

    public function save($code, $val)
    {
        $stmt = $this->conn->prepare("INSERT INTO conversion_map (`currency_code`,`conversion_rate`) VALUES (?,?)");
        $stmt->bind_param("sd", $code, $val);
        $stmt->execute();
        $stmt->close();
    }



    function getRate(Currency $target)
    {
        $createdAt = time() - 17280;
        $sql = "SELECT * FROM conversion_map WHERE currency_code =? and created_at > ?"; // SQL with parameters
        $stmt = $this->conn->prepare($sql);
        $targetCode = $target->code();
        $stmt->bind_param("si", $targetCode, $createdAt);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $rate = $result->fetch_assoc(); // fetch data   
        $stmt->close();
        if ($rate) {
            return $rate['conversion_rate'];
        }
        return null;
    }
}
