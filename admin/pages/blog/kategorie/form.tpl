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
	
	<form action="/admin/?p1=blog&p2={$smarty.get.p2}&p3={$smarty.get.p3}&akce=ulozit" method="post" role="form">
		<div class="row">
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-12">
						<ul class="nav nav-tabs" role="tablist">
							{foreach $jazyky as $j}
								{if $j.zkratka == "cs"}
									<li role="presentation" class="active"><a href="#{$j.zkratka}" aria-controls="{$j.zkratka}" role="tab" data-toggle="tab">{$j.nazev}</a></li>
								{else}
									<li role="presentation"><a href="#{$j.zkratka}" aria-controls="{$j.zkratka}" role="tab" data-toggle="tab">{$j.nazev}</a></li>
								{/if}
							{/foreach}
						</ul>
						<hr>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="tab-content">
							{foreach $jazyky as $j}
								{assign var=zkratka value=$j.zkratka}
								{assign var=nazev value=$kategorie.texty.$zkratka.nazev}
								<div role="tabpanel" class="tab-pane {if $j.zkratka == "cs"}active{/if}" id="{$j.zkratka}">
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
																<label for="">Název {$zkratka}</label>
																<input type="text" class="form-control" id="" name="nazev_{$zkratka}" value="{$nazev}" placeholder="Název kategorie" autofocus="">
															</div>								
														</div>
													</div>
												</div>
											</div>			
										</div>
									</div>
								</div>
							{/foreach}
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row">	
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Další nastavení</h4>
							</div>
							<div class="box-body table-responsive">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">URL</label>
											<input type="text" class="form-control" id="" name="url" value="{$kategorie.url}" placeholder="URL kategorie" autofocus="">
										</div>								
									</div>
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