<template>
    <div>
        <x-create-edit-template :setup="setup" :selected="selected">
            <form v-on:submit.prevent="submit" action="#" method="POST" enctype="multipart/form-data">
                <x-grid>
                     <x-grid-col>
                        <x-form-group>
                            <input type="hidden" name="" v-model="form.destination_id">
                            <template #label>Destination </template>
                            <template #value><x-input type="text" v-model="form.destination" readonly/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Customer</template>
                            <template #value><x-input type="text" v-model="form.name" readonly/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Email</template>
                            <template #value><x-input type="text" v-model="form.email" readonly/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Phone </template>
                            <template #value><x-input type="text" v-model="form.phone_no" readonly/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Resident Country</template>
                            <template #value><x-input type="text" v-model="form.resident_country" readonly/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Check In Date</template>
                            <template #value><x-input type="text" v-model="form.check_in" readonly/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Check Out Date</template>
                            <template #value><x-input type="text" v-model="form.check_out" readonly/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>No. of Adults</template>
                            <template #value><x-input type="text" v-model="form.adults_no" readonly/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>No. of Children</template>
                            <template #value><x-input type="text" v-model="form.children_no" readonly/></template>
                        </x-form-group>
                    </x-grid-col>
                    <x-grid-col>
                        <x-form-group>
                            <template #label>Message</template>
                            <template #value><x-input type="text" v-model="form.message" readonly/></template>
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
                    phone_no: null,
                    resident_country: null,
                    check_in: null,
                    check_out: null,
                    adults_no: null,
                    children_no: null,
                    message: null,
                    email: null,
                    destination_id: null,
                    destination: null,
                    status: null,
                },
                show_image:'',
            }
        },
        methods:{
            setData(){
                console.log(this.cardData);
                this.form.uuid = this.cardData.uuid;
                this.form.name = this.cardData.name;
                this.form.email = this.cardData.email;
                this.form.message = this.cardData.message;
                this.form.phone_no = this.cardData.phone_no;
                this.form.resident_country = this.cardData.resident_country;
                this.form.check_out = this.cardData.check_out;
                this.form.check_in = this.cardData.check_in;
                this.form.adults_no = this.cardData.adults_no;
                this.form.children_no = this.cardData.children_no;
                this.form.destination_id = this.cardData.destination_id;
                this.form.destination = this.cardData.destination.title;
                this.form.status = this.cardData.status;
            }
        }
    }
</script>
