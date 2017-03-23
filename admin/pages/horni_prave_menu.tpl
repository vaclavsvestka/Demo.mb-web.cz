{foreach $web_menu as $polozka}
    {assign var=prava_nazev value=$polozka.prava_nazev}
    {if $logged_user.prava.$prava_nazev == 1 || $prava_nazev == ""}
        <li {if $polozka.podmenu == 1}class="dropdown"{/if}>
            {if $polozka.podmenu == 1}
                <a class="dropdown-toggle" data-toggle="tooltip" data-placement="bottom" title="{$polozka.nazev}" href="#">
                    <i class="fa {$polozka.ikona} fa-lg"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    {foreach $polozka.podmenu_polozky as $p}
                        <li><a href="/admin/{$p.odkaz}"><i class="fa {$p.ikona}" style="margin-right: 5px"></i> {$p.nazev}</a></li>
                    {/foreach}
                </ul>
            {else}
                <a href="/admin/{$polozka.odkaz}" data-toggle="tooltip" data-placement="bottom" title="{$polozka.nazev}">
                    <i class="fa {$polozka.ikona} fa-lg"></i>
                </a>
            {/if}
        </li> 
    {/if}
{/foreach}    

<li>
    <a href="/admin/nastaveni" data-toggle="tooltip" data-placement="bottom" title="Nastavení systému">
        <i class="fa fa-gear fa-lg"></i>
    </a>
</li>

<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-user fa-lg"></i>  <i class="fa fa-caret-down"></i>
    </a>
    <ul class="dropdown-menu dropdown-user">
        <li><a href="#"><i class="fa fa-user" style="margin-right: 5px"></i> {$logged_user.name} {$logged_user.surname}</a></li>
        <li class="border-bottom"><a href="/admin/error-log/"><i class="fa fa-exclamation" style="margin-right: 5px"></i> Seznam chyb v systému</a></li>
        {if $modules.uzivatele.enable == 1}<li><a href="/admin/uzivatele"><i class="fa fa-group" style="margin-right: 5px"></i> Správa uživatelů</a></li>{/if}
        {if $modules.poznamky.enable == 1}<li><a href="/admin/poznamky"><i class="fa fa-edit" style="margin-right: 5px"></i> Poznámky</a></li>{/if}
        {if $modules.ukoly.enable == 1}<li><a href="/admin/ukoly"><i class="fa fa-tasks" style="margin-right: 5px"></i> Úkoly</a></li>{/if}
        {if $modules.kalendar.enable == 1}<li><a href="/admin/kalendar"><i class="fa fa-calendar" style="margin-right: 5px"></i> Kalendář</a></li>{/if}

        <li class="border-top"><a href="{$URL}" target="_blank"><i class="fa fa-globe" style="margin-right: 5px"></i> Přejít na web</a></li>
        <li class="border-top"><a href="/admin/logout"><i class="fa fa-sign-out" style="margin-right: 5px"></i> Odhlásit z administrace</a></li>
    </ul>
            <!-- 
            $menu['ukoly']['prava_nazev'] = "ukoly";        
            $menu['uzivatele']['prava_nazev'] = "nastaveni_uzivatele";      
            $menu['poznamky']['prava_nazev'] = "poznamky";  
            -->
</li>

