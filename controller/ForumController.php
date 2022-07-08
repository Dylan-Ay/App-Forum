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
        
        // Method to display the list of categories
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

        // Method to display the list of topics
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
                    "message" => $messageManager,
                    "session" => $session
                ]
            ];
        }
        // Method to delete a topic
        public function deleteTopic($id)
        {
            $topicManager = new TopicManager();
            $session = new Session();
            
            $referer = $_SERVER['HTTP_REFERER'];

            $topicTitle = $topicManager->getTopicTitleById($id)->getTitle();

            $topicManager->delete($id);

            $session->addFlash('message-topic',
                '<div class="alert alert-success text-center" role="alert">
                Le sujet <strong>"'.$topicTitle.'"</strong> a bien été supprimé.
            </div>');
            
            header("Location: $referer");
        }

        // Method to display the detail of topic
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

        
        // Method to add a topic
        public function addTopic($id)
        {
            $topicManager = new TopicManager();
            $messageManager = new MessageManager();
            $userManager = new UserManager();
            $session = new Session();

            if ($_SERVER['REQUEST_METHOD'] === "POST"){

                if (!empty($_POST['title']) && (!empty($_POST['message']))){
                    // If the user is logged we filter the inputs and we execute de add method
                    //We get the $topicId from the add method to get the lastInsertId topic in order to add the message to the right topic
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
                        $session->addFlash('success-new-topic',
                            '<div class="alert alert-success text-center" role="alert">
                                Le sujet <strong>"'.$title.'"</strong> a bien été crée et votre message a bien été posté !
                            </div>' );

                        $this->redirectTo("forum", "detailTopic", $topicId);

                    }else{
                        $session->addFlash('message-topic',
                            '<div class="alert alert-danger text-center" role="alert">
                                Erreur : Pour insérer un message vous devez être connecté.
                            </div>' );
    
                        $this->redirectTo("forum", "listTopics", $id);
                    }

                }else{
                    $session->addFlash('message-topic',
                        '<div class="alert alert-danger text-center" role="alert">
                            Erreur : Veuillez remplir les deux champs.
                        </div>' );

                    $this->redirectTo("forum", "listTopics", $id);
                }

            }else{
                $this->redirectTo("forum", "listTopics", $id);
            }
        }

        // Method to treat the add message form
        public function addMessage($id)
        {
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

                        $session->addFlash('success-topic-message',
                            '<div class="alert alert-success text-center" role="alert">
                                Votre message a bien été posté !
                            </div>' );
                        $this->redirectTo("forum", "detailTopic", $id);

                    }else{
                        $session->addFlash('error-topic-message',
                            '<div class="alert alert-danger text-center" role="alert">
                                Erreur : Pour insérer un message vous devez être connecté.
                            </div>' );
    
                        $this->redirectTo("forum", "detailTopic", $id);
                    }
                }else{
                    $session->addFlash('error-topic-message',
                        '<div class="alert alert-danger text-center" role="alert">
                            Erreur : Veuillez insérez un message.
                        </div>' );

                    $this->redirectTo("forum", "detailTopic", $id);
                }

            }else{
                $this->redirectTo("forum", "detailTopic", $id);
            }
        }
    }