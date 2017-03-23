{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="box border blue">
		<div class="box-title">
			<h4><i class="fa fa-table"></i>Seznam posledních přihlášení uživatele {$uzivatel.username}</h4>
			<div class="buttons">
				<!-- <a href="/admin/nastaveni/uzivatele/novy">
					<button type="button" class="btn btn-success btn-xs">
						<span class="glyphicon glyphicon-plus"></span> Přidat uživatele
					</button>
				</a> -->
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-striped">
				<thead>
				  	<tr>
						<th width="40">ID</th>
						<th width="150">Datum a čas</th>
						<th>IP adresa</th>
						<th width="90" class="text-right"></th>
				  	</tr>
				</thead>
				<tbody>
					{foreach $prihlaseni as $p}
						<tr>
							<td>{$p.id}</td>
							<td>{$p.datetime}</td>
							<td>{$p.ip}</td>
							<td class="text-right">
								<a href="/admin/nastaveni/uzivatele/seznam-prihlaseni/smazat/{$p.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
							</td>
						</tr>					
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
{/block}