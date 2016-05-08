<h4><?= __('My Page') ?></h4>

<div class="row">
	<h5>
		<i class="fa fa-info-circle fa-with" aria-hidden="true"></i>
		<?= __('Company Infomation') ?>
	</h5>
	<div class="card">
		<div class="card-content">
			<div class="title-and-item">
				<h6 class="card-title grey-text text-darken-4"><?php echo $company->company_name; ?></h6>
				<p><?php echo $company->name_kana;?></p>
				<a class="btn-floating btn-large green" href='<?php echo $this->Url->build(["action" => "edit", $company->id ]);?>'>
					<i class="fa fa-pencil-square-o"></i>
				</a>
				<a class="btn-floating btn-large green" href='<?php echo $this->Url->build(["action" => "editPassword", $company->id ]);?>'>
					<i class="fa fa-key" aria-hidden="true"></i>
				</a>
			</div>

			<label><?= __('E-mail') ?></label>
			<p><?php echo $company->email;?></p>

			<label><?= __('URL') ?></label>
			<p><?php echo $company->url;?></p>

			<label><?= __('TEL') ?></label>
			<p><?php echo $company->tel;?></p>
		</div>
		<div class="card-action">
			<a href="#" class="waves-effect waves-light btn grey"><?= __('Label Download') ?></a>
			<a href="#" class="waves-effect waves-light btn grey"><?= __('Disclosure Request') ?></a>
			<a href="#" class="waves-effect waves-light btn grey"><?= __('Terms of service') ?></a>
		</div>
	</div>
</div>


<div class="row">
	<div class="title-and-item">
		<h5>
			<i class="fa fa-cog fa-with" aria-hidden="true"></i>
			<?= __('Product Evaluation') ?>
		</h5>
		<a class="btn-floating btn-large green" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "edit" ]);?>'>
			<i class="fa fa-plus"></i>
		</a>
	</div>
	<div class="card">
		<div class="card-content">
			<div class="title-and-item">
				<h6 class="card-title grey-text text-darken-4">
					<?= __('Saved Data') ?>
				</h6>
			</div>
			<?php if(isset($editingProducts) && count($editingProducts) != 0): ?>
				<table class="sorter tablesorter white striped z-depth-0 table-for-productlist">
					<thead>
						<tr>
							<th><?= __('Product Name') ?></th>
							<th><?= __('Model Number') ?></th>
							<th><?= __('Save Date') ?></th>
							<th><?= __('In Charge') ?></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($editingProducts as $product): ?>
							<tr>
								<td>
									<?php echo $product->product_name; ?>
								</td>
								<td><?php echo $product->model_number; ?></td>
								<td>
									<?= $this->cell('DateTime', ['type'=> 'datetime', 'data' => $product->modified ])->render();?>
								</td>
								<td><?php echo $product->operator_name; ?></td>
								<td>
									<a class="btn-floating btn grey" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "edit", $product->id ]);?>'>
										<i class="fa fa-sm fa-pencil-square-o"></i>
									</a>
									<a class="btn-floating btn grey" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "delete", $product->id ]);?>'>
										<i class="fa fa-sm fa-trash"></i>
									</a>

								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<p><?= __('There is no data.') ?></p>
			<?php endif; ?>
		</div>
		<div class="card-content">
			<div class="title-and-item">
				<h6 class="card-title grey-text text-darken-4">
					<?= __('Published Data') ?>
				</h6>
			</div>
			<?php if(isset($completedProducts) && count($completedProducts) != 0): ?>
				<table class="sorter tablesorter white striped z-depth-0 table-for-productlist">
					<thead>
						<tr>
							<th><?= __('Product Name') ?></th>
							<th><?= __('Model Number') ?></th>
							<th><?= __('Save Date') ?></th>
							<th><?= __('In Charge') ?></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($completedProducts as $product): ?>
							<tr>
								<td>								<a href='<?php echo $this->Url->build(["controller" => "Products", "action" => "view", $product->id ]);?>'>
										<?php echo $product->product_name; ?>
									</a>
								</td>
								<td><?php echo $product->model_number; ?></td>
								<td>
									<?= $this->cell('DateTime', ['type'=> 'datetime', 'data' => $product->modified ])->render();?>
								</td>
								<td><?php echo $product->operator_name; ?></td>
								<td>
									<a class="btn-floating btn grey" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "edit", $product->id ]);?>'>
										<i class="fa fa-sm fa-pencil-square-o"></i>
									</a>
									<a class="btn-floating btn grey" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "unpublish", $product->id ]);?>'>
										<i class="fa fa-sm fa-undo"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<p><?= __('There is no data.') ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>


<div class="row">
	<div class="title-and-item">
		<h5>
			<i class="fa fa-filter fa-with" aria-hidden="true"></i>
			<?= __('Folumas Evaluation') ?>
		</h5>
		<a class="btn-floating btn-large green" href='<?php echo $this->Url->build(["controller" => "Fomulas","action" => "edit" ]);?>'>
			<i class="fa fa-plus"></i>
		</a>
	</div>
	<div class="card">
		<div class="card-content">
			<div class="title-and-item">
				<h6 class="card-title grey-text text-darken-4">
					<?= __('Saved Data') ?>
				</h6>
			</div>
			<?php if(isset($editingFomulas) && count($editingFomulas) != 0): ?>
				<table class="sorter tablesorter white striped table-for-fomulalist">
					<thead>
						<tr>
							<th><?= __('Save Date') ?></th>
							<th><?= __('Period') ?></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($editingFomulas as $fomula): ?>
							<tr>
								<td>
									<?= $this->cell('DateTime', ['type'=> 'datetime', 'data' => $fomula->modified ])->render();?>
								</td>
								<td>
									<?= $this->cell('DateTime', ['type'=> 'date', 'data' => $fomula->fomula_start ])->render();?>~<?= $this->cell('DateTime', ['type'=> 'date', 'data' => $fomula->fomula_end ])->render();?>
								</td>
								<td>
									<a class="btn-floating btn grey" href='<?php echo $this->Url->build(["controller" => "Fomulas", "action" => "edit", $fomula->id ]);?>'>
										<i class="fa fa-sm fa-pencil-square-o"></i>
									</a>
									<a class="btn-floating btn grey" href='<?php echo $this->Url->build(["controller" => "Fomulas", "action" => "delete", $fomula->id ]);?>'>
										<i class="fa fa-sm fa-trash"></i>
									</a>

								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<p><?= __('There is no data.') ?></p>
			<?php endif; ?>
		</div>
		<div class="card-content">
			<div class="title-and-item">
				<h6 class="card-title grey-text text-darken-4">
					<?= __('Published Data') ?>
				</h6>
			</div>
			<?php if(isset($completedFomulas) && count($completedFomulas) != 0): ?>
				<table class="sorter tablesorter white striped table-for-fomulalist">
					<thead>
						<tr>
							<th><?= __('Save Date') ?></th>
							<th><?= __('Period') ?></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($completedFomulas as $fomula): ?>
							<tr>
								<td>
									<a href='<?php echo $this->Url->build(["controller" => "Fomulas", "action" => "view", $fomula->id ]);?>'>
									<?= $this->cell('DateTime', ['type'=> 'datetime', 'data' => $fomula->modified ])->render();?>
									</a>
								</td>
								<td>
									<?= $this->cell('DateTime', ['type'=> 'date', 'data' => $fomula->fomula_start ])->render();?>~<?= $this->cell('DateTime', ['type'=> 'date', 'data' => $fomula->fomula_end ])->render();?>
								</td>
								<td>
									<a class="btn-floating btn grey" href='<?php echo $this->Url->build(["controller" => "Fomulas", "action" => "edit", $fomula->id ]);?>'>
										<i class="fa fa-sm fa-pencil-square-o"></i>
									</a>
									<a class="btn-floating btn grey" href='<?php echo $this->Url->build(["controller" => "Fomulas", "action" => "unpublish", $fomula->id ]);?>'>
										<i class="fa fa-sm fa-undo"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<p><?= __('There is no data.') ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>

