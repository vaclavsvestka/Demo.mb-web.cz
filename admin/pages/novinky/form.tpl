{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	{if $smarty.get.p2 == "novy" || $novinka.autor == $logged_user.id}
		<div class="row">
			<div class="col-md-12">	
				{if $smarty.get.p == 'novy'}
					<h1>Přidání novinky</h1>
				{elseif $smarty.get.p == 'edit'}
					<h1>Editace novinky {$novinka.nadpis}</h1>
				{/if}
			</div>
		</div>
		
		<form action="/admin/?p1=novinky&p2={$smarty.get.p2}&akce=ulozit" method="post" role="form">
			<!-- Nadpis novinky -->
				<div class="row">	
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Nadpis novinky</h4>
							</div>
							<div class="box-body table-responsive">
								<div class="form-group">
									<input type="text" class="form-control" id="" name="nadpis" value="{$novinka.nadpis}" placeholder="Nadpis novinky">
								</div>
							</div>
						</div>			
					</div>
				</div>
			<!-- /Nadpis novinky -->

			<!-- Anotace -->
				<div class="row">	
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Anotace</h4>
							</div>
							<div class="box-body table-responsive">
								<textarea name="anotace" id="editor1" rows="5" cols="80">
					                {$novinka.anotace}
					            </textarea>
					            <script>
					                CKEDITOR.replace( 'editor1' );
					            </script>
							</div>
						</div>			
					</div>
				</div>
			<!-- /Anotace -->
			
			<!-- Text -->
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Text</h4>
							</div>
							<div class="box-body table-responsive">
								<textarea name="text" id="editor2" rows="10" cols="80">
					                {$novinka.text}
					            </textarea>
					            <script>
					                CKEDITOR.replace( 'editor2' );
					            </script>
							</div>
						</div>
					</div>
				</div>
			<!-- /Text -->
			
			<input type="hidden" name="id" value="{$novinka.id}">
			<input type="hidden" class="form-control" id="" name="autor" value="{$logged_user.id}">

			<!-- Tlacitko -->
				<div class="fixed-buttons">
					<button type="submit" class="btn btn-success btn-md fixed-button" name="button" value="send">Uložit</button>
					<button type="submit" class="btn btn-success btn-md fixed-button" name="button" accesskey="s" value="send_exit">Uložit a odejít</button>
				</div>
			<!-- /Tlacitko -->
		</form>
	{else}
		<div class="row">
			<div class="col-md-12">
				{assign var=autor value="{$novinka.name} {$novinka.surname}"}
				{include file="nepristupne.tpl" autor={$autor}}
			</div>
		</div>
	{/if}

{/block}

{block name=scripts}
	<script>
        CKEDITOR.replace( 'editor1' );
    </script>
	<script>
        CKEDITOR.replace( 'editor2' );
    </script>
{/block}