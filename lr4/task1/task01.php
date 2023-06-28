<html>
<head>
    <script>
        function showHint(str) {
            if (str.length === 0) {
                document.getElementById("txtHint").innerHTML = "";
            } else {
                let xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        document.getElementById("answer").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "train.php?q=" + str, true);
                xmlhttp.send();
            }
        }
    </script>
</head>
<body>
<p><b>Розпочніть вводити ім'я:</b></p>
<form action="">
    <label for="name">Ім'я:</label>
    <input type="text" id="name" name="name" onkeyup="showHint(this.value)">
</form>
<p>Мови програмування: <span id="answer"></span></p>
</body>
</html>