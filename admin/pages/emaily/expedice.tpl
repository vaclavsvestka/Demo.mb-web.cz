<!DOCTYPE html>
<html lang="cs">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
	<title>Objednávka č. {$objednavka.id} byla expedována - ProtanCzech.cz</title>
</head>
<body style="margin: 0 auto;">
	<center>
		<table style="width:600px;">
			<tr>
				<td>
					<p><b>Vaše objednávka č. {$objednavka.id} z e-shopu ProtanCzech.cz byla právě expedována.</b></p>
					<p>Doručení objednávky můžete očekávat od 3 do 5 pracovních dnů</p>
					<h3>Souhrn objednávky</h3>
					{include file="./_table.tpl"}
					<p>Děkujeme Vám, že jste využili našich služeb.</p>
					<p>Hezký den Vám přeje team ProtanCzech</p>
				</td>
			</tr>
		</table>
	</center>
</body>
</html>