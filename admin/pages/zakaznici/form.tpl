{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<form action="/admin/?p1={$smarty.get.p1}&p2={$smarty.get.p2}&akce=ulozit" method="post" role="form" enctype="multipart/form-data">
		<div class="row">	
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Fakturační údaje</h4>
							</div>
							<div class="box-body table-responsive">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="jmeno">Jméno:</label><input type="text" class="form-control" id="jmeno" name="jmeno" value="{$zakaznik.jmeno}" placeholder="Jméno">
										</div>									
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="prijmeni">Příjmení:</label><input type="text" class="form-control" id="prijmeni" name="prijmeni" value="{$zakaznik.prijmeni}" placeholder="Příjmení">
										</div>									
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="firma">Název firmy:</label><input type="text" class="form-control" id="firma" name="firma" value="{$zakaznik.firma}" placeholder="Název firmy">
										</div>									
									</div>
								</div>
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<label for="ulice">Ulice:</label><input type="text" class="form-control" id="ulice" name="ulice" value="{$zakaznik.ulice}" placeholder="Ulice">
										</div>									
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="psc">PSČ:</label><input type="text" class="form-control" id="psc" name="psc" value="{$zakaznik.psc}" placeholder="PSČ">
										</div>	
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label for="mesto">Město:</label><input type="text" class="form-control" id="mesto" name="mesto" value="{$zakaznik.mesto}" placeholder="Město">
										</div>	
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="telefon">Telefon:</label><input type="text" class="form-control" id="telefon" name="telefon" value="{$zakaznik.telefon}" placeholder="Telefon">
										</div>	
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="email">E-mail:</label><input type="text" class="form-control" id="email" name="email" value="{$zakaznik.email}" placeholder="E-mail">
										</div>	
									</div>
								</div>
							</div>
						</div>						
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Dodací údaje</h4>
							</div>
							<div class="box-body table-responsive">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="jmeno">Jméno:</label><input type="text" class="form-control" id="dod_jmeno" name="dod_jmeno" value="{$zakaznik.dod_jmeno}" placeholder="Jméno">
										</div>									
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="prijmeni">Příjmení:</label><input type="text" class="form-control" id="dod_prijmeni" name="dod_prijmeni" value="{$zakaznik.dod_prijmeni}" placeholder="Příjmení">
										</div>									
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="firma">Název firmy:</label><input type="text" class="form-control" id="dod_firma" name="dod_firma" value="{$zakaznik.dod_firma}" placeholder="Název firmy">
										</div>									
									</div>
								</div>
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<label for="ulice">Ulice:</label><input type="text" class="form-control" id="dod_ulice" name="dod_ulice" value="{$zakaznik.dod_ulice}" placeholder="Ulice">
										</div>									
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="psc">PSČ:</label><input type="text" class="form-control" id="dod_psc" name="dod_psc" value="{$zakaznik.dod_psc}" placeholder="PSČ">
										</div>	
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label for="mesto">Město:</label><input type="text" class="form-control" id="dod_mesto" name="dod_mesto" value="{$zakaznik.dod_mesto}" placeholder="Město">
										</div>	
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="telefon">Telefon pro přepravce:</label><input type="text" class="form-control" id="dod_telefon_prepravce" name="dod_telefon_prepravce" value="{$zakaznik.dod_telefon_prepravce}" placeholder="Telefon">
										</div>	
									</div>
								</div>
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="box border blue">
					<div class="box-title">
						<h4><i class="fa fa-table"></i>Poznámka k zákazníkovi</h4>
					</div>
					<div class="box-body table-responsive">
						<textarea name="poznamka" id="editor1" rows="5" cols="80">
			                {$zakaznik.poznamka}
			            </textarea>
					</div>
				</div>	
			</div>
		</div>
		
		<input type="hidden" name="id" value="{$zakaznik.id}">
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