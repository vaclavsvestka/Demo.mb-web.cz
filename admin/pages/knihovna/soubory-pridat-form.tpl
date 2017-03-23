{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=breadcrumb}
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="/admin/uvod">Úvod</a></li>
                <li><a href="/admin/knihovna">Knihovna</a></li>
                <li class="active">Přidání souborů do složky</li>
            </ol>
        </div>
    </div>
{/block}
{block name=content}
	
    <div class="row">
        <div class="col-md-12">
            <!-- <h1>Soubory a fotografie s vodoznakem</h1>
            <form action="/admin/?p1=knihovna&p2=soubory-pridat-form&akce=nahrat-soubory-vodoznak&id={$smarty.get.id}" method="post" class="dropzone">
                {if $smarty.get.id4}{assign var=id value=$smarty.get.id4}
                {else}
                    {if $smarty.get.id3}{assign var=id value=$smarty.get.id3}
                    {else}
                        {if $smarty.get.id2}{assign var=id value=$smarty.get.id2}
                        {else}
                            {if $smarty.get.id}{assign var=id value=$smarty.get.id}
                            {else}{/if}
                        {/if}
                    {/if}
                {/if}
                <input type="hidden" name="parent_id" value="{$id}">
            </form>  -->
            <!-- <h1>Soubory a fotografie bez vodoznaku</h1> -->
            <form action="/admin/?p1=knihovna&p2=soubory-pridat-form&akce=nahrat-soubory-bez-vodoznaku&id={$smarty.get.id}" method="post" class="dropzone">
                {if $smarty.get.id4}{assign var=id value=$smarty.get.id4}
                {else}
                    {if $smarty.get.id3}{assign var=id value=$smarty.get.id3}
                    {else}
                        {if $smarty.get.id2}{assign var=id value=$smarty.get.id2}
                        {else}
                            {if $smarty.get.id}{assign var=id value=$smarty.get.id}
                            {else}{/if}
                        {/if}
                    {/if}
                {/if}
                <input type="hidden" name="parent_id" value="{$id}">
            </form> 
        </div>   
    </div>
    <div class="row text-center">
        <div class="col-md-12">
            <p>Jakmile budou všechny soubory nahrány, kliknutím na tlačítko níže se vrátíte do složky.</p>
        </div>
    </div>
    <div class="row text-center">
    	<div class="col-md-12">
            {if $smarty.get.id4}{assign var=odkaz value="&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&id4={$smarty.get.id4}&zobrazit={$smarty.get.zobrazit}"}
            {else}
                {if $smarty.get.id3}{assign var=odkaz value="&id={$smarty.get.id}&id2={$smarty.get.id2}&id3={$smarty.get.id3}&zobrazit={$smarty.get.zobrazit}"}
                {else}
                    {if $smarty.get.id2}{assign var=odkaz value="&id={$smarty.get.id}&id2={$smarty.get.id2}&zobrazit={$smarty.get.zobrazit}"}
                    {else}
                        {if $smarty.get.id}{assign var=odkaz value="&id={$smarty.get.id}&zobrazit={$smarty.get.zobrazit}"}
                        {else}{/if}
                    {/if}
                {/if}
            {/if}
            <a href="/admin/knihovna/{$odkaz}">
                <button type="button" class="btn btn-success">
                    <span class="glyphicon glyphicon-chevron-left"></span> Zpět do složky
                </button>
            </a>
    	</div>
    </div>
{/block}