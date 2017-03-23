{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<form action="/admin/?p1={$smarty.get.p1}&p2={$smarty.get.p2}&akce=ulozit" method="post" role="form" enctype="multipart/form-data">
		
		<div class="row">	
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Údaje o rezervaci</h4>
							</div>
							<div class="box-body table-responsive">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="datum_od">Datum příjezdu:</label>
											<input type="date" class="form-control" id="datum_od" name="datum_od" value="{$rezervace.datum_od}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="datum_od">Datum odjezdu:</label>
											<input type="date" class="form-control" id="datum_do" name="datum_do" value="{$rezervace.datum_do}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<label for="pokoj_id">Pokoj:</label>
										<select name="pokoj_id" id="" class="form-control">
											{foreach $pokoje as $p}
												<option value="{$p.id}">{$p.nazev}</option>
											{/foreach}
										</select>
									</div>
									<div class="col-md-6">
										<label for="zakaznik_id">Zákazník:</label>
										<select name="zakaznik_id" id="" class="form-control">
											<option value="">Vybrat zákazníka</option>
											{foreach $zakaznici as $z}
												<option value="{$z.id}">{$z.jmeno} {$z.prijmeni}{if $z.firma} - {$z.firma}{/if}</option>
											{/foreach}
										</select>
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
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Nový zákazník</h4>
							</div>
							<div class="box-body table-responsive">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="jmeno">Jméno:</label><input type="text" class="form-control" id="jmeno" name="jmeno" value="{$rezervace.jmeno}" placeholder="Jméno">
										</div>									
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="prijmeni">Příjmení:</label><input type="text" class="form-control" id="prijmeni" name="prijmeni" value="{$rezervace.prijmeni}" placeholder="Příjmení">
										</div>									
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="firma">Název firmy:</label><input type="text" class="form-control" id="firma" name="firma" value="{$rezervace.firma}" placeholder="Název firmy">
										</div>									
									</div>
								</div>
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<label for="ulice">Ulice:</label><input type="text" class="form-control" id="ulice" name="ulice" value="{$rezervace.ulice}" placeholder="Ulice">
										</div>									
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="psc">PSČ:</label><input type="text" class="form-control" id="psc" name="psc" value="{$rezervace.psc}" placeholder="PSČ">
										</div>	
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label for="mesto">Město:</label><input type="text" class="form-control" id="mesto" name="mesto" value="{$rezervace.mesto}" placeholder="Město">
										</div>	
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="telefon">Telefon:</label><input type="text" class="form-control" id="telefon" name="telefon" value="{$rezervace.telefon}" placeholder="Telefon">
										</div>	
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="email">E-mail:</label><input type="text" class="form-control" id="email" name="email" value="{$rezervace.email}" placeholder="E-mail">
										</div>	
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="poznamka">Poznámka:</label>
										<textarea name="poznamka" id="editor1" rows="5" cols="80">
							                {$rezervace.poznamka}
							            </textarea>
									</div>
								</div>
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
		
		<input type="hidden" name="id" value="{$rezervace.id}">
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