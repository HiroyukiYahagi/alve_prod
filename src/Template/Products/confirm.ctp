<h4><?= __('Confirm') ?></h4>

<form method="post" action="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'publish']);?>">
	<input type="hidden" name="id" value="<?php echo $product->id;?>">
    <div class="row">
        <div class="col s12">
            <h5>
                <i class="fa fa-user fa-with" aria-hidden="true"></i>
                <?= __('Company Info') ?>
            </h5>
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s6">
                        	<label for="company_name">
                        		<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        		<?= __('Company Name') ?>
                        	</label>
                            <p><?php echo $product->company->company_name;?></p>
                        </div>
                        <div class="col s6">
                        	<label for="company_name_kana">
                        		<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        		<?= __('Company Name ( kana )') ?>
                        	</label>
                            <p><?php echo $product->company->company_name_kana;?></p>
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col s6">
                    		<label for="company_url"><?= __('Company URL') ?></label>
                            <p id="company_url">
                                <?php echo $product->company->url;?>
                            </p>
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col s6">
                    		<label for="operator_name">
                    			<i class="fa fa-star" aria-hidden="true"></i>
                    			<?= __('Operator Name') ?>
                    		</label>
                            <p id="operator_name"><?php echo $product->operator_name;?></p>
                    	</div>
                    	<div class="col s6">
                    		<label for="operator_department">
                    			<i class="fa fa-star" aria-hidden="true"></i>
                    			<?= __('Operator Department') ?>
                    		</label>
                            <p id="operator_department"><?php echo $product->operator_department;?>
                            </p>
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col s6">
                    		<label for="operator_tel">
                    			<i class="fa fa-star" aria-hidden="true"></i>
                    			<?= __('Operator TEL') ?>
                    		</label>
                            <p id="operator_tel"><?php echo $product->operator_tel;?>
                            </p>
                    	</div>
                    	<div class="col s6">
                    		<label for="operator_email">
                    			<i class="fa fa-star" aria-hidden="true"></i>
                    			<?= __('Operator Email') ?>
                    		</label>
                            <p id="operator_email">
                                <?php echo $product->operator_email;?>
                            </p>
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col s6">
                    		<label for="latest_fomula">
                    			<i class="fa fa-star" aria-hidden="true"></i>
                        		<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                    			<?= __('Latest Fomula Date') ?>
                    		</label>
                            <p>
                                <?php echo $product->latest_fomula; ?>
                            </p>
                    	</div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="row">
        <div class="col s12">
            <h5>
                <i class="fa fa-cog fa-with" aria-hidden="true"></i>
                <?= __('Product Info') ?>
            </h5>

            <div class="card">
                <div class="card-content">

                    <div class="row">
						<div class="col s6">
							<label>
                    	   		<i class="fa fa-star" aria-hidden="true"></i>
		                		<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
								<?= __('Product Type')?>
							</label>
                            <p>
                                <?php echo $types[$product->type_id]->type_name;?>
                            </p>
						</div>
                    </div>

                    <div class="row">
                        <div class="col s6">
                        	<label for="product_name">
                    	   		<i class="fa fa-star" aria-hidden="true"></i>
		                		<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        		<?= __('Product Name') ?>
                        	</label>
                        	<p id="product_name"><?php echo $product->product_name;?></p>
                        </div>
                        <div class="col s6">
                        	<label for="model_number">
                    	   		<i class="fa fa-star" aria-hidden="true"></i>
		                		<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        		<?= __('Model Number') ?>
                        	</label>
                        	<p id="model_number"><?php echo $product->model_number;?></p>
                        </div>
                    </div>

                    <div class="row">
                    	<div class="col s12">
                    		<label for="product_comment"><?= __('Product Comment') ?></label>
                            <p id="product_comment"><?php echo $product->product_comment;?></p>
                    	</div>
                    </div>

                    <div class="row">
                    	<div class=" col s6">
                        	<label for="product_info_url">
                        		<?= __('Product URL') ?>
                        	</label>
                        	<p id="product_info_url"><?php echo $product->product_info_url;?></p>
                    	</div>
                    	<div class="col s6">
                        	<label for="sales_date">
                    	   		<i class="fa fa-star" aria-hidden="true"></i>
		                		<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        		<?= __('Sales Date') ?>
                        	</label>
                        	<p id="sales_date"><?php echo $product->sales_date;?></p>
                    	</div>
                    </div>


                    <?php if($evaluation_type==0):?>
                    <div class="row">
                        <div class="col s6">
                            <label>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <?= __('Evaluation Type') ?>
                            </label>
                            <p>
                                <?= __('Compared with the following product')?>
                            </p>
                        </div>
                    </div>
                    <div id="compared-option" class="row">
                        <div class="col s6">
                            <label for="compared_product_name">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <?= __('Compared Product Name') ?>
                            </label>
                            <p id="compared_product_name"></p>
                        </div>
                        <div class=" col s6">
                            <label for="compared_model_number">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <?= __('Compared Product Model Number') ?>
                            </label>
                            <p id="compared_model_number"></p>
                        </div>
                    </div>

                    <?php else:?>
                    <div class="row">
                        <div class="col s6">
                            <label>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <?= __('Evaluation Type') ?>
                            </label>
                            <p>
                                <?= __('Compared with target value')?>
                            </p>
                        </div>
                    </div>

                    <?php endif;?>

                </div>
            </div>

        </div>
    </div>

	<button class="submit btn waves-effect waves-light green" type="submit">
		<?= __('Submit') ?>
	</button>

</form>


<script type="text/javascript">
function changeEvaluationType(mode){
	if(mode == 0){
		$('#compared-option').show();
	}else{
		$('#compared-option').hide();
	}
}
</script>
