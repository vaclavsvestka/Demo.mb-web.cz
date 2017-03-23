{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="box border blue">
		<div class="box-title">
			<h4><i class="fa fa-table"></i>Seznam objednávek</h4>
			<div class="buttons">
				<!-- <a href="/admin/objednavky/novy">
					<button type="button" class="btn btn-success btn-xs">
						<span class="glyphicon glyphicon-plus"></span> Přidat objednávku
					</button>
				</a> -->
			</div>
		</div>
		<div class="box-body table-responsive">
			<table class="table table-striped">
				<thead>
				  	<tr>
						<th width="120">ID</th>
						<th width="200">Datum a čas objednávky</th>
						<th>Jméno a příjmení zákazníka</th>
						<th width="200">Částka s dopravou</th>
						<th width="150">Status objednávky</th>
						<th width="100"></th>
				  	</tr>
				</thead>
				<tbody>
					{foreach $objednavky as $o}
						<tr>
							<td>{$o.id}</td>
							<td>{$o.datum_cas_vytvoreni|date_format:"%d.%m.%Y"} {$o.datum_cas_vytvoreni|date_format:"%H:%M:%S"}</td>
							<td>{$o.adresy.jmeno} {$o.adresy.prijmeni}</td>
							<td>{$o.castka_s_dopravou} Kč</td>
							<td>{$o.status}</td>
							<td width="90" class="text-right">
								<a href="{$smarty.const.ADMIN_PREFIX}admin/objednavky/edit/{$o.id}"><i class="fa fa-eye fa-funkce" title="Editace"></i></a>
								<a href="{$smarty.const.ADMIN_PREFIX}admin/objednavky/smazat/{$o.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
							</td>
						</tr>					
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
{/block}