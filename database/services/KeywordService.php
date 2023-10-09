<?php

class KeywordService
{
    public $db = null;

    public function __construct(DBController $db)
    {
        $this->db = $db;
    }

    public function getKeywordById($id){
        
        if (isset($id)) {
            $result = $this->db->connection->query("SELECT * FROM `keywords` WHERE id = $id");
            $resultArray = array();

            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }

            return $resultArray;
        }

    }

    public function getKeywordByName($name){
        
        if (isset($name)) {
            $result = $this->db->connection->query("SELECT * FROM `keywords` WHERE `name` = $name");
            $resultArray = array();

            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }

            return $resultArray;
        }

    }

    public function getSimilar($userId, $keyword){
        if (isset($userId) && isset($keyword)) {
            // Получение ключевых слов пользователя из таблицы users
            $userKeywords = $this->getUserKeywordsList($userId);

            if (!empty($userKeywords)) {

                // Форматирование строки чтобы в итоге получ
                $userKeywordsString = str_replace(['"', "[", "]"], '', implode(',', $userKeywords));

                if(!empty($userKeywordsString)){
                    // Выполнение запроса для получения ключевых слов, которых нет у пользователя
                    $result = $this->db->connection->query("SELECT * FROM keywords WHERE id NOT IN ($userKeywordsString) AND name LIKE '%$keyword%' ORDER BY name ASC LIMIT 15");

                    if($result !== false){
                        $resultArray = array();

                        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $resultArray[] = $item;
                        }

                        echo json_encode($resultArray);
                    }  
                } else {
                    // Показать все
                    $result = $this->db->connection->query("SELECT * FROM keywords WHERE id NOT IN (0) AND name LIKE '%$keyword%' ORDER BY name ASC LIMIT 15");

                    if($result !== false){
                        $resultArray = array();

                        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $resultArray[] = $item;
                        }

                        echo json_encode($resultArray);
                    }  
                }
                
            }
        }
    }

    public function getUserKeywordsList($userId){
        // Получение ключевых слов пользователя из таблицы users
        $query = "SELECT keywords FROM users WHERE id = ?";
        $stmt = $this->db->connection->prepare($query);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $stmt->bind_result($keywords);

        if ($stmt->fetch()) {
            // Преобразование строки с ключевыми словами в массив
            $userKeywords = explode(',', $keywords);
            return $userKeywords;
        }

        return array(); // Возвращаем пустой массив, если ключевых слов нет
    }
}