<?php 
require('forms/function.php'); 
$option = pluck($conn);

$title = 'Thank you | CIFF Pay Solution Inc.';

require_once('header.php'); 
?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-12 d-flex flex-column justify-content-center" style="text-align:center;">
          <div class="hero_wra">
            <h2 data-aos="fade-up"><?php echo $lang['Your order has been placed.']; ?></h2> 
            <h3 data-aos="fade-up"><?php echo $lang['Your order number:']; ?> <strong><?php echo $_GET['order_id']; ?></strong></h3> 

            <p><?php echo $lang['An email has been sent to you about how to make an eTransfer to CIFFpay. If you have not received the email please check your junkmail folder or email support@ciffpay.com']; ?></p>

            <p><?php echo $lang['Once we receive the eTransfer, you Money Order will be mailed out within 24 hours.']; ?></p>

            <p><a href="/"> <?php echo $lang['Click here']; ?></a> <?php echo $lang['to go to Homepage.']; ?></p>
        </div>
        </div>
      </div>
    </div>

  </section>
  <!-- End Hero -->

<?php 
require_once('footer.php'); 
?>