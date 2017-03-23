{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#uzivatele" aria-controls="uzivatele" role="tab" data-toggle="tab">Uživatelé</a></li>
		<li role="presentation"><a href="#skupiny" aria-controls="skupiny" role="tab" data-toggle="tab">Skupiny</a></li>
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="uzivatele">
			<div class="box border blue">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Správa uživatelských účtů</h4>
					<div class="buttons">
						<a href="/admin/nastaveni/uzivatele/novy">
							<button type="button" class="btn btn-success btn-xs">
								<span class="glyphicon glyphicon-plus"></span> Přidat uživatele
							</button>
						</a>
					</div>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-striped">
						<thead>
						  	<tr>
								<th width="40">ID</th>
								<th width="150">Uživatelské jméno</th>
								<th width="150">Jméno a příjmení</th>
								<th>Skupina</th>
								<th>Registrace</th>
								<th>Poslední přihlášení</th>
								<th>IP</th>
								<th width="90" class="text-right"></th>
						  	</tr>
						</thead>
						<tbody>
							{foreach $uzivatele as $uzivatel}
								<tr>
									<td>{$uzivatel.id}</td>
									<td>{$uzivatel.username}</td>
									<td>{$uzivatel.name} {$uzivatel.surname}</td>
									<td>{$uzivatel.skupina}</td>
									<td>{$uzivatel.registration|date_format:"%d. %m. %Y"}</td>
									<td>{$uzivatel.last_login|date_format:"%d. %m. %Y"}</td>
									<td>{$uzivatel.ip}</td>
									<td class="text-right">
										<a href="/admin/uzivatele/seznam-prihlaseni/{$uzivatel.id}"><i class="fa fa-list fa-funkce" title="Seznam přihlášení uživatele"></i></a>
										<a href="/admin/uzivatele/edit/{$uzivatel.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
										<a href="/admin/uzivatele/smazat/{$uzivatel.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
									</td>
								</tr>					
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="skupiny">
			<div class="box border blue">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Správa uživatelských skupin</h4>
					<div class="buttons">
						<a href="/admin/nastaveni/uzivatele/nova-skupina">
							<button type="button" class="btn btn-success btn-xs">
								<span class="glyphicon glyphicon-plus"></span> Přidat skupinu
							</button>
						</a>
					</div>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-striped">
						<thead>
						  	<tr>
								<th width="40">ID</th>
								<th>Název</th>
								<th width="80" class="text-right"></th>
						  	</tr>
						</thead>
						<tbody>
							{foreach $skupiny as $skupina}
								<tr>
									<td>{$skupina.id}</td>
									<td>{$skupina.name}</td>
									<td class="text-right">
										<a href="/admin/uzivatele/edit-skupinu/{$skupina.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
										<a href="/admin/uzivatele/smazat-skupinu/{$skupina.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
									</td>
								</tr>					
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

{/block}