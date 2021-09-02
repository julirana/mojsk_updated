<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active">User</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->

    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <div class="card">

    <!-- /.card-header -->
    <div class="card-body">
      <div class="row">
        <div class="col-md-1">
          <label>Filter : </label>
        </div>
        <div class="col-md-2">
          <div class="box-tools">
            <select class="browser-default custom-select" id="otp_filter" name="otp_filter">
              <option value="">Select OTP status</option>
              <option value="1">Validated</option>
              <option value="0">Not Validated</option>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="box-tools">
            <select class="browser-default custom-select" id="payment_filter" name="payment_filter">
              <option value="">Select payment status</option>
              <option value="1">Paid</option>
              <option value="0">Unpaid</option>
            </select>
          </div>
        </div>
      </div>

      <div class="clearfix"></div><br>

      <?php if ($this->session->flashdata('msg')) : ?>
        <div id="message">
          <h4 style="color:green;text-align: center;"><?php echo $this->session->flashdata('msg'); ?></h4>
        </div>
      <?php endif; ?>
      <script>
        setTimeout(function() {
          $('#message').fadeOut('fast');
        }, 3000);
      </script>

      <table id="userTable" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sl.No</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>OTP</th>
            <th>Payment</th>
            <th>Action</th>
          </tr>
        </thead>

      </table>
      
    </div>
    <!-- /.card-body -->
              
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width:100%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Payment Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                        
      <form class="form-horizontal" action="<?= base_url() ?>Admin/updatePaymentStatus" method="post" enctype="multipart/form-data">
                  <div class="row">
                  <input id="user_id" name="user_id" type="hidden" value="">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Payment Amount</label>
                        <input id="payment_amt" name="payment_amt" type="text" class="form-control <?= form_error('payment_amt') ? 'is-invalid' : '' ?>" value="" placeholder="Enter amount...">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">

                        <label>Payment Id</label>
                        <input id="payment_id" name="payment_id" type="text" class="form-control <?= form_error('payment_id') ? 'is-invalid' : '' ?>" value="" placeholder="Enter ...">

                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Payment Status</label>
                        <select name="payment_status" class="custom-select">
                          <option selected="">Select status</option>
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                      </div>
                    </div>

                  </div>
                  <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="<?= base_url() ?>Admin/user"><button type="button" class="btn btn-danger">Cancel</button></a>
                  </div>
                </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
  </div>
  </div>
  <!-- /.content-wrapper -->
  