<h4><?= __('製品登録完了')?></h4>

<blockquote>
    環境配慮バルブ制度への製品登録が完了しました。<br/>
    当該製品が登録されているか<a href="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'search']);?>">「製品検索」</a>でご確認ください。
</blockquote>

<a class="waves-effect waves-light btn green" href='<?php echo $this->Url->build(["controller" => "Companies", "action" => "view" ]);?>' >
	<?= __('マイページに戻る') ?>
</a>