{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="row">
		<div class="col-md-12">	
			{if $smarty.get.p == 'novy'}
				<h1>Přidání pokoje</h1>
			{elseif $smarty.get.p == 'edit'}
				<h1>Editace pokoje {$pokoj.nazev}</h1>
			{/if}
		</div>
	</div>
	
	<form action="/admin/?p1=pokoje&p2={$smarty.get.p2}&akce=ulozit" method="post" role="form">
		<!-- Název pokoje -->
			<div class="row">	
				<div class="col-md-12">
					<div class="box border blue">
						<div class="box-title">
							<h4><i class="fa fa-table"></i>Základní údaje</h4>
						</div>
						<div class="box-body table-responsive">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Název pokoje</label>
										<input type="text" class="form-control" id="" name="nazev" value="{$pokoj.nazev}" placeholder="Název pokoje">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Cena</label>
										<input type="text" class="form-control" id="" name="cena" value="{$pokoj.cena}" placeholder="Cena pokoje">
									</div>
								</div>
							</div>
						</div>
					</div>			
				</div>
			</div>
		<!-- /Název pokoje -->

		<!-- Složka galerie -->
			<div class="row">
                <div class="col-md-12">
                    <div class="box border blue">
                        <div class="box-title">
                            <h4><i class="fa fa-table"></i>Složka knihovny</h4>
                        </div>
                        <div class="box-body table-responsive">
                            <div class="form-group">
                                <label for="nazev">Přiřadit složku knihovny:</label>
                                <select name="galerie_id" id="" class="form-control">
                                    <option value="0">Žádná složka</option>
                                    {foreach $knihovna_kategorie.kategorie as $kat}
                                        <option value="{$kat.id}" {if $kat.id == $pokoj.galerie_id}selected{/if}>-- {$kat.title}</option>
                                        {foreach $kat.podkategorie as $podkat}
                                            <option value="{$podkat.id}" {if $podkat.id == $pokoj.galerie_id}selected{/if}>&nbsp;&nbsp;&nbsp;{$podkat.title}</option>
                                            {foreach $podkat.podkategorie as $podkat2}
                                                <option value="{$podkat2.id}" {if $podkat2.id == $pokoj.galerie_id}selected{/if}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$podkat2.title}</option>
                                                {foreach $podkat2.podkategorie as $podkat3}
                                                    <option value="{$podkat3.id}" {if $podkat3.id == $pokoj.galerie_id}selected{/if}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$podkat3.title}</option>
                                                {/foreach}  
                                            {/foreach}  
                                        {/foreach}
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                    </div>              
                </div>
            </div>
		<!-- /Složka galerie -->

		<!-- Anotace -->
			<div class="row">	
				<div class="col-md-12">
					<div class="box border blue">
						<div class="box-title">
							<h4><i class="fa fa-table"></i>Anotace</h4>
						</div>
						<div class="box-body table-responsive">
							<textarea name="anotace" id="editor1" rows="5" cols="80">
				                {$pokoj.anotace}
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
							<textarea name="popis" id="editor2" rows="10" cols="80">
				                {$pokoj.popis}
				            </textarea>
				            <script>
				                CKEDITOR.replace( 'editor2' );
				            </script>
						</div>
					</div>
				</div>
			</div>
		<!-- /Text -->
		
		<input type="hidden" name="id" value="{$pokoj.id}">

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
	<script>
        CKEDITOR.replace( 'editor2' );
    </script>
{/block}