<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <!-- ID Generator -->
  <script>
  $(document).ready(function() {
    var alamat = '<?php echo base_url("index.php/ControllerSystem/idGenerator/agent"); ?>';
    setInterval(function() {
      $.ajax({
        url: alamat,
        cache: false,
        success: function(result) {
          $('#add_agent #agent-id').val(result);
        }
      });
    }, 1000);
  });
  </script>

  <script>
  $(document).ready(function() {
    var alamat = '<?php echo base_url("index.php/ControllerSystem/idGenerator/insurer"); ?>';
    setInterval(function() {
      $.ajax({
        url: alamat,
        cache: false,
        success: function(result) {
          $('#add_agent #insurer-id').val(result);
        }
      });
    }, 1000);
  });
  </script>

  <script>
    $(document).ready(function () {
      $.ajax({
        url: "<?php echo site_url('ControllerSystem/showAllBranch'); ?>",
        cache: false,
        dataType: 'json',
        success: function (result) {
          $.each(result.branch, function (k, v) {
            // console.log(k, v);
            var option = document.createElement("option");
            option.text = v.branchname + " (" + v.idbranch + ")";
            option.value = v.idbranch;
            $('#branch-id').append(option);
          })
        }
      });
    });
  </script>

  <!-- Email Avaibility -->
  <script>
    $(document).ready(function() {
      $('#add_agent #agent-email').focusout(function() {
        var nilai = $('#add_agent #agent-email').val();
        var berkas = "<?php echo base_url('index.php/ControllerSystem/emailAvailibility/'); ?>";
        $.ajax({
          url: berkas,
          type: 'POST',
          data: {
            "nilai": nilai
          },
          cache: false,
          success: function(result) {
            if ($('#add_agent #agent-email').val() == "") {
              $('#add_agent #agent-email-div').removeClass('has-success');
              $('#add_agent #agent-email-div').addClass('has-error');
              $('#add_agent #email-msg').html('<span class="glyphicon glyphicon-remove" style="color:red"></span>&nbsp;<strong>Kolom email wajib diisi.</strong>');
            } else {
              if (result == "false") {
                $('#add_agent #agent-email-div').removeClass('has-success');
                $('#add_agent #agent-email-div').addClass('has-error');
                $('#add_agent #email-msg').html('<span class="glyphicon glyphicon-remove" style="color:red"></span>&nbsp;<strong>Email sudah digunakan.</strong>');
              } else {
                $('#add_agent #agent-email-div').removeClass('has-error');
                $('#add_agent #agent-email-div').addClass('has-success');
                $('#add_agent #email-msg').html('<span class="glyphicon glyphicon-ok" style="color:green"></span>&nbsp;<strong>Email tersedia.</strong>');
              }
            }
          }
        });
      });
    });
  </script>

  <script>
    $(document).on('click', '.edit-button', function () {
      var idagent = $(this).data('id');
      // console.log(idagent);
      $.ajax({
          url: "<?php echo site_url('Agent/showAgentDetail/"+idagent+"') ?>",
          dataType: 'json',
          cache: false,
          success: function (result) {
            // console.log(result);
            $.each(result.agentdetail, function(k, v) {
              if (v.agentgender == 'f') {
                $('#edit_agent #female').prop('checked', true);
              } else {
                $('#edit_agent #male').prop('checked', true);
              }

               $('#edit_agent #agent-id').val(v.idagent);
               $('#edit_agent #agent-name').val(v.agentname);
               $('#edit_agent #agent-email').val(v.agentemail);
               $('#edit_agent #agent-idnumb').val(v.agentidentitynumber);
               $('#edit_agent #agent-phone').val(v.agentphone);
               $('#edit_agent #agent-address').val(v.agentaddress);
               $('#edit_agent #agent-bdate').val(v.agentbirthdate);
               $('#edit_agent #insurer-id').val(v.idinsurer);
               $('#edit_agent #insurer-name').val(v.insurername);
               $('#edit_agent #insurer-address').val(v.insureraddress);
               $('#edit_agent #insurer-phone').val(v.insurerphone);

              if (v.insurerstatusagent == '0') {
                $('#edit_agent #suami').prop('checked', true);
              } else if (v.insurerstatusagent == '1') {
                $('#edit_agent #istri').prop('checked', true);
              } else if (v.insurerstatusagent == '2') {
                $('#edit_agent #orang-tua').prop('checked', true);
              } else if (v.insurerstatusagent == '3') {
                $('#edit_agent #saudara').prop('checked', true);
              } else if (v.insurerstatusagent == '4') {
                $('#edit_agent #tetangga').prop('checked', true);
              } 
            });
          }
        });
    });
  </script>

  <script>
    $(document).on('click', '.detail-button', function () {
      var idagent = $(this).data('id');
      $.ajax({
          url: "<?php echo site_url('Agent/showAgentDetail/"+idagent+"') ?>",
          dataType: 'json',
          cache: false,
          success: function (result) {
            $.each(result.agentdetail, function(k, v) {
              if (v.agentgender == 'f') {
                $('#agent-detail #agent-gender').html('Perempuan');
              } else {
                $('#agent-detail #agent-gender').html('Laki-Laki');
              }

               $('#agent-detail #agent-id').html(v.idagent);
               $('#agent-detail #agent-name').html(v.agentname);
               $('#agent-detail #agent-email').html(v.agentemail);
               $('#agent-detail #agent-idnumb').html(v.agentidentitynumber);
               $('#agent-detail #agent-phone').html(v.agentphone);
               $('#agent-detail #agent-address').html(v.agentaddress);
               $('#agent-detail #agent-birthdate').html(v.agentbirthdate);
               $('#agent-detail #insurer-id').html(v.idinsurer);
               $('#agent-detail #insurer-name').html(v.insurername);
               $('#agent-detail #insurer-address').html(v.insureraddress);
               $('#agent-detail #insurer-phone').html(v.insurerphone);

              if (v.insurerstatusagent == '0') {
                $('#agent-detail #insurer-status-agent').html('Suami');
              } else if (v.insurerstatusagent == '1') {
                $('#agent-detail #insurer-status-agent').html('Istri');
              } else if (v.insurerstatusagent == '2') {
                $('#agent-detail #insurer-status-agent').html('Orang Tua');
              } else if (v.insurerstatusagent == '3') {
                $('#agent-detail #insurer-status-agent').html('Saudara');
              } else if (v.insurerstatusagent == '4') {
                $('#agent-detail #insurer-status-agent').html('Tetangga');
              } 
            });
          }
        });
    });
  </script>

  <!-- page content -->
  <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <ol class="breadcrumb">
      <li><a href="#">Data Management</a></li>
      <li><a href="#">Agent</a></li>
    </ol>
    <h2 class="sub-header">Agent&nbsp;
      <a data-toggle="modal" href="#add_agent" class="btn btn-primary pull-right">
        <span class="glyphicon glyphicon-plus"></span>&nbsp;Add Agent
      </a>
    </h2>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Identity Number</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Detail</th>
            <th>Status</th>
            <th><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if ($allagent == false) {
          ?> 
            <tr><td colspan='9' class='text-center'>Data Agen belum terisi</td></tr>
          <?php
          } else { 
            foreach ($allagent as $v) { 
          ?>
            <tr>
              <td><?php echo $v['idagent']; ?></td>
              <td><?php echo $v['agentname']; ?></td>
              <td><?php echo $v['agentemail']; ?></td>
              <td><?php echo $v['agentidentitynumber']; ?></td>
              <td><?php echo $v['agentphone']; ?></td>
              <td><?php echo $v['agentaddress']; ?></td>

              <td class="text-center">
                <a data-toggle="modal" href="#agent-detail" class="btn btn-xs btn-info detail-button" data-id="<?php echo $v['idagent']; ?>">
                  Detail
                </a>
              </td>

              <td>
                <?php if ($v['agentstatus'] == '0'): ?>
                <span  class="btn btn-xs btn-default">Inactive</span>
                <?php elseif ($v['agentstatus'] == '1'): ?>
                <span class="btn btn-xs btn-success">Active</span>
                <?php elseif ($v['agentstatus'] == '2'): ?>
                <span class="btn btn-xs btn-warning">On Vacation</span>
                <?php elseif ($v['agentstatus'] == '3'): ?>
                <span class="btn btn-xs btn-danger">Banned</span>
                <?php endif; ?>
              </td>

              <td>
                <a href="#edit_agent" data-toggle="modal" class="edit-button btn btn-primary btn-xs" data-id="<?php echo $v['idagent']; ?>">
                  <span class="glyphicon glyphicon-pencil"></span>
                </a>
                &nbsp;
                <a onclick="return confirm('Hapus data?')" class="btn btn-xs btn-danger " href="<?php echo site_url('Agent/deleteAgent/').$v['idagent']; ?>">
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
  <!-- Modal detail -->
  <div class="modal fade" id="agent-detail" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4><strong>Agent Detail</strong></h4>
        </div>
        <div class="modal-body">
          <table>
            <tr>
              <td>ID Agen</td>
              <td>:&nbsp;</td>
              <td id="agent-id"></td>
            </tr>
            <tr>
              <td>Nama Agen</td>
              <td>:&nbsp;</td>
              <td id="agent-name"></td>
            </tr>
            <tr>
              <td>Email Agen</td>
              <td>:&nbsp;</td>
              <td id="agent-email"></td>
            </tr>
            <tr>
              <td>Nomor Identitas Agen</td>
              <td>:&nbsp;</td>
              <td id="agent-idnumb"></td>
            </tr>
            <tr>
              <td>No. Telepon Agen</td>
              <td>:&nbsp;</td>
              <td id="agent-phone"></td>
            </tr>
            <tr>
              <td>Alamat Agen</td>
              <td>:&nbsp;</td>
              <td id="agent-address"></td>
            </tr>
            <tr>
              <td>Jenis Kelamin</td>
              <td>:&nbsp;</td>
              <td id="agent-gender"></td>
            </tr>
            <tr>
              <td>Tanggal Lahir Agen</td>
              <td>:&nbsp;</td>
              <td id="agent-birthdate"></td>
            </tr>
            <tr>
              <td>ID Penjamin</td>
              <td>:&nbsp;</td>
              <td id="insurer-id"></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>:&nbsp;</td>
              <td id="insurer-name"></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:&nbsp;</td>
              <td id="insurer-address"></td>
            </tr>
            <tr>
              <td>No. Telepon</td>
              <td>:&nbsp;</td>
              <td id="insurer-phone"></td>
            </tr>
            <tr>
              <td>Status Hubungan dengan Agen</td>
              <td>:&nbsp;</td>
              <td id="insurer-status-agent"></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer"></div>
      </div>
    </div>
  </div>
  <!-- /Modal deteail -->

  <!-- Modal Add -->
  <div class="modal fade" id="add_agent" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Add Agent</h4>
        </div>

        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('Agent/insertAgent'); ?>" method="POST">
          
          <div class="modal-body">
            <div class="row">
              <div class="col-xs-10 col-sm-9 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
                
                <div class="form-group">
                  <label for="agent-name" style="font-size:0.8em">Nama Agen</label>
                  <div class="input-group">
                    <input type="hidden" name="idagent" id="agent-id" required="required" class="form-control" />
                    <input type="text" name="agentname" id="agent-name" required="required" class="form-control">
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="agent-email" style="font-size:0.8em">Email Agen</label>
                  <div class="input-group">
                    <input type="email" name="agentemail" id="agent-email" required="required" class="form-control" />
                    <div class="input-group-addon">*</div>
                  </div>
                  <em style="font-size:0.8em">Contoh: nama@email.com</em>
                  <em id="email-msg" class="pull-right" style="font-size:0.8em"></em>
                </div>
                
                <div class="form-group">
                  <label for="agent-idnumb" style="font-size:0.8em">Nomor Identitas Agen</label>
                  <div class="input-group">
                    <input type="text" name="agentidentitynumber" id="agent-idnumb" required="required" class="form-control">
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="agent-phone" style="font-size:0.8em">No. Telepon Agen</label>
                  <div class="input-group">
                    <input type="tel" name="agentphone" id="agent-phone" required="required" class="form-control" >
                    <div class="input-group-addon">*</div>
                  </div>
                  <em style="font-size:0.8em">Contoh: 081***</em>
                </div>
                
                <div class="form-group">
                  <label for="agent-address" style="font-size:0.8em">Alamat Agen</label>
                  <div class="input-group">
                    <input type="text" name="agentaddress" id="agent-address" required="required" class="form-control" placeholder="Alamat Agen">
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="agent-gender" style="font-size:0.8em">Jenis Kelamin Agen</label><br>
                  <div class="input-group">
                    <div class="radio radio-inline">
                      <label><input type="radio" name="agentgender" value="m" checked>L</label>
                    </div>
                    <div class="radio radio-inline">
                      <label><input type="radio" name="agentgender" value="f">P</label>
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="agent-bdate" style="font-size:0.8em">Tanggal Lahir Agen</label>
                  <div class="input-group">
                    <input type="date" name="agentbirthdate" id="agent-bdate" required="required" class="form-control" value="<?php echo date("Y-m-d", strtotime("-17 years")); ?>" max="<?php echo date("Y-m-d", strtotime("-17 years")); ?>" >
                    <div class="input-group-addon">*</div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="branch-id" style="font-size:0.8em">Branch</label>
                  <div class="input-group">
                    <select name="idbranch" id="branch-id" class="form-control">
                      <!-- Filled by jQuery -->
                    </select>
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="insurer-name" style="font-size:0.8em">Nama Penjamin</label>
                  <div class="input-group">
                    <input type="hidden" name="insurerid" id="insurer-id" required="required" class="form-control">
                    <input type="text" name="insurername" id="insurer-name" required="required" class="form-control" placeholder="Nama Penjamin">
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="insurer-address" style="font-size:0.8em">Alamat Penjamin</label>
                  <div class="input-group">
                    <input type="text" name="insureraddress" id="insurer-address" required="required" class="form-control" >
                    <div class="input-group-addon">*</div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="insurer-phone" style="font-size:0.8em">No. Telepon Penjamin</label>
                  <div class="input-group">
                    <input type="tel" name="insurerphone" id="insurer-phone" required="required" class="form-control">
                    <div class="input-group-addon">*</div>
                  </div>
                  <em style="font-size:0.8em">Contoh: 081***</em>
                </div>
                
                <div class="form-group hidden-xs">
                  <label for="insurer-status" style="font-size:0.8em">Status Penjamin</label><br>
                  <div class="input-group">
                    <div class="radio radio-inline">
                      <label><input type="radio" name="insurerstatus" value="0">Suami</label>
                    </div>
                    <div class="radio radio-inline">
                      <label><input type="radio" name="insurerstatus" value="1">Istri</label>
                    </div>
                    <div class="radio radio-inline">
                      <label><input type="radio" name="insurerstatus" value="2">Orang Tua</label>
                    </div>
                    <div class="radio radio-inline">
                      <label><input type="radio" name="insurerstatus" value="3">Saudara</label>
                    </div>
                    <div class="radio radio-inline">
                      <label><input type="radio" name="insurerstatus" value="4">Tetangga</label>
                    </div>
                  </div>
                </div>
                
                <div class="form-group visible-xs">
                  <label for="insurer-status" style="font-size:0.8em">Status Penjamin</label><br>
                  <div class="input-group">
                    <div class="radio">
                      <label><input type="radio" name="insurerstatus" value="0">Suami</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="insurerstatus" value="1">Istri</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="insurerstatus" value="2">Orang Tua</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="insurerstatus" value="3">Saudara</label>
                    </div>
                    <div class="radio">
                      <label><input type="radio" name="insurerstatus" value="4">Tetangga</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Cancel</button>&nbsp;&nbsp;&nbsp;
            <button type="submit" value="" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add</button>
          </div>

        </form>
      </div>
    </div>
  </div>
  <!-- /Modal Add -->

  <!-- Modal Edit -->
  <div class="modal fade" id="edit_agent" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4>Edit Agent</h4>
        </div>

        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('Agent/editAgentAndInsurer'); ?>" method="POST">
          <div class="modal-body">
            <div class="row">
              <div class="col-xs-10 col-sm-9 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">

                <div class="form-group">
                  <label for="agent-id" style="font-size:0.8em">Agent ID</label>
                  <div class="input-group">
                    <input type="text" name="idagent" id="agent-id" required="required" class="form-control" readonly />
                    <div class="input-group-addon">*</div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="agent-name" style="font-size:0.8em">Nama Agen</label>
                  <div class="input-group">
                    <input type="text" name="agentname" id="agent-name" required="required" class="form-control" >
                    <div class="input-group-addon">*</div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="agent-email" style="font-size:0.8em">Email Agen</label>
                  <div class="input-group">
                    <input type="email" name="agentemail" id="agent-email" required="required" class="form-control" readonly>
                    <div class="input-group-addon">*</div>
                  </div>
                  <em style="font-size:0.8em">nama@email.com</em>
                </div>

                <div class="form-group">
                  <label for="agent-idnumb" style="font-size:0.8em">Nomor Identitas Agen</label>
                  <div class="input-group">
                    <input type="text" name="agentidentitynumber" id="agent-idnumb" required="required" class="form-control" readonly>
                    <div class="input-group-addon">*</div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="agent-phone" style="font-size:0.8em">No. Telepon Agen</label>
                  <div class="input-group">
                    <input type="tel" name="agentphone" id="agent-phone" required="required" class="form-control" />
                    <div class="input-group-addon">*</div>
                  </div>
                  <em style="font-size:0.8em">Contoh: 081*********</em>
                </div>

                <div class="form-group">
                  <label for="agent-address" style="font-size:0.8em">Alamat Agen</label>
                  <div class="input-group">
                    <input type="text" name="agentaddress" id="agent-address" required="required" class="form-control" />
                    <div class="input-group-addon">*</div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="agent-gender" style="font-size:0.8em">Jenis Kelamin Agen</label><br>
                  <div class="input-group" id="agent-gender">
                    <div class="radio radio-inline">
                      <label><input type="radio" name="agentgender" id="male" value="male" checked>L</label>
                    </div>
                    <div class="radio radio-inline">
                      <label><input type="radio" name="agentgender" id="female" value="female">P</label>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="agent-bdate" style="font-size:0.8em">Tanggal Lahir Agen</label>
                  <div class="input-group">
                    <input type="date" name="agentbirthdate" id="agent-bdate" required="required" class="form-control" />
                    <div class="input-group-addon">*</div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="agent-status" style="font-size:0.8em">Status Agen</label>
                  <div class="input-group">
                    <select name="agentstatus" id="agent-status" class="form-control">
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

                <div class="form-group">
                  <label for="insurer-id" style="font-size:0.8em">ID Penjamin</label>
                  <div class="input-group">
                    <input type="text" name="idinsurer" id="insurer-id" required="required" class="form-control" readonly />
                    <div class="input-group-addon">*</div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="insurer-name" style="font-size:0.8em">Nama Penjamin</label>
                  <div class="input-group">
                    <input type="text" name="insurername" id="insurer-name" required="required" class="form-control" />
                    <div class="input-group-addon">*</div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="insurer-address" style="font-size:0.8em">Alamat Penjamin</label>
                  <div class="input-group">
                    <input type="text" name="insureraddress" id="insurer-address" required="required" class="form-control" />
                    <div class="input-group-addon">*</div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="insurer-phone" style="font-size:0.8em">No. Telepon Penjamin</label>
                  <div class="input-group">
                    <input type="tel" name="insurerphone" id="insurer-phone" required="required" class="form-control" />
                    <div class="input-group-addon">*</div>
                  </div>
                  <em style="font-size:0.8em">Contoh: 081****</em>
                </div>

                <div class="form-group">
                  <label for="insurer-rel" style="font-size:0.8em">Status Penjamin</label><br>
                  <div class="input-group" id="insurer-rel">
                    <div class="radio radio-inline">
                      <label><input type="radio" name="insurerstatusagent" id="suami" value="0">Suami</label>
                    </div>
                    <div class="radio radio-inline">
                      <label><input type="radio" name="insurerstatusagent" id="istri" value="1">Istri</label>
                    </div>
                    <div class="radio radio-inline">
                      <label><input type="radio" name="insurerstatusagent" id="orang-tua" value="2">Orang Tua</label>
                    </div>
                    <div class="radio radio-inline">
                      <label><input type="radio" name="insurerstatusagent" id="saudara" value="3">Saudara</label>
                    </div>
                    <div class="radio radio-inline">
                      <label><input type="radio" name="insurerstatusagent" id="tetangga" value="4">Tetangga</label>
                    </div>
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
  <!-- /Modal Edit -->
  <!-- /Modal -->