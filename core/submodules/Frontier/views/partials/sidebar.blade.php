<v-navigation-drawer
    :dark.sync="dark"
    :floating="sidebar.floating"
    light
    :light.sync="light"
    :mini-variant.sync="sidebar.mini"
    @click.native.stop="setStorage('sidebar.mini', sidebar.mini)"
    class="navigation-drawer--is-booted elevation-1"
    enable-resize-watcher
    overflow
    persistent
    v-model="sidebar.drawer"
    class="pb-3"
>
    <v-toolbar flat class="transparent">
        <v-list class="pa-0">
            <v-list-tile tag="div">
                <v-list-tile-avatar>
                    @include("Frontier::partials.brand")
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title><strong>{{ $application->site->title }}</strong></v-list-tile-title>
                </v-list-tile-content>
                <v-list-tile-action>
                    <v-btn
                        icon
                        :dark.sync="dark" :light.sync="light"
                        @click.native.stop="setStorage('sidebar.mini', (sidebar.mini = !sidebar.mini))"
                    >
                        <v-icon>chevron_left</v-icon>
                    </v-btn>
                </v-list-tile-action>
            </v-list-tile>
        </v-list>
    </v-toolbar>

    {{-- <v-divider :dark.sync="dark" :light.sync="light"></v-divider> --}}

    {{-- <v-divider :dark.sync="dark" :light.sync="light"></v-divider> --}}

    <v-toolbar flat class="transparent">
        <v-list>{{-- <v-list dense> --}}

            <template v-for="(menu, i) in navigation.sidebar">
                {{-- if is avatar --}}
                {{-- Avatar --}}
                <v-list-group
                    :dark.sync="dark" :light.sync="light"
                    class="mb-4"
                    no-action
                    v-if="menu.is_avatar"
                    v-model="menu.active"
                >
                    {{-- headmenu --}}
                    <v-list-tile slot="item">
                        <v-list-tile-avatar>
                            <img src="{{ user()->avatar }}" alt="{{ user()->handlename }}">
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <strong><v-list-tile-title>{{ user()->displayname }}</v-list-tile-title></strong>
                            <small>
                                <v-icon :dark.sync="dark" :light.sync="light">supervisor_account</v-icon>
                                {{ user()->displayrole }}
                            </small>
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <v-icon
                                :dark.sync="dark"
                                :light.sync="light"
                            >keyboard_arrow_down</v-icon>
                        </v-list-tile-action>
                    </v-list-tile>

                    {{-- childmenu --}}
                    <v-list-tile
                        :key="i"
                        :class="(child.child && child.child.active) || child.active ? 'active--primary' : ''"
                        :href="child.slug"
                        v-for="(child, i) in menu.children"
                        :title="child.labels.description"
                        v-model="child.active"
                    >
                        <v-list-tile-action>
                            <v-icon
                                :dark.sync="dark"
                                :light.sync="light"
                            >@{{ child.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content >
                            <v-list-tile-title>
                                @{{ child.labels.title }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>
                {{-- /Avatar --}}


                {{-- if is header --}}
                <v-subheader
                    v-else-if="menu.is_header || menu.before"
                    :dark.sync="dark" :light.sync="light"
                    class="grey--text text--lighten-1 mt-4"
                >
                    <small>@{{ menu.text.toUpperCase() }}</small>
                    &nbsp; <v-divider :dark.sync="dark" :light.sync="light"></v-divider>
                </v-subheader>

                {{-- elseif has children --}}
                <v-list-group
                    v-else-if="menu.has_children"
                    v-model="menu.active"
                    no-action
                >
                    {{-- headmenu --}}
                    <v-list-tile slot="item" :title="menu.labels.description">
                        <v-list-tile-action v-if="menu.icon">
                            <v-icon
                                :dark.sync="dark"
                                :light.sync="light"
                            >@{{ menu.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                @{{ menu.labels.title }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <v-icon
                                :dark.sync="dark"
                                :light.sync="light"
                            >@{{ menu.name ? 'keyboard_arrow_down' : 'keyboard_arrow_up' }}</v-icon>
                        </v-list-tile-action>
                    </v-list-tile>

                    {{-- childmenu --}}
                    <v-list-tile
                        :key="i"
                        :class="(child.child && child.child.active) || child.active ? 'active--primary' : ''"
                        :href="child.slug"
                        v-for="(child, i) in menu.children"
                        :title="child.labels.description"
                        {{-- v-model="child.active" --}}
                    >
                        <v-list-tile-action>
                            <v-icon
                                :dark.sync="dark"
                                :light.sync="light"
                            >@{{ child.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content >
                            <v-list-tile-title>
                                @{{ child.labels.title }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>

                {{-- else if no children --}}
                <v-list-tile
                    :class="menu.active ? 'active--primary' : ''"
                    :href="menu.slug"
                    :title="menu.labels.description"
                    v-else
                    v-model="menu.active"
                >
                    <v-list-tile-action v-if="menu.icon">
                        <v-icon
                            :dark.sync="dark"
                            :light.sync="light"
                        >@{{ menu.icon }}</v-icon>
                    </v-list-tile-action>

                    <v-list-tile-content>
                        <v-list-tile-title>
                            @{{ menu.labels.title }}
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>

            </template>

        </v-list>
    </v-toolbar>

</v-navigation-drawer>

@push('pre-scripts')
    <script>
        mixins.push({
            data: {
                navigation: {
                    sidebar: {!! json_encode($navigation->sidebar->collect) !!},
                },
            }
        });
    </script>
@endpush
