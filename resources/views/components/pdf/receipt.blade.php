<html lang="en">
<head>
    <title>Receipt</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>  
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <x-application-logo />
        <h1 class="font-bold my-3 text-3xl text-primary">{{__('Receipt')}}</h1>
        <div class="flex justify-between">
            <div class="w-1/2">
                <x-pdf.components.title>{{__('Customer details')}}</x-pdf.components.title>
                <x-pdf.components.paragraph><strong>{{__('Name:')}}</strong> {{ $customer['name'] }}</x-pdf.components.paragraph>
                <x-pdf.components.paragraph><strong>{{__('Email:')}}</strong> {{ $customer['email'] }}</x-pdf.components.paragraph>
            </div>
            <div class="w-1/2">
                <x-pdf.components.title>{{__('Payment Details')}}</x-pdf.components.title>
                <x-pdf.components.paragraph><strong>{{__('Date:')}}</strong> {{ $receipt['date'] }}</x-pdf.components.paragraph>
                <x-pdf.components.paragraph><strong>{{__('Card: ')}}</strong>**** **** **** {{ $receipt['card']['last4'] }}</x-pdf.components.paragraph>
            </div>
        </div>
        <table class="table mt-5">
            <thead class="text-left">
                <tr class="border-b border-b-secondaryDark">
                    <th class="font-medium mb-3 text-lg">{{__('Item')}}</th>
                    <th class="font-medium mb-3 text-lg">{{__('Price')}}</th>
                </tr>
            </thead>
            <tbody class="text-left">
                <tr class="border-b border-b-secondaryDark">
                    <td class="text-secondary">{{ $course['name'] }}</td>
                    <td class="text-secondary">$ {{ $course['price'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
