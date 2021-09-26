<template>
    <app-layout title="Extensions">
        <template #header>            
            <div class="flex justify-start">
                <h2 class="font-semibold text-xl text-gray-800 leading-tigh">
                    {{__('Extensions')}}
                </h2>
                <div class="mx-2">
                    <jet-button class="m-1" >
                        {{__('Upload')}} Excel
                    </jet-button>
                    <jet-button class="m-1">
                        {{__('Download')}} Excel
                    </jet-button>
                    <jet-button class="m-1">
                        {{__('Template')}} Excel
                    </jet-button>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <h1>Aqui las extensiones</h1>                  
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetButton from '@/Jetstream/Button.vue'
    

    export default defineComponent({
        components: {
            AppLayout,
            JetButton,
            
        },
    })
</script>
