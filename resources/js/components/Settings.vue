<template>
<div class="settings-wrapper">
    <h4 class="mt-4" style="margin-left: 1.5rem">General</h4>
        <div style="background-color: #fff; padding: 1.5rem; box-shadow: 0 0 5px rgba(0,0,0,0.1);" class="mt-3 mb-5">
            <div v-for="setting in settings" :key="setting.id">
                <label style="margin-right: 1em; font-weight: bold">{{setting.name}}</label>
                <input type="text" :value="setting.value"/>
            </div>
        </div>

        <h4 style="margin-left: 1.5rem">Users</h4>
        <div style="background-color: #fff; padding: 1.5rem; box-shadow: 0 0 5px rgba(0,0,0,0.1);" class="mt-3 mb-5">
            <table class="table table-sm" :style="{opacity: tableOpacity}">
                <tr><th>Name</th><th>Email</th><th>Admin</th><th></th></tr>
                    <tr v-for="user in usersList" :key="user.id">
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>
                            <input type="checkbox" v-model="user.is_admin" @change="updateUserStatus(user)"/>
                        </td>
                        <td>
                            <span style="cursor: pointer; color: #3490dc" @click="deleteUser(user.id)">Delete user</span>
                        </td>
                    </tr>
            </table>
        </div>
</div>
</template>


<script>
    export default {
        mounted() {
            console.log('Vue: Settings Component mounted.');
            this.usersList = [...this.users];
        },
        data() {
            return {
                response: [],
                isLoading: false,
                usersList: []
            }
        },
        methods: {
            deleteUser(id) {
                this.isLoading = true;
                axios.delete(`/api/users/${id}`, null, null)
                .then((response) => { // success
                    this.usersList = this.usersList.filter(user => user.id !== id);
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(() => {
                    // always executed
                    this.isLoading = false;
                });
            },
            updateUserStatus(user) {
                this.isLoading = true;
                axios.patch(`/api/users/${user.id}`, null, { params: {'is_admin': user.is_admin} })
                .then((response) => { // success
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(() => {
                    // always executed
                    this.isLoading = false;
                });
            }
        },
        computed: {
            tableOpacity() { return this.isLoading ? 0.6 : 1 }
        },
        props: {
            csrf:     { type: String, default: '' },
            settings: { type: Array, default: '' },
            users:    { type: Array, default: '' }
        }
    }
</script>
<style scoped>
</style>
