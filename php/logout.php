<?php
session_start();
session_unset(); // Clear all session variables
session_destroy(); // Destroy the session
echo "<script>
        localStorage.removeItem('userName'); // Remove username from localStorage
        window.location.href = '/perpustakaan/index.html'; // Redirect to login page
      </script>";
?>