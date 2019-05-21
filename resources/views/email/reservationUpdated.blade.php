<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width">
    <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">
    <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>Confirmación de Reserva</title>
    <!-- The title tag shows in email notifications, like Android 4.4. -->


    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
    <style>
        * {
            font-family: rawline !important;
        }
    </style>

    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <link href="https://cdn.rawgit.com/h-ibaldo/Raleway_Fixed_Numerals/master/css/rawline.css" rel="stylesheet">

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset : BEGIN -->
    <style>
        /*  Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */

        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }
        /*  Stops email clients resizing small text. */

        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        /*  Centers email on Android 4.4 */

        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }
        /*  Stops Outlook from adding extra spacing to tables. */

        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }
        /*  Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */

        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        table table table {
            table-layout: auto;
        }
        /*  Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */

        a {
            text-decoration: none;
        }
        /*  Uses a better rendering method when resizing images in IE. */

        img {
            -ms-interpolation-mode: bicubic;
        }
        /*  A work-around for email clients meddling in triggered links. */

        *[x-apple-data-detectors],
            /* iOS */

        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
        /*  Prevents Gmail from displaying a download button on large, non-linked images. */

        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }
        /* If the above doesn't work, add a .g-img class to any image in question. */

        img.g-img+div {
            display: none !important;
        }
        /*  Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */
        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */

        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u~div .email-container {
                min-width: 320px !important;
            }
        }
        /* iPhone 6, 6S, 7, 8, and X */

        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u~div .email-container {
                min-width: 375px !important;
            }
        }
        /* iPhone 6+, 7+, and 8+ */

        @media only screen and (min-device-width: 414px) {
            u~div .email-container {
                min-width: 414px !important;
            }
        }
    </style>
    <!-- CSS Reset : END -->
    <!-- Reset list spacing because Outlook ignores much of our inline CSS. -->
    <style type="text/css">
        ul,
        ol {
            margin: 0 !important;
        }

        li {
            margin-left: 30px !important;
        }

        li.list-item-first {
            margin-top: 0 !important;
        }

        li.list-item-last {
            margin-bottom: 10px !important;
        }
    </style>

    <!-- Progressive Enhancements : BEGIN -->
    <style>
        .button-td-primary:hover,
        .button-a-primary:hover {
            background-color: #ED9C28 !important;
            border-color: none !important;
            border-radius: 50px;
        }
        /* Media Queries */

        @media screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                margin: auto !important;
            }
            /*  Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
            .fluid {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }
            /*  Forces table cells into full-width rows. */
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            /* And center justify these ones. */
            .stack-column-center {
                text-align: center !important;
            }
            /*  Generic utility class for centering. Useful for images, buttons, and nested tables. */
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }
            /*  Adjust typography on small screens to improve readability */
            .email-container p {
                font-size: 17px !important;
            }
        }
    </style>
    <!-- Progressive Enhancements : END -->

    <!--  Makes background images in 72ppi Outlook render at correct size. -->
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch></o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
</head>
<!--
	The email background color (#222222) is defined in three places:
	1. body tag: for most email clients
	2. center tag: for Gmail and Inbox mobile apps and web versions of Gmail, GSuite, Inbox, Yahoo, AOL, Libero, Comcast, freenet, Mail.ru, Orange.fr
	3. mso conditional: For Windows 10 Mail
-->

<body width="100%" class="body-tag" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #fff;">
<center style="width: 100%; background-color: #fff;">
    <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #fff;">
        <tr>
            <td>
    <![endif]-->

    <!-- Visually Hidden Preheader Text : BEGIN -->
    <div style="display: none; font-size: 1px; font-family: 'rawline', sans-serif; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all;">
        (Optional) This text will appear in the inbox preview, but not the email body. It can be used to supplement the email subject line or even summarize the email's contents. Extended text preheaders (~490 characters) seems like a better UX for anyone using
        a screenreader or voice-command apps like Siri to dictate the contents of an email. If this text is not included, email clients will automatically populate it using the text (including image alt text) at the start of the email's body.
    </div>
    <!-- Visually Hidden Preheader Text : END -->

    <!-- Create white space after the desired preview text so email clients don’t pull other distracting text into the inbox preview. Extend as necessary. -->
    <!-- Preview Text Spacing Hack : BEGIN -->
    <div style="display: none; font-size: 1px; font-family: 'rawline', sans-serif; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    <!-- Preview Text Spacing Hack : END -->

    <!-- Email Body : BEGIN -->
    <table valign="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: 0 auto;" class="email-container">
        <!-- Email Header : BEGIN -->
        <!-- Hero Image, Flush : BEGIN -->
        <tr>
            <td valign="bottom" style="text-align: center; background-image: url({{ url('storage/image/email-reservationUpdated-Fotos-1Confirmacion_de_reserva_05.jpg') }}); background-position: center center !important; background-size: cover !important; height: 270px">
                <!--[if gte mso 9]>
                <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:175px; background-position: center center !important;">
                    <v:fill type="tile" src="https://via.placeholder.com/600x230/222222/666666" color="#222222" />
                    <v:textbox inset="0,0,0,0">
                <![endif]-->
                <div>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td valign="bottom" style="text-align: left; padding: 10px 40px; font-family: sans-serif; font-size: 15px; font-family: 'rawline', sans-serif;line-height: 20px; color: #ffffff;">
                                <p><img src="{{ asset('storage/image/email-reservationUpdated-SVG-Logo_Castro.svg') }}" width="170"></p>
                                <hr style="border-color: #787878; border-bottom-width: 1px;">
                            </td>
                        </tr>
                    </table>
                </div>
                <!--[if gte mso 9]>
                </v:textbox>
                </v:rect>
                <![endif]-->
            </td>
        </tr>
        <!-- Hero Image, Flush : END -->
        <!-- Email Header : END -->

        <!-- 1 Column: BEGIN -->
        <tr>
            <td>
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td style="padding: 0 40px; font-size: 15px; font-family: 'rawline', sans-serif; line-height: 20px; background-color: #000;">
                            <h1 style="margin: 0 0 10px; text-align: left; font-size: 27px; font-family: 'rawline', sans-serif; line-height: 30px; color: #fff; font-weight: bold;">Tu reserva se ha modificado </h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px 40px; background-color: #000;">
                            <p style="text-align: left; color: #FFF; font-size: 17px; font-weight: 300; font-family: 'rawline', sans-serif; text-align: left;">Parece que has realizado cambios en tu reserva. A continuación te los indicamos en <span style="color: #EA9928; font-weight: bold;">color amarillo</span> </p>
                        </td>
                    </tr>

                    <!-- 2 Even Columns : BEGIN -->
                    <tr>
                        <td valign="top" style="padding: 10px; background-color: #000;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <!-- Column : BEGIN -->
                                    <td class="stack-column-center">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="padding: 10px; text-align: left; color: #fff;" valign="middle">
                                                    <img src="{{ asset('storage/image/email-reservationUpdated-SVG-Check_In.svg') }}" width="80" height="80" alt="check-in-img" border="0" class="fluid" style="height: auto; float: left; padding-left: 15px;">
                                                    <div style="float: left; margin-left: 15px; margin-top: 8px;">
                                                        <b style="font-size: 28px;font-family: 'rawline', sans-serif;">Check - In</b><br>
                                                        <span style="font-weight: bold; font-size: 20; font-family: 'rawline', sans-serif; color:#EA9928;">{{ $data['checkin'] }}</span><br>
                                                        <span style="font-weight: 300; font-size: 19; font-family: 'rawline', sans-serif;">{{ $data['checkinHour'] }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <!-- Column : END -->
                                    <!-- Column : BEGIN -->
                                    <td class="stack-column-center">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td style="padding: 10px; text-align: left; color: #fff;" valign="middle">
                                                    <img src="{{ asset('storage/image/email-reservationUpdated-SVG-Check_Out.svg') }}" width="80" height="80" alt="check-out-img" border="0" class="fluid" style="height: auto; float: left;">
                                                    <div style="float: left; margin-left: 15px; margin-top: 8px;">
                                                        <b style="font-size: 28px; font-family: 'rawline', sans-serif;">Check - Out</b><br>
                                                        <span style="font-weight: bold; font-size: 20; font-family: 'rawline', sans-serif;color: #EA9928;">{{ $data['checkout'] }}</span><br>
                                                        <span style="font-weight: 300; font-size: 19; font-family: 'rawline', sans-serif;">{{ $data['checkoutHour'] }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <!-- Column : END -->
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- 2 Even Columns : END -->

                </table>
            </td>
        </tr>
        <!-- 1 Column : END -->

        <!-- Column Table BEGIN -->
        <tr>
            <!-- Bulletproof Background Images c/o https://backgrounds.cm -->
            <td valign="middle" style="text-align: center; background-color: #000;">
                <!--[if gte mso 9]>
                <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:175px; background-position: center center !important;">
                    <v:fill type="tile" src="https://via.placeholder.com/600x230/222222/666666" color="#222222" />
                    <v:textbox inset="0,0,0,0">
                <![endif]-->
                <div>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td valign="middle" style="text-align: center; padding: 40px 40px 30px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #ffffff;">
                                <div style="font-weight: bold; margin: 0; background-color: #8E071C; border-radius: 3px; padding: 15px 15px;">
                                    <div style="float: left;">Localizador de reserva</div>
                                    <div style="text-align: right">{{ $data['locator'] }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" style="text-align: center; padding: 0px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #ffffff;">
                                <div style="margin: 0; background-color: #6D6F70; border-top-left-radius: 3px; border-top-right-radius: 3px; padding: 15px 15px;">
                                    <div style="float: left;">Nombre</div>
                                    <div style="text-align: right; font-weight: bold">{{ $data['name'] }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" style="text-align: center; padding: 0px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color:{{ $data['modificaciones']['adultos_modificados'] || $data['modificaciones']['ninos_modificados'] ? '#000' : '#fff' }};">
                                <div style="margin: 0; background-color: {{ $data['modificaciones']['adultos_modificados'] || $data['modificaciones']['ninos_modificados'] ? '#EA9928' : '#6D6F70' }}; padding: 15px 15px;">
                                    <div style="float: left;">N&ordm; pax</div>
                                    <div style="text-align: right; font-weight: bold">{{ $data['pax'] }}</div>
                                </div>
                            </td>
                        </tr>
                        {{--<tr>
                            <td valign="middle" style="text-align: center; padding: 0px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #ffffff;">
                                <div style="margin: 0; background-color: #6D6F70; padding: 15px 15px;border-bottom: 1px solid #56595A">
                                    <div style="float: left;">Portal</div>
                                    <div style="text-align: right; font-weight: bold">booking.com</div>
                                </div>
                            </td>
                        </tr>--}}
                        <tr>
                            <td valign="middle" style="text-align: center; padding: 0px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #ffffff;">
                                <div style="margin: 0; background-color: #6D6F70; padding: 15px 15px;border-bottom: 1px solid #56595A">
                                    <div style="float: left;">Apartamento</div>
                                    <div style="text-align: right; font-weight: bold">{{ $data['apartment'] }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" style="text-align: center; padding: 0px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: {{ $data['modificaciones']['apartamento_modificado'] ? '#000' : '#fff' }};">
                                <div style="margin: 0; background-color: {{ $data['modificaciones']['apartamento_modificado'] ? '#EA9928' : '#6D6F70' }}; padding: 15px 15px;border-bottom: 1px solid #56595A">
                                    <div style="float: left;">Tipo de apartamento</div>
                                    <div style="text-align: right;font-weight: bold">{{ $data['apartmentType'] }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" style="text-align: center; padding: 0px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: {{ $data['modificaciones']['regimen_modificado'] ? '#000' : '#fff' }};">
                                <div style="margin: 0; background-color: {{ $data['modificaciones']['regimen_modificado'] ? '#EA9928' : '#6D6F70' }}; padding: 15px 15px;">
                                    <div style="float: left;">Tipo de Régimen</div>
                                    <div style="text-align: right; font-weight: bold">{{ $data['package'] }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" style="text-align: center; padding: 0px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: {{ $data['modificaciones']['experiencia_modificada'] ? '#000' : '#fff' }};">
                                <div style="margin: 0; background-color: {{ $data['modificaciones']['experiencia_modificada'] ? '#EA9928' : '#6D6F70' }}; padding: 15px 15px;">
                                    <div style="float: left;">Experiencia</div>
                                    <div style="text-align: right; font-weight: bold">{{ $data['experience'] }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" style="text-align: center; padding: 0px 40px 40px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #ffffff;">
                                <div style="margin: 0; background-color: #6D6F70; padding: 15px 15px; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px; ">
                                    <div style="float: left;">Política de cancelación</div>
                                    <div style="text-align: right; font-weight: bold">{{ $data['cancellationPolicy'] }}</div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <!--[if gte mso 9]>
                </v:textbox>
                </v:rect>
                <![endif]-->
            </td>
        </tr>
        <tr>
            <td style="padding: 0 20px 20px; text-align: center; background-color: #000;">
                <!-- Button : BEGIN -->
                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: auto;">
                    <tr>
                        <td class="button-td button-td-primary">
                            <a class="button-a button-a-primary" href="#" style="background: #ED9C28; font-size: 21px; font-family: 'rawline', sans-serif; font-weight: bold; text-decoration: none; padding: 8px 30px 10px 30px; color: #000; display: block; border-radius: 50px;">¿Qué incluye mi experiencia?</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td style="padding: 0px 40px; background-color: #000;">
                <h1 style="margin: 0 0 10px; text-align: left; font-size: 20px; font-family: 'rawline', sans-serif; line-height: 30px; color: #fff; font-weight: bold;">Otros servicios que puedes contratar </h1>
                <hr style="border-color:#787878; border-bottom-width: 1px;">
            </td>
        </tr>
        <!-- Column Table : END -->

        <!-- 2 Columns : BEGIN -->
        <tr>
            <td valign="top" style="padding: 10px 10px 30px 10px; background-color: #000;">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <!-- Column : BEGIN -->
                        <td class="stack-column-center">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="padding-left: 30px;">
                                        <div style="text-align: right; background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), url({{ url('storage/image/email-reservationUpdated-Fotos-Deluxe-Guardamaletas.jpg') }}); background-position: center center !important; background-size: cover !important; width: 250px; height: 230px; border-radius: 3px;display: flex; align-items: flex-end; justify-content: flex-end;">
                                            <img src="{{ asset('storage/image/email-reservationUpdated-SVG-Recommended.svg') }}" width="70" style="margin-bottom: 150px;margin-right: 45px;">
                                            <p style="margin: 0; color: #FFF; font-size: 27;font-family: 'rawline', sans-serif;padding:0px 10px 10px 0px;">Guardamaletas<br> <b>€10 por día</b></p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <!-- Column : END -->
                        <!-- Column : BEGIN -->
                        <td class="stack-column-center">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="padding-left: 10px;">
                                        <div style="text-align: right; background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), url({{ url('storage/image/email-reservationUpdated-Fotos-Deluxe-Trae_a_tu_mascota.jpg') }}); background-position: center center !important; background-size: cover !important; width: 250px; height: 230px;border-radius: 3px;display: flex; align-items: flex-end; justify-content: flex-end;">
                                            <p style="margin: 0; color: #FFF; font-size: 27;font-family: 'rawline', sans-serif;padding:0px 10px 10px 0px;">Trae tu mascota<br> <b>€10 por día</b></p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <!-- Column : END -->
                    </tr>
                </table>
            </td>
        </tr>
        <!-- 2 Columns : END -->

        <!-- Column Table : BEGIN -->
        <tr>
            <td valign="middle" style="text-align: center; background-color: #000;">
                <!--[if gte mso 9]>
                <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:175px; background-position: center center !important;">
                    <v:fill type="tile" src="https://via.placeholder.com/600x230/222222/666666" color="#222222" />
                    <v:textbox inset="0,0,0,0">
                <![endif]-->
                <div>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td valign="middle" style="text-align: center; padding: 0px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #ffffff;">
                                <div style="margin: 0; background-color: #56595A; border-top-left-radius: 3px; border-top-right-radius: 3px; padding: 15px 15px;">
                                    <div style="text-align: left;">Resumen de pago</div>
                                </div>
                            </td>
                        </tr>
                        {{--<tr>
                            <td valign="middle" style="text-align: center; padding: 0px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #ffffff;">
                                <div style="margin: 0; background-color: #6D6F70; padding: 15px 15px;">
                                    <div style="float: left;">City tax</div>
                                    <div style="text-align: right; font-weight: bold">{{ $data['cityTax'] }}</div>
                                </div>
                            </td>
                        </tr>--}}
                        <tr>
                            <td valign="middle" style="text-align: center; padding: 0px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #000;">
                                <div style="margin: 0; background-color: #EA9928; padding: 15px 15px;border-bottom: 1px solid #000">
                                    <div style="float: left;">{{ $data['experience'] }}</div>
                                    <div style="text-align: right; font-weight: bold">{{ $data['experienceAmount'] }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" style="text-align: center; padding: 0px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #000;">
                                <div style="margin: 0; background-color: #EA9928; padding: 15px 15px 10px 15px;">
                                    <div style="text-align: left;">Servicios Extra</div>
                                </div>
                            </td>
                        </tr>
                        @foreach($data['services'] as $service)
                            <tr>
                                <td valign="middle" style="text-align: center; padding: 0px 40px; font-size: 18px; font-family: 'rawline', sans-serif; line-height: 18px; color: #000;">
                                    <div style="margin: 0; background-color: #EA9928; padding: 5px 15px;">
                                        <div style="float: left;">{{ $service['name'] }}</div>
                                        <div style="text-align: right; font-weight: bold">{{ $service['amount'] }}</div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td valign="middle" style="text-align: center; padding: 0px 40px 20px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #ffffff;">
                                <div style="margin: 0; background-color: #56595A; padding: 15px 15px; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;">
                                    <div style="float: left;"><b>Total</b> (IVA incluído)</div>
                                    <div style="text-align: right; font-weight: bold">{{ $data['total'] }}</div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <!--[if gte mso 9]>
                </v:textbox>
                </v:rect>
                <![endif]-->
            </td>
        </tr>
        <!-- Column Table : END -->

        <tr>
            <td style="text-align: center; background-color: #000;">
                <!-- Button : BEGIN -->
                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: auto;">
                    <tr>
                        <td class="button-td button-td-primary">
                            <a class="button-a button-a-primary" href="#" style="background: #ED9C28; font-size: 21px; font-family: 'rawline', sans-serif; font-weight: bold; text-decoration: none; padding: 8px 180px 10px 180px; color: #000; display: block; border-radius: 50px;">Check - In Online</a>
                        </td>
                    </tr>
                    <tr></tr>
                </table>
                <!-- Button : END -->
            </td>
        </tr>
        <tr>
            <td style="padding: 0px 40px; text-align: center; background-color: #000;">
                <p style="color: #FFF; font-size: 15px; font-family: 'rawline', sans-serif; text-align: left;">Realiza tu check-in online y ahorra tiempo cuando llegues a Barcelona, para que puedas disfrutar tu estancia desde el primer momento.</p>
            </td>
        </tr>

        <tr>
            <td valign="middle" style="text-align: center; padding: 10px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #fff;background-color: #000;">
                <div style="margin: 0; padding: 25px 15px 30px 15px;border-bottom: 1px solid #787878;border-top: 1px solid #787878">
                    <div style="float: left; text-align: left;margin-top: -10px;">
                        <b>Dirección</b> <br>
                        <span style="font-size: 19px; font-family: 'rawline', sans-serif;">{{ $data['address'] }}</span>
                    </div>
                    <div style="text-align: right; font-weight: bold">
                        <a href="#" style="color: #ED9C28">Ubicar en el mapa</a>
                    </div>
                </div>
            </td>
        </tr>

        <!-- Contact Columns : BEGIN -->
        <tr>
            <td valign="top" style="padding: 0px 0px 0px 0px; background-color: #000;">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <!-- Column : BEGIN -->
                        <td width="22.33%" class="stack-column-center">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/image/email-reservationUpdated-SVG-Botones.svg') }}" height="230" width="210" style="margin-top: 35px;margin-bottom:-4px">
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <!-- Column : END -->
                        <!-- Column : BEGIN -->
                        <td width="66.66%" class="stack-column-center" valign="top" style="padding-left:15px;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="color: #FFF;padding-bottom: 20px;">
                                        <p style="font-size: 14px; font-family: 'rawline', sans-serif; font-weight: 600;">¿Tienes dudas? Contáctanos</p>
                                        <div style="padding-bottom: 20px;">
                                            <img src="{{ asset('storage/image/email-reservationUpdated-SVG-Correos.svg') }}" width="15" style="float: left;padding:0px 10px 0px 5px;"> <span style="font-size: 13px;">+34 93 281 29 05</span>
                                        </div>
                                        <div>
                                            <img src="{{ asset('storage/image/email-reservationUpdated-SVG-Telefono.svg') }}" width="20" style="float:left;padding: 5px 10px 0px 3px;"> <span style="font-size: 13px; font-family: 'rawline', sans-serif;">welcome@castroexclusiveresidences.com</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #fff;padding-top: 10px;">
                                        <div style="margin: 0;">
                                            <div style="margin-right:10px;float: left;font-size: 14px; font-family: 'rawline', sans-serif; font-weight: 600; margin-top: 5px; padding-right:10px;">
                                                <div style="padding-bottom: 10px;">Síguenos en nuestras redes</div>
                                                <img src="{{ asset('storage/image/email-reservationUpdated-SVG-Instagram.svg') }}" width="20" style="float: left;padding: 4px 10px 0px 3px;"><a href="#" style="font-size: 13px; font-family: 'rawline', sans-serif; font-weight: 400; color: #FFF; text-decoration: none;">@castroexclusiveresidences</span>
                                            </div>
                                            <div style="float: left;text-align: left; padding: 5px 0px 10px 20px;border-left: 1px solid #787878;">
                                                <span style="font-size: 14px; font-family: 'rawline', sans-serif; font-weight: 600;">Descarga nuestra App</span> <br>
                                                <a href="#"><img src="{{ asset('storage/image/email-reservationUpdated-SVG-Banner_Google_Play.svg') }}" width="80" style="padding-top: 5px;"></a>
                                                <a href="#"><img src="{{ asset('storage/image/email-reservationUpdated-SVG-banner_app_store.svg') }}" width="70" style="padding-top: 5px;"></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <!-- Column : END -->
                    </tr>
                </table>
            </td>
        </tr>
        <!-- Contact Columns : END -->

        <!-- 3 Columns FOOTER : BEGIN -->
        <tr>
            <td valign="top" style="padding: 10px; background-color: #8E071C;">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <!-- Column : BEGIN -->
                        <td width="33.33%" class="stack-column-center">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td style="padding: 10px; text-align: center;font-size: 10px; font-family: 'rawline', sans-serif; color: #fff;">
                                        <a href="#" style="color: #FFF; text-decoration: none;">www.castroexclusiveresidences.com</a>
                                        <div style="padding-top:5px">
                                            <img src="{{ asset('storage/image/email-reservationUpdated-SVG-Instagram.svg') }}" width="20" style="float: left;">
                                            <a href="#" style="color: #FFF; text-decoration: none;">@castroexclusiveresidences</a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <!-- Column : END -->
                        <!-- Column : BEGIN -->
                        <td width="33.33%" class="stack-column-center" valign="bottom">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td style="font-size: 6px; font-family: 'rawline', sans-serif; color: #fff; text-align: center;" class="center-on-narrow">
                                        <p style="margin: 0;">Copyright © 2018 castro Exclusive Residences All Rights Reserved</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <!-- Column : END -->
                        <!-- Column : BEGIN -->
                        <td width="33.33%" style="text-align: right">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td style="padding: 10px 0px 10px 40px; text-align: right">
                                        <a href="#"><img src="{{ asset('storage/image/email-reservationUpdated-SVG-Logo_Castro.svg') }}" width="130" height="170" alt="logo-castro" border="0" class="fluid" style="height: auto;"></a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <!-- Column : END -->
                    </tr>
                </table>
            </td>
        </tr>
        <!-- 3 Columns FOOTER : END -->

        <!--[if mso | IE]>
        </td>
        </tr>
        </table>
        <![endif]-->
</center>
</body>

</html>