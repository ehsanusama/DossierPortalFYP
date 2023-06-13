<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <div class="portlet-title">
        <h2 class=''>(1.4) Other contributions</h2>
    </div>
    <div class='portlet-body'>
        <form action="api/index.php" method="post" class="ajax-form">
            <input type="hidden" name="action" value="other_contributions">
            <div class="row">

                <div class="col-sm-12">
                    <div class="bg-dar w-100 p-2 mt-5 ">
                        <?php
                        $otherContributions = [
                            "MOUs/ Collaborations",
                            "Organization of trainings/workshops/seminars/conferences",
                            "Peer review of journal articles (Number) ",
                            "External Examiner",
                            "Administrative/non-academic departmental duties/Teachers evaluations",
                        ];
                        ?>

                    </div>
                    <div class="panel panel-default panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Title</label>
                                <select name="contributions_domain_title" class="form-control">
                                    <option value="" disabled selected>Select Category</option>
                                    <?php foreach ($otherContributions as $value) :
                                        // $selected = ($value == $fetchSale['payment_type']) ? "selected" : "";
                                    ?>
                                        <option value="<?= $value ?>" <?= @$selected ?>><?= ucwords($value) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br>
                            </div>
                            <!-- <div class="col-md-6">
                                <label for="">Add New Title</label>
                                <input type="text" name="contributions_domain_title" class="form-control">
                                <br>
                            </div> -->
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
                                    <td colspan="1"><input type="file" name="f[]" class="form-control" id="" style="width: 150px;"></td>
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
        <h2 class=''>(1.2)2. Research Achievements</h2>
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
                    for ($i = 0; $i < count($otherContributions); $i++) : ?>
                        <tr>
                            <td style="width:40%"><?= $otherContributions[$i]; ?></td>
                            <td style="padding: 0;">
                                <table class="table table-bordered" cellspacing="0" height="100%">
                                    <?php
                                    $sql = "SELECT * FROM other_contributions WHERE user_id = $fetchUser[user_id] and contributions_domain_title = '$otherContributions[$i]'   ";
                                    $q = mysqli_query($dbc, $sql);
                                    while ($row = mysqli_fetch_assoc($q)) :
                                        $data1 = json_decode($row['contributions_domain_data']);
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