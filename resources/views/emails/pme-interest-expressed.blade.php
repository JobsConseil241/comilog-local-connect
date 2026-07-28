<x-emails.layout :preheader="$pme->raison_sociale . ' a manifesté un intérêt sur ' . $opportunity->reference">

<div style="display:inline-block; padding:6px 12px; background:#ECFDF5; color:#0F5132; border-radius:20px; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:1.5px; margin-bottom:16px;">
    Manifestation d'intérêt
</div>

<h1 style="margin:0 0 8px 0; font-size:22px; font-weight:700; color:#0A2240; letter-spacing:-0.02em; line-height:1.25;">
    Une PME souhaite être recontactée
</h1>

<p style="margin:0 0 24px 0; font-size:13px; color:#78716C;">
    À l'attention du service Achats Local Content
</p>

<div style="background:#FAFAF9; border-radius:8px; padding:20px 22px; margin:0 0 20px 0;">
    <div style="font-size:11px; color:#78716C; text-transform:uppercase; letter-spacing:1.5px; font-weight:600; margin-bottom:6px;">PME</div>
    <div style="font-size:16px; font-weight:600; color:#0A2240; margin-bottom:12px;">{{ $pme->raison_sociale }}</div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="font-size:13px; color:#292524;">
        @if($pme->ville)
        <tr>
            <td style="padding:4px 0; color:#78716C; width:130px;">Ville</td>
            <td style="padding:4px 0; color:#0A2240; font-weight:500;">{{ $pme->ville }}</td>
        </tr>
        @endif
        @if($pme->representant_nom)
        <tr>
            <td style="padding:4px 0; color:#78716C;">Représentant</td>
            <td style="padding:4px 0; color:#0A2240; font-weight:500;">{{ $pme->representant_nom }} @if($pme->representant_fonction) <span style="color:#78716C; font-weight:400;">({{ $pme->representant_fonction }})</span>@endif</td>
        </tr>
        @endif
        <tr>
            <td style="padding:4px 0; color:#78716C;">Compte utilisateur</td>
            <td style="padding:4px 0; color:#0A2240; font-weight:500;">{{ $pmeUser->name }}</td>
        </tr>
        <tr>
            <td style="padding:4px 0; color:#78716C;">Email de contact</td>
            <td style="padding:4px 0;"><a href="mailto:{{ $pme->email_contact ?: $pmeUser->email }}" style="color:#B45309; text-decoration:none; font-weight:500;">{{ $pme->email_contact ?: $pmeUser->email }}</a></td>
        </tr>
        @if($pme->telephone)
        <tr>
            <td style="padding:4px 0; color:#78716C;">Téléphone</td>
            <td style="padding:4px 0; color:#0A2240; font-weight:500;">{{ $pme->telephone }}</td>
        </tr>
        @endif
    </table>

    @if($pme->categories->isNotEmpty())
    <div style="margin-top:14px; padding-top:14px; border-top:1px solid #E7E5E4;">
        <div style="font-size:11px; color:#78716C; text-transform:uppercase; letter-spacing:1.5px; font-weight:600; margin-bottom:6px;">Métiers déclarés</div>
        @foreach($pme->categories as $cat)
            <span style="display:inline-block; padding:3px 8px; background:{{ $cat->color }}1A; color:{{ $cat->color }}; border-radius:12px; font-size:11px; font-weight:600; margin-right:3px; margin-bottom:3px;">{{ $cat->name }}</span>
        @endforeach
    </div>
    @endif
</div>

<div style="background:#FFFBEB; border-left:3px solid #B45309; padding:16px 20px; margin:0 0 24px 0; border-radius:6px;">
    <div style="font-size:11px; color:#78716C; text-transform:uppercase; letter-spacing:1.5px; font-weight:600; margin-bottom:6px;">Opportunité concernée</div>
    <div style="font-size:12px; color:#A8A29E; font-family:monospace; margin-bottom:4px;">{{ $opportunity->reference }}</div>
    <div style="font-size:15px; font-weight:600; color:#0A2240; line-height:1.35;">{{ $opportunity->titre }}</div>
    @if($opportunity->deadline)
        <div style="margin-top:6px; font-size:12px; color:#78716C;">Date limite : {{ $opportunity->deadline->translatedFormat('d F Y') }}</div>
    @endif
</div>

<table role="presentation" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td style="border-radius:8px; background: linear-gradient(135deg, #D97706 0%, #B45309 100%);">
            <a href="{{ url('/admin/pmes/' . $pme->id) }}" style="display:inline-block; padding:12px 24px; font-size:14px; font-weight:600; color:#ffffff; text-decoration:none; font-family:inherit;">
                Voir le profil PME →
            </a>
        </td>
    </tr>
</table>

<p style="margin:32px 0 0 0; font-size:12px; color:#78716C; padding-top:20px; border-top:1px solid #E7E5E4; line-height:1.5;">
    L'intérêt exprimé sur la plateforme ne vaut pas candidature — la PME reste à recontacter par les canaux habituels.
</p>

</x-emails.layout>
