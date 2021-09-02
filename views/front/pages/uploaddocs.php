<?php if (!empty($session_data)) { ?>
    <div class="row justify-content-center">
        <div class="card my-4 p-3 pb-5 col-md-5">
            <div class="row main">
                <div class="col-12"><h4 class="text-center mb-5">Upload Documents</h4></div>
            </div>

            <?php if (!empty($user_data)) { ?> 
            <?php $encode_user_data = json_decode($user_data);
                foreach($encode_user_data as $value) { ?> 

<form class="form-card" id="uploadDoc">
        <input type="hidden" id="userid" name="userid" value="<?= !empty($session_data) ? $session_data['id'] : '' ?>">

 <div class="form-row mb-3">
    <div class="col-md-3">
<label class="col-form-label">    Aadhar</label>
    </div>
    <?php if(empty($value->aadhar_img)) { ?>
    <div class="col-md-8 col-11">        
      <div class="input-group">          
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="aadhar_img" id="aadhar_img" accept="image/*" value="<?= !empty($user_data) ? $value->aadhar_img : '' ?>" >
            <label class="custom-file-label" for="validatedCustomFile">Choose file</label><div class="invalid-feedback">Example invalid custom file feedback</div>
        </div>
    </div>
    </div>
    <?php } else { ?>
        <img id="doc_tag" name="doc_tag" src="<?= (base_url('assets/documents_img/') . $value->aadhar_img) ?>" alt="mojsk" style="object-fit: cover; width: 200px; height: 200px;">
        <a href="#" onClick="UpdateDoc('aadhar_img')"><i class="icofont-ui-delete icofont-2x text-danger"></i></a>
    <?php } ?>

        </div>
  <div class="form-row mb-3">
    <div class="col-md-3">
<label class="col-form-label"> Pan</label>
    </div>

    <?php if(empty($value->pan_img)) { ?>
    <div class="col-md-8 col-11">
      <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="pan_img" id="pan_img" value="<?= !empty($user_data) ? $value->pan_img : '' ?>">
            <label class="custom-file-label" for="myInput">Choose file</label>
        </div>
        </div>
    </div>
    <?php } else { ?>
        <img id="doc_tag" name="doc_tag" src="<?= (base_url('assets/documents_img/') . $value->pan_img) ?>" alt="mojsk" style="object-fit: cover;width: 200px;height: 200px;">
        <a href="#" onClick="UpdateDoc('pan_img')"><i class="icofont-ui-delete icofont-2x text-danger"></i></a>
    <?php } ?>
    </div>
    
 
  <div class="form-row mb-3">
    <div class="col-md-3">
<label class="col-form-label">Shop Photo</label>
    </div>
  
    <?php if(empty($value->shop_img)) { ?>
    <div class="col-md-8 col-11">      
      <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="shop_img" id="shop_img" value="<?= !empty($user_data) ? $value->shop_img : '' ?>">
            <label class="custom-file-label" for="myInput">Choose file</label>
        </div>
    </div>
    </div>
    <?php } else { ?>
        <img id="doc_tag" name="doc_tag" src="<?= (base_url('assets/documents_img/') . $value->shop_img) ?>" alt="mojsk" style="object-fit: cover;width: 200px;height: 200px;">
        <a href="#" onClick="UpdateDoc('shop_img')"><i class="icofont-ui-delete icofont-2x text-danger"></i></a>
    <?php } ?>
</div>
               
     <div class="form-row mb-3">
    <div class="col-md-3">
<label class="col-form-label">Bank Passbook</label>
    </div>
    
    <?php if(empty($value->bank_passbook_img)) { ?>
    <div class="col-md-8 col-11">
      <div class="input-group">
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="bank_passbook_img" id="bank_passbook_img" value="<?= !empty($user_data) ? $value->bank_passbook_img : '' ?>">
            <label class="custom-file-label" for="myInput">Choose file</label>
        </div>
    </div>
    </div>
    <?php } else { ?>
        <img id="doc_tag" name="doc_tag" src="<?= (base_url('assets/documents_img/') . $value->bank_passbook_img) ?>" alt="mojsk" style="object-fit: cover;width: 200px;height: 200px;" >
        <a href="#" onClick="UpdateDoc('bank_passbook_img')"><i class="icofont-ui-delete icofont-2x text-danger"></i></a>
        <!-- <div class="col-1"><a href="#"><i class="icofont-ui-delete icofont-2x text-danger"></i></a></div> -->
    <?php } ?>
</div>     
            </form>
            <?php } ?>  
            <?php } ?>  

        </div>
    </div>
<?php } ?>