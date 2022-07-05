<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class MessageManager extends Manager{

        protected $className = "Model\Entities\Message";
        protected $tableName = "message";


        public function __construct(){
            parent::connect();
        }
        
        public function findMessagesByTopic($id){

            $sql = 
            "SELECT content, creationdate, m.user_id, topic_id
            FROM message m
            INNER JOIN user u
            ON u.id_user = m.user_id
            WHERE topic_id = :id
            GROUP BY creationdate;";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]), 
                $this->className
            );
        }

        public function findMessagesByEmail($email)
        {
            $sql = 
                "SELECT t.title, m.content, m.creationdate, m.user_id, m.topic_id, COUNT(m.id_message) as nb
                FROM topic t
                INNER JOIN message m
                ON t.id_topic = m.topic_id
                INNER JOIN user u
                ON m.user_id = u.id_user
                WHERE u.email = :email
                GROUP BY m.content
                ORDER BY m.creationdate
            ";

            return $this->getMultipleResults(
                DAO::select($sql, ['email' => $email]), 
                $this->className
            );
        }
    }