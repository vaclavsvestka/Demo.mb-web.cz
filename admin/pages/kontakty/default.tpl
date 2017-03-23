{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="box border blue">
		<div class="box-title">
			<h4><i class="fa fa-table"></i>Seznam kontaktů</h4>
			<div class="buttons">
				<a href="/admin/kontakty/novy&type=1">
					<button type="button" class="btn btn-success btn-xs">
						<span class="glyphicon glyphicon-plus"></span> Přidat pobočku
					</button>
				</a>
				<a href="/admin/kontakty/novy&type=2">
					<button type="button" class="btn btn-success btn-xs">
						<span class="glyphicon glyphicon-plus"></span> Přidat kontakt
					</button>
				</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-striped">
				<thead>
				  	<tr>
						<th>ID</th>
						<th>Skupina</th>
						<th>Název kontaktu</th>
						<th>Dlouhý název</th>
						<th width="70" class="text-center">Fotka</th>
						<th width="70" class="text-center">QR kód</th>
						<th width="70" class="text-center">Vizitka</th>
						<th width="80" class="text-right">Akce</th>						
				  	</tr>
				</thead>
				<tbody>
					{foreach $kontakty as $kontakt}
						<tr>
							<td>{$kontakt.id_kontaktu}</td>
							<td>{$kontakt.nazev_pobocky}</td>
							<td>{$kontakt.nazev_kontaktu}</td>
							<td>{$kontakt.dlouhy_nazev|truncate:45:" ..."}</td>
							<td class="text-center">{if $kontakt.foto}<i class="fa fa-camera"></i>{/if}</td>
							<td class="text-center">{if $kontakt.qr}<i class="fa fa-qrcode"></i>{/if}</td>
							<td class="text-center">{if $kontakt.vizitka}<i class="fa fa-file-o"></i>{/if}</td>
							<td class="text-right">
								<a href="/admin/kontakty/edit/{$kontakt.id_kontaktu}&type={$kontakt.skupina}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
								<a href="/admin/kontakty/smazat/{$kontakt.id_kontaktu}&type={$kontakt.skupina}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
							</td>
						</tr>
					{foreachelse}				
						<tr>
							<td colspan="7" class="text-center">
								<strong>
									<br>Nejsou žádné kontakty k zobrazení
								</strong>								
							</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
{/block}