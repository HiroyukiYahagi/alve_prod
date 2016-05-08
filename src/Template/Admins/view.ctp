<h4><?= __('Admin Page') ?></h4>

<div class="row">
	<div class="title-and-item">
		<h5>
			<i class="fa fa-info-circle fa-with" aria-hidden="true"></i>
			<?= __('Administrator Infomation') ?>
		</h5>
		<a class="btn-floating btn-large green" href='<?php echo $this->Url->build(["controller" => "Admins", "action" => "edit" , $admin->id ]);?>'>
			<i class="fa fa-pencil-square-o"></i>
		</a>
	</div>
	<div class="card">
		<div class="card-content">
			<label><?= __('User Name') ?></label>
			<p><?php echo $admin->username;?></p>
		</div>
		<div class="card-action">
			<a href="<?php echo $this->Url->build(["controller" => "Admins", "action" => "logout"]);?>" class="waves-effect waves-light btn grey"><?= __('Logout') ?></a>
		</div>
	</div>
</div>

<div class="row">
	<h5>
		<i class="fa fa-info-circle fa-with" aria-hidden="true"></i>
		<?= __('Registered Company Infomation') ?>
	</h5>	

	 <table class="table-for-companieslist sorter tablesorter white striped z-depth-2">
        <thead>
            <tr>
                <th><?= __('ID') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
                <th><?= __('Company Name') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
                <th><?= __('Email') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
                <th><?= __('Actions') ?></th>
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
						<a class="btn-floating btn grey" href='<?php echo $this->Url->build(["controller" => "Admins", "action" => "editCompany", $company->id ]);?>'>
							<i class="fa fa-sm fa-pencil-square-o"></i>
						</a>
						<a class="btn-floating btn grey" href='<?php echo $this->Url->build(["controller" => "Admins", "action" => "deleteCompany", $company->id ]);?>'>
							<i class="fa fa-sm fa-trash"></i>
						</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
