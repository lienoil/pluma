@extends("Install::layouts.installation")

@push('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
@endpush

@section("content")
    <div class="mdl-layout mdl-js-layout">
        <div class="mdl-cell mdl-cell--8-col mdl-cell--2-offset">
            <header class="header">
                <div class="header-row">
                    <h2 class="display-3">Pluma&trade; | <span class="text-muted">Welcome</span></h2>
                    <p class="lead">Thank you for using <strong>Pluma&trade;</strong> CMS. This page will guide you through the installation process.</p>
                </div>
            </header>

            <main class="content">
                <p>Before getting started, the application needs some information on the database from you. You will need to know the following items before proceeding:</p>

                <ul>
                    <li>Database name (can be non-existent)</li>
                    <li>Hostname</li>
                    <li>User</li>
                    <li>Password</li>
                </ul>

                <p>These must be pre-configured on your <code>.env</code> file. If the database does not exist, the application will try to create one based on the name given in the <code>.env</code> file. Note that the <em>database user</em> must have the appropriate permissions.</p>

                <p>If you don't have the information above, you may have to contact your Web Host to supply them for you.</p>

                <hr>
                <p class="text-muted"><small>If you think there is a mistake, and you've already installed the app, then check if the <code>.install</code> file is on the root of the folder. If it exists, simply delete it. If problem persist, refer to <a href="/soon">documentation</a>.</small></p>

                <hr>
                <a href="{{ route('installation.next') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">Start</a>
                <p><small><em><strong>By clicking the button</strong>, you agree to <strong>Pluma&trade;</strong>'s <a href="#">Terms and Conditions</a>.</em></small></p>
                <hr>

            </main>

            <aside class="footnote mb-3">
                <small>&copy; Pluma&trade; 2017. Licensed under the MIT.</small>
            </aside>


        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
@endpush
