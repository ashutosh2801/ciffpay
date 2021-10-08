<?php 
require('forms/function.php'); 
$option = pluck($conn);

//echo $_SESSION['user_id']; exit;
$user_id = $_COOKIE['user_id'];

$sql = "SELECT * FROM `tbl_users` WHERE id='".$user_id."' limit 1";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();
if($row) {
  if(isset($_POST['submit'])) {
    //echo '<pre>'; print_r($_POST); exit;

    extract($_POST);
    try {

      $sql = "UPDATE tbl_inmates SET status=0, first_name='$first_name', last_name='$last_name', institute='$institute', inmate_number='$inmate_number', created_at='".date('Y-m-d H:i:s')."' WHERE id='".intval($_GET['id'])."'";
      if($conn->query($sql)) 
      { 
        
        /*
        $sql2 = "SELECT cheque_id FROM `tbl_inmates` WHERE id='".intval($_GET['id'])."'";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();

        $sql3 = "UPDATE tbl_cheques SET count = count-1 WHERE id='".$row2['cheque_id']."'"; 
        $conn->query($sql3);

        $sendData = array(
          'NAME'            => ucfirst($row['first_name'].' '.$row['last_name']), 
          'EMAIL'           => $row['email'],
          'ORDER_ID'        => $order_id,
          'EMAIL_TEMPLATE'  => 'order-placed-waiting-etransfer'
        );
        sendMailer($conn, $sendData) ; //To USER


        $sendData = array(
          'NAME'            => ucfirst($row['first_name'].' '.$row['last_name']), 
          'EMAIL'           => $row['email'],
          'ORDER_ID'        => $order_id,
          'EMAIL_TEMPLATE'  => 'order-placed-mail-admin'
        );
        sendMailer($conn, $sendData) ; //To Admin
        
        header('Location: '.SITEURL.'/thank_you?order_id='.$order_id); 
        */
        header('Location: '.SITEURL.'/confirm/'.$_GET['id']); 
        exit;
      }
      throw new Exception(''.$conn->error);
    }
    catch(Exception $e){
      echo '<pre>'; print_r($e); exit;
    }
  }
}

$sql2 = "SELECT * FROM `tbl_inmates` WHERE id='".intval($_GET['id'])."' limit 1";
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();
//print_r($row2);

$title = 'Inmate Information | CIFF Pay Solution Inc.';

require('header.php'); 
?>



  <main id="main">

    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <!-- <h2><?php //echo $lang['Receiver Information']; ?></h2> -->
          <h2><?php echo $lang['Inmate Details']; ?></h2>
        </header>

        <div class="row gy-4">
        <div class="hero_wra">
          <div class="col-lg-12">
            <form action="" method="post" class="php-email-form">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" value="<?php echo $row2[first_name]; ?>" name="first_name" class="form-control" placeholder="<?php echo $lang['First Name']; ?>" required>
                </div>

                <div class="col-md-6 ">
                  <input type="text" value="<?php echo $row2[last_name]; ?>"name="last_name" class="form-control" placeholder="<?php echo $lang['Last Name']; ?>" required>
                </div>

                <div class="col-md-12">
                <select name="institute" id="institute" class="form-control" style="line-height: 2em; font-size: large;">
                <option value=""><?php echo $lang['Click here to select your friend or loved one’s institution']; ?></option>
                <?php 
                $sql = "SELECT id,`title` FROM `tbl_correctional` WHERE 1 ORDER by title";
                if ($result = $conn -> query($sql)) {
                while ($obj = $result -> fetch_object()) {
                ?>
                  <option <?php if($row2['institute']==$obj->id) echo 'selected'; ?>  value="<?php echo $obj->id; ?>"><?php echo $obj->title; ?></option>
                <?php
                }
                }
                // Free result set
                $result -> free_result();               
                ?>
                </select>
                </div>

                <div class="col-md-12">
                <input type="text" value="<?php echo $row2[inmate_number]; ?>" name="inmate_number" class="form-control" placeholder="Inmate # (FPS/OTIS)" required>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading"><?php echo $lang['Loading...']; ?></div>
                  <div class="error-message"></div>
                  <div class="sent-message"><?php echo $lang['Your message has been sent. Thank you!']; ?></div>

                  <button type="submit" name="submit"><?php echo $lang['Submit']; ?></button>
                </div>

              </div>
            </form>

            </div>
            </div>

        </div>

      </div>

    </section>

  </main>

<?php 
require('footer.php'); 
?>