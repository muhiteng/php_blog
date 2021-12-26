<?php
class Comment {
    private $table = "comments";
    private $Connection;

    private $id;
    private $contributor_name;
    private $email;
    private $text;
    private $post_id;
    private $parent_id ;
    private $status ;
    private $show ;

    public function __construct($Connection) {
		$this->Connection = $Connection;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getcontributor_name() {
        return $this->contributor_name;
    }

    public function setcontributor_name($contributor_name) {
        $this->contributor_name = $contributor_name;
    }
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }


    public function gettext() {
        return $this->Surname;
    }

    public function settext($text) {
        $this->text = $text;
    }


    public function getpost_id() {
        return $this->post_id;
    }

    public function setpost_id($post_id) {
        $this->post_id = $post_id;
    }
    public function getparent_id () {
        return $this->parent_id ;
    }

    public function setparent_id ($parent_id ) {
        $this->parent_id  = $parent_id ;
    }
    public function getstatus () {
        return $this->status ;
    }

    public function setstatus ($status ) {
        $this->status  = $status;
    }
    public function getshow () {
        return $this->show ;
    }

    public function setshow ($show) {
        $this->show  = $show;
    }



    public function save(){

        $consultation = $this->Connection->prepare("INSERT INTO " . $this->table . " (contributor_name,email,text,post_id,parent_id,status,show,rank,created_at)
                                        VALUES (:contributor_name,:email,:text,:post_id,:parent_id,:status,:show,:rank,:created_at)");
        $result = $consultation->execute(array(
            "contributor_name" => $this->contributor_name,
            "email" => $this->email,
            "text" => $this->text,
            "post_id" => $this->post_id,
            "parent_id" => $this->parent_id,
            "status" => $this->status,
            "show" => $this->show,
            "rank" => $this->rank,
            "created_at" => date("Y/m/d")
        ));
        $this->Connection = null;

        return $result;
    }

    public function update(){

        $consultation = $this->Connection->prepare("
            UPDATE " . $this->table . " 
            SET 
                contributor_name = :contributor_name,
                email = :email, 
                text = :text,
                post_id = :post_id,
                parent_id = :parent_id,
                status = :status,
                show = :show,
                rank = :rank,
                updated_at = :updated_at,
            WHERE id = :id 
        ");

        $resultado = $consultation->execute(array(
            "id" => $this->id,
            "contributor_name" => $this->contributor_name,
            "email" => $this->email,
            "text" => $this->text,
            "post_id" => $this->post_id,
            "parent_id" => $this->parent_id,
            "status" => $this->status,
            "show" => $this->show,
            "rank" => $this->rank,
            "updated_at" => date("Y/m/d")
        ));
        $this->Connection = null;

        return $resultado;
    }
        
    
    public function getAll(){

        $consultation = $this->Connection->prepare("SELECT id,contributor_name,email,text,post_id,parent_id,status,show,rank,createed_at FROM " . $this->table);
        $consultation->execute();
        /* Fetch all of the remaining rows in the result set */
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //clear connection
        return $resultados;

    }
    
    
    public function getById($id){
        $consultation = $this->Connection->prepare("SELECT id,contributor_name,email,text,post_id,parent_id,status,show,rank,createed_at
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
        $consultation = $this->Connection->prepare("SELECT id,contributor_name,email,text,post_id,parent_id,status,show,rank,createed_at
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
