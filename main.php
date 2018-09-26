<!DOCTYPE html>  
    <head>
        <title>Welcome to Crowdfunding!</title>
        <?php include("./template/head.php"); ?>
    </head>
    
    <body>       
        <?php
            //check if logged out
            include_once("./php_funcs/checkLogOut.php");
            //log in to db
            include_once('./php_funcs/connectDB.php');
        ?>
        
        <!-- Nav bar -->
        <?php include("./template/nav.php"); ?>        
        
        <div class="container">
            <br>
            <h1>Browse through projects!</h1>
            <br>
            <?php
                // Retrieving projects from DB
                $result = pg_query('SELECT title, advertiser, start_date, duration, amount_funded, funding_sought, projectid FROM projects');
            ?>
            
            <!-- Display information from Database in table form -->
            <?php include('./template/project_table.php'); ?>

            <h2>Browse projects here:</h2>
			
			<!-- Nav tabs -->
			<ul class="nav nav-tabs">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#viewAll">View All</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#viewFunded">View Funded</a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#search">Search</a></li>
			</ul>
			
			<!-- Tab content -->
			<div class="tab-content">
				<div id="viewAll" class="tab-pane show active">
					<br>
					<h3>Creative projects coming to life.</h3>
					<p> Here are the list of all projects.</p>
					<br>
					<?php
						// Retrieving projects from DB
						$result = pg_query('SELECT title, advertiser, start_date, duration, amount_funded, funding_sought FROM projects');
					?>

					<?php include('./template/project_table.php'); ?>
				</div>
				
				<div id="viewFunded" class="tab-pane fade">
					<br>
					<h3>Our Success Stories.</h3>
					<p> We love to see projects succeed through our platform. <br>
						Here are the list of projects that have met and exceeded their own fund goals.</p>
					<br>
					<?php
						// Retrieving projects from DB
						$result = pg_query('SELECT title, advertiser, start_date, duration, amount_funded, funding_sought FROM projects
							WHERE amount_funded >= funding_sought');
					?>

					<?php include('./template/project_table.php'); ?>
				</div>
				
				<div id="search" class="tab-pane fade">
					<br>
					<h3>Can't find what you're looking for?</h3>
					<p> Don't worry, we got you covered.</p>
					<form action="main.php" method="POST">
						<label for="search_field" class="col-lg-1 col-form-label">Search: </label>
						<input name="search_field" class="form-control" placeholder="Any relevant keywords" required/>
						<div class="text-center">
							<button class="btn btn-primary" type="submit" name="search">Search</button>
						</div>
					</form>
					<br> 
					<?php
						if (isset($_POST['search'])) {
							//Currently only allows direct string comparison
							$result = pg_query("SELECT title, advertiser, start_date, duration, amount_funded, funding_sought FROM projects
								WHERE title = '$_POST[search_field]'");
						}
					?>
					
					<?php include('./template/project_table.php'); ?>
				</div>
			</div>
			
            <?php
                if (isset($_POST[logout_submit])) {
                    include('./php_funcs/logOut.php');
                }
            ?>
        </div>
        
        <script>
            $(document).ready(function () {
                $(".projectRow").click(function () {
                    console.log($(this).data());
                    var content = './getContent.php?projectid=';
                    content += $(this).data().id;
                    console.log(content);
                    $('.modal-body').load(content, function() {
                        $('#projectModal').modal();
                    });
                });
            });
        </script>       
    </body>
    
<!-- Modal -->
<div id="projectModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-left">Modal Header</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>  
    </div>
</div>
</html>