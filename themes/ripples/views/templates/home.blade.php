{{--
Template Name: Home Template
Type: Page
Description: The default home template displaying the title, body, and featured image of the page.
Author: John Lioneil Dionisio
Version: 1.0
--}}

@extends("Theme::layouts.public")

@section("content")
    <div id="banner">
        <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.50); position: absolute; width: 100%; height: 100%; z-index: 0;"></div>
        <v-card flat class="transparent threejs-section">
            <v-card-text class="white--text text-xs-center">
                <h2 class="page-title display-4">{{ $application->site->title }}</h2>
                <h4 class="page-title headline">{!! $page->body !!}</h4>
            </v-card-text>
        </v-card>
    </div>
    <template id="hero">
        <v-card dark class="elevation-0">
            {{-- <v-card-media src="{{ $page->feature }}" height="90vh"> --}}
            <v-card-media src="{{ assets('frontier/images/placeholder/hero.jpg') }}" height="90vh">
                {{-- <div class="insert-overlay" style="background: rgba(0, 0, 0, 0.3); position: absolute; width: 100%; height: 100%; z-index: 0;"></div> --}}
                <v-container fill-height>
                    <layout row wrap justify-center align-left>
                        <v-flex md5 xs12>
                            <v-card flat dark class="transparent">
                                <h2 class="page-title">{{ $application->site->title }}</h2>
                                <p class="page-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos unde architecto, mollitia, alias corporis autem delectus libero molestias iure! Hic iusto voluptates repellendus numquam! Optio architecto soluta hic magnam adipisci?</p>
                                <p class="page-title">Relax! It is still under construction.</p>
                            </v-card>
                        </v-flex>
                    </layout>
                </v-container>
            </v-card-media>
        <v-card>
    </template>

    {{-- divider --}}
    <v-card flat height="200px"></v-card>
    {{-- /divider --}}

    <template id="why-us">
        <div class="white">
            <v-layout row wrap justify-right align-center>
                <v-flex md5 offset-md1 xs12>
                    <v-card flat>
                        <h2 class="page-title display-1 primary--text"><strong>Why Us</strong></h2>
                        <v-card-text>
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
                        <img src="{{ assets('frontier/images/placeholder/section-1.jpg') }}" width="100%">
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
                        <img src="{{ assets('frontier/images/placeholder/section-2.jpg') }}" width="100%">
                    </v-card>
                </v-flex>

                <v-flex md5 offset-md1 xs12 order-sm1 order-md2>
                    <v-card flat>
                        <h2 class="page-title display-1 primary--text"><strong>How it works</strong></h2>
                        <v-card-text>
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

    <template id="pricing">
        <div class="white">
            <v-layout row wrap justify-right align-center>
                <v-flex md5 offset-md1 xs12>
                    <v-card flat>
                        <h2 class="page-title display-1 primary--text"><strong>Pricing</strong></h2>
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
                        <h2 class="page-title display-1 primary--text"><strong>Try Now</strong></h2>
                        <v-card-text>
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
        }
        .threejs-section {
            position: absolute !important;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
@endpush

@push('js')
    {{-- <script src="../build/three.js"></script> --}}
    <script src="{{ assets('frontier/threejs/build/three.js') }}"></script>

    <script src="js/renderers/Projector.js"></script>
    <script src="{{ assets('frontier/threejs/examples/js/renderers/Projector.js') }}"></script>
    <script src="{{ assets('frontier/threejs/examples/js/renderers/CanvasRenderer.js') }}"></script>
    {{-- <script src="js/renderers/CanvasRenderer.js"></script> --}}

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
            container.classList.add('3d-section');
            var parent = document.querySelector('#banner');
            parent.appendChild(container);

            camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 10000 );
            camera.position.z = 100;

            scene = new THREE.Scene();

            renderer = new THREE.CanvasRenderer();
            renderer.setPixelRatio( window.devicePixelRatio );
            renderer.setSize( window.innerWidth, window.innerHeight );
            container.appendChild( renderer.domElement );

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

            var line = new THREE.Line( geometry, new THREE.LineBasicMaterial( { color: 0xca3784, opacity: 0.5 } ) );
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
