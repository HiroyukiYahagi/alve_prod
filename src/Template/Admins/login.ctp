<h4>管理者ログイン</h4>

<div class="card">
	<div class="card-content">
		<form action="<?php echo $this->Url->build(['controller' => 'Admins', 'action' => 'login']);?>" method="post">
			<div class="row">
				<div class="input-field col s12">
					<input id="username" name="username" type="text" class="validate" required>
					<label for="username">ユーザ名</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="password" name="password" type="password" class="validate" required>
					<label for="password">パスワード</label>
				</div>
			</div>
			<button class="btn waves-effect waves-light green" type="submit" name="action">送信</button>
		</form>
	</div>
</div>