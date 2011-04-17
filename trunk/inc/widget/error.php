<?php 
require_once 'inc/class.log.php';

$log = Log::getInstance();

if($log->isError()){
?>
<div class="ui-widget">
	<div class='ui-state-error ui-corner-all' style="padding:0.8em">
		<span style="float:left" class='ui-icon ui-icon-alert'></span>
		<p style="margin-left:1.5em">
			<strong>Atenci&oacute;n:</strong> Ha ocurrido un error:
			<ul class="error-list">
			<?php
			foreach($log->getErrors() as $error){
				echo "<li>$error</li>";
			}
			?>
			</ul>
		</p>
	</div>
</div>
<br />
<?php
} 
?>