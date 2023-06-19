<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <?php $summary = fetchRecord($dbc, "initiatives_taken", 'user_id', $fetchUser['user_id']); ?>
    <?php if (empty($summary['user_id'])) { ?>
        <a href="#modal-id" data-toggle="modal" title="initiatives_taken_form|id|" class="btn btn-success pull-right modal-action">+ Add Summary</a>
    <?php }  ?>
    <div class='portlet-body'>
        <div class="bg-dar w-100 text-center p-2 mt-5 ">
            <h2 class=''>(7.2) Initiatives Taken : </h2>
        </div>
        <?= @$summary['summary'] ?>

        <br><br>
        <?php if (!empty($summary['user_id'])) { ?>
            <a href="#!" onclick="deleteData('initiatives_taken','id',<?= $summary['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger pull-right">Delete</a>
            <a href="#modal-id" data-toggle="modal" title="initiatives_taken_form|id|<?= $summary['id'] ?>" class="btn btn-success pull-right  modal-action">Edit</a>

        <?php }  ?>
        <br><br>
    </div>
</div>