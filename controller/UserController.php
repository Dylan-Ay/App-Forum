<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;

    class UserController extends AbstractController implements ControllerInterface{

        public function index(){

        }

        // Get users list method
        public function listUsers()
        {
            $userManager = new UserManager();
            $session = new Session();

            return [
                "view" => VIEW_DIR."user/listUsers.php",
                "data" => [
                    "users" => $userManager->getUsersList(),
                    "session" => $session
                ]
            ];
        }

        // Get user detail method
        public function detailUser($id)
        {
            $userManager = new UserManager();
            $session = new Session();
            
            return [
                "view" => VIEW_DIR."user/detailUser.php",
                "data" => [
                    "user" => $userManager->getUser($id),
                    "session" => $session
                ]
            ];
        }

    }
    