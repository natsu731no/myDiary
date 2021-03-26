<?php
require_once "database.php";

class checkPage extends database{
    public function check($diary_no){
        $sql_select = "SELECT d.title, c.category_name, d.diary_text
                       FROM diary d, categories c
                       WHERE d.category_id = c.category_id
                       AND d.diary_no = '$diary_no'";

        if($result = $this->conn->query($sql_select)){
            return $result->fetch_assoc();
        }else{
            die("Error selecting category : " . $this->conn->error);
        }               

    }
}