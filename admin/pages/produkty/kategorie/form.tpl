{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<form action="/admin/?p1={$smarty.get.p1}&p2={$smarty.get.p2}&p3={$smarty.get.p3}&akce=ulozit" method="post" role="form" enctype="multipart/form-data">
		<div class="row">	
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-9">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Údaje</h4>
							</div>
							<div class="box-body table-responsive">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="nazev">Název:</label><input type="text" class="form-control" id="nazev" name="nazev" value="{$kat.nazev}" placeholder="Název kategorie">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="nazev">Patří do kategorie:</label>
											<select name="parent_id" id="" class="form-control">
												<option value="0">Žádná</option>
												{foreach $kategorie as $k}
													<option value="{$k.id}" {if $kat.parent_id == $k.id}selected{/if}>{$k.nazev}</option>
													{if $k.podkategorie}
														{foreach $k.podkategorie as $l}
															<option value="{$l.id}" {if $kat.parent_id == $l.id}selected{/if}>{$k.nazev} -> {$l.nazev}</option>
															{if $l.podkategorie}
																{foreach $l.podkategorie as $m}
																	<option value="{$m.id}" {if $kat.parent_id == $m.id}selected{/if}>{$k.nazev} -> {$l.nazev} -> {$m.nazev}</option>
																{/foreach}
															{/if}
														{/foreach}
													{/if}
												{/foreach}
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="sort">Pořadí:</label>
											<input type="number" class="form-control" id="sort" name="sort" value="{$kat.sort}" placeholder="Pořadí">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="sort">Aktivní:</label>
											<select name="aktivni" class="form-control">
												<option value="1" {if $kat.aktivni == 1}selected{/if}>Ano</option>
												<option value="0" {if $kat.aktivni == 0}selected{/if}>Ne</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="popis">Popis:</label>
										<textarea name="popis" id="editor1" rows="5" cols="80">
							                {$kat.popis}
							            </textarea>
									</div>
								</div>
							</div>
						</div>						
					</div>
					<div class="col-md-3">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Obrázek</h4>
							</div>
							<div class="box-body table-responsive text-center">
								{if $kat.obrazky.main.filename}
									<a class="fancybox" rel="gallery1" href="/images/{$kat.obrazky.main.filename}" title="Obrázek kategorie {$kat.nazev}">
										<img src="/images/{$kat.obrazky.main.filename}" style="width: 70%;"><br /><br />
						            </a>            	
								{else}
									<p>Dosud nebyl vložen žádný obrázek</p>
								{/if}
								<div class="form-group">
				                    <input type="file" name="file[]" accept="image/*" class="form-control">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<input type="hidden" name="id" value="{$kat.id}">
		<!-- Tlacitko -->
			<div class="fixed-buttons">
				<button type="submit" class="btn btn-success btn-md fixed-button" name="button" value="send">Uložit</button>
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
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
{/block}