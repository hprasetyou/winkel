<v-navigation-drawer fixed v-model="drawer" app>
    <v-list dense>
        <v-list-item v-for="item in {{ $foo }}" :to="item.url">
            <v-list-item-action>
                <v-icon>@{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>@{{ item.name }}</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
        <v-list-item @click="logOut">
            <v-list-item-action>
                <v-icon></v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>Logout</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
    </v-list>
</v-navigation-drawer>
