{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="box border blue">
		<div class="box-title">
			<h4><i class="fa fa-table"></i>Seznam značek produktů</h4>
			<div class="buttons">
				<a href="/admin/produkty/znacky/novy">
					<button type="button" class="btn btn-success btn-xs">
						<span class="glyphicon glyphicon-plus"></span> Přidat značku
					</button>
				</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-striped">
				<thead>
				  	<tr>
						<th>Název</th>
						<th width="60" class="text-center">Aktivní</th>
						<th width="100" class="text-center"></th>
				  	</tr>
				</thead>
				<tbody>
					{foreach $znacky as $z}
						<tr>
							<td>{$z.nazev}</td>
							<td class="text-center">
								{if $z.aktivni == 1}
									<i class="fa fa-check fa-toggle-on" title="Aktivní"></i>
								{else}
									<i class="fa fa-close fa-toggle-off" title="Neaktivní"></i>
								{/if}
							</td>
							<td class="text-right">
								<a href="/admin/produkty/znacky/edit/{$z.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
								<a href="/admin/produkty/znacky/smazat/{$z.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
							</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>	
{/block}