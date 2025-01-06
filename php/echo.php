<?php
//header("Content-Security-Policy: default-src 'self'; script-src php.example.org origin2.example.org; img-src 'self' upload.wikimedia.org");

// header for
//header("Content-Security-Policy: default-src 'self'; script-src php.example.org origin2.example.org; img-src 'self' upload.wikimedia.org");

// header for hash
//header("Content-Security-Policy: default-src 'self';script-src 'sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=' 'sha256-R8zYyr6SsdPtVRksL/WqTk/W/Roz22Ncr6LJrMEl3Fs='");

$nonce = bin2hex(openssl_random_pseudo_bytes(32));
//header("Content-Security-Policy: default-src 'self';script-src 'self' 'sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=' origin2.example.org 'nonce-$nonce';img-src 'self' upload.wikimedia.org;frame-src origin2.example.org");

$cookie_value = 123123;
setcookie("SESSION_ID", $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

if (isset($_GET['search']))
{
    $search = $_GET['search'];
    $results = "nothing found.";
} else {
    $search = "";
    $results = "";
}

?><!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles1.css">
    <script 
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" 
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
        crossorigin="anonymous"></script>
    <style>
        img {
            border-bottom: 2px solid green;
        }
    </style>
</head>
<body>
    <div>
        <p>Hello! You searched for "<?=$search?>".<p>
    </div>
    <div>
        <form id="form1">
        <input name="search" value="<?=$search?>" />
        <input type="submit">
        </form>
        <button type="check" onclick="check()">check</button>
        
    </div>
    <div id="results">
        <img width="10%" src="A-Cat.jpg" onclick="alert('click')">
        <img width="10%" src="https://upload.wikimedia.org/wikipedia/commons/7/74/A-Cat.jpg" onclick="alert('click')">
    <?=$results?>
    </div>
    
    <iframe src="frame.html"></iframe>
    <iframe src="https://origin2.example.org/frame.html"></iframe>
    <iframe src="data:text/html,%3cscript%3edocument.write%28%27iframe3%27%29%3c%2fscript%3e"></iframe>

    <script></script>
</body>
<script nonce="<?=$nonce?>" src="script1.js"></script>
<script src="https://origin2.example.org/script2.js"></script>
<script>document.body.innerHTML += "<p>inline1 executed</p>"</script>
<script nonce="<?=$nonce?>">
        function check(){
            alert("check");
        }

        $("body").append("JQuery is loaded");

        const obj = { x: 20, y: 30 };
        const msg = eval('`<p>this is an eval message: ${obj.x}</p>`');
        document.body.innerHTML += msg;
    </script>
</html>