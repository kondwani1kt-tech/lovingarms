<!DOCTYPE html>
<html>
<body style="margin:0;padding:24px;background:#f8f5fb;font-family:Arial,Helvetica,sans-serif;color:#292333">
<div style="max-width:620px;margin:auto;background:#fff;border:1px solid #e8e1ed;border-radius:14px;overflow:hidden">
    <div style="background:#4b2b68;color:#fff;padding:18px 24px;font-size:18px">♥ Loving Arms Home Care, SPC</div>
    <div style="padding:24px">
        <h2 style="margin:0 0 12px;font-size:19px;color:#4b2b68">{{ $heading }}</h2>
        @if($intro)<p style="margin:0 0 16px">{{ $intro }}</p>@endif
        <table style="width:100%;border-collapse:collapse;font-size:14px">
            @foreach($rows as $label => $value)
                <tr>
                    <td style="padding:8px 10px;border-bottom:1px solid #eee;width:34%;color:#6e6875;vertical-align:top">{{ $label }}</td>
                    <td style="padding:8px 10px;border-bottom:1px solid #eee">{!! nl2br(e((string) $value)) !!}</td>
                </tr>
            @endforeach
        </table>
        @if($link)<p style="margin:22px 0 0"><a href="{{ $link }}" style="background:#4b2b68;color:#fff;padding:10px 18px;border-radius:999px;text-decoration:none;font-size:14px">Open in the staff area</a></p>@endif
    </div>
</div>
</body>
</html>
