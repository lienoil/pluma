@extends('Theme::layouts.admin')

@section('head:title', __('Add User'))
@section('main:title', '')

@section('page:content')
  <div class="container-fluid">
    <form action="{{ route('users.store') }}" method="POST">
      @csrf
      <div data-sticky="#page-header"></div>
      <nav id="page-header" data-sticky-class="sticky bg-workspace shadow-sm" class="navbar row px-3">
        <h1 class="page-title">{{ __('Add User') }}</h1>
        <button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save">&nbsp;</i>{{ __('Save') }}</button>
      </nav>

      <div class="row">
        @section('user.main')
          <div class="col-lg col-sm-12">
            <div class="mb-7">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <h6 class="form-label text-uppercase text-muted mb-4">{{ __('Account') }}</h1>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg col-sm-12">
                      @field('input', [
                        'label' => __('First name'),
                        'icon' => 'mdi mdi-account-outline',
                        'name' => 'firstname',
                      ])
                    </div>

                    <div class="col-lg col-sm-12">
                      @field('input', [
                        'label' => __('Middle name'),
                        'name' => 'middlename',
                      ])
                    </div>

                    <div class="col-lg col-sm-12">
                      @field('input', [
                        'label' => __('Last name'),
                        'name' => 'lastname',
                      ])
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg col-sm-12">
                      @field('input', [
                        'label' => __('Email'),
                        'type' => 'email',
                        'name' => 'email',
                      ])
                    </div>
                    <div class="col-lg col-sm-12">
                      @field('input', [
                        'label' => __('Username'),
                        'name' => 'username',
                      ])
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg col-sm-12">
                      @field('input', [
                        'label' => __('Password'),
                        'type' => 'password',
                        'name' => 'password',
                      ])
                    </div>
                    <div class="col-lg col-sm-12">
                      @field('input', [
                        'label' => __('Retype Password'),
                        'type' => 'password',
                        'name' => 'password_confirmation',
                      ])
                    </div>
                  </div>

                </div>

                <div class="card-body py-0 border-0">
                  <div class="row">
                    <div class="col-lg-12">
                      <h6 class="form-label text-uppercase text-muted">{{ __('Additional Background Details') }}</h6>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-12">
                      <table class="table table-no-border" data-dynamic-container>
                        <tbody>
                          <tr>
                            <td>
                              <div class="form-group mb-0">
                                <div class="input-icon">
                                  <span class="input-icon-addon">
                                    <i class="mdi mdi-cellphone-android"></i>
                                  </span>
                                  <input type="text" readonly name="details[phone][key]" class="form-control" value="Mobile Phone" placeholder="{{ __('Key') }}">
                                  <input type="hidden" name="details[phone][icon]" value="mdi mdi-cellphone-android">
                                </div>
                              </div>
                            </td>
                            <td colspan="3">
                              <div class="form-group mb-0">
                                <input type="text" name="details[phone][value]" class="form-control" value="{{ old('details.phone.value') }}" placeholder="+## ### #######" autocomplete="off" maxlength="19">
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group mb-0">
                                <div class="input-icon">
                                  <span class="input-icon-addon">
                                    <i class="mdi mdi-cake"></i>
                                  </span>
                                  <input type="text" readonly name="details[birthday][key]" class="form-control" value="Birthday" placeholder="{{ __('Key') }}">
                                  <input type="hidden" name="details[birthday][icon]" value="mdi mdi-cake">
                                </div>
                              </div>
                            </td>
                            <td colspan="3">
                              <div class="form-group mb-0">
                                <input type="text" name="details[birthday][value]" class="form-control" data-mask="99/99/9999" data-mask-clearifnotmatch="true" placeholder="MM/DD/YYYY" autocomplete="off" maxlength="10" value="{{ old('details.birthday.value') }}">
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="form-group mb-0">
                                <div class="input-icon">
                                  <span class="input-icon-addon">
                                    <i class="mdi mdi-map-marker"></i>
                                  </span>
                                  <input type="text" readonly name="details[address][key]" class="form-control" value="Home Address" placeholder="{{ __('Key') }}">
                                  <input type="hidden" name="details[address][icon]" value="mdi mdi-map-marker">
                                </div>
                              </div>
                            </td>
                            <td colspan="3">
                              <div class="form-group mb-0">
                                <textarea name="details[address][value]" cols="30" rows="1" class="form-control">{{ old('details.address.value') }}</textarea>
                              </div>
                            </td>
                          </tr>

                          {{-- Old value --}}
                          {{-- {{ dd(old('details')) }} --}}
                          @if (old('details'))
                            @foreach (collect(old('details'))->except(['address', 'phone', 'birthday']) as $i => $detail)
                              <tr data-dynamic-item data-dynamic-item-number="{{ $i }}">
                                <td>
                                  @include('Theme::fields.selecticons', [
                                    'name' => 'details['.$i.'][icon]',
                                    'value' => $detail['icon'] ?? '',
                                    'attr' => 'data-selectpicker data-live-search="true"',
                                  ])
                                </td>
                                <td>
                                  <div class="form-group mb-0">
                                    <input type="text" name="details[{{ $i }}][key]" class="form-control" value="{{ $detail['key'] ?? '' }}" placeholder="{{ __('Key') }}">
                                  </div>
                                </td>
                                <td>
                                  <div class="form-group mb-0">
                                    <input type="text" name="details[{{ $i }}][value]" class="form-control" value="{{ $detail['value'] ?? '' }}" autocomplete="off" placeholder="{{ __('Value') }}">
                                  </div>
                                </td>
                                <td class="justify-content-end d-flex">
                                  <div class="w-100"></div>
                                  <button class="btn btn-secondary" type="button" data-dynamic-remove-button><i class="mdi mdi-close"></i></button>
                                </td>
                              </tr>
                            @endforeach
                          @endif
                          {{-- Old value --}}

                          {{-- Dynamic Template --}}
                          <tr data-dynamic-item-template>
                            <td>
                              @include('Theme::fields.selecticons', [
                                'name' => 'details[#][icon]',
                                'attr' => 'disabled data-live-search="true"',
                              ])
                            </td>
                            <td>
                              <div class="form-group mb-0">
                                <input disabled type="text" data-name="details[#][key]" class="form-control" value="" placeholder="{{ __('Key') }}">
                              </div>
                            </td>
                            <td>
                              <div class="form-group mb-0">
                                <input disabled type="text" data-name="details[#][value]" class="form-control" value="" autocomplete="off" placeholder="{{ __('Value') }}">
                              </div>
                            </td>
                            <td class="d-flex justify-content-end">
                              <button class="btn btn-secondary" type="button" data-dynamic-remove-button><i class="mdi mdi-close"></i></button>
                            </td>
                          </tr>
                          {{-- Dynamic Template --}}

                          <tr data-dynamic-after-items>
                            <td colspan="4">
                              <button data-dynamic-add-button type="button" class="btn btn-secondary btn-sm">{{ __('Add Field') }}</button>
                            </td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>

        @show

        @section('user.sidebar')
          <div class="col-lg-3 col-sm-12">
            <div class="row">
              <div class="col-sm-12 order-lg-2 order-1">
                @section('user.avatar')
                  <div class="card mb-3">
                    <div class="card-body">
                      @field('selectavatars', [
                        'title' => __('Select Avatar'),
                        'name' => 'avatar',
                        'attr' => 'data-selectpicker data-live-search=true',
                        'value' => old('avatar'),
                      ])
                    </div>
                  </div>
                @show
              </div>
            </div>

            @section('user.sidemenu')
              <div class="card">
                <div class="card-body">
                  @field('select', [
                    'label' => __('Roles'),
                    'name' => 'roles[]',
                    'field' => 'roles',
                    'attr' => 'data-selectpicker',
                    'old' => old('roles'),
                    'items' => $roles,
                    'text' => 'name',
                    'key' => 'id',
                  ])
                </div>
              </div>
            @show
          </div>
        @show
      </div>
    </form>
  </div>
@endsection
