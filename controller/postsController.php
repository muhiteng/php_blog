<?php
class PostsController{

    private $conectar;
    private $Connection;

    public function __construct() {
		require_once  __DIR__ . "/../core/Conectar.php";
        require_once  __DIR__ . "/../model/post.php";
        
        $this->conectar=new Conectar();
        $this->Connection=$this->conectar->Connection();

    }

   /**
    *
    *  posts route
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
    * Loads the posts home page with the list of
    * users getting from the model Post.
    *
    */ 
    public function index(){
        
        //We create the post object
        $posts=new Post($this->Connection);
        
        //We get all the posts
        $posts=$posts->getAll();
       
        //We load the index view and pass values to it
        $this->view("index",array(
            "posts"=>$posts,
            "title" => "Posts"
        ));
    }

    /**
    * Loads the post home page with the list of
     * post getting from the model.
    *
    */ 
    public function details(){
        
        //We load the model
        $model = new Post($this->Connection);
        //We recover the post from the BBDD
        $post = $model->getById($_GET["id"]);
        //We load the detail view and pass values to it
        $this->view("show",array(
            "post"=>$post,
            "title" => "Post details"
        ));
    }
    
   /**
    * Create a new post from the POST parameters
     * and reload the index.php.
    *
    */
    public function create(){
        if(isset($_POST["title"])){

            //Create
            $post=new Post($this->Connection);
            $post->settitle($_POST["title"]);
            $post->settext($_POST["text"]);
            $post->setcategory_id(($_POST["category_id"]));
            $post->setuser_id($_POST["user_id"]);
            $save=$post->save();
        }
        header('Location: view/posts/index.php');
    }

   /**
    * Update post from POST parameters
     * and reload the index.php.
    *
    */
    public function update(){
        if(isset($_POST["id"])){

            //We update a post
            $post=new Post($this->Connection);
            $post->setId($_POST["id"]);
            $post->settitle($_POST["title"]);
            $post->settext($_POST["text"]);
            $post->setcategory_id(($_POST["category_id"]));
            $post->setuser_id($_POST["user_id"]);
            $save=$post->update();
        }
        header('Location: view/posts/index.php');
    }
    
    
   /**
    * Create the view that we pass to it with the dedicated data.
    *
    */
    public function view($page,$data){
        $data = $data;
        require_once  __DIR__ . "/../view/posts/" . $page . ".php";

    }

}
?>
