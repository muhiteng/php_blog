<?php
class Post {
    private $table = "posts";
    private $Connection;

    private $id;
    private $title ;
    private $text;
    private $category_id ;
    private $user_id ;
    private $status ;

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

    public function settitle($title ) {
        $this->title  = $title ;
    }

    public function gettext() {
        return $this->text;
    }

    public function settext($text) {
        $this->text = $text;
    }

    public function getcategory_id () {
        return $this->category_id ;
    }

    public function setcategory_id ($category_id ) {
        $this->category_id  = $category_id ;
    }

    public function getuser_id () {
        return $this->user_id ;
    }

    public function setuser_id ($user_id ) {
        $this->user_id  = $user_id ;
    }
    public function getstatus () {
        return $this->status ;
    }

    public function setstatus ($status ) {
        $this->status  = $status;
    }

    public function save(){

        $consultation = $this->Connection->prepare("INSERT INTO " . $this->table . " (title,text,category_id,user_id,status,created_at)
                                        VALUES (:title,:text,:category_id,:user_id,:status,:created_at)");
        $result = $consultation->execute(array(
            "title" => $this->title,
            "text" => $this->text,
            "category_id" => $this->category_id,
            "user_id" => $this->user_id,
            "status" => $this->status,
            "created_at" => date("Y/m/d")
        ));
        $this->Connection = null;

        return $result;
    }

    public function update(){

        $consultation = $this->Connection->prepare("
            UPDATE " . $this->table . " 
            SET 
                title = :title,
                text = :text, 
                category_id = :category_id,
                user_id = :user_id,
                status = :status,
                updated_at=:updated_at
            WHERE id = :id 
        ");

        $resultado = $consultation->execute(array(
            "id" => $this->id,
            "title" => $this->title,
            "text" => $this->text,
            "category_id" => $this->category_id,
            "user_id" => $this->user_id,
            "status" => $this->status,
            "updated_at" => date("Y/m/d")
        ));
        $this->Connection = null;

        return $resultado;
    }
        
    // get all posts with category title and username
    public function getAll(){

        $consultation = $this->Connection->prepare("SELECT posts.id,posts.title,posts.text,posts.category_id,
                                                    categories.title,posts.user_id,users.username,posts.status,
                                                    posts.created_at 
                                                FROM users,categories,posts 
                                                where users.id=posts.user_id and categories.id=posts.category_id " );
        $consultation->execute();
        /* Fetch all of the remaining rows in the result set */
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //clear connection
        return $resultados;

    }
    public function get_other_posts($post_id){

        $consultation = $this->Connection->prepare("SELECT posts.id,posts.title,posts.text,posts.category_id,
                                                    categories.title,posts.user_id,users.username,posts.status,
                                                    posts.created_at 
                                                FROM users,categories,posts 
                                                where users.id=posts.user_id and categories.id=posts.category_id and posts.id <> :post_id" );
        $consultation->execute(array(
            "post_id" => $post_id
        ));
        /* Fetch all of the remaining rows in the result set */
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //clear connection
        return $resultados;

    }

    // get all comments by category id
    public function getAll_comments_by_post_id($post_id){

        $consultation = $this->Connection->prepare("SELECT contributor_name,email,text,post_id,status,rank,created_at
                                        FROM comments
                                        WHERE comments.show =1 and status=1 and parent_id is null and  post_id=:post_id 
                                        ORDER by created_at DESC" );
         $consultation->execute(array(
            "post_id" => $post_id

        ));
        /*Fetch all of the remaining rows in the result set*/
        $resultado = $consultation->fetchAll();
        $this->Connection = null; //connection close
        return $resultado;

    }


    public function getById($id){
        $consultation = $this->Connection->prepare("SELECT posts.id,posts.title,posts.text,posts.category_id,
                                                    categories.title as category_name,posts.user_id,users.username,posts.status,
                                                    posts.created_at 
                                                FROM users,categories,posts 
                                                where users.id=posts.user_id and categories.id=posts.category_id and  posts.id = :id");
        $consultation->execute(array(
            "id" => $id
        ));
        /*Fetch all of the remaining rows in the result set*/
        $resultado = $consultation->fetchObject();
        $this->Connection = null; //connection close
        return $resultado;
    }
    
    public function getBy($column,$value){
        $consultation = $this->Connection->prepare("SELECT id,title,text,category_id,user_id,status,updated_at 
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
