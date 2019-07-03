<v-navigation-drawer fixed v-model="drawer" app>
    <v-list dense>
        <v-list-tile v-for="item in {{ $foo }}" :to="item.url">
            <v-list-tile-action>
                <v-icon>@{{ item.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title>@{{ item.name }}</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        <v-list-tile @click="logOut">
            <v-list-tile-action>
                <v-icon></v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title>Logout</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
    </v-list>
</v-navigation-drawer>
