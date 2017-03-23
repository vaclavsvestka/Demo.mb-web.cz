{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="row">
		<div class="col-md-2">
			<ol class="tree">
				<li>
					<label for="folder1">Folder 1</label> <input type="checkbox" id="folder1" /> 
					<ol>
						<li>
							<label for="subfolder1">Subfolder 1</label> <input type="checkbox" id="subfolder1" /> 
							<ol>
								<li>
									<label for="subsubfolder1">Subfolder 1</label> <input type="checkbox" id="subsubfolder1" /> 
									<ol>
										<li>
											<label for="subsubfolder2">Subfolder 1</label> <input type="checkbox" id="subsubfolder2" /> 
											<ol>
												<li class="file"><a href="">Subfile 1</a></li>
												<li class="file"><a href="">Subfile 2</a></li>
												<li class="file"><a href="">Subfile 3</a></li>
												<li class="file"><a href="">Subfile 4</a></li>
												<li class="file"><a href="">Subfile 5</a></li>
												<li class="file"><a href="">Subfile 6</a></li>
											</ol>
										</li>
										<li class="file"><a href="">File 1</a></li>
									</ol>
								</li>
								<li class="file"><a href="">Filey 1</a></li>
								<li class="file"><a href="">File 3</a></li>
								<li class="file"><a href="">File 4</a></li>
								<li class="file"><a href="">File 5</a></li>
								<li class="file"><a href="">File 6</a></li>
							</ol>
						</li>
						<li class="file"><a href="document.html.pdf">File 1</a></li>
					</ol>
				</li>
			</ol>
		</div>	
		<div class="col-md-10 text-right">
			<a href="/admin/knihovna/nova-slozka{$odkaz}">
				<button type="button" class="btn btn-success btn-xs">
					<span class="glyphicon glyphicon-plus"></span> Přidat složku
				</button>
			</a>
			<a href="/admin/knihovna/soubory-pridat-form{$odkaz}">
				<button type="button" class="btn btn-success btn-xs">
					<span class="glyphicon glyphicon-plus"></span> Přidat soubory
				</button>
			</a>
		</div>	
	</div>
	
	
{/block}
{block name=scripts}
	<script type="text/javascript">
        $(document).ready(function() {
            $('.fancybox').fancybox();
        });
    </script>
{/block}