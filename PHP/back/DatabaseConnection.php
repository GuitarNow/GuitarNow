<?php

class DatabaseConnection
{
    
    private  $host="localhost";
    private  $username ="ddamico";
    private  $password ="aiFawohhaoso3AhX";
    private  $dbName ="ddamico";

 

    private $connection;

    public function __construct()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbName);
        
        if (!$this->connection) {
            throw new RuntimeException("Errore durante la connessione al database");
        }   
    }
    
    public function escape_string($string){
        return mysqli_real_escape_string($this->connection,$string);
    }

  
    public function disconnect()
    {
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }

    public function get_result_query($query)
    {
        $query_result = mysqli_query($this->connection, $query);
        mysqli_close($this->connection);
        return $query_result;
        
    }

    public function delete_query($query){

        if (mysqli_query($this->connection, $query)) {
            return "eliminazione andata a buon fine";
            } else {
            return "Errore durante l'eliminazione: " . mysqli_error($this->connection);
            }
    }

    public function insert_query($query){

        if (mysqli_query($this->connection, $query)) {
            return "inserimento andato a buon fine";
            } else {
            return "Errore durante l'inserimento: " . mysqli_error($this->connection);
            }
    }

}

?>

