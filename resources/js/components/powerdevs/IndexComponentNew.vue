<template>
    <div>
        <b-row>

            <b-col lg="3" class="my-1">
                <b-form-group
                    label="Filter"
                    label-for="filter-input"
                    label-cols-sm="3"
                    label-align-sm="right"
                    label-size="sm"
                    class="mb-0"
                    >
                    <b-input-group size="sm">
                        <b-form-input
                            id="filter-input"
                            v-model="filter"
                            type="search"
                            placeholder="Type to Search"
                            size="sm"
                        ></b-form-input>

                        <b-input-group-append>
                            <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>

            <b-col lg="3" class="my-1">
                <b-form-group
                v-model="sortDirection"
                label="Filter On"
                description="Leave all unchecked to filter on all data"
                label-cols-sm="3"
                label-align-sm="right"
                label-size="sm"
                class="mb-0"
                v-slot="{ ariaDescribedby }"
                >
                <b-form-checkbox-group
                        v-model="filterOn"
                        :aria-describedby="ariaDescribedby"
                        class="mt-1"
                    >
                        <b-form-checkbox value="make">Make</b-form-checkbox>
                        <b-form-checkbox value="model">Model</b-form-checkbox>
                    </b-form-checkbox-group>
                </b-form-group>
            </b-col>
            <b-col lg="3" class="my-1">
                <b-button size="sm" pill variant="success" :to="{name: 'createPowerDev'}">
                    Add Power Device
                </b-button>
            </b-col>
            <b-col lg="3" class="my-1">
            </b-col>
        </b-row>
        <b-table
            :items="motors"
            :fields="fields"
            sort-icon-left
            responsive="sm"
            :current-page="currentPage"
            :per-page="perPage"
            :filter="filter"
            :filter-included-fields="filterOn"
            :sort-by.sync="sortBy"
            :sort-desc.sync="sortDesc"
            :sort-direction="sortDirection"
            stacked="md"
            show-empty
            small
            @filtered="onFiltered"
        >
            <template #cell(avatar)="row">
                <b-img :src="'/image/'+ row.item.avatar" width="88" height="50"></b-img>
            </template>
            
            <template #cell(actions)="row">
                
                <b-button size="sm" pill variant="success" @click="row.toggleDetails">
                    {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
                </b-button>
                <b-button size="sm" pill variant="warning" :to="{name: 'editPowerDev', params: { id: row.item.id }}">
                    Edit
                </b-button>
                <b-button size="sm" pill variant="info" :to="{name: 'tasks', params: { id: row.item.id }}">
                    Tasks
                </b-button>
                <b-button size="sm" pill variant="info" :to="{name: 'services', params: { id: row.item.id }}">
                    Services
                </b-button>
                <b-button size="sm" pill variant="danger" @click="deleteConf(row.item.id)">
                    Delete
                </b-button>

            </template>

            <template #row-details="row">
                <b-card>
                    <ul>
                        <b-img :src="'/image/'+ row.item.avatar" width="175" height="100"></b-img>
                        <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
                    </ul>
                </b-card>
            </template>
        
        </b-table>
        <b-row>                
            <b-col sm="2" md="3" class="my-1">
                <b-form-group
                    label="Per page"
                    label-for="per-page-select"
                    label-cols-sm="6"
                    label-cols-md="6"
                    label-cols-lg="6"
                    label-align-sm="right"
                    label-size="sm"
                    class="mb-0"
                    >
                    <b-form-select
                        id="per-page-select"
                        v-model="perPage"
                        :options="pageOptions"
                        size="sm"
                    ></b-form-select>
                </b-form-group>
            </b-col>
            <b-col sm="10" md="9" class="my-1">
            </b-col>
            <b-col sm="3" md="3" class="my-1">
                <b-pagination
                    v-model="currentPage"
                    :total-rows="totalRows"
                    :per-page="perPage"
                    align="right"
                    size="sm"
                    class="my-0"
                ></b-pagination>
            </b-col>
        </b-row>
    </div>
    
</template>

<style>
  .trash {
    color: red;
    background-color:lightgray;
  }
  .edit {
    color: orange;
    background-color:lightgray;
  }
  .eyeball {
    color: navy;
    background-color:lightgray;
  }
</style>

<script>
    export default {
        data() {
            return {
                sortBy: 'ID',
                sortDesc: false,
                fields: [
                { key: 'make', label: 'Make', sortable: false, headerTitle: "Brand" },
                { key: 'model', label: 'Model', sortable: false, headerTitle: "Model" },
                { key: 'mfg_year', label: 'Year', sortable: true, headerTitle: "Model Year" },
                { key: 'current_mileage', label: 'Hours', sortable: true, headerTitle: "Current Hours" },
                { key: 'avatar', label: 'Avatar', sortable: false, headerTitle: "Model photo" },
                { key: 'actions', label: 'Actions'}
                ],
                totalRows: 1,
                currentPage: 1,
                perPage: 5,
                pageOptions: [5, 10, 15, { value: 100, text: "Show a lot" }],
                sortBy: '',
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                filterOn: [],
                infoModal: {
                id: 'info-modal',
                title: '',
                content: ''
                },
                motors: []
            }
        },
        methods: {
            showMotors: function () {
                console.log('/motors');
                axios.get('/api/motors').then(function (res) {
                   // console.log('data:', res.data);
                    this.motors = res.data.data;
                }.bind(this));
            },
            info(item, index, button) {
                this.infoModal.title = `Row index: ${index}`
                this.infoModal.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', this.infoModal.id, button)
            },
            resetInfoModal() {
                this.infoModal.title = ''
                this.infoModal.content = ''
            },
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            deleteConf(id) {
            // $swal functions calls SweetAlert2
                Swal.fire({
                title: 'Are you sure?',
                text: "You will permanently delete tasks/services too!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                    let uri = `/api/motor/delete/${id}`;
                    this.axios.delete(uri).then(response => {
                        this.motors.splice(this.motors.findIndex(motor => motor.id === id), 1);
                    })
                    console.log("deleted");
                    Swal.fire(
                    'Deleted!',
                    'Power Device has been deleted.',
                    'success'
                    )
                    } // result.value
                }); //then
            }  //deleteConf 
        },
        computed: {
            sortOptions() {
                // Create an options list from our fields
                return this.fields
                .filter(f => f.sortable)
                .map(f => {
                    return { text: f.label, value: f.key }
                })
            }
        },
        mounted() {
            // Set the initial number of items
            this.totalRows = this.motors.length
        },
        created: function () {
            console.log('..showMotors');
            this.showMotors()
        }
    }
</script>
