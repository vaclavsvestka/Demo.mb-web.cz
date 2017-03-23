{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="box border blue">
		<div class="box-title">
			<h4><i class="fa fa-table"></i>Seznam novinek</h4>
			<div class="buttons">
				<a href="/admin/novinky/novy">
					<button type="button" class="btn btn-success btn-xs">
						<span class="glyphicon glyphicon-plus"></span> Přidat novinku
					</button>
				</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-striped">
				<thead>
				  	<tr>
						<th>ID</th>
						<th>Nadpis</th>
						<th>Datum vytvoření</th>
						<th>Datum editace</th>
						<th>Autor</th>
						<th width="220" class="text-right">Akce</th>						
				  	</tr>
				</thead>
				<tbody>
					{foreach $novinky as $novinka}
						<tr>
							<td>{$novinka.id}</td>
							<td>{$novinka.nadpis}</td>
							<td>{$novinka.datum_cas_vytvoreni|date_format:"%d. %m. %Y %H:%M"}</td>
							<td>{$novinka.datum_cas_editace|date_format:"%d. %m. %Y %H:%M"}</td>
							<td>{$novinka.autor}</td>
							<td class="text-right">
								{if $novinka.autor_id == $logged_user.id}
									<a href="/admin/novinky/edit/{$novinka.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
									<a href="/admin/novinky/smazat/{$novinka.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
								{/if}
							</td>
						</tr>
					{foreachelse}					
						<tr>
							<td colspan="6" class="text-center">
								<strong>
									<br>Nejsou žádné novinky k zobrazení									
								</strong>
							</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>  
{/block}