{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=breadcrumb}
	{assign var=module value='Nastavení systému'}
	{include file="../breadcrumb.tpl"}
{/block}
{block name=content}
	<form action="/admin/?p1=nastaveni&p2=edit&akce=ulozit" method="post" role="form">
		<div class="row">
			<div class="col-md-5">
    			<div class="box border blue">
                    <div class="box-title">
                        <h4><i class="fa fa-table"></i>Základní informace</h4>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" class="form-control" id="" name="nazev_stranek" value="{$nastaveni.nazev_stranek}" placeholder="Název stránek. Bude se zobrazovat v titulce prohlížeče">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-danger btn-md btn-block" name="button" value="send">Uložit</button>
							</div>
						</div>
                    </div>
                </div>
                <div class="box border blue">
                    <div class="box-title">
                        <h4><i class="fa fa-table"></i>Nastavení e-shopu</h4>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<div class="checkbox">
										<input type="checkbox" name="jednotne_dph"> Jednotná sazba DPH pro všechny produkty
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-danger btn-md btn-block" name="button" value="send">Uložit</button>
							</div>
						</div>
                    </div>
                </div>
	   			<div class="box border blue">
                    <div class="box-title">
                        <h4><i class="fa fa-table"></i>Kontakty</h4>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" id="" name="jmeno" value="{$nastaveni.jmeno}" placeholder="Jméno">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" id="" name="prijmeni" value="{$nastaveni.prijmeni}" placeholder="Příjmení">
								</div>
							</div>
						</div>
                        <div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" class="form-control" id="" name="telefon" value="{$nastaveni.telefon}" placeholder="Telefon">
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<input type="text" class="form-control" id="" name="email" value="{$nastaveni.email}" placeholder="E-mailová adresa">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<div class="form-group">
									<input type="text" class="form-control" id="" name="ulice" value="{$nastaveni.ulice}" placeholder="Ulice">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<input type="text" class="form-control" id="" name="psc" value="{$nastaveni.psc}" placeholder="PSČ">
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<input type="text" class="form-control" id="" name="mesto" value="{$nastaveni.mesto}" placeholder="Město">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" id="" name="ico" value="{$nastaveni.ico}" placeholder="IČO">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" id="" name="dic" value="{$nastaveni.dic}" placeholder="DIČ">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-danger btn-md btn-block" name="button" value="send">Uložit</button>
							</div>
						</div>
                    </div>
                </div>
			</div>
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
		                    <div class="box-title">
		                        <h4><i class="fa fa-table"></i>Sociální sítě</h4>
		                        <div class="tools"></div>
		                    </div>
		                    <div class="box-body table-responsive">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Facebook</label>
											<input type="text" class="form-control" id="" name="facebook" value="{$nastaveni.facebook}" placeholder="Odkaz na profil na sociální síti facebook">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Twitter</label>
											<input type="text" class="form-control" id="" name="twitter" value="{$nastaveni.twitter}" placeholder="Odkaz na profil na sociální síti twitter">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Linkedin</label>
											<input type="text" class="form-control" id="" name="linkedin" value="{$nastaveni.linkedin}" placeholder="Odkaz na profil na profesní sociální síti linkedin">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Google +</label>
											<input type="text" class="form-control" id="" name="google_plus" value="{$nastaveni.google_plus}" placeholder="Odkaz na profil na sociální síti Google +">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Youtube</label>
											<input type="text" class="form-control" id="" name="youtube" value="{$nastaveni.youtube}" placeholder="Odkaz na profil na Youtube">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Instagram</label>
											<input type="text" class="form-control" id="" name="instagram" value="{$nastaveni.instagram}" placeholder="Odkaz na profil na Instagramu">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<button type="submit" class="btn btn-danger btn-md btn-block" name="button" value="send">Uložit</button>
									</div>
								</div>
		                    </div>
		                </div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Správa jazyků</h4>
								<div class="buttons">
									<a href="/admin/nastaveni/jazyky/novy">
										<button type="button" class="btn btn-success btn-xs">
											<span class="glyphicon glyphicon-plus"></span> Přidat jazyk
										</button>
									</a>
								</div>
							</div>
							<div class="box-body table-responsive">
								<table class="table table-striped">
									<thead>
									  	<tr>
											<th width="150">Zkratka</th>
											<th>Název</th>
											<th width="90" class="text-right"></th>
									  	</tr>
									</thead>
									<tbody>
										{foreach $jazyky as $j}
											<tr>
												<td>{$j.zkratka}</td>
												<td>{$j.nazev}</td>
												<td class="text-right">
													<a href="/admin/nastaveni/jazyky/edit/{$j.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
													<a href="/admin/nastaveni/jazyky/smazat/{$j.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
												</td>
											</tr>					
										{/foreach}
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Sazby DPH</h4>
								<div class="buttons">
									<a href="/admin/nastaveni/dph/novy">
										<button type="button" class="btn btn-success btn-xs">
											<span class="glyphicon glyphicon-plus"></span> Přidat sazbu
										</button>
									</a>
								</div>
							</div>
							<div class="box-body table-responsive">
								<table class="table table-striped">
									<thead>
									  	<tr>
											<th>Sazba</th>
											<th width="90" class="text-right"></th>
									  	</tr>
									</thead>
									<tbody>
										{foreach $sazby_dph as $j}
											<tr>
												<td>{$j.sazba}</td>
												<td class="text-right">
													<a href="/admin/nastaveni/sazby/edit/{$j.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
													<a href="/admin/nastaveni/sazby/smazat/{$j.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
												</td>
											</tr>					
										{/foreach}
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Menu webu</h4>
								<div class="buttons">
									<a href="/admin/nastaveni/menu/novy">
										<button type="button" class="btn btn-success btn-xs">
											<span class="glyphicon glyphicon-plus"></span> Přidat položku menu
										</button>
									</a>
								</div>
							</div>
							<div class="box-body table-responsive">
								<table class="table table-striped">
									<thead>
									  	<tr>
											<th>Položka</th>
											<th class="text-center">Pořadí</th>
											<th class="text-center">Odkaz</th>
											<th class="text-center">Aktivní</th>
											<th class="text-right">Akce</th>
									  	</tr>
									</thead>
									<tbody>
										{foreach from=$menu item=polozka}
											<tr>
												<td>{$polozka.nazev}</td>	
												<td class="text-center">{$polozka.sort}</td>
												<td class="text-center">{$polozka.odkaz}</td>
												<td class="text-center">
													{if $polozka.aktivni == 1}
														<i class="fa fa-check fa-toggle-on" title="Aktivní"></i>
													{else}
														<i class="fa fa-close fa-toggle-off" title="Neaktivní"></i>
													{/if}
												</td>
												<td class="text-right">
													<a href="/admin/nastaveni/menu/edit/{$polozka.id}"><i class="fa fa-edit fa-funkce" title=""></i></a>
													<a href="/admin/nastaveni/menu/smazat/{$polozka.id}"><i class="fa fa-trash fa-funkce" title=""></i></a>
												</td>
												{if is_array($polozka.8)}
													<tr>
														{foreach from=$polozka.8 item=polozka1}
															<tr>
																<td class="submenu">{$polozka1.nazev}</td>
																<td class="text-center">{$polozka1.sort}</td>
																<td class="text-center">{$polozka1.odkaz}</td>
																<td class="text-center">
																	{if $polozka1.aktivni == 1}
																		<i class="fa fa-check fa-toggle-on" title="Aktivní"></i>
																	{else}
																		<i class="fa fa-close fa-toggle-off" title="Neaktivní"></i>
																	{/if}
																</td>
																<td class="text-right">
																	<a href="/admin/nastaveni/menu/edit/{$polozka1.id}"><i class="fa fa-edit fa-funkce" title=""></i></a>
																	<a href="/admin/nastaveni/menu/smazat/{$polozka1.id}"><i class="fa fa-trash fa-funkce" title=""></i></a>
																</td>
															</tr>
														{/foreach}								
													</tr>
												{/if}
											</tr>
										{/foreach}		
									</tbody>
								</table>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
    </form>
{/block}