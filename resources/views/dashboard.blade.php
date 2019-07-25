
@extends('layouts.app')

@section('content')
        <v-app id="inspire">
            @include('layouts.partial.navigation')
            <v-app-bar app color="indigo" dark>
                <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                <v-toolbar-title>Application</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-flex xs2>
                    <v-select
                        :value="getActiveStore"
                        @change="setStore"
                        :items="getStore"></v-select>
                </v-flex>
            </v-app-bar>
            <v-content>
                <v-container fluid fill-height>
                    <v-layout column>
                      <router-view></router-view>
                    </v-layout>
                </v-container>
            </v-content>
            <v-footer color="indigo" app inset>
                <span class="white--text">&copy; 2017</span>
            </v-footer>
        </v-app>
@endsection