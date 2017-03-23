<div class="col-md-2">
	<div class="album">
		<div class="row">
			<a href="/admin/knihovna/&{$odkaz}">
				<div class="album-icon text-center">
					<i class="fa fa-folder" title="folder icon"></i>							
				</div>
			</a>
		</div>
		<div class="row">
			<a href="/admin/knihovna/&{$odkaz}">
				<div class="album-title text-center"><strong>{$album.title}</strong><br><small>{$album.pocet_slozek} složek<br>{$album.pocet_souboru} souborů</small></div>
			</a>							
		</div>

		<div class="album-functions text-center">
			<a href="/admin/knihovna/edit-slozky&id={$album.id}">
				<i class="fa fa-edit fa-lg" title="Editace"></i>
			</a>
			{if $album.pocet < 1}
				{if $smarty.get.id}{assign var=odkaz value="smazat-slozku&id={$smarty.get.id}&slozka={$album.id}&zobrazit={$smarty.get.zobrazit}"}
				{else}{assign var=odkaz value="smazat-slozku&slozka={$album.id}"}
				{/if}
				{if $smarty.get.id2}{assign var=odkaz value="smazat-slozku&id={$smarty.get.id}&id2={$smarty.get.id2}&slozka={$album.id}&zobrazit={$smarty.get.zobrazit}"}{/if}
				{if $smarty.get.id3}{assign var=odkaz value="smazat-slozku&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&slozka={$album.id}&zobrazit={$smarty.get.zobrazit}"}{/if}
				{if $smarty.get.id4}{assign var=odkaz value="smazat-slozku&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&id4={$smarty.get.id4}&slozka={$album.id}&zobrazit={$smarty.get.zobrazit}"}{/if}
				<a href="/admin/knihovna/{$odkaz}">
					<i class="fa fa-trash fa-lg" title="Smazat"></i>
				</a>
			{/if}
		</div>
	</div>						
</div>