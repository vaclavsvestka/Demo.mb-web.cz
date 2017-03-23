{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="row" style="margin-top: 50px;">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<div class="alert alert-danger" role="alert">Bohužel došlo k chybě! Chyba byla zaznamenána a opravíme jí co nejdříve to bude možné.</div>
		</div>
		<div class="col-md-4"></div>
	</div>
	<div class="row text-center">
		<a href="javascript:history.back()"><button type="button" class="button btn btn-sm btn-success">Zpět</button></a>
	</div>
{/block}