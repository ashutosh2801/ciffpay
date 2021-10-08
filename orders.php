<?php 
require('forms/function.php'); 
$option = pluck($conn);
require_once('header.php'); 
//$user_id = $_SESSION['user_id'];
$user_id = $_COOKIE['user_id'];
?>

<section class="breadcrumbs">
      <div class="container">

        <ol>
        <li><a href="<?php echo SITEURL; ?>"><?php echo $lang['Home']; ?></a></li>
          <li><a href="<?php echo SITEURL; ?>/dashboard"><?php echo $lang['Dashboard']; ?></a></li>
          <li><?php echo $lang['My Orders']; ?></li>
        </ol>
        <!-- <h2>Blog Single</h2> -->

      </div>
    </section>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex" style="padding-top:50px">

    <div class="container">
      <div class="row">
        <div class="col-lg-12 d-flex flex-column justify-content-center">
            <h2 data-aos="fade-up"><?php echo $lang['My Orders']; ?></h2> 
            <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th><?php echo $lang['S. no.']; ?></th>
                        <th><?php echo $lang['Placed On']; ?></th>
                        <th><?php echo $lang['Order ID']; ?></th>
                        <th><?php echo $lang['Tracking no.']; ?></th>
                        <th><?php echo $lang['Inmate Name']; ?></th>
                        <th><?php echo $lang['Inmate Number']; ?></th>
                        <th><?php echo $lang['Institute']; ?></th>
                        <th><?php echo $lang['Amount']; ?></th>
                        <th><?php echo $lang['Status']; ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php

              $condition = "a.user_id=".$user_id;
              if(!empty($_GET['q'])) {
                  $condition.= " AND (a.first_name like '%".$_GET['q']."%' OR a.last_name like '%".$_GET['q']."%' OR b.title like '%".$_GET['q']."%')";
              }
              $sql = "SELECT a.*, concat(a.first_name,' ',a.last_name) as name, b.title, c.price FROM `tbl_inmates` a left join tbl_correctional b on a.institute=b.id join tbl_cheques c on c.id=a.cheque_id  WHERE $condition ORDER BY a.id DESC";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  $i=1;
                  while($obj = $result->fetch_object()) {
              ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo date('d M Y',strtotime($obj->created_at)); ?></td>
                        <td><?php echo $obj->order_id; ?></td>
                        <td><?php echo $obj->tracking_no?'<span class="text-success">'.$obj->tracking_no.'</span>':'<span class="text-danger">'.$lang['Waiting for eTransfer'].'</span>'; ?></td>
                        <td><?php echo $obj->name; ?></td>
                        <td><?php echo $obj->inmate_number; ?></td>
                        <td><?php echo $obj->title; ?></td>
                        <td>CAD $<?php echo number_format($obj->price,2); ?></td>
                        <td><?php echo $obj->status?'<span class="text-success">'.$lang['Transferred'].'</span>':'<span class="text-danger">'.$lang['Waiting for eTransfer'].'</span>'; ?></td>
                    </tr>
                    <?php } } else { ?>
                        <tr>
                            <td colspan="9"><?php echo $lang['Not found!']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
      </div>
    </div>

  </section>
  <!-- End Hero -->

<?php 
require_once('footer.php'); 
?>