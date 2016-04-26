<h4><?= __('Product Search') ?></h4>
<blockquote>
	【ご注意】<br/>
	ここに掲載されている製品は、会員企業が当工業会の定める評価項目に沿ってアセスメントを行い、自社従来製品又は新規設計目標値と比較し、環境側面で改善をしていると自己評価した製品です。<br/>
	会員企業の評価結果に対し、当工業会は一切責任を負いませんので、あらかじめご了承ください。製品についての詳細は、メーカー各社までお問い合わせいただけますよう、お願いいたします。
</blockquote>


<div class="content">
	<h5>
		<i class="fa fa-info-circle fa-with" aria-hidden="true"></i>
		<?= __('Company Infomation') ?>
	</h5>
	<div class="card">
		<form method="get" action="<?php echo $this->Url->build(["controller" => "Products", "action" => "search" ]);?>">
			<div class="card-content">
				
				<label for="condition"><?= __('Search Condition') ?></label>
				<input placeholder="<?= __('Please Inpu Search Conditions') ?>" id="condition" type="text" class="validate" name="condition" required>

				<label for="options"><?= __('Product Type') ?></label>
				<select id="options" multiple name="options">
					<option value="" disabled selected><?= __('Please Select Input Types') ?></option>
					<?php foreach ($types as $type):?>
						<option value="<?php echo $type->id;?>"><?php echo $type->type_name.$type->fomula.$type->purpose;?></option>
					<?php endforeach; ?>
				</select>

				
			</div>
			<div class="card-action">
				<button class="btn waves-effect waves-light green" type="submit" name="action"><?= __('Search') ?></button>
			</div>
		</form>
	</div>
</div>


<div class="content">
	<h5>
		<i class="fa fa-info-circle fa-with" aria-hidden="true"></i>
		<?= __('Company Infomation') ?>
	</h5>
	<div class="card">
		<form method="get" action="<?php echo $this->Url->build(["controller" => "Products", "action" => "search" ]);?>">
			<div class="card-content">
				
				<label for="condition"><?= __('Search Condition') ?></label>
				<input placeholder="<?= __('Please Inpu Search Conditions') ?>" id="condition" type="text" class="validate" name="condition" required>

				<label for="options"><?= __('Product Type') ?></label>
				<select id="options" multiple name="options">
					<option value="" disabled selected><?= __('Please Select Input Types') ?></option>
					<?php foreach ($types as $type):?>
						<option value="<?php echo $type->id;?>"><?php echo $type->type_name.$type->fomula.$type->purpose;?></option>
					<?php endforeach; ?>
				</select>

				
			</div>
			<div class="card-action">
				<button class="btn waves-effect waves-light green" type="submit" name="action"><?= __('Search') ?></button>
			</div>
		</form>
	</div>
</div>

