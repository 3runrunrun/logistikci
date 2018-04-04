<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container-fluid">

    <!-- Header & Navbar -->
    <?php include('navbar.php'); ?>
    <!-- /Header & Navbar -->

    <div class="row marketing">
      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
        <h2 class="text-center">Proses reservasi pengiriman berhasil</h2>
        <h4 class="text-center">Tanda bukti reservasi telah dikirim ke email anda.</h4>
      </div>

      <div class="help-block visible-xs">&nbsp;</div>
      <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
        <h3 class="text-center">Tanda Bukti Reservasi Pengiriman</h3>
        
        <?php foreach ($data as $data) { ?>

        <!-- Informasi armada -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
          <h4 class="text-capitalize">Informasi Armada</h4>
          <span class="glyphicon glyphicon-send" style="font-size: 5em"></span>
          <?php foreach ($infoarmada as $infoarmada) { ?>
          <p class="text-uppercase"><strong><?php echo $infoarmada['vehiclenumber']; ?></strong></p>
          <p class="text-capitalize"><?php echo $infoarmada['drivername']; ?></p>
          <p class=""><?php echo $infoarmada['armadaphone']; ?></p>
          <?php } ?>
        </div>
        <!-- /Informasi armada -->

        <div class="help-block visible-xs">&nbsp;</div>
        <!-- Informasi keberangkatan -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
          <h4 class=" text-capitalize">Informasi Keberangkatan</h4>
          <p class="text-capitalize">
            <strong>
              <?php 
                setlocale(LC_TIME, 'Indonesian');

                $ddatetimestamp = strToTime($data['deliverydate']);

                $dday = strftime('%A', $ddatetimestamp);
                $ddate = date('d', $ddatetimestamp);
                $dmonth = strftime('%B', $ddatetimestamp);
                $dyear = strftime('%Y', $ddatetimestamp);
                
                echo $dday . ', ' . $ddate . ' ' . $dmonth . ' ' . $dyear; 
              ?> 
            </strong>
          </p>
          <!-- <div class="col-sm-12 col-md-12 col-lg-10 col-sm-offset-0 col-md-offset-0 col-lg-offset-1"> -->
          <table class="table text-center">
            <thead>
              <tr>
                <th class="text-center">Berangkat</th>
                <th class="text-center">Tiba</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              foreach ($inforute as $inforute) { 
                $dtimestamp = strToTime($inforute['departuretime']);
                $atimestamp = strToTime($inforute['arrivaltime']);

                $dtime = date("H:i", $dtimestamp);
                $atime = date("H:i", $atimestamp);
            ?>
              <tr>
                <td><?php echo $dtime ?></td>
                <td><?php echo $atime ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
          <!-- </div> -->
        </div>
        <!-- /Informasi keberangkatan -->

        <div class="help-block visible-xs">&nbsp;</div>
        <!-- Kode dan biaya reservasi -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
          <div class="col-sm-6 col-md-12">
            <h4 class="text-capitalize">Kode Reservasi</h4>
            <p><strong style="font-size:2em"><?php echo $data['reservationcode']; ?></strong></p>
          </div>
          <p class="hidden-sm">&nbsp;</p>
          <div class="col-sm-6 col-md-12">
            <h4 class="text-capitalize">Estimasi Biaya</h4>
            <p><strong style="font-size:2em">Rp <?php echo $data['fare']; ?>*<br></strong><em style="font-size:0.8em">*Belum termasuk asuransi pengiriman</em></p>
          </div>
        </div>
        <!-- /Kode dan biaya reservasi -->

        <div class="help-block visible-xs">&nbsp;</div>

        <!-- Alamat detail -->
        <?php 
          foreach ($kotaasal as $kotaasal) { 
            foreach ($kotatujuan as $kotatujuan) {
        ?>
          <div class="col-sm-12 col-md-12 text-left hidden-xs">
          <table class="table">
            <thead>
              <tr>
                <th>Dari</th>
                <th>Menuju</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th><?php echo $kotaasal['city'] . ' (' . $data['departureidbranch'] . ')'; ?></th>
                <th><?php echo $kotatujuan['city'] . ' (' . $data['arrivalidbranch'] . ')'; ?></th>
              </tr>
              <tr>
                <td>
                  <?php echo $kotaasal['branchaddress']; ?>
                </td>
                <td>
                  <?php echo $kotatujuan['branchaddress']; ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-xs-12 text-left visible-xs">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Dari</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th><?php echo $kotaasal['city'] . ' (' . $data['departureidbranch'] . ')'; ?></th>
              </tr>
              <tr>
                <td>
                  <?php echo $kotaasal['branchaddress']; ?>
                </td>
              </tr>
            </tbody>
          </table>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Menuju</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th><?php echo $kotatujuan['city'] . ' (' . $data['arrivalidbranch'] . ')'; ?></th>
              </tr>
              <tr>
                <td>
                  <?php echo $kotatujuan['branchaddress']; ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php } } ?>
        <!-- /Alamat detail -->

        <!-- Informasi barang -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center text-capitalize">
          <h4 class="text-center">Informasi Barang</h4>
          <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
            <li style="list-style:none">
              <span class="glyphicon glyphicon-briefcase" style="font-size:1.6em"></span>
              <span class="glyphicon-class" style="font-size:1em"><strong><br><?php echo $data['idcargocategory']; ?></strong></span>
            </li>
          </div>
          <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
            <li style="list-style:none">
              <span class="glyphicon glyphicon-ok" style="font-size:1.6em"></span>
              <span class="glyphicon-class" style="font-size:1em">
                <strong><br>
                  <?php
                    if ($data['insurance'] == '1') {
                      echo "Asuransi";
                    } else {
                      echo "Non-Asuransi";
                    }
                  ?>
                </strong>
              </span>
            </li>
          </div>
          <div class="help-block hidden-sm hidden-md hidden-lg">&nbsp;</div>
          <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
            <li style="list-style:none">
              <span class="glyphicon glyphicon-scale" style="font-size:1.6em"></span>
              <span class="glyphicon-class" style="font-size:1em"><strong><br><?php echo $data['cargoweight']; ?> Kg.</strong></span>
            </li>
          </div>
          <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
            <li style="list-style:none">
              <span class="glyphicon glyphicon-resize-full" style="font-size:1.6em"></span>
              <span class="glyphicon-class text-lowercase" style="font-size:1em">
                <strong><br>
                  <?php echo $data['cargolength']." m. x ".$data['cargowidth']." m. x ".$data['cargoheight']." m."; ?>
                </strong>
              </span>
            </li>
          </div>
        </div>
        <!-- /Informasi barang -->

        <div class="help-block col-xs-12" style="background-color:#E53935; height:3px; margin: 20px 0"></div>
        <div class="col-lg-12">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <!-- medium & large viewport -->
            <span class="glyphicon glyphicon-barcode col-md-3 col-lg-3 col-xs-offset-4 col-sm-offset-4 col-md-offset-0 visible-md visible-lg" style="font-size:4em"></span>
            <span class="glyphicon-class col-md-9 col-lg-9 visible-md visible-lg" style="font-size:1em; font-weight: bold">Tunjukan Kode Reservasi kepada agen LogOn saat booking</span>
            <!-- /medium & large viewport -->

            <!-- xsmall & small viewport -->
            <span class="glyphicon glyphicon-barcode col-xs-2 col-sm-2 visible-xs visible-sm" style="font-size:2em"></span>
            <span class="glyphicon-class col-xs-8 col-sm-9 col-xs-offset-1 text-left visible-xs visible-sm" style="font-size:0.6em; font-weight: bold">Tunjukan Kode Reservasi kepada agen LogOn saat booking</span>
            <!-- /xsmall & small viewport -->

          </div>
          <div class="help-block hidden-sm hidden-md hidden-lg">&nbsp;</div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <!-- medium & large viewport -->
            <span class="glyphicon glyphicon-time col-md-3 col-lg-3 col-xs-offset-4 col-sm-offset-4 col-md-offset-0 visible-md visible-lg" style="font-size:4em"></span>
            <span class="glyphicon-class col-md-9 col-lg-9 visible-md visible-lg" style="font-size:1em; font-weight: bold">Booking paling lambat 30 menit sebelum pengiriman</span>
            <!-- /medium & large viewport -->

            <!-- xsmall & small viewport -->
            <span class="glyphicon glyphicon-time col-xs-2 col-sm-2 visible-xs visible-sm" style="font-size:2em"></span>
            <span class="glyphicon-class col-xs-8 col-sm-9 col-xs-offset-1 text-left visible-xs visible-sm" style="font-size:0.6em; font-weight: bold">Booking paling lambat 30 menit sebelum pengiriman</span>
            <!-- /xsmall & small viewport -->
          </div>
        </div>

        <?php } ?>
      </div>
    </div>
  </div>