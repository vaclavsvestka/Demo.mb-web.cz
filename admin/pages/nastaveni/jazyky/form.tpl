{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="row">
		<div class="col-md-12">	
			{if $smarty.get.p3 == 'novy'}
				<h1>Přidání jazyka</h1>
			{elseif $smarty.get.p3 == 'edit'}
				<h1>Editace jazyka {$jazyk.nazev}</h1>
			{/if}
		</div>
	</div>
		
	<form action="/admin/?p1=nastaveni&p2=jazyky&p3={$smarty.get.p3}&akce=ulozit" method="post" role="form">
		<div class="row">	
			<div class="col-md-12">
				<div class="box border blue">
					<div class="box-title">
						<h4><i class="fa fa-table"></i></h4>
					</div>
					<div class="box-body table-responsive">
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label for="">Zkratka jazyka</label>
									<input type="text" class="form-control" id="" name="zkratka" value="{$jazyk.zkratka}" placeholder="Zkratka jazyka" autofocus>
								</div>								
							</div>
							<div class="col-md-10">
								<div class="form-group">
									<label for="">Název jazyka</label>
									<input type="text" class="form-control" id="" name="nazev" value="{$jazyk.nazev}" placeholder="Název jazyka">
								</div>								
							</div>
						</div>
					</div>
				</div>			
			</div>
		</div>

		<!-- Tlacitko -->
			<input type="hidden" name="id" value="{$jazyk.id}">
			<div class="fixed-buttons">
				<input type="hidden" name="autor" value="{$logged_user.id}">
				<button type="submit" class="btn btn-success btn-md fixed-button" name="button" value="send">Uložit</button>
				<button type="submit" class="btn btn-success btn-md fixed-button" name="button" accesskey="s" value="send_exit">Uložit a odejít</button>
			</div>
		<!-- /Tlacitko -->
	</form>
	
	
{/block}

{block name=scripts}
	<script>
        CKEDITOR.replace( 'editor1' );
    </script>
	<script>
        CKEDITOR.replace( 'editor2' );
    </script>
{/block}