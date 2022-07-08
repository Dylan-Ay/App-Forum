<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity{

        private $id;
        private $nickname;
        private $email;
        private $roles;
        private $registerdate;
        private $state;
        private $picture;
        private $password;
        private $nb;
        private $gender;
        private $birthdate;
        private $country;

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
         * Get the value of nickname
         */ 
        public function getNickname()
        {
                return $this->nickname;
        }

        /**
         * Set the value of nickname
         *
         * @return  self
         */ 
        public function setNickname($nickname)
        {
                $this->nickname = $nickname;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of state
         */ 

        public function getState()
        {
                return $this->state;
        }

        /**
         * Set the value of state
         *
         * @return  self
         */ 
        public function setState($state)
        {
                $this->state = $state;

                return $this;
        }
        
        /**
         * Get the value of role
         */ 
        public function getRoles()
        {
                return $this->roles;
        }

        /**
         * Set the value of role
         *
         * @return  self
         */ 
        public function setRoles($roles)
        {
                $this->roles = json_decode($roles);
                if(empty($this->roles)){
                        $this->roles [] = "ROLE_USER";
                }
        }

        public function hasRole($role)
        {
                return in_array($role, $this->getRoles());
        }

        /**
         * Get the value of registerdate
         */ 

        public function getRegisterDate(){

            $formattedDate = $this->registerdate;
            return $formattedDate;
        }

        public function getRegisterDateFull()
        {
            $formattedDate = $this->registerdate;
            $dateToFrench = $formattedDate;
            $fmt = datefmt_create(
                'fr_FR',
                \IntlDateFormatter::MEDIUM,
                \IntlDateFormatter::NONE,
                'Europe/Paris',
                \IntlDateFormatter::GREGORIAN
            ); 
            return datefmt_format($fmt, $dateToFrench);
        }
        /**
         * Set the value of registerdate
         */

        public function setRegisterDate($date){
                $this->registerdate = new \DateTime($date);
                return $this;
        }

        /**
         * Get the value of picture
         */ 
        public function getPicture()
        {
                return $this->picture;
        }

        /**
         * Set the value of picture
         *
         * @return  self
         */ 
        public function setPicture($picture)
        {
                $this->picture = $picture;

                return $this;
        }

        /**
         * Get the value of nb
         */ 
        public function getNb()
        {
                return $this->nb;
        }

        /**
         * Set the value of nb
         *
         * @return  self
         */ 
        public function setNb($nb)
        {
                $this->nb = $nb;

                return $this;
        }

        /**
         * Get the value of gender
         */ 
        public function getGender()
        {
                return $this->gender;
        }

        /**
         * Set the value of gender
         *
         * @return  self
         */ 
        public function setGender($gender)
        {
                $this->gender = $gender;

                return $this;
        }

        /**
         * Get the value of birthdate
         */ 
        public function getBirthdate()
        {
                return $this->birthdate;
        }

        public function getAge()
        {
                $personAge = $this->birthdate;
                $dateNow = new \DateTime();
                return $personAge->diff($dateNow)->y." ans";
        }

        /**
         * Set the value of birthdate
         *
         * @return  self
         */ 
        public function setBirthdate($birthdate)
        {
                $this->birthdate = new \DateTime($birthdate);

                return $this;
        }

        /**
         * Get the value of country
         */ 
        public function getCountry()
        {
                return $this->country;
        }

        /**
         * Set the value of country
         *
         * @return  self
         */ 
        public function setCountry($country)
        {
                $this->country = $country;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

    }
