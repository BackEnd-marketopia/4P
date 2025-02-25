<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('payment.title') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        .status {
            font-size: 24px;
            font-weight: bold;
        }

        .success {
            color: green;
        }

        .pending {
            color: orange;
        }

        .failed {
            color: red;
        }
    </style>
</head>

<body dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <h1>{{ __('message.payment title') }}</h1>
    <p class="status {{ $status }}">{{ __('message.' . $status) }}</p>
</body>

</html>