<!DOCTYPE html>
<html lang="cs">
	<head>
		<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
		<title>Přijetí objednávky č. {$objednavka.id} - ProtanCzech.cz</title>
	</head>
	<body style="margin: 0 auto;">
		<center>
			<table style="width:600px;">
				<tr>
					<td>
						<p><b>Vaše objednávka  č. {$objednavka.id} na e-shopu ProtanCzech.cz byla přijata.</b></p>
						<p>Stav objednávky můžete sledovat ve Vašem účtů. Současně Vás budeme o stavu Vaší objednávky informovat prostřednictvím emailu.</p>	
						<h3>Souhrn objednávky</h3>
						{include file="./_table.tpl"}
						<p>Děkujeme Vám, že jste si u nás objednali.</p>
						<p>Hezký den Vám přeje team ProtanCzech</p>
					</td>
				</tr>
			</table>
		</center>
	</body>
</html>