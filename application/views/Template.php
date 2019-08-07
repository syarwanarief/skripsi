<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <script language='JavaScript'>
        var txt = "Implementasi Web Scraping Pada Mesin Pencari Jurnal";
        var speed = 300;
        var refresh = null;
        function action() {
            document.title = txt;
            txt = txt.substring(1, txt.length) + txt.charAt(0);
            refresh = setTimeout("action()", speed);
        }

        action();
    </script>

    <style type="text/css">

        {margin: 0px auto;}
        html, body {
            height: 100%;
        }

        ::selection {
            background-color: #E13300;
            color: white;
        }

        ::-moz-selection {
            background-color: #E13300;
            color: white;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
        }

        #body {
            margin: 0 15px 0 15px;
        }

        .footer {
            position: absolute;
            bottom: 0px;
            width: 98%;
        }

        }
        .menu {

            float:inherit;
            margin:0 auto 25px;
            width:101%;
            border:1px solid #dedede;
            padding:5%;
            background: #fff;
        }

        .artikel {
            height: auto;
            padding: 30px;
            border: 1px solid #543535;
        }

        .cari {
            border: 1px solid #543535;
            height: 100px;
            padding: 20px;
        }

        .navbar {
            overflow: hidden;
            background-color: #4e4a4a;
        }

        .navbar a {
            float: right;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .navbar a:hover {
            background: #ddd;
            color: darkred;
        }

        .pucuk {
            background: darkred;
            text-align: justify;
            height: 75px;
            text-align: center;
            top: 0px;
        }

        .container {
            position: relative;
        }

        .header {
            background: #0cf;
            padding: 10px;
        }

        .content {
            padding: 10px;
        }

        .footer {
            height: 50px;
            line-height: 50px;
            background: #333;
            color: #fff;
        }
    </style>

</head>

<body>

<div style="border: 5px solid #4e4a4a">
<div class="pucuk">

    <img src="../../../UNIVERSITASTEKNOKRAT.png" style="float:left; margin:0 3px 3px 0; width:70px; height:70px"/>

    <b><font size="6" color="#000000" style="alignment: center">Implementasi Web Scraping pada Mesin Pencari Jurnal</b></font>
</div>

    <div class="navbar">
        <a href="<?php echo base_url('Welcome/about') ?>">About</a>
        <a href="<?php echo base_url('Welcome/Home') ?>">Home</a>
    </div>

</div>
</body>
</html>