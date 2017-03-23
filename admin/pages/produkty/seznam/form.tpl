{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<form action="/admin/?p1={$smarty.get.p1}&p2={$smarty.get.p2}&p3={$smarty.get.p3}&akce=ulozit" method="post" role="form" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
				            <div class="box-title">
				                <h4><i class="fa fa-table"></i>Základní informace</h4>
				                <div class="tools"></div>
				            </div>
				            <div class="box-body table-responsive">
				                <div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="nazev">Název:</label><input type="text" class="form-control" id="nazev" name="nazev" value="{$produkt.nazev}" placeholder="Název produktu" autofocus>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label for="cena">Cena:</label>
											<input type="text" class="form-control" id="cena" name="cena" value="{$produkt.cena}" placeholder="Cena" required>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="stara_cena">Stará cena:</label>
											<input type="text" class="form-control" id="stara_cena" name="stara_cena" value="{$produkt.stara_cena}" placeholder="Stará cena (přeškrtnutá v seznamu produktů)">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="cena">Značka:</label>
											<select name="znacka" class="form-control" id="">
												<option value="0">Bez značky</option>
												{foreach $znacky as $z}
													<option value="{$z.id}" {if $z.id == $produkt.znacka}selected{/if}>{$z.nazev}</option>
												{/foreach}
											</select>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="sort">Pořadí:</label>
											<input type="number" class="form-control" id="sort" name="sort" value="{$produkt.sort}" placeholder="Pořadí">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="sort">Aktivní:</label>
											<select name="aktivni" class="form-control">
												<option value="1" {if $produkt.aktivni == 1}selected{/if}>Ano</option>
												<option value="0" {if $produkt.aktivni == 0}selected{/if}>Ne</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="popis">Krátký popis:</label>
											<textarea name="kratky_popis" class="form-control">{$produkt.kratky_popis}</textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="popis">Dlouhý popis:</label>
										<textarea name="popis" id="editor1" rows="5" cols="80">
							                {$produkt.popis}
							            </textarea>
									</div>
								</div>
				            </div>
				        </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
				        <div class="box border blue">
				            <div class="box-title">
				                <h4><i class="fa fa-table"></i>Parametry</h4>
				                <div class="tools"></div>
				            </div>
				            <div class="box-body table-responsive">
				            	<div class="row">
				            		{foreach $parametry as $p}
										<div class="col-md-4">
											<div class="form-group">
												<label for="{$p.nazev}">{$p.nazev}</label>
												{assign var=id value=$p.id}
												<input type="text" class="form-control" id="{$p.nazev}" name="parametr[{$p.id}]" value="{$produkt.parametry.$id.hodnota}" placeholder="">
											</div>
										</div>
									{/foreach}
								</div>
				            </div>
				        </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
		                    <div class="box-title">
		                        <h4><i class="fa fa-table"></i>Nahrát obrázky</h4>
		                        <div class="tools"></div>
		                    </div>
		                    <div class="box-body table-responsive">
		                    	<div class="row">
		                    		<div class="col-md-6">
				                        <input type="file" name="file[]" accept="image/*">
				                        <input type="file" name="file[]" accept="image/*">
				                        <input type="file" name="file[]" accept="image/*">
				                        <input type="file" name="file[]" accept="image/*">
				                        <input type="file" name="file[]" accept="image/*">
		                    		</div>
		                    		<div class="col-md-6">
				                        <input type="file" name="file[]" accept="image/*">
				                        <input type="file" name="file[]" accept="image/*">
				                        <input type="file" name="file[]" accept="image/*">
				                        <input type="file" name="file[]" accept="image/*">
				                        <input type="file" name="file[]" accept="image/*">
		                    		</div>
		                    	</div>
		                    </div>
		                </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
		                    <div class="box-title">
		                        <h4><i class="fa fa-table"></i>Již přidané obrázky</h4>
		                        <div class="tools"></div>
		                    </div>
		                    <div class="box-body table-responsive">
		                       	{if $produkt.obrazky.main}
			                        <div class="row">
			                            <div class="col-md-4 text-center">
			                                <a class="fancybox" rel="gallery1" href="/images/{$produkt.obrazky.main.filename}" title="">
			                                    <img src="/images/{$produkt.obrazky.main.filename}" style="width:100%; margin: 5px;" alt="">
			                                </a>
			                            </div>              
			                            <div class="col-md-6">
			                                {$produkt.obrazky.main.title}
			                            </div>
			                            <div class="col-md-2">
			                                <div class="checkbox" style="margin: 0;">
			                                    <label>
			                                        <input type="checkbox" name="smazat_obrazek[{$produkt.obrazky.main.id}]"> Smazat
			                                    </label>
			                                </div>
			                                <div class="radio" style="margin: 0;">
			                                    <label>
			                                        <input type="radio" name="hlavni_obrazek" value="{$produkt.obrazky.main.id}" {if $produkt.obrazky.main.main == 1}checked{/if}> Hlavní fotka
			                                    </label>
			                                </div>
			                            </div>        
			                        </div>
			                        <div class="row">
			                        	<div class="col-md-12"><hr></div>
			                        </div>
		                       	{/if}
		                        {foreach $produkt.obrazky.ostatni as $soubor}
		                            <div class="row">
		                                <div class="col-md-4 text-center">
		                                    <a class="fancybox" rel="gallery1" href="/images/{$soubor.filename}" title="">
		                                        <img src="/images/{$soubor.filename}" style="width:100%; margin: 5px;" alt="">
		                                    </a>
		                                </div>              
		                                <div class="col-md-6">
		                                    {$soubor.title}
		                                </div>
		                                <div class="col-md-2">
		                                    <div class="checkbox" style="margin: 0;">
		                                        <label>
		                                            <input type="checkbox" name="smazat_obrazek[{$soubor.id}]"> Smazat
		                                        </label>
		                                    </div>
		                                    <div class="radio" style="margin: 0;">
		                                        <label>
		                                            <input type="radio" name="hlavni_obrazek" value="{$soubor.id}" {if $soubor.main == 1}checked{/if}> Hlavní fotka
		                                        </label>
		                                    </div>
		                                </div>        
		                            </div>
		                            <div class="row">
		                            	<div class="col-md-12"><hr></div>
		                            </div>
		                        {/foreach}                        
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
				                <h4><i class="fa fa-table"></i>Kategorie</h4>
				                <div class="tools"></div>
				            </div>
				            <div class="box-body table-responsive">
				            	{foreach $kategorie as $k}
									{assign var=kid value=$k.id}
									<div class="checkbox" style="margin-left: 0px;"><label><input type="checkbox" name="kategorie[{$k.id}]" id="kat{$k.id}" value="{$k.id}" {if $produkt.kategorie.$kid}checked{/if}>{$k.nazev}</label></div>
									{if $k.podkategorie}
										{foreach $k.podkategorie as $l}
											{assign var=lid value=$l.id}
											<div class="checkbox" style="margin-left: 20px;"><label><input type="checkbox" name="kategorie[{$l.id}]" id="podkat{$k.id}" class="podkat{$k.id}" value="{$l.id}" {if $produkt.kategorie.$lid}checked{/if}>{$l.nazev}</label></div>
											{if $l.podkategorie}
												{foreach $l.podkategorie as $m}
													{assign var=mid value=$m.id}
													<div class="checkbox" style="margin-left: 40px;"><label><input type="checkbox" name="kategorie[{$m.id}]" class="podpodkat{$k.id}" value="{$m.id}" {if $produkt.kategorie.$mid}checked{/if}>{$m.nazev}</label></div>
													{if $m.podkategorie}
														{foreach $m.podkategorie as $n}
															{assign var=nid value=$n.id}
															<div class="checkbox" style="margin-left: 60px;"><label><input type="checkbox" name="kategorie[{$n.id}]" class="podpodpodkat{$k.id}" value="{$n.id}" {if $produkt.kategorie.$nid}checked{/if}>{$n.nazev}</label></div>
														{/foreach}
													{/if}
												{/foreach}
											{/if}
										{/foreach}
									{/if}
								{/foreach}
				            </div>
				        </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
				            <div class="box-title">
				                <h4><i class="fa fa-table"></i>Štítky</h4>
				                <div class="tools"></div>
				            </div>
				            <div class="box-body table-responsive">
				            	{foreach $stitky as $s}
				            		<div class="checkbox" style="margin-left: 0px;">
					            		<label>
					            			{assign var=sid value=$s.id}
					            			<input type="checkbox" name="stitky[{$s.id}]" value="{$s.id}" {if $produkt.stitky.$sid}checked{/if}>{$s.nazev}
					            		</label>
				            		</div>
								{/foreach}
				            </div>
				        </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
				            <div class="box-title">
				                <h4><i class="fa fa-table"></i>Historie cen</h4>
				                <div class="tools"></div>
				            </div>
				            <div class="box-body table-responsive">
				            	<table class="table table-striped">
					            	{foreach $produkt.historie_cen as $cena}
										<tr>
											<td width="200">{$cena.datum_zmeny|date_format:"%d. %m. %Y"}</td>
											<td>{$cena.cena_czk} Kč</td>
										</tr>
					            	{/foreach}
				            	</table>
				            </div>
				        </div>
					</div>
				</div>
				<!-- <div class="row">
					<div class="col-md-12">
						<div class="box border blue">
				            <div class="box-title">
				                <h4><i class="fa fa-table"></i>Graf</h4>
				                <div class="tools"></div>
				            </div>
				            <div class="box-body table-responsive">
				            </div>
				        </div>
					</div>
				</div> -->
			</div>
		</div>
		<input type="hidden" name="id" value="{$produkt.id}">
		<div class="fixed-buttons">
			<button type="submit" class="btn btn-success btn-md fixed-button" name="button" value="send">Uložit</button>
			<button type="submit" class="btn btn-success btn-md fixed-button" name="button" accesskey="s" value="send_exit">Uložit a odejít</button>
		</div>
	</form>
{/block}
{block name=scripts}
	<script type="text/javascript">
        $(document).ready(function() {
            $('.fancybox').fancybox();
        });
    </script>
	<script type="text/javascript">
        CKEDITOR.replace( 'editor1' );
    </script>
{/block}