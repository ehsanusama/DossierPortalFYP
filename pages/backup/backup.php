<div class="portlet light">
  <div class=" portlet-body">
    <h3>Backup and Restore Database</h3>
    <?php include_once 'inc/backup_code.php'; ?>
    <style>
      .box {

        padding-top: 20px;

        padding-bottom: 20px;

        padding-left: 10px;

        padding-right: 10px;

        text-decoration: none !important;

        text-align: center;

        font-size: 1.4em;

      }
    </style>

    <center>

      <div class="mt-1 mb-2">

        <form action="" method="post">

          <button type="submit" name="action" value="backup" class="box btn btn-success" style="">

            <span class="fa fa-refresh"></span> Take Backup

          </button>

        </form>

      </div><!-- row -->

    </center>

    <div class="row">

      <div class="col-sm-12">

        <div class="table-responsive">

          <table class="table table-hover">

            <thead>

              <tr>

                <th>#</th>

                <th>Name</th>

                <th>Action</th>

              </tr>

            </thead>

            <tbody>

              <?php

              if (is_dir(BACKUP_DIR)) :

                $opendir = opendir(BACKUP_DIR);

                $i = 1;

                while ($r = readdir($opendir)) :

                  $file_address = BACKUP_DIR . "/" . $r;

                  if ($r == "." or $r == "..") {
                    continue;
                  }

              ?>

                  <tr>

                    <td><?= $i++ ?></td>

                    <td><?= $r ?></td>

                    <td align="right">

                      <div class="btn-group">

                        <a class="btn btn-success btn-md" title="Restore Backup" data-toggle="tooltip" href="index.php?nav=<?= $_REQUEST['nav'] ?>&action=restore&backupfile=<?= $r ?>"><span class="fa fa-refresh"></span> </a>

                        <a href="<?= $file_address ?>" title="Download" data-toggle="tooltip" download class="btn btn-primary btn-md"><span class="fa fa-download"></span> </a>

                        <a href="index.php?nav=<?= $_REQUEST['nav'] ?>&business=<?= $_REQUEST['business'] ?>&delete_file=<?= $r ?>" title="Delete" data-toggle="tooltip" class="btn btn-danger btn-md"><span class="fa fa-trash"></span> </a>

                      </div>

                    </td>

                  </tr>

                <?php endwhile; ?>

              <?php else : ?>

                <tr>

                  <td colspan="2">No Backup Found</td>

                </tr>

              <?php endif; ?>

            </tbody>

          </table>

        </div>

      </div><!-- row -->

    </div><!-- col -->



  </div>

</div>