<?php
defined('BASEPATH') OR exit('No direct script access allowed');
setlocale(LC_TIME, 'Indonesian');
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

    <?php 
      $meetingpoint;
      $mpaddress;
      $droppoint;
      $dpaddress;
      foreach ($trackingdetail as $v) {
        $meetingpoint = $v['meetingpoint'];
        $mpaddress = $v['mpaddress'];
        $droppoint = $v['droppoint'];
        $dpaddress = $v['dpaddress'];
        $ts_tgl_pengiriman = strToTime($v['deliverydate']);
        $hari = strftime('%A', $ts_tgl_pengiriman);
        $tgl = strftime('%d', $ts_tgl_pengiriman);
        $bln = strftime('%B', $ts_tgl_pengiriman);
        $thn = strftime('%Y', $ts_tgl_pengiriman);
        $deliverydate = $hari . ", " . $tgl . " " . $bln . " " . $thn;
    ?>

    <!-- First table -->
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
        <h4>Hasil Tracking</h4>
        <table class="table table-bordered text-capitalize table-responsive">
          <thead style="background-color:#CCCCCC">
            <tr>
              <th>No. Resi</th>
              <th>Armada</th>
              <th>Tanggal Pengiriman</th>
              <th>Kota Asal</th>
              <th>Kota Tujuan</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $v['receiptnumber']; ?></td>
              <td>
                <?php echo $v['vehiclenumber'] 
                . "<br />" 
                . $v['drivername']; ?>
              </td>
              <td><?php echo $deliverydate; ?></td>
              <td>
                <?php echo $v['origincity'] 
                . " (" 
                . $v['departureidbranch']
                . ")"; ?>
              </td>
              <td>
                <?php echo $v['destinationcity'] 
                . " (" 
                . $v['arrivalidbranch']
                . ")"; ?>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /First table -->

    <!-- Second table -->
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
        <table class="table table-bordered text-capitalize" >
          <thead style="background-color:#CCCCCC">
            <tr>
              <th>Pengirim</th>
              <th>Penerima</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $v['sendername'] ?></td>
              <td rowspan="2"><?php echo $v['recipientname'] ?></td>
            </tr>
            <tr>
              <td>Shipping</td>
            </tr>
            <tr>
              <td><?php echo $v['senderaddress'] ?></td>
              <td><?php echo $v['recipientaddress'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /Second table -->

    <?php } ?>

    <!-- Third table -->
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
        <table class="table table-bordered text-capitalize" >
          <thead style="background-color:#CCCCCC">
            <tr>
              <th colspan="2" class="text-left">Riwayat Perjalanan</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              foreach ($shipmenthistory as $val) {

                $ts_shipment_history = strToTime($val['timeevent']);
                $sh_hari = strftime('%A', $ts_shipment_history);
                $sh_tgl = strftime('%d', $ts_shipment_history);
                $sh_bln = strftime('%B', $ts_shipment_history);
                $sh_thn = strftime('%Y', $ts_shipment_history);
                $sh_jam = strftime('%H', $ts_shipment_history);
                $sh_min = strftime('%M', $ts_shipment_history);
                $timeevent = $sh_hari 
                . ", " 
                . $sh_tgl 
                . " " 
                . $sh_bln 
                . " " 
                . $sh_thn
                . " "
                . $sh_jam
                . ":"
                . $sh_min;
                if ($val['shipmentstatus'] == "1") {
                  $status = "Manifested at the Meeting Point - <strong>" 
                  . $meetingpoint
                  . "</strong> ("
                  . $mpaddress
                  . ")";
                } else if ($val['shipmentstatus'] == "2") {
                  $status = "On-Process";
                } else if ($val['shipmentstatus'] == "3") {
                  $status = "On-Transit";
                } else if ($val['shipmentstatus'] == "4") {
                  $status = "Received on Drop Point - <strong>" 
                  . $droppoint
                  . "</strong> ("
                  . $dpaddress
                  . ")";
                } else if ($val['shipmentstatus'] == "5") {
                  $status = "Delivered to Recipient";
                }

            ?>
            <tr>
              <td><?php echo $timeevent; ?></td>
              <td><?php echo $status; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /Third table -->
</div>