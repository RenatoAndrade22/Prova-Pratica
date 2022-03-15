<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="x-apple-disable-message-reformatting" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="color-scheme" content="light dark" />
        <meta name="supported-color-schemes" content="light dark" />
        <title></title>
        <style type="text/css" rel="stylesheet" media="all">
            /* Base ------------------------------ */

            @import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap");

            body {
                width: 100% !important;
                height: 100%;
                margin: 0;
                -webkit-text-size-adjust: none;
                background-color: #F4F4F7;
                color: #51545E;
            }

            h1 {
                margin-top: 0;
                color: #333333;
                font-weight: bold;
                margin-bottom: 0;
                font-size: 32px;
                font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
            }

            h2 {
                margin-top: 20px;
                color: #333333;
                font-size: 16px;
                font-weight: bold;
                text-align: center;

                font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
            }

            h3 {
                margin: 0;
                color: #333333;
                font-size: 14px;
                font-weight: bold;
                font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
            }

            p {
                margin: 0;
                color: #51545E;
                font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
            }
            ul{

            }
            li{
                font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
            }
            .sales_amount{
                width: 100%;
                border-bottom: 1px solid #999;
                padding-bottom: 20px;
                text-align: center;
                margin: 40px auto 0;
            }
            .card{
                float: left;
                width: 240px;
                text-align: center;
                padding: 30px 20px;
                background: #ffff;
                border-radius: 8px;
                margin: 20px;
            }
        </style>
    </head>
    <body>
        <div class="sales_amount">
            <h1>{{ $sales_amount }}</h1>
            <p>Faturamento do dia</p>
        </div>

        <div class="container">
            <h2>Relatório por vendedor</h2>
            @foreach($list_sellers as $seller)
                <div class="card">
                    <h3>{{ $seller['amount_format'] }}</h3>
                    <p>{{ $seller['name'] }} </p>
                </div>
            @endforeach
        </div>

    </body>
</html>
