<h4><?= __('マイページ') ?></h4>

<div class="row">
	<h5>
		<i class="fa fa-info-circle fa-with" aria-hidden="true"></i>
		<?= __('会社情報') ?>
	</h5>
	<div class="card">
		<div class="card-content">
			<div class="title-and-item">
				<h6 class="card-title grey-text text-darken-4"><?php echo $company->company_name; ?></h6>
				<p><?php echo $company->name_kana;?></p>
				<a class="btn-floating btn-large green tooltipped" href='<?php echo $this->Url->build(["action" => "edit", $company->id ]);?>' data-delay="10" data-tooltip="<?= __('編集')?>">
					<i class="fa fa-pencil-square-o"></i>
				</a>
				<a class="btn-floating btn-large green tooltipped" href='<?php echo $this->Url->build(["action" => "editPassword", $company->id ]);?>' data-delay="10" data-tooltip="<?= __('パスワード変更')?>">
					<i class="fa fa-key" aria-hidden="true"></i>
				</a>
			</div>

			<label><?= __('E-mail') ?></label>
			<p><?php echo $company->email;?></p>

			<label><?= __('会社HP URL') ?></label>
			<p><?php echo $company->url;?></p>

			<label><?= __('TEL') ?></label>
			<p><?php echo $company->tel;?></p>
		</div>
		<div class="card-action">
			<a href="#" class="waves-effect waves-light btn grey"><?= __('ラベルデータ') ?></a>
			<a href="#" class="waves-effect waves-light btn grey"><?= __('評価結果開示フォーマット') ?></a>
			<a href="#" class="waves-effect waves-light btn grey"><?= __('利用規約') ?></a>
		</div>
	</div>
</div>


<div class="row">
	<div class="title-and-item">
		<h5>
			<i class="fa fa-cog fa-with" aria-hidden="true"></i>
			<?= __('製品評価') ?>
		</h5>
		<a class="btn-floating btn-large green tooltipped" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "edit" ]);?>' data-delay="10" data-tooltip="<?= __('新規作成')?>">
			<i class="fa fa-plus"></i>
		</a>
	</div>
	<div class="card">
		<div class="card-content">
			<div class="title-and-item">
				<h6 class="card-title grey-text text-darken-4">
					<?= __('保存済みのデータ') ?>
				</h6>
			</div>
			<?php if(isset($editingProducts) && count($editingProducts) != 0): ?>
				<table class="sorter tablesorter white striped z-depth-0 table-for-productlist">
					<thead>
						<tr>
							<th><?= __('製品名') ?></th>
							<th><?= __('型番') ?></th>
							<th><?= __('最終更新日') ?></th>
							<th><?= __('作業者') ?></th>
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
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "edit", $product->id ]);?>' data-delay="10" data-tooltip="<?= __('編集')?>">
										<i class="fa fa-sm fa-pencil-square-o"></i>
									</a>
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "delete", $product->id ]);?>' data-delay="10" data-tooltip="<?= __('削除')?>" onclick="return confirmDelete();">
										<i class="fa fa-sm fa-trash"></i>
									</a>

								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<p><?= __('データがありません。') ?></p>
			<?php endif; ?>
		</div>
		<div class="card-content">
			<div class="title-and-item">
				<h6 class="card-title grey-text text-darken-4">
					<?= __('評価済みのデータ') ?>
				</h6>
			</div>
			<?php if(isset($completedProducts) && count($completedProducts) != 0): ?>
				<table class="sorter tablesorter white striped z-depth-0 table-for-productlist">
					<thead>
						<tr>
							<th><?= __('製品名') ?></th>
							<th><?= __('型番') ?></th>
							<th><?= __('最終更新日') ?></th>
							<th><?= __('作業者') ?></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($completedProducts as $product): ?>
							<tr>
								<td>
									<a href='<?php echo $this->Url->build(["controller" => "Products", "action" => "view", $product->id ]);?>'>
										<?php echo $product->product_name; ?>
									</a>
								</td>
								<td><?php echo $product->model_number; ?></td>
								<td>
									<?= $this->cell('DateTime', ['type'=> 'datetime', 'data' => $product->modified ])->render();?>
								</td>
								<td><?php echo $product->operator_name; ?></td>
								<td>
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "edit", $product->id ]);?>' data-delay="10" data-tooltip="<?= __('編集')?>">
										<i class="fa fa-sm fa-pencil-square-o"></i>
									</a>
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "delete", $product->id ]);?>' data-delay="10" data-tooltip="<?= __('削除')?>" onclick="return confirmDelete();">
										<i class="fa fa-sm fa-trash"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<p><?= __('データがありません。') ?></p>
			<?php endif; ?>
		</div>
		<div class="card-content">
			<div class="title-and-item">
				<h6 class="card-title grey-text text-darken-4">
					<?= __('公開中のデータ') ?>
				</h6>
			</div>
			<?php if(isset($publishedProducts) && count($publishedProducts) != 0): ?>
				<table class="sorter tablesorter white striped z-depth-0 table-for-productlist">
					<thead>
						<tr>
							<th><?= __('製品名') ?></th>
							<th><?= __('型番') ?></th>
							<th><?= __('最終更新日') ?></th>
							<th><?= __('作業者') ?></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($publishedProducts as $product): ?>
							<tr>
								<td>
									<a href='<?php echo $this->Url->build(["controller" => "Products", "action" => "view", $product->id ]);?>'>
										<?php echo $product->product_name; ?>
									</a>
								</td>
								<td><?php echo $product->model_number; ?></td>
								<td>
									<?= $this->cell('DateTime', ['type'=> 'datetime', 'data' => $product->modified ])->render();?>
								</td>
								<td><?php echo $product->operator_name; ?></td>
								<td>
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "edit", $product->id ]);?>' data-delay="10" data-tooltip="<?= __('編集')?>">
										<i class="fa fa-sm fa-pencil-square-o"></i>
									</a>
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "unpublish", $product->id ]);?>' data-delay="10" data-tooltip="<?= __('非公開')?>">
										<i class="fa fa-sm fa-undo"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<p><?= __('データがありません。') ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>


<div class="row">
	<div class="title-and-item">
		<h5>
			<i class="fa fa-filter fa-with" aria-hidden="true"></i>
			<?= __('しくみ評価') ?>
		</h5>
		<a class="btn-floating btn-large green tooltipped" href='<?php echo $this->Url->build(["controller" => "Fomulas","action" => "edit" ]);?>' data-delay="10" data-tooltip="<?= __('新規作成')?>">
			<i class="fa fa-plus"></i>
		</a>
	</div>
	<div class="card">
		<div class="card-content">
			<div class="title-and-item">
				<h6 class="card-title grey-text text-darken-4">
					<?= __('保存済みのデータ') ?>
				</h6>
			</div>
			<?php if(isset($editingFomulas) && count($editingFomulas) != 0): ?>
				<table class="sorter tablesorter white striped table-for-fomulalist">
					<thead>
						<tr>
							<th><?= __('最終更新日') ?></th>
							<th><?= __('評価期間') ?></th>
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
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Fomulas", "action" => "edit", $fomula->id ]);?>' data-delay="10" data-tooltip="<?= __('編集')?>">
										<i class="fa fa-sm fa-pencil-square-o"></i>
									</a>
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Fomulas", "action" => "delete", $fomula->id ]);?>' data-delay="10" data-tooltip="<?= __('削除')?>" onclick="return confirmDelete();">
										<i class="fa fa-sm fa-trash"></i>
									</a>

								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<p><?= __('データがありません。') ?></p>
			<?php endif; ?>
		</div>
		<div class="card-content">
			<div class="title-and-item">
				<h6 class="card-title grey-text text-darken-4">
					<?= __('評価済みのデータ') ?>
				</h6>
			</div>
			<?php if(isset($completedFomulas) && count($completedFomulas) != 0): ?>
				<table class="sorter tablesorter white striped table-for-fomulalist">
					<thead>
						<tr>
							<th><?= __('最終更新日') ?></th>
							<th><?= __('評価期間') ?></th>
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
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Fomulas", "action" => "edit", $fomula->id ]);?>' data-delay="10" data-tooltip="<?= __('編集')?>"> 
										<i class="fa fa-sm fa-pencil-square-o"></i>
									</a>
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Fomulas", "action" => "delete", $fomula->id ]);?>' data-delay="10" data-tooltip="<?= __('削除')?>" onclick="return confirmDelete();">
										<i class="fa fa-sm fa-trash"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<p><?= __('データがありません。') ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>

