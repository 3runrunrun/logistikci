
  <div class="container-fluid">
    <!-- Logo -->
    <div class="row">
      <a href="<?php echo base_url(); ?>">
        <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="" class="col-xs-6 col-sm-2 col-md-2 col-lg-2 col-xs-offset-3 col-sm-offset-5 col-lg-offset-5" />
      </a>
    </div>
    <!-- /Logo -->

    <!-- Title -->
    <div class="row">
      <div class="help-block">&nbsp;</div>
      <h2 class="text-uppercase text-center">MASUK KE AKUN ANDA</h2>
      <p class="text-center">Belum memiliki akun? Daftar <a href="<?php echo site_url('user/viewHalamanDaftar'); ?>">disini</a></p>
      <div class="help-block">&nbsp;</div>
    </div>
    <!-- /Title -->

    <!-- Form -->
    <div class="row">
      <form id="courier-registration-form" action="<?php echo site_url('User/Login'); ?>" method="POST">
        <!-- Form login -->
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xs-offset-0 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
          <div class="form-group">
            <label for="email-address" class="sr-only">Alamat Email</label>
            <input type="text" name="email" id="email-address" class="form-control input-lg" placeholder="Alamat Email" required="required"> 
          </div>
          <div class="form-group">
            <label for="kata-sandi" class="sr-only">Kata Sandi</label>
            <input type="password" name="pwd" id="kata-sandi" class="form-control input-lg" placeholder="Kata Sandi" required="required">
          </div>
          <div class="form-group">
            <label for="log-in" class="sr-only">Masuk</label>
            <input type="submit" name="login" value="Masuk" id="log-in" class="form-control input-lg btn btn-lg btn-success">
          </div>
        </div>
        <!-- /Form login -->
      </form>
    </div>
    <!-- /Form -->
  </div>

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/docs.min.js'); ?>"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="<?php echo base_url('assets/js/ie10-viewport-bug-workaround.js'); ?>"></script>
</body>

</html>
