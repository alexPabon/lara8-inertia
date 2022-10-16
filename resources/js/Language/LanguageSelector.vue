<template>
    <span class="mx-3">
        <a :href="route('language', ['es'])" :class="selectable_locale == 'es'?classes:classesGrey">
            ES
        </a>
        <a :href="route('language', ['en'])" :class="selectable_locale == 'en'?classes:classesGrey">
            EN
        </a>
    </span>
</template>

<script>

export default {


    computed: {
        selectable_locale() {
            return this.$page.props.locale;
        },
        classes() {
            return 'border_b_3 border-purple-600 inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-red-900 hover:text-red-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
        },
        classesGrey() {
            return 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-red-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
        },

    },
}
</script>
