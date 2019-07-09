
@extends('layouts.app')

@section('content')
        <v-app id="inspire">
            @include('layouts.partial.navigation')
            <v-toolbar color="indigo" dark fixed app>
                <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
                <v-toolbar-title>Application</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-flex xs2>
                    <v-select
                        :value="getActiveStore"
                        @change="setStore"
                        :items="getStore"></v-select>
                </v-flex>
            </v-toolbar>
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