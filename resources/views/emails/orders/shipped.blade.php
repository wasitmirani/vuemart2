@component('mail::message')
# {{$maildata['title']}}

<h2>{{$maildata['title']}}</h2>
<br>
<hr>
<h2>Customer Info</h2>
<br>
<h3>{{$maildata['subject']}}</h3><br>
<span><strong>Name:</strong> {{$maildata['name']}} </span><br>
<span><strong>Phone:</strong> {{$maildata['phone']}} </span><br>
<span><strong>Address:</strong> {{$maildata['address']}} </span><br>
<span><strong>SubTotal:</strong> {{$maildata['total_unitprice']}} </span><br>
<span><strong>Discount:</strong> {{$maildata['total_discount']}} </span><br>
<span><strong>Total:</strong> {{$maildata['total']}} </span><br>

@component('mail::button', ['url' =>  $maildata['url']])
 View Order
 @endcomponent

 <a herf="{{ $maildata['message_url'] }}">{{ $maildata['message_url'] }}</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
