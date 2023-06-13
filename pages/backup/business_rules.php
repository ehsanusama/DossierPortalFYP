 <!-- Insert business rules -->
 <section class="portlet light">

     <div class="portlet-body">
         <h2 class="mb-4">Add Business Rules</h2>
         <form method="post">
             <?php $btn = (empty($_REQUEST['edit_businessRules_id'])) ? "add" : "update"; ?>
             <input type="hidden" name="operation" value="<?= $btn ?>">

             <input type='hidden' name="business_id" value='<?= @$_REQUEST['business'] ?>' />

             <div class="form-group">

                 <textarea name="business_rules" style='width:100%' id="business_rules" cols="50" class="w-full w-100 form-control" placeholder="your business rules ..." rows="6"><?= @$fetchBusiness_rules['business_rules'] ?></textarea>

             </div>

             <!-- <button name='add_BusinessRules' class='btn btn-success mt-3' type='submit'>Submit</button> -->
             <br>
             <div class="form-group text-right">
                 <button name='add_BusinessRules' class='btn btn-success mt-3 ' type='submit'>Submit</button>
             </div>
         </form>

     </div>

 </section>

 <!--! Insert business rules -->

 <!-- Show Bussiness Rules -->

 <div class="portlet light">
     <div class="portlet-body">
         <table class="table table-condensed table-striped">
             <thead>
                 <tr>
                     <th>Business Rules</th>
                     <th>Status</th>
                     <th>Options</th>
                 </tr>
             </thead>
             <tbody>
                 <?php
                    $business_id = base64_decode($_REQUEST['business']);
                    $getBusinessRules = mysqli_query($dbc, "SELECT * FROM business_rules where business_id = '$business_id'");
                    if ($getBusinessRules > 0) :
                        while ($fetchBusinessRules = mysqli_fetch_assoc($getBusinessRules)) :
                    ?>
                         <tr>
                             <td><?php echo $fetchBusinessRules['business_rules'] ?></td>
                             <td><?php echo $fetchBusinessRules['sts'] ?></td>
                             <td>
                                 <a href="#!" onclick="deleteData('business_rules','id',<?= $fetchBusinessRules['id'] ?>,'index.php?nav=<?= $_REQUEST["nav"] ?>&business=<?= $_REQUEST['business'] ?>',this)" class="btn btn-danger btn-xs">Delete</a> |
                                 <a href="index.php?nav=<?= $_REQUEST["nav"] ?>&business=<?= $_REQUEST['business'] ?>&edit_businessRules_id=<?= $fetchBusinessRules['id'] ?>" class="btn btn-primary btn-xs">Edit</a>
                             </td>
                         </tr>
                 <?php endwhile;
                    endif; ?>
             </tbody>
         </table>
     </div>
 </div>

 <!--! Show Bussiness Rules -->