<?php
include_once "database.php";

class Diary extends database{
    public function makeDiary($user_id, $date, $title, $diary_text, $category){

        $sql_category = "SELECT category_id FROM categories 
        WHERE `user_id` = '$user_id' AND category_name = '$category'";
        
        $result_cat = $this->conn->query($sql_category);

        if($result_cat->num_rows == 1){
            $category_id = $result_cat->fetch_assoc();

            $sql_diary = "INSERT INTO diary(`user_id`, `date`, title, diary_text, category_id)
                          VALUES ($user_id, '$date', '$title', '$diary_text',". $category_id['category_id'].")";

        }else{
            $sql_cate_insert = "INSERT INTO categories(`user_id`, category_name) VALUES ('$user_id', '$category')";

            if($this->conn->query($sql_cate_insert)){
                $sql_diary = "INSERT INTO diary(`user_id`, `date`, title, diary_text, category_id)
                              VALUES ($user_id, '$date', '$title', '$diary_text', ".$this->conn->insert_id.")";

            }else{
                die("Error inserting new category : " . $this->conn->error);
            }
        }

        if($this->conn->query($sql_diary)){
            header("location: ../views/mainPage.php?id=$user_id");

        }else{
            die("Error creating new entry : " . $this->conn->error);
        }
    }

    public function updateDiary($diary_no, $user_id, $title, $category, $diary_text){
        
        $sql_category = "SELECT category_id FROM categories 
        WHERE `user_id` = $user_id AND category_name = '$category'";
        
        $result_cat = $this->conn->query($sql_category);
        
        
        if($result_cat->num_rows == 1){
            $category_id = $result_cat->fetch_assoc();

            $diary_up = "UPDATE diary SET title = '$title', category_id = '" . $category_id['category_id'] . "', diary_text = '$diary_text'
                         WHERE diary_no = '$diary_no'";

        }else{
            $sql_cate_insert = "INSERT INTO categories(`user_id`, category_name) VALUES ('$user_id', '$category')";

            if($this->conn->query($sql_cate_insert)){
                $diary_up = "UPDATE diary SET title = '$title', category_id = '" . $this->conn->insert_id . "', diary_text = '$diary_text' WHERE diary_no = '$diary_no'";

            }else{
                die("Error inserting new category : " . $this->conn->error);
            }
        }

        if($this->conn->query($diary_up)){
            header("location: ../views/mainPage.php");
            exit;

        }else{
            die("Error creating new entry : " . $this->conn->error);
        }
    }

    public function deleteDiary($diary_no){
        $sql_sele = "SELECT `user_id` FROM diary WHERE diary_no = '$diary_no'";
        $result_who = $this->conn->query($sql_sele);
        $result_id = $result_who->fetch_assoc();

        $sql = "DELETE FROM diary WHERE diary_no = '$diary_no'";
        
        if($this->conn->query($sql)){
            header("location: ../views/mainPage.php?id=". $result_id['user_id']);
            exit;
        }else{
            die("Error deleting users" . $this->conn->error);
        }
    }
}