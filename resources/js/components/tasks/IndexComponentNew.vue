<template>
    <div>
      <h1>Task Detail</h1>
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
                        <b-form-checkbox value="description">Description</b-form-checkbox>
                        <b-form-checkbox value="mileage_interval">Mileage Int.</b-form-checkbox>
                    </b-form-checkbox-group>
                </b-form-group>
            </b-col>
            <b-col lg="3" class="my-1">
                <b-button size="sm" pill variant="success" :to="{ name: 'createTask', params: { id: this.$route.params.id}}">
                    Add Task
                </b-button>
            </b-col>
            <b-col lg="3" class="my-1">
            </b-col>
        </b-row>
        <b-table
            :items="tasks"
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
                        
            <template #cell(actions)="row">
                
                <b-button size="sm" pill variant="success" @click="row.toggleDetails">
                    {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
                </b-button>
                <b-button size="sm" pill variant="warning" :to="{name: 'editTask', params: { id: row.item.id }}">
                    Edit
                </b-button>
                <b-button size="sm" pill variant="danger" @click="deleteConf(row.item.id)">
                    Delete
                </b-button>

            </template>

            <template #row-details="row">
                <b-card>
                    <ul>
                        <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
                    </ul>
                </b-card>
            </template>
        
        </b-table>
        <b-row>                
            <b-col sm="2" md="2" class="my-1">
                <b-form-group
                    label="Per page"
                    label-for="per-page-select"
                    label-cols-sm="6"
                    label-cols-md="6"
                    label-cols-lg="6"
                    
                    >
                    <b-form-select
                        id="per-page-select"
                        v-model="perPage"
                        :options="pageOptions"
                       
                    ></b-form-select>
                </b-form-group>
            
            </b-col>
        </b-row>
        <b-row>
            <b-col sm="3" md="3" class="my-1">
                <b-pagination
                    v-model="currentPage"
                    :total-rows="totalRows"
                    :per-page="perPage"
                    first-text="First"
                    prev-text="Prev"
                    next-text="Next"
                    last-text="Last"
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
                { key: 'mileage_interval', label: 'HR||MI Int.', sortable: true , headerTitle: "Hour or Mile interval", thStyle: {width:"10%"}},
                { key: 'month_interval', label: 'Mo. Int.', sortable: true, headerTitle: "Month interval", thStyle: {width:"10%"} },
                { key: 'last_completed_miles', label: 'Comp. HR||MI', sortable: true, headerTitle: "Hour or Mile at completion", thStyle: {width:"10%"} },
                { key: 'last_completed_date', label: 'Comp. Date', sortable: true, headerTitle: "Last completed date", thStyle: {width:"10%"} },
                { key: 'description', label: 'Description', sortable: false , headerTitle: "Task description", thStyle: {width:"40%"}},
                { key: 'actions', label: 'Actions', thStyle: {width:"20%"}}
                ],
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
                tasks: []
            }
        },
        methods: {
            showTasks: function () {
                console.log('/tasks');
                axios.get(`/api/tasks/${this.$route.params.id}`).then(function (res) {
                    // console.log('data:', res.data);
                    this.tasks = res.data;
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
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                    let uri = `/api/task/delete/${id}`;
                    this.axios.delete(uri).then(response => {
                        this.tasks.splice(this.tasks.findIndex(task => task.id === id), 1);
                    })
                    console.log("deleted");
                    Swal.fire(
                    'Task has been deleted.',
                    'success'
                    )
                    } // result.value
                }); //then
            }  //deleteConf 
        },
        computed: {
            
            totalRows: {
                get() {
                    return this.tasks.length;
                },
                set(value) {
                    this.tasks.length = value;
                },
            },
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
            this.totalRows = this.tasks.length
        },
        created: function () {
            console.log('..showTasks');
            this.showTasks()
        }
    }
</script>
