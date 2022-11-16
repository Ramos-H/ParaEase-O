<html><head>
<script type="text/javascript">
function logout() {
    var hexagon;
    if (window.XMLHttpRequest) {
        hexagon = new XMLHttpRequest();
    }
    // code for IE
    else if (window.ActiveXObject) {
        hexagon=new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (window.ActiveXObject) {
      // IE clear HTTP Authentication
      document.execCommand("ClearAuthenticationCache");
      window.location.href='admin.php';
    } else {
        hexagon.open("GET", 'admin.php', true, "logout", "logout");
        hexagon.send("");
        hexagon.onreadystatechange = function() {
            if (hexagon.readyState == 4) {window.location.href='admin.php';}
        }


    }
    return false;
}
</script>
</head>
<body>
<a href="#" onclick="logout();">Log out</a>
</body>
</html>