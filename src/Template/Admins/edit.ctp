<h4><?= __('Edit Administorator')?></h4>

<div class="card">
	<div class="card-content">
		<form action="<?php echo $this->Url->build(['controller' => 'Admins', 'action' => 'edit', $admin->id ]);?>" method="post">
			<div class="row">
				<div class="input-field col s12">
					<input id="username" name="username" type="text" class="validate" required value="<?php echo $admin->username;?>">
					<label for="username">UserName</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="password" name="password" type="password" class="validate" required value="<?php echo $admin->password;?>">
					<label for="password">Password</label>
				</div>
			</div>
			<button class="btn waves-effect waves-light green" type="submit" name="action">送信</button>
		</form>
	</div>
</div>