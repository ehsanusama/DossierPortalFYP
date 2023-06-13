<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link text-center">
      <img src="http://attendezz.com/img/logo.png" width="28" height="28" alt=""> Attendezz</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/staff/<?=$fetchUser['user_pic']?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info text-uppercase">
          <a href="index.php?nav=<?=base64_encode('profile')?>&business=<?=@$_SESSION['business']?>" class="d-block"><?=$fetchUser['user_first_name']?></a>
        </div>
      </div>
    
      <!-- Sidebar Menu -->
      <nav class="mt-2">
           <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php   if(!empty($_SESSION['business'])): ?>
          <?php foreach (array_unique($parents) as  $p) :
          $unique_parent = fetchRecord($dbc,"menus","id",$p);
          ?>
          <li  class="nav-item"> 
           <a href="#" class="nav-link">
              <i class="<?=$unique_parent['icon']?>"></i>
              <p>
                 <?=ucwords($unique_parent['title'])?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          <ul  class="nav nav-treeview" style="margin-left: 15px;font-size: 14px">
             <?php foreach ($files as  $value) :
              $filename=$value.".php";
             $q= mysqli_query($dbc,"SELECT * FROM menus WHERE parent_id='$p' AND page='$filename'");
             if(mysqli_num_rows($q)==1):
               $navigation = fetchRecord($dbc,"menus","page",$filename);
                if(empty($navigation['parent_id']) AND $navigation['page']=="#"){
                  continue;
                }
               ?>
                <li  class="nav-item"> 
               <a href="index.php?nav=<?=base64_encode($value)?>&business=<?=@$_SESSION['business']?>" class="nav-link">
                  <i class="<?=$navigation['icon']?>"></i>
                  <p>
                     <?=ucwords($navigation['title'])?>
                  </p>
                </a>
              </li>
           
          <?php endif; ?>
             <?php endforeach; ?>

          </ul>
        </li>
          
      <?php endforeach; ?>
      <?php else: ?>
         <?php if($getRoleAdmin>=1):
          foreach (array_unique($parents) as  $p) :
          $unique_parent = fetchRecord($dbc,"menus","id",$p);
          ?>
        <li  class="nav-item"> 
           <a href="#" class="nav-link">
              <i class="<?=$unique_parent['icon']?>"></i>
              <p>
                 <?=ucwords($unique_parent['title'])?>
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          <ul  class="nav nav-treeview" style="margin-left: 15px;font-size: 14px">
             <?php foreach ($files as  $value) :
              $filename=$value.".php";
             $q= mysqli_query($dbc,"SELECT * FROM menus WHERE parent_id='$p' AND page='$filename'");
             if(mysqli_num_rows($q)==1):
               $navigation = fetchRecord($dbc,"menus","page",$filename);
                if(empty($navigation['parent_id']) AND $navigation['page']=="#"){
                  continue;
                }
               ?>
                <li  class="nav-item"> 
               <a href="index.php?nav=<?=base64_encode($value)?>&business=<?=@$_SESSION['business']?>" class="nav-link">
                  <i class="<?=$navigation['icon']?>"></i>
                  <p>
                     <?=ucwords($navigation['title'])?>
                  </p>
                </a>
              </li>
           
          <?php endif; ?>
             <?php endforeach; ?>

          </ul>
        </li>
          
      <?php endforeach; endif; ?>
        <?php endif; ?>
      <?php if($getRoleEmployee>=1):?>
        <li  class="nav-item"> 
           <a href="#" class="nav-link">
              <i class="fa fa-tasks"></i>
              <p>
                 Task Management <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          <ul  class="nav nav-treeview" style="margin-left: 15px;font-size: 14px">
             <li  class="nav-item"> 
               <a href="index.php?nav=<?=base64_encode('add_task')?>=&business=" class="nav-link">
                  <i class="fa fa-plus"></i>
                  <p>
                     Add Task
                   </p>
                </a>
              </li>
          </ul>
        </li>
      <li  class="nav-item"> 
       <a href="index.php?nav=<?=base64_encode('emp_monthly_attendance_report')?>&business=<?=@$_SESSION['business']?>" class="nav-link">
          <i class="fa fa-file"></i>
          <p>
               Attendance Report
          </p>
        </a>
      </li>

    <?php endif; ?>
      <li  class="nav-item"> 
       <a href="index.php?nav=<?=base64_encode('profile')?>&business=<?=@$_SESSION['business']?>" class="nav-link">
          <i class="fa fa-cog"></i>
          <p>
               Account Settings
          </p>
        </a>
      </li>
      <li  class="nav-item"> 
       <a href="logout.php" class="nav-link">
          <i class="fa fa-power-off"></i>
          <p>
              Logout
          </p>
        </a>
      </li>
      </ul>
      </nav>
      <!-- /.sidebar-menu -->
      
    </div>
    <!-- /.sidebar -->
    <center style="position: fixed;bottom: 10px;left: 0">
        <a href="../attendezz.apk" download>
          <img src="../img/download_apk.png" width="200" class="img img-responsive" alt="">
        </a>
      </center>
  </aside>