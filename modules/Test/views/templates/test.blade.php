{{--
Template Name: Generic Form Template
Type: Form
Description: The default home template displaying the title, body, and featured image of the page.
Author: John Lioneil Dionisio
Version: 1.0
--}}

<form action="{{ $form->action ?? route('tests.store') }}" method="POST">
    {{ csrf_field() }}
    <p>{{ $form->title }}</p>
    {!! $form->body !!}

    @foreach ($fields->items() as $name => $field)
        <p>{!! $fields->template($name, 'template')->render() !!}</p>
    @endforeach

    <v-btn primary type="submit">{{ 'Submit' }}</v-btn>
</form>

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    resource: {
                        item: {!! json_encode(old()) !!},
                    },
                    errors: {!! json_encode($errors->getMessages()) !!},
                }
            }
        })
    </script>
@endpush

{{-- {{ dd( $fields->template('12qw', 'template')->render() ) }} --}}
