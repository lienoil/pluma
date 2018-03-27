@extends("Theme::layouts.admin")

@section("main")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm12>
                <v-card class="mb-3">
                    <v-card-text class="grey--text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, omnis iure magni veritatis illum tempore aliquid repudiandae. Obcaecati ipsam alias error, distinctio repellat perspiciatis perferendis, voluptatum tempora, odit iusto natus.</p>
                    </v-card-text>
                </v-card>
                <chatbox></chatbox>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push("pre-foot")
    {{-- <script src="https://cdn.socket.io/socket.io-1.3.5.js"></script> --}}
    {{-- <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            encrypted: true
        });
        var channel = pusher.subscribe('test_channel');
  </script> --}}
@endpush
