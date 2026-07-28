@props(['preheader' => null])
<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>{{ config('app.name') }}</title>
    <!--[if mso]>
    <style>* { font-family: Arial, sans-serif !important; }</style>
    <![endif]-->
</head>
<body style="margin:0; padding:0; background:#FAFAF9; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif; color:#292524; line-height:1.55;">

@if($preheader)
    <div style="display:none; overflow:hidden; line-height:1px; opacity:0; max-height:0; max-width:0;">
        {{ $preheader }}
    </div>
@endif

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#FAFAF9;">
    <tr>
        <td align="center" style="padding: 32px 16px;">

            {{-- CARD --}}
            <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px; width:100%; background:#ffffff; border-radius:16px; overflow:hidden; box-shadow: 0 4px 8px -2px rgba(12,10,9,0.08), 0 2px 4px -1px rgba(12,10,9,0.04);">

                {{-- HEADER BAND --}}
                <tr>
                    <td style="background: linear-gradient(135deg, #0A2240 0%, #1B3358 50%, #0F5132 100%); padding: 24px 32px;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td style="vertical-align: middle;">
                                    <img src="{{ url('/images/comilog-logo.png') }}" alt="COMILOG" width="120" style="height:auto; display:block; background:#fff; padding:6px 8px; border-radius:6px;">
                                </td>
                                <td align="right" style="vertical-align: middle; color:#FBBF24; font-size:11px; letter-spacing:2.5px; text-transform:uppercase; font-weight:600;">
                                    Local Connect
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- BODY --}}
                <tr>
                    <td style="padding: 40px 32px 32px 32px;">
                        {{ $slot }}
                    </td>
                </tr>

                {{-- FOOTER --}}
                <tr>
                    <td style="padding: 24px 32px 32px 32px; border-top: 1px solid #E7E5E4; background:#FAFAF9;">
                        <p style="margin:0 0 8px 0; font-size:12px; color:#78716C; line-height:1.5;">
                            <strong style="color:#0A2240;">COMILOG Local Connect</strong> &mdash; la plateforme dédiée aux PME Local Content gabonaises.
                        </p>
                        <p style="margin:0; font-size:11px; color:#A8A29E;">
                            © {{ date('Y') }} COMILOG · Groupe ERAMET. Cet email a été envoyé automatiquement, merci de ne pas y répondre directement.
                        </p>
                    </td>
                </tr>

            </table>

            {{-- BELOW-CARD LINK --}}
            <p style="margin:16px 0 0 0; font-size:11px; color:#A8A29E;">
                <a href="{{ url('/') }}" style="color:#B45309; text-decoration:none;">{{ parse_url(config('app.url'), PHP_URL_HOST) }}</a>
            </p>
        </td>
    </tr>
</table>

</body>
</html>
