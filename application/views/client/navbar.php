<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!-- Header & Navbar -->
<div class="header clearfix">
  <!-- Fixed navbar -->
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url(); ?>">
          <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="Logistik Online" width="50" style="object-fit: contain">
        </a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a id="choose-track-on" href="#trackon">TrackOn</a></li>
          <li><a href="<?php echo base_url('index.php/user/viewHalamanComplaint'); ?>">Pengaduan</a></li>
          <li><a href="<?php echo base_url('index.php/user/viewHalamanTestimonial'); ?>">Testimoni</a></li>
          <li><a href="<?php echo base_url('index.php/user/viewhalamandaftar'); ?>">Daftar</a></li>
          <li><a href="<?php echo site_url('Admins/'); ?>">Masuk</a></li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </nav>
</div>
<!-- /Header & Navbar -->
<script>
  $(document).ready(function() {
    var btn = document.getElementById('choose-track-on');
    var idtrackon = document.getElementById("trackon");
    var link = "<?php echo site_url('User/showTrackingResult'); ?>";
    console.log(idtrackon);
    if (idtrackon == null) {
      $('#choose-track-on').removeAttr('href');
      btn.setAttribute("href", link);
    }
  });
</script>
