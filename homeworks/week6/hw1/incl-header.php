<div class="header">
    <div class="home"><a href="index.php"><b>I WANT TO SAY.</b></a></div> 
    <div class="login">
        
        <?php 
            
            $user_id = '';
            
            //判斷是否登入過
            if(isset($_COOKIE["user_id"])){
                $session_id = $_COOKIE["user_id"];
                $stmt = $conn->prepare("SELECT * FROM annieshen_users_certificate where id = ?");
                $stmt->bind_param("s", $session_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                echo "Hello " . $row['user_id'] ." !";
                ?>
                <a href="logout.php">登出</a>           
   
            <?php
                
            } else{

                ?>
                <a href="register.php">註冊</a> <a href="login.php">會員登入</a>

                <?php
                
                
            }
        ?>    

        



        
    
    </div>
</div>