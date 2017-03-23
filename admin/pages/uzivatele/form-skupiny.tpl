{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="row">
		<div class="col-md-12">	
			{if $smarty.get.p3 == 'novy'}
				<h1>Přidání uživatele</h1>
			{elseif $smarty.get.p3 == 'edit'}
				<h1>Editace uživatele {$uzivatel.nazev}</h1>
			{/if}
		</div>
	</div>
	
	<form action="/admin/?p1=nastaveni&p2=uzivatele&p3={$smarty.get.p3}&akce=ulozit" method="post" role="form">
		<div class="row">	
			<div class="col-md-12">
				<div class="box border blue">
					<div class="box-title">
						<h4><i class="fa fa-table"></i>Základní údaje skupiny</h4>
					</div>
					<div class="box-body table-responsive">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Název</label>
									<input type="text" class="form-control" id="" name="name" value="{$skupina.name}" placeholder="Název skupiny">
								</div>								
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
						<h4><i class="fa fa-table"></i>Přidělená uživatelská práva</h4>
					</div>
					<div class="box-body table-responsive">
						<div class="row">
							{foreach $skupina.prava as $p key=k item=v}
								{if $k != 'id' && $k != 'id_skupiny'}
									<div class="col-md-3">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="{$k}" {if $p.$k == 1}checked{/if}>{$k}
											</label>
										</div>
									</div>
								{/if}
							{/foreach}
						</div>
					</div>
				</div>			
			</div>
		</div>

		<input type="hidden" name="id" value="{$skupina.id}">
		<div class="fixed-buttons">
			<button type="submit" class="btn btn-success btn-md fixed-button" name="button" value="send">Uložit</button>
			<button type="submit" class="btn btn-success btn-md fixed-button" name="button" accesskey="s" value="send_exit">Uložit a odejít</button>
		</div>

	</form>
{/block}