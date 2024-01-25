<template>
    <div>
        <x-create-edit-template :setup="setup" :selected="selected">
            <form v-on:submit.prevent="submit" action="#" method="POST" enctype="multipart/form-data">
                <x-grid>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Name</template>
                            <template #value><x-input type="text" v-model="form.name" readonly /></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Phone No</template>
                            <template #value><x-input type="text" v-model="form.phone_no" readonly/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Email</template>
                            <template #value><x-input type="email" v-model="form.email" readonly/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Date</template>
                            <template #value><x-input type="date" v-model="form.date" readonly/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Service</template>
                            <template #value><x-input type="text" v-model="form.service" readonly/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>From Time</template>
                            <template #value><x-input type="time" v-model="form.from_time" readonly/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>To Time </template>
                            <template #value><x-input type="time" v-model="form.to_time" readonly/></template>
                        </x-form-group>
                    </x-grid-col>
                    
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Status</template>
                            <template #value>
                                <x-select v-model="form.status">
                                    <option value="">--select--</option>
                                    <option v-for="(status,index) in setup.statuses" :key="index" :value="status.id">{{status.caption}}</option>
                                </x-select>
                            </template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col v-if="form.status == 3">
                        <x-form-group>
                            <template #label>Publish Time</template>
                            <template #value><x-input type="datetime-local" v-model="form.publish_time"/></template>
                        </x-form-group>
                    </x-grid-col>
                </x-grid>
                <div class="flex justify-center py-2">
                    <x-button type="submit">Submit</x-button>
                </div>
            </form>
        </x-create-edit-template>
    </div>
</template>
<script setup>
    // import CreateEditMixin from '@/System/Mixins/CRUD/CreateEditMixin.js'
    import { createEditProps, useCreateEdit } from '@/Composables/useCreateEdit'
    import { ref, reactive, computed  } from 'vue'

    const props = defineProps({...createEditProps})

    const form = reactive({
        uuid: null,
        name: null,
        email: null,
        phone_no: null,
        date: null,
        service: null,
        from_time: null,
        to_time: null,
        status: null,
        publish_time: null,
    })
    
    const show_image = ref('')

    function setData(){
        if (props.cardData != null && props.cardData.uuid != null) {
            form.uuid = props.cardData.uuid;
            form.name = props.cardData.name;
            form.email = props.cardData.email;
            form.phone_no = props.cardData.phone_no;
            form.date = props.cardData.date;
            form.service = props.cardData.service.title;
            form.from_time = props.cardData.timeslot.from_time;
            form.to_time = props.cardData.timeslot.to_time;
            form.status = props.cardData.status;
            form.publish_time = props.cardData.publish_time2;
        }
    }
    
    const { editor,editorConfig, submit, onFileChange, ckeditor, xGrid,
        xFormGroup,
        xGridCol,
        xLoading,
        xPanel,
        xInput,
        xSelect,
        xTextarea,
        xCheckbox,
        xButton,
        AppLayout,
        xCreateEditTemplate, TextInput } = useCreateEdit(props, setData, form )
    
</script>
