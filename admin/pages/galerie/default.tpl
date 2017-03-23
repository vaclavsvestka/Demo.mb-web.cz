{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=breadcrumb}
	{assign var=module value='Galerie'}
	{include file="../breadcrumb.tpl"}
{/block}
{block name=content}
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				{foreach $album as $g}
					<div class="col-md-2 text-center">
						<div class="obrazek" style="margin-bottom: 20px;">
							<a href="{$URL}admin/galerie/album/{$g.id}" style="text-decoration: none;">
								<i class="fa fa-folder fa-5x"></i>
							</a>
							<br>
							<strong>{$g.nazev}</strong><br>
							<div style="margin-top: 10px; margin-bottom: 30px;">
								<a href="{$URL}admin/galerie/edit-album/{$g.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
								<a href="{$URL}admin/galerie/smazat-album/{$g.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
							</div>
						</div>
					</div>
				{/foreach}
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<a href="{$URL}admin/galerie/nove-album">
						<button type="button" class="btn btn-success btn-sm">
							<span class="glyphicon glyphicon-plus"></span> Přidat album
						</button>
					</a>
				</div>
			</div>
		</div>
	</div>
{/block}

{block name=scripts}
	<script type="text/javascript">
        $(document).ready(function() {
            $('.fancybox').fancybox();
        });
    </script>
{/block}