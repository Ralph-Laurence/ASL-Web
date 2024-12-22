<?php

class DatabaseHelper
{
    private $pdo;

    public $FETCH_MODE_SINGLE = 'single';
    public $FETCH_MODE_COLUMN = 'column';
    public $FETCH_MODE_LIST   = 'list';

    public function __construct()
    {
        $host = DBHOST;
        $dbname = DBNAME;
        $user = DBUSER;
        $pass = DBPWD;
        $dsn  = "mysql:host=$host;dbname=$dbname";

        try 
        {
            $this->pdo = new PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch (PDOException $e) 
        {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function query($sql, $params = [], $options = [])
    {
        try
        {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            
            if (isset($options['fetchMode']))
            {
                switch ($options['fetchMode'])
                {
                    case $this->FETCH_MODE_SINGLE:
                        return $stmt->fetch(PDO::FETCH_ASSOC);
                        
                    case $this->FETCH_MODE_COLUMN:
                        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
                        
                    default:
                        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
                }
            }
            else
            {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        catch (PDOException $e)
        {
            error_log("Query failed: " . $e->getMessage()); return false;
        }
    }

    public function insert($table, $data)
    {
        $keys   = array_keys($data);
        $fields = implode(',', $keys);
        $placeholders = ':' . implode(',:', $keys);
        $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";

        return $this->query($sql, $data);
    }

    public function update($table, $data, $condition, $conditionParams)
    {
        $setPart = [];

        foreach ($data as $key => $value)
        {
            $setPart[] = "$key = :$key";
        }

        $setPart = implode(',', $setPart);
        $sql = "UPDATE $table SET $setPart WHERE $condition";

        return $this->query($sql, array_merge($data, $conditionParams));
    }

    public function delete($table, $conditions)
    {
        $conditionParts = [];
        $params = [];
    
        foreach ($conditions as $field => $value) {
            $conditionParts[] = "$field = :$field";
            $params[$field] = $value;
        }
    
        $conditionString = implode(' AND ', $conditionParts);
        $sql = "DELETE FROM $table WHERE $conditionString";
        
        return $this->query($sql, $params) !== false;
    }


    // Fetch a single record by its record id
    public function find($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE id = ?";
        return $this->query($sql, [$id], ['fetchMode' => $this->FETCH_MODE_SINGLE]);
    }

//     public function find($table, $id)
// {
//     $sql = "SELECT * FROM $table WHERE id = :id LIMIT 1";
//     $result = $this->query($sql, ['id' => $id]);
    
//     return $result ? $result[0] : false;
// }
    
    // Fetch multiple records with optional conditions.
    public function select($table, $conditions = [], $params = [])
    {
        $sql = "SELECT * FROM $table";
        
        if (!empty($conditions))
        {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }
    
        return $this->query($sql, $params);
    }

    public function recordExists($table, $conditions)
    {
        $conditionParts = [];
        $params = [];

        foreach ($conditions as $field => $value) {
            $conditionParts[] = "$field = :$field";
            $params[$field] = $value;
        }

        $conditionString = implode(' AND ', $conditionParts);
        $sql = "SELECT COUNT(*) as count FROM $table WHERE $conditionString";
        
        $result = $this->query($sql, $params);
        
        return $result && $result[0]['count'] > 0;
    }

    public function insertIfNotExists($table, $data, $conditions)
    {
        if (!$this->recordExists($table, $conditions))
        {
            return $this->insert($table, $data);
        }
        else
        {
            return false; // or you could return a message indicating the record already exists
        }
    }
}