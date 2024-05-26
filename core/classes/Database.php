<?php

namespace core\classes;

use Exception;
use LDAP\Result;
use PDO;

    class Database{
        private $conn;

        function open(){
            $this->conn = new PDO("pgsql:".
            "host=".DB_HOST.";".
            "dbname=".DB_NAME.";",
            DB_USER,
            DB_PASS, 
            array(PDO::ATTR_PERSISTENT => true));
        }

        function close(){
            $this->conn = null;
        }

        function select($sql, $params = null){
            if(!preg_match("/^SELECT/i", $sql)){
                throw new Exception("Base de dados: Nao eh uma instrucao SELECT");
            }
            $this->open();

            $result = null;

            try {
                $execute = $this->conn->prepare($sql);
                $execute->execute($params);
                $result = $execute->fetchAll(PDO::FETCH_CLASS);
                print_r($result);
            } catch (\Throwable $th) {
                echo "Oops! Deu erro.";
            }

            $this->close();

            return $result;
        }

        function insert($sql, $params = null){
            if(!preg_match("/^INSERT/i", $sql)){
                throw new Exception("Base de dados: nao eh uma instrucao INSERT.");
            }

            // Estabelecer a conexao
            $this->open();

            try {
                $execute = $this->conn->prepare($sql);
                $execute->execute();
            } catch (\Throwable $th) {
                echo "Oops! insert deu erro!";

            }

            // Desligar a conexao
            $this->close();
        }

        function update($sql, $params = null){
            if(!preg_match("/^UPDATE/i", $sql)){
                throw new Exception("Base de dados: nao eh uma instrucao insert.");
            }

            // Estabelecer a conexao
            $this->open();

            try {
                $execute = $this->conn->prepare($sql);
                $execute->execute();
            } catch (\Throwable $th) {
                echo "Oops! Update deu erro!";
                return false;
            }

            // Desligar a conexao
            $this->close();
        }

        function delete($sql, $params = null){
            if(!preg_match("/^DELETE/i", $sql)){
                throw new Exception("Base de dados: nao eh uma instrucao DELETE.");
            }

            // Estabelecer a conexao
            $this->open();

            try {
                $execute = $this->conn->prepare($sql);
                $execute->execute($params);
            } catch (\Throwable $th) {
                return false;
            }

            // Desligar a conexao
            $this->close();
        }
    }
?>