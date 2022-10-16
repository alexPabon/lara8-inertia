<template>
    <div v-if="hasPages">

        <div class="min-w-full sm:hidden pb-3">
            <!-- small window view    -->
            <p class="text-sm text-gray-700 leading-5">
                {{ __('Showing') }}

                <span v-if="firstItem" class="font-medium">{{ firstItem }}</span>
                {{ __('to') }}
                <span v-if="firstItem" class="font-medium">{{ lastItem }}</span>

                <span v-else class="font-medium">{{ count }}</span>

                {{ __('of') }}
                <span class="font-medium">{{ total }}</span>
                {{ __('results') }}
            </p>
            <!-- *******************************************       -->
        </div>


        <nav role="navigation" :aria-label=" __('Pagination Navigation')" class="flex items-center justify-between">

            <div class="flex justify-between flex-1 sm:hidden">
                <!-- small window view    -->
                <span v-if="onFirstPage"
                      v-html="previous"
                      class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">

                </span>

                <a v-else
                   v-html="previous"
                   v-on:click.prevent="changePage"
                   :href="previousPageUrl"
                   class="relative change_page inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">

                </a>

                <a v-if="hasMorePages"
                   v-html="next"
                   v-on:click.prevent="changePage"
                   :href="nextPageUrl"
                   class="relative change_page inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">

                </a>

                <span v-else v-html="next"
                      class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">

                </span>
                <!--*******************-->
            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700 leading-5">
                        {{ __('Showing') }}

                        <span v-if="firstItem" class="font-medium">{{ firstItem }}</span>
                        {{ __('to') }}
                        <span v-if="firstItem" class="font-medium">{{ lastItem }}</span>

                        <span v-else class="font-medium">{{ count }}</span>


                        {{ __('of') }}
                        <span class="font-medium">{{ total }}</span>
                        {{ __('results') }}
                    </p>
                </div>

                <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">

                        <span v-if="onFirstPage" aria-disabled="true" :aria-label="__('previous')">
                            <span
                                class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5"
                                aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </span>
                        </span>

                        <a v-else
                           v-on:click.prevent="changePage"
                           :href="previousPageUrl"
                           class="change_page relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                           aria-label="previous">
                            <svg :href.prop="previousPageUrl" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path :href.prop="previousPageUrl" fill-rule="evenodd"
                                      d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                      clip-rule="evenodd"/>
                            </svg>


                        </a>

                    <!-- ********** pagination elements ********-->

                    <!--*********** separtator *************-->




                    <!--                        Array links-->

                    <span v-if="isArray">
                        <span v-for="page in allLinks">

                            <span v-if="page.label==currentPage" aria-current="page">
                                <span v-html="page.label" :class="[page.active?'Active':'']"
                                      class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-white border border-gray-300 bg-blue-700 cursor-default leading-5"></span>
                            </span>

                            <a v-else-if="!isNaN(page.label)"
                               v-on:click.prevent="changePage"
                               :href="page.url" v-html="page.label"
                               :class="[page.active?'Active':'']"
                               class="change_page relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none ring-gray-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                               :aria-label="__('Go to page') + page.label">

                            </a>

                            <span v-else-if="page.label=='...'" aria-disabled="true">
                                <span
                                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">
                                    {{page.label}}
                                </span>
                            </span>

                        </span>
                    </span>


                    <!--********** Next Page Link **********-->

                    <a v-if="hasMorePages"
                       v-on:click.prevent="changePage"
                       :href="nextPageUrl" rel="next"
                       class="change_page relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                       :aria-label="next">
                        <svg :href.prop="nextPageUrl" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path :href.prop="nextPageUrl" fill-rule="evenodd"
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </a>

                    <span v-else aria-disabled="true" :aria-label="__('next')">
                        <span
                            class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md leading-5"
                            aria-hidden="true">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </span>
                    </span>
                </span>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>

import {isString} from "lodash";
import {isArray} from "lodash";

export default {
    props: ['links', 'paginationVue'],
    name: "paginationComponent",
    data() {

        return {
            allLinks: this.links,
            currentPage: this.paginationVue.currentPage,
            previousPageUrl: this.paginationVue.previousPageUrl,
            nextPageUrl: this.paginationVue.nextPageUrl,
            hasPages: this.paginationVue.hasPages,
            onFirstPage: this.paginationVue.onFirstPage,
            hasMorePages: this.paginationVue.hasMorePages,
            firstItem: this.paginationVue.firstItem,
            lastItem: this.paginationVue.lastItem,
            count: this.paginationVue.count,
            total: this.paginationVue.total,
            next: this.paginationVue.next,
            previous: this.paginationVue.previous,
            isString: isString(this.links),
            isArray: isArray(this.links),
        }

    },
    methods: {
        changePage(element) {

            let url = element.target.href;


            this.$emit('changePage', url);
            this.$emit('restartProgress');

        }
    },
    watch: {

        paginationVue: function () {
            // console.log('pagi');
            //
            // console.log(this.allLinks);
            // console.log(this.links);
            //
            // console.log('pagaaa');
            // console.log(this.paginationVue);

            this.currentPage = this.paginationVue.currentPage;
            this.previousPageUrl = this.paginationVue.previousPageUrl;
            this.nextPageUrl = this.paginationVue.nextPageUrl;
            this.hasPages = this.paginationVue.hasPages;
            this.onFirstPage = this.paginationVue.onFirstPage;
            this.hasMorePages = this.paginationVue.hasMorePages;
            this.firstItem = this.paginationVue.firstItem;
            this.lastItem = this.paginationVue.lastItem;
            this.count = this.paginationVue.count;
            this.total = this.paginationVue.total;
            this.next = this.paginationVue.next,
            this.previous = this.paginationVue.previous,
            this.isString = isString(this.links);
            this.isArray = isArray(this.links);
            this.allLinks = this.links;

        },
    }
}
</script>

<style scoped>

</style>
