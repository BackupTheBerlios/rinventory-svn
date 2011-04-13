<?php
$db->query("UPDATE ".TBL_USER_ONLINE." SET active='D' WHERE active='H'");
?>
<script>
document.location='index.php';
</script>
