{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=breadcrumb}
	{assign var=module value='Galerie'}
	{if $smarty.get.p2 == "nove-album"}{assign var=v value="Vytvoření alba"}{else}{assign var=v value="Editace alba"}{/if}
	{assign var=page value=$v|cat:" "|cat:$album.nazev}
	{include file="../../breadcrumb.tpl"}
{/block}
{block name=content}
	<form action="{$smarty.const.ADMIN_PREFIX}admin/?p1=galerie&p2={$smarty.get.p2}&akce=ulozit" method="post" role="form" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-12">
				<div class="box border blue">
					<div class="box-title">
						<h4><i class="fa fa-table"></i>Album</h4>
					</div>
					<div class="box-body table-responsive">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Název</label>
									<input type="text" class="form-control" id="" name="nazev" value="{$album.nazev}" placeholder="Zadejte název alba" autofocus="">
								</div>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Tlacitko -->
			<input type="hidden" name="id" value="{$album.id}">
			<div class="fixed-buttons">
				<input type="hidden" name="autor" value="{$logged_user.id}">
				<button type="submit" class="btn btn-success btn-md fixed-button" name="button" accesskey="s" value="send_exit">Uložit a odejít</button>
			</div>
		<!-- /Tlacitko -->
	</form>
{/block}