<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class CategoryManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "category";


        public function __construct(){
            parent::connect();
        }

    }