{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=breadcrumb}
	{assign var=module value='Galerie'}
	{assign var=page value='Fotky z alba '|cat:$album.nazev}
	{include file="../../breadcrumb.tpl"}
{/block}
{block name=content}
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				{foreach $galerie as $g}
					<div class="col-md-3 text-center">
						<div class="obrazek" style="margin-bottom: 20px;">
							<a href="{$URL}images/galerie/{$g.obrazek_velky}" class="fancybox" rel="galerie1" title="{$g.popis}">
								{if $g.obrazek_maly}
									{assign var=obrazek value=$g.obrazek_maly}
								{else}
									{assign var=obrazek value=$g.obrazek_velky}
								{/if}
								<img src="{$URL}images/galerie/{$obrazek}" style="height: 200px; max-width: 100%; padding: 3px; border: 1px solid grey;" alt="{$g.popis}">
							</a>
							<br>
							{if $g.popis}{$g.popis}{else}<span style="color:grey">(Popis obrázku nebyl zadán...)</span>{/if}<br>
							<a href="{$URL}admin/galerie/edit/{$g.id}"><i class="fa fa-edit fa-funkce" title="Editace"></i></a>
							<a href="{$URL}admin/galerie/smazat/{$g.id}&id_alba={$album.id}"><i class="fa fa-trash fa-funkce" title="Smazat"></i></a>
						</div>
					</div>
				{/foreach}
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<a href="{$URL}admin/galerie/novy/{$album.id}">
						<button type="button" class="btn btn-success btn-sm">
							<span class="glyphicon glyphicon-plus"></span> Přidat obrázky
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