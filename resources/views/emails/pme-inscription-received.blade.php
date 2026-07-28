<x-emails.layout preheader="Nous avons bien reçu votre demande d'inscription à la plateforme COMILOG Local Connect.">

<h1 style="margin:0 0 8px 0; font-size:24px; font-weight:700; color:#0A2240; letter-spacing:-0.02em;">
    Votre demande a bien été reçue
</h1>
<p style="margin:0 0 24px 0; font-size:14px; color:#78716C;">
    Bonjour {{ $representantNom ?? 'à vous' }},
</p>

<p style="margin:0 0 16px 0; font-size:15px; color:#292524;">
    Nous avons bien enregistré la demande d'inscription de <strong style="color:#0A2240;">{{ $raisonSociale }}</strong> sur la plateforme COMILOG Local Connect.
</p>

<p style="margin:0 0 16px 0; font-size:15px; color:#292524;">
    Nos équipes examinent votre dossier sous <strong style="color:#0A2240;">48h ouvrées</strong>. Vous recevrez un second email dès que votre compte sera activé.
</p>

<div style="background:#FFFBEB; border-left:3px solid #B45309; padding:16px 20px; margin:24px 0; border-radius:6px;">
    <p style="margin:0; font-size:13px; color:#78716C; text-transform:uppercase; letter-spacing:1.5px; font-weight:600;">Récapitulatif</p>
    <p style="margin:6px 0 0 0; font-size:14px; color:#0A2240;">
        <strong>Raison sociale :</strong> {{ $raisonSociale }}<br>
        @if($ville)<strong>Ville :</strong> {{ $ville }}<br>@endif
        @if($email)<strong>Email de connexion :</strong> {{ $email }}<br>@endif
    </p>
</div>

<p style="margin:0 0 24px 0; font-size:14px; color:#78716C;">
    À très vite,<br>
    L'équipe COMILOG Local Connect
</p>

<table role="presentation" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td style="border-radius:8px; background: linear-gradient(135deg, #D97706 0%, #B45309 100%);">
            <a href="{{ url('/') }}" style="display:inline-block; padding:12px 24px; font-size:14px; font-weight:600; color:#ffffff; text-decoration:none; font-family:inherit;">
                Retour à la plateforme
            </a>
        </td>
    </tr>
</table>

</x-emails.layout>
