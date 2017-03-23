{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<form action="/admin/?p1=kalendar&p2={$smarty.get.p2}&akce=ulozit" method="post" role="form" enctype="multipart/form-data">
		<div class="row">	
			<div class="col-md-8">
				<div class="box border blue">
					<div class="box-title">
						<h4><i class="fa fa-table"></i>Základní údaje</h4>
					</div>
					<div class="box-body table-responsive">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="nazev">Název události:</label>
									<input type="text" class="form-control" id="nazev" name="nazev" value="{$udalost.nazev}">
								</div>									
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="status">Datum od:</label>
									<input type="date" class="form-control" id="od_datum" name="od_datum" value="{$udalost.od_datum}" placeholder="">
								</div>									
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="status">Čas od:</label>
									<input type="time" class="form-control" id="od_cas" name="od_cas" value="{$udalost.od_cas}" placeholder="">
								</div>									
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="status">Datum do:</label>
									<input type="date" class="form-control" id="do_datum" name="do_datum" value="{$udalost.do_datum}" placeholder="">
								</div>									
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="status">Čas do:</label>
									<input type="time" class="form-control" id="do_cas" name="do_cas" value="{$udalost.do_cas}" placeholder="">
								</div>									
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="popis">Popis:</label>
									<textarea name="popis" id="editor1" rows="5" cols="80">{$udalost.popis}</textarea>
								</div>									
							</div>
						</div>
					</div>
				</div>						
			</div>
			<div class="col-md-4">
				<div class="box border blue">
					<div class="box-title">
						<h4><i class="fa fa-table"></i>Přidat k události soubory</h4>
					</div>
					<div class="box-body table-responsive">
						<div class="row">
							<div class="col-md-12">
								<label for="soubor">Soubor 1</label>
								<input type="file" id="soubor" name="soubor[]" class="form-control" style="margin-bottom: 10px;">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="soubor">Soubor 2</label>
								<input type="file" id="soubor" name="soubor[]" class="form-control" style="margin-bottom: 10px;">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="soubor">Soubor 3</label>
								<input type="file" id="soubor" name="soubor[]" class="form-control" style="margin-bottom: 10px;">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="soubor">Soubor 4</label>
								<input type="file" id="soubor" name="soubor[]" class="form-control" style="margin-bottom: 10px;">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="soubor">Soubor 5</label>
								<input type="file" id="soubor" name="soubor[]" class="form-control" style="margin-bottom: 10px;">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<input type="hidden" name="id" value="{$udalost.id}">
		<input type="hidden" name="autor" value="{$logged_user.id}">

		<!-- Tlacitko -->
			<div class="fixed-buttons">
				<button type="submit" class="btn btn-success btn-md fixed-button" name="button" value="send">Uložit</button>
				<button type="submit" class="btn btn-success btn-md fixed-button" name="button" accesskey="s" value="send_exit">Uložit a odejít</button>
			</div>
		<!-- /Tlacitko -->

	</form>
{/block}

{block name=scripts_document_ready}
	<script type="text/javascript">
        $(document).ready(function() {
            $('.fancybox').fancybox();
	    	$('#podminky_button').click(function() {
	    		$('#podminky').show();
	    	});
        });
    </script>
{/block}

{block name=scripts}
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
	<script>
        CKEDITOR.replace( 'editor2' );
    </script>
    <script>
		$(function() {
			$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
			$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
		});
	</script>
{/block}