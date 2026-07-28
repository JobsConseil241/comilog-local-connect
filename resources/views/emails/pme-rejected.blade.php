<x-emails.layout preheader="Votre demande d'inscription COMILOG Local Connect n'a pas pu être validée.">

<h1 style="margin:0 0 8px 0; font-size:24px; font-weight:700; color:#0A2240; letter-spacing:-0.02em;">
    Votre demande n'a pas été retenue
</h1>
<p style="margin:0 0 24px 0; font-size:14px; color:#78716C;">
    Bonjour {{ $representantNom ?? 'à vous' }},
</p>

<p style="margin:0 0 16px 0; font-size:15px; color:#292524;">
    Après examen de votre dossier d'inscription pour <strong style="color:#0A2240;">{{ $raisonSociale }}</strong>, notre équipe n'a pas pu valider votre demande à ce stade.
</p>

@if($motif)
<div style="background:#FEF2F2; border-left:3px solid #B91C1C; padding:16px 20px; margin:24px 0; border-radius:6px;">
    <p style="margin:0; font-size:11px; color:#B91C1C; text-transform:uppercase; letter-spacing:1.5px; font-weight:600;">Motif</p>
    <p style="margin:6px 0 0 0; font-size:14px; color:#292524; white-space:pre-line;">{{ $motif }}</p>
</div>
@endif

<p style="margin:0 0 16px 0; font-size:15px; color:#292524;">
    Vous pouvez corriger les éléments demandés puis soumettre une nouvelle demande.
    Notre équipe reste à votre disposition pour tout complément d'information.
</p>

<table role="presentation" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td style="border-radius:8px; border:1px solid #0A2240;">
            <a href="{{ url('/inscription') }}" style="display:inline-block; padding:12px 24px; font-size:14px; font-weight:600; color:#0A2240; text-decoration:none; font-family:inherit;">
                Soumettre une nouvelle demande
            </a>
        </td>
    </tr>
</table>

<p style="margin:32px 0 0 0; font-size:13px; color:#78716C; padding-top:20px; border-top:1px solid #E7E5E4;">
    Contact : <a href="mailto:contact@jobs-conseil.host" style="color:#B45309; text-decoration:none;">contact@jobs-conseil.host</a>
</p>

</x-emails.layout>
