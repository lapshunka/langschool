<x-mail::message>
# Здравствуйте, {{ $booking->user->name }}!

Ваша заявка на курс «{{ $booking->course->title }}» успешно принята.
Мы свяжемся с вами по указанному номеру телефона: {{ $booking->phone }}.

<x-mail::button :url="route('profile')">
Мои заявки
</x-mail::button>

С уважением,<br>
{{ config('app.name') }}
</x-mail::message>