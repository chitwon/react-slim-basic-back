<?php
namespace MathCart;
use NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder;
use \PDO;

class Database
{
    public $isConn;
    public $builder;
    protected $db;
    //connect db
    public function __construct($username = " ", $password = " ", $host = "localhost", $dbname = ' ', $options = [])
    {
        $this->isConn = true;
        try {
            $this->db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            //throw new Exception($e->getMessage());
            echo 'db error......' . $e->getMessage();
        }

        $this->builder = new GenericBuilder();
    }

    // getter for SQL builder
    public function getBuilder()
    {
        return $this->builder;
    }
    //disconnect
    public function Disconnect()
    {
        $this->db = null;
        $this->isConn = false;
    }
    //get row
    public function getRow($query, $params = [])
    {
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    //get rows
    public function getRows($query, $params = [])
    {
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    //insert row
    public function insertRow($query, $params = [])
    {
        try {
            $stmt = $this->db->prepare($query);
            $result = $stmt->execute($params);
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    //update row
    public function updateRow($query, $params = [], $returnRowCount = true)
    {
        try {
            $stmt = $this->db->prepare($query);
            $execute = $stmt->execute($params);
            if ($returnRowCount) {
                return $stmt->rowCount();
            }

            return $execute;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    //delete row
    public function deleteRow($query, $params = [])
    {
        $this->insertRow($query, $params);
    }

    // get last id created
    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }

    /*
     * above this comment are mysql functions,
     * below is the database interaction business logic for the app
     */
    

}
