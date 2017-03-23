{extends file="{$smarty.const.ADMIN_PAGES}layout.tpl"}
{block name=content}
	<div class="row">
		<div class="col-md-8">
			<div class="box border blue">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Kalendář</h4>
					<div class="buttons">
						<a href="/admin/kalendar/novy">
							<button type="button" class="btn btn-success btn-xs">
								<span class="glyphicon glyphicon-plus"></span> Vytvořit novou událost
							</button>
						</a>
					</div>
				</div>
				<div class="box-body table-responsive">
					<div id="calendar"></div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box border blue">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Agenda</h4>
				</div>
				<div class="box-body">
					<table class="table table-hovered">
						<thead>
							<tr>
								<th width="100">Od</th>
								<th width="100">Do</th>
								<th>Název události</th>
							</tr>
						</thead>
						<tbody>
							{foreach $udalosti_nasledujici as $u}
								<tr>
									<td><strong>{$u.od_datum|date_format:"%d.%m.%Y"}</strong>{if $u.od_cas != "00:00:00"}<br>{$u.od_cas|date_format:"%H:%M"}{/if}</td>
									<td><strong>{$u.do_datum|date_format:"%d.%m.%Y"}</strong>{if $u.do_cas != "00:00:00"}<br>{$u.do_cas|date_format:"%H:%M"}{/if}</td>
									<td><a href="/kalendar/udalost/{$u.id}">{$u.nazev}</a></td>
								</tr>
							{/foreach}
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>

{/block}
{block name=scripts}
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#calendar').fullCalendar({
		        header: {
			      left: 'prev,next today',
			      center: 'title',
			      right: 'month,agendaWeek,agendaDay'
			    },
			    editable: false,
			    eventLimit: true, // allow "more" link when too many events
			    events: [
			    {foreach $udalosti as $u}
			      {
			        title: '{$u.nazev}',
			        start: '{$u.od_datum}{if $u.od_cas != "00:00:00"}T{$u.od_cas}{else}T00:00:00{/if}',
			        end: '{$u.do_datum}{if $u.do_cas != "00:00:00"}T{$u.do_cas}{else}T23:59:59{/if}',
			        color: 'green',
			        {if $u.od_cas == "00:00:00" && $u.do_cas == "00:00:00"}allDay: true,{/if}
			      },
			    {/foreach}
			    ],
			    timeFormat: 'HH(:mm)' // uppercase H for 24-hour clock
		    })
		});
	</script>
{/block}