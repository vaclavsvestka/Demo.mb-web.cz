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
						<h4><i class="fa fa-table"></i>Základní údaje uživatele</h4>
					</div>
					<div class="box-body table-responsive">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Uživatelské jméno</label>
									<input type="text" class="form-control" id="" name="username" value="{$uzivatel.username}" placeholder="Uživatelské jméno">
								</div>								
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Heslo</label>
									<input type="password" class="form-control" id="" name="password" value="" placeholder="Heslo">
								</div>								
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Jméno</label>
									<input type="text" class="form-control" id="" name="name" value="{$uzivatel.name}" placeholder="Jméno">
								</div>								
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Příjmení</label>
									<input type="text" class="form-control" id="" name="surname" value="{$uzivatel.surname}" placeholder="Příjmení">
								</div>								
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">E-mail</label>
									<input type="email" class="form-control" id="" name="email" value="{$uzivatel.email}" placeholder="E-mail">
								</div>								
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Skupina</label>
									<select name="admin_group" id="" class="form-control">
										{foreach $skupiny as $skupina}
											<option value="{$skupina.id}" {if $uzivatel.admin_group == $skupina.id}selected{/if}>{$skupina.name}</option>
										{/foreach}
									</select>
								</div>								
							</div>
						</div>
					</div>
				</div>			
			</div>
		</div>

		<input type="hidden" name="id" value="{$uzivatel.id}">
		<div class="fixed-buttons">
			<button type="submit" class="btn btn-success btn-md fixed-button" name="button" value="send">Uložit</button>
			<button type="submit" class="btn btn-success btn-md fixed-button" name="button" accesskey="s" value="send_exit">Uložit a odejít</button>
		</div>

	</form>
{/block}