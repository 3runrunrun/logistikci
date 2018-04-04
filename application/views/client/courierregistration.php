
  <!-- ID Generator -->
  <script>
    $(document).ready(function() {
      var alamat = '<?php echo base_url("index.php/ControllerSystem/idGenerator/courier"); ?>';
      setInterval(function() {
        $.ajax({
          url: alamat,
          cache: false,
          success: function(result) {
            $('#courier-id').val(result);
          }
        });
      }, 1000);
    });
  </script>

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
      <h2 class="text-uppercase text-center">REGISTRASI GRATIS SEBAGAI KURIR</h2>
      <p class="text-center">Sudah memiliki akun? Masuk <a href="<?php echo site_url('user/viewHalamanLogin'); ?>">disini</a></p>
      <div class="help-block">&nbsp;</div>
    </div>
    <!-- /Title -->

    <!-- Form -->
    <div class="row">
      <form id="courier-registration-form" action="<?php echo base_url('index.php/user/insertCourier'); ?>" method="POST">
        <!-- Form pendaftaran kurir -->
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 col-sm-offset-2 col-md-offset-2 col-lg-offset-3">
          <h4 class="text-center">Form Pendaftaran Kurir</h4>
          <div class="form-group">
            <label for="courier-id" class="sr-only">ID Kurir</label>
            <input type="hidden" name="courierid" id="courier-id" class="form-control" placeholder="ID Kurir" required="required">
          </div>
          <div class="form-group">
            <label for="courier-name" class="sr-only">Nama Kurir</label>
            <div class="input-group">
              <input type="text" name="couriername" id="courier-name" class="form-control" placeholder="Nama Kurir" required="required">
              <div class="input-group-addon">*</div>
            </div>
          </div>
          <div class="form-group">
            <label for="courier-address" class="sr-only">Alamat Kurir</label>
            <div class="input-group">
              <input type="text" name="courieraddress" id="courier-address" class="form-control" placeholder="Alamat Kurir" required="required">
              <div class="input-group-addon">*</div>
            </div>
          </div>
          <div class="form-group">
            <label for="courier-phone" class="sr-only">No. Telepon Kurir</label>
            <div class="input-group">
              <input type="tel" name="courierphone" id="courier-phone" class="form-control" placeholder="No. Telepon Kurir" required="required">
              <div class="input-group-addon">*</div>
            </div>
            <em style="font-size:0.8em">Contoh: 08xxx</em>
          </div>
          <div id="courier-mail-div" class="form-group has-feedback">
            <label for="courier-mail" class="sr-only">Email Kurir</label>
            <div class="input-group">
              <input type="email" name="couriermail" id="courier-mail" class="form-control" placeholder="kurir@email.com" required="required">
              <div class="input-group-addon">*</div>
            </div>
            <em style="font-size:0.8em">Contoh: name@mail.com</em>
            <em id="email-msg" class="pull-right" style="font-size:0.8em"></em>
          </div>
          <div id="pwd-one" class="form-group has-feedback">
            <label for="courier-pwd-one" class="sr-only">Password</label>
            <div class="input-group">
              <input type="password" name="courierpwdone" id="courier-pwd-one" class="form-control" placeholder="Kata Sandi" required="required">
              <div class="input-group-addon">*</div>
            </div>
            <em id="pwd-one-msg" class="pull-right" style="font-size:0.8em"></em>
          </div>
          <div id="pwd-two" class="form-group has-feedback">
            <label for="courier-pwd-two" class="sr-only">Confirm Password</label>
            <div class="input-group">
              <input type="password" name="courierpwdtwo" id="courier-pwd-two" class="form-control" placeholder="Ulangi Kata Sandi" required="required">
              <div class="input-group-addon">*</div>
            </div>
            <em id="pwd-two-msg" class="pull-right" style="font-size:0.8em"></em>
          </div>
        </div>
        <!-- /Form pendaftaran kurir -->

        <!-- Form pendaftaran penanggung jawab -->
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
          <h4 class="text-center">Form Penanggung Jawab</h4>
          <div class="form-group">
            <label for="owner-name" class="sr-only">No. KTP Penanggung Jawab</label>
            <div class="input-group">
              <input type="text" name="ownerid" id="owner-id" class="form-control" placeholder="No. KTP Penanggung Jawab" required="required">
              <div class="input-group-addon">*</div>
            </div>
          </div>
          <div class="form-group">
            <label for="owner-name" class="sr-only">Nama Penanggung Jawab</label>
            <div class="input-group">
              <input type="text" name="ownername" id="owner-name" class="form-control" placeholder="Nama Penanggung Jawab" required="required">
              <div class="input-group-addon">*</div>
            </div>
          </div>
          <div class="form-group">
            <label for="owner-address" class="sr-only">Alamat Penanggung Jawab</label>
            <div class="input-group">
              <input type="text" name="owneraddress" id="owner-address" class="form-control" placeholder="Alamat Penanggung Jawab" required="required">
              <div class="input-group-addon">*</div>
            </div>
          </div>
          <div class="form-group">
            <label for="owner-phone" class="sr-only">No. Telepon Penanggung Jawab</label>
            <div class="input-group">
              <input type="tel" name="ownerphone" id="owner-phone" class="form-control" placeholder="No. Telepon Penanggung Jawab" required="required">
              <div class="input-group-addon">*</div>
            </div>
            <em style="font-size:0.8em">Contoh: 08xxx</em>
          </div>
          <div class="form-group">
            <label for="owner-mail" class="sr-only">Email Penanggung Jawab</label>
            <div class="input-group">
              <input type="email" name="ownermail" id="owner-mail" class="form-control" placeholder="pj@email.com" required="required">
              <div class="input-group-addon">*</div>
            </div>
            <em style="font-size:0.8em">Contoh: name@mail.com</em>
          </div>
          <div class="form-group">
            <label for="agree" class="">
              <input type="checkbox" name="agree" id="agree" required="required"> Saya telah menyetujui &amp; membaca <a href="#">Syarat dan Persetujuan</a> yang berlaku*.
            </label>
          </div>
          <div class="form-group">
            <label for="sign-up" class="sr-only">Daftar Sebagai Kurir</label>
            <input type="submit" name="signup" value="Daftar Sebagai Kurir" id="sign-up" class="form-control btn btn-success" disabled="disabled">
          </div>
        </div>
        <!-- /Form pendaftaran penanggung jawab -->
      </form>
    </div>
    <!-- /Form -->
  </div>

  <!-- Email Avaibility -->
  <script>
    $(document).ready(function() {
      $('#courier-mail').focusout(function() {
        var nilai = $('#courier-mail').val();
        var berkas = "<?php echo base_url('index.php/ControllerSystem/emailAvailibility/'); ?>";
        $.ajax({
          url: berkas,
          type: 'POST',
          data: {
            "nilai": nilai
          },
          cache: false,
          success: function(result) {
            if ($('#courier-mail').val() == "") {
              $('#courier-mail-div').removeClass('has-success');
              $('#courier-mail-div').addClass('has-error');
              $('#email-msg').html('<span class="glyphicon glyphicon-remove" style="color:red"></span>&nbsp;<strong>Kolom email wajib diisi.</strong>');
            } else {
              if (result == "false") {
                $('#courier-mail-div').removeClass('has-success');
                $('#courier-mail-div').addClass('has-error');
                $('#email-msg').html('<span class="glyphicon glyphicon-remove" style="color:red"></span>&nbsp;<strong>Email sudah digunakan.</strong>');
              } else {
                $('#courier-mail-div').removeClass('has-error');
                $('#courier-mail-div').addClass('has-success');
                $('#email-msg').html('<span class="glyphicon glyphicon-ok" style="color:green"></span>&nbsp;<strong>Email tersedia.</strong>');
              }
            }
          }
        });
      });
    });
  </script>

  <!-- Password Matching Check -->
  <script type="text/javascript">
    $(document).ready(function() {
      var isTrue = false;
      $('#courier-pwd-one, #courier-pwd-two').focusout(function() {
        var charlength = $('#courier-pwd-one').val().length;
        var pwdvaluea = $('#courier-pwd-one').val();
        var pwdvalueb = $('#courier-pwd-two').val();
        if (charlength < 6) {
          $('#pwd-one, #pwd-two').removeClass('has-success');
          $('#pwd-one, #pwd-two').addClass('has-error');
          $('#pwd-one-msg, #pwd-two-msg').html('<span class="glyphicon glyphicon-remove" style="color:red"></span>&nbsp;<strong>Minimal 6 karakter</strong>');
        } else {
          $('#pwd-one').removeClass('has-error');
          $('#pwd-one').addClass('has-success');
          $('#pwd-one-msg').html('<span class="glyphicon glyphicon-ok" style="color:green"></span>&nbsp;');
          if (pwdvaluea != pwdvalueb) {
            $('#sign-up').attr('disabled', 'disabled');
            $('#pwd-two-msg').html('<span class="glyphicon glyphicon-remove" style="color:red"></span>&nbsp;<strong>Kata sandi tidak sesuai</strong>');
          } else {
            $('#pwd-two').removeClass('has-error');
            $('#pwd-two').addClass('has-success');
            $('#pwd-two-msg').html('<span class="glyphicon glyphicon-ok" style="color:green"></span>&nbsp;');
            isTrue = true;
            $('#sign-up').removeAttr('disabled');
          }
        }
      });
    });
  </script>

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/docs.min.js'); ?>"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="<?php echo base_url('assets/js/ie10-viewport-bug-workaround.js'); ?>"></script>
</body>

</html>
