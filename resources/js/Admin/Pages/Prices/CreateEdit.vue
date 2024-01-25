<template>
    <div>
        <x-create-edit-template :setup="setup" :selected="selected">
            <form v-on:submit.prevent="submit" action="#" method="POST" enctype="multipart/form-data">
                <x-grid>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Name</template>
                            <template #value><x-input type="text" v-model="form.name"/></template>
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
<script>
    import CreateEditMixin from '@/System/Mixins/CRUD/CreateEditMixin'

    export default{
        mixins:[CreateEditMixin],
        data(){
            return{
                form:{
                    uuid: null,
                    name: null,
                    status: null,
                    publish_time: null,
                },
                show_image:'',
            }
        },
        methods:{
            setData(){
                this.form.uuid = this.cardData.uuid;
                this.form.name = this.cardData.name;
                this.form.status = this.cardData.status;
                this.form.publish_time = this.cardData.publish_time2;
            }
        }
    }
</script>
