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
    }

    