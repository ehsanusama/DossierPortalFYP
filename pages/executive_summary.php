<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <?php $summary = fetchRecord($dbc, "executive_summary", 'user_id', $fetchUser['user_id']); ?>
    <?php if (empty($summary['user_id'])) { ?>
        <a href="#modal-id" data-toggle="modal" title="load_summary_form|id|" class="btn btn-success pull-right modal-action">+ Add Summary</a>
    <?php }  ?>
    <div class='portlet-body'>
        <div class="bg-dar w-100 text-center p-2 mt-5 ">
            <h1 class=''>(1.1) Executive Summary</h1>
        </div>
        <span>
            <?= @$summary['summary'] ?>
        </span> <br><br>
        <?php if (!empty($summary['user_id'])) { ?>
            <a href="#!" onclick="deleteData('executive_summary','id',<?= $summary['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger pull-right">Delete</a>
            <a href="#modal-id" data-toggle="modal" title="load_summary_form|id|<?= $summary['id'] ?>" class="btn btn-success pull-right  modal-action">Edit</a>

        <?php }  ?>
        <br><br>
    </div>
</div>