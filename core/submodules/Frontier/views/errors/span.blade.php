@if ($errors->has($field))
    <span class="mdl-textfield__error error help-block">{{ $errors->first($field) }}</span>
@endif