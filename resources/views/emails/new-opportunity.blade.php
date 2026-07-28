<x-emails.layout :preheader="'Nouvelle opportunité pour ' . $raisonSociale . ' : ' . $opportunity->titre">

<div style="display:inline-block; padding:6px 12px; background:#FEF3C7; color:#B45309; border-radius:20px; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:1.5px; margin-bottom:16px;">
    Nouvelle opportunité
</div>

<h1 style="margin:0 0 8px 0; font-size:22px; font-weight:700; color:#0A2240; letter-spacing:-0.02em; line-height:1.25;">
    {{ $opportunity->titre }}
</h1>

<p style="margin:0 0 24px 0; font-size:12px; color:#A8A29E; font-family:monospace;">
    {{ $opportunity->reference }} · {{ \App\Models\Opportunity::TYPES[$opportunity->type] ?? $opportunity->type }}
</p>

<div style="margin:0 0 20px 0;">
    @foreach($opportunity->categories as $cat)
        <span style="display:inline-block; padding:4px 10px; background:{{ $cat->color }}1A; color:{{ $cat->color }}; border-radius:12px; font-size:11px; font-weight:600; margin-right:4px; margin-bottom:4px;">{{ $cat->name }}</span>
    @endforeach
</div>

<p style="margin:0 0 24px 0; font-size:14px; color:#292524; line-height:1.6; white-space:pre-line;">{{ \Illuminate\Support\Str::limit(strip_tags($opportunity->description), 280) }}</p>

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#FAFAF9; border-radius:8px; margin:0 0 24px 0;">
    <tr>
        <td style="padding:16px 20px;">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="font-size:13px; color:#292524;">
                @if($opportunity->deadline)
                <tr>
                    <td style="padding:4px 0; color:#78716C; width:120px;">Date limite</td>
                    <td style="padding:4px 0; color:#0A2240; font-weight:600;">{{ $opportunity->deadline->translatedFormat('d F Y') }}</td>
                </tr>
                @endif
                @if($opportunity->budget_estime)
                <tr>
                    <td style="padding:4px 0; color:#78716C;">Budget estimé</td>
                    <td style="padding:4px 0; color:#0A2240; font-weight:600;">{{ $opportunity->budget_estime }}</td>
                </tr>
                @endif
                @if($opportunity->lieu_execution)
                <tr>
                    <td style="padding:4px 0; color:#78716C;">Lieu</td>
                    <td style="padding:4px 0; color:#0A2240; font-weight:600;">{{ $opportunity->lieu_execution }}</td>
                </tr>
                @endif
            </table>
        </td>
    </tr>
</table>

<table role="presentation" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td style="border-radius:8px; background: linear-gradient(135deg, #D97706 0%, #B45309 100%);">
            <a href="{{ url('/pme/opportunites/' . $opportunity->id) }}" style="display:inline-block; padding:14px 28px; font-size:15px; font-weight:600; color:#ffffff; text-decoration:none; font-family:inherit;">
                Voir l'opportunité →
            </a>
        </td>
    </tr>
</table>

<p style="margin:32px 0 0 0; font-size:12px; color:#78716C; padding-top:20px; border-top:1px solid #E7E5E4; line-height:1.5;">
    Vous recevez cet email car <strong style="color:#0A2240;">{{ $raisonSociale }}</strong> est active sur COMILOG Local Connect et exerce dans au moins un des métiers concernés par cette opportunité.
</p>

</x-emails.layout>
