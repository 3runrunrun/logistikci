<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- ID Generator -->
  <script>
    $(document).ready(function() {
      var alamat = '<?php echo base_url("index.php/ControllerSystem/idGenerator/courier"); ?>';
      setInterval(function() {
        $.ajax({
          url: alamat,
          cache: false,
          success: function(result) {
            $('#add_courier #courier-id').val(result);
          }
        });
      }, 1000);
    });
  </script>

  <!-- Email Avaibility -->
  <script>
    $(document).ready(function() {
      $('#add_courier  #courier-mail').focusout(function() {
        var nilai = $('#add_courier #courier-mail').val();
        var berkas = "<?php echo base_url('index.php/ControllerSystem/emailAvailibility/'); ?>";
        $.ajax({
          url: berkas,
          type: 'POST',
          data: {
            "nilai": nilai
          },
          cache: false,
          success: function(result) {
            if ($('#add_courier #courier-mail').val() == "") {
              $('#add_courier #courier-mail-div').removeClass('has-success');
              $('#add_courier #courier-mail-div').addClass('has-error');
              $('#add_courier #email-msg').html('<span class="glyphicon glyphicon-remove" style="color:red"></span>&nbsp;<strong>Kolom email wajib diisi.</strong>');
            } else {
              if (result == "false") {
                $('#add_courier #courier-mail-div').removeClass('has-success');
                $('#add_courier #courier-mail-div').addClass('has-error');
                $('#add_courier #email-msg').html('<span class="glyphicon glyphicon-remove" style="color:red"></span>&nbsp;<strong>Email sudah digunakan.</strong>');
              } else {
                $('#add_courier #courier-mail-div').removeClass('has-error');
                $('#add_courier #courier-mail-div').addClass('has-success');
                $('#add_courier #email-msg').html('<span class="glyphicon glyphicon-ok" style="color:green"></span>&nbsp;<strong>Email tersedia.</strong>');
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
      $('#add_courier #courier-pwd-one, #add_courier #courier-pwd-two').focusout(function() {
        var charlength = $('#add_courier #courier-pwd-one').val().length;
        var pwdvaluea = $('#add_courier #courier-pwd-one').val();
        var pwdvalueb = $('#add_courier #courier-pwd-two').val();
        if (charlength < 6) {
          $('#add_courier #pwd-one, #pwd-two').removeClass('has-success');
          $('#add_courier #pwd-one, #pwd-two').addClass('has-error');
          $('#add_courier #pwd-one-msg, #pwd-two-msg').html('<span class="glyphicon glyphicon-remove" style="color:red"></span>&nbsp;<strong>Minimal 6 karakter</strong>');
        } else {
          $('#add_courier #pwd-one').removeClass('has-error');
          $('#add_courier #pwd-one').addClass('has-success');
          $('#add_courier #pwd-one-msg').html('<span class="glyphicon glyphicon-ok" style="color:green"></span>&nbsp;');
          if (pwdvaluea != pwdvalueb) {
            $('#add_courier #sign-up').attr('disabled', 'disabled');
            $('#add_courier #pwd-two-msg').html('<span class="glyphicon glyphicon-remove" style="color:red"></span>&nbsp;<strong>Kata sandi tidak sesuai</strong>');
          } else {
            $('#add_courier #pwd-two').removeClass('has-error');
            $('#add_courier #pwd-two').addClass('has-success');
            $('#add_courier #pwd-two-msg').html('<span class="glyphicon glyphicon-ok" style="color:green"></span>&nbsp;');
            isTrue = true;
            $('#add_courier #sign-up').removeAttr('disabled');
          }
        }
      });
    });
  </script>

  <!-- Show Courier detail -->
  <script>
    $(document).on('click', '.detail-button', function () {
      var idcourier = $(this).data('id');
      $.ajax({
        url: "<?php echo site_url('Courier/showCourierDetail/"+idcourier+"'); ?>",
        dataType: 'json',
        cache: false,
        success: function (result) {
          $.each(result.courierdetail, function(k, v) {
            $('#courier-detail #courier-id').html(v.idcourier);
            $('#courier-detail #courier-name').html(v.couriername);
            $('#courier-detail #courier-email').html(v.courieremail);
            $('#courier-detail #courier-address').html(v.courieraddress);
            $('#courier-detail #courier-phone').html(v.courierphone);
            $('#courier-detail #owner-id').html(v.idowner);
            $('#courier-detail #owner-name').html(v.ownername);
            $('#courier-detail #owner-address').html(v.owneraddress);
            $('#courier-detail #owner-phone').html(v.ownerphone);
          });
        }
      })
    });
  </script>

  <!-- Show Courier detail into modal -->
  <script>
    $(document).on('click', '.edit-button', function () {
      var idcourier = $(this).data('id');
      $.ajax({
        url: "<?php echo site_url('Courier/showCourierDetail/"+idcourier+"'); ?>",
        cache: false,
        dataType: 'json',
        success: function (result) {
          $.each(result.courierdetail, function(k, v) {
            $('#edit_courier #courier-id').val(v.idcourier);
            $('#edit_courier #courier-name').val(v.couriername);
            $('#edit_courier #courier-address').val(v.courieraddress);
            $('#edit_courier #courier-phone').val(v.courierphone);
            $('#edit_courier #courier-email').val(v.courieremail);
            $('#edit_courier #owner-id').val(v.idowner);
            $('#edit_courier #owner-name').val(v.ownername);
            $('#edit_courier #owner-address').val(v.owneraddress);
            $('#edit_courier #owner-phone').val(v.ownerphone);
            $('#edit_courier #owner-email').val(v.owneremail);
          });
        }
      })
    });
  </script>

  <!-- page content -->
  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <ol class="breadcrumb">
      <li><a href="#">Data Management</a></li>
      <li><a href="#">Courier</a></li>
    </ol>

    <h2 class="sub-header">Courier&nbsp;
      <a data-toggle="modal" href="#add_courier" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Courier</a>
    </h2>

    <div class="table table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Detail</th>
            <th>Status</th>
            <th>
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if ($allcourier == false) {
          ?> 
            <tr>
              <td colspan='8' class='text-center'>Data Kurir belum terisi</td>
            </tr>
          <?php
            } else {
              foreach ($allcourier as $v) { 
          ?>
            <tr>
              <td><?php echo $v['idcourier'] ?></td>
              <td><?php echo $v['couriername'] ?></td>
              <td><?php echo $v['courieremail'] ?></td>
              <td><?php echo $v['courieraddress'] ?></td>
              <td><?php echo $v['courierphone'] ?></td>
              <td>
                <a data-toggle="modal" href="#courier-detail" class="btn btn-xs btn-info detail-button" data-id="<?php echo $v['idcourier'] ?>">Detail</a>
              </td>
              <td>
                <?php if ($v['courierstatus'] == '0'): ?>
                  <button type="submit" class="btn btn-xs btn-default">Inactive</button>
                <?php elseif ($v['courierstatus'] == '1'): ?>
                  <button type="submit" class="btn btn-xs btn-success">Active</button>
                <?php elseif ($v['courierstatus'] == '2'): ?>
                  <button type="submit" class="btn btn-xs btn-warning">On Vacation</button>
                <?php elseif ($v['courierstatus'] == '3'): ?>
                  <button type="submit" class="btn btn-xs btn-danger">Banned</button>
                <?php endif; ?>
              </td>
              <td>
                <a href="#edit_courier" data-toggle="modal" class="edit-button btn btn-xs btn-primary" data-id="<?php echo $v['idcourier'] ?>" >
                  <span class="glyphicon glyphicon-pencil"></span>
                </a>
                &nbsp;
                <a onclick="return confirm('Hapus data?')" class="btn btn-xs btn-danger" href="<?php echo site_url('Courier/deleteCourier/').$v['idcourier']; ?>">
                  <span class="glyphicon glyphicon-trash"></span>
                </a>
              </td>
            </tr>
          <?php }} ?>
        </tbody>
      </table>
    </div>
  </div>

  </div>
  </div>

  <!-- modal -->

  <!-- modal detail -->
  <div class="modal fade" id="courier-detail" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4><strong>Courier Detail</strong></h4>
        </div>
        <div class="modal-body">
          <table>
            <tr>
              <td>ID Kurir</td>
              <td>:&nbsp;</td>
              <td id="courier-id"></td>
            </tr>
            <tr>
              <td>Nama Kurir</td>
              <td>:&nbsp;</td>
              <td id="courier-name"></td>
            </tr>
            <tr>
              <td>Email Kurir</td>
              <td>:&nbsp;</td>
              <td id="courier-email"></td>
            </tr>
            <tr>
              <td>Alamat Kurir</td>
              <td>:&nbsp;</td>
              <td id="courier-address"></td>
            </tr>
            <tr>
              <td>No. Telepon Kurir</td>
              <td>:&nbsp;</td>
              <td id="courier-phone"></td>
            </tr>
            <tr>
              <td>ID</td>
              <td>:&nbsp;</td>
              <td id="owner-id"></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>:&nbsp;</td>
              <td id="owner-name"></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:&nbsp;</td>
              <td id="owner-address"></td>
            </tr>
            <tr>
              <td>No. Telepon</td>
              <td>:&nbsp;</td>
              <td id="owner-phone"></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer"></div>
      </div>
    </div>
  </div>  
  <!-- /modal detail -->

  <!-- modal add -->
  <div class="modal fade" id="add_courier" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Add Courier</h4>
        </div>
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo base_url('index.php/user/insertCourier'); ?>" method="POST">
          <div class="modal-body">
           <div class="row">
             <div class="col-xs-10 col-sm-9 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
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
                <div class="form-group">
                  <div class="input-group">
                    <label for="owner-name" class="sr-only">Penanggung Jawab Kurir</label>
                    <input type="text" id="owner-name" required="required" class="form-control" placeholder="Penanggung Jawab Kurir">
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <label for="owner-address" class="sr-only">Alamat Penanggung Jawab</label>
                    <input type="text" id="owner-address" required="required" class="form-control" placeholder="Alamat Penanggung Jawab">
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <label for="owner-phone" class="sr-only">No. Telp Penanggung Jawab</label>
                    <input type="tel" id="owner-phone" required="required" class="form-control" placeholder="No. Telp Penanggung Jawab">
                    <div class="input-group-addon">*</div>
                  </div>
                  <em style="font-size:0.8em">Contoh: 0812xxxx</em>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <label for="owner-email" class="sr-only">Email Penanggung Jawab</label>
                    <input type="email" id="owner-email" required="required" class="form-control" placeholder="Email Penanggung Jawab">
                    <div class="input-group-addon">*</div>
                  </div>
                  <em style="font-size:0.8em">Contoh: nama@mail.com</em>
                </div>
            </div>
           </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Cancel</button>&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add</button>
          </div>
        </form>    
      </div>
    </div>
  </div>
  <!-- /modal add -->

  <!-- modal edit  -->
  <div class="modal fade" id="edit_courier" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-header">
          <h4>Edit Courier</h4>
        </div>
        
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('Courier/editCourierAndOwner'); ?>" method="POST">
          <div class="modal-body">
            <div class="row">
              <div class="col-xs-10 col-sm-9 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">

                  <div class="form-group">
                    <label for="courier-id" style="font-size:0.8em">ID Kurir</label>
                    <div class="input-group">
                      <input type="text" name="idcourier" id="courier-id" required="required" class="form-control" readonly />
                      <div class="input-group-addon">*</div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="courier-name" style="font-size:0.8em">Nama Kurir</label>
                    <div class="input-group">
                      <input type="text" name="couriername" id="courier-name" required="required" class="form-control" />
                      <div class="input-group-addon">*</div>
                    </div>
                  </div>
              
                  <div class="form-group">
                    <label for="courier-address" style="font-size:0.8em">Alamat Kurir</label>
                    <div class="input-group">
                      <input type="text" name="courieraddress" id="courier-address" required="required" class="form-control"/>
                      <div class="input-group-addon">*</div>
                    </div>
                  </div>
              
                  <div class="form-group">
                    <label for="courier-phone" style="font-size:0.8em">No. Telp Kurir</label>
                    <div class="input-group">
                      <input type="tel" name="courierphone" id="courier-phone" required="required" class="form-control"/>
                      <div class="input-group-addon">*</div>
                    </div>
                    <em style="font-size:0.8em">Contoh: 081xxxx</em>
                  </div>
              
                  <div class="form-group">
                    <label for="courier-email" style="font-size:0.8em">Email Kurir</label>
                    <div class="input-group">
                      <input type="email" name="courieremail" id="courier-email" required="required" class="form-control" readonly />
                      <div class="input-group-addon">*</div>
                    </div>
                    <em style="font-size:0.8em">Contoh: name@email.com</em>
                  </div>
              
                  <div class="form-group">
                    <label for="owner-id" style="font-size:0.8em">No. Identitas Penanggung Jawab</label>
                    <div class="input-group">
                      <input type="text" name="idowner" id="owner-id" required="required" class="form-control" readonly />
                      <div class="input-group-addon">*</div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="owner-name" style="font-size:0.8em">Penanggung Jawab Kurir</label>
                    <div class="input-group">
                      <input type="text" name="ownername" id="owner-name" required="required" class="form-control" />
                      <div class="input-group-addon">*</div>
                    </div>
                  </div>
              
                  <div class="form-group">
                    <label for="owner-address" style="font-size:0.8em">Alamat Penanggung Jawab</label>
                    <div class="input-group">
                      <input type="text" name="owneraddress" id="owner-address" required="required" class="form-control" />
                      <div class="input-group-addon">*</div>
                    </div>
                  </div>
              
                  <div class="form-group">
                    <label for="owner-phone" style="font-size:0.8em">No. Telp Penanggung Jawab</label>
                    <div class="input-group">
                      <input type="tel" name="ownerphone" id="owner-phone" required="required" class="form-control" />
                      <div class="input-group-addon">*</div>
                    </div>
                    <em style="font-size:0.8em">Contoh: 081xxxx</em>
                  </div>
              
                  <div class="form-group">
                    <label for="owner-email" style="font-size:0.8em">Email Penanggung Jawab</label>
                    <div class="input-group">
                      <input type="email" name="owneremail" id="owner-email" required="required" class="form-control" readonly />
                      <div class="input-group-addon">*</div>
                    </div>
                    <em style="font-size:0.8em">contoh: name@email.com</em>
                  </div>
              
                  <div class="form-group">
                    <label for="courier-status" style="font-size:0.8em">Status</label>
                    <div class="input-group">
                      <select name="courierstatus" id="courier-status" class="form-control">
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                        <option value="2">On-Vacation</option>
                        <option value="3">Banned</option>
                        <option value="4">Rejected</option>
                        <option value="5">Deleted</option>
                      </select>
                      <div class="input-group-addon">*</div>
                    </div>
                  </div>
              
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Cancel</button>&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /modal edit -->

  <!-- /modal -->
