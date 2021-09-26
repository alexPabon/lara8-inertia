<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{__('Dashboard')}}
            </h2>
            
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <h2 class="text-center text-lg font-bold">{{__('List of registered users')}}</h2>             
                    
                    <p 
                        v-for="user in users" :key="user.id"
                        class="p-2 flex flex-wrap items-center content-center">
                        <span class="ml-1">
                            <img class="object-cover w-12 h-12 rounded-full" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name">
                        </span>
                        <span class="ml-1"><b class="text-blue-400">{{__('Name')}}: </b>{{user.name}}</span>
                        <span class="ml-1"><b class="text-blue-400">{{__('Email')}}: </b>{{user.email}}</span>
                    </p> 
                    
                                      
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'

    export default defineComponent({
        props:['users'],
        components: {
            AppLayout,
            Welcome,
        },
    })
</script>
