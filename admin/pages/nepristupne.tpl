<div class="row">
	<div class="col-md-12 text-center margin-top-120">
		<i class="fa fa-info fa-5x"></i>
		<div class="margin-top-20">
			<h1>Do této části nemáte přístup</h1>			
		</div>
		{if $smarty.get.p1 == "novinky" && $smarty.get.p2 == "edit"}
			<div>
				<h2>Požádejte o úpravy autora článku ({$autor})</h2>				
			</div>
		{/if}
		{if $smarty.get.p1 == "clanky" && $smarty.get.p2 == "edit"}
			<div>
				<h2>Požádejte o úpravy autora článku ({$autor})</h2>				
			</div>
		{/if}
	</div>
</div>