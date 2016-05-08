<h4><?= __('Reset Password')?></h4>

<div class="card">
	<div class="card-content">
		<form action="<?php echo $this->Url->build(['controller' => 'Companies', 'action' => 'editPassword', $company->id ]);?>" method="post">
			<div class="row">
				<div class="input-field col s12">
					<input id="password" name="password" type="password" class="validate" required>
					<label for="password">Password</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="password-again" name="password-again" type="password" class="validate" required>
					<label for="password-again">Password Again</label>
				</div>
			</div>
			<button class="btn waves-effect waves-light green" type="submit" name="action">送信</button>
		</form>
	</div>
</div>