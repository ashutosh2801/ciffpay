<?php 
require('forms/function.php'); 
$option = pluck($conn);
require('header.php'); 

//echo $_GET['slug'].'-------------'; exit;
$sql = "SELECT * FROM tbl_pages WHERE slug='".$_GET['slug']."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$model = $result->fetch_object();
} else {
	$msg = $lang['Invalid ID!'];
	header('Location: '.SITEURL.'/404');
	exit;
}
?>

<section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="<?php echo SITEURL; ?>"><?php echo $lang['Home']; ?></a></li>
          <li><?php $title = "title$lang_field"; echo $model->$title; ?></li>
        </ol>
        <!-- <h2>Blog Single</h2> -->

      </div>
    </section>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex" style="padding-top:50px">

    <div class="container">
      <div class="row">
        <div class="col-lg-12 d-flex flex-column justify-content-center">
          <div class="hero_wra1">
            <h2 data-aos="fade-up"><?php echo $model->$title; ?></h2> 
            <div class="description"><?php $content = "content$lang_field"; echo $model->$content; ?></div>
        </div>
        </div>
      </div>
    </div>

  </section>
  <!-- End Hero -->

<?php 
require_once('footer.php'); 
?>