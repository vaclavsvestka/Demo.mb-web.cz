{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=body}
    <body>
        <div class="login-box">
            <!-- <div class="body"></div> -->
            <div class="message">
                {if $smarty.get.loggedout eq 'yes'}
                    <div class="alert alert-success fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Byl jste úspěšně odhlášen
                    </div> 
                {/if}
                {if $smarty.get.err eq '1'}
                    <div class="alert alert-danger fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Bohužel uživatel s takovým jménem neexistuje. Zkuste prosím jiné jméno.
                    </div> 
                {/if}
                {if $smarty.get.err eq '2'}
                    <div class="alert alert-danger fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Bohužel bylo zadáno špatné heslo. Zkuste prosím jiné.
                    </div> 
                {/if}
            </div>
            <h1>Přihlášení do administračního rozhraní</h1>
            <div class="logo">
                <div class="logo-inner">
                    <p>Zde bude logo</p>
                </div>
            </div>
            <div class="login">
                <form class="form-signin" role="form" method="post" action="/admin/?m=login">
                    <input type="text" placeholder="Uživatelské jméno" name="username"><br>
                    <input type="password" placeholder="Heslo" name="password"><br>
                    <input type="submit" value="Přihlásit">
                </form>
            </div>
        </div>
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    </body>
{/block}