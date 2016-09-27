<?php
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8');
$pdf->SetFont('kozgopromedium');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->AddPage();

if(isset($product->register_date)){
	$createDate = $product->register_date->i18nFormat('yyyy-MM-dd', 'Asia/Tokyo', 'ja-JP');
}else{
	$createDate = '';
}
if(isset($product->register_update_date)){
	$modifiedDate = $product->register_update_date->i18nFormat('yyyy-MM-dd', 'Asia/Tokyo', 'ja-JP');
}else{
	$modifiedDate = '';
}

$companyName = $product->company->company_name;
$productName = $product->product_name;
$modelNumber = $product->model_number;
$salesDate = $product->sales_date->i18nFormat('yyyy-MM-dd', 'Asia/Tokyo', 'ja-JP');
$productInfoUrl = $product->product_info_url;
$productTel = $product->product_tel;
$tel = $product->company->tel;
$url = $product->company->url;
$latestFomula = $product->latest_fomula->i18nFormat('yyyy-MM-dd', 'Asia/Tokyo', 'ja-JP');
$evalCount = count($evaluationHeadsText);
$type = $product->type->type_name;



if(!is_null($product->evaluations[0]->compared_product_name) 
	&& strlen($product->evaluations[0]->compared_product_name) > 0 ){
	$productNameComp = $product->evaluations[0]->compared_product_name;
	$modelNumberComp = $product->evaluations[0]->compared_model_number;
	$salesDateComp = $product->evaluations[0]->compared_sales_date->i18nFormat('yyyy', 'Asia/Tokyo', 'ja-JP').'年';
}else{
 	$productNameComp = '新規設計目標値と比較';
	$modelNumberComp = '';
	$salesDateComp = '';
}

$html = <<< EOF
<!DOCTYPE html>
<html>
<head>
	<
</head>
<body>
<table border="1" cellspacing="0" cellpadding="5">
	<tbody>
		<tr>
			<td colspan="6" style="text-align: center;background-color:black;color:white;">一般社団法人日本バルブ工業会 環境配慮バルブ登録制度 登録情報</td>
		</tr>
		<tr>
			<td colspan="1" style="text-align: center;">登録日</td>
			<td colspan="2">$createDate</td>
			<td colspan="1" style="text-align: center;width:20%;">最新の登録更新日</td>
			<td colspan="2" style="width:30%">$modifiedDate</td>
		</tr>
		<tr>
			<td colspan="1" style="text-align: center;">メーカー名</td>
			<td colspan="5">$companyName</td>
		</tr>
		<tr>
			<td colspan="1" rowspan="2" style="text-align: center;">評価対象製品</td>
			<td colspan="1" style="text-align: center;">製品名</td>
			<td colspan="4" >$productName</td>
		</tr>
		<tr>
			<td colspan="1" style="text-align: center;">型番</td>
			<td colspan="2" >　$modelNumber</td>
			<td colspan="1" style="text-align: center;">発売時期</td>
			<td colspan="1" >$salesDate</td>
		</tr>
		<tr>
			<td colspan="1" rowspan="2" style="text-align: center;">比較対象製品</td>
			<td colspan="1" style="text-align: center;">製品名</td>
			<td colspan="4" >$productNameComp</td>
		</tr>
		<tr>
			<td colspan="1" style="text-align: center;">型番</td>
			<td colspan="2" >$modelNumberComp</td>
			<td colspan="1" style="text-align: center;">発売時期</td>
			<td colspan="1" >$salesDateComp</td>
		</tr>
		<tr>
			<td colspan="1" style="text-align: center;">製品説明</td>
			<td colspan="5">$product->product_comment</td>
		</tr>
		<tr>
			<td colspan="1" style="text-align: center;">登録更新内容</td>
			<td colspan="5">$product->update_comment</td>
		</tr>
		<tr>
			<td colspan="1" style="text-align: center;">製品情報</td>
			<td colspan="5">$productInfoUrl または $productTel</td>
		</tr>
		<tr>
			<td colspan="1" style="text-align: center;">お問い合わせ</td>
			<td colspan="5">$url または $tel</td>
		</tr>
	</tbody>
</table>
<table>
	<tbody>
		<tr>
		<td></td>
		</tr>
	</tbody>
</table>
<table border="1" cellspacing="0" cellpadding="5">
	<tbody>
		<tr>
			<td colspan="2" style="background-color:lightgrey;">
				<b>{$type}は以下に示す{$evalCount}項目について改善しています。</b><br/>
				ご注意: この評価は当社従来製品ばつばつ型ばつばつ弁を比較対象とした時の環境側面の改善を示すものです。
				製品んの性能の優劣を示すものではなく、また、当社の他製品んまたは他者製品の環境側面との優劣を示すものではありません。
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
			改善した評価項目
			</td>
		</tr>

EOF;

for ($i=0; $i < count($evaluationHeadsText) ; $i++) {
	$num = $i + 1;
	$val = $evaluationHeadsText[$i];
	$html .= <<< EOF
<tr>
	<td style="width:5%;text-align: center;">$num</td>
	<td style="width:95%;">$val</td>
</tr>
EOF;
}

$html .= <<< EOF
		<tr>
			<td colspan="2" style="text-align: left;">
			●製品評価に関する備考:<br/>
			$product->model_comment
			</td>
		</tr>
	</tbody>
</table>
</body>
</html>
EOF;
 
$pdf->writeHTML($html, true);
echo $pdf->Output('', 'D');
?>