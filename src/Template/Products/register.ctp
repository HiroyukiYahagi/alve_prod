<h4><?= __('Product Register Form') ?></h4>
<blockquote>
	情報更新時は、前回登録時の内容が記載されていますので、必要に応じ修正してください。
</blockquote>


<form method="post" action="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'register']);?>">
	<input type="hidden" name="id" value="<?php echo $product->id;?>">
	<input type="hidden" name="status" value="true">
    <div class="row">
        <div class="col s12">
            <h5>
                <i class="fa fa-user fa-with" aria-hidden="true"></i>
                <?= __('Company Info') ?>
            </h5>
    		<blockquote>
				<i class="fa fa-star fa-with" aria-hidden="true"></i>入力必須項目<br/>
				<i class="fa fa-exclamation-triangle fa-with" aria-hidden="true"></i>登録製品一覧のページに表示される項目
			</blockquote>

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
                    	<div class="input-field col s6">
                    		<label for="company_url"><?= __('Company URL') ?></label>
                            <input id="company_url" type="text" name="company[url]" class="validate" value="<?php echo $product->company->url;?>" />
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="input-field col s6">
                    		<label for="operator_name">
                    			<i class="fa fa-star" aria-hidden="true"></i>
                    			<?= __('Operator Name') ?>
                    		</label>
                            <input id="operator_name" type="text" name="product[operator_name]" class="validate" value="<?php echo $product->operator_name;?>"/>
                    	</div>
                    	<div class="input-field col s6">
                    		<label for="operator_department">
                    			<i class="fa fa-star" aria-hidden="true"></i>
                    			<?= __('Operator Department') ?>
                    		</label>
                            <input id="operator_department" type="text" name="product[operator_department]" class="validate" value="<?php echo $product->operator_department;?>" />
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="input-field col s6">
                    		<label for="operator_tel">
                    			<i class="fa fa-star" aria-hidden="true"></i>
                    			<?= __('Operator TEL') ?>
                    		</label>
                            <input id="operator_tel" type="text" name="product[operator_tel]" class="validate" value="<?php echo $product->operator_tel;?>"/>
                    	</div>
                    	<div class="input-field col s6">
                    		<label for="operator_email">
                    			<i class="fa fa-star" aria-hidden="true"></i>
                    			<?= __('Operator Email') ?>
                    		</label>
                            <input id="operator_email" type="text" name="product[operator_email]" class="validate" value="<?php echo $product->operator_email;?>"/>
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col s6">
                    		<label for="latest_fomula">
                    			<i class="fa fa-star" aria-hidden="true"></i>
                        		<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                    			<?= __('Latest Fomula Date') ?>
                    		</label>
                            <input id="latest_fomula" type="date" class="datepicker" name="product[latest_fomula]">
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
			<blockquote>
				<i class="fa fa-star fa-with" aria-hidden="true"></i>入力/選択必須項目<br/>
				<i class="fa fa-exclamation-triangle fa-with" aria-hidden="true"></i>登録製品一覧のページに表示される項目
			</blockquote>

            <div class="card">
                <div class="card-content">

                    <div class="row">
						<div class="input-field col s6">
							<select>
								<?php foreach ($types as $type):?>
								<option <?php echo $type->id==$product->type_id ? 'selected': '';?> value="<?php echo $type->id;?>"><?php echo $type->type_name.' '.$type->fomula.' '.$type->purpose; ?></option>
								<?php endforeach;?>
							</select>
							<label>
                    	   		<i class="fa fa-star" aria-hidden="true"></i>
		                		<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
								<?= __('Product Type')?>
							</label>
						</div>
                    </div>

                    <div class="row">
                        <div class="col s6">
                        	<label for="product_name">
                    	   		<i class="fa fa-star" aria-hidden="true"></i>
		                		<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        		<?= __('Product Name') ?>
                        	</label>
                        	<input id="product_name" type="text" name="product[product_name]" class="validate" value="<?php echo $product->product_name;?>" />
                        </div>
                        <div class="col s6">
                        	<label for="model_number">
                    	   		<i class="fa fa-star" aria-hidden="true"></i>
		                		<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        		<?= __('Model Number') ?>
                        	</label>
                        	<input id="model_number" type="text" name="product[model_number]" class="validate" value="<?php echo $product->model_number;?>" />
                        </div>
                    </div>

                    <div class="row">
                    	<div class="input-field col s12">
                    		<label for="product_comment"><?= __('Product Comment') ?></label>
                            <textarea id="product_comment" class="materialize-textarea" name="product[product_comment]"><?php echo $product->product_comment;?></textarea>
                    	</div>
                    </div>

                    <div class="row">
                    	<div class="input-field col s6">
                        	<label for="product_info_url">
                        		<?= __('Product URL') ?>
                        	</label>
                        	<input id="product_info_url" type="text" name="product[product_info_url]" class="validate" value="<?php echo $product->product_info_url;?>" />
                    	</div>
                    	<div class="input-field col s6">
                        	<label for="sales_date">
                    	   		<i class="fa fa-star" aria-hidden="true"></i>
		                		<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        		<?= __('Sales Date') ?>
                        	</label>
                        	<input id="sales_date" type="text" name="product[sales_date]" class="validate" value="<?php echo $product->sales_date;?>" />
                    	</div>
                    </div>

                    <div class="row">
                    	<div class="col s6">
                    	   	<label>
                    	   		<i class="fa fa-star" aria-hidden="true"></i>
		                		<?= __('Evaluation Type') ?>
		                	</label>
							<p onclick="changeEvaluationType(0);">
						    	<input name="evaluation_type" type="radio" id="evaluation_type_comp" checked value="0"/>
						    	<label for="evaluation_type_comp"><?= __('Compared with the following product')?></label>
					    	</p>
					    	<p onclick="changeEvaluationType(1);">
						    	<input name="evaluation_type" type="radio" id="evaluation_type_none" value="1"/>
						    	<label for="evaluation_type_none"><?= __('Compared with target value')?></label>
						    </p>
                    	</div>
                    </div>

                    <div id="compared-option" class="row">
                    	<div class="input-field col s6">
                    		<label for="compared_product_name">
                    			<i class="fa fa-star" aria-hidden="true"></i>
                    			<?= __('Compared Product Name') ?>
                    		</label>
                            <input id="compared_product_name" type="text" name="evaluation[compared_product_name]" class="validate" value="">
                    	</div>
                    	<div class="input-field col s6">
                    		<label for="compared_model_number">
                    			<i class="fa fa-star" aria-hidden="true"></i>
                    			<?= __('Compared Product Model Number') ?>
                    		</label>
                            <input id="compared_model_number" type="text" name="evaluation[compared_model_number]" class="validate" value=""/>
                    	</div>
                    </div>

                </div>
            </div>

        </div>
    </div>

	<blockquote>
		製品評価結果に関わるデータは提出不要ですが、自社でしっかり保管しておく必要があります。
	</blockquote>

	<button class="submit btn waves-effect waves-light green" type="submit">
		<?= __('Confirm') ?>
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
