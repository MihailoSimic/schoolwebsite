
<?php
session_start();
session_unset();
session_destroy();

?>
<script>
window.parent.location.reload();
</script>
