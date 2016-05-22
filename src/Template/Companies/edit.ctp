<h4><?= __('会社情報の編集') ?></h4>

<div class="content">
    <div class="card">
        <form action='<?php echo $this->Url->build(["action" => "edit", $company->id ]);?>' method='post'>
            <div class="card-content">
                <div class="row">
                    <div class="input text">
                        <label for="company-name" class="active"><?= __('会社名') ?></label>
                        <input type="text" name="company_name" maxlength="256" id="company-name" value="<?php echo $company->company_name;?>">
                    </div>
                    <div class="input text">
                        <label for="name_kana" class="active"><?= __('会社名 (カナ) ※カブシキガイシャ等の法人格は不必要です') ?></label>
                        <input type="text" name="name_kana" maxlength="256" id="name_kana" value="<?php echo $company->name_kana;?>">
                    </div>
                    <div class="input email">
                        <label for="email" class="active"><?= __('ログインID(メールアドレス)') ?></label>
                        <input type="email" name="email" maxlength="256" id="email" value="<?php echo $company->email;?>">
                    </div>
                    <div class="input textarea">
                        <label for="url" class="active"><?= __('会社HP URL') ?></label>
                        <input type="text" name="url" id="url" value="<?php echo $company->url;?>">
                    </div>
                    <div class="input tel">
                        <label for="tel" class="active"><?= __('TEL') ?></label>
                        <input type="tel" name="tel" maxlength="256" id="tel" value="<?php echo $company->tel;?>">
                    </div>
                </div>
            </div>
            <div class="card-action">
                <button class="btn waves-effect waves-light green" type="submit" name="action">送信</button>
            </div>
        </form>
    </div>
</div>



