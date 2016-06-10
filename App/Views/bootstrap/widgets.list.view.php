<div class="do-results">
<?php
if ($parameters['widgets']) {
?>
	<table class="table">
		<tr>
			<th>Name</th>
			<th>Actions</th>
		</tr>
<?php
	foreach ($parameters['widgets'] as $widget) {
		echo "<tr>
					<td>{$widget['name']}</td>
					<td class=\"capitalize\">";
echo '					<a class="btn btn-default do-loadmodal" href="'.$app_http.'?action=parts&widgetid='.$widget['id'].'">Parts</a>
						<a class="btn btn-default do-loadmodal" href="'.$app_http.'?action=edit&id='.$widget['id'].'">Edit</a>
						<form class="inline-block do-submit-confirm" name="removewidget" method="POST" action="'.$app_http.'">
							<input type="hidden" name="action" value="remove" />
							<input type="hidden" name="id" value="'.$widget['id'].'" />
							<input class="btn btn-default" type="submit" name="submitremove" value="Remove" />
						</form>';
echo "
					</td>
				</tr>";
	}
?>
	</table>
<?php
} else {
	echo 'No widgets, yet!';
}
?>
</div>
