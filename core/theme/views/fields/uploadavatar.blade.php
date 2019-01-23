<div data-avatar class="form-group {{ $group ?? $group_class ?? 'mb-0' }}">
  <div class="avatar-upload">
    <div class="avatar-edit">
      <input id="avatar-{{ $name ?? 'avatar' }}-{{ $v = date('Hs') }}" type="file" name="{{ $name ?? 'avatar' }}" data-avatar-upload accept="image/*">
      <label for="avatar-{{ $name ?? 'avatar' }}-{{ $v }}" class="avatar-upload-icon">
        <i class="icon mdi mdi-upload"></i>
      </label>
    </div>
    <div class="avatar-preview">
      <div data-avatar-preview>
      </div>
    </div>
  </div>
</div>
