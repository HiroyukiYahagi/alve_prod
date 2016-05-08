<h4><?= __('Reset Password')?></h4>

<div class="card">
	<div class="card-content">
		<form action="<?php echo $this->Url->build(['controller' => 'Admins', 'action' => 'editCompany', $company->id ]);?>" method="post">
			<div class="row">
				<div class="col s12">
					<label for="username">Company Name</label>
					<p id="username"><?php echo $company->company_name;?></p>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="password" name="password" type="password" class="validate" required value="<?php echo $company->password;?>">
					<label for="password">Password</label>
				</div>
			</div>
			<button class="btn waves-effect waves-light green" type="submit" name="action">送信</button>
		</form>
	</div>
</div>