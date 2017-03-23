{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="box border blue">
		<div class="box-title">
			<h4><i class="fa fa-table"></i>Seznam zákazníků</h4>
			<div class="buttons">
				<a href="/admin/zakaznici/novy">
					<button type="button" class="btn btn-success btn-xs">
						<span class="glyphicon glyphicon-plus"></span> Přidat zákazníka
					</button>
				</a>
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-striped">
				<thead>
				  	<tr>
						<th>Jméno a příjmení</th>
						<th>Firma</th>
						<th>Město</th>
						<th></th>
				  	</tr>
				</thead>
				<tbody>
					<tr>
						{foreach $zakaznici as $zakaznik}
							<tr>
								<td>{$zakaznik.jmeno} {$zakaznik.prijmeni}</td>
								<td>{$zakaznik.firma}</td>
								<td>{$zakaznik.mesto}</td>
								<td class="text-right">
									<a href="/admin/zakaznici/edit/{$zakaznik.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
									<a href="/admin/zakaznici/smazat/{$zakaznik.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
								</td>
							</tr>
						{/foreach}
					</tr>					
				</tbody>
			</table>
		</div>
	</div>
{/block}