<h4><?= __('製品登録') ?></h4>
<blockquote>
    <?= __('以下の欄に必要事項を入力し、「利用規約に同意」にチェックを入れてください。')?>
</blockquote>

<form method="post" action="#">
    <input type="hidden" name="id" value="<?php echo $product->id;?>">

   <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s6">
                    <label>
                        <?= __('会社名') ?>
                    </label>
                    <p><?php echo $product->company->company_name;?></p>
                </div>
                <div class="col s6">
                    <label>
                        <?= __('登録製品名') ?>
                    </label>
                    <p><?php echo $product->product_name;?></p>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <label for="operator_name"><i class="fa fa-star fa-with" aria-hidden="true"></i><?= __('登録担当者氏名') ?></label>
                    <input id="operator_name" type="text" name="operator_name" class="validate" required="true" value="<?php echo isset($product->operator_name) ? $product->operator_name: ''; ?>" />
                </div>
                <div class="input-field col s6">
                    <label for="operator_department">
                    	<?= __('登録担当者所属・役職') ?>
                    </label>
                    <input id="operator_department" type="text" name="operator_department" class="validate" value="<?php echo isset($product->operator_department) ? $product->operator_department: ''; ?>" />
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <label for="operator_email"><i class="fa fa-star fa-with" aria-hidden="true"></i><?= __('登録担当者メールアドレス') ?></label>
                    <input id="operator_email" type="text" name="operator_email" class="validate" required="true" value="<?php echo isset($product->operator_email) ? $product->operator_email: ''; ?>" />
                </div>
                <div class="input-field col s6">
                    <label for="operator_tel">
                    	<?= __('登録担当者電話番号') ?>
                    </label>
                    <input id="operator_tel" type="text" name="operator_tel" class="validate" value="<?php echo isset($product->operator_tel) ? $product->operator_tel: ''; ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                	<p>
                        <input id="confirm-term" type="checkbox" class="filled-in" onchange="confirmTerm();" />
                        <label for="confirm-term"><a href="#">利用規約</a>に同意する</label>
                    </p>
                </div>
            </div>
            <div class="row">
            	<div class="col s12">
            		<button disabled id="submit" class="submit btn waves-effect waves-light green disabled" type="submit" data-action="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'publish', $product->id]);?>"><?= __('登録') ?></button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
	function confirmTerm(){
		if($('#confirm-term').prop("checked")){
			$('#submit').removeClass('disabled');
			$('#submit').attr('disabled', false);
		}else{
			$('#submit').addClass('disabled');
			$('#submit').attr('disabled', true);
		}
	}
</script>