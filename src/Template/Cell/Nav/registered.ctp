<li>
	<a href="<?php echo $this->Url->build(["controller" => "Companies", "action" => "view" ]);?>">
	<?php echo $authedCompany->company_name;?>
	</a>
</li>
<li>
	<a href="<?php echo $this->Url->build(["controller" => "Companies", "action" => "view" ]);?>">
		<i class="fa fa-user fa-lg fa-with"></i>マイページ
	</a>
</li>
<li>
	<a href="<?php echo $this->Url->build(["controller" => "Companies", "action" => "logout" ]);?>"><i class="fa fa-sign-out fa-lg fa-with"></i>ログアウト</a>
</li>