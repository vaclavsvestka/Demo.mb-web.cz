{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=breadcrumb}
	{assign var=module value='Galerie'}
	{if $smarty.get.p2 == "novy"}{assign var=v value="Přidání fotografie"}{else}{assign var=v value="Editace fotografie"}{/if}
	{assign var=page value=$v}
	{include file="../breadcrumb.tpl"}
{/block}
{block name=content}
	<form action="{$smarty.const.ADMIN_PREFIX}admin/?p1=galerie&p2={$smarty.get.p2}&akce=ulozit" method="post" role="form" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-12">
				<div class="box border blue">
					<div class="box-title">
						<h4><i class="fa fa-table"></i>Soubor</h4>
					</div>
					<div class="box-body table-responsive">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Popisek</label>
									<input type="text" class="form-control" id="" name="popis" value="{$obrazek.popis}" placeholder="Popis">
								</div>								
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="">Album</label>
									<select name="album" class="form-control">
										{foreach $album as $a}
											{if $smarty.get.p2 == "novy"}
												<option value="{$a.id}" {if $a.id == $smarty.get.p3}selected{/if}>{$a.nazev}</option>
											{else}
												<option value="{$a.id}" {if $a.id == $obrazek.album}selected{/if}>{$a.nazev}</option>
											{/if}
										{/foreach}
									</select>
								</div>								
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="">Řazení</label>
									<input type="text" class="form-control" id="" name="sort" value="{$obrazek.sort}" placeholder="Řazení">
								</div>								
							</div>
						</div>
						{if $smarty.get.p2 != "edit"}
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Obrázek</label>
										<input type="file" name="obrazek_velky" class="form-control">
									</div>								
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Náhled</label>
										<input type="file" name="obrazek_maly" class="form-control">
									</div>								
								</div>
							</div>
						{else}
							<div class="row">
								<div class="col-md-12">
									* editace obrázků není možná. Pokud chcete použít jiný obrázek, tak smažte tento a přidejte nový.
								</div>
							</div>
						{/if}
					</div>
				</div>
			</div>
		</div>
		<!-- Tlacitko -->
			<input type="hidden" name="id" value="{$obrazek.id}">
			<div class="fixed-buttons">
				<input type="hidden" name="autor" value="{$logged_user.id}">
				<!-- <button type="submit" class="btn btn-success btn-md fixed-button" name="button" value="send">Uložit</button> -->
				<button type="submit" class="btn btn-success btn-md fixed-button" name="button" accesskey="s" value="send_exit">Uložit a odejít</button>
			</div>
		<!-- /Tlacitko -->
	</form>
{/block}