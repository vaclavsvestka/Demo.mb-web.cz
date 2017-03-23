{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=breadcrumb}
	{assign var=module value='Seznamy'}
	{include file="../breadcrumb.tpl"}
{/block}
{block name=content}
	<div class="row">
		<div class="col-md-3">
			<div class="box border blue">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Kategorie</h4>
					<div class="buttons">
						
					</div>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-striped">
						<thead>
						  	<tr>
								<th>Název</th>
								<th width="220" class="text-right">Akce</th>						
						  	</tr>
						</thead>
						<tbody>
							{foreach $seznam_kategorii as $kat}
								<tr>
									<td>{$kat.nazev}</td>
									<td class="text-right">
										<a href="{$smarty.const.ADMIN_PREFIX}admin/seznamy/kategorie/edit/{$kat.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
										<a href="{$smarty.const.ADMIN_PREFIX}admin/seznamy/kategorie/smazat/{$kat.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
									</td>
								</tr>
							{foreachelse}				
								<tr>
									<td colspan="7" class="text-center">
										<strong>
											<br>Nejsou žádné kategorie k zobrazení
										</strong>								
									</td>
								</tr>
							{/foreach}
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2" class="text-center" style="padding-top: 30px;">
									<a href="{$smarty.const.ADMIN_PREFIX}admin/seznamy/kategorie/novy">
										<button type="button" class="btn btn-success btn-xs">
											<span class="glyphicon glyphicon-plus"></span> Přidat kategorii
										</button>
									</a>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="box border blue">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Seznamy</h4>
					<div class="buttons">
						<a href="{$smarty.const.ADMIN_PREFIX}admin/seznamy/novy">
							<button type="button" class="btn btn-success btn-xs">
								<span class="glyphicon glyphicon-plus"></span> Přidat
							</button>
						</a>
					</div>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-striped">
						<thead>
						  	<tr>
								<th>ID</th>
								<th>Titulek</th>
								<th>Podtitulek</th>
								<th>Kategorie</th>
								<th>Datum vytvoření</th>
								<th>Datum editace</th>
								<th width="220" class="text-right">Akce</th>						
						  	</tr>
						</thead>
						<tbody>
							{foreach $seznamy as $s}
								<tr>
									<td>{$s.id}</td>
									<td>{$s.nazev}</td>
									<td>{$s.podnazev}</td>
									<td>{$s.kategorie}</td>
									<td>{$s.datum_cas_vytvoreni|date_format:"%d. %m. %Y %H:%M"}</td>
									<td>{$s.datum_cas_editace|date_format:"%d. %m. %Y %H:%M"}</td>
									<td class="text-right">
										<a href="{$smarty.const.ADMIN_PREFIX}admin/seznamy/edit/{$s.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
										<a href="{$smarty.const.ADMIN_PREFIX}admin/seznamy/smazat/{$s.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
									</td>
								</tr>
							{foreachelse}				
								<tr>
									<td colspan="7" class="text-center">
										<strong>
											<br>Nejsou žádné položky k zobrazení
										</strong>								
									</td>
								</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
{/block}