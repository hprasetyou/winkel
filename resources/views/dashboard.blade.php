
@extends('layouts.app')

@section('content')
            @include('layouts.partial.navigation')
            <v-app-bar app color="teal" dark>
                <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                <v-toolbar-title>Application</v-toolbar-title>
                <!-- <v-spacer></v-spacer>
                <v-flex xs2>
                    <v-select
                        :value="getActiveStore"
                        @change="setStore"
                        :items="getStore"></v-select>
                </v-flex> -->
            </v-app-bar>
            <v-content>
                <v-container fluid fill-height>
                    <v-layout column>
                      <router-view></router-view>
                    </v-layout>
                </v-container>
            </v-content>
            <v-footer color="teal" app inset>
                <span class="white--text">&copy; 2019 <a href="mailto:hprasetyou@gmail.com">Hprasetyou</a></span>
            </v-footer>
@endsection