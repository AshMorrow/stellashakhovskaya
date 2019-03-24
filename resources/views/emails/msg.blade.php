<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stella Shakhovskaya</title>

    <style type="text/css">
        body {
            margin: 0;
        }

        body, table, td, p, a, li, blockquote {
            -webkit-text-size-adjust: none !important;
            font-family: Merienda, 'Times New Roman', serif;
            font-style: normal;
            font-weight: 400;
        }

        button {
            width: 90%;
        }

        @media screen and (max-width: 600px) {
            /*styling for objects with screen size less than 600px; */
            body, table, td, p, a, li, blockquote {
                -webkit-text-size-adjust: none !important;
                font-family: Merienda, 'Times New Roman', serif;
            }

            table {
                /* All tables are 100% width */
                width: 100%;
            }

            .footer {
                /* Footer has 2 columns each of 48% width */
                height: auto !important;
                max-width: 48% !important;
                width: 48% !important;
            }

            table.responsiveImage {
                /* Container for images in catalog */
                height: auto !important;
                max-width: 30% !important;
                width: 30% !important;
            }

            table.responsiveContent {
                /* Content that accompanies the content in the catalog */
                height: auto !important;
                max-width: 66% !important;
                width: 66% !important;
            }

            .top {
                /* Each Columnar table in the header */
                height: auto !important;
                max-width: 48% !important;
                width: 48% !important;
            }

            .catalog {
                margin-left: 0% !important;
            }

        }

        @media screen and (max-width: 480px) {
            /*styling for objects with screen size less than 480px; */
            body, table, td, p, a, li, blockquote {
                -webkit-text-size-adjust: none !important;
                font-family: Merienda, 'Times New Roman', serif;
            }

            table {
                /* All tables are 100% width */
                width: 100% !important;
                border-style: none !important;
            }

            .footer {
                /* Each footer column in this case should occupy 96% width  and 4% is allowed for email client padding*/
                height: auto !important;
                max-width: 96% !important;
                width: 96% !important;
            }

            .table.responsiveImage {
                /* Container for each image now specifying full width */
                height: auto !important;
                max-width: 96% !important;
                width: 96% !important;
            }

            .table.responsiveContent {
                /* Content in catalog  occupying full width of cell */
                height: auto !important;
                max-width: 96% !important;
                width: 96% !important;
            }

            .top {
                /* Header columns occupying full width */
                height: auto !important;
                max-width: 100% !important;
                width: 100% !important;
            }

            .catalog {
                margin-left: 0% !important;
            }

            button {
                width: 90% !important;
            }
        }
    </style>
</head>
<body yahoo="yahoo">
<table width="100%" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
        <td>
            <table width="600" align="center" cellpadding="0" cellspacing="0">
                <!-- Main Wrapper Table with initial width set to 60opx -->
                <tbody>
                <tr>
                    <td>
                        <table class="top" width="96%" align="left" cellpadding="0" cellspacing="0"
                               style="padding:10px 10px 10px 10px;border-bottom: 1px solid #ddd;">
                            <!-- First header column with Logo -->
                            <tbody>
                            <tr>
                                <td style="font-size: 12px; text-align:center; font-family: Merienda, 'Times New Roman', serif, sans-serif;">
                                    <img src="{{env('APP_URL')}}img/logo/logo.png" width="100%" class="">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <!-- Introduction area -->
                    <td>
                        <table width="96%" align="left" cellpadding="0" cellspacing="0"
                               style="border-bottom: 1px solid #ddd">


                            <tr>
                                <!-- Row container for Intro/ Description -->
                                <td align="left"
                                    style="font-size: 16px;font-style: normal;font-weight: 100;color: #666;line-height: 1.8;text-align:justify;padding: 10px;font-family:Merienda, 'Times New Roman', serif, sans-serif;">
                                    <table style="width: 100%;text-align: center;">
                                        <tr>
                                            <td><span style="width: 40px; display: inline-table;">Имя:</span>
                                                {{$name}}
                                            </td>
                                            <td><span style="width: 70px; display: inline-table;">Телефон:</span>
                                                {{$phone}}<br>
                                            </td>
                                            <td><span style="width: 50px; display: inline-table;">Email:</span>
                                                {{$from_adr}}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <!-- Introduction area -->
                    <td>
                        <table width="96%" align="left" cellpadding="0" cellspacing="0">


                            <tr>
                                <!-- Row container for Intro/ Description -->
                                <td align="left"
                                    style="font-size: 14px; font-style: normal; font-weight: 100; color: #929292; line-height: 1.8; text-align:justify; padding:10px 20px 0px 20px; font-family:Merienda, 'Times New Roman', serif, sans-serif;">
                                    {!!nl2br($msg) !!}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>