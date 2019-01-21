<div class="form-group {{ $group ?? $group_class ?? 'mb-0' }}">
  <div class="avatar-upload">
    <div class="avatar-edit">
      <input id="avatarupload-input" type="file" name="{{ $name ?? 'avatar' }}" data-avatar-upload accept="image/*">
      <label for="avatarupload-input" class="avatar-upload-icon">
        <i class="icon mdi mdi-upload"></i>
      </label>
    </div>
    <div class="avatar-preview">
      <div data-avatar>
      </div>
    </div>
  </div>
</div>
