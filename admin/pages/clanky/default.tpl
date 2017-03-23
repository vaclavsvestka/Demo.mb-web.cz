{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="row">
		<div class="col-md-3">
			<div class="box border blue">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Seznam kategorií článků</h4>
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
												<a href="/admin/clanky/kategorie/edit/{$kategorie.id}">
													<i class="fa fa-edit fa-funkce" title="Editace"></i>
												</a>
												<a href="/admin/clanky/kategorie/smazat/{$kategorie.id}">
													<i class="fa fa-trash fa-funkce" title="Smazat"></i>
												</a>
											{/if}
										</td>
									</tr>							
								{/if}
							{/foreach}
						</tbody>
						<tfoot>
							<tr>
								<td colspan="3" class="text-center" style="padding-top: 30px;">
									<a href="/admin/clanky/kategorie/novy">
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
					<h4><i class="fa fa-table"></i>Seznam článků</h4>
					<div class="buttons">
						<a href="/admin/clanky/novy">
							<button type="button" class="btn btn-success btn-xs">
								<span class="glyphicon glyphicon-plus"></span> Přidat článek
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
								<th>Kategorie</th>
								<th>URL</th>
								<th>Datum vytvoření</th>
								<th>Datum editace</th>
								<th>Autor</th>
								<th width="220" class="text-right">Akce</th>						
						  	</tr>
						</thead>
						<tbody>
							{foreach $clanky as $clanek}
								<tr>
									<td>{$clanek.id}</td>
									<td>{$clanek.texty.cs.nadpis}</td>
									<td>{$clanek.kategorie}</td>
									<td>{$clanek.url}</td>
									<td>{$clanek.datum_cas_vytvoreni|date_format:"%d. %m. %Y %H:%M"}</td>
									<td>{$clanek.datum_cas_editace|date_format:"%d. %m. %Y %H:%M"}</td>
									<td>{$clanek.autor}</td>
									<td class="text-right">
										<a href="/admin/clanky/edit/{$clanek.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
										<a href="/admin/clanky/smazat/{$clanek.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
									</td>
								</tr>
							{foreachelse}				
								<tr>
									<td colspan="7" class="text-center">
										<strong>
											<br>Nejsou žádné články k zobrazení
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