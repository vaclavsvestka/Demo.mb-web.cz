{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<form action="/admin/?p1={$smarty.get.p1}&p2={$smarty.get.p2}&p3={$smarty.get.p3}&akce=ulozit" method="post" role="form" enctype="multipart/form-data">
		<div class="row">	
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Údaje</h4>
							</div>
							<div class="box-body table-responsive">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="nazev">Název:</label><input type="text" class="form-control" id="nazev" name="nazev" value="{$par.nazev}" placeholder="Název parametru">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="popis">Popis:</label>
										<textarea name="popis" id="editor1" rows="5" cols="80">
							                {$par.popis}
							            </textarea>
									</div>
								</div>
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
		
		<input type="hidden" name="id" value="{$par.id}">
		<!-- Tlacitko -->
			<div class="fixed-buttons">
				<button type="submit" class="btn btn-success btn-md fixed-button" name="button" value="send">Uložit</button>
				<button type="submit" class="btn btn-success btn-md fixed-button" name="button" accesskey="s" value="send_exit">Uložit a odejít</button>
			</div>
		<!-- /Tlacitko -->
	</form>
{/block}
{block name=scripts}
	<script type="text/javascript">
        $(document).ready(function() {
            $('.fancybox').fancybox();
        });
    </script>
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
{/block}