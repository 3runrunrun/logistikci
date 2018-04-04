<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="container-fluid">
    <!-- Logo -->
    <div class="row">
      <a href="<?php echo base_url(); ?>">
        <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="Logo" class="col-xs-6 col-sm-2 col-md-2 col-lg-2 col-xs-offset-3 col-sm-offset-5 col-lg-offset-5" />
      </a>
    </div>
    <!-- /Logo -->

    <!-- Title -->
    <div class="row">
      <div class="help-block">&nbsp;</div>
      <h2 class="text-capitalize text-center">TrackOn - Trace &amp; Tracking</h2>
      <p class="text-center">TrackOn memudahkan anda melacak lokasi dan status barang yang sedang anda kirim.</p>
      <div class="help-block">&nbsp;</div>
    </div>
    <!-- /Title -->

    <!-- Row form -->
    <div class="row">

      <!-- Form -->
      <form action="">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
          <h4 class="text-left">Masukkan No. Resi</h4>
          <div class="help-block">&nbsp;</div>
          <div class="form-group">
            <span class="glyphicon glyphicon-info-sign"></span>
            <span class="glyphicon-class" style="font-size:1em">Anda bisa memasukkan lebih dari 1 No. Resi, masukkan setiap resi pada baris yang berbeda.</span>
          </div>
          <div class="form-group">
            <label for="noresi" class="sr-only">No. Resi</label>
            <textarea name="" id="noresi" class="form-control" placeholder="No. Resi"></textarea>
          </div>
          <div class="form-group">
            <label for="lacak" class="sr-only">Lacak</label>
            <input type="submit" value="Lacak" id="lacak" class="form-control btn btn-success">
          </div>
        </div>
      </form>
      <!-- /Form -->
      <div class="help-block visible-xs">&nbsp;</div>

      <!-- Result -->
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
        <h4 class="text-left">Hasil Tracking</h4>
        <div class="help-block">&nbsp;</div>

        <!-- The result table large -->
        <table class="table text-capitalize hidden-xs" style="table-layout:fixed">
          <thead>
            <tr>
              <th style="width:5%">No.</th>
              <th>No. Resi</th>
              <th>Kota Tujuan</th>
              <th>Alamat Tujuan</th>
              <th>Penerima</th>
              <th>Lokasi Terkini</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if ($trackingresult == false) {
            ?>
            <td colspan="7" class="text-center">Data tidak ditemukan</td>
            <?php
              } else {
                $i = 0;
                foreach ($trackingresult as $k => $v) {
                  foreach ($v as $value) {
                    $i++;
                    $no = $i;
                    if ($value['currentlocation'] == "0") {
                      $loc = "Penerima";
                    } else if ($value['currentlocation'] == "2") {
                      $loc = $value['origincity'] 
                      . " <br />(" 
                      . $value['meetingpoint']
                      . ") ";
                    } else if ($value['currentlocation'] == "3") {
                      $loc = $value['destinationcity']
                      . " <br />(" 
                      . $value['droppoint']
                      . ") ";
                    } else if ($value['currentlocation'] == "4") {
                      $loc = "Didalam kargo " + $value['idarmada'];
                    }

                    if ($value['shipmentstatus'] == "1") {
                      $status = "Manifested at the Meeting Point";
                    } else if ($value['shipmentstatus'] == "2") {
                      $status = "On-Process";
                    } else if ($value['shipmentstatus'] == "3") {
                      $status = "On-Transit";
                    } else if ($value['shipmentstatus'] == "4") {
                      $status = "Received on Drop Point";
                    } else if ($value['shipmentstatus'] == "5") {
                      $status = "Delivered to Recipient";
                    }

             ?>
            <tr>
              <th scope="row"><?php echo $no; ?></th>
              <td style="word-wrap:break-word">
                <a target="_blank" href="<?php echo site_url('User/showTrackingDetail/').$value['receiptnumber']; ?>">
                  <?php echo $value['receiptnumber']; ?>
                </a>
              </td>
              <td><?php echo $value['destinationcity']; ?></td>
              <td style="white-space:nowrap; overflow:hidden !important; text-overflow:ellipsis">
                <?php echo $value['recipientaddress']; ?>
              </td>
              <td><?php echo $value['recipientname']; ?></td>
              <td><?php echo $loc; ?></td>
              <td><?php echo $status; ?></td>
            </tr>
            <?php }}} ?>
          </tbody>
        </table>
        <!-- /The result table large -->

        <!-- The result table extra small -->
        <div class="col-xs-12 visible-xs">
          <table class="table text-capitalize" style="table-layout:fixed">
            <thead>
              <tr>
                <th>No.</th>
                <th>No. Resi</th>
                <th>Lokasi Terkini</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                if ($trackingresult == false) {
              ?>
              <td colspan="4" class="text-center">Data tidak ditemukan</td>
              <?php
                } else {
                  $i = 0;
                  foreach ($trackingresult as $k => $v) {
                    foreach ($v as $value) {
                      $i++;
                      $no = $i;
                      if ($value['currentlocation'] == "0") {
                        $loc = "Penerima";
                      } else if ($value['currentlocation'] == "2") {
                        $loc = $value['origincity'] 
                        . " <br />(" 
                        . $value['meetingpoint']
                        . ") ";
                      } else if ($value['currentlocation'] == "3") {
                        $loc = $value['destinationcity']
                        . " <br />(" 
                        . $value['droppoint']
                        . ") ";
                      } else if ($value['currentlocation'] == "4") {
                        $loc = "Didalam kargo " + $value['idarmada'];
                      }

                      if ($value['shipmentstatus'] == "1") {
                        $status = "Manifested at the Meeting Point";
                      } else if ($value['shipmentstatus'] == "2") {
                        $status = "On-Process";
                      } else if ($value['shipmentstatus'] == "3") {
                        $status = "On-Transit";
                      } else if ($value['shipmentstatus'] == "4") {
                        $status = "Received on Drop Point";
                      } else if ($value['shipmentstatus'] == "5") {
                        $status = "Delivered to Recipient";
                      }
                                          
               ?>
              <tr>
                <th scope="row">1</th>
                <td style="word-wrap:break-word"><a target="_blank" href="<?php echo site_url('User/showTrackingDetail/').$value['receiptnumber']; ?>">
                  <?php echo $value['receiptnumber']; ?>
                </a></td>
                <td><?php echo $loc; ?></td>
                <td><?php echo $status; ?></td>
              </tr>
              <?php }}} ?>
            </tbody>
          </table>
        </div>
        <!-- /The result table extra small -->
      </div>
      <!-- /Result -->

    </div>
    <!-- /Row form -->
  </div>