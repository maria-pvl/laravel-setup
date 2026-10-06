<?php

header("Content-Type: text/css");

header("Cache-Control: public, max-age=86400");

header(
    "Expires: " .
    gmdate("D, d M Y H:i:s", time() + 86400) .
    " GMT"
);

?>

* {
box-sizing: border-box;
}

body {
margin: 0;
padding: 40px;

font-family: Arial, sans-serif;

background: #f3f4f6;
color: #222;
}


h1 {
margin-bottom: 10px;

font-size: 38px;
color: #1e868a;
}

body > p {
margin-bottom: 40px;

font-size: 18px;
color: #666;
}


h2 {
margin: 0;

font-size: 22px;
color: #333;
}


h2,
h2 + p,
h2 + a,
h2 + img {
margin-left: 0;
}


a {
display: inline-block;

margin-top: 15px;
padding: 12px 20px;

background: #1e868a;
color: white;

text-decoration: none;

border-radius: 8px;

transition: 0.2s;
}

a:hover {
background: #1e868a;
}


img {
display: block;

margin-top: 15px;

width: 300px;
max-width: 100%;

border-radius: 12px;

box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
}


hr {
margin: 40px 0;

border: none;
border-top: 1px solid #ddd;
}


.container {
max-width: 900px;
margin: 0 auto;
}


.subtitle {
margin-bottom: 35px;
}


.card {
margin-bottom: 20px;
padding: 25px;

background: white;

border-radius: 14px;

box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}


.card p {
line-height: 1.6;
color: #666;
}


.card h2 {
margin-bottom: 10px;
}