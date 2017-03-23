{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="row">
		<div class="col-md-12 text-right">
			<a href="/admin/poznamky/novy">
				<button type="button" class="btn btn-success btn-lg" style="margin-bottom: 10px"><span class="glyphicon glyphicon-plus"></span>Přidat poznámku</button>
			</a>
		</div>
	</div>
	<div class="row">
		{foreach $poznamky_uzivatele as $poznamka name=foo}
			<div class="col-md-4">
				<div id="poznamka">
					<h2>{$poznamka.nazev}</h2>
					{$poznamka.text|truncate:600:"..."}
					<div class="pruh">
						{if $poznamka.pripnout == 1}
							<a href="/admin/poznamky/odepnout/{$poznamka.id}"><i class="fa fa-toggle-off fa-2x" title="Poznámka je připnutá na ploše"></i></a>
						{else}
							<a href="/admin/poznamky/pripnout/{$poznamka.id}"><i class="fa fa-toggle-on fa-2x" title="Poznámka není připnutá na ploše"></i></a>
						{/if}
						<a href="" data-toggle="modal" data-target="#zobrazit-{$poznamka.id}"><i class="fa fa-eye fa-2x"></i></a>
						<a href="/admin/poznamky/edit/{$poznamka.id}"><i class="fa fa-pencil fa-2x"></i></a>
						<a href="/admin/poznamky/smazat/{$poznamka.id}"><i class="fa fa-trash fa-2x"></i></a>
					</div>
				</div>
			</div>
			{if $smarty.foreach.foo.iteration is div by 3}
			</div>
			<div class="row">
			{/if}
		{/foreach}
	</div>


	{foreach $poznamky_uzivatele as $poznamka}
		<!-- Modal -->
		<div class="modal fade" id="zobrazit-{$poznamka.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">{$poznamka.nazev}</h4>
					</div>
					<div class="modal-body">{$poznamka.text}</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Zavřít</button>
					</div>
				</div>
			</div>
		</div>
	{/foreach}
{/block}