{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="box border blue">
		<div class="box-title">
			<h4><i class="fa fa-table"></i>Seznam kategorií produktů</h4>
			<div class="buttons">
				<a href="/admin/produkty/kategorie/novy">
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
						<th>Název</th>
						<th width="60" class="text-center">Pořadí</th>
						<th width="60" class="text-center">Aktivní</th>
						<th width="100" class="text-center"></th>
				  	</tr>
				</thead>
				<tbody>
					{foreach $kategorie as $kat}
						<tr>
							<td>{$kat.nazev}</td>
							<td class="text-center">{$kat.sort}</td>
							<td class="text-center">
								{if $kat.aktivni == 1}
									<i class="fa fa-check fa-toggle-on" title="Aktivní"></i>
								{else}
									<i class="fa fa-close fa-toggle-off" title="Neaktivní"></i>
								{/if}
							</td>
							<td class="text-right">
								<a href="/admin/produkty/kategorie/edit/{$kat.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
								<a href="/admin/produkty/kategorie/smazat/{$kat.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
							</td>
						</tr>
						{if $kat.podkategorie}
							{foreach $kat.podkategorie as $k}
								<tr>
									<td style="padding-left:20px;">{$k.nazev}</td>
									<td class="text-center">{$k.sort}</td>
									<td class="text-center">
										{if $k.aktivni == 1}
											<i class="fa fa-check fa-toggle-on" title="Aktivní"></i>
										{else}
											<i class="fa fa-close fa-toggle-off" title="Neaktivní"></i>
										{/if}
									</td>
									<td class="text-right">
										<a href="/admin/produkty/kategorie/edit/{$k.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
										<a href="/admin/produkty/kategorie/smazat/{$k.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
									</td>
								</tr>
								{if $k.podkategorie}
									{foreach $k.podkategorie as $l}
										<tr>
											<td style="padding-left:40px;">{$l.nazev}</td>
											<td class="text-center">{$l.sort}</td>
											<td class="text-center">
												{if $l.aktivni == 1}
													<i class="fa fa-check fa-toggle-on" title="Aktivní"></i>
												{else}
													<i class="fa fa-close fa-toggle-off" title="Neaktivní"></i>
												{/if}
											</td>
											<td class="text-right">
												<a href="/admin/produkty/kategorie/edit/{$l.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
												<a href="/admin/produkty/kategorie/smazat/{$l.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
											</td>
										</tr>
										{if $l.podkategorie}
											{foreach $l.podkategorie as $m}
												<tr>
													<td style="padding-left:60px;">{$m.nazev}</td>
													<td class="text-center">{$m.sort}</td>
													<td class="text-center">
														{if $m.aktivni == 1}
															<i class="fa fa-check fa-toggle-on" title="Aktivní"></i>
														{else}
															<i class="fa fa-close fa-toggle-off" title="Neaktivní"></i>
														{/if}
													</td>
													<td class="text-right">
														<a href="/admin/produkty/kategorie/edit/{$m.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
														<a href="/admin/produkty/kategorie/smazat/{$m.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
													</td>
												</tr>
											{/foreach}
										{/if}
									{/foreach}
								{/if}
							{/foreach}
						{/if}
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>	
{/block}