<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\MessageManager;
    use Model\Managers\UserManager;

    class SecurityController extends AbstractController implements ControllerInterface{

        // Method to Display the registration page
        public function registerForm()
        {
            $session = new Session;
            
            return [
                "view" => VIEW_DIR."security/signup.php",
                "data" => [
                    "session" => $session
                ]
            ];
        }

        // Method to treats the form and to validate the registration and to create the user
        public function register()
        {
            $session = new Session;

            if (!empty($_POST['nickname'] && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm-password']) && !empty($_POST['birthdate'])))

            {
                $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

                $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $country = filter_input(INPUT_POST, "country", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $confirmPassword = filter_input(INPUT_POST, "confirm-password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $birthdate = filter_input(INPUT_POST, "birthdate", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
            else{
                $session->addFlash('signup-message',
                '<div class="alert alert-danger text-center" role="alert">
                    Erreur : Veuillez remplir tous les champs requis.
                </div>' );
            }

            // If all the inputs are validated we continue the process

            if ($nickname && $email && $gender && $country && $password && $confirmPassword && $birthdate){

                if ($password === $confirmPassword && strlen($password) >= 8){

                    $userManager = new UserManager();
                    $userNickname = $userManager->findOneByNickname($nickname);
                    $userMail = $userManager->getUserByEmail($email);

                    // If the nickname or the email doesn't exist in db, we hash the password and we create the user

                    if (!$userNickname){
                        if (!$userMail){
                            $hash = password_hash($password, PASSWORD_DEFAULT);
    
                            if($userManager->add([
                                "nickname" => $nickname,
                                "email" => $email,
                                "gender" => $gender,
                                "country" => $country,
                                "password" => $hash,
                                "birthdate" => $birthdate
                            ])){
                                $session->addFlash('signup-message',
                                '<div class="alert alert-success text-center" role="alert">
                                    Votre compte a bien été crée.
                                </div>' );
                            }
                        }else{
                            $session->addFlash('signup-message',
                                '<div class="alert alert-danger text-center" role="alert">
                                    Erreur :  Un compte a déjà été crée avec cette adresse email. Veuillez vous <a href="index.php?ctrl=security&action=login" class="bold">connecter</a> ou créer un compte avec un email différent.
                                </div>' );

                            return [
                                "view" => VIEW_DIR."security/signup.php",
                                "data" => [
                                    "session" => $session
                                ]
                            ];
                        }
                    }else{
                        $session->addFlash('signup-message',
                            '<div class="alert alert-danger text-center" role="alert">
                                Erreur :  Un compte a déjà été crée avec ce pseudo. Veuillez vous <a href="index.php?ctrl=security&action=login" class="bold">connecter</a> ou créer un compte avec un pseudo différent.
                            </div>' );

                        return [
                            "view" => VIEW_DIR."security/signup.php",
                            "data" => [
                                "session" => $session
                            ]
                        ];
                    }
                }else{
                    $session->addFlash('signup-message',
                    '<div class="alert alert-danger text-center" role="alert">
                        Erreur :  Le mot de passe doit contenir au moins 8 caractères.
                    </div>' );

                    return [
                        "view" => VIEW_DIR."security/signup.php",
                        "data" => [
                            "session" => $session
                        ]
                    ];
                }
            }
            $session->addFlash('signup-message',
                    '<div class="alert alert-danger text-center" role="alert">
                        Erreur :  Veuillez remplir correctement le formulaire.
                    </div>' );

            return [
                "view" => VIEW_DIR."security/signup.php",
                "data" => [
                    "session" => $session
                ]
            ];
        }

        // Method to display the login page
        public function login()
        {
            $session = new Session;

            return [
                "view" => VIEW_DIR."security/login.php",
                "data" => [
                    "session" => $session
                ]
            ];
        }

        // Method to display the detailAccount page
        public function detailAccount()
        {
            $userManager = new UserManager();
            $messageManager = new MessageManager();
            $session = new Session();
  
            return [
                "view" => VIEW_DIR."security/detailAccount.php",
                "data" => [
                    "user" => $userManager->getUserByEmail($session->getUser()),
                    "messages" => $messageManager->findMessagesByEmail($session->getUser()),
                    "session" => $session
                ]
            ];
        }

        // Method to treats the login form
        public function submitLogin()
        {
            $session = new Session;
        // We check that the inputs aren't empty 
            if (!empty($_POST['email']) && !empty($_POST['password'])){

                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // If both inputs we get are validated we continue the process
                
                if ($email && $password){

                    $userManager = new UserManager;
                    $emailExists = $userManager->getUserByEmail($email);
                    $passwordMatches = $userManager->getUserByEmailCheckPassword($email);

                    // If the email exists and the password matches to the email which both exist in the db we put in session the user email

                    if ($emailExists && password_verify($password, $passwordMatches->getPassword())){
                        
                        $session->setUser($email);

                        return [
                            "view" => VIEW_DIR."security/detailAccount.php",
                            "data" => [
                                "user" => $userManager->getUserByEmail($email),
                                "session" => $session
                            ]
                        ];
                    }else{
                        $session->addFlash('login-message',
                        '<div class="alert alert-danger text-center" role="alert">
                            Erreur : aucun résultat ne correspond à cette adresse électronique et/ou mot de passe.
                            Merci de réessayer.
                        </div>' );

                        return [
                            "view" => VIEW_DIR."security/login.php",
                            "data" => [
                                "session" => $session
                            ]
                        ];
                    }
                }
            }else{
                $session->addFlash('login-message',
                '<div class="alert alert-danger text-center" role="alert">
                        Erreur : Veuillez insérez un email et un mot de passe.
                </div>' );
                
                return [
                    "view" => VIEW_DIR."security/login.php",
                    "data" => [
                        "session" => $session
                    ]
                ];
            }
        }

        // Method to allows the user to logout
        public function logout()
        {
            unset($_SESSION["user"]);

            $session = new Session;
                return [
                    "view" => VIEW_DIR."home.php",
                    "data" =>[
                        "session" => $session
                    ]
                ];
        }

        public function modifyPassword()
        {
            $session = new Session;
            $userManager = new UserManager;

            return [
                "view" => VIEW_DIR."security/modifyPassword.php",
                "data" => [
                    "user" => $userManager->getUserByEmail($session->getUser()),
                    "session" => $session
                ]
            ];
        }

        public function modifyPasswordSubmit()
        {
            $session = new Session;
            $userManager = new UserManager;

            if ($_SERVER['REQUEST_METHOD'] === "POST"){

                if (!empty($_POST['password']) && !empty($_POST['confirm-password'])){

                    if ($_POST['password'] === $_POST['confirm-password']){
                        
                        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                        if ($password && strlen($password) >= 8){
                            
                        }else{
                            
                            $session->addFlash('password-message',
                                '<div class="alert alert-danger text-center" role="alert">
                                        Erreur : Le mot de passe doit au moins contenir 8 caractères.
                                </div>' );
                        }
                    }else{
                        $session->addFlash('password-message',
                            '<div class="alert alert-danger text-center" role="alert">
                                    Erreur : Les mots de passes ne correspondent pas.
                            </div>' );
                    }
                }else{
                    $session->addFlash('password-message',
                        '<div class="alert alert-danger text-center" role="alert">
                                Erreur : Veuillez remplir les deux champs.
                        </div>' );
                }
            }

            return [
                "view" => VIEW_DIR."security/modifyPassword.php",
                "data" => [
                    "user" => $userManager->getUserByEmail($session->getUser()),
                    "session" => $session
                ]
            ];
        }

        public function modifyAccount()
        {
            $session = new Session;
            $userManager = new UserManager;

            return [
                "view" => VIEW_DIR."security/modifyAccount.php",
                "data" => [
                    "user" => $userManager->getUserByEmail($session->getUser()),
                    "session" => $session
                ]
            ];
        }

        public function modifyAccountSubmit()
        {
            $session = new Session;
            $userManager = new UserManager;

            return [
                "view" => VIEW_DIR."security/modifyAccount.php",
                "data" => [
                    "user" => $userManager->getUserByEmail($session->getUser()),
                    "session" => $session
                ]
            ];
        }

    }
