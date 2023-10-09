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

    public function delete($activity_id) {
        if (isset($activity_id)) {
            // SQL-запрос для удаления из таблицы
            $sql = "DELETE FROM $this->table_name WHERE activity_id = $activity_id";

            $this->db->connection->query($sql);
        }
    }

    public function add_image($activity_id, $filepath){
        $sql = "UPDATE $this->table_name SET `image` = '$filepath' WHERE `activity_id` = $activity_id";

        $this->db->connection->query($sql);
    }


}