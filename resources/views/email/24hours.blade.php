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
<title>{{ CTrans::trans('pages.header.welcome', $data['lang']) }}</title>
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
        {{ CTrans::trans('pages.header.preheader', $data['lang']) }}
    </div>
    <!-- Visually Hidden Preheader Text : END -->

    <!-- Create white space after the desired preview text so email clients don’t pull other distracting text into the inbox preview. Extend as necessary. -->
    <!-- Preview Text Spacing Hack : BEGIN -->
    <div style="display: none; font-size: 1px; font-family: 'rawline', sans-serif; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    <!-- Preview Text Spacing Hack : END -->

    <!-- Email Body : BEGIN -->
    <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: 0 auto;" class="email-container">
        <!-- Email Header : BEGIN -->
        <!-- Hero Image, Flush : BEGIN -->
        <tr>
            <td valign="top" style="text-align: center; background-image: linear-gradient(to bottom, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 1)), url('storage/image/email-24hours-background.jpg'); background-position: center center !important; background-size: cover !important;">
                <!--[if gte mso 9]>
                <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:175px; background-position: center center !important;">
                    <v:fill type="tile" src="https://via.placeholder.com/600x230/222222/666666" color="#222222" />
                    <v:textbox inset="0,0,0,0">
                <![endif]-->
                <!--[if gte mso 9]>
                </v:textbox>
                </v:rect>
                <![endif]-->
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" height="270px">
                    <tr>
                        <td valign="bottom" style="text-align: left; padding: 10px 40px; font-family: sans-serif; font-size: 15px; font-family: 'rawline', sans-serif;line-height: 20px; color: #ffffff;">
                            <p><img src="{{ asset('storage/image/email-24hours-LogoCastro.svg') }}" width="150"></p>
                            <hr style="height: 1px;border: none;background-color: #787878;">
                            <h1 style="margin: 0 0 10px; text-align: left; font-size: 27px; font-family: 'rawline', sans-serif; line-height: 30px; color: #fff; font-weight: bold;">{{ CTrans::trans('pages.24Hours.until', $data['lang']) }}</h1>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- Hero Image, Flush : END -->
        <!-- Email Header : END -->

        <!-- 1 Column: BEGIN -->
        <tr>
            <td style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 1), rgba(0, 0, 0, 1));">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">


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
                                                    <img src="{{ asset('storage/image/email-24hours-Check_In.svg') }}" width="80" height="80" alt="check-in-img" border="0" class="fluid" style="height: auto; float: left; padding-left: 15px;">
                                                    <div style="float: left; margin-left: 15px; margin-top: 8px;">
                                                        <b style="font-size: 28px;font-family: 'rawline', sans-serif;">{{ CTrans::trans('pages.24Hours.checkin', $data['lang']) }}</b><br>
                                                        <span style="font-weight: 300; font-size: 19; font-family: 'rawline', sans-serif;">{{ date('Y-m-d', strtotime($data['reserva']['checkin'])) }}</span><br>
                                                        <span style="font-weight: 300; font-size: 19; font-family: 'rawline', sans-serif;">{{--hora--}}</span>
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
                                                    <img src="{{ asset('storage/image/email-24hours-Check_Out.svg') }}" width="80" height="80" alt="check-out-img" border="0" class="fluid" style="height: auto; float: left;">
                                                    <div style="float: left; margin-left: 15px; margin-top: 8px;">
                                                        <b style="font-size: 28px; font-family: 'rawline', sans-serif;">{{ CTrans::trans('pages.24Hours.checkout', $data['lang']) }}</b><br>
                                                        <span style="font-weight: 300; font-size: 19; font-family: 'rawline', sans-serif;">{{ date('Y-m-d', strtotime($data['reserva']['checkout'])) }}</span><br>
                                                        <span style="font-weight: 300; font-size: 19; font-family: 'rawline', sans-serif;">{{--hora--}}</span>
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
                            <td valign="middle" style="text-align: center; padding: 25px 40px 30px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #ffffff;">
                                <div style="font-weight: bold; margin: 0; background-color: #8E071C; border-radius: 3px; padding: 15px 15px;">
                                    <div style="float: left;">{{ CTrans::trans('pages.booking.tracker', $data['lang']) }}</div>
                                <div style="text-align: right">{{ $data['reserva']['localizador_erp'] }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" style="text-align: center; padding: 0px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #ffffff;">
                                <div style="margin: 0; border-bottom: 1px solid #898989; background-color: #6D6F70; border-top-left-radius: 3px; border-top-right-radius: 3px; padding: 15px 15px;">
                                    <div style="float: left;">{{ CTrans::trans('pages.booking.name', $data['lang']) }}</div>
                                    <div style="text-align: right; font-weight: bold">{{ $data['reserva']['user']['name'] }} {{ $data['reserva']['user']['last_name'] }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" style="text-align: center; padding: 0px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #ffffff;">
                                <div style="margin: 0; border-bottom: 2px solid #898989; background-color: #6D6F70; padding: 15px 15px;">
                                    <div style="float: left;">{{ CTrans::trans('pages.booking.apartament', $data['lang']) }}</div>
                                    <div style="text-align: right; font-weight: bold">{{ $data['reserva']['apartmentName'] }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" style="text-align: center; padding: 0px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #ffffff;">
                                <div style="margin: 0; border-bottom: 1px solid #898989; background-color: #6D6F70; padding: 15px 15px;">
                                    <div style="float: left;">{{ CTrans::trans('pages.booking.apartamentType', $data['lang']) }}</div>
                                    <div style="text-align: right; font-weight: bold">{{ $data['reserva']['apartmentType'] }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td valign="middle" style="text-align: center; padding: 0px 40px 40px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #ffffff;">
                                <div style="margin: 0; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px; background-color: #6D6F70; padding: 15px 15px;">
                                    <div style="float: left;">{{ CTrans::trans('pages.booking.experience', $data['lang']) }}</div>
                                    <div style="text-align: right; font-weight: bold">{{ $data['reserva']['experienceName'] }}</div>
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
            <td valign="middle" style="text-align: center;padding: 0px 0px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #fff;background-color: #000;">
                <hr style="width: 72%; margin-bottom: 15px; padding: 0px 40px 0px 40px;background-color: #787878;height: 1px;border: none;">
                <div style="margin: 0; padding: 25px 0px 30px 40px;">
                    <div style="float: left; text-align: left;margin-top: -10px;">
                        <b>{{ CTrans::trans('pages.24Hours.timeBarcelona', $data['lang']) }}</b>
                    </div>
                </div>
                <div style="display:inline-block; Margin: 0 -2px; max-width:25%; min-width:180px; vertical-align:top; width:100%;" class="stack-column">
                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 0px 10px;">
                                <table cellspacing="0" cellpadding="0" border="0" width="100%" style="font-size: 14px;text-align: left;">
                                    <tr>
                                        <td>
                                            <img src="{{ asset('storage/image/email-24hours-24horas03.svg') }}" width="200" alt="" style="transform: translateX(25px); border: 0;width: 100px;max-width: 200px;" class="center-on-narrow">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; padding-top: 10px;" class="stack-column-center">
                                            <p style="text-align: center;margin-top: 6px; color: #fff;"><span style="font-weight: bold;color: #fff;font-size: 18px;">19o C</span> - {{ CTrans::trans('pages.days.wednesday', $data['lang']) }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="display:inline-block; Margin: 0 -2px; max-width:25%; min-width:180px; vertical-align:top; width:100%;" class="stack-column">
                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 0px 10px;">
                                <table cellspacing="0" cellpadding="0" border="0" width="100%" style="font-size: 14px;text-align: left;">
                                    <tr>
                                        <td>
                                            <img src="{{ asset('storage/image/email-24hours-24horas04.svg') }}" width="200" alt="" style="transform: translateX(25px);border: 0;width: 100px;max-width: 200px;" class="center-on-narrow">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; padding-top: 10px;" class="stack-column-center">
                                            <p style="text-align: center;margin-top: 20px; color: #fff;"><span style="font-weight: bold;color: #fff;font-size: 18px;">17o C</span> - {{ CTrans::trans('pages.days.thursday', $data['lang']) }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="display:inline-block; Margin: 0 -2px; max-width:25%; min-width:180px; vertical-align:top; width:100%;" class="stack-column">
                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="padding: 0px 10px;">
                                <table cellspacing="0" cellpadding="0" border="0" width="100%" style="font-size: 14px;text-align: left;">
                                    <tr>
                                        <td>
                                            <img src="{{ asset('storage/image/email-24hours-24horas05.svg') }}" width="200" alt="" style="transform: translateX(25px);border: 0;width: 100px;max-width: 200px;" class="center-on-narrow">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-family: sans-serif; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #555555; padding-top: 10px;" class="stack-column-center">
                                            <p style="text-align: center;margin-top: 0px; color: #fff;"><span style="font-weight: bold;color: #fff;font-size: 18px;">15o C</span> - {{ CTrans::trans('pages.days.friday', $data['lang']) }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <hr style="width: 72%; margin-bottom: 15px; padding: 0px 40px 0px 40px;background-color: #787878;height: 1px;border: none;">
            </td>
        </tr>
        <tr>
            <td style="padding: 0 20px 10px; text-align: center; background-color: #000;">
                <!-- Button : BEGIN -->
                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: auto;">
                    <tr>
                        <td class="button-td button-td-primary">
                            <div>
                                <a class="button-a button-a-primary" href="#" style="background: #ED9C28; font-size: 21px; font-family: 'rawline', sans-serif; cursor: pointer; font-weight: bold; text-decoration: none; padding: 8px 30px 10px 30px; color: #000; display: block; border-radius: 50px;">
                                    {{ CTrans::trans('pages.24Hours.peticions', $data['lang']) }}
                                </a>
                            </div>
                        </td>
                    </tr>
                </table>
                <hr style="width: 78%; margin-top: 15px; border: none;padding: 0px 40px 0px 40px;height: 1px;background-color: #787878;">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <!-- Column : BEGIN -->
                        <td class="stack-column-center">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td style="padding: 10px; text-align: left; color: #fff;" valign="middle">
                                        <div style="float: left; margin-left: 10px; margin-top: 8px;">
                                            <span style="font-weight: 700; font-size: 19; font-family: 'rawline', sans-serif;">{{ CTrans::trans('pages.24Hours.address', $data['lang']) }}</span>
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
                                    <td style="padding: 10px; text-align: right; color: #fff;" valign="middle">
                                        <div style="float: right; margin-left: 0px;margin-right: 10px; margin-top: 8px;">
                                            <span style="font-weight: 300; font-size: 19; font-family: 'rawline', sans-serif;">{{ CTrans::trans('pages.24Hours.torrijo', $data['lang']) }}, 21</span><br>
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
        <tr>
            <td>
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td valign="middle">
                            <div>
                                <div style="width: 100%"><iframe width="100%" height="450" src="https://maps.google.com/maps?width=100%&height=600&hl=es&coord=Casa de les Punxes, attraction, Barcelona, Spain&q=Casa%20de%20les%20Punxes%2C%20attraction%2C%20Barcelona%2C%20Spain+(Email)&ie=UTF8&t=&z=14&iwloc=B&output=embed"
                                                                 frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- 3 Columns FOOTER : BEGIN -->
        <tr>
            <td valign="top" style="padding: 0px 0px 0px 0px; background-color: #000;">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <!-- Column : BEGIN -->
                        <td width="22.33%" class="stack-column-center">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/image/email-24hours-Footer-Botones.svg') }}" height="230" width="210" style="margin-top: 35px;margin-bottom:-4px">
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
                                        <p style="font-size: 14px; font-family: 'rawline', sans-serif; font-weight: 600;">{{ CTrans::trans('pages.footer.contactUs', $data['lang']) }}</p>
                                        <div style="padding-bottom: 20px;">
                                            <img src="{{ asset('storage/image/email-24hours-Footer-Correos.svg') }}" width="15" style="float: left;padding:0px 10px 0px 5px;"> <span style="font-size: 13px;">+34 93 281 29 05</span>
                                        </div>
                                        <div>
                                            <img src="{{ asset('storage/image/email-24hours-Footer-Teléfono.svg') }}" width="20" style="float:left;padding: 5px 10px 0px 3px;"> <span style="font-size: 13px; font-family: 'rawline', sans-serif;">welcome@castroexclusiveresidences.com</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #fff;padding-top: 10px;">
                                        <div style="margin: 0;">
                                            <div style="margin-right:10px;float: left;font-size: 14px; font-family: 'rawline', sans-serif; font-weight: 600; margin-top: 5px; padding-right:10px;">
                                                <div style="padding-bottom: 10px;">{{ CTrans::trans('pages.footer.followUs', $data['lang']) }}</div>
                                                <img src="{{ asset('storage/image/email-24hours-Footer-Instagram.svg') }}" width="20" style="float: left;padding: 4px 10px 0px 3px;"><a href="#" style="font-size: 13px; font-family: 'rawline', sans-serif; font-weight: 400; color: #FFF; text-decoration: none;">@castroexclusiveresidences</span>
                                            </div>
                                            <div style="float: left;text-align: left; padding: 5px 0px 10px 20px;border-left: 1px solid #787878;">
                                                <span style="font-size: 14px; font-family: 'rawline', sans-serif; font-weight: 600;">{{ CTrans::trans('pages.footer.downloadApp', $data['lang']) }}</span> <br>
                                                <a href="#"><img src="{{ asset('storage/image/email-24hours-Footer-BannerGooglePlay.svg') }}" width="80" style="padding-top: 5px;"></a>
                                                <a href="#"><img src="{{ asset('storage/image/email-24hours-Footer-banner app store.svg') }}" width="70" style="padding-top: 5px;"></a>
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
                                            <img src="{{ asset('storage/image/email-24hours-Footer-Instagram.svg') }}" width="20" style="float: left;">
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
                                        <p style="margin: 0;">{{ CTrans::trans('pages.footer.copyright', $data['lang']) }}</p>
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
                                        <a href="#"><img src="{{ asset('storage/image/email-24hours-Footer-LogoCastro.svg') }}" width="130" height="170" alt="logo-castro" border="0" class="fluid" style="height: auto;"></a>
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