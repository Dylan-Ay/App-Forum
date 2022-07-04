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
            "SELECT content, creationdate, u.email as email, topic_id, user_id, id_message, COUNT(id_message) as nb
			FROM message m
            INNER JOIN user u
            ON u.id_user = m.user_id
            WHERE u.email = :email
            GROUP BY content
            ORDER BY creationdate DESC";

            return $this->getMultipleResults(
                DAO::select($sql, ['email' => $email]), 
                $this->className
            );
        }
    }