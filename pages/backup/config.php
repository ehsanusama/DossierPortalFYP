<?php
if (!empty($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $data = "";
    $getData = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM config WHERE id = '$id'"));
    $metaValues = json_decode($getData['meta'], true);
}
?>
<!-- Insert business rules -->
<section class="portlet light">
    <div class="portlet-body">
        <div class="container py-5 my-5 card " style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;border:none;padding:2%">
            <form class="portlet-body" method="POST" enctype="multipart/form-data">
                <input type="text" name="action" value="<?= !isset($_REQUEST['id']) ? 'add' : 'update'; ?>" hidden>
                <input type="text" name="config_id" value="<?php echo  @$getData['id']; ?>" hidden>
                <div class="form-group">
                    <label for=""><small><b>Project Name</b></small></label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Title About Event Booking" name="projectName" required value="<?php echo @$getData['project_name']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"><small><b>Base URL</b></small></label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Title About Event Booking" name="baseUrl" required value="<?php echo @$metaValues['base_url']; ?>">
                </div>
                <label for=""><small><b>Project Meta <small class="text-danger">( Spaces & Special Character Not
                                Allowed. )</small></b></small></label>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><small><b>Primary Color</b></small></label>
                            <input type="color" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Title About Event Booking" name="primaryColor" required value="<?php echo @$metaValues['colors']['primaryColor']; ?>">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><small><b>Secondary Color</b></small></label>
                            <input type="color" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Title About Event Booking" name="secondaryColor" required value="<?php echo @$metaValues['colors']['secondaryColor']; ?>">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><small><b>Font Color</b></small></label>
                            <input type="color" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Title About Event Booking" name="fontColor" required value="<?php echo @$metaValues['colors']['fontColor']; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for=""><small><b>Logo Path</b></small></label>
                    <label for="logo" class="w-100 border rounded py-2 text-center" style="cursor:pointer">
                        <?php if (empty($metaValues['logo_url'])) : ?>
                            <small><b>Upload Logo</b></small>
                        <?php else : ?>
                            <img width="100" src="https://attendezz.com/dashboard/img/appLogo/<?= $metaValues['logo_url']; ?>" alt="">
                        <?php endif; ?>
                        <input type="text" hidden name="logo_path" hidden>
                        <input type="file" name="logo" id="logo" hidden>
                    </label>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1"><small><b>Description</b></small></label>
                    <textarea class="form-control" name="desc" id="" cols="30" rows="4" placeholder="Why You Want To Book Event" required><?php echo @$getData['description'] ?></textarea>
                </div>
                <button type="submit" name="addMeta" class="btn btn-primary button-style">Add</button>
            </form>
        </div>
    </div>
    <div class="container py-5  card " style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;border:none">
        <div class="container  card-body d-flex flex-column align-items-center">
            <h1>Configuration Detail</h1>

            <?php
            $configrations = mysqli_query($dbc, "SELECT * FROM config");
            $i = 1;
            while ($fetchConfig = mysqli_fetch_assoc($configrations)) :
                $meta = $fetchConfig['meta'];
                $meta = json_decode($meta, true);

            ?>
                <div class="row w-100 my-3 py-2" style="box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;padding:2%">
                    <div class="col-12 col-md-5 p-4">
                        <b>App Name: </b><?php echo $fetchConfig['project_name']; ?>
                        <br>
                        <b>Base URL: </b><?php echo  $meta['base_url'];  ?>
                        <br>
                        <b>Description: </b>
                        <p class="text-justify"><?php echo $fetchConfig['description']; ?></p>
                        <br>
                        <b>Logo: </b>
                        <br>
                        <img width="100" src="https://attendezz.com/dashboard/img/appLogo/<?= $meta['logo_url']; ?>" alt="">
                        <div class="py-3 d-flex">
                            <form action="" method="POST">
                                <input type="text" name="configId" value="<?php echo $fetchConfig['id'] ?>" hidden>
                                <button type="submit" name="delConfig" class="btn mx-2 btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                            <a href="index.php?nav=Y29uZmln&business=&id=<?= $fetchConfig['id'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                        </div>
                    </div>
                    <div class="row col-12 col-md-7 col-sm-12 px-5 py-1 mt-3">
                        <table class="table  text-center">
                            <thead>
                                <tr class="px-5">
                                    <th scope="col">#</th>
                                    <th scope="col">Primary Color</th>
                                    <th scope="col">Secondary Color</th>
                                    <th scope="col">Font Color</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $meta['colors']['primaryColor'] ?></td>
                                    <td><?php echo $meta['colors']['secondaryColor'] ?></td>
                                    <td><?php echo $meta['colors']['fontColor'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php $i = $i + 1;
            endwhile; ?>
        </div>
    </div>
</section>