@component('mail::message')
# Verify Email

Your order has been shipped

@component('mail::panel')
Oh yeah!!
@endcomponent
@component('mail::button', ['url' => 'ad'])
View Order
@endcomponent

@component('mail::table')
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
@endcomponent

@endcomponent
