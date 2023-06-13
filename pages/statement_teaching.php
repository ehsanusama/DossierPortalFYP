<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <?php $summary = fetchRecord($dbc, "statement_teaching", 'user_id', $fetchUser['user_id']); ?>
    <?php if (empty($summary['user_id'])) { ?>
        <a href="#modal-id" data-toggle="modal" title="statement_teaching_form|id|" class="btn btn-success pull-right modal-action">+ Add Summary</a>
    <?php }  ?>
    <div class='portlet-body'>
        <div class="bg-dar w-100 text-center p-2 mt-5 ">
            <h1 class=''>(5.1) Statement of Teaching: </h1>
        </div>

        <?= @$summary['statement_teaching_text'] ?>
        <br><br>
        <?php if (!empty($summary['user_id'])) { ?>
            <a href="#!" onclick="deleteData('statement_teaching','id',<?= $summary['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger pull-right">Delete</a>
            <a href="#modal-id" data-toggle="modal" title="statement_teaching_form|id|<?= $summary['id'] ?>" class="btn btn-success pull-right  modal-action">Edit</a>

        <?php }  ?>
        <br><br>
    </div>
</div>