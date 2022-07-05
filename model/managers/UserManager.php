<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }

        public function getUsersList()
        {
            $sql = 
            "SELECT id_user, nickname, email, role, registerdate, state, picture, COUNT(m.id_message) as nb
            FROM user u
            LEFT JOIN message m
            ON m.user_id = u.id_user
            GROUP BY nickname ASC;";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

        public function getUser($id)
        {
            $sql = 
            "SELECT id_user, nickname, email, role, registerdate, state, picture, COUNT(m.id_message) as nb, gender, birthdate, country
            FROM user u
            LEFT JOIN message m
            ON m.user_id = u.id_user
            WHERE u.id_user = :id
            GROUP BY nickname ASC";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }

        public function findOneByNickname($nickname)
        {
            $sql = 
            "SELECT u.nickname
            FROM ".$this->tableName." u
            WHERE u.nickname = :nickname";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['nickname' => $nickname], false), 
                $this->className
            );
        }

        public function getUserByEmail($email)
        {
            $sql = 
            "SELECT u.email, u.id_user, u.nickname, u.role, u.registerdate, u.picture, COUNT(m.id_message) as nb, u.gender, u.birthdate, u.country
            FROM ".$this->tableName." u
            LEFT JOIN message m
            ON m.user_id = u.id_user
            WHERE u.email = :email";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['email' => $email], false), 
                $this->className
            );
        }

        public function getUserByEmailCheckPassword($email)
        {
            $sql = 
            "SELECT DISTINCT u.email, u.password
            FROM ".$this->tableName." u
            LEFT JOIN message m
            ON m.user_id = u.id_user
            WHERE u.email = :email";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['email' => $email], false), 
                $this->className
            );
        }
    }