{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=breadcrumb}
	<div class="row">
	    <div class="col-md-12">
	        <ol class="breadcrumb">
	            <li><a href="/admin/uvod">Úvod</a></li>
	            <li><a href="/admin/fotogalerie">Fotogalerie</a></li>
	            <li class="active">Editace fotografie</li>
	        </ol>
	    </div>
	</div>
{/block}
{block name=content}
	<script type="text/javascript">
        $(document).ready(function() {
            $('.fancybox').fancybox();
        });
    </script>
	<div class="row">
		<div class="col-md-12">
			<h1>Editace fotografie {$fotka.nazev}</h1>
		</div>
	</div>
	<form action="/admin/?m=fotogalerie&fotografie-alba&id={$smarty.get.id}&akce=upravit_fotku&akce2=ulozit&zobrazit={$smarty.get.zobrazit}" method="post" role="form">
		<div class="row">
			<div class="col-md-4">
				<a class="fancybox" rel="gallery1" href="{$smarty.const.PHOTO_UPLOADS}/{$fotka.soubor}" title="{$fotka.nazev}">
	                <img src="http://{$smarty.server.HTTP_HOST}/{$smarty.const.PHOTO_UPLOADS}/{$fotka.soubor}" class="photo-edit" alt="" />
	            </a>  
			</div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Název fotky</label>
							<input type="text" class="form-control" id="" name="nazev" value="{$fotka.nazev}" placeholder="Název fotky" required>
						</div>
						<div class="form-group">
							<label for="">Popis fotky</label>
							<textarea class="form-control" name="popis" placeholder="Popis fotky">{$fotka.popis}</textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row text-center margin-top-50">
			<input type="hidden" name="id_alba" value="{$smarty.get.id}">
			<input type="hidden" name="id_fotky" value="{$fotka.id}">
			<button type="submit" class="btn btn-success btn-lg">
				Uložit
			</button>
		</div>
	</form>
{/block}