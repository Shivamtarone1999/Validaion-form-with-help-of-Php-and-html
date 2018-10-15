<!Doctype HTML>
<html>
    <title>Validation</title>
<head>
    <style>
        .error{
            color: red;
        }
    </style>
    
    </head>
    
    <body>
      
        <?php
        $name = $email = $gender = $comment = $website = "";
        $nameErr = $emailErr = $genderErr = $commentErr = $websiteErr = "";
        
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(empty($_POST["name"])){
                $nameErr = "Name is required";
            }else{
                $name = test_input($_POST["name"]);
                if(!preg_match("/^[a-zA-z]*$/",$name)){
                    $nameErr = "Only letters and white space allowed";
                }
            }
            if(empty($_POST["email"])){
                $emailErr = "Email is required";
            }else{
                $email = test_input($_POST["email"]);
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $emailErr = "Invalid email format";
                }
            }
            
            if(empty($_POST["website"])){
                $websiteErr = "";
            }else{
                $website = test_input($_POST["website"]);
                
                if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)){
                    $websiteErr = "Invalid Url";
                }
            }
            if(empty($_POST["comment"])){
                $commentErr = "";
            }else{
                $comment = test_input($_POST["comment"]);
            }
            
            if(empty($_POST["gender"])){
                $genderErr = "Gender is required.";
            }else{
                $gender = test_input($_POST["gender"]);
            }
        }
        
        function test_input($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        ?>
        
        <h1 style="text-align: center;color:#000;font-size:55px;">Form</h1>
        <p style="padding-left:150px;"><Span class="error">* required field</Span></p><br>
        <form style="text-align:center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Name : <input type="text" name="name" value="<?php echo $name;?>">
            <span class="error">*<?php echo $nameErr;?></span><br><br>
            Email : <input type="email" name="email" value="<?php echo $email;?>">
            <span class="error">*<?php echo $emailErr?></span><br><br>
            <span style="padding-right:0px;"> Website :</span> <input type="text" name="website" value="<?php echo $website;?>">
            <span class="error"><?php echo $websiteErr;?></span><br><br>
            Comment :<br> <textarea  style="padding-left:10px; "name="comment" rows="5" cols="40" ><?php echo $comment;?></textarea><br><br>
            
             Gender:<br>
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other 
            
            <span class="error">*<?php echo $genderErr;?></span><br><br>
            
            <input type="submit" name="submmit" value="Submit">
                    </form>

        <?php
            echo "<h2>Your Details : </h2>";
        echo "<br>";
        echo "$name";
        echo "<br>";
        echo "$email";
        echo "<br>";
        echo "$website <br>";
        echo "$comment <br>";
        echo "$gender<br>";
            
            ?>    
            
        
    
    </body>
</html>