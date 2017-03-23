{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}

{block name=content}
	<div class="row">
		<div class="col-md-12">	
			{if $smarty.get.p2 == 'novy'}
				<h1>Přidání položky</h1>
			{elseif $smarty.get.p2 == 'edit'}
				<h1>Editace položky {$polozka.nadpis}</h1>
			{/if}
		</div>
	</div>
	<form action="/admin/?p1=seznamy&p2={$smarty.get.p2}&akce=ulozit" method="post" role="form" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-9">
				<div class="box border blue">
					<div class="box-title">
						<h4><i class="fa fa-table"></i>Položka</h4>
					</div>
					<div class="box-body table-responsive">
						{assign var=nazev value=$polozka.nazev}
						{assign var=podnazev value=$polozka.podnazev}
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<label for="">Titulek <span style="text-transform: uppercase;">{$j.zkratka}</span></label>
									<input type="text" class="form-control" id="" name="nazev" value="{$nazev}" placeholder="Titulek">
								</div>								
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Kategorie</label>
									<select name="kategorie" class="form-control">
										{foreach $seznam_kategorii as $kat}
											<option value="{$kat.id}" {if $kat.id == $polozka.kategorie}selected{/if}>{$kat.nazev}</option>
										{/foreach}
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Podtitulek <span style="text-transform: uppercase;">{$j.zkratka}</span></label>
									<input type="text" class="form-control" id="" name="podnazev" value="{$podnazev}" placeholder="Podtitulek">
								</div>								
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
								<h4><i class="fa fa-table"></i>Fotografie</h4>
							</div>
							<div class="box-body table-responsive">
								<div class="row">	
									<div class="col-md-12">
										<div class="form-group">
											<div class="row">
												<div class="col-md-12 text-center">
													<a href="{$smarty.const.ADMIN_PREFIX}images/{$polozka.obrazek}" class="fancybox" rel="group1">
														<img src="{$smarty.const.ADMIN_PREFIX}images/{$polozka.obrazek}" style="border:1px solid grey; padding: 3px; width: 100%; margin-bottom: 20px;">
													</a>
												</div>
											</div>
											<!-- <div style="height: 30px;"></div> -->
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>Obrázek {$i}:</label>
														<input type="file" name="fotogalerie1" class="form-control">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Tlacitko -->
			<input type="hidden" name="id" value="{$polozka.id}">
			<div class="fixed-buttons">
				<input type="hidden" name="autor" value="{$logged_user.id}">
				<button type="submit" class="btn btn-success btn-md fixed-button" name="button" value="send">Uložit</button>
				<button type="submit" class="btn btn-success btn-md fixed-button" name="button" accesskey="s" value="send_exit">Uložit a odejít</button>
			</div>
		<!-- /Tlacitko -->
	</form>
{/block}

{block name=scripts}
	{foreach $jazyky as $j}
		<script>
	        CKEDITOR.replace( 'editor_anotace_{$j.zkratka}' );
	    </script>
		<script>
	        CKEDITOR.replace( 'editor_text_{$j.zkratka}' );
	    </script>
		<script type="text/javascript">
	        $(document).ready(function() {
	            $('.fancybox').fancybox();
	        });
	    </script>
	{/foreach}
{/block}