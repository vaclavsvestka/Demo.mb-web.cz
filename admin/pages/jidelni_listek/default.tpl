{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="row">
		<div class="col-md-8">
			{foreach $jidelni_listek as $m}
				<div class="box border blue">
					<div class="box-title">
						<h4><i class="fa fa-table"></i>{$m.nazev}</h4>
					</div>
					<div class="box-body table-responsive">
						<table class="table table-striped">
							<thead>
							  	<tr>
									<th width="280">Název</th>
									<th width="100">Množství</th>
									<th width="100">Cena</th>
									<th width="100">Řazení</th>
									<th width="100">Sleva</th>
									<th></th>
							  	</tr>
							</thead>
							<tbody>
								{foreach $m.napoje as $n}
									<form action="/admin/?p1=jidelni_listek&p2=upravit_polozku" method="post">
										<tr>
											<td><input type="text" name="nazev" value="{$n.nazev}" class="form-control" style="width: 95%"></td>	
											<td><input type="text" name="mnozstvi" value="{$n.mnozstvi}" class="form-control" style="width: 95%"></td>
											<td><input type="number" name="cena" value="{$n.cena}" class="form-control" style="width: 95%"></td>	
											<td><input type="number" name="sort" value="{$n.sort}" class="form-control" style="width: 95%"></td>	
											<td><input type="number" name="sleva" value="{$n.sleva}" class="form-control" style="width: 95%"></td>	
											<td class="text-right">
												<input type="hidden" name="id" value="{$n.id}">
												<button type="submit" class="btn btn-info">Editovat</button>
												<a href="/admin/jidelni_listek/smazat_polozku/{$n.id}"><button type="button" class="btn btn-danger">Smazat</button></a>
											</td>
										</tr>
									</form>
								{/foreach}
							</tbody>
							<tfoot>
								<form action="/admin/?p1=jidelni_listek&p2=pridat_polozku" method="post">
									<tr style="background-color: #eee;">
										<td style="padding: 0; padding-top: 3px; padding-bottom: 3px;"><input style="width: 95%" type="text" name="nazev" class="form-control"></td>
										<td style="padding: 0; padding-top: 3px; padding-bottom: 3px;"><input style="width: 95%" type="text" name="mnozstvi" class="form-control" width="100"></td>
										<td style="padding: 0; padding-top: 3px; padding-bottom: 3px;"><input style="width: 95%" type="number" name="cena" class="form-control"></td>
										<td style="padding: 0; padding-top: 3px; padding-bottom: 3px;"><input style="width: 95%" type="number" name="sort" class="form-control"></td>
										<td style="padding: 0; padding-top: 3px; padding-bottom: 3px;"><input style="width: 95%" type="number" name="sleva" class="form-control"></td>
										<td style="padding: 0; padding-top: 3px; padding-bottom: 3px;" class="text-right">
											<input type="hidden" name="id_kategorie" value="{$m.id}">
											<button type="submit" class="btn btn-success">Přidat položku</button>
										</td>
									</tr>
								</form>
							</tfoot>
						</table>
					</div>
				</div>
			{/foreach}
		</div>
		<div class="col-md-4">
			<div class="box border blue">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Kategorie</h4>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-striped">
						<thead>
						  	<tr>
								<th>Název</th>
								<th>Podnázev</th>
								<th></th>
						  	</tr>
						</thead>
						<tbody>
							{foreach $jidelni_listek as $m}
								<tr>
									<th>{$m.nazev}</th>
									<th>{$m.podnazev}</th>
									<th></th>
								</tr>
							{/foreach}
							<form method="post" action="/admin/?p1=jidelni_listek&p2=vlozit_kategorii">
								<tr>
									<td><input type="text" name="nazev" class="form-control" style="width: 90%"></td>
									<td><input type="text" name="podnazev" class="form-control" style="width: 90%"></td>
									<td class="text-right">
										<button type="submit" class="btn btn-success">Vytvořit kategorii</button>
									</td>
								</tr>
							</form>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

{/block}