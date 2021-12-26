<?php
class CategoriesController{

    private $conectar;
    private $Connection;

    public function __construct() {
		require_once  __DIR__ . "/../core/Conectar.php";
        require_once  __DIR__ . "/../model/category.php";
        
        $this->conectar=new Conectar();
        $this->Connection=$this->conectar->Connection();

    }

   /**
    *
    *  categories route
    *
    */
    public function run($action){
        switch($action)
        { 
            case "index" :
                $this->index();
                break;
            case "create" :
                $this->create();
                break;
            case "details" :
                $this->details();
                break;
            case "update" :
                $this->update();
                break;
            default:
                $this->index();
                break;
        }
    }
    
   /**
    * Loads the categories home page with the list of
    * users getting from the model User.
    *
    */ 
    public function index(){
        
        //We create the category object
        $categories=new Category($this->Connection);
        
        //We get all the categories
        $categories=$categories->getAll();
       
        //We load the index view and pass values to it
        $this->view("index",array(
            "categories"=>$categories,
            "title" => "Categories"
        ));
    }

    /**
    * Loads the Category home page with the list of
     * Categories getting from the model.
    *
    */ 
    public function details(){
        
        //We load the model
        $model = new Category($this->Connection);
        //We recover the user from the BBDD
        $category = $model->getById($_GET["id"]);
        //We load the detail view and pass values to it
        $this->view("show",array(
            "category"=>$category,
            "title" => "Category details"
        ));
    }
    
   /**
    * Create a new category from the POST parameters
     * and reload the index.php.
    *
    */
    public function create(){
        if(isset($_POST["title"])){

            //Create
            $category=new Category($this->Connection);
            $category->settitle($_POST["title"]);
            $category->setdescription($_POST["description"]);
            $category->setstatus($_POST["status"]);  // we can not set its default value, but for further use
            $category->setrank($_POST["rank"]);// we can not set its default value, but for further use
            $save=$category->save();
        }
        header('Location: view/categories/index.php');
    }

   /**
    * Update category from POST parameters
     * and reload the index.php.
    *
    */
    public function update(){
        if(isset($_POST["id"])){

            //We update a category
            $category=new Category($this->Connection);
            $category->setId($_POST["id"]);
            $category->settitle($_POST["title"]);
            $category->setdescription($_POST["description"]);
            $category->setstatus($_POST["status"]);
            $category->setrank($_POST["rank"]);
            $save=$category->update();
        }
        header('Location: view/categories/index.php');
    }
    
    
   /**
    * Create the view that we pass to it with the dedicated data.
    *
    */
    public function view($page,$data){
        $data = $data;
        require_once  __DIR__ . "/../view/categories/" . $page . ".php";

    }

}
?>
