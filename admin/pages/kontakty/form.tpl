{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<form action="/admin/?p1=nastaveni&p2=kontakty&p3={$smarty.get.p3}&akce=ulozit" method="post" role="form" enctype="multipart/form-data">
		<input type="hidden" name="skupina" value="{$smarty.get.type}">
		<div class="row">	
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Údaje</h4>
							</div>
							<div class="box-body table-responsive">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="nazev">Název:</label><input type="text" class="form-control" id="nazev" name="nazev" value="{$kontakt.nazev}" placeholder="Název kontaktu">
										</div>									
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="dlouhy_nazev">Dlouhý název:</label><input type="text" class="form-control" id="dlouhy_nazev" name="dlouhy_nazev" value="{$kontakt.dlouhy_nazev}" placeholder="Dlouhý název kontaktu">
										</div>									
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="nazev">Umístění:</label><input type="text" class="form-control" id="umisteni" name="umisteni" value="{$kontakt.umisteni}" placeholder="Umístění">
										</div>									
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="telefon">Telefon:</label><input type="text" class="form-control" id="telefon" name="telefon" value="{$kontakt.telefon}" placeholder="Telefon">
										</div>	
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="mobil">Mobil:</label><input type="text" class="form-control" id="mobil" name="mobil" value="{$kontakt.mobil}" placeholder="Mobil">
										</div>	
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="mobil">E-mail:</label><input type="text" class="form-control" id="email" name="email" value="{$kontakt.email}" placeholder="E-mail">
										</div>	
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="nazev">Web:</label><input type="text" class="form-control" id="web" name="web" value="{$kontakt.web}" placeholder="Web">
										</div>									
									</div>
								</div>
							</div>
						</div>						
					</div>
				</div>
				{if $smarty.get.type == 1 || $kontakt.skupina == 1}
					<div class="row">	
						<div class="col-md-12">
							<div class="box border blue">
								<div class="box-title">
									<h4><i class="fa fa-table"></i>Provozní doba</h4>
								</div>
								<div class="box-body table-responsive">
									{for $i=1 to 7}
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-2"></div>
													<div class="col-md-2">
														<div class="form-group">
															{if $i == 1}{assign var=label value='Pondělí'}
															{elseif $i == 2}{assign var=label value='Úterý'}
															{elseif $i == 3}{assign var=label value='Středa'}
															{elseif $i == 4}{assign var=label value='Čtvrtek'}
															{elseif $i == 5}{assign var=label value='Pátek'}
															{elseif $i == 6}{assign var=label value='Sobota'}
															{elseif $i == 7}{assign var=label value='Neděle'}
															{/if}
															<label for="">{$label}</label>
														</div>														
													</div>
													<div class="col-md-3">
														<div class="row">
															<div class="col-md-5"><div class="form-group"><input type="text" name="{$i}_dop_od" value="{$kontakt.provozni_doba.$i.dop_od}" class="form-control"></div></div>
															<div class="col-md-2">-</div>
															<div class="col-md-5"><div class="form-group"><input type="text" name="{$i}_dop_do" value="{$kontakt.provozni_doba.$i.dop_do}" class="form-control"></div></div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="row">
															<div class="col-md-5"><div class="form-group"><input type="text" name="{$i}_odp_od" value="{$kontakt.provozni_doba.$i.odp_od}" class="form-control"></div></div>
															<div class="col-md-2">-</div>
															<div class="col-md-5"><div class="form-group"><input type="text" name="{$i}_odp_do" value="{$kontakt.provozni_doba.$i.odp_do}" class="form-control"></div></div>
														</div>
													</div>
													<div class="col-md-2"></div>
												</div>
											</div>
										</div>
									{/for}
								</div>
							</div>			
						</div>
					</div>
				{/if}
				<div class="row">	
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Iframe mapy - zdroj</h4>
							</div>
							<div class="box-body table-responsive">
								<textarea name="mapa" class="form-control" rows="10">{$kontakt.mapa}</textarea>
							</div>
						</div>			
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Mapa</h4>
							</div>
							<div class="box-body table-responsive">
					            {if $kontakt.mapa}
									{$kontakt.mapa}
					            {else}
									Mapa dosud nebyla vložena
					            {/if}
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
								<h4><i class="fa fa-table"></i>Foto</h4>
							</div>
							<div class="box-body table-responsive text-center">
								{if $kontakt.foto}
									<a class="fancybox" rel="gallery1" href="/contact_images/{$kontakt.foto}" title="Obrázek kontaktu {$kontakt.nazev}">
										<img src="/contact_images/{$kontakt.foto}" style="width: 70%;"><br /><br />
						            </a>            	
								{else}
									<p>Dosud nebyla vložena žádná fotografie</p>
								{/if}
								<div class="form-group">
								    <input type="file" id="soubor" name="foto" class="form-control">
								</div>
							</div>
						</div>		
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>QR kód</h4>
							</div>
							<div class="box-body table-responsive text-center">
								{if $kontakt.qr}
									<a class="fancybox" rel="gallery1" href="/contact_images/{$kontakt.qr}" title="QR kód kontaktu {$kontakt.nazev}">
										<img src="/contact_images/{$kontakt.qr}" style="width: 70%;"><br /><br />
									</a>
								{else}
									<p>Dosud nebyl vložen žádný QR kód</p>
								{/if}
								<div class="form-group">
								    <input type="file" id="soubor" name="qr" class="form-control">
								</div>
							</div>
						</div>	
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Vizitka</h4>
							</div>
							<div class="box-body table-responsive text-center">
								{if $kontakt.vizitka}
									<a href="/contact_vizitky/{$kontakt.vizitka}">
										Stáhnout soubor										
									</a>
								{else}
									<p>Dosud nebyla vložena vizitka</p>
								{/if}
								<div class="form-group">
								    <input type="file" id="soubor" name="vizitka" class="form-control">
								</div>
							</div>
						</div>	
					</div>
				</div>
				{if $smarty.get.type == 1}
					<div class="row">	
						<div class="col-md-12">
							<div class="box border blue">
								<div class="box-title">
									<h4><i class="fa fa-table"></i>Kontakty této pobočky</h4>
								</div>
								<div class="box-body table-responsive">
									{foreach $kontakty_pobocky as $kontakt_pobocky}
										<div class="checkbox">
											<label for="">
												{assign var=id value=$kontakt_pobocky.id}
												<input type="checkbox" name="pobocky_lide[]" value="{$kontakt_pobocky.id}" {if $kontakt_pobocky.id|in_array:$kontakt.kontakty}checked{/if}>{$kontakt_pobocky.nazev}
											</label>
										</div>
									{foreachelse}
										Nejsou vytvořeni žádní lidé
									{/foreach}																		
								</div>
							</div>			
						</div>
					</div>
				{/if}
			</div>
		</div>
		
		<input type="hidden" name="id" value="{$kontakt.id}">
		<!-- Tlacitko -->
			<div class="fixed-buttons">
				<!-- <button type="submit" class="btn btn-success btn-md fixed-button" name="button" value="send">Uložit</button> -->
				<button type="submit" class="btn btn-success btn-md fixed-button" name="button" accesskey="s" value="send_exit">Uložit a odejít</button>
			</div>
		<!-- /Tlacitko -->
	</form>
{/block}
{block name=scripts}
	<script type="text/javascript">
        $(document).ready(function() {
            $('.fancybox').fancybox();
        });
    </script>
{/block}