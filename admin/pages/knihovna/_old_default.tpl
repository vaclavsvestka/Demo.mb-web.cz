{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="row">
		<div class="col-md-12 text-right">
			{if $smarty.get.id}
				{if $smarty.get.id2}
					{if $smarty.get.id3}
						{if $smarty.get.id4}
							{assign var=odkaz value="/&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&id4={$smarty.get.id4}&zobrazit={$smarty.get.zobrazit}"}
						{else}
							{assign var=odkaz value="/&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&zobrazit={$smarty.get.zobrazit}"}
						{/if}
					{else}
						{assign var=odkaz value="/&id={$smarty.get.id}&id2={$smarty.get.id2}&zobrazit={$smarty.get.zobrazit}"}
					{/if}
				{else}
					{assign var=odkaz value="/&id={$smarty.get.id}&zobrazit={$smarty.get.zobrazit}"}
				{/if}			
			{else}
				{assign var=odkaz value="/"}
			{/if}
			{if $smarty.get.id4}
			{else}
				<a href="/admin/knihovna/nova-slozka{$odkaz}">
					<button type="button" class="btn btn-success btn-xs">
						<span class="glyphicon glyphicon-plus"></span> Přidat složku
					</button>
				</a>
			{/if}
			{if $smarty.get.id}
				{if $smarty.get.id2}
					{if $smarty.get.id3}
						{if $smarty.get.id4}
							{assign var=odkaz value="/&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&id4={$smarty.get.id4}&zobrazit={$smarty.get.zobrazit}"}
						{else}
							{assign var=odkaz value="/&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&zobrazit={$smarty.get.zobrazit}"}
						{/if}
					{else}
						{assign var=odkaz value="/&id={$smarty.get.id}&id2={$smarty.get.id2}&zobrazit={$smarty.get.zobrazit}"}
					{/if}
				{else}
					{assign var=odkaz value="/&id={$smarty.get.id}&zobrazit={$smarty.get.zobrazit}"}
				{/if}
				<a href="/admin/knihovna/soubory-pridat-form{$odkaz}">
					<button type="button" class="btn btn-success btn-xs">
						<span class="glyphicon glyphicon-plus"></span> Přidat soubory
					</button>
				</a>
			{/if}
		</div>	
	</div>
	
	<!-- <div class="row">
		<div class="col-md-12">
			<p>Mazání alb je umožněno pouze u alb, která neobsahují žádné fotografie. Proto je nutné nejprve smazat fotografie z alba.</p>
		</div>
	</div> -->

	
	{if $smarty.get.id4}
	{else}
		<hr>
		
		<div class="seznam-alb">
			<div class="row">
				<div class="col-md-12">
					{if $smarty.get.id}
						<h1>Podsložky</h1>
					{else}
						<h1>Složky</h1>
					{/if}
				</div>
			</div>
			<div class="row">
				{assign var=id value=$smarty.get.id}
				{assign var=id2 value=$smarty.get.id2}
				{assign var=id3 value=$smarty.get.id3}
				{assign var=id4 value=$smarty.get.id4}
				{if $smarty.get.id}
					{if $smarty.get.id2}
						{if $smarty.get.id3}
							{if $smarty.get.id4}
								<div class="col-md-12">Není podsložka</div>							
							{else}
								{foreach $kategorie.kategorie.$id.podkategorie.$id2.podkategorie.$id3.podkategorie as $album}
									{assign var=odkaz value="id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&id4={$album.id}&zobrazit=mrizka"}
									{include file="./inc_slozky.tpl" album=$album odkaz=$odkaz}								
								{foreachelse}
									<div class="col-md-12">Není podsložka</div>
								{/foreach}
							{/if}
						{else}
							{foreach $kategorie.kategorie.$id.podkategorie.$id2.podkategorie as $album}
								{assign var=odkaz value="id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$album.id}&zobrazit=mrizka"}
								{include file="./inc_slozky.tpl" album=$album odkaz=$odkaz}								
							{foreachelse}
								<div class="col-md-12">	
									Není podsložka
								</div>								
							{/foreach}
						{/if}
					{else}
						{foreach $kategorie.kategorie.$id.podkategorie as $album}
							{assign var=odkaz value="id={$album.parent_id}&id2={$album.id}&zobrazit=mrizka"}
							{include file="./inc_slozky.tpl" album=$album odkaz=$odkaz}							
						{foreachelse}
							<div class="col-md-12">Není podsložka</div>
						{/foreach}
					{/if}
				{else}
					{foreach $kategorie.kategorie as $album}
						{assign var=odkaz value="id={$album.id}&zobrazit=mrizka"}
						{include file="./inc_slozky.tpl" album=$album odkaz=$odkaz}
					{foreachelse}
						<div class="col-md-12">Neexistuje zatím žádné album</div>
					{/foreach}
				{/if}
			</div>
		</div>
	{/if}
	
	<hr>

	{if $smarty.get.id}
		{if $soubory.soubory}
			<div class="row">
				<div class="col-md-6">
					<h1>Soubory v této složce</h1>
				</div>
				<div class="col-md-6 text-right">
					{if $smarty.get.id2}
						{if $smarty.get.id3}
							{if $smarty.get.id4}
								{assign var=odkaz value="/&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&id4={$smarty.get.id4}"}
							{else}
								{assign var=odkaz value="/&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}"}
							{/if}
						{else}
							{assign var=odkaz value="/&id={$smarty.get.id}&id2={$smarty.get.id2}"}
						{/if}
					{else}
						{assign var=odkaz value="/&id={$smarty.get.id}"}
					{/if}
					{if $smarty.get.zobrazit == 'mrizka'}
						<strong>Mřížka</strong> | 
						<a href="/admin/{$smarty.get.p1}{$odkaz}&zobrazit=seznam">Seznam s názvy a popisy</a>
					{elseif $smarty.get.zobrazit == 'seznam'}
						<a href="/admin/{$smarty.get.p1}{$odkaz}&zobrazit=mrizka">Mřížka</a> |
						<strong>Seznam s názvy a popisy</strong> 
					{/if}					
				</div>
			</div>
		{else}
			<div class="row">
				<div class="col-md-12">
					<h1>Soubory v této složce</h1>
				</div>
			</div>
		{/if}
	{/if}

	{if $smarty.get.id}
		{if $soubory.soubory}
			<div class="row">
				<div class="col-md-12">
					{if $smarty.get.zobrazit == 'seznam'}
						{foreach $soubory.soubory as $photo}
							{if $smarty.get.id2}
								{if $smarty.get.id3}
									{if $smarty.get.id4}
										{assign var=odkaz_upravit value="/admin/knihovna/upravit_soubor/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&id4={$smarty.get.id4}&zobrazit={$smarty.get.zobrazit}"}
										{assign var=odkaz_smazat value="/admin/knihovna/smazat_soubor/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&id4={$smarty.get.id4}&zobrazit={$smarty.get.zobrazit}"}
										{assign var=odkaz_hlavni value="/admin/knihovna/hlavni_fotka/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&id4={$smarty.get.id4}&zobrazit={$smarty.get.zobrazit}"}
									{else}
										{assign var=odkaz_upravit value="/admin/knihovna/upravit_soubor/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&zobrazit={$smarty.get.zobrazit}"}
										{assign var=odkaz_smazat value="/admin/knihovna/smazat_soubor/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&zobrazit={$smarty.get.zobrazit}"}
										{assign var=odkaz_hlavni value="/admin/knihovna/hlavni_fotka/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&zobrazit={$smarty.get.zobrazit}"}
									{/if}
								{else}
									{assign var=odkaz_upravit value="/admin/knihovna/upravit_soubor/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&zobrazit={$smarty.get.zobrazit}"}
									{assign var=odkaz_smazat value="/admin/knihovna/smazat_soubor/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&zobrazit={$smarty.get.zobrazit}"}
									{assign var=odkaz_hlavni value="/admin/knihovna/hlavni_fotka/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&zobrazit={$smarty.get.zobrazit}"}
								{/if}
							{else}
								{assign var=odkaz_upravit value="/admin/knihovna/upravit_soubor/&id_souboru={$photo.id}&id={$smarty.get.id}&zobrazit={$smarty.get.zobrazit}"}
								{assign var=odkaz_smazat value="/admin/knihovna/smazat_soubor/&id_souboru={$photo.id}&id={$smarty.get.id}&zobrazit={$smarty.get.zobrazit}"}
								{assign var=odkaz_hlavni value="/admin/knihovna/hlavni_fotka/&id_souboru={$photo.id}&id={$smarty.get.id}&zobrazit={$smarty.get.zobrazit}"}
							{/if}
					        <div class="row">
						        <div class="col-md-2">
						        	{if $photo.type == 'image/jpeg' || $photo.type == 'img' }
							            <a class="fancybox" rel="gallery1" href="/files/uploads/{$photo.filename}" title="{$photo.title}">
							                <img src="/files/uploads/{$photo.filename}" class="thumbnail" alt="" />
							            </a>            	
						        	{else}
						        		<a class="fancybox" rel="gallery1" href="/files/uploads/{$photo.filename}" title="{$photo.title}">
							                gg
							            </a>            	
						        	{/if}
						        </div>
						        <div class="col-md-10">
									<div class="row">
						            	<strong>Název fotografie:</strong> 
					            		{if $photo.title != ''}
					            			{$photo.title}
					            		{else}
					            			<i>(nebyl vložen název fotografie)</i>
					            		{/if}
									</div>
									<!-- <div class="row">
						            	<strong>Popis fotografie:</strong>		            	 
					            		{if $photo.popis != ''}
					            			{$photo.popis}
					            		{else}
					            			<i>(nebyl vložen popis fotografie)</i>
					            		{/if}
									</div> -->
						        </div>
						    </div>
						    <div class="row">
					        	<div class="col-md-12 margin-top-20">
					        		<div class="tlacitka-fotografie">
							            <a href="{$odkaz_upravit}">
							                <button type="button" class="btn btn-success btn-sm">
							                    <span class="glyphicon glyphicon-pencil"></span> Upravit
							                </button>  
							            </a>
							            <a href="{$odkaz_smazat}">
							                <button type="button" class="btn btn-warning btn-sm">
							                    <span class="glyphicon glyphicon-trash"></span> Smazat
							                </button>  
							            </a>
						        		{if $photo.type == 'image/jpeg' || $photo.type == 'img' }
						        			{if $photo.main == 0}
									            <a href="{$odkaz_hlavni}">
									                <button type="button" class="btn btn-info btn-sm">
									                    <span class="glyphicon glyphicon-trash"></span> Nastavit jako hlavní fotku
									                </button>  
									            </a>
									        {/if}
								        {/if}
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
					{elseif $smarty.get.zobrazit == '' || $smarty.get.zobrazit == 'mrizka'}
						{foreach $soubory.soubory as $photo}
							{if $smarty.get.id2}
								{if $smarty.get.id3}
									{if $smarty.get.id4}
										{assign var=odkaz_upravit value="/admin/knihovna/upravit_soubor/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&id4={$smarty.get.id4}&zobrazit={$smarty.get.zobrazit}"}
										{assign var=odkaz_smazat value="/admin/knihovna/smazat_soubor/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&id4={$smarty.get.id4}&zobrazit={$smarty.get.zobrazit}"}
										{assign var=odkaz_hlavni value="/admin/knihovna/hlavni_fotka/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&id4={$smarty.get.id4}&zobrazit={$smarty.get.zobrazit}"}
									{else}
										{assign var=odkaz_upravit value="/admin/knihovna/upravit_soubor/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&zobrazit={$smarty.get.zobrazit}"}
										{assign var=odkaz_smazat value="/admin/knihovna/smazat_soubor/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&zobrazit={$smarty.get.zobrazit}"}
										{assign var=odkaz_hlavni value="/admin/knihovna/hlavni_fotka/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&zobrazit={$smarty.get.zobrazit}"}
									{/if}
								{else}
									{assign var=odkaz_upravit value="/admin/knihovna/upravit_soubor/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&zobrazit={$smarty.get.zobrazit}"}
									{assign var=odkaz_smazat value="/admin/knihovna/smazat_soubor/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&zobrazit={$smarty.get.zobrazit}"}
									{assign var=odkaz_hlavni value="/admin/knihovna/hlavni_fotka/&id_souboru={$photo.id}&id={$smarty.get.id}&id2={$smarty.get.id2}&zobrazit={$smarty.get.zobrazit}"}
								{/if}
							{else}
								{assign var=odkaz_upravit value="/admin/knihovna/upravit_soubor/&id_souboru={$photo.id}&id={$smarty.get.id}&zobrazit={$smarty.get.zobrazit}"}
								{assign var=odkaz_smazat value="/admin/knihovna/smazat_soubor/&id_souboru={$photo.id}&id={$smarty.get.id}&zobrazit={$smarty.get.zobrazit}"}
								{assign var=odkaz_hlavni value="/admin/knihovna/hlavni_fotka/&id_souboru={$photo.id}&id={$smarty.get.id}&zobrazit={$smarty.get.zobrazit}"}
							{/if}
					        <div class="col-md-3 text-center">
					        	<div class="thumbs">
						        	<div class="row text-center">
						        		<div class="col-md-12 text-center">
								            {if $photo.type == 'image/jpeg' || $photo.type == 'img' }
									            <div class="thumbnails">
										            <a class="fancybox" rel="gallery1" href="/files/uploads/{$photo.filename}" title="{$photo.title}">
										                <img src="/files/uploads/{$photo.filename}" class="thumbnail" alt="" />
										            </a>							            	
									            </div>
								        	{else}
									            <div class="thumbnails">
										        	<a href="/files/uploads/{$photo.filename}" title="{$photo.title}">
										        		{if $photo.type == 'application/pdf' || $photo.type == 'pdf'}
															<i class="fa fa-file-pdf-o fa-5x"></i>
														{elseif $photo.type == 'txt'}
															<i class="fa fa-file-text-o fa-5x"></i>											
														{elseif $photo.type == 'vcf'}
															<i class="fa fa-file-o fa-5x"></i>											
														{elseif $photo.type == 'xml'}
															<i class="fa fa-file-code-o fa-5x"></i>											
														{else}
															<i class="fa fa-file-o fa-5x"></i>														
														{/if}
														<br>{$photo.filename}
											        </a>								            	
									            </div>
								        	{/if}				        			
						        		</div>
						        	</div>
						        	<div class="row text-center">
							        	<div class="col-md-12">
								            <a href="{$odkaz_upravit}">
								                <button type="button" class="btn btn-success btn-xs">
								                    <span class="glyphicon glyphicon-pencil"></span> Upravit
								                </button>  
								            </a>
								            <a href="{$odkaz_smazat}">
								                <button type="button" class="btn btn-warning btn-xs">
								                    <span class="glyphicon glyphicon-trash"></span> Smazat
								                </button>  
								            </a>
							        	</div>	        		
						        	</div>
								    {if $photo.type == 'image/jpeg' || $photo.type == 'img' }
								    	{if $photo.main == 0}
								        	<div class="row text-center margin-top-3">
								        		<div class="col-md-12">
								        			<a href="{$odkaz_hlavni}">
										                <button type="button" class="btn btn-info btn-xs">
										                    Nastavit jako hlavní fotku
										                </button>  
										            </a>
								        		</div>
								        	</div>
							        	{/if}
							        {/if}					        		
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
				</div>
			</div>
		{else}
			<div class="row">
				<div class="col-md-12">
					Ve složce nejsou uloženy žádné soubory
				</div>
			</div>
		{/if}
	{/if}

{/block}
{block name=scripts}
	<script type="text/javascript">
        $(document).ready(function() {
            $('.fancybox').fancybox();
        });
    </script>
{/block}