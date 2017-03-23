{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="box border blue">
		<div class="box-title">
			<h4><i class="fa fa-table"></i>Seznam kategorií článků</h4>
			<div class="buttons">
				<a href="{$smarty.const.ADMIN_PREFIX}admin/clanky/kategorie/novy">
					<button type="button" class="btn btn-success btn-xs">
						<span class="glyphicon glyphicon-plus"></span> Přidat kategorii
					</button>
				</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-striped">
				<thead>
				  	<tr>
						<th>ID</th>
						<th>Název</th>
						<th></th>
				  	</tr>
				</thead>
				<tbody>
					{foreach $kategorie_clanku as $kategorie}
						{if $kategorie.id == 1}
							{if $logged_user.admin_group == 1}
								<tr>
									<td>{$kategorie.id}</td>
									<td>{$kategorie.nazev}</td>
									<td class="text-right"></td>
								</tr>							
							{/if}
						{else}
							<tr>
								<td>{$kategorie.id}</td>
								<td>{$kategorie.nazev}</td>
								<td class="text-right">
									{if $kategorie.id != 1}
										<a href="{$smarty.const.ADMIN_PREFIX}admin/clanky/kategorie/edit/{$kategorie.id}">
											<i class="fa fa-edit fa-funkce" title="Editace"></i>
										</a>
										<a href="{$smarty.const.ADMIN_PREFIX}admin/clanky/kategorie/smazat/{$kategorie.id}">
											<i class="fa fa-trash fa-funkce" title="Smazat"></i>
										</a>
									{/if}
								</td>
							</tr>							
						{/if}
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
{/block}