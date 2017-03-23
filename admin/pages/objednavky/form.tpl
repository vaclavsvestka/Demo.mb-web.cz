{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<form action="/admin/?p1=objednavky&p2={$smarty.get.p2}&akce=ulozit" method="post" role="form">
		<!-- Základní údaje -->
			<div class="row">	
				<div class="col-md-4">
					<div class="box border blue">
						<div class="box-title">
							<h4><i class="fa fa-table"></i>Základní údaje</h4>
						</div>
						<div class="box-body table-responsive">
							<table class="table table-striped">
								<tr>
									<th>ID objednávky</th>
									<td class="text-right">{$objednavka.id}</td>
								</tr>
								<tr>
									<th>Datum a čas objednávky</th>
									<td class="text-right">{$objednavka.datum_cas_vytvoreni|date_format:"%d. %m. %Y - %H:%M"}</td>
								</tr>
								<tr>
									<th>IP adresa</th>
									<td class="text-right">{$objednavka.ip}</td>
								</tr>
								<tr>
									<th>Status<a href="#" data-id="{$o.id}" data-status="{$o.status}" data-toggle="modal" data-target="#modal-zmenit-stav-{$o.id}"><i class="fa fa-pencil left-offset-5"></i></a></th>
									<td class="text-right">
										<a href=""></a> <strong>{$objednavka.status}</strong>
									</td>
								</tr>
							</table>
						</div>
					</div>			
				</div>
				<div class="col-md-4">
					<div class="box border blue">
						<div class="box-title">
							<h4><i class="fa fa-table"></i>Fakturační adresa</h4>
							<div class="buttons">
								<a href="#" data-toggle="modal" data-target="#modal-zmenit-dodaci-adresu">
									<button type="button" class="btn btn-success btn-xs">
										<i class="fa fa-pencil"></i> Upravit adresu
									</button>
								</a>
							</div>
						</div>
						<div class="box-body table-responsive">
							<table class="table table-striped">
								{if $objednavka.adresy.firma}
									<tr>
										<th>Firma</th>
										<td class="text-right">{$objednavka.adresy.firma}</td>
									</tr>
								{/if}
								{if $objednavka.adresy.jmeno}
									<tr>
										<th>Jméno a příjmení</th>
										<td class="text-right">{$objednavka.adresy.jmeno} {$objednavka.adresy.prijmeni}</td>
									</tr>
								{/if}
								{if $objednavka.adresy.ulice}
									<tr>
										<th>Ulice</th>
										<td class="text-right">{$objednavka.adresy.ulice}</td>
									</tr>
								{/if}
								{if $objednavka.adresy.mesto}
									<tr>
										<th>PSČ a město</th>
										<td class="text-right">{$objednavka.adresy.psc} {$objednavka.adresy.mesto}</td>
									</tr>
								{/if}
								{if $objednavka.adresy.telefon}
									<tr>
										<th>Telefon</th>
										<td class="text-right">{$objednavka.adresy.telefon}</td>
									</tr>
								{/if}
								{if $objednavka.adresy.email}
									<tr>
										<th>E-mail</th>
										<td class="text-right">{$objednavka.adresy.email}</td>
									</tr>
								{/if}
							</table>
						</div>
					</div>			
				</div>
				<div class="col-md-4">
					<div class="box border blue">
						<div class="box-title">
							<h4><i class="fa fa-table"></i>Dodací adresa</h4>
							<div class="buttons">
								<a href="#" data-toggle="modal" data-target="#modal-zmenit-fakturacni-adresu">
									<button type="button" class="btn btn-success btn-xs">
										<i class="fa fa-pencil"></i> Upravit adresu
									</button>
								</a>
							</div>
						</div>
						<div class="box-body table-responsive">
							<table class="table table-striped">
								{if $objednavka.adresy.dod_firma}
									{assign var=f value=1}
									<tr>
										<th>Firma</th>
										<td class="text-right">{$objednavka.adresy.dod_firma}</td>
									</tr>
								{/if}
								{if $objednavka.adresy.dod_jmeno}
									{assign var=f value=1}
									<tr>
										<th>Jméno a příjmení</th>
										<td class="text-right">{$objednavka.adresy.dod_jmeno} {$objednavka.adresy.dod_prijmeni}</td>
									</tr>
								{/if}
								{if $objednavka.adresy.dod_ulice}
									{assign var=f value=1}
									<tr>
										<th>Ulice</th>
										<td class="text-right">{$objednavka.adresy.dod_ulice}</td>
									</tr>
								{/if}
								{if $objednavka.adresy.dod_mesto}
									{assign var=f value=1}
									<tr>
										<th>PSČ a město</th>
										<td class="text-right">{$objednavka.adresy.dod_psc} {$objednavka.adresy.dod_mesto}</td>
									</tr>
								{/if}
								{if $f != 1}
									Shodná s fakturační adresou
								{/if}
							</table>
						</div>
					</div>			
				</div>
			</div>
		<!-- /Základní údaje -->

		<!-- Produkty -->
			<div class="row">
                <div class="col-md-12">
                    <div class="box border blue">
                        <div class="box-title">
                            <h4><i class="fa fa-table"></i>Produkty v objednávce</h4>
                        </div>
						<div class="box-body table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th width="50"></th>
										<th>Název produktu</th>
										<th width="100" class="text-right">Počet</th>
										<th width="100" class="text-right">Cena za ks</th>
										<th width="100" class="text-right">Celkem</th>
										<th width="160" class="text-right">Celkem s DPH</th>
										<th width="90"></th>
									</tr>
								</thead>
								<tbody>
									{foreach $objednavka.polozky as $p}
										{assign var=celkem value={$p.pocet}*{$p.cena_ks}}
										{assign var=dph value=$p.produkt.cena.dph}
										{assign var=celkem_s_dph value=$celkem * (1+($dph/100))}
										<tr>
											<td class="text-center"><img src="{$smarty.const.ADMIN_PREFIX}images/{$p.produkt.obrazky.main.filename}" style="height: 30px;"></td>
											<td>{$p.produkt.nazev}</td>
											<td class="text-right">{$p.pocet} ks</td>
											<td class="text-right">{$p.cena_ks} Kč</td>
											<td class="text-right">{$celkem} Kč</td>
											<td class="text-right">{$celkem_s_dph} Kč</td>
											<td class="text-right">
												<a href="#" data-toggle="modal" data-target="#modal-zmenit-polozku-{$p.id}"><i class="fa fa-pencil fa-2x"></i></a>
												<a href="{$URL}admin/objednavky/smazat-polozku&id_polozky={$p.id}&id_objednavky={$objednavka.id}"><i class="fa fa-trash fa-2x left-offset-5"></i></a>
											</td>
										</tr>
									{/foreach}
								</tbody>
								<tfoot>
									<tr>
										<th></th>
										<th>Dopravné</th>
										<th></th>
										<th></th>
										<th></th>
										<th class="text-right">{$objednavka.doprava.castka_dopravy|number_format:1:",":" "} Kč</th>
										<th></th>
									</tr>
									<tr>
										<th></th>
										<th>Celková částka s dopravou</th>
										<th></th>
										<th></th>
										<th></th>
										<th class="text-right">{$objednavka.castka_s_dopravou} Kč</th>
										<th></th>
									</tr>
								</tfoot>
							</table>
                        </div>
                    </div>              
                </div>
            </div>
		<!-- /Produkty -->
		
		{if $objednavka.soutez}
			<!-- Objednaný nástřik na soutěž -->
				<div class="row">
	                <div class="col-md-12">
	                    <div class="box border blue">
	                        <div class="box-title">
	                            <h4><i class="fa fa-table"></i>Objednaný nástřik na soutěž</h4>
	                        </div>
							<div class="box-body table-responsive">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Jméno a příjmení</th>
											<th class="text-right">Datum příjezdu do místa konání soutěže</th>
											<th class="text-right">Čas příjezdu do místa konání soutěže</th>
											<th class="text-right">Požadované datum prvního nástřiku</th>
											<th class="text-right">Preferovaný čas prvního nástřiku</th>
											<th class="text-right">Pohlaví</th>
											<th class="text-right">Status</th>
											<th class="text-right">Divize</th>
											<th class="text-right">Třída</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>{$objednavka.soutez.athlete}</td>
											<td class="text-right">{$objednavka.soutez.city_date}</td>
											<td class="text-right">{$objednavka.soutez.city_time}</td>
											<td class="text-right">{$objednavka.soutez.application_date}</td>
											<td class="text-right">{$objednavka.soutez.application_time}</td>
											<td class="text-right">{$objednavka.soutez.gender}</td>
											<td class="text-right">{$objednavka.soutez.category}</td>
											<td class="text-right">{$objednavka.soutez.division}</td>
											<td class="text-right">{$objednavka.soutez.class}</td>
										</tr>
									</tbody>
								</table>
	                        </div>
	                    </div>              
	                </div>
	            </div>
			<!-- /Objednaný nástřik na soutěž -->
		{/if}

		<!-- Tlacitko -->
			<!-- <div class="fixed-buttons">
				<button type="submit" class="btn btn-success btn-md fixed-button" name="button" value="send">Uložit</button>
				<button type="submit" class="btn btn-success btn-md fixed-button" name="button" accesskey="s" value="send_exit">Uložit a odejít</button>
			</div> -->
		<!-- /Tlacitko -->
	</form>
	
	<!-- modals -->
		<form action="{$smarty.const.ADMIN_PREFIX}admin/?p1=objednavky&p2=zmenit-stav" method="post">
			<div class="modal fade" id="modal-zmenit-stav-{$o.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Upravit stav objednávky</h4>
						</div>
						<div class="modal-body">
							<select name="status" id="status" class="form-control">
								<option value="Přijatá objednávka" {if $objednavka.status=="Přijatá objednávka"}selected{/if}>Přijatá objednávka</option>
								<option value="Objednávka zaplacena" {if $objednavka.status=="Objednávka zaplacena"}selected{/if}>Objednávka zaplacena</option>
								<option value="Objednávka expedována" {if $objednavka.status=="Objednávka expedována"}selected{/if}>Objednávka expedována</option>
								<option value="Objednávka nezaplacena" {if $objednavka.status=="Objednávka nezaplacena"}selected{/if}>Objednávka nezaplacena</option>
								<option value="Objednávka stornována" {if $objednavka.status=="Objednávka stornována"}selected{/if}>Objednávka stornována</option>
							</select>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="id" id="id" value="{$objednavka.id}">
							<button type="button" class="btn btn-default" data-dismiss="modal">Storno</button>
							<button type="submit" class="btn btn-primary">Uložit</button>
						</div>
					</div>
				</div>
			</div>
		</form>

		<form action="{$smarty.const.ADMIN_PREFIX}admin/?p1=objednavky&p2=zmenit-dodaci-adresu" method="post">
			<div class="modal fade" id="modal-zmenit-dodaci-adresu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Upravit dodací adresu</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="firma">Firma</label>
										<input type="text" name="firma" value="{$objednavka.adresy.firma}" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="jmeno">Jméno</label>
										<input type="text" name="jmeno" value="{$objednavka.adresy.jmeno}" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="prijmeni">Příjmení</label>
										<input type="text" name="prijmeni" value="{$objednavka.adresy.prijmeni}" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="ulice">Ulice</label>
										<input type="text" name="ulice" value="{$objednavka.adresy.ulice}" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="psc">PSČ</label>
										<input type="text" name="psc" value="{$objednavka.adresy.psc}" class="form-control">
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label for="mesto">Město</label>
										<input type="text" name="mesto" value="{$objednavka.adresy.mesto}" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="telefon">Telefon</label>
										<input type="text" name="telefon" value="{$objednavka.adresy.telefon}" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="email">E-mail</label>
										<input type="text" name="email" value="{$objednavka.adresy.email}" class="form-control">
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="id" id="id" value="{$objednavka.id}">
							<button type="button" class="btn btn-default" data-dismiss="modal">Storno</button>
							<button type="submit" class="btn btn-primary">Uložit</button>
						</div>
					</div>
				</div>
			</div>
		</form>

		<form action="{$smarty.const.ADMIN_PREFIX}admin/?p1=objednavky&p2=zmenit-fakturacni-adresu" method="post">
			<div class="modal fade" id="modal-zmenit-fakturacni-adresu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Upravit fakturační adresu</h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="firma">Firma</label>
										<input type="text" name="dod_firma" value="{$objednavka.adresy.dod_firma}" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="jmeno">Jméno</label>
										<input type="text" name="dod_jmeno" value="{$objednavka.adresy.dod_jmeno}" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="prijmeni">Příjmení</label>
										<input type="text" name="dod_prijmeni" value="{$objednavka.adresy.dod_prijmeni}" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="ulice">Ulice</label>
										<input type="text" name="dod_ulice" value="{$objednavka.adresy.dod_ulice}" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="psc">PSČ</label>
										<input type="text" name="dod_psc" value="{$objednavka.adresy.dod_psc}" class="form-control">
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label for="mesto">Město</label>
										<input type="text" name="dod_mesto" value="{$objednavka.adresy.dod_mesto}" class="form-control">
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="id" id="id" value="{$objednavka.id}">
							<button type="button" class="btn btn-default" data-dismiss="modal">Storno</button>
							<button type="submit" class="btn btn-primary">Uložit</button>
						</div>
					</div>
				</div>
			</div>
		</form>

		{foreach $objednavka.polozky as $p}
			<form action="{$smarty.const.ADMIN_PREFIX}admin/?p1=objednavky&p2=zmenit-polozku" method="post">
				<div class="modal fade" id="modal-zmenit-polozku-{$p.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Upravit položku</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-4 text-center">
										<img src="{$URL}images/{$p.produkt.obrazky.main.filename}" style="max-width: 50px; max-height: 100px;">
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="pocet">Počet kusů</label>
											<input type="number" name="pocet" value="{$p.pocet}" class="form-control" min="1">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="cena_ks">Cena za kus</label>
											<input type="text" name="cena_ks" value="{$p.cena_ks}" class="form-control">
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<input type="hidden" name="id" id="id" value="{$p.id}">
								<input type="hidden" name="id_objednavky" id="id_objednavky" value="{$objednavka.id}">
								<button type="button" class="btn btn-default" data-dismiss="modal">Storno</button>
								<button type="submit" class="btn btn-primary">Uložit</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		{/foreach}

	<!-- modals -->

{/block}

{block name=scripts}
	<script type="text/javascript">
		$('#modal-zmenit-stav').on('show.bs.modal', function (event) {})
		$('#modal-zmenit-dodaci-adresu').on('show.bs.modal', function (event) {})
		$('#modal-zmenit-fakturacni-adresu').on('show.bs.modal', function (event) {})
		{foreach $objednavka.polozky as $p}
			$('#modal-zmenit-polozku-{$p.id}').on('show.bs.modal', function (event) {})
		{/foreach}
	</script>

	<script>
        CKEDITOR.replace( 'editor1' );
    </script>
	<script>
        CKEDITOR.replace( 'editor2' );
    </script>
{/block}