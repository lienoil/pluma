<form action="{{ route('password.change', $resource->id) }}" method="POST">
    {{ csrf_field() }}
    <v-card class="mb-3 elevation-1">
        <v-toolbar card class="transparent">
            <v-toolbar-title class="accent--text">{{ __('Change Password') }}</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            <v-text-field
                :error-messages="resource.errors.old_password"
                label="{{ _('Old Password') }}"
                type="password"
                name="old_password"
                value="{{ old('old_password') }}"
                prepend-icon="fa-key"
                input-group
            ></v-text-field>
            <v-text-field
                :error-messages="resource.errors.password"
                label="{{ _('Password') }}"
                type="password"
                name="password"
                value="{{ old('password') }}"
                prepend-icon="lock"
                input-group
            ></v-text-field>
            <v-text-field
                :error-messages="resource.errors.password"
                label="{{ _('Password Confirmation') }}"
                type="password"
                name="password_confirmation"
                value="{{ old('password_confirmation') }}"
                prepend-icon="lock_open"
                input-group
            ></v-text-field>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn type="submit" primary class="elevation-1">{{ __('Change Password') }}</v-btn>
        </v-card-actions>
    </v-card>
</form>
