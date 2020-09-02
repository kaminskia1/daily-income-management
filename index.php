<?php
//Route user to project index
header("Location: src/index.php");
?>

<script>
    // JavaScript Fallback (1)
    document.location.href = document.location.href + "src/index.php";
</script>

<!-- HTML Fallback (2) -->
<a href="src/index.php"> Click Me </a>
