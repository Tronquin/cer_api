<!DOCTYPE html>
<html lang="{{ $data['lang'] }}" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

@include('email.emailReservationHeader')
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
    <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: 0 auto;" class="email-container">
        <!-- Email Header : BEGIN -->
        <!-- Hero Image, Flush : BEGIN -->
        <tr>
            <td valign="top" style="text-align: center; background-image: linear-gradient(to top, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.9)), url('{{ asset('storage/image/emails-confirmacionReserva-SPA_Sagrada_Familia.jpg') }}'); background-position: center center !important; background-size: cover !important; height: 270px">
                <!--[if gte mso 9]>
                <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:175px; background-position: center center !important;">
                    <v:fill type="tile" src="https://via.placeholder.com/600x230/222222/666666" color="#222222" />
                    <v:textbox inset="0,0,0,0">
                <![endif]-->
                <div>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td valign="top" style="text-align: center; padding: 10px; font-family: sans-serif; font-size: 15px; font-family: 'rawline', sans-serif;line-height: 20px; color: #ffffff;
    padding-left: 32px;">
                                <p><img src="{{ asset('storage/image/emails-registerUser-Logo_Castro.svg') }}" width="150"></p>
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
            <td style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 1), rgba(0, 0, 0, 1)">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td style="padding: 5px; font-size: 15px; font-family: 'rawline', sans-serif; line-height: 20px; color: #555555;">
                            <h1 style="margin: 0 0 10px; text-align: center; font-size: 27px; font-family: 'rawline', sans-serif; line-height: 30px; color: #fff; font-weight: bold;padding-left: 30px;">{{ trans('emails.emails.confirmacionreserva.title') }}</h1>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 1), rgba(0, 0, 0, 1));">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td class="stack-column-center" valign="top" style="padding-left:15px;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">                              
                                <tr>
                                    <td style="color: #fff;padding-top: 10px;">
                                        <div style="padding: 0px 15px;">
                                            <div style="margin-right:30px;float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 600; margin-top: 5px; padding-right:10px;">
                                                <img src="{{ asset('storage/image/emails-confirmacionReserva-Check_In.svg') }}" width="80" style="float: left;padding: 4px 10px 0px 3px;">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0">                              
                                                    <tr>
                                                        <td style="color: #fff;font-size: 28px;font-family: 'rawline', sans-serif;font-weight: 600;padding-top:10px">
                                                            <span>{{ trans('emails.emails.confirmacionreserva.checkin') }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="color: #fff;font-size: 15px;font-family: 'rawline', sans-serif;font-weight: 400;">
                                                            <span>{{ $data['reserva']['fecha_entrada'] }}</span>
                                                        </td
                                                    </tr>
                                                    <tr>
                                                        <td style="color: #fff;font-size: 15px;font-family: 'rawline', sans-serif;font-weight: 400;">
                                                            <span>{{ $data['reserva']['hora_entrada'] }}</span>
                                                        </td
                                                    </tr>
                                                </table>
                                            </div>
                                            <div style="float: left;text-align: left; padding: 5px 0px 10px 20px;font-size: 30px;font-family: 'rawline', sans-serif;font-weight: 600;">
                                                <img src="{{ asset('storage/image/emails-confirmacionReserva-Check_Out.svg') }}" width="80" style="float: left;padding: 4px 10px 0px 3px;">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0">                              
                                                    <tr>
                                                        <td style="color: #fff;font-size: 28px;font-family: 'rawline', sans-serif;font-weight: 600;padding-top:10px">
                                                            <span>{{ trans('emails.emails.confirmacionreserva.checkout') }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="color: #fff;font-size: 15px;font-family: 'rawline', sans-serif;font-weight: 400;">
                                                            <span>{{ $data['reserva']['fecha_salida'] }}</span>
                                                        </td
                                                    </tr>
                                                    <tr>
                                                        <td style="color: #fff;font-size: 15px;font-family: 'rawline', sans-serif;font-weight: 400;">
                                                            <span>{{ $data['reserva']['hora_salida'] }}</span>
                                                        </td
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 0px 35px; background-color:#000">
            <br>
            </td>
        </tr>
        <tr>
            <td style="padding: 35px; background-color:#000">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td style="background-color: #8E071C;border-top-left-radius:0.2rem;border-bottom-left-radius:0.2rem">
                            <div style="padding:0px 10px 10px 10px;float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 600;">
                                <span style="text-align: left;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: left;font-weight: Light;">{{ trans('emails.emails.confirmacionreserva.localizadorreserva') }}</span>
                            </div>
                        </td>
                        <td style="background-color: #8E071C;border-top-right-radius:0.2rem;border-bottom-right-radius:0.2rem">
                            <div style="padding:0px 10px 10px 10px;float: right;text-align: right; font-size: 30px;font-family: 'rawline', sans-serif;font-weight: 600;">
                                <span style="text-align: right;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: right;font-weight: Light;">{{ $data['reserva']['localizador'] }}</span>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 0px 35px 35px; background-color:#000">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td style="background-color: darkgray;border-top-left-radius:0.2rem;">
                            <div style="padding:5px 10px 10px 10px;float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 400;">
                                <span style="text-align: left;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: left;font-weight: Light;">{{ trans('emails.emails.confirmacionreserva.nombre') }}</span>
                            </div>
                        </td>
                        <td style="background-color: darkgray;border-top-right-radius:0.2rem;">
                            <div style="padding:5px 10px 10px 10px;float: right;text-align: right; font-size: 30px;font-family: 'rawline', sans-serif;font-weight: 800;">
                                <span style="text-align: right;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: right;font-weight: Light;">{{ $data['reserva']['cliente']['nombre'] }} {{ $data['reserva']['cliente']['apellido'] }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: gray;">
                            <div style="padding:5px 10px 10px 10px;float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 400;">
                                <span style="text-align: left;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: left;font-weight: Light;">N° {{ trans('emails.emails.confirmacionreserva.pax') }}</span>
                            </div>
                        </td>
                        <td style="background-color: gray;">
                            <div style="padding:5px 10px 10px 10px;float: right;text-align: right; font-size: 30px;font-family: 'rawline', sans-serif;font-weight: 800;">
                                <span style="text-align: right;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: right;font-weight: Light;">{{ $data['reserva']['adultos'] }} adultos - {{ $data['reserva']['ninos'] }} niños</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: darkgray;">
                            <div style="padding:5px 10px 10px 10px;float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 400;">
                                <span style="text-align: left;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: left;font-weight: Light;">{{ trans('emails.emails.confirmacionreserva.apartamento') }}</span>
                            </div>
                        </td>
                        <td style="background-color: darkgray;">
                            <div style="padding:5px 10px 10px 10px;float: right;text-align: right; font-size: 30px;font-family: 'rawline', sans-serif;font-weight: 800;">
                                <span style="text-align: right;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: right;font-weight: Light;">{{ $data['reserva']['apartamento']['nombre'] }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: gray;">
                            <div style="padding:5px 10px 10px 10px;float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 400;">
                                <span style="text-align: left;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: left;font-weight: Light;">{{ trans('emails.emails.confirmacionreserva.tipodeapartamento') }}</span>
                            </div>
                        </td>
                        <td style="background-color: gray;">
                            <div style="padding:5px 10px 10px 10px;float: right;text-align: right; font-size: 30px;font-family: 'rawline', sans-serif;font-weight: 800;">
                                <span style="text-align: right;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: right;font-weight: Light;">{{ $data['reserva']['tipologia']['componentes']['dormitorios'] }} dormitorios - {{ $data['reserva']['tipologia']['componentes']['lavabos'] }} baños</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: darkgray;">
                            <div style="padding:5px 10px 10px 10px;float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 400;">
                                <span style="text-align: left;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: left;font-weight: Light;">{{ trans('emails.emails.confirmacionreserva.tipoderegimen') }}</span>
                            </div>
                        </td>
                        <td style="background-color: darkgray;">
                            <div style="padding:5px 10px 10px 10px;float: right;text-align: right; font-size: 30px;font-family: 'rawline', sans-serif;font-weight: 800;">
                                <span style="text-align: right;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: right;font-weight: Light;">{{ $data['reserva']['tarifa']['nombre'] }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: gray;">
                            <div style="padding:5px 10px 10px 10px;float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 400;">
                                <span style="text-align: left;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: left;font-weight: Light;">{{ trans('emails.emails.confirmacionreserva.experiencia') }}</span>
                            </div>
                        </td>
                        <td style="background-color: gray;">
                            <div style="padding:5px 10px 10px 10px;float: right;text-align: right; font-size: 30px;font-family: 'rawline', sans-serif;font-weight: 800;">
                                <span style="text-align: right;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: right;font-weight: Light;">{{ $data['reserva']['experiencia']['nombre'] }}</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: darkgray;">
                            <div style="padding:5px 10px 10px 10px;float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 400;">
                                <span style="text-align: left;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: left;font-weight: Light;">{{ trans('emails.emails.confirmacionreserva.portal') }}</span>
                            </div>
                        </td>
                        <td style="background-color: darkgray;">
                            <div style="padding:5px 10px 10px 10px;float: right;text-align: right; font-size: 30px;font-family: 'rawline', sans-serif;font-weight: 800;">
                                <span style="text-align: right;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: right;font-weight: Light;">P-5462568</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: gray;border-bottom-left-radius:0.2rem">
                            <div style="padding:5px 10px 10px 10px;float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 400;">
                                <span style="text-align: left;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: left;font-weight: Light;">{{ trans('emails.emails.confirmacionreserva.politicadecancelacion') }}</span>
                            </div>
                        </td>
                        <td style="background-color: gray;;border-bottom-right-radius:0.2rem">
                            <div style="padding:5px 10px 10px 10px;float: right;text-align: right; font-size: 30px;font-family: 'rawline', sans-serif;font-weight: 800;">
                                <span style="text-align: right;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: right;font-weight: Light;">{{ $data['reserva']['politica_cancelacion']['nombre_cliente'] }}</span>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 0px 0px 15px;background-color:#000">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="60%">
                    <tr>
                        <td style="background-color: #ED9C28;border-top-left-radius:0.2rem;border-radius:2rem">
                            <div style="padding:0px 10px 10px 10px;font-size: 30px;text-align:center; font-family: 'rawline', sans-serif; font-weight: 700;">
                                <span style="text-align: center;color: #151515; font-size: 20px; font-family: 'rawline', sans-serif;font-weight: Light;">{{ trans('emails.emails.confirmacionreserva.queincluyemiexp') }}</span>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 1), rgba(0, 0, 0, 1));">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td class="stack-column-center" valign="top">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">                              
                                <tr>
                                    <td style="color: #fff;padding-top: 10px;">
                                        <div style="padding: 0px 35px;background-color:white">
                                        @for ($i = 0;$i < 2; $i++)
                                            
                                            @if($i === 0)
                                            <div style="float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 600; margin-top: 5px; margin-right: 17px;">
                                                @if($data['reserva']['experiencia']['extras'][$i]['front_image'] === 'http://www.cer-api.test/storage/image')
                                                <img src="{{ asset('storage/image/emails-confirmacionReserva-Acceso_al_spa.jpg') }}" width="255" >
                                                @else
                                                <img src="{{ $data['reserva']['experiencia']['extras'][$i]['front_image'] }}" width="255" >
                                                @endif
                                                <img style="position:absolute;margin:-205px 0px 0px 10px;" src="{{ asset('storage/image/emails-confirmacionReserva-Recommended.svg') }}" width="60" > 
                                            @else
                                            <div style="float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 600; margin-top: 5px;">
                                                @if($data['reserva']['experiencia']['extras'][$i]['front_image'] === 'http://www.cer-api.test/storage/image')
                                                <img src="{{ asset('storage/image/emails-confirmacionReserva-Acceso_al_spa.jpg') }}" width="255" >
                                                @else
                                                <img src="{{ $data['reserva']['experiencia']['extras'][$i]['front_image'] }}" width="255" >
                                                @endif
                                            @endif
                                            <div style="width:180px;margin:-50px 0px 0px 60px;position:absolute;">

                                                @foreach ($data['reserva']['experiencia']['extras'][$i]['fieldTranslations'] as $iso)
                                                    @if($iso['iso'] === 'es')
                                                        @foreach($iso['fields']  as $translation)
                                                        @if($translation['field'] === 'nombre')
                                                        <div style="display: block;margin:0px 0px 0px 75px;float:right;font-size: 10px; font-family: 'rawline', sans-serif; font-weight: 400;">
                                                            {{ $translation['translation']}}  
                                                        </div>
                                                        @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach    
                                                <div style="display: block;margin:0px 0px 0px 75px;float: right;font-size: 10px; font-family: 'rawline', sans-serif; font-weight: 800;">
                                                    {{ $data['reserva']['experiencia']['extras'][$i]['precio']['total'] }}€  
                                                </div>                                        
                                            </div>
                                            </div>
                                        @endfor
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px 35px 25px; background-color:#000">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td style="background-color: gray;border-top-left-radius:0.2rem;">
                            <div style="padding:5px 10px 10px 10px;float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 400;">
                                <span style="text-align: left;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: left;font-weight: Light;">{{ trans('emails.emails.confirmacionreserva.resumendpago') }}</span>
                            </div>
                        </td>
                        <td style="background-color: gray;border-top-right-radius:0.2rem;">
                            <div style="padding:5px 10px 10px 10px;float: right;text-align: right; font-size: 30px;font-family: 'rawline', sans-serif;font-weight: 800;">
                                <span style="text-align: right;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: right;font-weight: Light;"></span>
                            </div>
                        </td>
                    </tr>
                    <!--<tr>
                        <td style="background-color: darkgray;border-bottom:0.1rem solid;border-bottom-color:white">
                            <div style="padding:5px 10px 10px 10px;float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 400;">
                                <span style="text-align: left;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: left;font-weight: Light;">City tax</span>
                            </div>
                        </td>
                        <td style="background-color: darkgray;border-bottom:0.1rem solid;border-bottom-color:white">
                            <div style="padding:5px 10px 10px 10px;float: right;text-align: right; font-size: 30px;font-family: 'rawline', sans-serif;font-weight: 800;">
                                <span style="text-align: right;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: right;font-weight: Light;">14$</span>
                            </div>
                        </td>
                    </tr>-->
                    <tr>
                        <td style="background-color: darkgray;border-bottom:0.1rem solid;border-bottom-color:white">
                            <div style="padding:5px 10px 10px 10px;float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 400;">
                                <span style="text-align: left;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: left;font-weight: Light;">{{ $data['reserva']['experiencia']['nombre'] }}</span>
                            </div>
                        </td>
                        <td style="background-color: darkgray;border-bottom:0.1rem solid;border-bottom-color:white">
                            <div style="padding:5px 10px 10px 10px;float: right;text-align: right; font-size: 30px;font-family: 'rawline', sans-serif;font-weight: 800;">
                                <span style="text-align: right;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: right;font-weight: Light;">{{ $data['reserva']['total_reserva'] - $data['reserva']['total_extras_contratados'] }}</span>
                            </div>
                        </td>
                    </tr> 
                    @if( count($data['reserva']['extras_contratados']) > 0 )
                    <tr >
                        <td style="background-color: darkgray;">
                            <div style="padding:5px 10px 10px 10px;float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 400;">
                                <span style="text-align: left;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: left;font-weight: Light;">{{ trans('emails.emails.confirmacionreserva.serviciosextras') }}</span>
                            </div>
                        </td>
                        <td style="background-color: darkgray;">
                            <div style="padding:5px 10px 10px 10px;float: right;text-align: right; font-size: 30px;font-family: 'rawline', sans-serif;font-weight: 800;">
                                <span style="text-align: right;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: right;font-weight: Light;"></span>
                            </div>
                        </td>
                    </tr>
                    @foreach ($data['reserva']['extras_contratados'] as $extra)
                    <tr >
                        <td style="background-color: darkgray;">
                            <div style="padding:5px 10px 10px 10px;float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 400;">
                            @foreach ($extra['fieldTranslations'] as $iso)
                                @if($iso['iso'] === 'es')
                                    @foreach($iso['fields']  as $translation)
                                    @if($translation['field'] === 'nombre')
                                    <span style="text-align: left;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: left;font-weight: Light;">{{ $translation['translation'] }}</span>
                                    @endif
                                    @endforeach
                                @endif
                            @endforeach
                            </div>
                        </td>
                        <td style="background-color: darkgray;">
                            <div style="padding:5px 10px 10px 10px;float: right;text-align: right; font-size: 30px;font-family: 'rawline', sans-serif;font-weight: 800;">
                                <span style="text-align: right;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: right;font-weight: Light;">{{ $extra['precio']['total'] }}€</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    <tr>
                        <td style="background-color: gray;border-bottom-left-radius:0.2rem">
                            <div style="padding:5px 10px 10px 10px;float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 800;">
                                <span style="text-align: left;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: left;font-weight: Light;">{{ trans('emails.emails.confirmacionreserva.total') }} <span><span style="font-weight: 400;">({{ trans('emails.emails.confirmacionreserva.ivaincluido') }})</span>
                            </div>
                        </td>
                        <td style="background-color: gray;;border-bottom-right-radius:0.2rem">
                            <div style="padding:5px 10px 10px 10px;float: right;text-align: right; font-size: 30px;font-family: 'rawline', sans-serif;font-weight: 800;">
                                <span style="text-align: right;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: right;font-weight: Light;">{{ $data['reserva']['total_reserva'] }} €</span>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color:#000">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="90%">
                    <tr>
                        <td style="background-color: #ED9C28;border-top-left-radius:0.2rem;border-radius:2rem">
                            <div style="padding:5px 10px 10px 10px;font-size: 30px;text-align:center; font-family: 'rawline', sans-serif; font-weight: 700;">
                                <a href=""><span style="text-align: center;color: #151515; font-size: 20px; font-family: 'rawline', sans-serif;font-weight: Light;">{{ trans('emails.emails.confirmacionreserva.checkin') }} {{ trans('emails.emails.confirmacionreserva.online') }}</span></a>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color:#000">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td style="padding: 5px 40px;">
                            <div style="font-size: 20px;text-align:left; font-family: 'rawline', sans-serif; font-weight: 400;">
                                <p style="text-align: left;color: #FFF; font-size: 16px; font-family: 'rawline', sans-serif;font-weight: Light;">{{ trans('emails.emails.confirmacionreserva.descripcion') }}</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="middle" style="text-align: center; padding: 5px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #fff;background-color: #000;">
                <div style="margin: 0;border-top: 1px solid #787878">
                </div>
            </td>
        </tr>
        <tr>
            <td style="background-color:#000">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td style="padding: 10px 40px;">
                            <div style="margin-bottom:-3px;padding:0px 30px 0px 0px; float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 600;">
                                <div style="text-align: left;color: #FFF; font-size: 20px; font-family: 'rawline', sans-serif; text-align: left;font-weight: Bold;">{{ trans('emails.emails.confirmacionreserva.direccion') }}</div>
                            </div>
                            <div style="float: left;font-size: 30px; font-family: 'rawline', sans-serif; font-weight: 400;">
                                <div style="text-align: left;color: #FFF; font-size: 18px; font-family: 'rawline', sans-serif; text-align: left;font-weight: Light;">{{ $data['reserva']['ubicacion']['direccion'] }}</div>
                            </div>
                        </td>
                        <td style="padding: 10px 40px;">
                            <div style="float: right;text-align: right; font-size: 30px;font-family: 'rawline', sans-serif;font-weight: 600;">
                            <a href="#"><span style="text-align: right;color: #ED9C28; font-size: 20px; font-family: 'rawline', sans-serif; text-align: right;font-weight: Light;">{{ trans('emails.emails.confirmacionreserva.ubicarenmapa') }}</span></a>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="middle" style="text-align: center; padding: 10px 40px; font-size: 21px; font-family: 'rawline', sans-serif; line-height: 20px; color: #fff;background-color: #000;">
                <div style="margin: 0;border-top: 1px solid #787878">
                </div>
            </td>
        </tr>

        <!-- Contact Columns : BEGIN -->
        
        <!-- 3 Columns FOOTER : END -->

        <!--[if mso | IE]>
        </td>
        </tr>
        </table>
        <![endif]-->
</center>
</body>
@include('email.emailReservationFooter')


</html>