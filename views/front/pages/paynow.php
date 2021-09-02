<?php if (!empty($user_data)) {
        $data = json_decode($user_data);
    } ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card my-4 p-3 col-md-4">
            <div class="row main">
                <div class="col-12">
                    <h4 class="text-center">Proceed to pay</h4>
                </div>
            </div>
            <div class="row justify-content-center mrow">
                <div class="col-12"> <img src="https://img.icons8.com/color/48/000000/mastercard-logo.png" width="35px" height="35px" /> <img src="https://img.icons8.com/color/48/000000/visa.png" width="35px" height="35px" /> <img src="https://img.icons8.com/color/48/000000/paypal.png" width="35px" height="35px" /> </div>
            </div>
            
            <form class="form-card">

                <div class="row">
                    <div class="col-12">
                        <div class="form-group mt-2"> 
                            <input type="text" class="form-control" id="payment_user_name" name="payment_user_name" value="<?= !empty($data) ? ($data[0]->f_name .' '.$data[0]->l_name) : '' ?>" placeholder="Enter your name" readonly>
                            <input type="hidden" id="payment_user_id" name="payment_user_id" value="<?= !empty($data) ? $data[0]->user_id : '' ?>">
                            <input type="hidden" id="payment_amt" name="payment_amt" value="490">
                        </div>
                    </div>
                </div>

                <div class="row lrow mt-4 mb-3">
                    <div class="col-sm-8 col-12">
                        <h3>Grand Total:</h3>
                    </div>
                    <div class="col-sm-4 col-12">
                        <h5>&#x20B9;490.00</h5>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-12"> 
                        <button type="button" class="btn btn-primary btn-block" onclick="pay_now()">Pay with Razorpay</button> 
                    </div>
                </div>
            </form>
           
          
        
           
        </div>
        <div class="card my-4 p-3 col-md-4">
        <img src="<?= base_url('assets/') ?>upi.jpg" alt="UPI" class="img-fluid">
       </div>    
    </div>
</div>