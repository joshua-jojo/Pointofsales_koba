<!DOCTYPE html>
<html data-theme="winter">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    @routes
    @inertiaHead
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body>
    <div id="modal_stage"></div>
    @inertia
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/eac4eeb2c0.js" crossorigin="anonymous"></script>
</body>

</html>