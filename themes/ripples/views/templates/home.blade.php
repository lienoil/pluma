{{--
Template Name: Home Template
Type: Page
Description: The default home template displaying the title, body, and featured image of the page.
Author: John Lioneil Dionisio
Version: 1.0
--}}


@extends("Theme::layouts.home")

@section("content")
    {{-- banner --}}
    <v-container fluid class="pa-0">
        <div id="banner" class="hidden-sm-and-down">
            {{-- main menu --}}
            <v-card flat class="transparent pb-5">
                <v-toolbar id="home-menu" dark flat class="transparent">
                    <a href="{{ url('/') }}">
                        <v-avatar tile>
                            <img src="{{ $application->site->logo }}" alt="{{ $application->site->title }}">
                        </v-avatar>
                    </a>

                    <v-toolbar-title class="subheading white--text">
                        <div href="{{ url('/') }}">{{ $application->site->title }}</div>
                        <div class="caption">{{ $application->site->tagline }}</div>
                    </v-toolbar-title>

                    <v-spacer></v-spacer>

                    <v-toolbar-items>
                        @include("Template::recursives.main-menu", ['items' => get_navmenus('main-menu')])

                        @if (settings('show_login_at_main_menu', true))
                            <v-btn flat primary href="{{ route('login.show') }}">{{ __(user() ? 'Dashboard' : 'Login') }}</v-btn>
                        @endif
                    </v-toolbar-items>
                </v-toolbar>
            </v-card>
            {{-- /main menu --}}

            {{-- banner-content --}}
            {{-- <div class="overlay" style="background: rgba(0, 0, 0, 0.2); position: absolute; width: 100%; height: 100%; z-index: 0;"></div> --}}
            <v-card flat class="transparent">
                <v-card flat class="transparent threejs-section">
                    <v-container fluid fill-height>
                        <v-layout align-center justify-center>
                            <v-flex md10 xs12>
                                <v-layout row wrap align-center justify-center>
                                    <v-flex sm6 xs12>
                                        <v-card flat class="transparent" data-aos="fade-right">
                                            <v-card-text class="white--text">
                                                <h2 class="page-title display-3"><strong>{{ __('The Rippl3s Effect') }}</strong></h2>
                                                <ul class="page-title headline">
                                                    <li>{{ __('Portable and convenient') }}</li>
                                                    <li>{{ __('System tailored for maximum results') }}</li>
                                                    <li>{{ __('Organised analytics tools to track progress') }}</li>
                                                </ul>
                                            </v-card-text>
                                            <v-card-text>
                                                <h2 class="white--text page-title headline">
                                                    {{ __('Already using Rippl3s? ') }}
                                                </h2>
                                                <v-btn round round outline large class="px-4 elevation-1 white--text" href="{{ route('login.show') }}">Sign in here</v-btn>
                                            </v-card-text>
                                        </v-card>
                                    </v-flex>

                                    <v-flex sm6 xs12>
                                        <v-card flat class="transparent" data-aos="fade-left">
                                            {{-- <img src="{{ assets('frontier/images/placeholder/iso/landing-page.png') }}" alt="" width="100%"> --}}
                                            <img src="{{ assets('frontier/images/placeholder/iso/landing-page.png') }}" alt="" width="100%">
                                        </v-card>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card>
            </v-card>
            {{-- banner-content --}}
        </div>

        <div id="banner-sm" class="hidden-md-and-up">
            {{-- main menu --}}
            <v-card flat class="transparent pb-5">
                <v-toolbar id="home-menu" dark flat class="transparent">
                    <a href="{{ url('/') }}">
                        <v-avatar tile>
                            <img src="{{ $application->site->logo }}" alt="{{ $application->site->title }}">
                        </v-avatar>
                    </a>

                    <v-toolbar-title class="subheading white--text">
                        <div href="{{ url('/') }}">{{ $application->site->title }}</div>
                        <div class="caption">{{ $application->site->tagline }}</div>
                    </v-toolbar-title>

                    <v-spacer></v-spacer>

                    <v-toolbar-items>
                        @include("Template::recursives.main-menu", ['items' => get_navmenus('main-menu')])

                        @if (settings('show_login_at_main_menu', true))
                            <v-btn flat primary href="{{ route('login.show') }}">{{ __(user() ? 'Dashboard' : 'Login') }}</v-btn>
                        @endif
                    </v-toolbar-items>
                </v-toolbar>
            </v-card>
            {{-- /main menu --}}

            {{-- banner-content --}}
            {{-- <div class="overlay" style="background: rgba(0, 0, 0, 0.2); position: absolute; width: 100%; height: 100%; z-index: 0;"></div> --}}
            <v-card flat class="transparent">
                <v-card flat class="transparent">
                    <v-container fluid fill-height>
                        <v-layout align-center justify-center>
                            <v-flex md10 xs12>
                                <v-layout row wrap align-center justify-center>
                                    <v-flex sm6 xs12>
                                        <v-card flat class="transparent" data-aos="fade-right">
                                            <v-card-text class="white--text">
                                                <h2 class="page-title display-3"><strong>{{ __('The Rippl3s Effect') }}</strong></h2>
                                                <ul class="page-title headline">
                                                    <li>{{ __('Portable and convenient') }}</li>
                                                    <li>{{ __('System tailored for maximum results') }}</li>
                                                    <li>{{ __('Organised analytics tools to track progress') }}</li>
                                                </ul>
                                            </v-card-text>
                                            <v-card-text>
                                                <h2 class="white--text page-title headline">
                                                    {{ __('Already using Rippl3s? ') }}
                                                </h2>
                                                <v-btn round round outline large class="px-4 elevation-1 white--text" href="{{ route('login.show') }}">Sign in here</v-btn>
                                            </v-card-text>
                                        </v-card>
                                    </v-flex>

                                    <v-flex sm6 xs12>
                                        <v-card flat class="transparent" data-aos="fade-left">
                                            {{-- <img src="{{ assets('frontier/images/placeholder/iso/landing-page.png') }}" alt="" width="100%"> --}}
                                            <img src="{{ assets('frontier/images/placeholder/iso/landing-page.png') }}" alt="" width="100%">
                                        </v-card>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card>
            </v-card>
            {{-- banner-content --}}
        </div>
    </v-container>
    {{-- /banner --}}

    {{-- divider --}}
    <v-card flat height="100px"></v-card>
    {{-- /divider --}}

    <template id="webdash">
        <div class="white">
            <v-layout row wrap justify-center align-center>
                <v-flex md9 xs12>
                    <v-card flat class="text-xs-center">
                        <v-card-text>
                            <h2 class="page-title display-2 blue-grey--text text--lighten-2"><strong>Explore the Infinite Possibilities</strong></h2>
                            <p class="headline page-title">We create learning paths where you are at the centre of the experience, tailored specifically to suit your needs.</em></p>
                        </v-card-text>
                    </v-card>

                    {{-- divider --}}
                    <v-card flat height="100px"></v-card>
                    {{-- /divider --}}

                    <v-layout row wrap justify-center align-center>
                        <v-flex md7 xs12>
                            <v-card flat data-aos="fade-right">
                                <v-card-text>
                                    <img src="{{ assets('frontier/images/placeholder/iso/webdash.png') }}" width="100%" style="max-width: 500px;">
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex md5 xs12>
                            <v-card flat>
                                <v-card-text>
                                    <v-card-actions class="pa-0">
                                        <v-avatar size="40px" class="elevation-5">
                                            <v-icon class="blue-grey--text">format_color_fill</v-icon>
                                        </v-avatar>
                                        <v-card flat>
                                            <v-card-text>
                                                <h2 class="title page-title">Customizable Profiles</h2>
                                                <p class="subheading page-title grey--text text--darken-1">Build customizable profiles of your account</p>
                                            </v-card-text>
                                        </v-card>
                                    </v-card-actions>

                                    <v-divider></v-divider>

                                    <v-card-actions class="mt-3 pa-0">
                                        <v-avatar size="40px" class="elevation-5">
                                            <v-icon class="blue-grey--text">search</v-icon>
                                        </v-avatar>
                                        <v-card flat>
                                            <v-card-text>
                                                <h2 class="title page-title">Search</h2>
                                                <p class="subheading page-title grey--text text--darken-1">Search and filter amongst all user and courses</p>
                                            </v-card-text>
                                        </v-card>
                                    </v-card-actions>

                                    <v-divider></v-divider>

                                    <v-card-actions class="mt-3 pa-0">
                                        <v-avatar size="40px" class="elevation-5">
                                            <v-icon class="blue-grey--text">account_circle</v-icon>
                                        </v-avatar>
                                        <v-card flat>
                                            <v-card-text>
                                                <h2 class="title page-title">User Profiles</h2>
                                                <p class="subheading page-title grey--text text--darken-1">Manually create your own user profiles</p>
                                            </v-card-text>
                                        </v-card>
                                    </v-card-actions>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-flex>
            </v-layout>
        </div>
    </template>

    {{-- divider --}}
    <v-card flat height="200px"></v-card>
    {{-- /divider --}}

    <template id="why-us">
        <div class="white">
            <v-layout row wrap justify-right align-center justify-space-between>
                <v-flex md5 offset-md1 xs12>
                    <v-card flat>
                        <v-card-text>
                            <h2 class="page-title display-2 blue-grey--text text--lighten-3 pb-4"><strong>Why Rippl3s</strong></h2>
                            <h2 class="title page-title">{{ __('It’s an engaging learning experience right at your fingertips') }}</h2>
                            <p class="subheading page-title">{{ __('Through our focused responsive portal where technology and curriculum work seamlessly together, we deliver convenience on different devices, thus cutting down your learning time and keeping track of your milestones without having to leave the comforts of your home.') }}</p>
                        </v-card-text>
                    </v-card>
                </v-flex>

                <v-flex md6 xs12>
                    <v-card flat data-aos="fade-up">
                        <img src="{{ assets('frontier/images/placeholder/iso/people-hero2@2x.png') }}" width="100%">
                    </v-card>
                </v-flex>
            </v-layout>
        </div>
    </template>

    {{-- divider --}}
    <v-card flat height="200px"></v-card>
    {{-- /divider --}}

    <template id="how-it-works">
        <div class="white">
            <v-layout row wrap justify-left align-center>
                <v-flex md6 xs12 order-sm2 order-md1>
                    <v-card flat class="mb-3" data-aos="fade-up">
                        <img src="{{ assets('frontier/images/placeholder/iso/engagement.png') }}" width="100%">
                    </v-card>
                </v-flex>

                <v-flex md5 offset-md1 xs12 order-sm1 order-md2>
                    <v-card flat>
                        <v-card-text>
                            <h2 class="page-title display-2 blue-grey--text text--lighten-3 pb-4"><strong>How it works</strong></h2>
                            <h2 class="title page-title">Far far away, behind the word mountains</h2>
                            <p class="subheading page-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis deserunt, aut, ratione vitae natus sunt voluptas dolorum.</p>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </div>
    </template>

    {{-- divider --}}
    <v-card flat height="200px"></v-card>
    {{-- /divider --}}

    {{-- full-width gradient --}}
    <div id="full-width">
        <v-card flat class="transparent" height="100px"></v-card>

        <v-layout row wrap justify-center align-center>
            <v-flex md8 xs12>
                <v-card flat class="text-xs-center white--text transparent">
                    <v-card-text>
                        <h2 class="display-2 page-title"><strong>Feedback/Affiliations</strong></h2>
                        <p class="headline page-title">
                            Our goal is to bring personalised and adaptive learning experience to people. Here are some of our learners’ success stories.
                        </p>
                    </v-card-text>
                    <v-card-text data-aos="zoom-in-up">
                        <img src="{{ assets('frontier/images/placeholder/iso/image-table.png') }}" width="300" alt="">
                        <img src="{{ assets('frontier/images/placeholder/iso/img05.png') }}" width="300" alt="">
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>

        <v-card flat class="transparent" height="100px"></v-card>
    </div>
    {{-- /full-width gradient --}}

    {{-- divider --}}
    <v-card flat height="200px"></v-card>
    {{-- /divider --}}

    <template id="pricing">
        <div class="white">
            <v-layout row wrap justify-right align-center>
                <v-flex md5 offset-md1 xs12>
                    <v-card flat>
                        <v-card-text>
                            <h2 class="page-title display-2 blue-grey--text text--lighten-3 pb-4"><strong>Pricing</strong></h2>
                            <h2 class="title page-title">Far far away, behind the word mountains</h2>
                            <p class="subheading page-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis deserunt, aut, ratione vitae natus sunt voluptas dolorum.</p>
                        </v-card-text>
                    </v-card>
                </v-flex>

                <v-flex md6 xs12>
                    <v-card flat data-aos="fade-up">
                        <img src="{{ assets('frontier/images/placeholder/iso/ship.png') }}" width="100%">
                    </v-card>
                </v-flex>
            </v-layout>
        </div>
    </template>

    {{-- divider --}}
    <v-card flat height="200px"></v-card>
    {{-- /divider --}}

    <template id="try-now">
        <div class="white">
            <v-layout row wrap justify-left align-center>
                <v-flex md6 xs12 order-sm2 order-md1>
                    <v-card flat class="mb-3" data-aos="fade-up">
                        <img src="{{ assets('frontier/images/placeholder/iso/laptopIllustration.png') }}" width="100%">
                    </v-card>
                </v-flex>

                <v-flex md5 offset-md1 xs12 order-sm1 order-md2>
                    <v-card flat>
                        <v-card-text>
                            <h2 class="page-title display-2 blue-grey--text text--lighten-3 pb-4"><strong>Try Now</strong></h2>
                            <h2 class="title page-title">Far far away, behind the word mountains</h2>
                            <p class="subheading page-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis deserunt, aut, ratione vitae natus sunt voluptas dolorum.</p>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </div>
    </template>

    {{-- divider --}}
    <v-card flat height="200px"></v-card>
    {{-- /divider --}}

    <template id="footer">
        <v-card flat style="background: linear-gradient(135deg, #003073, #029797);">
            <v-layout row wrap justify-center align-center>
                <v-flex md8 xs12>
                    <v-card flat class="transparent text-xs-center py-5">
                        <v-card-text>
                            <h2 class="white--text page-title display-1">
                                <strong>Start using {{ $application->site->title }} today!</strong>
                            </h2>
                            <p class="white--text page-title"><em>..from wherever you are, to whenever you want to.</em></p>

                            <v-btn round large outline class="elevation-1 px-4 white--text" href="{{ route('register.show') }}">Sign up now</v-btn>
                        </v-card-text>
                    </v-card>
                    <v-divider class="white"></v-divider>
                    <v-card flat class="transparent py-3">
                        <v-layout row wrap justify-center align-center>
                            <v-flex md6 xs12>
                                <v-card-actions>
                                    <v-avatar size="60px">
                                        <img src="{{ $application->site->logo }}" alt="">
                                    </v-avatar>
                                    <v-card-text class="caption">
                                        <p class="mb-1 white--text"> Copyright &copy; 2018 Rippl3s. All rights reserved.</p>
                                        <span><a class="white--text td-n" href="">Privacy Policy</a></span>
                                    </v-card-text>
                                </v-card-actions>
                            </v-flex>

                            <v-flex md6 xs12>
                                <v-card-text class="pa-0 text-xs-right caption">
                                        <a class="td-n white--text mr-3" href="">HOME</a>
                                        <a class="td-n white--text mr-3" href="">ABOUT US</a>
                                        <a class="td-n white--text mr-3" href="">HOW IT WORKS</a>
                                        <a class="td-n white--text" href="">CONTACT US</a>
                                </v-card-text>
                            </v-flex>
                        </v-layout>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-card>
    </template>

    @include("Template::widgets.home")
@endsection

@push('css')
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <style>
        #banner {
            position: relative !important;
            height: 100% !important;
            width: 100% !important;

            background: -webkit-gradient(linear, 0 0, 100% 100%, color-stop(0, #003073), color-stop(100%, #029797));
            background: -webkit-linear-gradient(1335deg, #003073, #029797);
            background: -moz-linear-gradient(45deg, #003073, #029797);
            background: -ms-linear-gradient(45deg, #003073 0, #029797 100%);
            background: -o-linear-gradient(45deg, #003073, #029797);
            background: linear-gradient(135deg, #003073, #029797);

            box-shadow: 0 1px 3px rgba(0,0,0,.2),0 1px 1px rgba(0,0,0,.14),0 2px 1px -1px rgba(0,0,0,.12)!important;
        }
        #banner-sm {
            background: -webkit-gradient(linear, 0 0, 100% 100%, color-stop(0, #003073), color-stop(100%, #029797));
            background: -webkit-linear-gradient(1335deg, #003073, #029797);
            background: -moz-linear-gradient(45deg, #003073, #029797);
            background: -ms-linear-gradient(45deg, #003073 0, #029797 100%);
            background: -o-linear-gradient(45deg, #003073, #029797);
            background: linear-gradient(135deg, #003073, #029797);

            box-shadow: 0 1px 3px rgba(0,0,0,.2),0 1px 1px rgba(0,0,0,.14),0 2px 1px -1px rgba(0,0,0,.12)!important;
        }
        .threejs-section {
            position: absolute !important;
            /*top: 50%;*/
            /*transform: translateY(-50%);*/
            top: 64px !important;
            width: 100%;
            /*height: 100%;*/
        }
        #home-menu {
            position: absolute !important;
            z-index: 100;
            height: 64px !important;
        }
        #full-width {
            /*background: linear-gradient(159deg,#512dcf 31%,#10a3d5 100%) #512dcf;*/
            /*background: linear-gradient(to top, rgb(95, 11, 89), rgb(63, 10, 82));*/
            background: linear-gradient(159deg,#9C27B0 31%,#2196F3 100%);
        }
        #footer {
            background: linear-gradient(135deg, #003073, #029797);
        }
        .relative {
            position: relative !important;
        }
    </style>
@endpush

@push('js')
    <script src="{{ assets('frontier/threejs/build/three.min.js') }}"></script>
    <script src="{{ assets('frontier/threejs/examples/js/renderers/Projector.js') }}"></script>
    <script src="{{ assets('frontier/threejs/examples/js/renderers/CanvasRenderer.js') }}"></script>

    <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>

    <script>
        var mouseX = 0, mouseY = 0,

        windowHalfX = window.innerWidth / 2,
        windowHalfY = window.innerHeight / 2,

        SEPARATION = 200,
        AMOUNTX = 10,
        AMOUNTY = 10,

        camera, scene, renderer;

        init();
        animate();

        function init() {

            var container, separation = 100, amountX = 50, amountY = 50,
            particles, particle;


            container = document.createElement('div');
            container.classList.add('js-section');
            var parent = document.querySelector('#banner');
            parent.appendChild(container);

            camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 10000 );
            camera.position.z = 100;

            scene = new THREE.Scene();

            renderer = new THREE.CanvasRenderer({alpha: true});
            renderer.setPixelRatio( window.devicePixelRatio );
            renderer.setSize( window.innerWidth, window.innerHeight );
            container.appendChild( renderer.domElement );
            renderer.setClearColor( 0xffffff, 0 );

            // particles

            var PI2 = Math.PI * 2;
            var material = new THREE.SpriteCanvasMaterial( {

                color: 0xffffff,
                program: function ( context ) {

                    context.beginPath();
                    context.arc( 0, 0, 0.5, 0, PI2, true );
                    context.fill();

                }

            } );

            var geometry = new THREE.Geometry();

            for ( var i = 0; i < 100; i ++ ) {

                particle = new THREE.Sprite( material );
                particle.position.x = Math.random() * 2 - 1;
                particle.position.y = Math.random() * 2 - 1;
                particle.position.z = Math.random() * 2 - 1;
                particle.position.normalize();
                particle.position.multiplyScalar( Math.random() * 10 + 450 );
                particle.scale.x = particle.scale.y = 10;
                scene.add( particle );

                geometry.vertices.push( particle.position );

            }

            // lines

            var line = new THREE.Line( geometry, new THREE.LineBasicMaterial( { color: 0x0288d1, opacity: 0.5 } ) );
            scene.add( line );

            document.addEventListener( 'mouseover', onDocumentMouseMove, false );
            document.addEventListener( 'touchstart', onDocumentTouchStart, false );
            document.addEventListener( 'touchmove', onDocumentTouchMove, false );

            //

            window.addEventListener( 'resize', onWindowResize, false );

        }

        function onWindowResize() {

            windowHalfX = window.innerWidth / 2;
            windowHalfY = window.innerHeight / 2;

            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();

            renderer.setSize( window.innerWidth, window.innerHeight );

        }

        //

        function onDocumentMouseMove(event) {

            mouseX = event.clientX - windowHalfX;
            mouseY = event.clientY - windowHalfY;

        }

        function onDocumentTouchStart( event ) {

            if ( event.touches.length > 1 ) {

                event.preventDefault();

                mouseX = event.touches[ 0 ].pageX - windowHalfX;
                mouseY = event.touches[ 0 ].pageY - windowHalfY;

            }

        }

        function onDocumentTouchMove( event ) {

            if ( event.touches.length == 1 ) {

                event.preventDefault();

                mouseX = event.touches[ 0 ].pageX - windowHalfX;
                mouseY = event.touches[ 0 ].pageY - windowHalfY;

            }

        }

        //

        function animate() {

            requestAnimationFrame( animate );

            render();

        }

        function render() {

            camera.position.x += ( mouseX - camera.position.x ) * .05;
            camera.position.y += ( - mouseY + 200 - camera.position.y ) * .05;
            camera.lookAt( scene.position );

            renderer.render( scene, camera );
        }


        // AOS Animation
        AOS.init({
            duration: 1200,
        })
    </script>
@endpush
