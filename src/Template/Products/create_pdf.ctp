<?php
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8');
$pdf->SetFont('kozgopromedium');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->AddPage();

$createDate = $product->created->i18nFormat('yyyy-MM-dd', 'Asia/Tokyo', 'ja-JP');
$modifiedDate = $product->modified->i18nFormat('yyyy-MM-dd', 'Asia/Tokyo', 'ja-JP');
$companyName = $product->company->company_name;
$productName = $product->product_name;
$modelNumber = $product->model_number;
$salesDate = $product->sales_date->i18nFormat('yyyy-MM-dd', 'Asia/Tokyo', 'ja-JP');
$productInfoUrl = $product->product_info_url;
$tel = $product->company->tel;
$url = $product->company->url;
$latestFomula = $product->latest_fomula->i18nFormat('yyyy-MM-dd', 'Asia/Tokyo', 'ja-JP');
$evalCount = count($evaluationHeads);
$type = $product->type->type_name;

$html = <<< EOF
<!DOCTYPE html>
<html>
<body>
<table border="1" cellspacing="0">
	<tbody>
		<tr>
			<td colspan="6" style="text-align: center;background-color:black;color:white;">JVMA ラベル制度 登録情報</td>
		</tr>
		<tr>
			<td colspan="1" style="text-align: center;">登録日</td>
			<td colspan="2" >$createDate</td>
			<td colspan="1" style="text-align: center;">情報更新日</td>
			<td colspan="2" >$modifiedDate</td>
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
			<td colspan="2" >$modelNumber</td>
			<td colspan="1" style="text-align: center;">発売時期</td>
			<td colspan="1" >$salesDate</td>
		</tr>
		<tr>
			<td colspan="1" rowspan="2" style="text-align: center;">評価実施時期</td>
			<td colspan="1" style="text-align: center;">製品評価</td>
			<td colspan="4" >$modifiedDate</td>
		</tr>
		<tr>
			<td colspan="1" style="text-align: center;">しくみ評価</td>
			<td colspan="4" >$latestFomula</td>
		</tr>
		<tr>
			<td colspan="1" style="text-align: center;">製品説明</td>
			<td colspan="5">$product->product_comment</td>
		</tr>
		<tr>
			<td colspan="1" style="text-align: center;">製品情報</td>
			<td colspan="5">$productInfoUrl</td>
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
<table border="1" cellspacing="0">
	<tbody>
		<tr>
			<td colspan="2">
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

for ($i=0; $i < count($evaluationHeads) ; $i++) {
	$num = $i + 1;
	$val = $evaluationHeads[$i]->item_description;
	$html .= <<< EOF
<tr>
	<td style="width:5%;text-align: center;">$num</td>
	<td style="width:95%;">$val</td>
</tr>
EOF;
}

$html .= <<< EOF
	</tbody>
</table>
</body>
</html>
EOF;

$pdf->writeHTML($html, true);
echo $pdf->Output('', 'D');
?>