<?php
	
	$this->Csv->clear();

	$this->Csv->addRow($companyInfo);

	$this->Csv->addRow($header);

	foreach($data as $row) {
		$this->Csv->addField($row['large_type']);
		$this->Csv->addField($row['medium_type']);
		$this->Csv->addField($row['small_type']);
		$this->Csv->addField($row['item_description']);
		$this->Csv->addField($row['unit']);
		$this->Csv->addField($row['value']);
		$this->Csv->addField($row['compared_value']);
		$this->Csv->addField($row['option']);
		$this->Csv->endRow();
	}
	$this->Csv->setFilename($filename);
	//echo $this->Csv->render(true, 'utf-8');
	echo $this->Csv->render(true, 'SJIS');
?>