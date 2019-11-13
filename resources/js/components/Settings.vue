<template>
<div class="settings-wrapper">
    <h4 class="mt-4 section-title">General</h4>
        <div class="mt-3 mb-5 section">
            <table class="table table-sm">
                <tr v-for="setting in settings" :key="setting.id">
                    <td style="width: 25%; font-weight: bold">{{setting.name}}</td>
                    <td><input type="text" v-model="setting.value" @blur="updateSetting(setting)"/></td>
                </tr>
            </table>
        </div>

        <h4 class="section-title">Users</h4>
        <div class="mt-3 mb-5 section">
            <table class="table table-sm" :style="{opacity: tableOpacity}">
                <tr><th>Name</th><th>Email</th><th>Admin</th><th></th></tr>
                    <tr v-for="user in usersList" :key="user.id">
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>
                            <input type="checkbox" v-model="user.is_admin" @change="updateUserStatus(user)"/>
                        </td>
                        <td>
                            <span class="delete-button" @click="deleteUser(user.id)">Delete user</span>
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
            updateSetting(setting) {
                axios.patch(`/api/settings/${setting.id}`, null, {params: {'value': setting.value}})
                .then((response) => { // success
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(() => {
                    // always executed
                });
            },
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
.section {
    background-color: #fff;
    padding: 1.5rem;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
}
.section-title {
    margin-left: 1.5rem;
}
.delete-button {
    cursor: pointer;
    color: #3490dc;
}
</style>
