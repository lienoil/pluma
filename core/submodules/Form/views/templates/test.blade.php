{{--
Template Name: Index Template
Type: Form
Description: The default home template displaying the title, body, and featured image of the page.
Author: John Lioneil Dionisio
Version: 1.0
--}}

<v-toolbar dark class="elevation-1 blue">
    <v-toolbar-title>{{ __('Post-evaluation Form') }}</v-toolbar-title>
</v-toolbar>

<v-container fluid grid-list-lg>
    <v-layout row wrap justify-center align-center>
        <v-flex md8 sm10 xs12>
            <form action="" method="POST">

                {{-- start --}}
                @foreach ($form->fields as $name => $field)
                <div class="input-group input-group--text-field">
                    <label for=""> {{ __('Label') }} </label>
                    <div class="input-group__input">
                        <p>{!! $field->template($name)->render() !!}</p>
                    </div>
                    <div class="input-group__details">
                        <div class="input-group__messages"></div>
                    </div>
                </div>
                @endforeach
               {{-- /end --}}

            </form>
        </v-flex>
    </v-layout>
</v-container>




{{-- {{ dd($form, $fields) }} --}}
