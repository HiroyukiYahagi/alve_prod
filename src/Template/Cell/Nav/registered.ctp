<ul class="right hide-on-med-and-down">
    <li>
    	<a href="<?php echo $this->Url->build(["controller" => "Products", "action" => "search" ]);?>" class="nav-link green-text">
    		<i class="fa fa-search fa-with" ></i>製品検索
    	</a>
    </li>
    <li>
    	<a href="<?php echo $this->Url->build(["controller" => "Companies", "action" => "view" ]);?>" class="nav-link green-text">
			<i class="fa fa-user fa-with" ></i>マイページ
    	</a>
    </li>
    <li>
		<a href="<?php echo $this->Url->build(["controller" => "Companies", "action" => "logout" ]);?>" class="nav-link green-text">
			<i class="fa fa-sign-out fa-with"></i>ログアウト
		</a>
	</li>
</ul>