<!-- leve_menu.tpl -->
    <ul class="nav in" id="side-menu">
        <li class="sidebar-search">
            <form action="/admin/" method="post" role="form">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" name="hledat" placeholder="Hledej...">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div>
            </form>
        </li>
        {foreach $web_menu as $polozka}
            {assign var=prava_nazev value=$polozka.prava_nazev}
            {if $logged_user.prava.$prava_nazev == 1 || $prava_nazev == ""}
                <li>
                    <a href="/admin/{$polozka.odkaz}"><i class="fa {$polozka.ikona} fa-fw"></i> {$polozka.nazev}{if $polozka.submenu}<span class="fa arrow"></span>{/if}</a>
                    {if $polozka.submenu}
                        <ul class="nav nav-second-level">
                            {foreach $polozka.submenu as $polozka2}
                                {assign var=prava_nazev value=$polozka2.prava_nazev}
                                {if $logged_user.prava.$prava_nazev == 1 || $prava_nazev == ""}
                                    <li>
                                        <a href="/admin/{$polozka2.odkaz}"><i class="fa {$polozka2.ikona} fa-fw"></i> {$polozka2.nazev}</a>
                                    </li>
                                {/if}
                            {/foreach}
                        </ul>
                    {/if}                     
                </li>
            {/if}
        {/foreach}
	</ul>
<!-- /leve_menu.tpl -->
