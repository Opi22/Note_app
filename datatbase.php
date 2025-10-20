<?php 
class Database{
    public $connection;
    public function __construct($config, $username='root', $password=''){

        $dsn ="mysql:". http_build_query($config,'',';');
        $this->connection = new PDO($dsn, $username,$password,
        [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
    }
    public function query($query, $prams=[]){
        
        $statement= $this->connection->prepare($query);
        $statement->execute($prams);
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function insert($person){
        $statement = $this->connection->prepare(
            "INSERT INTO student (id, age, grade, firstName, lastName)
            VALUES (:id, :age, :grade, :firstName, :lastName)"
        );
        $statement->execute([
            ':id' => $person["id"],
            ':age' => $person["age"],
            ':grade' => $person["grade"],
            ':firstName' => $person["firstName"],
            ':lastName' => $person["lastName"]
        ]);
    }
}