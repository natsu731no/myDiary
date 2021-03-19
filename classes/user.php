<?php
require_once "database.php";

class User extends Database{
    public function login($username, $password){
        $sql = "SELECT `user_id`, username, `password` FROM users WHERE username = '$username'";

        $result = $this->conn->query($sql);

        //num_rows → sqlの行数を返す
        if($result->num_rows == 1){
            $user_detailes = $result->fetch_assoc();
            
            //password_verify → ハッシュ化されたパスワード同士で突き合わせをする
            if(password_verify($password, $user_detailes['password'])){

                session_start();

                $_SESSION['user_id'] = $user_detailes['user_id'];
                $_SESSION['username'] = $user_detailes['username'];

                header("location: ../views/mainPage.php?id={$_SESSION['user_id']}");

            }else{
                echo "The username or password you entered is incprrect ";
            }

        }else{
            echo "The username or password you entered is incprrect ";
        }
    }


    public function createUser($username, $password, $origin){
        $sql ="INSERT INTO users(username, `password`) 
                VALUES ('$username', '$password')";

        if($this->conn->query($sql)){
            if($origin == "register"){
                header("location: ../views/login.php"); //go to login.php /login page
                exit;
            }elseif($origin == "login"){
                header("location: ../views/mainPage.php");
                exit;
            }
            

        }else{
            die("Error creating user : " .$this->conn->error);
        }
    }

    // Diary list of mainPage.php
    public function indicateList($user_id){
        $sql ="SELECT d.date, d.title, c.category_name, d.diary_no FROM diary d, categories c 
               WHERE d.category_id = c.category_id AND d.user_id = '$user_id' ORDER BY d.diary_no DESC";

        if($result = $this->conn->query($sql)){
            return $result;

        }else{
            die("Error retrieving users" . $this->conn->error);
        }
    }

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

    public function getUser($user_id){
        $sql ="SELECT d.date, d.title, c.category_name FROM diary d, categories c 
               WHERE d.category_id = c.category_id AND d.user_id = $user_id";
        
        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();

        }else{
            die("Error retrieving users" . $this->conn->error);
        }
    }

    public function updateDiary($diary_no, $date, $title, $category, $diary_text){
        $sql_who = "SELECT `user_id` FROM diary WHERE diary_no = '$diary_no'";
        
        $sql_category = "SELECT category_id FROM categories 
        WHERE `user_id` = '$sql_who' AND category_name = '$category'";
        
        $result_cat = $this->conn->query($sql_category);
        $result_who = $this->conn->query($sql_who);
        
        if($result_cat->num_rows == 1){
            $category_id = $result_cat->fetch_assoc();

            $diary_up = "UPDATE diary SET title = '$title', category_id = $category_id, diary_text = $diary_text
                         WHERE diary_no = '$diary_no'";
            //$sql = "UPDATE users SET first_name  = '$first_name', last_name = '$last_name', username = '$username' WHERE id = $user_id ";
            // $sql_diary = "INSERT INTO diary(`user_id`, `date`, title, diary_text, category_id)
            //               VALUES ($user_id, '$date', '$title', '$diary_text',". $category_id['category_id'].")";

        }else{
            $sql_cate_insert = "INSERT INTO categories(`user_id`, category_name) VALUES ('$result_who', '$category')";

            if($this->conn->query($sql_cate_insert)){
                $diary_up = "UPDATE diary SET title = '$title', category_id =" .$this->conn->insert_id.", diary_text = $diary_text";

            }else{
                die("Error inserting new category : " . $this->conn->error);
            }
        }

        if($this->conn->query($sql_diary)){
            header("location: ../views/mainPage.php?id=$result_who");

        }else{
            die("Error creating new entry : " . $this->conn->error);
        }
    }
    

    // public function updateUser($user_id, $first_name, $last_name, $username){
    //     $sql = "UPDATE users SET first_name  = '$first_name', last_name = '$last_name', username = '$username' WHERE id = $user_id ";
    
    //     if($this->conn->query($sql)){
    //         header("location: ../views/dashboard.php");
    //         exit;
    //     }else{
    //         die("Error retrieving users" . $this->conn->error);
    //     }
    
    
    // }

    // public function deleteUser($user_id){
    //     $sql = "DELETE FROM users WHERE id = $user_id";

    //     if($this->conn->query($sql)){
    //         header("location: ../views/dashboard.php");
    //         exit;
    //     }else{
    //         die("Error retrieving users" . $this->conn->error);
    //     }
    // }

    

}

