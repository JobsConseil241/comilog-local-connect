<x-emails.layout preheader="Votre PME est désormais active sur COMILOG Local Connect.">

<div style="display:inline-block; padding:6px 12px; background:#ECFDF5; color:#0F5132; border-radius:20px; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:1.5px; margin-bottom:16px;">
    ✓ Compte activé
</div>

<h1 style="margin:0 0 8px 0; font-size:24px; font-weight:700; color:#0A2240; letter-spacing:-0.02em;">
    Votre PME est validée
</h1>
<p style="margin:0 0 24px 0; font-size:14px; color:#78716C;">
    Bonjour {{ $representantNom ?? 'à vous' }},
</p>

<p style="margin:0 0 16px 0; font-size:15px; color:#292524;">
    Bonne nouvelle : <strong style="color:#0A2240;">{{ $raisonSociale }}</strong> est désormais active sur COMILOG Local Connect.
</p>

<p style="margin:0 0 24px 0; font-size:15px; color:#292524;">
    Vous pouvez dès maintenant vous connecter à votre espace pour consulter les opportunités d'affaires, les formations et les actualités SMI ciblées par vos métiers.
</p>

<table role="presentation" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td style="border-radius:8px; background: linear-gradient(135deg, #D97706 0%, #B45309 100%);">
            <a href="{{ url('/login') }}" style="display:inline-block; padding:14px 28px; font-size:15px; font-weight:600; color:#ffffff; text-decoration:none; font-family:inherit;">
                Accéder à mon espace →
            </a>
        </td>
    </tr>
</table>

<p style="margin:32px 0 0 0; font-size:13px; color:#78716C; padding-top:20px; border-top:1px solid #E7E5E4;">
    Un problème pour vous connecter ? Contactez-nous à
    <a href="mailto:contact@jobs-conseil.host" style="color:#B45309; text-decoration:none;">contact@jobs-conseil.host</a>.
</p>

</x-emails.layout>
