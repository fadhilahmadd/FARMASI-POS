@component('mail::message')
{{ __('Anda telah diundang untuk bergabung dengan tim :team!', ['team' => $invitation->team->name]) }}

{{ __('Jika Anda belum memiliki akun, Anda dapat membuatnya dengan mengeklik tombol di bawah ini. Setelah membuat akun, Anda dapat mengeklik tombol penerimaan undangan di email ini untuk menerima undangan tim:') }}

@component('mail::button', ['url' => route('register')])
{{ __('Buat Akun') }}
@endcomponent

{{ __('Jika Anda sudah memiliki akun, Anda dapat menerima undangan ini dengan mengeklik tombol di bawah ini:') }}

@component('mail::button', ['url' => $acceptUrl])
{{ __('Terima Undangan') }}
@endcomponent

{{ __('Jika Anda tidak mengharapkan menerima undangan untuk bergabung dengan tim ini, Anda dapat mengabaikan email ini.') }}
@endcomponent
