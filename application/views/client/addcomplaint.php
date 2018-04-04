<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container-fluid">

    <!-- Header & Navbar -->
    <?php include('navbar.php'); ?>
    <!-- /Header & Navbar -->

    <!-- Title -->
    <div class="row marketing">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2 class="text-center">Pusat Pengaduan</h2>
        <div class="help-block">&nbsp;</div>
      </div>
    </div>
    <!-- /Title -->

    <!-- Info -->
    <div class="row marketing">
      <div class="col-lg-8 col-lg-offset-2">
        <p class="well well-sm" style="margin: 0 16px">
          <span class="glyphicon glyphicon-info-sign" style="font-size:1.5em"></span> &nbsp; Pengaduan hanya dapat dilakukan terhadap pengiriman yang anda pesan.
        </p>
      </div>
    </div>
    <!-- /Info -->
    
    <!-- Form pengaduan -->
    <div class="row marketing">
      <form action="<?php echo site_url('User/insertComplaint'); ?>" method="POST">
        <div class="col-lg-8 col-lg-offset-2">

          <div class="col-lg-6">
            <div class="form-group">
              <label for="receipt-number" class="sr-only">No. Resi</label>
              <div class="input-group">
                <input type="text" name="receiptnumber" id="receipt-number" class="form-control" placeholder="No. Resi" required>
                <div class="input-group-addon">*</div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
              <label for="complaint" class="sr-only">Pengaduan</label>
              <textarea name="complaint" id="complaint" cols="30" rows="10" class="form-control" placeholder="Tulis pengaduan anda disini" required></textarea>
            </div>
            <div class="form-group">
              <label for="setuju" style="font-size:0.8em">
                <input type="checkbox" name="agree" id="setuju" required> Saya telah menyetujui &amp; membaca <a href="#">Syarat dan Persetujuan</a> yang berlaku*.
              </label>
            </div>
            <div class="form-group">
              <label for="send-complaint" class="sr-only">Kirim Pengaduan</label>
              <input type="submit" id="send-complaint" class="form-control btn btn-success" value="Kirim Pengaduan">
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- /Form pengaduan -->
  </div>
