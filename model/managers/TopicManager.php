<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }

        // Method to get the topics by category, we also get the number of messages by topic with nb and getNb()
        public function findTopicsByCategory($id){

            $sql = 
            "SELECT id_topic, title, t.user_id as user_id, category_id, t.creationdate AS creationdate, closed, COUNT(m.id_message) AS nb
            FROM topic t
            INNER JOIN message m 
            ON m.topic_id = t.id_topic
            WHERE t.category_id = :id
            GROUP BY t.id_topic;";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]), 
                $this->className
            );
        }

        // Method to find the last five topics for the home
        public function findLastFiveTopics(){
            $sql=
            "SELECT *
            FROM topic
            ORDER BY creationdate DESC LIMIT 5";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );

        }

        //Method to get the topic by id
        public function getTopicTitleById($id)
        {
            $sql =
            "SELECT *
            FROM topic
            WHERE id_topic = :id";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }
    }