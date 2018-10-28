<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="index.php"><b>I WANT TO SAY.</b></a>
        </div> 
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
            
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
                    ?>
                    <li><a><?php echo "Hello " . $row['user_id'] ." !"; ?></a></li>
                    <li><a href="logout.php">登出</a></li>           
    
                <?php
                    
                } else{

                    ?>
                    <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> 註冊</a></li> 
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> 會員登入</a></li>

                    <?php
                    
                    
                }
            ?>    
   
            </ul>
        </div>
    </div>
</nav>