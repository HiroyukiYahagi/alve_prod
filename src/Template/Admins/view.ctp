<h4><?= __('管理ページ') ?></h4>

<div class="row">
	<div class="title-and-item">
		<h5>
			<i class="fa fa-info-circle fa-with" aria-hidden="true"></i>
			<?= __('管理者情報') ?>
		</h5>
		<a class="btn-floating btn-large green tooltipped" href='<?php echo $this->Url->build(["controller" => "Admins", "action" => "edit" , $admin->id ]);?>' data-delay="10" data-tooltip="<?= __('編集')?>">
			<i class="fa fa-pencil-square-o"></i>
		</a>
	</div>
	<div class="card">
		<div class="card-content">
			<label><?= __('ユーザ名') ?></label>
			<p><?php echo $admin->username;?></p>
		</div>
		<div class="card-action">
			<a href="<?php echo $this->Url->build(["controller" => "Admins", "action" => "logout"]);?>" class="waves-effect waves-light btn grey"><?= __('ログアウト') ?></a>
		</div>
	</div>
</div>

<div class="row">
	<div class="title-and-item">
		<h5>
			<i class="fa fa-info-circle fa-with" aria-hidden="true"></i>
			<?= __('会社一覧') ?>
		</h5>	
		<a class="btn-floating btn-large green tooltipped" href='<?php echo $this->Url->build(["action" => "addCompany" ]);?>' data-delay="10" data-tooltip="<?= __('新規作成')?>">
			<i class="fa fa-plus"></i>
		</a>
	</div>
	 <table class="table-for-companieslist sorter tablesorter white striped z-depth-2">
        <thead>
            <tr>
                <th><?= __('ID') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
                <th><?= __('会社名') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
                <th><?= __('Email') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($companies as $company): ?>
                <tr>
                    <td>
                       <?php echo $company->id;?>
                    </td>
                    <td>
                    	<?php echo $company->company_name;?>
                    </td>
                    <td>
						<?php echo $company->email;?>  
                    </td>
                    <td>
						<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Admins", "action" => "editCompany", $company->id ]);?>' data-delay="10" data-tooltip="<?= __('パスワード変更')?>">
							<i class="fa fa-sm fa-key"></i>
						</a>
						<a class="btn-floating btn grey tooltipped" href='<?php echo $this->Url->build(["controller" => "Admins", "action" => "deleteCompany", $company->id ]);?>' data-delay="10" data-tooltip="<?= __('削除')?>" onclick="return confirmDelete();">
							<i class="fa fa-sm fa-trash"></i>
						</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
