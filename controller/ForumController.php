<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\MessageManager;
    use Model\Managers\CategoryManager;
    use Model\Managers\UserManager;
    use APP\DAO;

    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
        
        }
        
        // Categories List method
        public function listCategories()
        {
            $categoryManager = new CategoryManager();
            $session = new Session();

            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categoryManager->findAll(["creationdate", "DESC"]),
                    "session" => $session
                ]
            ];
        }

        // Topics list method
        public function listTopics($id)
        {
            $topicManager = new TopicManager();
            $categoryManager = new CategoryManager();
            $messageManager = new MessageManager();
            $session = new Session();

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findTopicsByCategory($id),
                    "category" => $categoryManager->findOneById($id),
                    "messages" => $messageManager->findAll(),
                    "session" => $session
                ]
            ];
        }

        // Detail topic method
        public function detailTopic($id)
        {
            $topicManager = new TopicManager();
            $messageManager = new MessageManager();
            $session = new Session();

            return [
                "view" => VIEW_DIR."forum/detailTopic.php",
                "data" => [
                    "topic" => $topicManager->findOneById($id),
                    "messages" => $messageManager->findMessagesByTopic($id),
                    'session' => $session
                ]
            ];
        }
        
        // Add Topic method
        public function addTopic($id)
        {
            $topicManager = new TopicManager();
            $messageManager = new MessageManager();
            $userManager = new UserManager();
            $session = new Session();

            if ($_SERVER['REQUEST_METHOD'] === "POST"){

                if (!empty($_POST['title']) && (!empty($_POST['message']))){

                    if($session->getUser()){

                        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
                        $message = filter_input(INPUT_POST, 'message', FILTER_DEFAULT);
                
                        $topicId = $topicManager->add([
                            'title' => $title,
                            'user_id' => $userManager->getUserByEmail($_SESSION['user'])->getId(),
                            'category_id' => $id
                        ]);
                                                 
                        $messageManager->add([
                            'content' => $message,
                            'user_id' => $userManager->getUserByEmail($_SESSION['user'])->getId(),
                            'topic_id' => $topicId
                        ]);

                        $this->redirectTo("forum", "detailTopic", $topicId);

                        return [
                            "view" => VIEW_DIR."forum/detailTopic.php",
                            "data" => [
                                "topic" => $topicManager->findOneById($id),
                                "messages" => $messageManager->findMessagesByTopic($id),
                                "session" => $session
                            ]
                        ];
                    }
                }
            }
        }

        // Fonction pour traiter l'ajout d'un message
        public function addMessage($id)
        {
            $topicManager = new TopicManager();
            $messageManager = new MessageManager();
            $userManager = new UserManager();
            $session = new Session();

            if ($_SERVER['REQUEST_METHOD'] === "POST"){

                if (!empty($_POST['message'])){

                    if ($session->getUser()){
                        
                        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        
                        $messageManager->add([
                            "content" => $message,
                            "user_id" => $userManager->getUserByEmail($_SESSION['user'])->getId(),
                            "topic_id" => $id
                        ]);

                        $this->redirectTo("forum", "detailTopic", $id);

                        return [
                            "view" => VIEW_DIR."forum/detailTopic.php",
                            "data" => [
                                "topic" => $topicManager->findOneById($id),
                                "messages" => $messageManager->findMessagesByTopic($id),
                                "session" => $session
                            ]
                        ];
                    }
                }
            }
        }
    }