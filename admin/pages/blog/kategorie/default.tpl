{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="box border blue">
		<div class="box-title">
			<h4><i class="fa fa-table"></i>Seznam kategorií blogu</h4>
			<div class="buttons">
				<a href="/admin/blog/kategorie/novy">
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
						<th width="20">ID</th>
						<th>Název</th>
						<th></th>
				  	</tr>
				</thead>
				<tbody>
					{foreach $kategorie_blogu as $kategorie}
						<tr>
							<td>{$kategorie.id}</td>
							<td>{$kategorie.texty.cs.nazev}</td>
							<td class="text-right">
								<a href="/admin/blog/kategorie/edit/{$kategorie.id}">
									<i class="fa fa-edit fa-funkce" title="Editace"></i>
								</a>
								<!-- <a href="/admin/blog/kategorie/smazat/{$kategorie.id}">
									<i class="fa fa-trash fa-funkce" title="Smazat"></i>
								</a> -->
							</td>
						</tr>							
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
{/block}