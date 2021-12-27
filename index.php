<?php
//Global setting
require_once 'config/global.php';
$_SESSION['user_id']=1;
//We load the controller and execute the action
if(isset($_GET["controller"])){
    // We load the instance of the corresponding controller
    $controllerObj=instanceControllere($_GET["controller"]);
    //We launch the action
    launchAction($controllerObj);
}else{
    // We load the default controller instance
    $controllerObj=instanceControllere(CONTROLLER_DEFECTO);
   // echo  CONTROLLER_DEFECTO;
    // We launch the action
    launchAction($controllerObj);
}


function instanceControllere($controller){

    switch ($controller) {
        case 'users':
            $strFileController='controller/usersController.php';
            require_once $strFileController;
            $controllerObj=new UsersController();
            break;
        case 'categories':
            $strFileController='controller/categoriesController.php';
            require_once $strFileController;
            $controllerObj=new CategoriesController();
            break;
        case 'posts':
            $strFileController='controller/postsController.php';
            require_once $strFileController;
            $controllerObj=new PostsController();
            break;

        default:
            $strFileController='controller/usersController.php';
            require_once $strFileController;
            $controllerObj=new UsersController();
            break;
    }
    return $controllerObj;
}

function launchAction($controllerObj){
    if(isset($_GET["action"])){
        $controllerObj->run($_GET["action"]);
    }else{
        $controllerObj->run(DEFECT_ACTION);
    }
}


?>