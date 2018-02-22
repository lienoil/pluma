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
    <div id="banner" class="js-section">
        {{-- main menu --}}
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
        {{-- /main menu --}}

        {{-- banner-content --}}
        <div class="insert-overlay" style="background: rgba(0, 0, 0, 0.2); position: absolute; width: 100%; height: 100%; z-index: 0;"></div>
        <v-card flat class="transparent threejs-section">

            <v-layout row wrap justify-center align-center>
                <v-flex md10 xs12>
                    <v-layout row wrap justify-center align-center>
                        <v-flex sm6 xs12>
                            <v-card flat class="transparent">
                                <v-card-text class="white--text">
                                    <h2 class="page-title display-3"><strong>{{ $application->site->title }}</strong></h2>
                                    <h4 class="page-title headline">{!! $page->body !!}</h4>
                                </v-card-text>
                            </v-card>
                        </v-flex>

                        <v-flex sm6 xs12>
                            <v-card flat class="transparent">
                                <img src="{{ assets('frontier/images/placeholder/iso/iso-video.svg') }}" alt="" width="100%">
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-flex>
            </v-layout>
        </v-card>
        {{-- banner-content --}}
    </div>
    {{-- /banner --}}

    {{-- divider --}}
    <v-card flat height="200px"></v-card>
    {{-- /divider --}}

    <template id="why-us">
        <div class="white">
            <v-layout row wrap justify-right align-center>
                <v-flex md5 offset-md1 xs12>
                    <v-card flat>
                        <v-card-text>
                            <h2 class="page-title display-2 blue-grey--text text--lighten-4"><strong>Why Us</strong></h2>
                            <v-card-actions>
                                <v-avatar size="40px" tile class="mr-4">
                                    <img src="{{ assets('frontier/images/placeholder/home/computer.png') }}" alt="" width="100%">
                                </v-avatar>
                                <v-card-text>
                                    <p><strong>Far far away, behind the word mountains</strong></p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis deserunt, aut, ratione vitae natus sunt voluptas dolorum.</p>
                                </v-card-text>
                            </v-card-actions>

                            <v-card-actions>
                                <v-avatar size="40px" tile class="mr-4">
                                    <img src="{{ assets('frontier/images/placeholder/home/laptop.png') }}" alt="">
                                </v-avatar>
                                <v-card-text>
                                    <p><strong>Far far away, behind the word mountains</strong></p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis deserunt, aut, ratione vitae natus sunt voluptas dolorum.</p>
                                </v-card-text>
                            </v-card-actions>
                        </v-card-text>
                    </v-card>
                </v-flex>

                <v-flex md6 xs12>
                    <v-card flat>
                        <img src="{{ assets('frontier/images/placeholder/iso/7.png') }}" width="100%">
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
                    <v-card flat class="mb-3">
                        <img src="{{ assets('frontier/images/placeholder/iso/5.png') }}" width="100%">
                    </v-card>
                </v-flex>

                <v-flex md5 offset-md1 xs12 order-sm1 order-md2>
                    <v-card flat>
                        <v-card-text>
                            <h2 class="page-title display-2 blue-grey--text text--lighten-4"><strong>How it works</strong></h2>
                            <v-card-actions>
                                <v-avatar size="40px" tile class="mr-4">
                                    <img src="{{ assets('frontier/images/placeholder/home/networking.png') }}" alt="">
                                </v-avatar>
                                <v-card-text>
                                    <p><strong>Far far away, behind the word mountains</strong></p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis deserunt, aut, ratione vitae natus sunt voluptas dolorum.</p>
                                </v-card-text>
                            </v-card-actions>

                            <v-card-actions>
                                <v-avatar size="40px" tile class="mr-4">
                                    <img src="{{ assets('frontier/images/placeholder/home/user.png') }}" alt="">
                                </v-avatar>
                                <v-card-text>
                                    <p><strong>Far far away, behind the word mountains</strong></p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis deserunt, aut, ratione vitae natus sunt voluptas dolorum.</p>
                                </v-card-text>
                            </v-card-actions>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </div>
    </template>

    {{-- divider --}}
    <v-card flat height="200px"></v-card>
    {{-- /divider --}}

    {{-- full-width threejs --}}
    <div id="threejs-width">

    </div>
    {{-- /full-width threejs --}}

    {{-- divider --}}
    <v-card flat height="200px"></v-card>
    {{-- /divider --}}

    <template id="pricing">
        <div class="white">
            <v-layout row wrap justify-right align-center>
                <v-flex md5 offset-md1 xs12>
                    <v-card flat>
                        <h2 class="page-title display-2 blue-grey--text text--lighten-4"><strong>Pricing</strong></h2>
                        <v-card-text>
                            <v-card-actions>
                                <v-avatar size="40px" tile class="mr-4">
                                    <img src="{{ assets('frontier/images/placeholder/home/bar-chart.png') }}" alt="" width="100%">
                                </v-avatar>
                                <v-card-text>
                                    <p><strong>Far far away, behind the word mountains</strong></p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis deserunt, aut, ratione vitae natus sunt voluptas dolorum.</p>
                                </v-card-text>
                            </v-card-actions>

                            <v-card-actions>
                                <v-avatar size="40px" tile class="mr-4">
                                    <img src="{{ assets('frontier/images/placeholder/home/directions.png') }}" alt="">
                                </v-avatar>
                                <v-card-text>
                                    <p><strong>Far far away, behind the word mountains</strong></p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis deserunt, aut, ratione vitae natus sunt voluptas dolorum.</p>
                                </v-card-text>
                            </v-card-actions>
                        </v-card-text>
                    </v-card>
                </v-flex>

                <v-flex md6 xs12>
                    <v-card flat>
                        <img src="{{ assets('frontier/images/placeholder/section-3.jpg') }}" width="100%">
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
                    <v-card flat class="mb-3">
                        <img src="{{ assets('frontier/images/placeholder/section-4.jpg') }}" width="100%">
                    </v-card>
                </v-flex>

                <v-flex md5 offset-md1 xs12 order-sm1 order-md2>
                    <v-card flat>
                        <v-card-text>
                            <h2 class="page-title display-2 blue-grey--text text--lighten-4"><strong>Try Now</strong></h2>
                            <v-card-actions>
                                <v-avatar size="40px" tile class="mr-4">
                                    <img src="{{ assets('frontier/images/placeholder/home/pie-chart.png') }}" alt="">
                                </v-avatar>
                                <v-card-text>
                                    <p><strong>Far far away, behind the word mountains</strong></p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis deserunt, aut, ratione vitae natus sunt voluptas dolorum.</p>
                                </v-card-text>
                            </v-card-actions>

                            <v-card-actions>
                                <v-avatar size="40px" tile class="mr-4">
                                    <img src="{{ assets('frontier/images/placeholder/home/worldwide.png') }}" alt="">
                                </v-avatar>
                                <v-card-text>
                                    <p><strong>Far far away, behind the word mountains</strong></p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis deserunt, aut, ratione vitae natus sunt voluptas dolorum.</p>
                                </v-card-text>
                            </v-card-actions>
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
        <v-card flat style="background: linear-gradient(to top, rgb(95, 11, 89), rgb(63, 10, 82));">
            <v-layout row wrap justify-center align-center>
                <v-flex md8 xs12>
                    <v-card flat class="transparent text-xs-center py-5">
                        <v-card-text>
                            <h2 class="white--text page-title display-1">
                                <strong>Start using {{ $application->site->title }} today!</strong>
                            </h2>
                            <p class="white--text page-title"><em>..from wherever you are, to whenever you want to.</em></p>

                            <v-btn round large class="elevation-1 px-4" primary>Sign up now</v-btn>
                        </v-card-text>
                    </v-card>
                    <v-divider class="grey"></v-divider>
                    <v-card flat class="transparent py-3">
                        <v-layout row wrap justify-center align-center>
                            <v-flex md6 xs12>
                                <v-card-actions>
                                    <v-avatar size="60px">
                                        <img src="{{ $application->site->logo }}" alt="">
                                    </v-avatar>
                                    <v-card-text class="caption">
                                        <p class="mb-1 grey--text"> Copyright &copy; 2018 Rippl3s. All rights reserved.</p>
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
@endsection

@push('css')
    <style>
        #banner {
            position: relative !important;
            height: 100vh !important;
            background: linear-gradient(to top, rgb(95, 11, 89), rgb(63, 10, 82)) !important;
        }
        .threejs-section {
            /*position: absolute !important;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);*/
            position: absolute !important;
            top: 50%;
            transform: translateY(-50%);
        }
        #home-menu {
            position: absolute !important;
            z-index: 100;
        }
        .js-section {
            background: linear-gradient(to top, rgb(95, 11, 89), rgb(63, 10, 82)) !important;
        }
    </style>
@endpush

@push('js')
    <script src="{{ assets('frontier/threejs/build/three.min.js') }}"></script>

    <script src="{{ assets('frontier/threejs/examples/js/renderers/Projector.js') }}"></script>
    <script src="{{ assets('frontier/threejs/examples/js/renderers/CanvasRenderer.js') }}"></script>

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

            renderer = new THREE.CanvasRenderer();
            renderer.setPixelRatio( window.devicePixelRatio );
            renderer.setSize( window.innerWidth, window.innerHeight );
            container.appendChild( renderer.domElement );
            renderer = new THREE.CanvasRenderer({ alpha: true }); // gradient; this can be swapped for WebGLRenderer
            // renderer.setClearColor( 0xffffff, 0 );

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

            var line = new THREE.Line( geometry, new THREE.LineBasicMaterial( { color: 0x66b3f0, opacity: 0.5 } ) );
            scene.add( line );

            document.addEventListener( 'mousemove', onDocumentMouseMove, false );
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
    </script>
@endpush
