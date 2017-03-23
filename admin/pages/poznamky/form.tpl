{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<form action="/admin/?p1=poznamky&p2={$smarty.get.p2}&akce=ulozit" method="post" role="form" enctype="multipart/form-data">
		<div class="row">	
			<div class="col-md-12">
				<div class="box border blue">
					<div class="box-title">
						<h4><i class="fa fa-table"></i>Vytvoření/editace poznámky</h4>
					</div>
					<div class="box-body table-responsive">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="nazev">Název:</label>
									<input type="text" class="form-control" id="nazev" name="nazev" value="{$poznamka.nazev}" autofocus="">
								</div>									
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="popis">Text:</label>
									<textarea name="text" id="editor1" rows="5" cols="80">{$poznamka.text}</textarea>
								</div>									
							</div>
						</div>
					</div>
				</div>						
			</div>
		</div>

		<input type="hidden" name="id" value="{$poznamka.id}">

		<!-- Tlacitko -->
			<div class="fixed-buttons">
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
{/block}