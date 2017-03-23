{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="row">	
		<div class="col-md-8">
			<div class="box border blue">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Základní údaje</h4>
				</div>
				<div class="box-body table-responsive">
					<div class="row">
						<div class="col-md-2">Název události:</div>
						<div class="col-md-10">{$udalost.nazev}</div>
					</div>
					<div class="row">
						<div class="col-md-2">Datum a čas začátku:</div>
						<div class="col-md-10">{$udalost.od_datum} {$udalost.od_cas}</div>
					</div>
					<div class="row">
						<div class="col-md-2">Datum a čas konce:</div>
						<div class="col-md-10">{$udalost.do_datum} {$udalost.do_cas}</div>
					</div>	
					{if $udalost.popis}
						<div class="row">
							<div class="col-md-2">Popis události:</div>
							<div class="col-md-10">{$udalost.popis}</div>
						</div>
					{/if}
				</div>
			</div>						
		</div>
		<div class="col-md-4">
			<div class="box border blue">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Soubory k události</h4>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-striped">
						<tbody>
							{foreach $udalost.soubory as $soubor}
								<tr>
									<td class="text-center"><i class="fa fa-file-o fa-3x"></i></td>
									<td><a href="/{$smarty.const.KALENDAR_FILES_UPLOADS}/{$soubor.filename}">{$soubor.filename|substr:15:5000}</a></td>
								</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
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