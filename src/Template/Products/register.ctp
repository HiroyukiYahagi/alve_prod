<h4><?= __('評価方法結果開示シート掲載内容の確認') ?></h4>
<blockquote>
    <?= __('評価結果開示シートには次の内容が記載されます。')?>
</blockquote>

<div class="row">
    <div class="col s12">
        <h5>
            <i class="fa fa-cog fa-with" aria-hidden="true"></i>
            <?= __('製品情報') ?>
        </h5>
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s6">
                        <label>
                            <?= __('登録日') ?>
                        </label>
                        <p><?php echo $product->register_date;?></p>
                    </div>
                    <div class="col s6">
                        <label>
                            <?= __('最新の登録更新日') ?>
                        </label>
                        <p><?php echo $product->register_update_date;?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <label>
                            <?= __('メーカー名') ?>
                        </label>
                        <p><?php echo $product->company->company_name;?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <h6>
                            <b><?= __('評価対象製品') ?></b>
                        </h6>
                        <div class="row">
                            <div class="col s4">
                                <label>
                                    <?= __('製品名') ?>
                                </label>
                                <p><?php echo $product->product_name;?></p>
                            </div>
                            <div class="col s4">
                                <label>
                                    <?= __('型番') ?>
                                </label>
                                <p><?php echo $product->model_number;?></p>
                            </div>
                            <div class="col s4">
                                <label>
                                    <?= __('発売時期') ?>
                                </label>
                                <p>
                                    <?= $this->cell('DateTime', ['type'=> 'date', 'data' => $product->sales_date ])->render();?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <?php if($evaluation_type): ?>
                <div class="row">
                    <div class="col s12">
                        <h6>
                            <b><?= __('比較対象製品') ?></b>
                        </h6>
                        <div class="row">
                            <div class="col s4">
                                <label>
                                    <?= __('製品名') ?>
                                </label>
                                <p><?php echo $product->evaluations[0]->compared_product_name;?></p>
                            </div>
                            <div class="col s4">
                                <label>
                                    <?= __('型番') ?>
                                </label>
                                <p><?php echo $product->evaluations[0]->compared_model_number;?></p>
                            </div>
                            <div class="col s4">
                                <label>
                                    <?= __('発売時期') ?>
                                </label>
                                <p>
                                    <?= $this->cell('DateTime', ['type'=> 'date', 'data' => $product->evaluations[0]->compared_sales_date])->render();?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="row">
                    <div class="col s12">
                        <h6>
                            <b><?= __('比較対象') ?></b>
                        </h6>
                        <div class="row">
                            <div class="col s12">
                                <p>新規設計目標値と比較</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col s12">
                        <label>
                            <?= __('製品説明') ?>
                        </label>
                        <p><?php echo $product->product_comment;?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        <label>
                            <?= __('登録更新内容') ?>
                        </label>
                        <p><?php echo $product->update_comment;?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        <label>
                            <?= __('製品情報') ?>
                        </label>
                        <p><?php echo $product->product_info_url;?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        <h6>
                            <?= __('お問い合わせ') ?>
                        </h6>
                        <div class="row">
                            <div class="col s6">
                                <label>
                                    <?= __('URL') ?>
                                </label>
                                <p><?php echo $product->company->tel;?></p>
                            </div>
                            <div class="col s6">
                                <label>
                                    <?= __('TEL') ?>
                                </label>
                                <p><?php echo $product->company->url;?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="row">
    <div class="col s12">
        <h5>
            <i class="fa fa-file fa-with" aria-hidden="true"></i>
            <?= __('評価項目') ?>
        </h5>
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12">
                        <label>
                            <?= __('改善した評価項目として開示する項目') ?>
                        </label>
                        <?php foreach ($evaluationHeads as $key => $evaluationHead):?>
                            <p><?php echo $key+1;?>:<?php echo $evaluationHead->item_description;?></p>

                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <label>
                            <?= __('製品評価に関する備考') ?>
                        </label>
                        <p>
                            <?php echo $product->model_comment;?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<blockquote>
    以上の内容でよろしければ「PDFダウンロード」をクリックし、自社ホームページにPDFを掲載してください。<br/>
    PDFダウンロードが完了した後、「製品登録」をクリックし、次の手順に進んでください。<br/>
    掲載内容を修正する場合は「製品評価に戻る」をクリックしてください。
</blockquote>

<form target="_blank" method="post" action="<?php echo $this->Url->build(["action" => "createPdf", $product->id ]);?>">
    <?php foreach ($evaluationHeads as $key => $evaluationHead):?>
        <input type="hidden" name="evaluationHeads[]" value="<?php echo $evaluationHead->item_description; ?>">
    <?php endforeach; ?>
    <button type="submit" class="waves-effect waves-light btn grey">
        <i class="fa fa-file fa-with"></i><?= __('PDFダウンロード') ?>
    </button>
</form>


<div class="row fixed-button">
    <a class="waves-effect waves-light btn green" href='<?php echo $this->Url->build(["action" => "selectType", $product->id ]);?>' >
        <i class="fa fa-pencil-square-o fa-with"></i><?= __('製品評価に戻る') ?>
    </a>
    <a class="waves-effect waves-light btn green" href='<?php echo $this->Url->build(["action" => "confirm", $product->id ]);?>' >
        <?= __('製品登録') ?>
    </a>
</div>
