<template>
    <app-layout title="Dashboard">
        <template #header>

            <div class="flex flex-wrap justify-start">

                <sub-nav-link-component
                    v-for="(link, index) in navSubLinks"
                    v-bind:key="index"
                    :href="route(link.name)"
                    :active="route().current(link.name)"
                >
                    {{__(link.text)}}
                </sub-nav-link-component>
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <h2 class="text-center text-lg font-bold">{{ __('List of registered users') }}</h2>


                    <div>
                        <div class="p-2 text-right">
                            <select v-on:change="changePerPage" class="text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded" name="ldl" id="perPage">
                                <option value="1" :selected="users.per_page==20?true:false">20 {{__('per page')}}</option>
                                <option value="2" :selected="users.per_page==50?true:false">50 {{__('per page')}}</option>
                                <option value="3" :selected="users.per_page==100?true:false">100 {{__('per page')}}</option>
                            </select>
                        </div>
                        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">

                            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                                <table class="min-w-full leading-normal">
                                    <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            {{ __('Name') }}
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            {{ __('Email') }}
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            {{ __('Teams') }}
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            {{ __('Create teams') }}
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            {{ __('Manage all users') }}
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            {{ __('Manage all teams') }}
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            {{ __('Status') }}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(user, index) in this.userList.data" :key="user.id">
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="object-cover w-12 h-12 rounded-full"
                                                         :src="user.profile_photo_url" :alt="user.name">
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        <span class="ml-1">{{ user.id }}</span>
                                                        <span class="ml-1 capitalize">{{ user.name }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">{{ user.email }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ user.allTeams }}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap text-center">
                                                <checkbox-component
                                                    :check="user.userPrivieles.create_teams"
                                                    class-value="checkmark_green center_x"
                                                    :id-comp="'create_teams_'+user.id"
                                                    name="create_teams"
                                                    :index="index"
                                                    @update="updateCheckbox">
                                                </checkbox-component>
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap text-center">
                                                <checkbox-component
                                                    :check="user.userPrivieles.manage_all_users"
                                                    class-value="checkmark_green center_x"
                                                    :id-comp="'manage_all_users_'+user.id"
                                                    name="manage_all_users"
                                                    :index="index"
                                                    @update="updateCheckbox">
                                                </checkbox-component>
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap text-center">
                                                <checkbox-component
                                                    :check="user.userPrivieles.manage_all_teams"
                                                    class-value="checkmark_green center_x"
                                                    :id-comp="'manage_all_teams_'+user.id"
                                                    name="manage_all_teams"
                                                    :index="index"
                                                    @update="updateCheckbox">
                                                </checkbox-component>
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <span
                                                v-if="user.timeInactive < 60"
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight text-center">
                                                <span aria-hidden
                                                      class="absolute inset-0 bg-green-300 opacity-50 rounded-full"></span>
                                                <span class="relative capitalize">{{ __('online') }} </span>
                                            </span>
                                            <span
                                                v-else-if="user.timeInactive > 60 && user.timeInactive < 360"
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight text-center">
                                                <span aria-hidden
                                                      class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                <span class="relative capitalize">{{ __('active') }} </span>
                                                <br><small>{{ user.last_activity }}</small>
                                            </span>
                                            <span
                                                v-else-if="user.timeInactive > 360 && user.timeInactive < 900"
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight text-center">
                                                <span aria-hidden
                                                      class="absolute inset-0 bg-yellow-300 opacity-50 rounded-full"></span>
                                                <span class="relative capitalize">{{ __('absent') }}</span>
                                                <br><small>{{ user.last_activity }}</small>
                                            </span>
                                            <span
                                                v-else-if="user.timeInactive > 900"
                                                class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight text-center">
                                                <span aria-hidden
                                                      class="absolute inset-0 bg-gray-400 opacity-50 rounded-full"></span>
                                                <span class="relative capitalize">{{ __('inactive') }}</span>
                                                <br><small>{{ user.last_activity }}</small>
                                            </span>
                                        </td>
                                    </tr>


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <pagination-component
                            :links="links"
                            :pagination-Vue="pagination"
                            @changePage="getUsers"
                            @restartProgress="progressToProced=numberOfRequests-5"
                        ></pagination-component>
                    </div>

                </div>
            </div>

        </div>

    </app-layout>
</template>

<script>
import {defineComponent} from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import Welcome from '@/Jetstream/Welcome.vue'
import checkboxComponent from "@/Components/checkboxComponent.vue";
import paginationComponent from "@/Components/paginationComponent.vue";
import subNavLinkComponent from "@/Components/subNavLinkComponent";



export default defineComponent({
    props: ['users','paginationVue'],
    components: {
        AppLayout,
        Welcome,
        checkboxComponent,
        paginationComponent,
        subNavLinkComponent
    },
    data() {
        return {
            navSubLinks:[
                {
                    href: '/dashboard',
                    name: 'dashboard',
                    text: 'List of registered users',
                },
                {
                    href: '/dashboard/teams',
                    name: 'dashboard.teams',
                    text: 'Teams',
                },
                {
                    href: '/dashboard',
                    name: 'dashboard',
                    text: 'List of registered users',
                },
                {
                    href: '/dashboard/teams',
                    name: 'dashboard.teams',
                    text: 'Teams',
                },

            ],
            navLinks: this.$page.props.modulesLinks,
            userList: this.users,
            pagination: this.paginationVue,
            links: this.users.links,
            progressToProced:0,
            launchQuery: '',
            timeout: 45000,
            numberOfRequests: 8,
        }
    },
    mounted() {
        // this.progressToProced = 1;
        // clearTimeout(this.launchQuery);
        // this.launchQuery = setTimeout(function () { this.progress();}.bind(this), this.timeout*2);
        // this.getSubModules('dashboard');
        
   },
    methods: {
        updateCheckbox(element) {
            let ele = element.nextElementSibling;
            if (element.checked)
                ele.classList.add('alert_success');
            else
                ele.classList.remove('alert_success');

            console.log(element);
            console.log(element.name);
            console.log(element.checked);
            console.log(element.nextElementSibling);
            this.$swal({
                title:'jejeje',
                text: 'userListndo swal',
                icon: 'success',
            });
        },
        changePerPage(element){
            let perPage = element.target.value;
            let url = this.userList.path+`?perPage=${perPage}`;

            this.progressToProced = 0;
            clearTimeout(this.launchQuery);
            this.getUsers(url);

        },
        getUsers(url){

            let vm = this;

            axios.get(url)
                .then(response=>{

                    vm.userList = response.data.users;
                    vm.pagination = response.data.paginationVue;
                    vm.links = response.data.users.links;

                    /** Bucle settimeout para refrescar los datos */
                    // clearTimeout(vm.launchQuery);
                    // vm.launchQuery = setTimeout(function () { vm.progress();}.bind(vm), vm.timeout);

                })
                .catch(err=>{
                    let status = err.response.status;

                    console.log('code: '+status);

                    if(status === 401){
                        console.log('redirect to login');
                        console.log('code: '+status+' message: '+err.response.data.message);
                        location.reload();
                    }

                    console.log(err);
                });
        },
        getSubModules(name){

            let modules = this.navLinks;
            let existsName = false;
            let vm = this;
            modules.forEach(module => {

                if(module.name == name){
                    existsName = true;
                    vm.navSubLinks = module.subLinks;
                }

            });

            if(!existsName){
                vm.navSubLinks = [];

                if(modules.length > 0 && modules[0].href != undefined)
                    location.href = modules[0].href;
                else
                    this.$inertia.get(`/`);

            }

            return [];
        },
        // progress: function () {

        //     if (this.progressToProced < this.numberOfRequests) {

        //         this.progressToProced++
        //         let url = this.userList.path+`?perPage=${this.userList.per_page}&&page=${this.userList.current_page}`;

        //         // this.getUsers(url);

        //     }
        // }

    },

})
</script>
