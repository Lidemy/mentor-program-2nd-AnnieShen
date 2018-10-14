<div class="header">
    <div class="home"><a href="index.php"><b>I WANT TO SAY.</b></a></div> 
    <div class="login">
        
        <?php 
            
            $user_id = '';
            
            //判斷是否登入過
            if(isset($_COOKIE["session_id"])){
                $session_id = $_COOKIE["session_id"];
                $sql = "SELECT * FROM annieshen_users where session_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $session_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                echo "Hello " . $row['user_id'] ." !";
                ?>
                <a href="logout.php">登出</a>           
   
            <?php
                
            } else{
                //echo "member id: " . $_COOKIE[$cookie_name];
    
                ?>
                <a href="register.php">註冊</a> <a href="login.php">會員登入</a>

                <?php
                
                
            }
        ?>    

        



        
    
    </div>
</div>