{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="box border blue">
		<div class="box-title">
			<h4><i class="fa fa-table"></i>Seznam produktů</h4>
			<div class="buttons">
				<a href="/admin/produkty/seznam/novy">
					<button type="button" class="btn btn-success btn-xs">
						<span class="glyphicon glyphicon-plus"></span> Přidat produkt
					</button>
				</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-striped">
				<thead>
				  	<tr>
						<th>Název</th>
						<th width="90" class="text-center">Pořadí</th>
						<th width="100" class="text-right">Cena</th>
						<th width="90" class="text-center">Aktivní</th>
						<th width="80"></th>
				  	</tr>
				</thead>
				<tbody>
					{foreach $produkty as $produkt}
						<tr>
							<td>{$produkt.nazev}</td>
							<td class="text-center">{$produkt.sort}</td>
							<td class="text-right">{$produkt.cena} {$mena}</td>
							<td class="text-center">
								{if $produkt.aktivni == 1}
									<i class="fa fa-check fa-toggle-on" title="Aktivní"></i>
								{else}
									<i class="fa fa-close fa-toggle-off" title="Neaktivní"></i>
								{/if}
							</td>
							<td class="text-right">
								<a href="/admin/produkty/seznam/edit/{$produkt.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
								<a href="/admin/produkty/seznam/smazat/{$produkt.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
							</td>
						</tr>					
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
{/block}