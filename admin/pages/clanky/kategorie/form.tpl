{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="row">
		<div class="col-md-12">	
			{if $smarty.get.p3 == 'novy'}
				<h1>Přidání kategorie</h1>
			{elseif $smarty.get.p3 == 'edit'}
				<h1>Editace kategorie {$kategorie.nazev}</h1>
			{/if}
		</div>
	</div>
	
	<form action="/admin/?p1=clanky&p2={$smarty.get.p2}&p3={$smarty.get.p3}&akce=ulozit" method="post" role="form">
		<div class="row">	
			<div class="col-md-12">
				<div class="box border blue">
					<div class="box-title">
						<h4><i class="fa fa-table"></i>Základní údaje kategorie</h4>
					</div>
					<div class="box-body table-responsive">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Název</label>
									<input type="text" class="form-control" id="" name="nazev" value="{$kategorie.nazev}" placeholder="Název kategorie">
								</div>								
							</div>
						</div>
					</div>
				</div>			
			</div>
		</div>

		<input type="hidden" name="id" value="{$kategorie.id}">
		<div class="fixed-buttons">
			<button type="submit" class="btn btn-success btn-md fixed-button" name="button" value="send">Uložit</button>
			<button type="submit" class="btn btn-success btn-md fixed-button" name="button" accesskey="s" value="send_exit">Uložit a odejít</button>
		</div>

	</form>
{/block}