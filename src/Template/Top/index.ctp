
<div class="row">
	<div class="col s12">
		<h4>環境配慮バルブ登録制度について</h4>

		<blockquote>
			下記の通り、日本バル工業会と団体が、ある製品に関して「環境配慮バルブ」ということで製品を認定しています。<br/>
			今回のシステムはその製品を各企業がバルブ工業会の提示した「環境配慮バルブ」の内容に当てはめ、自社製品が何点であるかを取得し、自社ページに表示するものです。<br/>
			<br/>
			その為に、各登録企業がマイページを持ち、製品を登録し完了したものがバルブ工業会のHPにも製品一覧としえて表示されるものです。<br/>
		</blockquote>

		<a class="waves-effect waves-light btn grey">評価項目一覧（PDF）</a>
		<a class="waves-effect waves-light btn grey">環境関連情報等</a>
	</div>
</div>

<div class="start-menu">
	<div class="row">
		<div class="col s12">
			<a href="<?php echo $this->Url->build(["controller" => "Products", "action" => "search" ]);?>" class="waves-effect waves-light btn green ">
				<i class="fa fa-search fa-with"></i>
				製品検索
			</a>
			<blockquote>
			登録されている製品を検索できます。
			</blockquote>
		</div>
	</div>
</div>
<div class="start-menu">
	<div class="row">
		<div class="col s6">
			<a href="<?php echo $this->Url->build(["controller" => "Companies", "action" => "login" ]);?>" class="waves-effect waves-light btn green">
				<i class="fa fa-sign-in fa-with"></i>
				製品登録(正会員のみ)
			</a>
			<blockquote>
			製品登録ができます。(正会員のみ利用可能です)
			</blockquote>
		</div>
	</div>
</div>