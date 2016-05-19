<h4>ログイン</h4>


<div class="card">
	<div class="card-content">
		<form action="<?php echo $this->Url->build(['controller' => 'Companies', 'action' => 'login']);?>" method="post">
			<div class="row">
				<div class="input-field col s12">
					<input id="email" name="email" type="email" class="validate" required>
					<label for="email" data-error="XXXX@XXXと入力してください">メールアドレス</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="password" name="password" type="password" class="validate"  required>
					<label for="password">パスワード</label>
				</div>
			</div>
			<button class="btn waves-effect waves-light green" type="submit" name="action">送信</button>
		</form>
	</div>
</div>


<a href="<?php echo $this->Url->build(['controller' => 'Companies', 'action' => 'resetPassword']);?>">
	パスワードをお忘れの方はこちら
</a>