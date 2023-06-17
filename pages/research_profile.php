<style>
    dropdown-menu label {
        display: block;
    }
</style>
<div class='portlet light'>
    <?php $summary = fetchRecord($dbc, "research_profile", 'user_id', $fetchUser['user_id']); ?>
    <?php if (empty($summary['user_id'])) { ?>
        <a href="#modal-id" data-toggle="modal" title="research_profile_form|id|" class="btn btn-success pull-right modal-action">+ Add Summary</a>
    <?php }  ?>
    <div class='portlet-body'>
        <div class="bg-dar w-100 text-center p-2 mt-5 ">
            <h2 class=''>(6)Research Profile: </h2>
        </div>
        <?= @$summary['summary'] ?>
        <div class="bg-dar w-100 text-center p-2 mt-5 ">
            <h2 class=''>(6.1)Research Statement: </h2>
        </div>
        <?= @$summary['statement'] ?>
        <br><br>
        <?php if (!empty($summary['user_id'])) { ?>
            <a href="#!" onclick="deleteData('research_profile','id',<?= $summary['id'] ?>,'index.php?nav=<?= $_REQUEST['nav'] ?>',this)" class="btn btn-danger pull-right">Delete</a>
            <a href="#modal-id" data-toggle="modal" title="research_profile_form|id|<?= $summary['id'] ?>" class="btn btn-success pull-right  modal-action">Edit</a>

        <?php }  ?>
        <br><br>
    </div>
</div>