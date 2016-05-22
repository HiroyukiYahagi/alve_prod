<h4><?= __('パスワードのリセット')?></h4>

<div class="card">
	<div class="card-content">
		<form action="<?php echo $this->Url->build(['controller' => 'Admins', 'action' => 'editCompany', $company->id ]);?>" method="post">
			<div class="row">
				<div class="col s12">
					<label for="username">会社名</label>
					<p id="username"><?php echo $company->company_name;?></p>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="password" name="password" type="password" class="validate" required value="<?php echo $company->password;?>">
					<label for="password">パスワード</label>
				</div>
			</div>
			<button class="btn waves-effect waves-light green" type="submit" name="action" onclick="return confirmSend();">送信</button>
		</form>
	</div>
</div>