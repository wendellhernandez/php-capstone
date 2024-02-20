        <!-- 
        FORM HEAD IMPORTAN
        ACTION
        CLASS FORM VALIDATION
        - CHANGE JS IF YOU WILL CHANGE FOR STYLING
        DATA CC ON FILE
        PUBLISHABLE KEY
        -->
        <form role="form" action="<?php echo base_url('handleStripePayment');?>" method="post"
            class="form-validation" data-cc-on-file="false"
            data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>"
            >
            <div class='form-row row'>
                <div class='col-xs-12 form-group card required'>
                    <label class='control-label'>Card Number</label>
                    <!-- 
                        CLASS CARD-NUMBER
                        PLACEHOLDER
                        -4242 4242 4242 4242
                        -->
                    <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                </div>
            </div>
            <div class='form-row row'>
                <div class='col-xs-12 col-md-4 form-group cvc required'>
                    <label class='control-label'>CVC</label>
                    <!-- 
                        CLASS CARD-CVC
                        PLACEHOLDER
                        -456
                        -->
                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311'
                        size='4' type='text'>
                </div>
                <div class='col-xs-12 col-md-4 form-group expiration required'>
                    <label class='control-label'>Expiration Month</label>
                    <!-- 
                        CLASS CARD-EXPIRY-MONTH
                        PLACEHOLDER
                        -12
                        -->
                    <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                </div>
                <div class='col-xs-12 col-md-4 form-group expiration required'>
                    <label class='control-label'>Expiration Year</label>
                    <!-- 
                        CLASS CARD-EXPIRY-MONTH
                        PLACEHOLDER
                        -2025
                        -->
                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4'
                        type='text'>
                </div>
            </div>
            <!-- 
                ERROR MESSAGE
                CLASS ERROR
                -->
            <div class='form-row row'>
                <div class='col-md-12 error form-group hide'>
                    <div class='alert-danger alert'>Error occured while making the payment.</div>
                </div>
            </div>
            <!-- 
                SUBMIT BUTTON 
                CAN BE DELETED
                -->
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-danger btn-lg btn-block" type="submit">Pay $<?= $total_plus_shipping ?></button>
                </div>
            </div>
        </form>