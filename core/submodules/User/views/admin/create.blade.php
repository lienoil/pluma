@extends('Theme::layouts.admin')

@section('page-title', '')

@section('page-content')
  <div class="container-fluid">
    <form action="{{ route('users.store') }}" method="POST">
      {{ csrf_field() }}
      <div class="row mb-6">
        <div class="col">
          <h1 class="page-title">Create User</h1>
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-primary btn-lg">{{ __('Save') }}</button>
        </div>
      </div>

      <div class="row">

        @section('user.sidebar')
          <div class="col-lg-auto col-sm-12">
            @section('user.avatar')
              <div class="card">
                <div class="card-body">
                  <img role="button" data-avatar-img class="avatar-fit rounded-circle mb-4" width="150px" height="150px" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7">
                  <button class="btn btn-secondary btn-block"><i class="fe fe-upload"></i> {{ __('Upload') }}</button>
                </div>
              </div>
            @show

            @section('user.sidemenu')
            @show
          </div>
        @show

        @section('user.main')
          <div class="col-lg col-sm-12">
            <div class="mb-7">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg col-sm-12">
                      <div class="form-group mb-5">
                        <label class="form-label" for="firstname">{{ __('First name') }}</label>
                        <div class="input-icon">
                          <span class="input-icon-addon">
                            <i class="fe fe-user"></i>
                          </span>
                          <input id="firstname" type="text" name="firstname" class="form-control" aria-describedby="firstname" value="{{ old('firstname') }}">
                        </div>
                      </div>
                    </div>

                    <div class="col-lg col-sm-12">
                      <div class="form-group mb-5">
                        <label class="form-label" for="middlename">{{ __('Middle name') }}</label>
                        <input id="middlename" type="text" name="middlename" class="form-control" aria-describedby="middlename" value="{{ old('middlename') }}">
                      </div>
                    </div>

                    <div class="col-lg col-sm-12">
                      <div class="form-group mb-5">
                        <label class="form-label" for="lastname">{{ __('Last name') }}</label>
                        <input id="lastname" type="text" name="lastname" class="form-control" aria-describedby="lastname" value="{{ old('lastname') }}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-12">
                      <h1 class="form-label mb-4">{{ __('Account') }}</h1>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg col-sm-12">
                      <div class="form-group mb-5">
                        <label class="form-label" for="roles[]">{{ __('Roles') }}</label>
                        <select id="roles" data-selectpicker type="text" name="roles[]" class="form-control" aria-describedby="role[]">
                          @foreach ($resources->roles() as $role)
                            <option value="{{ $role->id }}" data-icon="{{ $role->icon }}">{{ $role->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg col-sm-12">
                      <div class="form-group mb-5">
                        <label class="form-label" for="email">{{ __('Email') }}</label>
                        <div class="input-icon">
                          <span class="input-icon-addon">
                            <i class="fe fe-mail"></i>
                          </span>
                          <input id="email" type="email" name="email" class="form-control" aria-describedby="email" value="{{ old('email') }}">
                        </div>
                      </div>
                    </div>
                    <div class="col-lg col-sm-12">
                      <div class="form-group mb-5">
                        <label class="form-label" for="username">{{ __('Username') }}</label>
                        <input id="username" type="text" name="username" class="form-control" aria-describedby="username" value="{{ old('username') }}">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg col-sm-12">
                      <div class="form-group mb-5">
                        <label class="form-label" for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" class="form-control" aria-describedby="password" value="{{ old('password') }}">
                      </div>
                    </div>
                    <div class="col-lg col-sm-12">
                      <div class="form-group mb-5">
                        <label class="form-label" for="password_confirmation">{{ __('Password Confirmation') }}</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" aria-describedby="password_confirmation" value="{{ old('password_confirmation') }}">
                        <div class="feedback text-muted small">{{ __('Retype password') }}</div>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="card-body py-0 border-0">
                  <div class="row">
                    <div class="col-lg-12">
                      <h1 class="form-label mb-4">{{ __('Additional Background Details') }}</h1>
                    </div>
                  </div>
                </div>

                <table class="table" data-dynamic-container>
                  <tbody>
                    <tr>
                      <td class="pl-5">
                        <div class="form-group mb-0">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fe fe-smartphone"></i>
                            </span>
                            <input type="text" readonly name="details[phone][key]" class="form-control" value="Mobile Phone" placeholder="{{ __('Key') }}">
                            <input type="hidden" name="details[phone][icon]" value="fe fe-smartphone">
                          </div>
                        </div>
                      </td>
                      <td colspan="3" class="pr-5">
                        <div class="form-group mb-0">
                          <input type="text" name="details[phone][value]" class="form-control" value="{{ old('detail.phone.value') }}" placeholder="+## ### #######" autocomplete="off" maxlength="19">
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td class="pl-5">
                        <div class="form-group mb-0">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fa fa-birthday-cake"></i>
                            </span>
                            <input type="text" readonly name="details[birthday][key]" class="form-control" value="Birthday" placeholder="{{ __('Key') }}">
                            <input type="hidden" name="details[birthday][icon]" value="fa fa-birthday-cake">
                          </div>
                        </div>
                      </td>
                      <td colspan="3" class="pr-5">
                        <div class="form-group mb-0">
                          <input type="text" name="details[birthday][value]" class="form-control" data-mask="99/99/9999" data-mask-clearifnotmatch="true" placeholder="MM/DD/YYYY" autocomplete="off" maxlength="10">
                        </div>
                      </td>
                    </tr>

                    <tr>
                      <td class="pl-5">
                        <div class="form-group mb-0">
                          <div class="input-icon">
                            <span class="input-icon-addon">
                              <i class="fe fe-map-pin"></i>
                            </span>
                            <input type="text" readonly name="details[address][key]" class="form-control" value="Billing Address" placeholder="{{ __('Key') }}">
                            <input type="hidden" name="details[address][icon]" value="fe fe-map-pin">
                          </div>
                        </div>
                      </td>
                      <td colspan="3" class="pr-5">
                        <div class="form-group mb-0">
                          <textarea name="details[address][value]" cols="30" rows="1" class="form-control"></textarea>
                        </div>
                      </td>
                    </tr>

                    {{-- Old value --}}
                    @if (old('details'))
                      @foreach (collect(old('details'))->except(['address', 'phone', 'birthday']) as $i => $detail)
                        <tr data-dynamic-item data-dynamic-item-number="{{ $i }}">
                          <td class="pl-5">
                            @include('Theme::fields.select-icons', [
                              'name' => 'details['.$i.'][icon]',
                              'value' => $detail['icon'],
                              'attr' => 'data-selectpicker',
                            ])
                          </td>
                          <td>
                            <div class="form-group mb-0">
                              <input type="text" name="details[{{ $i }}][key]" class="form-control" value="{{ $detail['key'] }}" placeholder="{{ __('Key') }}">
                            </div>
                          </td>
                          <td>
                            <div class="form-group mb-0">
                              <input type="text" name="details[{{ $i }}][value]" class="form-control" value="{{ $detail['value'] }}" autocomplete="off" placeholder="{{ __('Value') }}">
                            </div>
                          </td>
                          <td class="pr-5 justify-content-end d-flex">
                            <div class="w-100"></div>
                            <button class="btn btn-secondary" type="button" data-dynamic-remove-button><i class="fe fe-x"></i></button>
                          </td>
                        </tr>
                      @endforeach
                    @endif
                    {{-- Old value --}}

                    {{-- Dynamic Template --}}
                    <tr data-dynamic-item-template data-dynamic-item-number="{{ $i ?? 0 }}">
                      <td class="pl-5">
                        @include('Theme::fields.select-icons')
                      </td>
                      <td>
                        <div class="form-group mb-0">
                          <input type="text" name="details[#][key]" class="form-control" value="{{ old('detail.0.key') }}" placeholder="{{ __('Key') }}">
                        </div>
                      </td>
                      <td>
                        <div class="form-group mb-0">
                          <input type="text" name="details[#][value]" class="form-control" value="{{ old('detail.phone.value') }}" autocomplete="off" placeholder="{{ __('Value') }}">
                        </div>
                      </td>
                      <td class="pr-5 justify-content-end d-flex">
                        <div class="w-100"></div>
                        <button class="btn btn-secondary" type="button" data-dynamic-remove-button><i class="fe fe-x"></i></button>
                      </td>
                    </tr>
                    {{-- Dynamic Template --}}

                    <tr data-dynamic-after-items>
                      <td colspan="4" class="pl-5 pr-5">
                        <button data-dynamic-add-button type="button" class="btn btn-secondary btn-sm">{{ __('Add Field') }}</button>
                      </td>
                    </tr>

                  </tbody>
                </table>

                <footer class="card-footer border-0 d-flex bg-light">
                  <div class="w-100"></div>
                  <button type="submit" class="btn btn-primary btn-lg">{{ __('Save') }}</button>
                </footer>
              </div>
            </div>
          </div>
        @show

      </div>
    </form>
  </div>
@endsection
