<html>
<head>
<script>
var conn = new WebSocket("<?php echo Ratchet::get_uri('Socket'); ?>");
conn.onopen = function(e) {
    console.log("Connection established!");
};
conn.onmessage = function(e) {
    console.log(e.data);
};
function send() {
    var msg = document.getElementById("text").value;
    conn.send(msg);
}
</script>
</head>
<body>
<input type="text" id="text" />
<input type="button" id="button" value="Send" onclick="send();" />
</body>
</html>
