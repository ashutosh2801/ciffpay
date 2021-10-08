<?php 
require('forms/function.php'); 
$option = pluck($conn);

$title = 'Confirm | CIFF Pay Solution Inc.';

//echo $_SESSION['user_id']; exit;
$user_id = $_COOKIE['user_id'];

$sql = "SELECT * FROM `tbl_users` WHERE id='".$user_id."' limit 1";
$result = $conn -> query($sql);
$userrow = $result -> fetch_assoc();
if($userrow) {
  if(isset($_POST['submit'])) {

    extract($_POST);
    try {

      $order_id  = strtoupper(substr(md5(microtime()),0,8));

      $price = $row2['price'];
      $convenience = $option->convenience;
      $tracking_cost = $option->tracking_cost;
      if($tracking_status=='No') {
            $sub_total = floatval($price) + floatval($convenience);
            $tax = (floatval($convenience) * $option['tax'])/100;
            //$total = $sub_total + $tax;
      }
      else {
            $sub_total = floatval($price) + floatval($convenience) + floatval($tracking_cost);
            $tax = ((floatval($convenience) + floatval($tracking_cost)) * $option['tax'])/100;
      }
      $total = $sub_total + $tax;

      $sql = "UPDATE tbl_inmates SET 
                order_id       = '$order_id', 
                cost           = '$price', 
                convenience    = '$convenience', 
                tracking_cost  = '$tracking_cost', 
                sub_total      = '$sub_total', 
                tax            = '$tax', 
                total          = '$total', 
                tracking_status= '$tracking_status',
                status         = 1
            WHERE id='".intval($_GET['id'])."'"; 
      if($conn->query($sql)) 
      { 
        $sql2 = "SELECT cheque_id FROM `tbl_inmates` WHERE id='".intval($_GET['id'])."'";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();        

        $sql3 = "UPDATE tbl_cheques SET count = count-1 WHERE id='".$row2['cheque_id']."'"; 
        $conn->query($sql3);

        $sendData = array(
          'NAME'            => ucfirst($userrow['first_name'].' '.$userrow['last_name']), 
          'EMAIL'           => $userrow['email'],
          'ORDER_ID'        => $order_id,
          'PRICE'           => $price,
          'CONVENIENCE'     => $convenience,
          'TRACKING_COST'   => $tracking_cost,
          'TRACKING_STATUS' => $tracking_status,
          'EMAIL_TEMPLATE'  => 'order-placed-waiting-etransfer'
        );
        sendMailer($conn, $sendData) ; //To USER


        $sendData = array(
          'NAME'            => ucfirst($userrow['first_name'].' '.$userrow['last_name']), 
          'EMAIL'           => $userrow['email'],
          'ORDER_ID'        => $order_id,
          'PRICE'           => $price,
          'CONVENIENCE'     => $convenience,
          'TRACKING_COST'   => $tracking_cost,
          'TRACKING_STATUS' => $tracking_status,
          'EMAIL_TEMPLATE'  => 'order-placed-mail-admin'
        );
        sendMailer($conn, $sendData) ; //To Admin
        
        header('Location: '.SITEURL.'/thank_you?order_id='.$order_id); 
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

$sql20 = "SELECT price FROM `tbl_cheques` WHERE id='".intval($row2['cheque_id'])."'";
$result20 = $conn->query($sql20);
$row20 = $result20->fetch_assoc();

$title = 'Confirm | CIFF Pay Solution Inc.';

require('header.php'); 
?>



  <main id="main">

    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <!-- <h2><?php //echo $lang['Receiver Information']; ?></h2> -->
          <h2><?php echo $lang['Confirm Order Summary']; ?></h2>
        </header>

        <div class="row gy-4">
        <div class="hero_wra">
          <div class="col-lg-12">
            <form action="" method="post" class="php-email-form">
              <div class="row gy-4">


                    <div class="box-container">
                        <div class="left-top">
                            <h2><?php echo $userrow['first_name'].' '.$userrow['last_name']; ?></h2>
                            <p><?php echo $userrow['street_number'].' '.$userrow['street_name']; ?>,<?php echo $row['unit']; ?></p>
                            <p><?php echo $userrow['city']; ?>, <?php echo $userrow['province']; ?>, <?php echo $userrow['postal_code']; ?></p>
                            <p>Canada</p>
                        </div>
                        <div class="bottom-right gy-2">
                            <h2><?php echo $row2['first_name'].' '.$row2['last_name']; ?></h2>
                            <?php 
                            $sql = "SELECT `title`, address FROM `tbl_correctional` WHERE id='".$row2['institute']."' ORDER by title";
                            if ($result = $conn -> query($sql)) {
                                $obj = $result -> fetch_object();
                                echo '<p><strong>'.$obj->title.'</strong></p>';
                                echo '<p>'.str_replace("###","<br>",$obj->address).'</p>';
                            }
                            // Free result set
                            $result->free_result();               
                            ?>
                            <p>Inmate Number#: <?php echo $row2['inmate_number']; ?></p>
                        </div>
                    </div>
                </div>                

                <div class="col-md-12 text-center">
                    <a href="<?php echo SITEURL.'/home/'.intval($_GET['id']);?>" class="cancel"><?php echo $lang['Edit']; ?></a>
                    <button type="button" name="submit" class="btn2" data-bs-toggle="modal" data-bs-target="#confirmModal"><?php echo $lang['Checkout']; ?></button>
                </div>

              </div>



<div class="modal fade" id="confirm2Modal" tabindex="-1" aria-labelledby="confirmModal2Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-blue">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModal2Label"> <?php echo $lang['Order Confirmation Summary']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">      
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-login">					
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table">
                                            <tr>
                                                <th><?php echo $lang['Product']; ?></th>
                                                <td>: <?php echo $lang['Money Order']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo $lang['Date']; ?></th>
                                                <td>: <?php echo date('M d,  Y', strtotime($row2['created_at'])); ?></td>
                                            </tr>
                                        </table>
                                        <br/>
                                        <table class="table text-right">
                                            <tr>
                                                <th><?php echo $lang['Money Order']; ?>:</th> <?php $price = $row20['price']; ?>
                                                <td>$<?php echo number_format($price,2); ?> <input type="hidden" name="amount" id="amount" value="<?php echo $price; ?>"></td> 
                                            </tr>
                                            <tr>
                                                <th><?php echo $lang['Convenience']; ?>:</th> <?php $convenience = $option['convenience']; ?>
                                                <td>$<?php echo number_format($convenience,2); ?></td> 
                                            </tr>
                                            <tr id="tracking_envelope">
                                                <th><?php echo $lang['Tracking Envelope']; ?>:</th> <?php $tracking_cost = $option['tracking_cost']; ?>
                                                <td>$<?php echo number_format($tracking_cost,2); ?></td>
                                            </tr>
                                            <?php $subtotal = $convenience + $price + $tracking_cost; ?>
                                            <tr>
                                                <th><h3><?php echo $lang['Sub Total']; ?>:</h3></th>
                                                <td><h3 id="sub_total"><?php echo number_format($subtotal,2); ?></h3></td> 
                                            </tr>
                                            <?php $extra = $convenience + $tracking_cost; ?>
                                            <?php $hst = ($extra * $option['tax'])/100; ?>
                                            <tr>
                                                <th><?php echo $lang['Tax']; ?>:</th>
                                                <td><span id="tax">$<?php echo number_format($hst,2); ?></span></td> 
                                            </tr>
                                            <tr>
                                                <th><h3><?php echo $lang['Total']; ?>:</h3></th>
                                                <td><h3 id="total">$<?php echo $total = number_format(($subtotal + $hst),2); ?></h3></td>
                                            </tr>
                                        </table>
                                        <br/>
                                        <div class="col-md-12 text-center"> 
                                            <input type="hidden" name="tracking_status" id="tracking_status" value="Yes">
                                            <button type="button" class="cancel" data-bs-dismiss="modal" aria-label="Close"><?php echo $lang['Cancel']; ?></button>
                                            <button type="submit" name="submit" class="btn2"><?php echo $lang['Confirm']; ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            </form>

            </div>
            </div>

        </div>

      </div>

    </section>

  </main>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-blue">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel"> <?php echo $lang['Order Confirmation Summary']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">      
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-login">					
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table">
                                            <tr>
                                                <th><?php echo $lang['Product']; ?></th>
                                                <td>: <?php echo $lang['Money Order']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo $lang['Date']; ?></th>
                                                <td>: <?php echo date('M d,  Y', strtotime($row2['created_at'])); ?></td>
                                            </tr>
                                        </table>
                                        <br/>
                                        <h4><?php echo $lang['Do you require this package to be tracked?']; ?></h4>
                                        <br/>
                                        <h4><?php echo $lang['A tracking envelope will cost an additional:']; ?> $<?php echo $option['tracking_cost']; ?></h4>
                                        <br/>
                                        <div class="col-md-12 text-center">
                                            <button type="cancel" name="cancel" class="success" id="need_tracking"><?php echo $lang['Yes, I need a Tracking Number']; ?></button>
                                            <button type="submit" name="submit" class="cancel" id="need_not_tracking"><?php echo $lang["No, I don't need a Tracking Number"]; ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){

    var tracking_envelope = $('#tracking_envelope'),
        //amount = $('#amount'),
        //convenience = $('#convenience'),
        //tracking_cost = $('#tracking_cost')
        tracking_status = $('#tracking_status'),
        confirmModal = $('#confirmModal'),
        confirm2Modal = $('#confirm2Modal'),
        need_tracking = $('#need_tracking'),
        need_not_tracking = $('#need_not_tracking'),
        sub_total = $('#sub_total'),
        tax = $('#tax'),
        total = $('#total');

    var _total1 = parseFloat(<?php echo $price; ?>) + parseFloat(<?php echo $convenience; ?>) + parseFloat(<?php echo $tracking_cost; ?>);
    var _total2 = parseFloat(<?php echo $price; ?>) + parseFloat(<?php echo $convenience; ?>);

    var _hst1 = <?php echo (($convenience + $tracking_cost) * $option['tax'])/100 ?>;
    var _hst2 = <?php echo ($convenience * $option['tax'])/100; ?>;

    var _total1_ = parseFloat(_total1) + parseFloat(_hst1);
    var _total2_ = parseFloat(_total2) + parseFloat(_hst2);
        

    need_tracking.click(function() {
        tracking_status.val('Yes');
        tracking_envelope.show();
        sub_total.text( '$'+_total1.toFixed(2) );
        tax.text( '$'+_hst1.toFixed(2) );
        total.text( '$'+_total1_.toFixed(2) );
        confirmModal.modal('hide');
        confirm2Modal.modal('show');
    });
    need_not_tracking.click(function() {
        tracking_status.val('No');
        tracking_envelope.hide();
        sub_total.text( '$'+_total2.toFixed(2) );
        tax.text( '$'+_hst2.toFixed(2) );
        total.text( '$'+_total2_.toFixed(2) );
        confirmModal.modal('hide');
        confirm2Modal.modal('show');
    });
});  
</script>

<?php 
require('footer.php'); 
?>