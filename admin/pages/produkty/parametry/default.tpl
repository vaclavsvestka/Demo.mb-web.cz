{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="box border blue">
		<div class="box-title">
			<h4><i class="fa fa-table"></i>Seznam parametrů produktů</h4>
			<div class="buttons">
				<a href="/admin/produkty/parametry/novy">
					<button type="button" class="btn btn-success btn-xs">
						<span class="glyphicon glyphicon-plus"></span> Přidat parametr
					</button>
				</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-striped">
				<thead>
				  	<tr>
						<th>Název</th>
						<th></th>
				  	</tr>
				</thead>
				<tbody>
					{foreach $parametry as $par}
						<tr>
							<td>{$par.nazev}</td>
							<td class="text-right">
								<a href="/admin/produkty/parametry/edit/{$par.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
								<a href="/admin/produkty/parametry/smazat/{$par.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
							</td>
						</tr>					
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>	
{/block}