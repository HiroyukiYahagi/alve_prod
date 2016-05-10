<?php
	
	$this->Csv->clear();
	$this->Csv->addRow($header);

	foreach($data as $row) {
		$this->Csv->addField($row['large_type']);
		$this->Csv->addField($row['medium_type']);
		$this->Csv->addField($row['small_type']);
		$this->Csv->addField($row['item_description']);
		$this->Csv->addField($row['unit']);
		$this->Csv->addField($row['value']);
		$this->Csv->endRow();
	}
	$this->Csv->setFilename($filename);
	echo $this->Csv->render(true, 'utf-8');

?>