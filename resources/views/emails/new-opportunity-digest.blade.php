<x-emails.layout :preheader="'Nouvelle opportunité publiée sur COMILOG Local Connect : ' . $opportunity->titre">

<div style="display:inline-block; padding:6px 12px; background:#FEF3C7; color:#B45309; border-radius:20px; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:1.5px; margin-bottom:16px;">
    Digest COMILOG
</div>

<h1 style="margin:0 0 12px 0; font-size:22px; font-weight:700; color:#0A2240; letter-spacing:-0.02em; line-height:1.25;">
    Une nouvelle opportunité vient d'être publiée
</h1>

<p style="margin:0 0 24px 0; font-size:14px; color:#78716C;">
    Bonjour {{ $raisonSociale }},
</p>

<p style="margin:0 0 8px 0; font-size:12px; color:#A8A29E; font-family:monospace;">
    {{ $opportunity->reference }} · {{ \App\Models\Opportunity::TYPES[$opportunity->type] ?? $opportunity->type }}
</p>

<h2 style="margin:0 0 16px 0; font-size:18px; font-weight:600; color:#0A2240; line-height:1.35; letter-spacing:-0.015em;">
    {{ $opportunity->titre }}
</h2>

<div style="margin:0 0 20px 0;">
    @foreach($opportunity->categories as $cat)
        <span style="display:inline-block; padding:4px 10px; background:{{ $cat->color }}1A; color:{{ $cat->color }}; border-radius:12px; font-size:11px; font-weight:600; margin-right:4px; margin-bottom:4px;">{{ $cat->name }}</span>
    @endforeach
</div>

<div style="background:#FAFAF9; border-radius:8px; padding:16px 20px; margin:0 0 24px 0; font-size:13px; color:#57534E; line-height:1.6;">
    Cette opportunité n'est pas directement rattachée aux métiers déclarés par <strong style="color:#0A2240;">{{ $raisonSociale }}</strong>,
    mais elle vous est signalée pour information dans le cadre de la diffusion COMILOG Local Content.
    @if($opportunity->deadline)
        <br><br><strong style="color:#0A2240;">Date limite :</strong> {{ $opportunity->deadline->translatedFormat('d F Y') }}
    @endif
</div>

<table role="presentation" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td style="border-radius:8px; background: linear-gradient(135deg, #D97706 0%, #B45309 100%);">
            <a href="{{ url('/pme/opportunites/' . $opportunity->id) }}" style="display:inline-block; padding:12px 24px; font-size:14px; font-weight:600; color:#ffffff; text-decoration:none; font-family:inherit;">
                Consulter l'opportunité →
            </a>
        </td>
    </tr>
</table>

<p style="margin:32px 0 0 0; font-size:12px; color:#78716C; padding-top:20px; border-top:1px solid #E7E5E4; line-height:1.5;">
    Vous recevez ce mail parce que <strong style="color:#0A2240;">{{ $raisonSociale }}</strong> est active sur la plateforme COMILOG Local Connect.
    Pour recevoir uniquement les opportunités correspondant à vos métiers, mettez à jour vos secteurs depuis votre profil PME.
</p>

</x-emails.layout>
