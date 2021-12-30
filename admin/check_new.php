<?php include 'header.php';?>
<?php include '../config.php';
include '../config.php';
?>
<div class="container mt-5 mb-4">
    <div class="row">    

        <?php
        $sql = "SELECT NewAccountID,UserName,AccountType,Email  FROM newaccount WHERE STATUS='new' LIMIT 9;";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            
            // output data of each row
            while($row = $result->fetch_assoc()) {?>
                            <div class="col-md-6 col-xl-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="check_doc.php" method="POST">
                                        <div class="mb-3" style="min-height: 150px; background-color: teal;"></div>
                                        <div class="row justify-content-between mb-1">
                                            <h3 class="col-9 card-title"><?php echo $row['UserName'];?></h3>
                                            <input type="hidden" name="id" value="<?php echo $row['NewAccountID']; ?>">                                            
                                        </div>
                                        <p class="ms-2" style="font-size: 13px; margin-bottom:-5px; "><i
                                                class="fas fa-building "></i>&nbsp;
                                            <?php echo $row['AccountType'];?></p>
                                        <p class="m-2" style="font-size: 13px;"><i class="fas fa-envelope"></i> &nbsp;<?php echo $row['Email']; ?></p>
                                        
                                        <button type="submit" class="btn btn-success w-100 mt-2 me-2">Check</button>
                                        <!-- <p class="text-end" style="margin-bottom: -5px; margin-top: -5px;"><a href="#"
                                                style="text-decoration: none; color: #aaa;">See
                                                more..</a>
                                        </p> -->
                                        </form>
                                    </div>
                                </div>
                            </div>

                <?php
                }
        
            } else {
                echo "0 results";
            }  ?>     
    </div>
</div>

<?php include 'footer.php';?>
<script>
    $('title').text("New Account Requests");
    $('#title1').text("New Account Requests");
    $("#search1").hide();
</script>