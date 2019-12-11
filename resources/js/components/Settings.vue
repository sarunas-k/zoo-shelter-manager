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
            <a href="/users/create" class="btn btn-sm btn-success mb-3">New User</a>
            <table class="table table-sm" :style="{opacity: isUsersTableLoading ? 0.6 : 1}">
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

        <h4 class="section-title">Staff</h4>
        <div class="mt-3 mb-5 section">
            <a href="/staff/create" class="btn btn-sm btn-success mb-3">New Staff</a>
            <table class="table table-sm" :style="{opacity: isStaffTableLoading ? 0.6 : 1}">
                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Phone</th>
                    <th>Vet</th>
                    <th></th>
                </tr>
                <tr v-for="staffMember in staffList" :key="staffMember.id">
                    <td>{{staffMember.first_name}}</td>
                    <td>{{staffMember.last_name}}</td>
                    <td>
                        <input type="text" class="form-control" v-model="staffMember.phone" @change="updateStaffStatus(staffMember)"/>
                    </td>
                    <td>
                        <input type="checkbox" v-model="staffMember.is_vet" @change="updateStaffStatus(staffMember)"/>
                    </td>
                    <td>
                        <span class="delete-button" @click="deleteStaff(staffMember.id)">Delete staff</span>
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
            this.staffList = [...this.staff];
        },
        data() {
            return {
                response: [],
                isUsersTableLoading: false,
                isStaffTableLoading: false,
                usersList: [],
                staffList: []
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
                this.isUsersTableLoading = true;
                axios.delete(`/api/users/${id}`, null, null)
                .then((response) => { // success
                    this.usersList = this.usersList.filter(user => user.id !== id);
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(() => {
                    // always executed
                    this.isUsersTableLoading = false;
                });
            },
            deleteStaff(id) {
                this.isStaffTableLoading = true;
                axios.delete(`/api/staff/${id}`, null, null)
                .then((response) => { // success
                    this.staffList = this.staffList.filter(staff => staff.id !== id);
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(() => {
                    // always executed
                    this.isStaffTableLoading = false;
                });
            },
            updateUserStatus(user) {
                this.isUsersTableLoading = true;
                axios.patch(`/api/users/${user.id}`, null, { params: {'is_admin': user.is_admin} })
                .then((response) => { // success
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(() => {
                    // always executed
                    this.isUsersTableLoading = false;
                });
            },
            updateStaffStatus(staff) {
                this.isStaffTableLoading = true;
                axios.patch(`/api/staff/${staff.id}`, null, { params: {
                    'is_vet': staff.is_vet,
                    'phone': staff.phone
                } })
                .then((response) => { // success
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(() => {
                    // always executed
                    this.isStaffTableLoading = false;
                });
            }
        },
        props: {
            csrf:     { type: String, default: '' },
            settings: { type: Array, default: '' },
            users:    { type: Array, default: '' },
            staff:    { type: Array, default: '' }
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
