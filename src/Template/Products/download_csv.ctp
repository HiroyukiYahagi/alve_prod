<?php

// ヘッダー行設定
$this->Csv->clear();
$this->Csv->addRow($th);
foreach($td as $t) {
	$this->Csv->addField($t['Test']['id']);
	$this->Csv->addField($t['Test']['username']);
	$this->Csv->endRow();
}
$this->Csv->setFilename($filename);
echo $this->Csv->render(true, 'utf-8');

?>