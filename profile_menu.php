<div class="col-md-3 clearfix ">
<div class="list-group">
<a href="customer_home.php" class="list-group-item list-group-item-action clearfix">PROFILE <i class="icon-user float-right"></i></a>
<a href="loanapply.php" class="list-group-item list-group-item-action clearfix">APPLY FOR LOAN <i class="icon-laptop2 float-right"></i></a>
<a href="openaccount.php" class="list-group-item list-group-item-action clearfix">OPEN ACCOUNT <i class="icon-file-invoice-dollar float-right"></i></a>
<a href="passreset.php" class="list-group-item list-group-item-action clearfix">UPDATE PASSWORD<i class="icon-key float-right"></i></a>
<a href="edit_customer.php" class="list-group-item list-group-item-action clearfix">EDIT PROFILE <i class="icon-cog float-right"></i></a>
<?php
    switch ($_SESSION['ccc_privil']){
    
    case 300:
        echo '<a href="backend.php" class="list-group-item list-group-item-action clearfix primary ">ACCOUNT MANAGEMENT <i class="icon-cogs float-right"></i></a> <a href="backend_loan.php" class="list-group-item list-group-item-action  tear clearfix">LOAN MANAGEMENT <i class="icon-cogs float-right"></i></a><a href="cv_backend.php" class="list-group-item list-group-item-action clearfix">JOB APPLICATIONS <i class="icon-cogs float-right"></i></a>';
    break;
            
    case 280;
        
         echo '<a href="backend.php" class="list-group-item list-group-item-action clearfix">ACCOUNT MANAGEMENT <i class="icon-cogs float-right"></i></a>';
    break;
    
    case 270:
    echo '<a href="backend_loan.php" class="list-group-item list-group-item-action clearfix">LOAN MANAGEMENT <i class="icon-cogs float-right"></i></a>';
    
    break;
    
    case 260:
    echo'<a href="cv_backend.php" class="list-group-item list-group-item-action clearfix">JOB APPLICATIONS <i class="icon-user-graduate float-right"></i></a>';
    break;
    
        default:
                
    
    break;
    }
    ?>
<a href="#" id="logoffner" class="list-group-item list-group-item-action clearfix">LOGOUT <i class="icon-line2-logout float-right"></i></a>
</div>
</div>