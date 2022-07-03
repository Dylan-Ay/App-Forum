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

            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categoryManager->findAll(["creationdate", "DESC"])
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
                        $topicId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

                        $sql= $topicManager->add([
                                'title' => $title,
                                'user_id' => $userManager->getUserByEmail($_SESSION['user'])->getId(), // Il faut récupérer l'ID du user connecté
                                'category_id' => $topicId
                            ]);
                        
                        // $topicId = $topicManager->insert($sql);
                            
                        $messageManager->add([
                            'content' => $message,
                            'user_id' => $userManager->getUserByEmail($_SESSION['user'])->getId(), // Il faut récupérer l'ID du user connecté
                            'topic_id' => 20 // Il faut récupérer le lastInsertId
                        ]);
                        $id = 23;

                        header('Location: index.php?ctrl=forum&action=detailTopic&id='.$id); // Fonction redirectTo ?

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

        public function addMessage()
        {
            // Fonction pour traiter l'ajout d'un message
        }
    }