<h4><?= __('マイページ') ?></h4>

<div class="row">
	<a href="#" class="waves-effect waves-light btn grey"><?= __('ラベルデータ') ?></a>
	<a href="#" class="waves-effect waves-light btn grey"><?= __('評価結果開示フォーマット') ?></a>
	<a href="#" class="waves-effect waves-light btn grey"><?= __('利用規約') ?></a>
</div>

<div class="row">
	<div class="title-and-item">
		<h5>
			<i class="fa fa-info-circle fa-with" aria-hidden="true"></i>
			<?= __('会社情報') ?>
		</h5>
		<a class="waves-effect waves-light btn green" href='<?php echo $this->Url->build(["action" => "edit", $company->id ]);?>'>
			<i class="fa fa-pencil-square-o fa-with"></i><?= __('会社情報の編集')?>
		</a>
		<a class="waves-effect waves-light btn green" href='<?php echo $this->Url->build(["action" => "editPassword", $company->id ]);?>'>
			<i class="fa fa-key fa-with" aria-hidden="true"></i><?= __('ログイン情報の編集')?>
		</a>
	</div>

	<div class="col s8">
		<div class="card">
			<div class="card-content">
				<div class="title-and-item">
					<h6 class="card-title grey-text text-darken-4"><?php echo $company->company_name; ?></h6>
					<p><?php echo $company->name_kana;?></p>
				</div>

				<label><?= __('ユーザーID') ?></label>
				<p><?php echo $company->user_id;?></p>

				<label><?= __('メールアドレス') ?></label>
				<p><?php echo $company->email;?></p>

				<label><?= __('会社HP URL') ?></label>
				<p><?php echo $company->url;?></p>

				<label><?= __('TEL') ?></label>
				<p><?php echo $company->tel;?></p>
			</div>
		</div>
	</div>

	<div class="col s4">
		<div class="card history-base">
			<div class="card-content">
				<label><?= __('ログイン履歴') ?></label>
				<div class="history-table">
					<table class="white striped">
						<tbody>
							<?php foreach ($loginHistories as $loginHistory): ?>
							<tr>
								<td>
									<?= $this->cell('DateTime', ['type'=> 'datetime', 'data' => $loginHistory->created ])->render();?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>	
	</div>

</div>


<div class="row">
	<div class="title-and-item">
		<h5>
			<i class="fa fa-cog fa-with" aria-hidden="true"></i>
			<?= __('製品評価') ?>
		</h5>
		<a class="waves-effect waves-light btn green" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "selectType" ]);?>'>
			<i class="fa fa-plus fa-with"></i><?= __('新規登録') ?>
		</a>
	</div>
	<div class="card">
		<div class="card-content">
			<div class="title-and-item">
				<h6 class="card-title grey-text text-darken-4">
					<?= __('評価中の製品') ?>
				</h6>
			</div>
			<?php if(isset($editingProducts) && count($editingProducts) != 0): ?>
				<table class="sorter tablesorter white striped z-depth-0 table-for-productlist-edit">
					<thead>
						<tr>
							<th><?= __('製品名') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
							<th><?= __('型番') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
							<th><?= __('最後に保存した日') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
							<th><?= __('作業者') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($editingProducts as $product): ?>
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
								<td>
									<?php echo $product->operator_name; ?>
								</td>
								<td>
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "downloadCsv", $product->id ]);?>' data-delay="10" data-tooltip="<?= __('CSV出力')?>">
										<i class="fa fa-sm fa-file"></i>
									</a>
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "selectType", $product->id ]);?>' data-delay="10" data-tooltip="<?= __('編集')?>">
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
					<?= __('登録済の製品') ?>
				</h6>
			</div>
			<?php if(isset($publishedProducts) && count($publishedProducts) != 0): ?>
				<table class="sorter tablesorter white striped z-depth-0 table-for-productlist">
					<thead>
						<tr>
							<th><?= __('製品名') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
							<th><?= __('型番') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
							<th><?= __('登録日') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
							<th><?= __('登録更新日') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
							<th><?= __('作業者') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
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
									<?= $this->cell('DateTime', ['type'=> 'date', 'data' => $product->register_date ])->render();?>
								</td>
								<td>
									<?= $this->cell('DateTime', ['type'=> 'date', 'data' => $product->register_update_date ])->render();?>
								</td>
								<td><?php echo $product->operator_name; ?></td>
								<td>
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "downloadCsv", $product->id ]);?>' data-delay="10" data-tooltip="<?= __('CSV出力')?>">
										<i class="fa fa-sm fa-file"></i>
									</a>
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "selectType", $product->id ]);?>' data-delay="10" data-tooltip="<?= __('更新')?>">
										<i class="fa fa-sm fa-pencil-square-o"></i>
									</a>
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Products", "action" => "delete", $product->id ]);?>' data-delay="10" data-tooltip="<?= __('削除')?>" onclick="return confirmDelete();" >
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


<div class="row">
	<div class="title-and-item">
		<h5>
			<i class="fa fa-filter fa-with" aria-hidden="true"></i>
			<?= __('しくみ評価') ?>
		</h5>
		<a class="waves-effect waves-light btn green" href='<?php echo $this->Url->build(["controller" => "Fomulas","action" => "edit" ]);?>'>
			<i class="fa fa-plus fa-with"></i><?= __('新規登録') ?>
		</a>
	</div>
	<div class="card">
		<div class="card-content">
			<div class="title-and-item">
				<h6 class="card-title grey-text text-darken-4">
					<?= __('評価中のデータ') ?>
				</h6>
			</div>
			<?php if(isset($editingFomulas) && count($editingFomulas) != 0): ?>
				<table class="sorter tablesorter white striped table-for-fomulalist">
					<thead>
						<tr>
							<th><?= __('最終更新日') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
							<th><?= __('評価期間') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
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
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Fomulas", "action" => "downloadCsv", $fomula->id ]);?>' data-delay="10" data-tooltip="<?= __('CSV出力')?>">
										<i class="fa fa-sm fa-file"></i>
									</a>
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
							<th><?= __('最終更新日') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
							<th><?= __('評価期間') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
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
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Fomulas", "action" => "downloadCsv", $fomula->id ]);?>' data-delay="10" data-tooltip="<?= __('CSV出力')?>">
										<i class="fa fa-sm fa-file"></i>
									</a>
									<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Fomulas", "action" => "edit", $fomula->id ]);?>' data-delay="10" data-tooltip="<?= __('更新')?>"> 
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

