<?php
require_once "database.php";


class Category extends Database{

    public function getCat($user_id){
        $sql_array = "SELECT * FROM categories WHERE `user_id` = $user_id";

        if($cat_result = $this->conn->query($sql_array)){
            return $cat_result;

        }else{
            die("Error selecting category : " . $this->conn->error);
        }
    }

    public function inputCate($user_id, $cat_input){
        
        $sql_select = "SELECT category_name FROM categories WHERE `user_id` = $user_id";

        $result_cat = $this->conn->query($sql_select);

        if($result_cat->num_rows == 1){
            // カテゴリーが存在しなかったとき
            $sql_input = "INSERT INTO categories(`user_id`, category_name) VALUES ('$user_id', '$category')";

            if($this->conn->query($sql_input)){
                header("location: ../views/mainPage.php?id=$user_id");

            }else{
                die("Error inserting new category : " . $this->conn->error);
            }
        }
        

    }

    //カテゴリーのリストを取得
    public function getCateList($user_id){
        $sql_cate = "SELECT category_id, category_name FROM categories WHERE `user_id` = $user_id";

        if($cat_result = $this->conn->query($sql_cate)){
            return $cat_result;
        }else{
            die("Error selecting category : " . $this->conn->error);
        }
    }

    public function countCategory($category_id){
        $sql_cate = "SELECT COUNT(*) AS `count` FROM diary WHERE category_id = '$category_id'";

        if($cat_result = $this->conn->query($sql_cate)){
            $cat_row = $cat_result->fetch_assoc();
            return $cat_row['count'];
        }else{
            die("Error selecting category : " . $this->conn->error);
        }
    }

    public function getDateList($user_id){
        $sql_date = "SELECT DISTINCT `date` FROM diary WHERE `user_id` = $user_id";

        if($cat_result = $this->conn->query($sql_date)){
            return $cat_result;
        }else{
            die("Error selecting category : " . $this->conn->error);
        }
    }

    public function countDate($date, $user_id){
        $sql_date = "SELECT COUNT(*) AS `count` FROM diary 
        WHERE `date` = '$date' AND `user_id` = '$user_id'";

        if($date_result = $this->conn->query($sql_date)){
            $date_row = $date_result->fetch_assoc();
            return $date_row['count'];
        }else{
            die("Error selecting category : " . $this->conn->error);
        }
    }
}