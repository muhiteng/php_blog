<?php
class UsersController{

    private $conectar;
    private $Connection;

    public function __construct() {
		require_once  __DIR__ . "/../core/Conectar.php";
        require_once  __DIR__ . "/../model/user.php";
        
        $this->conectar=new Conectar();
        $this->Connection=$this->conectar->Connection();

    }

   /**
    *
    *  users route
    *
    */
    public function run($action){
        switch($action)
        { 
            case "index" :
                $this->index();
                break;
            case "login" :
                $this->login();
                break;
            case "logout" :
                $this->logout();
                break;
            case "register" :
                $this->register();
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
    public function login(){


       // header('Location: index.php');
        if(isset($_POST["email"])){

            //Create
            $user=new User($this->Connection);
            $user->setEmail($_POST["email"]);
            $user->setPassword(md5($_POST["password"]));
            // $user->setPassword($_POST["password"]);

            $save=$user->login();
            session_start();
            $_SESSION["user_id"] = $save->id;
           $_SESSION["user_name"] = $save->username;
            /*$this->view("index",array(
                "user"=>$save,
                "title" => "Users"
            ));*/
        }
        if(isset($_SESSION["user_id"]))
                header('Location: index.php');
        else
            header('Location: login.php');
    }
    public function logout(){


        session_start();

        session_unset();

        session_destroy();

        //  header('Location: index.php');
           header('Location: login.php');
    }
    public function register(){
        if(isset($_POST["username"])&& $_POST['password']== $_POST['cpassword']){

            //Create
            $user=new User($this->Connection);
            $user->setUserName($_POST["username"]);
            $user->setEmail($_POST["email"]);
            $user->setPassword(md5($_POST["password"]));
            $user->setRole(1);// we can provide role from select menu
            $save=$user->save();
            session_start();

        }
        if(isset($_SESSION["user_id"]))
            header('Location: index.php');
        else
            header('Location: login.php');
    }

    /**
    * Loads the users home page with the list of
    * users getting from the model User.
    *
    */ 
    public function index(){
        $_SESSION['user_id'] ="12";
        header('Location: index.php');
        //We create the user object
        $users=new User($this->Connection);
        
        //We get all the users
        $users=$users->getAll();
       
        //We load the index view and pass values to it
        $this->view("index",array(
            "users"=>$users,
            "title" => "Users"
        ));
    }

    /**
    * Loads the user home page with the list of
     * categories getting from the model.
    *
    */ 
    public function details(){
        
        //We load the model
        $model = new User($this->Connection);
        //We recover the user from the BBDD
        $user = $model->getById($_GET["id"]);
        //We load the detail view and pass values to it
        $this->view("show",array(
            "user"=>$user,
            "title" => "User details"
        ));
    }
    
   /**
    * Create a new user from the POST parameters
     * and reload the index.php.
    *
    */
    public function create(){
        if(isset($_POST["username"])){

            //Create
            $user=new User($this->Connection);
            $user->setUserName($_POST["username"]);
            $user->setEmail($_POST["email"]);
            $user->password(md5($_POST["password"]));
            $user->setRole($_POST["role"]);
            $save=$user->save();
        }
        header('Location: view/users/index.php');
    }

   /**
    * Update user from POST parameters
     * and reload the index.php.
    *
    */
    public function update(){
        if(isset($_POST["id"])){

            //We update a user
            $user=new User($this->Connection);
            $user->setId($_POST["id"]);
            $user->setUserName($_POST["username"]);
            $user->setEmail($_POST["email"]);
            $user->password(md5($_POST["password"]));
            $user->setRole($_POST["role"]);
            $save=$user->update();
        }
        header('Location: view/users/index.php');
    }
    
    
   /**
    * Create the view that we pass to it with the dedicated data.
    *
    */
    public function view($page,$data){
        $data = $data;
        require_once  __DIR__ . "/../view/users/" . $page . ".php";

    }

}
?>
