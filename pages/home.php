<style>
    .home-card:hover {
        background-color: #284b64 !important;
        color: #ffffff !important;
    }
</style>
<div class="portlet-light">


    <div class="portlet-body">

        <div class="row">

            <?php foreach (array_unique($parents) as  $p) :

                $unique_parent = fetchRecord($dbc, "menus", "id", $p);

            ?>

                <div class="col-sm-4 text-center">

                    <div class="portlet-body home-card" style="height: 120px;background-color:white;margin-top:5px; box-shadow: 0px 10px 50px rgba(40, 75, 100, 0.1); color: #284b64;">
                        <div class="btn-group pull-left">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fa fa-ellipsis-v"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <?php foreach ($files as  $value) :
                                    $filename = $value . ".php";
                                    $q = mysqli_query($dbc, "SELECT * FROM menus WHERE parent_id='$p' AND page='$filename'");
                                    if (mysqli_num_rows($q) == 1) :
                                        $navigation = fetchRecord($dbc, "menus", "page", $filename);
                                        if (empty($navigation['parent_id']) and $navigation['page'] == "#") {
                                            continue;
                                        }
                                ?>
                                        <li> <a class="dropdown-item modal-action" href="index.php?nav=<?= base64_encode($value) ?>&business=<?= @$_SESSION['business'] ?>"><span class="<?= $navigation['icon'] ?>"></span> <?= ucwords($navigation['title']) ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <strong class="text-center" style="font-size: 1.5em;font-weight: 700;">
                            <span class="<?= $unique_parent['icon'] ?>" style="margin-top:12%;"></span>
                            <?= ucwords($unique_parent['title']) ?>
                        </strong>

                    </div><!-- card body -->



                </div><!-- col -->



            <?php endforeach; ?>

        </div><!-- row -->

        <br><br>



        </form>

    </div><!-- card body -->

</div><!-- card -->

</div>







<div class="modal fade" id="qr-modal">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-body" id="qr-modal-body">

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

            </div>

        </div>

    </div>

</div>

</div>