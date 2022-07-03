<?php
    namespace Model\Entities;

    use App\Entity;

    final class Message extends Entity{

        private $id;
        private $content;
        private $creationdate;
        private $user;
        private $topic;

        public function __construct($data){         
            $this->hydrate($data);        
        }
 
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of content
         */ 
        public function getContent()
        {
                return $this->content;
        }

        /**
         * Set the value of content
         *
         * @return  self
         */ 
        public function setContent($content)
        {
                $this->content = $content;

                return $this;
        }

        public function getCreationDate(){
            $date = $this->creationdate;
            $dateToFrench = $date;
            $fmt = datefmt_create(
                'fr_FR',
                \IntlDateFormatter::LONG,
                \IntlDateFormatter::MEDIUM,
                'Europe/Paris',
                \IntlDateFormatter::GREGORIAN
            ); 
            return datefmt_format($fmt, $dateToFrench);
        }

        public function setCreationDate($date){
            $this->creationdate = new \DateTime($date);
            return $this;
        }

        /**
         * Get the value of user
         */ 
        public function getUser()
        {
                return $this->user;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setUser($user)
        {
                $this->user = $user;

                return $this;
        }

        /**
         * Get the value of closed
         */ 
        public function getTopic()
        {
                return $this->topic;
        }

        /**
         * Set the value of closed
         *
         * @return  self
         */ 
        public function setTopic($topic)
        {
                $this->closed = $topic;

                return $this;
        }

        // public function lastInsertId()
        // {
        //         return $this->lastInsertId();
        // }
    }