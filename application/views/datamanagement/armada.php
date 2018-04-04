<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- ID Generator -->
  <script>
    $(document).ready(function() {
      var alamat = '<?php echo base_url("index.php/ControllerSystem/idGenerator/armada"); ?>';
      setInterval(function() {
        $.ajax({
          url: alamat,
          cache: false,
          success: function(result) {
            $('#add_armada #armada-id').val(result);
          }
        });
      }, 1000);
    });
  </script>

  <!-- Vehicle Type -->
  <script>
    $(document).ready(function () {
      $.ajax({
        url: "<?php echo site_url('Armada/showVehicleType'); ?>",
        cache: false,
        dataType: 'json',
        success: function (result) {
          $.each(result.vehicletype, function (k, v) {
            var option = document.createElement("option");
            option.text = v.type;
            option.value = v.idvehicletype;
            $('#vehicle-type').append(option);
          });
        }
      });
    });
  </script>

  <!-- Cargo Category -->
  <script>
    $(document).ready(function () {
      $.ajax({
        url: "<?php echo site_url('Armada/showCargoCategory'); ?>",
        cache: false,
        dataType: 'json',
        success: function (result) {
          $.each(result.cargocategory, function (k, v) {
            var option = document.createElement("option");
            option.text = v.category;
            option.value = v.idcargocategory;
            $('#cargo-category').append(option);
          });
        }
      });
    });
  </script>

  <!-- Branch Point -->
  <script>
    $(document).ready(function () {
      $.ajax({
        url: "<?php echo site_url('Armada/showBranchPoint'); ?>",
        cache: false,
        dataType: 'json',
        success: function (result) {
          $.each(result.branchpoint, function (k, v) {
            var option = document.createElement("option");
            option.text = v.branchname + " (" + v.idbranch + ")";
            option.value = v.idbranch;
            $('#departure-point, #arrival-point').append(option);
          });
        }
      });

      $('#departure-point, #arrival-point').change(function () {
        if ($('#departure-point').val() == $('#arrival-point').val()) {
          $('#point-msg-1, #point-msg-2').html("<strong><span class='glyphicon glyphicon-remove' style='color:red'></span>&nbsp;Lokasi berangkat dan tiba tidak boleh sama.</strong>");
        } else {
          $('#point-msg-1, #point-msg-2').empty();
        }
      });
    });
  </script>

  <!-- Check Departure & Arrival Time values -->
  <script>
    $(document).ready(function () {
      $('#departure-time, #arrival-time').change(function () {
        if ($('#departure-time').val() == $('#arrival-time').val()) {
          $('#time-msg-1, #time-msg-2').html("<strong><span class='glyphicon glyphicon-remove' style='color:red'></span>&nbsp;Jam berangkat dan tiba tidak boleh sama.</strong>");
        } else {
          $('#time-msg-1, #time-msg-2').empty();
        }
      });
    });
  </script>

  <!-- Armada detail -->
  <script>
    $(document).on('click', '.detail-button', function() {
      var idarmada = $(this).data('id');

      $('#detail #route-detail').empty();
      $('#detail #cargo-category').empty();

      $.ajax({
        url: "<?php echo site_url('Armada/showArmadaDetail/"+idarmada+"'); ?>",
        cache: false,
        dataType: 'json',
        success: function (result) {
          $.each(result.armadadetail, function(k, v) {
             $('#detail #armada-id').html(v.idarmada);
             $('#detail #vehicle-number').html(v.vehiclenumber);
             $('#detail #driver-name').html(v.drivername);
             $('#detail #armada-phone').html(v.armadaphone);
             $('#detail #vehicle-type').html(v.type);
             $('#detail #cargo-category').html(v.idcargocategory);
             $('#detail #max-weight').html(v.maxweight + " Kg.");
             $('#detail #max-length').html(v.maxlengthdimension + " m.");
             $('#detail #max-width').html(v.maxwidthdimension + " m.");
             $('#detail #max-height').html(v.maxheightdimension + " m.");
          });

          $.each(result.armadacargo, function(k, v) {
             $('#detail #cargo-category').append("<td>"+v.category+"</td>")
          });

          $.each(result.armadaroute, function(k, v) {
            // console.log(v);
            var arrivaltime = v.arrivaltime;
            nat = arrivaltime.substring(0, 5);
            var departuretime = v.departuretime;
            ndt = departuretime.substring(0, 5);

             $('#detail #route-detail').append("<tr><td rowspan='2'>" + v.departureday+ "<br />" + ndt + "</td><td>"+v.meetingpoint+"</td><td rowspan='2'>" + v.departureday + "<br />" + nat + "</td><td>" + v.droppoint + "</td></tr><tr><td>" + v.mpaddress + "</td><td>" + v.dpaddress + "</td></tr>");
          });
        }
      });
    });
  </script>

  <!-- page content -->
  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <ol class="breadcrumb">
      <li><a href="employees.php">Employees</a></li>
      <li><a href="armada.php">Armada</a></li>
    </ol>
    <h2 class="sub-header">Armada
    <a data-toggle="modal" href="#add_armada" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Armada</a>
    </h2>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Vehicle Number</th>
            <th>Driver Name</th>
            <th>Armada Phone</th>
            <th>Armada Detail</th>
            <th>Status</th>
            <th><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if ($allarmada == false) {
          ?>
            <tr><td colspan="7" class="text-center">Data Armada belum terisi</td></tr>
          <?php
            } else {
              foreach ($allarmada as $v) { 
          ?>
            <tr>
              <td><?php echo $v['idarmada'] ?></td>
              <td><?php echo $v['vehiclenumber'] ?></td>
              <td><?php echo $v['drivername'] ?></td>
              <td><?php echo $v['armadaphone'] ?></td>
              <td><a data-toggle="modal" href="#detail" class="btn btn-xs btn-info detail-button" data-id="<?php echo $v['idarmada'] ?>">Detail</a></td>
              <td>
                <?php if ($v['armadastatus'] == '0'): ?>
                <button type="submit" class="btn btn-xs btn-default">Inactive</button>
                <?php elseif ($v['armadastatus'] == '1'): ?>
                <button type="submit" class="btn btn-xs btn-success">Active</button>
                <?php elseif ($v['armadastatus'] == '2'): ?>
                <button type="submit" class="btn btn-xs btn-warning">On Vacation</button>
                <?php elseif ($v['armadastatus'] == '3'): ?>
                <button type="submit" class="btn btn-xs btn-danger">Banned</button>
                <?php endif; ?>
              </td>
              <td>
                <a href="#edit_armada" data-toggle="modal" class="btn btn-primary btn-xs edit-button" data-id="<?php echo $v['idarmada'] ?>">
                  <span class="glyphicon glyphicon-pencil"></span>
                </a>
                &nbsp;
                <a onclick="return confirm('Hapus data?')" class="btn btn-danger btn-xs" href="<?php echo site_url('Armada/deleteArmada/').$v['idarmada']; ?>">
                  <span class="glyphicon glyphicon-trash"></span>
                </a>
              </td>
            </tr>
          <?php }} ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- /page content -->

  </div>
  </div>
  <!-- /Container -->

  <!-- Modal -->
  <!-- Modal Detail -->
  <div class="modal fade" id="detail" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4><strong>Detail Armada</strong></h4>
        </div>
        <div class="modal-body">
          <table style="margin:0px 10px 0px 10px;">
            <tr>
              <td>ID</td>
              <td>:&nbsp;</td>
              <td id="armada-id"></td>
            </tr>
            <tr>
              <td>Vehicle Number</td>
              <td>:&nbsp;</td>
              <td id="vehicle-number"></td>
            </tr>
            <tr>
              <td>Driver Name</td>
              <td>:&nbsp;</td>
              <td id="driver-name"></td>
            </tr>
            <tr>
              <td>Armada Phone</td>
              <td>:&nbsp;</td>
              <td id="armada-phone"></td>
            </tr>
            <tr>
              <td>Vehicle Type</td>
              <td>:&nbsp;</td>
              <td id="vehicle-type"></td>
            </tr>
            <tr>
              <td>Max Weight</td>
              <td>:&nbsp;</td>
              <td id="max-weight"></td>
            </tr>
            <tr>
              <td>Max Length Dimension</td>
              <td>:&nbsp;</td>
              <td id="max-length"></td>
            </tr>
            <tr>
              <td>Max Width Dimension</td>
              <td>:&nbsp;</td>
              <td id="max-width"></td>
            </tr>
            <tr>
              <td>Max Height Dimension</td>
              <td>:&nbsp;</td>
              <td id="max-height"></td>
            </tr>
          </table>
          <div class="help-block">&nbsp;</div>
          <h4>Jenis Muatan</h4>
          <table class="table">
            <thead>
              <tr id="cargo-category">
                <!-- Filled by jQuery -->
              </tr>
            </thead>
          </table>
          <div class="help-block">&nbsp;</div>
          <h4>Rute Armada</h4>
          <table class="table">
            <thead>
              <tr>
                <th><span class="glyphicon glyphicon-time"></span></th>
                <th>Kota Asal</th>
                <th><span class="glyphicon glyphicon-time"></span></th>
                <th>Kota Tujuan</th>
              </tr>
            </thead>
            <tbody id="route-detail">
              <!-- Filled by jQuery -->
            </tbody>
          </table>
        </div>
        <div class="modal-footer"></div>
      </div>
    </div>
  </div>
  <!-- /Modal Detail -->

  <!-- Modal Add -->
  <div class="modal fade" id="add_armada" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Add Armada</h4>
        </div>
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('Armada/insertArmada'); ?>" method="POST">
          <div class="modal-body">
            <div class="row">
              <div class="col-xs-10 col-sm-9 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
                <div class="form-group">
                  <label for="vehicle-number" style="font-size:0.8em">Nomor Polisi Kendaraan</label>
                  <div class="input-group">
                    <input type="hidden" name="idarmada" id="armada-id" class="form-control">
                    <input type="text" name="vehiclenumber" id="vehicle-number" required="required" class="form-control" />
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="driver-name" style="font-size:0.8em">Nama Supir</label>
                  <div class="input-group">
                    <input type="text" name="drivername" id="driver-name" required="required" class="form-control" />
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="armada-phone" style="font-size:0.8em">Nomor Telepon Supir</label>
                  <div class="input-group">
                    <input type="tel" name="armadaphone" id="armada-phone" required="required" class="form-control" />
                    <div class="input-group-addon">*</div>
                  </div>
                  <em style="font-size:0.8em">contoh: 081234******</em>
                </div>
                <div class="form-group">
                  <label for="max-weight" style="font-size:0.8em">Kapasitas Berat Maksimal</label>
                  <div class="input-group">
                    <input type="text" name="maxweight" id="max-weight" required="required" class="form-control" />
                    <div class="input-group-addon">*</div>
                  </div>
                  <em style="font-size:0.8em">Dalam Kilogram</em>
                </div>
                <div class="form-group">
                  <label for="max-length" style="font-size:0.8em">Panjang Barang Maksimal</label>
                  <div class="input-group">
                    <input type="text" name="maxlength" id="max-length" required="required" class="form-control" />
                    <div class="input-group-addon">*</div>
                  </div>
                  <em style="font-size:0.8em">Dalam meter</em>
                </div>
                <div class="form-group">
                  <label for="max-width" style="font-size:0.8em">Lebar Barang Maksimal</label>
                  <div class="input-group">
                    <input type="text" name="maxwidth" id="max-width" required="required" class="form-control" />
                    <div class="input-group-addon">*</div>
                  </div>
                  <em style="font-size:0.8em">Dalam meter</em>
                </div>
                <div class="form-group">
                  <label for="max-height" style="font-size:0.8em">Tinggi Barang Maksimal</label>
                  <div class="input-group">
                    <input type="text" name="maxheight" id="max-height" required="required" class="form-control" />
                    <div class="input-group-addon">*</div>
                  </div>
                  <em style="font-size:0.8em">Dalam meter</em>
                </div>
                <div class="form-group">
                  <label for="vehicle-type" style="font-size:0.8em">Jenis Kendaraan</label>
                  <div class="input-group">
                    <select name="idvehicletype" id="vehicle-type" class="form-control">
                      <option value="">Pilih Jenis Kendaraan</option>
                      <!-- Filled by jQuery -->
                    </select>
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="cargo-category" style="font-size:0.8em">Kategori Muatan</label>
                  <div class="input-group">
                    <select name="idcargocategory" id="cargo-category" class="form-control">
                      <option value="">Pilih Kategori Muatan</option>
                      <!-- Filled by jQuery -->
                    </select>
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="departure-point" style="font-size:0.8em">Lokasi Keberangkatan</label>
                  <div class="input-group">
                    <select name="departureidbranch" id="departure-point" class="form-control">
                      <option value="">Pilih Lokasi Keberangkatan</option>
                      <!-- Filled by jQuery -->
                    </select>
                    <div class="input-group-addon">*</div>
                  </div>
                  <em id="point-msg-1" class="pull-right" style="font-size:0.8em"></em>
                </div>
                <div class="form-group">
                  <label for="arrival-point" style="font-size:0.8em">Lokasi Kedatangan</label>
                  <div class="input-group">
                    <select name="arrivalidbranch" id="arrival-point" class="form-control">
                      <option value="">Pilih Lokasi Kedatangan</option>
                      <!-- Filled by jQuery -->
                    </select>
                    <div class="input-group-addon">*</div>
                  </div>
                  <em id="point-msg-2" class="pull-right" style="font-size:0.8em"></em>
                </div>
                <div class="form-group">
                  <label for="departure-day" style="font-size:0.8em">Hari Keberangkatan</label>
                  <div class="input-group">
                    <select name="departureday" id="departure-day" class="form-control">
                      <option value="Senin">Senin</option>
                      <option value="Selasa">Selasa</option>
                      <option value="Rabu">Rabu</option>
                      <option value="Kamis">Kamis</option>
                      <option value="Jumat">Jumat</option>
                      <option value="Sabtu">Sabtu</option>
                      <option value="Minggu">Minggu</option>
                    </select>
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="departure-time" style="font-size:0.8em">Jam Keberangkatan</label>
                  <div class="input-group">
                    <input type="time" name="departuretime" id="departure-time" class="form-control">
                    <div class="input-group-addon">*</div>
                  </div>
                  <em id="time-msg-1" class="pull-right" style="font-size:0.8em"></em>
                </div>
                <div class="form-group">
                  <label for="arrival-day" style="font-size:0.8em">Hari Kedatangan</label>
                  <div class="input-group">
                    <select name="arrivalday" id="arrival-day" class="form-control">
                      <option value="Senin">Senin</option>
                      <option value="Selasa">Selasa</option>
                      <option value="Rabu">Rabu</option>
                      <option value="Kamis">Kamis</option>
                      <option value="Jumat">Jumat</option>
                      <option value="Sabtu">Sabtu</option>
                      <option value="Minggu">Minggu</option>
                    </select>
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="arrival-time" style="font-size:0.8em">Jam Kedatangan</label>
                  <div class="input-group">
                    <input type="time" name="arrivaltime" id="arrival-time" class="form-control" />
                    <div class="input-group-addon">*</div>
                  </div>
                  <em id="time-msg-2" class="pull-right" style="font-size:0.8em"></em>
                </div>
                <div class="form-group">
                  <label for="fare-per-kilos" style="font-size:0.8em">Tarif per Kilogram</label>
                  <div class="input-group">
                    <div class="input-group-addon">Rp</div>
                    <input type="text" name="fareperkilos" id="fare-per-kilos" class="form-control" />
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="fare-per-dimension" style="font-size:0.8em">Tarif per Meter<sup>3</sup></label>
                  <div class="input-group">
                    <div class="input-group-addon">Rp</div>
                    <input type="text" name="fareperdimension" id="fare-per-dimension" class="form-control" />
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Cancel</button>&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /Modal Add -->

  <!-- Modal Edit -->
  <div class="modal fade" id="edit_armada" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Edit  Armada</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-xs-10 col-sm-9 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
              <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group">
                  <div class="input-group">
                    <label for="nopol" class="sr-only">Nomor Polisi Kendaraan</label>
                    <input type="text" id="nopol" required="required" class="form-control" placeholder="Nomor Polisi Kendaraan" />
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <label for="namasupir" class="sr-only">Nama Supir</label>
                    <input type="text" id="namasupir" required="required" class="form-control" placeholder="Nama Supir" />
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <label for="notelpsupir" class="sr-only">Nomor Telepon Supir</label>
                    <input type="tel" id="notelpsupir" required="required" class="form-control" placeholder="Nomor Telepon Supir" />
                    <div class="input-group-addon">*</div>
                  </div>
                  <em style="font-size:0.8em">contoh: 081234******</em>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <label for="beratmaksimal" class="sr-only">Kapasitas Berat Maksimal</label>
                    <input type="text" id="beratmaksimal" required="required" class="form-control" placeholder="Kapasitas Berat Maksimal" />
                    <div class="input-group-addon">*</div>
                  </div>
                  <em style="font-size:0.8em">Dalam Kilogram</em>
                </div>
                <div class="form-group">
                  <label for="panjangmaksimal" class="sr-only">Panjang Barang Maksimal</label>
                  <input type="text" id="panjangmaksimal" required="required" class="form-control" placeholder="p" />
                  <em style="font-size:0.8em">Dalam meter</em>
                </div>
                <div class="form-group">
                  <label for="lebarmaksimal" class="sr-only">Lebar Barang Maksimal</label>
                  <input type="text" id="lebarmaksimal" required="required" class="form-control" placeholder="l" />
                  <em style="font-size:0.8em">Dalam meter</em>
                </div>
                <div class="form-group">
                  <label for="tinggimaksimal" class="sr-only">Tinggi Barang Maksimal</label>
                  <input type="text" id="tinggimaksimal" required="required" class="form-control" placeholder="t" />
                  <em style="font-size:0.8em">Dalam meter</em>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <label for="jeniskendaraan" class="sr-only">Jenis Kendaraan</label>
                    <select name="" id="jeniskendaraan" class="form-control">
                      <option value="">Sedan</option>
                      <option value="">Mobil Box</option>
                      <option value="">Truk</option>
                    </select>
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <label for="kategorimuatan" class="sr-only">Kategori Muatan</label>
                    <select name="" id="kategorimuatan" class="form-control">
                      <option value="">Elektronik</option>
                      <option value="">Barang Pecah Belah</option>
                      <option value="">Bahan Kimia</option>
                      <option value="">Biasa</option>
                    </select>
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="lokasikeberangkatan">Lokasi Keberangkatan</label>
                  <div class="input-group">
                    <select name="" id="lokasikeberangkatan" class="form-control">
                      <option value="">Bandung (BDG1) - Jalan Gegerkalong Hilir No. 47</option>
                      <option value="">Bandung (BDG2) - Jalan Sukajadi No. 77</option>
                    </select>
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="lokasikedatangan">Lokasi Kedatangan</label>
                  <div class="input-group">
                    <select name="" id="lokasikedatangan" class="form-control">
                      <option value="">Jakarta Timur (JTM1) - Jalan Perikani Raya 1C</option>
                      <option value="">Jakarta Barat (JTM2) - Jalan Perikani Raya No. 20</option>
                    </select>
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="harikeberangkatan">Hari Keberangkatan</label>
                  <div class="input-group">
                    <select name="" id="harikeberangkatan" class="form-control">
                      <option value="">Senin</option>
                      <option value="">Selasa</option>
                      <option value="">Rabu</option>
                      <option value="">Kamis</option>
                      <option value="">Jumat</option>
                      <option value="">Sabtu</option>
                      <option value="">Minggu</option>
                    </select>
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="jamkeberangkatan">Jam Keberangkatan</label>
                  <div class="input-group">
                    <input type="time" name="" id="jamkeberangkatan" class="form-control">
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="harikedatangan">Hari Kedatangan</label>
                  <div class="input-group">
                    <select name="" id="harikedatangan" class="form-control">
                      <option value="">Senin</option>
                      <option value="">Selasa</option>
                      <option value="">Rabu</option>
                      <option value="">Kamis</option>
                      <option value="">Jumat</option>
                      <option value="">Sabtu</option>
                      <option value="">Minggu</option>
                    </select>
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="jamkedatangan">Jam Kedeatangan</label>
                  <div class="input-group">
                    <input type="time" name="" id="jamkedatangan" class="form-control">
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <label for="armada-status" class="sr-only">Status</label>
                    <select name="" id="armada-status" class="form-control">
                      <option value="">Inactive</option>
                      <option value="">Active</option>
                      <option value="">On-Vacation</option>
                      <option value="">Banned</option>
                      <option value="">Rejected</option>
                      <option value="">Deleted</option>
                    </select>
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Cancel</button>&nbsp;&nbsp;&nbsp;
          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Save</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /Modal Edit -->
  <!-- /Modal -->

