<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\MessageManager;
    use Model\Managers\UserManager;

    class UserController extends AbstractController implements ControllerInterface{

        public function index(){

        }

        // Method to get the users list for listUsers.php
        public function listUsers()
        {
            $userManager = new UserManager();
            $messageManager = new MessageManager();
            $session = new Session();

            return [
                "view" => VIEW_DIR."user/listUsers.php",
                "data" => [
                    "users" => $userManager->getUsersList(),
                    "message" => $messageManager,
                    "session" => $session
                ]
            ];
        }

        // Method to get the detail user by id for detailUser.php
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
    