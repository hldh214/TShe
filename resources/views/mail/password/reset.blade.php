@component('mail::message')
# Hello~

我们收到了一项请求，要求通过您的电子邮件地址修改您的密码

@component('mail::button', ['url' => url(config('app.url').route('password.reset', $token, false))])
修改密码
@endcomponent

此致,<br>
{{ config('app.name') }}
@endcomponent
