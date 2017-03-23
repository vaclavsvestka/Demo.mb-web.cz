{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="row">
		<div class="col-md-12">	
			{if $smarty.get.p2 == 'novy'}
				<h1>Přidání článku</h1>
			{elseif $smarty.get.p2 == 'edit'}
				<h1>Editace článku {$clanek.nadpis}</h1>
			{/if}
		</div>
	</div>
	<form action="/admin/?p1=blog&p2={$smarty.get.p2}&akce=ulozit" method="post" role="form" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-9">
				<div class="box border blue">
					<div class="box-title">
						<h4><i class="fa fa-table"></i>Článek</h4>
					</div>
					<div class="box-body table-responsive">
						<div class="row">
							<div class="col-md-12">
								<ul class="nav nav-tabs" role="tablist">
									{foreach $jazyky as $j}
										{if $j.zkratka == "cs"}
											<li role="presentation" class="active"><a href="#{$j.zkratka}" aria-controls="{$j.zkratka}" role="tab" data-toggle="tab">{$j.nazev}</a></li>
										{else}
											<li role="presentation"><a href="#{$j.zkratka}" aria-controls="{$j.zkratka}" role="tab" data-toggle="tab">{$j.nazev}</a></li>
										{/if}
									{/foreach}
								</ul>
								<hr>
							</div>
						</div>
						<div class="tab-content">
							{foreach $jazyky as $j}
								{assign var=zkratka value=$j.zkratka}
								{assign var=nadpis value=$clanek.texty.$zkratka.nadpis}
								{assign var=anotace value=$clanek.texty.$zkratka.anotace}
								{assign var=text value=$clanek.texty.$zkratka.text}
								{assign var=description value=$clanek.texty.$zkratka.description}
								{assign var=title value=$clanek.texty.$zkratka.title}
								<div role="tabpanel" class="tab-pane {if $j.zkratka == "cs"}active{/if}" id="{$j.zkratka}">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="">Nadpis <span style="text-transform: uppercase;">{$j.zkratka}</span></label>
												<input type="text" class="form-control" id="" name="nadpis_{$j.zkratka}" value="{$nadpis}" placeholder="Nadpis článku">
											</div>								
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="">Title <span style="text-transform: uppercase;">{$j.zkratka}</span></label>
												<input type="text" class="form-control" id="" name="title_{$j.zkratka}" value="{$title}" placeholder="Title stránky">
											</div>								
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="">Meta description <span style="text-transform: uppercase;">{$j.zkratka}</span></label>
												<textarea name="description_{$j.zkratka}" class="form-control" rows="5" cols="80">{$description}</textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="">Anotace <span style="text-transform: uppercase;">{$j.zkratka}</span></label>
												<textarea name="anotace_{$j.zkratka}" id="editor_anotace_{$j.zkratka}" rows="5" cols="80">{$anotace}</textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="">Text <span style="text-transform: uppercase;">{$j.zkratka}</span></label>
												<textarea name="text_{$j.zkratka}" id="editor_text_{$j.zkratka}" rows="10" cols="80">{$text}</textarea>
											</div>
										</div>
									</div>
								</div>
							{/foreach}
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="row">
					<div class="col-md-12">
						<div class="box border blue">
							<div class="box-title">
								<h4><i class="fa fa-table"></i>Kategorie článku</h4>
							</div>
							<div class="box-body table-responsive">
								<div class="row">	
									<div class="col-md-12">
										<div class="form-group">
											<label for="">Kategorie</label>
											<select name="kategorie" class="form-control">
												{foreach $kategorie_blogu as $kat}
													<option value="{$kat.id}" {if $kat.id == $clanek.kategorie}selected{/if}>{$kat.texty.cs.nazev}</option>
												{/foreach}
											</select>
										</div>
									</div>
								</div>
								<div class="row">	
									<div class="col-md-12">
										<div class="form-group">
											<label for="">URL</label>
											<input type="text" class="form-control" id="" name="url" value="{$clanek.url}" placeholder="URL stránky">
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
				                <h4><i class="fa fa-table"></i>Obrázek do seznamu článků</h4>
				                <div class="tools"></div>
				            </div>
				            <div class="box-body table-responsive">
				            	<div class="row">
				            		<div class="col-md-12 text-center">
				            			{if $clanek.obrazek1}
				            				<img src="/images/{$clanek.obrazek1}" style="width: 100%">
				            			{/if}
				            		</div>
				            	</div>
				            	<div class="row">
				            		<div class="col-md-12 text-center">
				            			<label>Nahrát obrázek:</label>
				            			<input type="file" name="obrazek1" class="form-control"></input>
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
				                <h4><i class="fa fa-table"></i>Obrázek v článku</h4>
				                <div class="tools"></div>
				            </div>
				            <div class="box-body table-responsive">
				            	<div class="row">
				            		<div class="col-md-12 text-center">
				            			{if $clanek.obrazek2}
				            				<img src="/images/{$clanek.obrazek2}" style="width: 100%">
				            			{/if}
				            		</div>
				            	</div>
				            	<div class="row">
				            		<div class="col-md-12 text-center">
				            			<label>Nahrát obrázek:</label>
				            			<input type="file" name="obrazek2" class="form-control"></input>
				            		</div>
				            	</div>
				            </div>
				        </div>
					</div>
				</div>
			</div>
		</div>
		<!-- Tlacitko -->
			<input type="hidden" name="id" value="{$clanek.id}">
			<div class="fixed-buttons">
				<input type="hidden" name="autor" value="{$logged_user.id}">
				<button type="submit" class="btn btn-success btn-md fixed-button" name="button" value="send">Uložit</button>
				<button type="submit" class="btn btn-success btn-md fixed-button" name="button" accesskey="s" value="send_exit">Uložit a odejít</button>
			</div>
		<!-- /Tlacitko -->
	</form>
{/block}

{block name=scripts}
	{foreach $jazyky as $j}
		<script>
	        CKEDITOR.replace( 'editor_anotace_{$j.zkratka}' );
	    </script>
		<script>
	        CKEDITOR.replace( 'editor_text_{$j.zkratka}' );
	    </script>
	{/foreach}
{/block}