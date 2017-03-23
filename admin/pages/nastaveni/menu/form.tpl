{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="row">
		<div class="col-md-12">
			<div class="box border blue">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>{if $smarty.get.p2 == "edit"}Editace{else}Vytvoření{/if} položky</h4>
				</div>
				<div class="box-body table-responsive">
					<form action="/admin/?p1=nastaveni&p2=menu&p3={$smarty.get.p3}&akce=ulozit" method="post" role="form">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Název</label>
									<input type="text" class="form-control" id="" name="nazev" value="{$aktualni_polozka.nazev}" placeholder="Název položky" required>
								</div>
								<div class="form-group">
									<label for="">Nadřazená položka</label>
									<select name="nadrazena" id="" class="form-control">
										<option value="0" {if $aktualni_polozka.parent_id eq 0}selected{/if}>Není nadřazená položka</option>
										{foreach from=$menu item=polozka}
											{if is_array($polozka.3)}
												<option value="{$polozka.id}" {if $aktualni_polozka.parent_id eq $polozka.id}selected{/if}>{$polozka.nazev}</option>
												{foreach from=$polozka.3 item=polozka1}
													<option value="{$polozka1.id}" {if $aktualni_polozka.parent_id == $polozka1.id}selected{/if} style="margin-left: 15px">{$polozka1.nazev}</option>
												{/foreach}								
											{else}
												<option value="{$polozka.id}" {if $aktualni_polozka.parent_id == $polozka.id}selected{/if}>{$polozka.nazev}</option>
											{/if}
										{/foreach}		
									</select>
								</div>
								<div class="form-group">
									<label for="">Výběr z textů (má přednost před ručním odkazem, tj. pokud bude vybráno toto políčko, na ruční odkaz nebude brán zřetel)</label>
									<select name="clanek" class="form-control">
										{foreach $texty as $t}
											<option value="{$t.id}" {if $t.id == $aktualni_polozka.clanek}selected{/if}>{$t.texty.cs.nadpis} (url: /{$t.url})</option>
										{/foreach}
									</select>
								</div>
								<div class="form-group">
									<label for="">Odkaz ručně</label>
									<input type="text" class="form-control" id="" name="odkaz" value="{$aktualni_polozka.odkaz}" placeholder="Odkaz">
								</div>
								<div class="form-group">
									<label for="">Pořadí</label>
									<input type="text" class="form-control" id="" name="sort" value="{$aktualni_polozka.sort}" placeholder="Pořadí">
								</div>
								<div class="form-group">
									<label for="">Aktivní</label>
									<select name="aktivni" id="" class="form-control">
										<option value="1" {if $aktualni_polozka.aktivni eq 1}selected{/if}>Ano</option>
										<option value="0" {if $aktualni_polozka.aktivni eq 0}selected{/if}>Ne</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row text-center">
							<input type="hidden" name="id" value="{$aktualni_polozka.id}">
							<!-- Tlacitko -->
								<div class="fixed-buttons">
									<button type="submit" class="btn btn-success btn-md fixed-button" name="button" value="send">Uložit</button>
									<button type="submit" class="btn btn-success btn-md fixed-button" name="button" accesskey="s" value="send_exit">Uložit a odejít</button>
								</div>
							<!-- /Tlacitko -->
						</div>
					</form>
				</div>
			</div>
		</div>		
	</div>
{/block}