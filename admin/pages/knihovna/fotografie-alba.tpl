{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=breadcrumb}
	<div class="row">
	    <div class="col-md-12">
	        <ol class="breadcrumb">
	            <li><a href="/admin/uvod">Úvod</a></li>
	            <li><a href="/admin/fotogalerie">Fotogalerie</a></li>
	            <li class="active">Fotografie v albu</li>
	        </ol>
	    </div>
	</div>
{/block}
{block name=content}
	<div class="row">
		<div class="col-md-12">
			<h1>Fotografie alba {$album.nazev}</h1>			
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<a href="/admin/fotogalerie/fotografie-pridat-form&id={$album.id}&zobrazit={$smarty.get.zobrazit}">
				<button type="button" class="btn btn-success">
					<span class="glyphicon glyphicon-plus"></span> Přidat fotografie
				</button>
			</a>
		</div>
	</div>
	
	<br>

	<div class="row">
		<div class="col-md-12">
			{if $smarty.get.zobrazit == 'mrizka'}
				<strong>Mřížka</strong> | 
				<a href="/admin/{$smarty.get.m}/{$smarty.get.p2}&id={$smarty.get.id}&zobrazit=seznam">Seznam s názvy a popisy</a>
			{elseif $smarty.get.zobrazit == 'seznam'}
				<a href="/admin/{$smarty.get.m}/{$smarty.get.p2}&id={$smarty.get.id}&zobrazit=mrizka">Mřížka</a> |
				<strong>Seznam s názvy a popisy</strong> 
			{/if}
		</div>
	</div>

	<br>
	
	{if $smarty.get.zobrazit == 'seznam'}
		{foreach $photos as $photo}
	        <div class="row">
		        <div class="col-md-2">
		            <a class="fancybox" rel="gallery1" href="/{$smarty.const.PHOTO_UPLOADS}/{$photo.soubor}" title="{$photo.nazev}">
		                <img src="/{$smarty.const.PHOTO_UPLOADS}/{$photo.soubor}" class="thumbnail" alt="" />
		            </a>            	
		        </div>
		        <div class="col-md-8">
					<div class="row">
		            	<strong>Název fotografie:</strong> 
	            		{if $photo.nazev != ''}
	            			{$photo.nazev}
	            		{else}
	            			<i>(nebyl vložen název fotografie)</i>
	            		{/if}
					</div>
					<div class="row">
		            	<strong>Popis fotografie:</strong>		            	 
	            		{if $photo.popis != ''}
	            			{$photo.popis}
	            		{else}
	            			<i>(nebyl vložen popis fotografie)</i>
	            		{/if}
					</div>
		        </div>
	        	<div class="col-md-2 text-right">
	        		<div class="tlacitka-fotografie">
			            <a href="/admin/{$smarty.get.m}/{$smarty.get.p2}&id={$smarty.get.id}&akce=upravit_fotku&id_fotky={$photo.id}&zobrazit={$smarty.get.zobrazit}">
			                <button type="button" class="btn btn-success btn-sm">
			                    <span class="glyphicon glyphicon-pencil"></span> Upravit
			                </button>  
			            </a>
			            <a href="/admin/{$smarty.get.m}/{$smarty.get.p2}&id={$smarty.get.id}&akce=smazat_fotku&id_fotky={$photo.id}&zobrazit={$smarty.get.zobrazit}">
			                <button type="button" class="btn btn-warning btn-sm">
			                    <span class="glyphicon glyphicon-trash"></span> Smazat
			                </button>  
			            </a>        			        			
	        		</div>
	        	</div>
	        </div>
	        <hr>
	    {foreachelse}
			<div class="row">
				<div class="col-md-12">
	    			Nejsou žádné fotografie k zobrazení. Přidejte fotografie kliknutím na tlačítko výše.				
				</div>
			</div>
	    {/foreach}
	{elseif $smarty.get.zobrazit == 'mrizka'}
		{foreach $photos as $photo}
	        <div class="col-md-3">
	        	<div class="row text-center" style="padding-left: 15px; padding-right: 15px;">
		            <a class="fancybox" rel="gallery1" href="/{$smarty.const.PHOTO_UPLOADS}/{$photo.soubor}" title="{$photo.nazev}">
		                <img src="/{$smarty.const.PHOTO_UPLOADS}/{$photo.soubor}" class="thumbnail-mrizka" alt="" />
		            </a>	        		
	        	</div>
	        	<div class="row text-center">
		        	<div class="col-md-12">
			            <a href="/admin/{$smarty.get.m}/{$smarty.get.p2}&id={$smarty.get.id}&akce=upravit_fotku&id_fotky={$photo.id}&zobrazit={$smarty.get.zobrazit}">
			                <button type="button" class="btn btn-success btn-sm">
			                    <span class="glyphicon glyphicon-pencil"></span> Upravit
			                </button>  
			            </a>
			            <a href="/admin/{$smarty.get.m}/{$smarty.get.p2}&id={$smarty.get.id}&akce=smazat_fotku&id_fotky={$photo.id}&zobrazit={$smarty.get.zobrazit}">
			                <button type="button" class="btn btn-warning btn-sm">
			                    <span class="glyphicon glyphicon-trash"></span> Smazat
			                </button>  
			            </a>        		
		        	</div>	        		
	        	</div>
	        </div>
	    {foreachelse}
			<div class="row">
				<div class="col-md-12">
	    			Nejsou žádné fotografie k zobrazení. Přidejte fotografie kliknutím na tlačítko výše.				
				</div>
			</div>
	    {/foreach}
	{/if}
{/block}
{block name=scripts}
	<script type="text/javascript">
        $(document).ready(function() {
            $('.fancybox').fancybox();
        });
    </script>
{/block}