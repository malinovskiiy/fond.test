<?php

class ActivityService
{
    protected $db = null;
    public $table_name;

    public function __construct(DBController $db, $table_name)
    {
        $this->db = $db;
        $this->table_name = $table_name;
    }

    public function calculatePoints($user_id){
        
        if (isset($user_id)) {
            // SQL-запрос для подсчета суммы баллов
            $sql = "SELECT SUM(points) as total_points FROM $this->table_name WHERE user_id = $user_id";

            $result = $this->db->connection->query($sql);

            $row = $result->fetch_assoc();
            $totalPoints = $row['total_points'];

            return $totalPoints;
        }
    }

    public function getAll($user_id) {
        if(isset($user_id)){
            
            $sql = "SELECT * FROM " . $this->table_name . " WHERE user_id = ? ORDER BY activity_id DESC";
            $stmt = $this->db->connection->prepare($sql);
            $stmt->bind_param("i", $user_id); // "i" означает, что $user_id - это целое число
            $stmt->execute();
            
            $result = $stmt->get_result();
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            
            $stmt->close();
            
            return $data;
        }
    }

    public function getById($activity_id){
        if(isset($activity_id)){
            $sql = "SELECT * FROM " . $this->table_name . " WHERE activity_id = ? ";
            $stmt = $this->db->connection->prepare($sql);
            $stmt->bind_param("i", $activity_id);
            $stmt->execute();
    
            $result = $stmt->get_result()->fetch_assoc();
    
            $stmt->close();
    
            return $result;
        }
    }

    public function generateActivityString($activity_category, $activity_type, $activity_subtype, $activity_year) {
        
        $categories = [
            'publication' => 'Публикация',
            'intellectual_property' => 'Инт. собственность',
            'grant_activity' => 'Грант',
            'conferences' => 'Конференция',
            'in_fond' => 'В Фонде',
            'not_only_in_fond' => 'Другое',
            'international' => 'Международное',
            'russian' => 'Всероссийское',
            'regional' => 'Региональное',
            'participant' => 'Участник'
        ];
    
        $types = [
            'scopus' => 'SCOPUS/WoS',
            'vak' => 'ВАК',
            'rinc' => 'РИНЦ',
            'patent' => 'Патент',
            'computer_certificate' => 'Программа для ЭВМ',
            'international' => $activity_category === 'grant_activity' ? 'Международный' : 'Международное',
            'russian' => $activity_category === 'grant_activity' ? 'Всероссийский' : 'Всероссийское',
            'regional' => $activity_category === 'grant_activity' ? 'Региональный' :'Региональное',
            'curator' => 'Организатор',
            'participant' => 'Участник'
        ];
    
        $subtypes = [
            'q1' => 'Q1',
            'q2' => 'Q2',
            'q3' => 'Q3',
            'invention' => 'Изобретение',
            'model' => 'Пол. модель',
            'head' => 'Руководитель',
            'performer' => 'Исполнитель'
        ];
    
        $result = '';
    
        if (isset($categories[$activity_category])) {
            $result .= $categories[$activity_category];
    
            if (isset($types[$activity_type])) {
                $result .= ' • ' . $types[$activity_type];
    
                if (isset($subtypes[$activity_subtype])) {
                    $result .= ' • ' . $subtypes[$activity_subtype];
                }
            }
        }
    
        $result .= ' • ' . $activity_year;
    
        return $result;
    }

    public function createActivity($user_id, $activity_category, $image, $title, $year, $description, $link) {
        
        // Определите баллы в соответствии с выбранными параметрами
        $points = 0;

        if ($activity_category === 'international') {           
            if($this->table_name === 'scholarship_activity'){
                $points = 10;
            } else {
                $points = 5;
            }       
        } elseif ($activity_category === 'russian') {        
            if($this->table_name === 'scholarship_activity'){
                $points = 5;
            } else {
                $points = 3;
            }          
        } elseif ($activity_category === 'regional') {
            if($this->table_name === 'scholarship_activity'){
                $points = 3;
            } else {
                $points = 1;
            }       
        } elseif ($activity_category === 'participant') {
            $points = 1;         
        }

        // Создайте запись в базе данных (предполагается, что у вас есть подключение к БД)
        $sql = "INSERT INTO `". $this->table_name ."` (`activity_id`, `user_id`, `points`, `activity_category`, `image`, `title`, `year`, `preview_text`, `link`) VALUES (NULL, '$user_id', '$points', '$activity_category', '$image', '$title', '$year', '$description', '$link')";
        
        // Выполните SQL-запрос и проверьте результат
        $this->db->connection->query($sql);
    }

    public function updateActivity($activity_id, $activity_category, $image, $title, $year, $description, $link){

        // Определите баллы в соответствии с выбранными параметрами
        $points = 0;

        if ($activity_category === 'international') {           
            if($this->table_name === 'scholarship_activity'){
                $points = 10;
            } else {
                $points = 5;
            }       
        } elseif ($activity_category === 'russian') {        
            if($this->table_name === 'scholarship_activity'){
                $points = 5;
            } else {
                $points = 3;
            }          
        } elseif ($activity_category === 'regional') {
            if($this->table_name === 'scholarship_activity'){
                $points = 3;
            } else {
                $points = 1;
            }       
        } elseif ($activity_category === 'participant') {
            $points = 1;         
        }

        $sql = "UPDATE `". $this->table_name ."` SET `points`= $points, `activity_category`= '$activity_category', `image`= '$image', `title`='$title', `year`=$year, `preview_text`='$description', `link`='$link' WHERE `activity_id`=$activity_id";
        $this->db->connection->query($sql);

        echo '{"new_image":"'. $image .'", "new_title": "'. $title .'"}';
        
    }
}