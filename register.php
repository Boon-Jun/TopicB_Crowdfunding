<!DOCTYPE html>  
<html lang="en">
    <head>
        <title>Register for Crowdfunding!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="./css/styles.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="./css/bootstrap.css">
        <!-- Boostrap JS dependencies -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="./js/bootstrap.js"></script>
    </head>
    
    <body>
        <?php 
            //check if user is logged in, if he is, redirect to main.php
            session_start(); 
            
            if(isset($_SESSION[userid])) {
                header("Location: main.php");
            }
        ?>
        
        <div class="jumbotron text-center">
            <h1>Welcome to Crowdfunding thingy</h1>
            <p>Something something crowdfunding something</p> 
        </div>
        
        <div class="container">
            <div class="text-center" style="margin-bottom: 10px">
                <h1>Register here</h1>
                <img src="./docs/logo.png" width="100" height="100" alt=""/>
            </div>
            
            <form action="register.php" method="POST">
                <div class="form-group row">
                    <label for="reg_userid" class="col-sm-1 col-form-label">UserID: </label>
                    <div class="col-sm-10">
                        <input name="reg_userid" class="form-control" placeholder="UserID" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="reg_password" class="col-sm-1 col-form-label">Password: </label>
                    <div class="col-sm-10">
                        <input name="reg_password" type="password" class="form-control" placeholder="Password" required/>
                    </div>
                </div>
                <div class="form-group text-center">
                   <button class="btn btn-primary" type="submit" name="signup_submit">Register</button>
                </div>
                
               <div class="text-center">
                    Already registered? <a href="index.php">Log in here.</a>
                </div>
            </form>

            <div class="text-center" style="margin-top: 1%">
                <?php
                    // Connect to the database
                    $db = pg_connect("host=localhost port=5432 dbname=project1 user=postgres password=test");	
                    if(!$db) {
                        echo "Error : Unable to open database\n";
                    } else {
                        echo "Opened database successfully\n";
                    }
                    
                    if (isset($_POST['signup_submit'])) {
                        $query = "INSERT INTO account VALUES ('$_POST[reg_userid]', '$_POST[reg_password]')";
                        $result = pg_query($db, $query);
                        if (!$result) {
                            echo "Signup failed!";
                        }
                        else {
                            echo "Signup successful! Return to the ";
                            echo '<a href="index.php">main page to log in! </a>';
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>