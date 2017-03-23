<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="/admin">Úvod</a></li>
            <li {if $page == ''}class="active"{/if}>{if $page != ''}<a href="/admin/{$smarty.get.p1}">{/if}{$module}{if $page != ''}</a>{/if}</li>
            {if $page}<li {if $page2 == ''}class="active"{/if}>{if $page2 != ''}<a href="/admin/{$smarty.get.p1}">{/if}{$page}{if $page2 != ''}</a>{/if}</li>{/if}
            {if $page2}<li>{$page2}</li>{/if}
        </ol>
    </div>
</div>