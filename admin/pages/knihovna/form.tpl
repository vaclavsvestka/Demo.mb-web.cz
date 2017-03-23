{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=breadcrumb}
	<div class="row">
	    <div class="col-md-12">
	        <ol class="breadcrumb">
	            <li><a href="/admin/uvod">Úvod</a></li>
	            <li><a href="/admin/knihovna">Knihovna</a></li>
	            <li class="active">{if $smarty.get.p2 == 'nova-slozka'}Přidání nové složky{else}Editace složky{/if}</li>
	        </ol>
	    </div>
	</div>
{/block}
{block name=content}
	<div class="row">
		<div class="col-md-12">
			<h1>
				{if $smarty.get.p2 eq 'nova-slozka'}
					Přidání nové složky
				{else}
					Editace složky {$album.nazev}
				{/if}
			</h1>
		</div>
	</div>    
	
	{if $smarty.get.id}{assign var=odkaz value="&id={$smarty.get.id}&akce=ulozit"}{else}{assign var=odkaz value="&akce=ulozit"}{/if}
	{if $smarty.get.id2}{assign var=odkaz value="&id={$smarty.get.id}&id2={$smarty.get.id2}&akce=ulozit"}{/if}
	{if $smarty.get.id3}{assign var=odkaz value="&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&akce=ulozit"}{/if}
	{if $smarty.get.id4}{assign var=odkaz value="&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&id4={$smarty.get.id4}&akce=ulozit"}{/if}
	<form action="/admin/?p1=knihovna&p2={$smarty.get.p2}{$odkaz}" method="post" role="form">
		<div class="row">	
			<div class="col-md-12">
				<div class="box border blue">
					<div class="box-title">
						<h4><i class="fa fa-table"></i>Nadpis</h4>
					</div>
					<div class="box-body table-responsive">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="">Název alba</label>
									<input type="text" class="form-control" id="" name="title" value="{if $smarty.get.p2 == 'nova-slozka'}{else}{$album.title}{/if}" placeholder="Název složky" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="parent_id">Nadřazená složka</label>
									<select name="parent_id" class="form-control" id="parent_id">
										<option value="0">Žádná</option>
										{if $smarty.get.id}{assign var=id value="{$smarty.get.id}"}{/if}
										{if $smarty.get.id2}{assign var=id value="{$smarty.get.id2}"}{/if}
										{if $smarty.get.id3}{assign var=id value="{$smarty.get.id3}"}{/if}
										{if $smarty.get.id4}{assign var=id value="{$smarty.get.id4}"}{/if}
										{foreach $kategorie.kategorie as $kat}
				                            <option value="{$kat.id}" {if $id == $kat.id}selected{/if}>{$kat.title}</option>
				                            {foreach $kat.podkategorie as $podkat}
				                                <option value="{$podkat.id}" {if $id == $podkat.id}selected{/if}>&nbsp;&nbsp;&nbsp;{$podkat.title}</option>
				                                {foreach $podkat.podkategorie as $podkat2}
				                                    <option value="{$podkat2.id}" {if $id == $podkat2.id}selected{/if}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$podkat2.title}</option>
				                                {/foreach}  
				                            {/foreach}
				                        {/foreach}
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>			
				<div class="row text-center">
					<input type="hidden" name="id" value="{$album.id}">
					<button type="submit" class="btn btn-success btn-md">
						Uložit
					</button>
				</div>
			</div>
		</div>
	</form>
{/block}