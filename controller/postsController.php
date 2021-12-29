<?php


use Interfaces\PostRepositoryInterface;
use Repository\PostRepository;

class PostsController{

    private $conectar;
    private $Connection;

    public function __construct() {
		require_once  __DIR__ . "/../core/Conectar.php";
        require_once  __DIR__ . "/../model/post.php";
        require_once  __DIR__ . "/../model/category.php";
        require_once  __DIR__ . "/../model/comment.php";

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
            case "create_page" :
                $this->create_page();
                break;
            case "create" :
                $this->create();
                break;
            case "create_comment" :
                $this->create_comment();
                break;
            case "details" :
                $this->details();
                break;
            case "update" :
                $this->update();
                break;
            case "show_update" :
                $this->show_update();
                break;
            case "delete" :
                $this->delete();
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
        //-------------------------------


            //---------------------------------------
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
        // get other posts except detailed
        $model_other = new Post($this->Connection);
        $other_posts=$model_other->get_other_posts($post ->id);
        // get all comments to the post
        $model_comments = new Post($this->Connection);
        $comments=$model_comments->getAll_comments_by_post_id($_GET["id"]);
        //We load the detail view and pass values to it
        //var_dump($post);
        $this->view("show",array(
            "post"=>$post,
           'other_posts'=> $other_posts,
           'comments'=> $comments,
            "title" => "Post details for ".$post->title
        ));
    }



    /**
    * Create a new post from the POST parameters
     * and reload the index.php.
    *
    */
    public function create_page(){


        //We create the category object
        // get all categories for update category
        $categories=new Category($this->Connection);
        //We get all the categories
        $categories=$categories->getAll();
        //We load the detail view and pass values to it
        //var_dump($post);
        $this->view("create",array(

            "categories"=>$categories,
            "title" => "Create new Post "
        ));
    }
    public function create(){
        if(isset($_POST["title"])){

            //Create
            $post=new Post($this->Connection);
            $post->settitle($_POST["title"]);
            $post->settext($_POST["text"]);
            $post->setcategory_id(($_POST["category_id"]));
            session_start();
            if(isset($_SESSION['user_id'] ))
                $post->setuser_id($_SESSION['user_id'] );
            else
                $post->setuser_id(1);
            $post->setstatus($_POST["status"]);
            $save=$post->save();
        }
        header('Location: index.php');
    }
    public function create_comment(){
        if(isset($_POST["email"])){

            //Create
            $comment=new Comment($this->Connection);
            $comment->setcontributor_name($_POST["contributor_name"]);
            $comment->setEmail($_POST["email"]);
            $comment->settext(($_POST["text"]));
            $comment->setpost_id($_POST['post_id'] );
            $comment->setpost_id($_POST['post_id'] );
            $comment->setparent_id(null);
            $comment->setstatus(1);
            $comment->setshow(1);
            $comment->setrank(1);


            $save=$comment->save();
        }
        header('Location: index.php?controller=posts&action=details&id='.$_POST['post_id']);

    }
    /**
     * Loads the post home page with the list of
     * post getting from the model.
     *
     */
    public function show_update(){

        //We load the model
        $model = new Post($this->Connection);
        //We recover the post from the BBDD
        $post = $model->getById($_GET["id"]);
        //We create the category object
        // get all categories for update category
        $categories=new Category($this->Connection);
        //We get all the categories
        $categories=$categories->getAll();
        //We load the detail view and pass values to it
        //var_dump($post);
        $this->view("edit",array(
            "post"=>$post,
            "categories"=>$categories,
            "title" => "Edit Post ".$post->title
        ));
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
            if(isset($_SESSION['user_id'] ))
              $post->setuser_id($_SESSION['user_id'] );
            else
                $post->setuser_id(1);
            $post->setstatus($_POST["status"]);
            $save=$post->update();

        }
       // header('Location: view/posts/index.php');
      //  header('Location: index.php');
    }
    public function delete(){
        if(isset($_POST["id"])){

            //We delete a post
            $post=new Post($this->Connection);
            $save=$post->deleteById($_POST["id"]);

        }
        // header('Location: view/posts/index.php');
          header('Location: index.php');
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
