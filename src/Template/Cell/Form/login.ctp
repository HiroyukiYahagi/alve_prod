<div class="card">
	<div class="card-content">
		<form action="<?php echo $data['action'];?>" method="post">
			<div class="row">
				<div class="input-field col s12">
					<input id="email" type="email" class="validate" required>
					<label for="email" data-error="XXXX@XXXと入力してください">Email</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input id="password" type="password" class="validate" minlength="8" required>
					<label for="password">Password 8文字以上入力してください</label>
				</div>
			</div>
			<button class="btn waves-effect waves-light green" type="submit" name="action">送信</button>
		</form>
	</div>
</div>
