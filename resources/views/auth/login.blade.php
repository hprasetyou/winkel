@extends('layouts.app')

@section('content')
<v-container grid-list-md text-xs-center>
    <v-layout row wrap>
        <v-flex md8>
        </v-flex>
        <v-flex md4>
            <login-form/>
        </v-flex>
    </v-layout>
</v-container>
@endsection
