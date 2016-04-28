<h4><?= __('Product Search') ?></h4>
<blockquote>
	【ご注意】<br/>
	ここに掲載されている製品は、会員企業が当工業会の定める評価項目に沿ってアセスメントを行い、自社従来製品又は新規設計目標値と比較し、環境側面で改善をしていると自己評価した製品です。<br/>
	会員企業の評価結果に対し、当工業会は一切責任を負いませんので、あらかじめご了承ください。製品についての詳細は、メーカー各社までお問い合わせいただけますよう、お願いいたします。
</blockquote>


<div class="row">
	<div class="card">
		<form method="get" action="<?php echo $this->Url->build(["controller" => "Products", "action" => "search" ]);?>">
			<div class="card-content">

				<div class="row">
					<div class="input-field col s12">
						<input id="condition" type="text" class="validate" name="condition" required>
						<label for="condition"><?= __('Search Conditions') ?></label>
					</div>
				</div>

				<div class="row">
					<div class="input-field col s12">
						<select id="options" multiple name="options">
							<option value="" disabled selected><?= __('Please Select Input Types') ?></option>
							<?php foreach ($types as $type):?>
								<option value="<?php echo $type->id;?>"><?php echo $type->type_name.$type->fomula.$type->purpose;?></option>
							<?php endforeach; ?>
						</select>
						<label><?= __('Product Type') ?></label>
					</div>
				</div>
				
			</div>
			<div class="card-action">
				<button class="btn waves-effect waves-light green" type="submit" name="action"><?= __('Search') ?></button>
			</div>
		</form>
	</div>
</div>

<div class="row">
	<div class="card">
		<div class="card-content">
			<?php if(!isset($results)): ?>
				<p><?= __('Please Input Search Coonditions') ?></p>
			<?php else: ?>
				<table id="sorter" class="tablesorter white striped z-depth-2">
					<thead>
						<tr>
							<th><?= __('ID') ?></th>
							<th><?= __('Registered Date') ?></th>
							<th><?= __('Updated Date') ?></th>
							<th><?= __('Type') ?></th>
							<th><?= __('Manufacturer') ?></th>
							<th><?= __('Product Name') ?></th>
							<th><?= __('Model Number') ?></th>
							<th><?= __('Sale Date') ?></th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($products as $product): ?>
							<tr>
								<td><?php echo $product->product_id;?></td>
								<td><?php echo $product->created;?></td>
								<td><?php echo $product->modified;?></td>
								<td><?php echo $product->type->type_name.$product->type->fomula.$product->type->purpose;?></td>
								<td><?php echo $product->company->name;?></td>
								<td><?php echo $product->product_name;?></td>
								<td><?php echo $product->model_number;?></td>
								<td><?php echo $product->sales_date;?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</tbody>
			</table>

		<?php endif; ?>
	</div>
</div>

