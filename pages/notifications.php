<div class="portlet light">
  <div class="portlet-body">
    <h2>Notifications</h2>

    <!-- Accordion Using List Group -->
    <div id="accordion">
      <div class="panel list-group">
        <!-- panel class must be in -->
        <?php $getNotifications = mysqli_query($dbc, "SELECT * FROM notifications WHERE user_id='$fetchUser[user_id]' ORDER BY id DESC");
        while ($fetchNotifications = mysqli_fetch_assoc($getNotifications)) :
        ?>
          <a href="#notificaton_<?= $fetchNotifications['id'] ?>" data-parent="#accordion" data-toggle="collapse" class="list-group-item d-flex justify-content-between text-muted">
            <span>
              <span class="fa fa-bell mr-4"></span>
              <?= (ucwords($fetchNotifications['type'])) ?>
              <br>
              <span class="ml-5"><?php echo date('d-M-Y', strtotime($fetchNotifications['timestamp'])); ?></span>
            </span>
          </a>
          <div class="collapse" id="notificaton_<?= $fetchNotifications['id'] ?>">
            <div class="card card-body">
              <p class="lead">
                <?php echo nl2br($fetchNotifications['text']); ?>
              </p>
            </div>
          </div>

        <?php endwhile; ?>
      </div>
    </div>


  </div> <!-- body -->
</div><!-- card -->