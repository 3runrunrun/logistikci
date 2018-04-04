<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <!-- idGenerator -->
  <script>
    $(document).ready(function() {
      var alamat = '<?php echo base_url("index.php/ControllerSystem/idGenerator/reservation"); ?>';
      setInterval(function() {
        $.ajax({
          url: alamat,
          cache: false,
          success: function(result) {
            $('#reservation-code').val(result);
          }
        });
      }, 1000);
    });
  </script>

  <div class="container-fluid">

    <!-- Header & Navbar -->
    <?php include('navbar.php'); ?>
    <!-- /Header & Navbar -->

    <div class="row marketing">

      <!-- Title -->
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h2 class="text-center">Form Reservasi Pengiriman</h2>
        <div class="help-block">&nbsp;</div>
      </div>
      <!-- /Title -->

      <!-- Form reservasi -->
      <form action="<?php echo site_url('User/insertReservation'); ?>" method="POST">

        <!-- Informasi pengiriman -->
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-1 col-lg-offset-2">
          <h4 class="text-left">1. Informasi Pengiriman</h4>
          
          <!-- Kode Reservasi -->
          <input type="hidden" name="reservationcode" id="reservation-code" />
          <!-- /Kode Reservasi -->
          
          <div class="col-xs-3 col-sm-2 col-md-3 col-lg-2" style="font-size:3.2em">
            <span class="glyphicon glyphicon-send"></span>
          </div>
          <div class="col-xs-9 col-sm-5 col-md-10 col-lg-10 text-left">

            <?php foreach ($infoarmada as $infoarmada) { ?>
              
              <!-- ID Armada -->
              <input type="hidden" name="idarmada" id="id-armada" value="<?php echo $infoarmada['idarmada']; ?>" />
              <!-- /ID Armada -->
              
              <p><?php echo $infoarmada['vehiclenumber']; ?></p>
              <p><?php echo $infoarmada['drivername']; ?></p>

            <?php } ?>
          
          </div>
          <div class="help-block visible-xs">&nbsp;</div>

          <!-- Estimasi Biaya - SM VIEWPORT ONLY -->
          <?php foreach ($infobiaya as $infobiaya) { ?>
            <div class="col-sm-4 visible-sm">
              <div class="help-block text-center" style="margin-top:0;"><strong>Estimasi Biaya</strong></div>
              <h4 class="text-center" style="font-size:2em; margin-top:0; margin-bottom:0;">Rp <?php echo $infobiaya['fare']; ?>*</h4>
              
              <!-- Fare -->
              <input type="hidden" name="fare" id="fare" value="<?php echo $infobiaya['fare']; ?>" />
              <!-- /Fare -->
              
              <p class="text-center"><em style="font-size:0.8em">*Belum termasuk asuransi pengiriman.</em></p>
            </div>
            <?php } ?>
            <!-- /Estimasi Biaya - SM VIEWPORT ONLY -->

          <?php 
            foreach ($infokeberangkatan as $infokeberangkatan) { 
              
              // Date formating due to delivery date input to database
              $combineddate = $infokeberangkatan['deliverydate']. ' ' .$infokeberangkatan['departuretime'];
              $deliverydatestamp = strToTime($combineddate);

              // Time formating due presentation to user
              $dtimetimestamp = strToTime($infokeberangkatan['departuretime']);
              $dtime = date("H:i", $dtimetimestamp);

              $atimetimestamp = strToTime($infokeberangkatan['arrivaltime']);
              $atime = date("H:i", $atimetimestamp);
          ?>
          <div class="col-xs-12 col-lg-12 text-left">
            <p>
              <strong>
                <?php 
                  setlocale(LC_TIME, 'Indonesian');
                  $hari = strftime('%A', $deliverydatestamp);
                  $tgl = strftime('%d', $deliverydatestamp);
                  $bulan = strftime('%B', $deliverydatestamp);
                  $tahun= strftime('%Y', $deliverydatestamp);

                  echo $hari . ", " . $tgl . " " . $bulan . " " . $tahun;
                ?>
              </strong>
            </p>
            
            <!-- Delivery Date -->
            <input type="hidden" name="deliverydate" id="delivery-date" value="<?php echo date('Y-m-d H:i:s', $deliverydatestamp) ?>" />
            <!-- /Delivery Date -->
          
          </div>
          <div class="col-xs-12 col-sm-1 col-md-3 col-lg-2 text-left">
            <p><strong><?php echo $dtime; ?></strong></p>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-9 col-lg-10 col-sm-offset-1 col-md-offset-0 text-left">
            <?php foreach ($alamatasal as $alamatasal) { ?>
            <p>
              <strong>

                <?php 
                  echo $alamatasal['city']." (".$infokeberangkatan['origincity'].")";
                ?>    

                <!-- Departure ID Branch -->
                <input type="hidden" name="departureidbranch" id="didbranch" value="<?php echo $infokeberangkatan['origincity']; ?>" />
                <!-- /Departure ID Branch -->

              </strong>
            </p>
              <p>
                <?php echo $alamatasal['branchaddress']; ?>
              </p>
            <?php } ?>
          </div>
          <div class="col-xs-12 col-sm-1 col-md-3 col-lg-2 col-sm-offset-1 col-md-offset-0 text-left">
            <p><strong><?php echo $atime; ?></strong></p>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-9 col-lg-10 text-left">
            <?php foreach ($alamattujuan as $alamattujuan) { ?>
            <p>
              <strong>

                <?php 
                  echo $alamattujuan['city']." (".$infokeberangkatan['arrivalcity'].")";
                ?>    

                <!-- Arrival ID Branch -->
                <input type="hidden" name="arrivalidbranch" id="aidbranch" value="<?php echo $infokeberangkatan['arrivalcity']; ?>" />
                <!-- /Arrival ID Branch -->

              </strong>
            </p>
              <p>
                <?php echo $alamattujuan['branchaddress']; ?>
              </p>
            <?php } ?>
          </div>
          <?php } ?>

          <div class="help-block visible-xs">&nbsp;</div>


          <?php foreach ($infobiaya as $infobiaya) { ?>
            <div class="col-xs-12 col-lg-12 hidden-sm">
              <h4 class="text-center">Estimasi Biaya</h4>
              <p class="text-center" style="font-size:2em">Rp <?php echo $infobiaya; ?>*</p>
              <!-- Fare -->
              <input type="hidden" name="fare" id="fare" value="<?php print_r($infobiaya); ?>" />
              <!-- /Fare -->
              <p class="text-center"><em style="font-size:0.8em">*Belum termasuk asuransi pengiriman.</em></p>
            </div>
          <?php } ?>

          <?php foreach ($infomuatan as $infomuatan) { ?>
          <div class="col-xs-12 col-sm-3 col-md-5 col-lg-6 text-left">
            <span class="glyphicon glyphicon-briefcase" style="font-size:1.3em"></span>
            <span class="glyphicon-class">
              
              <?php echo $infomuatan['cargocategory']; ?>
              
              <!-- Cargo Category -->
              <input type="hidden" name="idcargocategory" id="cargo-category" value="<?php echo $infomuatan['cargocategory']; ?>" />
              <!-- /Cargo Category -->

            </span>
          </div>
          <div class="col-xs-12 col-sm-3 col-md-7 col-lg-6 text-left">
            <span class="glyphicon glyphicon-ok" style="font-size:1.3em"></span>
            <span class="glyphicon-class">
              
              <?php 
                if ($infomuatan['insurance'] == '1') {
                  echo "Asuransi";
                } else {
                  echo "Non-Asuransi";
                }
              ?>

              <!-- Insurance -->
              <input type="hidden" name="insurance" id="insurance" value="<?php echo $infomuatan['insurance']; ?>" />
              <!-- /Insurance -->

            </span>
          </div>
          <div class="col-xs-12 col-sm-2 col-md-5 col-lg-6 text-left">
            <span class="glyphicon glyphicon-scale" style="font-size:1.3em"></span>
            <span class="glyphicon-class">
              
              <?php echo $infomuatan['cargoweight']; ?> Kg.

              <!-- Cargo Weight -->
              <input type="hidden" name="cargoweight" id="cargo-weight" value="<?php echo $infomuatan['cargoweight']; ?>" />
              <!-- /Cargo Weight -->

            </span>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-7 col-lg-6 text-left">
            <span class="glyphicon glyphicon-resize-full" style="font-size:1.3em"></span>
            <span class="glyphicon-class">
              
              <?php echo $infomuatan['cargolength']." m. x ".$infomuatan['cargowidth']." m. x ".$infomuatan['cargoheight']." m."; ?>
                
              <!-- cargo length, width, height -->
              <input type="hidden" name="cargolength" id="cargo-length" value="<?php echo $infomuatan['cargolength']; ?>" />
              <input type="hidden" name="cargowidth" id="cargo-width" value="<?php echo $infomuatan['cargowidth']; ?>" />
              <input type="hidden" name="cargoheight" id="cargo-height" value="<?php echo $infomuatan['cargoheight']; ?>" />
              <!-- /cargo length, width, height -->

            </span>
          </div>
        </div>
        <?php } ?>
        <!-- /Informasi pengiriman -->

        <div class="help-block visible-xs">&nbsp;</div>

        <!-- Identitas pengirim -->
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
          <h4 class="text-left">2. Identitas Pengirim</h4>
          <div class="form-group">
            <div class="input-group">
              <label for="sender-name" class="sr-only">Nama Pengirim</label>
              <input type="text" name="sendername" class="form-control" id="sender-name" placeholder="Nama Pengirim">
              <div class="input-group-addon">*</div>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <label for="sender-address" class="sr-only">Alamat Pengirim</label>
              <input type="text" name="senderaddress" class="form-control" id="sender-address" placeholder="Alamat Pengirim">
              <div class="input-group-addon">*</div>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <label for="sender-phone" class="sr-only">No. Telepon Pengirim</label>
              <input type="tel" name="senderphone" class="form-control" id="sender-phone" placeholder="No. Telepon Pengirim">
              <div class="input-group-addon">*</div>
            </div>
            <em style="font-size:0.8em">Contoh: 08xxxx</em>
          </div>
          <div class="form-group">
            <div class="input-group">
              <label for="sender-email" class="sr-only">Email Pengirim</label>
              <input type="email" name="senderemail" class="form-control" id="sender-email" placeholder="Email Pengirim">
              <div class="input-group-addon">*</div>
            </div>
            <em style="font-size:0.8em">Contoh: nama@mail.com</em>
          </div>
        </div>
        <!-- /Identitas pengirim -->

        <div class="help-block visible-xs">&nbsp;</div>
        <!-- Identitas Penerima -->
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
          <h4 class="text-left">3. Identitas Penerima</h4>
          <div class="form-group">
            <div class="input-group">
              <label for="recipient-name" class="sr-only">Nama Penerima</label>
              <input type="text" name="recipientname" class="form-control" id="recipient-name" placeholder="Nama Penerima">
              <div class="input-group-addon">*</div>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <label for="recipient-address" class="sr-only">Alamat Penerima</label>
              <input type="text" name="recipientaddress" class="form-control" id="recipient-address" placeholder="Alamat Penerima">
              <div class="input-group-addon">*</div>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <label for="recipient-phone" class="sr-only">No. Telepon Penerima</label>
              <input type="tel" name="recipientphone" class="form-control" id="recipient-phone" placeholder="No. Telepon Penerima">
              <div class="input-group-addon">*</div>
            </div>
            <em style="font-size:0.8em">Contoh: 08xxxx</em>
          </div>
          <div class="form-group">
            <label for="setuju" style="font-size:0.8em">
              <input type="checkbox" name="" id="setuju"> Saya telah menyetujui &amp; membaca <a href="#">Syarat dan Persetujuan</a> yang berlaku*.
            </label>
          </div>
          <div class="form-group">
            <label for="pesan" class="sr-only">Pesan</label>
            <input type="submit" name="" value="Pesan" id="pesan" class="form-control btn btn-success">
          </div>
        </div>
        <!-- /Identitas Penerima -->

      </form>
      <!-- /Form reservasi -->

    </div>
  </div>
  <!-- /container -->
