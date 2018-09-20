<div class="row justify-content-center">
  <div class="col-lg-10">
    <select name="format" data-selectpicker>
      <optgroup label="{{ __('Can be imported later') }}">
        <option data-icon="text-green fa fa-file-excel" value="csv">{{ __('CSV (.csv)') }}</option>
        <option data-icon="text-green fa fa-file-excel" value="xlsx">{{ __('Microsoft Excel (.xlsx)') }}</option>
        <option data-icon="text-green fa fa-file-excel" value="ods">{{ __('OpenDocument Spreadsheet (.ods)') }}</option>
      </optgroup>
      <optgroup label="{{ __('Presentable') }}">
        <option data-icon="text-red fa fa-file-pdf" value="pdf">{{ __('Portable Document Format (.pdf)') }}</option>
      </optgroup>
    </select>
  </div>
</div>
