<?php
require_once "database.php";

class User extends Database{
    
    public function login($username, $password){
        $sql = "SELECT `user_id`, username, `password` FROM users WHERE username = '$username'";

        $result = $this->conn->query($sql);

        //num_rows → sqlの行数を返す
        if($result->num_rows == 1){
            $user_details = $result->fetch_assoc();
            
            //password_verify → ハッシュ化されたパスワード同士で突き合わせをする
            if(password_verify($password, $user_details['password'])){

                session_start();

                $_SESSION['user_id'] = $user_details['user_id'];
                $_SESSION['username'] = $user_details['username'];

                header("location: ../views/mainPage.php");

            }else{
                echo "The username or password you entered is incorrect ";
            }

        }else{
            echo "The username or password you entered is incorrect ";
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

    // public function isExisting($username){
    //     $check_name = "SELECT `user_name` FROM user WHERE `user_name` = $username";
    //     $result_name = $this->conn->query($check_name);

    //     if($result_name->num_rows = 1){
    //         ini_set('display_errors', 1);
    //         echo "Your username is aleady used another people.<br>
    //               So you should chenge your username.";

    //     }else{
    //         $sql ="INSERT INTO users(username, `password`) 
    //             VALUES ('$username', '$password')";

    //             if($this->conn->query($sql)){
    //                 if($origin == "register"){
    //                     header("location: ../views/login.php"); //go to login.php /login page
    //                     exit;
    //                 }elseif($origin == "login"){
    //                     header("location: ../views/mainPage.php");
    //                     exit;
    //                 }
                    
        
    //             }else{
    //                 die("Error creating user : " .$this->conn->error);
    //             }
    //     }
    // }
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

    

    public function getUser($user_id){
        $sql ="SELECT d.date, d.title, c.category_name FROM diary d, categories c 
               WHERE d.category_id = c.category_id AND d.user_id = $user_id";
        
        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();

        }else{
            die("Error retrieving users" . $this->conn->error);
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

