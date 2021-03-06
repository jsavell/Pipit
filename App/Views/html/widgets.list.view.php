<div class="do-results">
<?php
if ($parameters['widgets']) {
?>
	<table class="list">
		<tr>
			<th>Name</th>
			<th>Actions</th>
		</tr>
<?php
	foreach ($parameters['widgets'] as $widget) {
		echo "<tr>
					<td>{$widget['name']}</td>
					<td class=\"capitalize\">
						<a class=\"inline-block button button-small do-loadmodal\" href=\"{$app_http}?action=parts&widgetid={$widget['id']}\">Parts</a>
						<a class=\"inline-block button button-small do-loadmodal\" href=\"{$app_http}?action=edit&id={$widget['id']}\">Edit</a>";
echo '					<form class="inline-block do-submit-confirm" name="removewidget" method="POST" action="'.$app_http.'">
							<input type="hidden" name="action" value="remove" />
							<input type="hidden" name="id" value="'.$widget['id'].'" />
							<input class="inline-block small" type="submit" name="submitremove" value="Remove" />
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
