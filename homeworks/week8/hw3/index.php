<?php
  require_once('conn.php');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>week8-3 練習 Transaction</title> 

</head>
<body>

<form method="post">
    <input type ="submit" name="buy" value="buy" id="buy">

    <?php

    $conn->autocommit(FALSE);
    $conn->begin_transaction();
    $stmt = $conn->prepare("select amount from annieshen_products where id = 1 for update");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if($row['amount']>0){

            $stock = $row['amount'];
            
            
            if(isset($_POST['buy'])){
                $stmt1 = $conn->prepare("UPDATE annieshen_products SET amount = amount -1 where id = 1");
                if($stmt1->execute()){
                    $stock = $row['amount']-1;
                    echo '<br>購買成功<br>';   
                }
            } 
            
        }else{
            ?>
            
            <input type ="submit" name="reset" value="reset" id="reset">
            <?php
            if(!isset($_POST['reset'])){
                echo '<br>商品無庫存，購買失敗!<br>'; 
                $row['amount'] = 0 ;
                $stock = $row['amount'];
            } else{
                $stmt_reset = $conn->prepare("UPDATE annieshen_products SET amount = 5 WHERE id = 1");
                if($stmt_reset->execute()){
                    $row['amount'] = 5 ;
                    $stock = $row['amount'];
                    
                }
            }

        } 


        echo '<br>商品庫存： ' . $stock;
    }
    $conn->commit();
    $conn->close();

    ?>

    
    
</form>

</body>

</html>
