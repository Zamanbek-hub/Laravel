<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/403.css">
    <title>Document</title>
</head>
<body>
    <h1>403</h1>
    <div><p>> <span>ERROR CODE</span>: "<i>HTTP 403 Forbidden</i>"</p>
    <p>> <span>ERROR DESCRIPTION</span>: "<i>Access Denied. You Do Not Have The Permission To Access This Page On This Server</i>"</p>
    <p>> <span>ERROR POSSIBLY CAUSED BY</span>: [<b>execute access forbidden, read access forbidden, write access forbidden, ssl required, ssl 128 required, ip address rejected, client certificate required, site access denied, too many users, invalid configuration, password change, mapper denied access, client certificate revoked, directory listing denied, client access licenses exceeded, client certificate is untrusted or invalid, client certificate has expired or is not yet valid, passport logon failed, source access denied, infinite depth is denied, too many requests from the same client ip</b>...]</p>
    <p>> <span>SOME PAGES ON THIS SERVER THAT YOU DO HAVE PERMISSION TO ACCESS</span>: [<a href="/">Home Page</a>, <a href="/">About Us</a>, <a href="/">Contact Us</a>, <a href="/">Blog</a>...]</p><p>> <span>HAVE A NICE DAY SIR AXLEROD :-)</span></p>
    </div>

    <script type="text/javascript">
        var str = document.getElementsByTagName('div')[0].innerHTML.toString();
        var i = 0;
        document.getElementsByTagName('div')[0].innerHTML = "";

        setTimeout(function() {
            var se = setInterval(function() {
                i++;
                document.getElementsByTagName('div')[0].innerHTML = str.slice(0, i) + "|";
                if (i == str.length) {
                    clearInterval(se);
                    document.getElementsByTagName('div')[0].innerHTML = str;
                }
            }, 10);
        },0);

    </script>
    <!-- <a class="avatar" href="https://codepen.io/leenalavanya/" title="If you liked this pen, don't forget to heart, share and follow ❤"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/157344/profile/profile-512.jpg?1535437978"/></a> -->
</body>
</html>