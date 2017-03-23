{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=breadcrumb}
	<div class="row">
	    <div class="col-md-12">
	        <ol class="breadcrumb">
	            <li><a href="/admin/uvod">Úvod</a></li>
	            <li><a href="/admin/knihovna">Knihovna</a></li>
	            <li class="active">Editace souboru</li>
	        </ol>
	    </div>
	</div>
{/block}

{block name=content}
	<div class="row">
		<div class="col-md-12">	
			<h1>Editace souboru</h1>
		</div>
	</div>
	<form action="/admin/?p1=knihovna&p2={$smarty.get.p2}&akce=ulozit" method="post" role="form" enctype="multipart/form-data">
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
									<label for="nazev">Název</label>
									<input type="text" class="form-control" name="title" value="{$soubor.title}">
								</div>									
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="nazev">Kategorie</label>
									<select name="parent_id" id="" class="form-control">
										<option value="0"><strong>Bez kategorie</strong></option>
										{foreach $kategorie.kategorie as $kat}
											<option value="{$kat.id}" {if $kat.id == $soubor.parent_id}selected{/if}>{$kat.title}</option>
											{foreach $kat.podkategorie as $podkat}
												<option value="{$podkat.id}" {if $podkat.id == $soubor.parent_id}selected{/if}>&nbsp;&nbsp;&nbsp; {$podkat.title}</option>
												{foreach $podkat.podkategorie as $podkat2}
													<option value="{$podkat2.id}" {if $podkat2.id == $soubor.parent_id}selected{/if}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$podkat2.title}</option>
													{foreach $podkat2.podkategorie as $podkat3}
														<option value="{$podkat3.id}" {if $podkat3.id == $soubor.parent_id}selected{/if}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$podkat3.title}</option>
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
			</div>
		</div>

		<input type="hidden" name="id_souboru" value="{$soubor.id}">
		<input type="hidden" name="id" value="{$smarty.get.id}">
		<input type="hidden" name="id2" value="{$smarty.get.id2}">
		<input type="hidden" name="id3" value="{$smarty.get.id3}">
		<input type="hidden" name="id4" value="{$smarty.get.id4}">
		<input type="hidden" name="zobrazit" value="{$smarty.get.zobrazit}">

		<!-- <input type="hidden" name="strana" value="{$smarty.get.strana}"> -->
		<!-- <input type="hidden" name="kategorie" value="{$smarty.get.kategorie}"> -->
		<!-- <input type="hidden" name="podkategorie" value="{$smarty.get.p2odkategorie}"> -->

		<!-- Tlacitko -->
			<div class="row">
				<div class="col-md-12">
					<div class="row text-center">
						<button type="submit" class="btn btn-success btn-md">
							Uložit
						</button>
					</div>
				</div>
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
{/block}