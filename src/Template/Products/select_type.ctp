<h4><?= __('製品評価') ?></h4>

<div class="content">
	<div class="card">
		<form action='<?php echo $this->Url->build(["action" => "edit", isset($product->id) ? $product->id : null ]);?>' method='post'>
			<div class="card-content">
				<div class="row">
					<div class="input-field col s4">
						<select id="types" name="type_id" required>
							<option value="" disabled selected><?= __('製品種別を選択してください') ?></option>
							<?php foreach ($types as $type):?>
								<option value="<?php echo $type->id;?>" <?php echo isset($product)&&($type->id==$product->type_id) ? 'selected': ''; ?> ><?php echo $type->type_name.$type->fomula.$type->purpose;?></option>
							<?php endforeach; ?>
						</select>
						<label><i class="fa fa-star fa-with" aria-hidden="true"></i><?= __('製品種別') ?></label>
					</div>
				</div>
				<button class="btn waves-effect waves-light green" type="submit" name="action">評価へ進む</button>
			</div>
		</form>
	</div>
</div>