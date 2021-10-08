<?php 
require('forms/function.php'); 
$option = pluck($conn);
$title = 'Home | CIFF Pay Solution Inc.';
require('header.php'); 
//$user_id = $_SESSION['user_id'];
$user_id = $_COOKIE['user_id'];
//echo '<pre>'; print_r($lang);

$inmate = [];
if(intval($_GET['id'])) {
  $sql2 = "SELECT * FROM `tbl_inmates` WHERE id='".intval($_GET['id'])."' limit 1";
  $result2 = $conn->query($sql2);
  $inmate = $result2->fetch_object();
  if($inmate && isset($_POST['continue']) ) {
    extract($_POST);
    $sql = "UPDATE tbl_inmates SET prison_type='$prison_type', status=0, institute='$institute', cheque_id='$amount' WHERE id='".intval($_GET['id'])."'";
    if($conn->query($sql)) 
    {
      header('Location: '.SITEURL.'/recipient/'.intval($_GET['id'])); 
      exit;
    }
  }
}
?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-12 d-flex flex-column justify-content-center" style="text-align:center;">
          <div class="hero_wra">
          <form id="inmate-form" action="" method="post" role="form" <?php if(empty($_GET['id'])) { ?>onsubmit="return false;"<?php } ?>>
          <div id="step1">
            <h2><?php echo $lang['How much do you want to send?']; ?> </h2>
            <div class="price" data-aos="fade-up" data-aos-delay="400">

              <?php 
              $first = $i = 0; 
              $sql = "SELECT * FROM `tbl_cheques` WHERE 1 ORDER by price";
              if ($result = $conn -> query($sql)) {
                while ($obj = $result -> fetch_object()) {
                  $active='';
                  if(($i==0 && empty($_GET['id'])) || $inmate->cheque_id==$obj->id) { $first=$obj->id; $active='active'; } 
                  $i++;
              ?>
              <button type="button" value="<?php echo $obj->id; ?>" class="btn3 <?php echo $active; ?>">$<?php echo $obj->price; ?></button>
                <?php
                }
              }
              // Free result set
              $result -> free_result();               
              ?>            
              <input type="hidden" name="amount" id="amount" value="<?php echo $first; ?>">
            </div>
            <br>
            
            <div data-aos="fade-up" data-aos-delay="600">
              <button type="button" class="btn2" id="continue"><?php echo $lang['Continue']; ?> <i class="bi bi-arrow-right"></i></button>
            </div>

            <div class="description"><?php echo $option['home_page_content_1'.$lang_field]; ?></div>
          </div>

          <div id="step2" style="display: none;">
            <h2 data-aos="fade-up"><?php echo $lang['Send money to your loved one.']; ?></h2>
            <div class="prison_type" data-aos="fade-up" data-aos-delay="400">

              <button type="button" value="provincial" class="btn3 <?php if($inmate->prison_type=='provincial') echo 'active'; ?>"><?php echo $lang['Provincial Jail']; ?></button>
              <button type="button" value="federal" class="btn3 <?php if($inmate->prison_type=='federal') echo 'active'; ?>"><?php echo $lang['Federal Jail']; ?></button>
              <input type="hidden" name="prison_type" id="prison_type" value="provincial">

            </div>
            <div data-aos="fade-up" data-aos-delay="400">
              <select name="institute" id="institute" class="form-control" style="line-height: 2em; font-size: large;">
                <option value=""><?php echo $lang['Click here to select your friend or loved one’s institution']; ?></option>
                <?php 
                $sql = "SELECT id,`title` FROM `tbl_correctional` WHERE 1 ORDER by title";
                if ($result = $conn -> query($sql)) {
                while ($obj = $result -> fetch_object()) {
                ?>
                  <option <?php if($inmate->institute==$obj->id) echo 'selected'; ?> value="<?php echo $obj->id; ?>"><?php echo $obj->title; ?></option>
                <?php
                }
                }
                // Free result set
                $result -> free_result();               
                ?>
              </select>
            </div>
            <br />
            <div data-aos="fade-up" data-aos-delay="600"> <?php //echo $_SESSION['user_id']; ?>

<?php if(intval($_GET['id'])) { ?>
    <button type="submit" class="btn2 send_now" name="continue"><?php echo $lang['Continue']; ?></button>
 <?php } else { ?> 
    <button type="submit" class="btn2 send_now" <?php if(isset($user_id)) { echo 'id="send_now"'; } else { echo 'data-bs-toggle="modal" data-bs-target="#exampleModal"'; } ?> disabled><?php echo $lang['Continue']; ?></button>
<?php } ?>

            </div>
            <?php if(isset($user_id)) { ?>
            <div class="form-group" id="message"></div>
            <?php } ?>
            <div class="description"><?php echo $option['home_page_content_2'.$lang_field]; ?></div>
          </div>
        </form>
        </div>
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <!-- ======= Values Section ======= -->
  <section id="values" class="values">

<div class="container" data-aos="fade-up">

  <header class="section-header">
    <!-- <h2><?php //echo $lang['Our Values']; ?></h2> -->
    <h2><?php echo $lang['CIFF Pay Solution']; ?></h2>
  </header>

  <div class="row">

    <div class="col-lg-4">
      <div class="box" data-aos="fade-up" data-aos-delay="200">
        <img src="assets/img/The-Problem.jpg" class="img-fluid" alt="The-Problem.jpg">
        <?php echo $option['solution_col_1'.$lang_field]; ?>
      </div>
    </div>

    <div class="col-lg-4 mt-4 mt-lg-0">
      <div class="box" data-aos="fade-up" data-aos-delay="400">
        <img src="assets/img/The-Solution.jpg" class="img-fluid" alt="The-Solution.jpg">
        <?php echo $option['solution_col_2'.$lang_field]; ?>
      </div>
    </div>

    <div class="col-lg-4 mt-4 mt-lg-0">
      <div class="box" data-aos="fade-up" data-aos-delay="600">
        <img src="assets/img/The-savings.jpg" class="img-fluid" alt="The-savings.jpg">
        <?php echo $option['solution_col_3'.$lang_field]; ?>
      </div>
    </div>

  </div>

</div>

</section><!-- End Values Section -->


<!-- ======= F.A.Q Section ======= -->
<section id="faq" class="faq">

<div class="container" data-aos="fade-up">

  <header class="section-header">
    <!-- <h2><?php //echo $lang['F.A.Q']; ?></h2> -->
    <h2><?php echo $lang['Frequently Asked Questions']; ?></h2>
  </header>

  <div class="row">
    <div class="col-lg-6">
      <!-- F.A.Q List 1-->
      <div class="accordion accordion-flush" id="faqlist1">

      <?php 
      $_sql = "SELECT * FROM `tbl_faqs` WHERE 1 ORDER by id asc";
      $_result = $conn -> query($_sql);
      $num_rows = $_result->num_rows;
      $half = ceil($num_rows/2);


      $sql = "SELECT * FROM `tbl_faqs` WHERE 1 ORDER by id asc LIMIT 0, $half";
      if ($result = $conn -> query($sql)) {
        $num_rows = $result->num_rows;
        $i=1;
        while ($obj = $result -> fetch_object()) {
      ?>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-<?php echo $i; ?>">
              <?php $title = 'title'.$lang_field; echo $obj->$title; ?>
            </button>
          </h2>
          <div id="faq-content-<?php echo $i; ?>" class="accordion-collapse collapse" data-bs-parent="#faqlist<?php echo $i; ?>">
            <div class="accordion-body">
            <?php $content = 'content'.$lang_field; echo $obj->$content; ?>
            </div>
          </div>
        </div>
      <?php
      $i++;
      }
      }
      // Free result set
      $result -> free_result();               
      ?>

      </div>
    </div>

    <div class="col-lg-6">

      <!-- F.A.Q List 2-->
      <div class="accordion accordion-flush" id="faqlist2">

      <?php
      $sql = "SELECT * FROM `tbl_faqs` WHERE 1 ORDER by id asc LIMIT $half, $num_rows";
      if ($result = $conn -> query($sql)) {
        $i=($half+1);
        while ($obj = $result -> fetch_object()) {
      ?>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-<?php echo $i; ?>">
              <?php $title = 'title'.$lang_field; echo $obj->$title; ?>
            </button>
          </h2>
          <div id="faq-content-<?php echo $i; ?>" class="accordion-collapse collapse" data-bs-parent="#faqlist<?php echo $i; ?>">
            <div class="accordion-body">
              <?php $content = 'content'.$lang_field; echo $obj->$content; ?>
            </div>
          </div>
        </div>
      <?php
      $i++;
      }
      }
      // Free result set
      $result -> free_result();               
      ?>

      </div>
    </div>

  </div>

</div>

</section><!-- End F.A.Q Section -->







<?php 
require('footer.php'); 
?> 