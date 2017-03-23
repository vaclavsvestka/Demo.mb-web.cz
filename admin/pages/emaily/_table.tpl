<table style="border: 1px solid black; border-collapse: collapse;">
	<tbody>
		<tr style="background-color:#ccc;">
			<th style="border:1px solid black; text-align:center; padding:5px;">Produkt</th>
			<th style="border:1px solid black; text-align:center; padding:5px;">Množství</th>
			<th style="border:1px solid black; text-align:center; padding:5px;">Cena</th>
		</tr>
		{foreach $objednavka.polozky as $p}
			{assign var=cena value=$p.produkt.cena.cena_s_dph}
			<tr>
				<td style="border:1px solid black; padding:5px;">{$p.produkt.nazev}</td>
				<td style="border:1px solid black; text-align:center; padding:5px;">{$p.pocet} ks</td>
				<td  style="border:1px solid black; text-align:right; padding:5px;">{$cena|number_format:1:",":" "} Kč</td>
			</tr>
		{/foreach}
		<tr style="border-top:2px solid black; font-style:italic;">
			<td  style="border:1px solid black; padding:5px;">Cena bez poštovného</td>
			<td  style="border:1px solid black; text-align:center; padding:5px;"></td>
			<td  style="border:1px solid black; text-align:right; padding:5px;">{$objednavka.castka|number_format:1:",":" "} Kč</td>
		</tr>
		<tr style="font-style:italic;">
			<td  style="border:1px solid black; padding:5px;">Poštovné</td>
			<td  style="border:1px solid black; text-align:center; padding:5px;"></td>
			<td  style="border:1px solid black; text-align:right; padding:5px;">{$objednavka.doprava.castka_dopravy|number_format:1:",":" "} Kč</td>
		</tr>
		<tr style="font-weight:bold;">
			<td  style="border:1px solid black; padding:5px;">Cena celkem</td>
			<td  style="border:1px solid black; text-align:center; padding:5px;"></td>
			<td  style="border:1px solid black; text-align:right; padding:5px;">{$objednavka.castka_s_dopravou|number_format:1:",":" "} Kč</td>
		</tr>
	</tbody>
</table>