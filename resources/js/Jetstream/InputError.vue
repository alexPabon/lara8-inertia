<template>
    <div v-show="message">
        <p class="text-sm text-red-600">
            {{ __(message) }}
        </p>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: ['message']
    })
</script>
