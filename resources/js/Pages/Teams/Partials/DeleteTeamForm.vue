<template>
    <jet-action-section>
        <template #title>
            {{__('Delete Team')}}
        </template>

        <template #description>
            {{__('Permanently delete this team.')}}
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                {{__('Once a team is deleted, all of its resources and data will be permanently deleted. Before deleting this team, please download any data or information regarding this team that you wish to retain.')}}
            </div>

            <div class="mt-5">
                <jet-danger-button @click="confirmTeamDeletion">
                    {{__('Delete Team')}}
                </jet-danger-button>
            </div>

            <!-- Delete Team Confirmation Modal -->
            <jet-confirmation-modal :show="confirmingTeamDeletion" @close="confirmingTeamDeletion = false">
                <template #title>
                    {{__('Delete Team')}}
                </template>

                <template #content>
                    {{__('Are you sure you want to delete this team? Once a team is deleted, all of its resources and data will be permanently deleted.')}}
                </template>

                <template #footer>
                    <jet-secondary-button @click="confirmingTeamDeletion = false">
                        {{__('Cancel')}}
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click="deleteTeam" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        {{__('Delete Team')}}
                    </jet-danger-button>
                </template>
            </jet-confirmation-modal>
        </template>
    </jet-action-section>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetActionSection from '@/Jetstream/ActionSection.vue'
    import JetConfirmationModal from '@/Jetstream/ConfirmationModal.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

    export default defineComponent({
        props: ['team'],

        components: {
            JetActionSection,
            JetConfirmationModal,
            JetDangerButton,
            JetSecondaryButton,
        },

        data() {
            return {
                confirmingTeamDeletion: false,
                deleting: false,

                form: this.$inertia.form()
            }
        },

        methods: {
            confirmTeamDeletion() {
                this.confirmingTeamDeletion = true
            },

            deleteTeam() {
                this.form.delete(route('teams.destroy', this.team), {
                    errorBag: 'deleteTeam'
                });
            },
        },
    })
</script>
