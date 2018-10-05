<?php
    while ($row = pg_fetch_assoc($result))  {
        $counter++;
        $projectid = $row['projectid'];
?>
        <div class="card" data-id="<?php echo $projectid;?>">
            <div class="card-header">
                <?php echo $row['title'];?>
            </div>
            <div class="card-body">
                <?php echo "<p>" . "Advertised by: " . $row['advertiser'] . " | " . "Currently raised: " . "$". $row['amount_funded'] . "/" . "$" . $row['funding_sought'] . "</p>"; ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#projectModal" 
                data-description="<?php echo $row['description'];?>" data-title="<?php echo $row['title'];?>" data-startdate="<?php echo $row['start_date'];?>" data-duration="<?php echo $row['duration'];?>" data-projectid="<?php echo $row['projectid'];?>">
                    Find out more
                </button>
            </div>
        </div>
        <br>
<?php
    }
    if(pg_num_rows($result) >= 10) {
?>
        <div id="load_more">
            <button type="button" name="btn_more" data-counter="<?php echo $counter; ?>" id="btn_more" class="btn btn-primary btn-lg btn-block">Load More</button>
            <br>
        </div>
<?php
    } else {
        echo '<div class="text-center">No more entries found!</div>';
    }
?>
