<v-navigation-drawer fixed v-model="drawer" app>
    <v-list dense>
        <template v-for="item in {{ $foo }}">
            <v-list-group
            v-if="item.menus"
            v-model="item.active"
            :prepend-icon="item.icon"
            no-action
            >
                <template v-slot:activator>
                <v-list-item-content>
                    <v-list-item-title v-text="item.name"></v-list-item-title>
                </v-list-item-content>
                </template>

                <v-list-item
                v-for="submenu in item.menus"
                :key="submenu.name"
                :to="submenu.url"
                >
                <v-list-item-content>
                    <v-list-item-title v-text="submenu.name"></v-list-item-title>
                </v-list-item-content>
                </v-list-item>
            </v-list-group>
            <v-list-item v-else :to="item.url">
                <v-list-item-action>
                    <v-icon>@{{ item.icon }}</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>@{{ item.name }}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </template>
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
