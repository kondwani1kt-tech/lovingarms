<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{!! e($subjectLine) !!}</title>
</head>
<body style="margin:0;padding:24px;background:#f8f5fb;font-family:Arial,Helvetica,sans-serif;color:#292333">
<div style="max-width:620px;margin:auto;background:#fff;border:1px solid #e8e1ed;border-radius:14px;overflow:hidden">
    <div style="background:#4b2b68;color:#fff;padding:18px 24px;font-size:18px">♥ {!! e(config('loving.company')) !!}</div>
    <div style="padding:24px">
        <h2 style="margin:0 0 12px;font-size:20px;color:#4b2b68">Hello {!! e($name) !!},</h2>
        <p style="margin:0 0 18px;font-size:15px;line-height:1.5">{!! nl2br(e($intro)) !!}</p>
        <div style="margin:0 0 20px;padding:14px 16px;background:#f6f2fa;border-radius:10px;font-size:14px;line-height:1.5">
            @foreach($lines as $label => $value)
                <p style="margin:0 0 8px">
                    @if(is_string($label))
                        <strong style="color:#4b2b68">{!! e($label) !!}:</strong>
                    @endif
                    {!! nl2br(e((string) $value)) !!}
                </p>
            @endforeach
        </div>
        @if($link)<p style="margin:0 0 18px"><a href="{!! e($link) !!}" style="background:#4b2b68;color:#fff;padding:10px 18px;border-radius:999px;text-decoration:none;font-size:14px">View details</a></p>@endif
        <p style="margin:0;font-size:14px;line-height:1.5">If you need to reach us, call <a href="tel:{!! e(config('loving.phone_digits')) !!}" style="color:#4b2b68">{!! e(config('loving.phone')) !!}</a> or email <a href="mailto:{!! e(config('loving.email')) !!}" style="color:#4b2b68">{!! e(config('loving.email')) !!}</a>.</p>
    </div>
    <div style="background:#f1ecf6;padding:14px 24px;font-size:12px;color:#6e6875">{!! e(config('loving.company')) !!} · {!! e(config('loving.service_area')) !!}</div>
</div>
</body>
</html>
