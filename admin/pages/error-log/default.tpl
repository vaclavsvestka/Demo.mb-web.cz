{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="row">
		<div class="col-md-12">
			<div class="box border blue">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Seznam chyb v systému</h4>
				</div>
				<div class="box-body table-responsive">
					{if $chyby}
						<table class="table table-striped">
							<thead>
							  	<tr>
									<th>Datum</th>
									<th>Čas</th>
									<th>Chyba</th>
									<th>Zpráva</th>
									<th>Cesta</th>
									<th>Kde se stala (řádek)</th>
							  	</tr>
							</thead>
							<tbody>
								{foreach $chyby as $ch}
									<tr>
										<td>{$ch.date}</td>
										<td>{$ch.time}</td>
										<td>{$ch.sqlstate}</td>
										<td>{$ch.message}</td>
										<td>{$ch.pathinfo}</td>
										<td>{$ch.link}</td>
									</tr>
								{/foreach}
							</tbody>
							<tfoot>
								
							</tfoot>
						</table>
					{else}
						<p class="text-center">Naštěstí bez chyb :-)</p>
					{/if}
				</div>
			</div>
		</div>
	</div>
{/block}