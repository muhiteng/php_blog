<?php
class User {
    private $table = "users";
    private $Connection;

    private $id;
    private $username;
    private $email;
    private $password;
    private $role;


    public function __construct($Connection) {
		$this->Connection = $Connection;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getUserName() {
        return $this->username;
    }

    public function setUserName($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }


    public function save(){

        $consultation = $this->Connection->prepare("INSERT INTO " . $this->table . " (username,email,password,role)
                                        VALUES (:username,:email,:password,:role)");
        $result = $consultation->execute(array(
            "username" => $this->username,
            "email" => $this->email,
            "password" => $this->password,
            "role" => $this->role
        ));
        $this->Connection = null;

        return $result;
    }

    public function update(){

        $consultation = $this->Connection->prepare("
            UPDATE " . $this->table . " 
            SET 
                username = :username,
                email = :Surname, 
                email = :email,
                phone = :phone
            WHERE id = :id 
        ");

        $resultado = $consultation->execute(array(
            "id" => $this->id,
            "username" => $this->username,
            "email" => $this->email,
            "password" => $this->password,
            "role" => $this->role
        ));
        $this->Connection = null;

        return $resultado;
    }
        
    
    public function getAll(){

        $consultation = $this->Connection->prepare("SELECT id,username,email,role,status FROM " . $this->table);
        $consultation->execute();
        /* Fetch all of the remaining rows in the result set */
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //clear connection 
        return $resultados;

    }
    
    
    public function getById($id){
        $consultation = $this->Connection->prepare("SELECT id,username,email,role,status 
                                                FROM " . $this->table . "  WHERE id = :id");
        $consultation->execute(array(
            "id" => $id
        ));
        /*Fetch all of the remaining rows in the result set*/
        $resultado = $consultation->fetchObject();
        $this->Connection = null; //connection close
        return $resultado;
    }
    
    public function getBy($column,$value){
        $consultation = $this->Connection->prepare("SELECT id,username,email,role,status 
                                                FROM " . $this->table . " WHERE :column = :value");
        $consultation->execute(array(
            "column" => $column,
            "value" => $value
        ));
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //connection close
        return $resultados;
    }
    
    public function deleteById($id){
        try {
            $consultation = $this->Connection->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
            $consultation->execute(array(
                "id" => $id
            ));
            $Connection = null;
        } catch (Exception $e) {
            echo 'Failed DELETE (deleteById): ' . $e->getMessage();
            return -1;
        }
    }
    
    public function deleteBy($column,$value){
        try {
            $consultation = $this->Connection->prepare("DELETE FROM " . $this->table . " WHERE :column = :value");
            $consultation->execute(array(
                "column" => $value,
                "value" => $value,
            ));
            $Connection = null;
        } catch (Exception $e) {
            echo 'Failed DELETE (deleteBy): ' . $e->getMessage();
            return -1;
        }
    }
    
}
?>
