<?php
class Category {
    private $table = "categories";
    private $Connection;

    private $id;
    private $title ;
    private $description;
    private $status;
    private $rank;

    public function __construct($Connection) {
		$this->Connection = $Connection;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function gettitle () {
        return $this->title ;
    }

    public function settitle ($title ) {
        $this->title  = $title ;
    }

    public function getdescription() {
        return $this->description;
    }

    public function setdescription($description) {
        $this->description = $description;
    }

    public function getstatus() {
        return $this->status;
    }

    public function setstatus($status) {
        $this->status = $status;
    }

    public function getrank() {
        return $this->rank;
    }

    public function setrank($rank) {
        $this->rank = $rank;
    }

    public function save(){

        $consultation = $this->Connection->prepare("INSERT INTO " . $this->table . " (title ,description,status,rank)
                                        VALUES (:title ,:description,:status,:rank)");
        $result = $consultation->execute(array(
            "title" => $this->title ,
            "description" => $this->description,
            "status" => $this->status,
            "rank" => $this->rank
        ));
        $this->Connection = null;

        return $result;
    }

    public function update(){

        $consultation = $this->Connection->prepare("
            UPDATE " . $this->table . " 
            SET 
                title  = :title ,
                description = :description, 
                status = :status,
                rank = :rank
            WHERE id = :id 
        ");

        $resultado = $consultation->execute(array(
            "id" => $this->id,
            "title" => $this->title ,
            "description" => $this->description,
            "status" => $this->status,
            "rank" => $this->rank
        ));
        $this->Connection = null;

        return $resultado;
    }
        
    //get all categories
    public function getAll(){

        $consultation = $this->Connection->prepare("SELECT id,title,description,status,rank FROM " . $this->table);
        $consultation->execute();
        /* Fetch all of the remaining rows in the result set */
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //clear connection
        return $resultados;

    }
    //get all categories order by rank DESC
    public function get_active_categories(){

        $consultation = $this->Connection->prepare("SELECT id,title,description,status,rank FROM " . $this->table.
                                        "where status=1 order by rank DESC");
        $consultation->execute();
        /* Fetch all of the remaining rows in the result set */
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //clear connection
        return $resultados;

    }
    //get all categories with posts count order by rank DESC
    public function getAll_with_posts_count(){

        $consultation = $this->Connection->prepare("SELECT categories.id,categories.title,description,
                            categories.status,categories.rank
                             FROM categories 
                               order by rank DESC" );
        $consultation->execute();
        /* Fetch all of the remaining rows in the result set */
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //clear connection
        return $resultados;

    }


    
    public function getById($id){
        $consultation = $this->Connection->prepare("SELECT id,title,description,status,rank, (SELECT COUNT(id) from posts where category_id=:cat_id) as posts_count 
                                                FROM " . $this->table . "  WHERE id = :id");
        $consultation->execute(array(
            "cat_id" => $id,
            "id" => $id
        ));
        /*Fetch all of the remaining rows in the result set*/
        $resultado = $consultation->fetchObject();
        $this->Connection = null; //connection close
        return $resultado;
    }
    
    public function getBy($column,$value){
        $consultation = $this->Connection->prepare("SELECT id,title,description,status,rank 
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
