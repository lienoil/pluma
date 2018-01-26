<v-subheader>{{ __('Membership') }}</v-subheader>
                        <v-card-text>
                            <v-layout row wrap>
                                <v-flex sm4>
                                </v-flex>
                                <v-flex sm8>
                                    <input type="hidden" name="site_membership" :value="resource.radios.membership.model">
                                    <v-radio-group v-model="resource.radios.membership.model" :mandatory="true">
                                        <template v-for="(radio, i) in resource.radios.membership.items">
                                            <v-radio hide-details :input-value="i.toString()" :value="i.toString()" :label="radio"></v-radio>
                                        </template>
                                    </v-radio-group>
                                </v-flex>
                            </v-layout>

                            <v-layout row wrap>
                                <v-flex sm4>
                                    <v-subheader>{{ __('Date Format') }}</v-subheader>
                                </v-flex>
                                <v-flex sm8>
                                    <input type="hidden" name="date_format" :value="resource.radios.date_format.model">
                                    <v-radio-group hide-details class="mb-0" v-model="resource.radios.date_format.model" :mandatory="true">
                                        <v-radio hide-details input-value="F d, Y" value="F d, Y" label="F d, Y ({{ date('F d, Y') }})"></v-radio>
                                        <v-radio hide-details input-value="Y-m-d" value="Y-m-d" label="Y-m-d ({{ date('Y-m-d') }})"></v-radio>
                                        <v-radio hide-details input-value="Y/m/d" value="Y/m/d" label="Y/m/d ({{ date('Y/m/d') }})"></v-radio>
                                        <v-radio hide-details label="{{ __('Custom Format') }}" hide-details :input-value="resource.radios.date_format.custom" :value="resource.radios.date_format.custom"></v-radio>
                                    </v-radio-group>
                                    <v-text-field
                                        label="{{ __('Custom Date Format') }}"
                                        v-model="resource.radios.date_format.custom"
                                        input-group
                                        hide-details
                                        @input="(val) => { resource.radios.date_format.model = val }"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>