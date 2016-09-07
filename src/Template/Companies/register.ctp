<h4>新規登録</h4>

<div class="card">
	<div class="card-content">
		<form action="<?php echo $this->Url->build(['controller' => 'Companies', 'action' => 'register']);?>" method="post">
			<div class="row">
				<div class="input-field col s12">
					<input id="company_name" name="company_name" type="text" class="validate" required>
					<label for="company_name">会社名</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="email" name="email" type="email" class="validate" required>
					<label for="email">メールアドレス</label>
				</div>
			</div>
			<button class="btn waves-effect waves-light green" type="submit" name="action">送信</button>
		</form>
	</div>
</div>