<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>(1.3) Academic</h2>
    </div>
    <div class='portlet-body'>
        <form action="api/index.php" method="post" class="ajax-form">
            <input type="hidden" name="action" value="academic_data">
            <div class="row">

                <div class="col-sm-12">
                    <div class="bg-dar w-100 p-2 mt-5 ">
                        <?php

                        ?>

                    </div>
                    <div class="panel panel-default panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Title</label>
                                <select name="academic_domain_title" class="form-control">
                                    <option value="" disabled selected>Select Category</option>
                                    <?php foreach ($academicData as $value) :
                                        // $selected = ($value == $fetchSale['payment_type']) ? "selected" : "";
                                    ?>
                                        <option value="<?= $value ?>" <?= @$selected ?>><?= ucwords($value) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br>
                            </div>

                            <table class="table">
                                <tr>
                                    <th colspan="5" class="text-center">Textile Engineering, knitting </th>
                                    <th>Action</th>
                                </tr>
                                <tr class="product-row">
                                    <td colspan="2">
                                        <input type="text" class="form-control" name="research_domain_text[]"></input>
                                    </td>
                                    <td colspan="2"><input type="text" class="form-control " name="research_domain_details[]"></td>
                                    <td colspan="1"><input type="file" name="f[]" class="form-control" id="img" style="width: 150px;"></td>
                                    <td><button type="button" class="btn btn-success btn-sm addProductRowBtnLab"><span class="fa fa-plus"></span></button></td>
                                </tr>
                            </table>
                        </div><!-- row -->
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div><!-- panel -->

                </div><!-- col -->
            </div><!-- row -->
        </form>
    </div>


</div>

<div class='portlet light'>
    <div class="portlet-title">
    </div>
    <div class='portlet-body'>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-center">Textile Engineering, knitting</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($academicData); $i++) : ?>
                        <tr>
                            <td><?= $academicData[$i]; ?></td>
                            <td style="padding: 0;">
                                <table class="table table-bordered" cellspacing="0" height="100%">
                                    <?php
                                    $sql = "SELECT * FROM academic_data WHERE user_id = $fetchUser[user_id] and academic_domain_title = '$academicData[$i]'   ";
                                    $q = mysqli_query($dbc, $sql);
                                    while ($row = mysqli_fetch_assoc($q)) :
                                        $data1 = json_decode($row['academic_domain_data']);
                                        foreach ($data1 as $value) :
                                            $value = (array) $value;
                                    ?>
                                            <tr>
                                                <td style="width: 50%;"><?= $value['research_domain_text'] ?></td>
                                                <td style="width: 50%;"><?= $value['research_domain_details'] ?></td>
                                            </tr>
                                    <?php endforeach;
                                    endwhile;
                                    ?>
                                </table>
                            </td>
                        </tr>
                    <?php
                    endfor; ?>
                </tbody>
            </table>
        </div>
    </div>


</div>