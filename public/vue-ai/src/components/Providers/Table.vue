<template>
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>URL</th>
                <th>Active</th>
                <th>Resident of Russian Federation</th>
                <th>Need proxy</th>
                <th>#ID</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(record, ind) in records['list']" v-bind:key="ind">
                <td class="clickable" v-html="record['id']" @click="$emit('loadRecord', record['id'])"></td>
                <td v-html="record['name']"></td>
                <td v-html="record['description']"></td>
                <td>
                    <a :href="record['url']" v-html="record['url']"></a>
                </td>
                <td>
                    <span v-if="record['active']">Yes</span>
                    <span v-else>No</span>
                </td>
                <td>
                    <span v-if="record['rfResident']">Yes</span>
                    <span v-else>No</span>
                </td>
                <td>
                    <span v-if="record['needProxy']">Yes</span>
                    <span v-else>No</span>
                </td>
                <td class="clickable" v-html="record['id']" @click="$emit('deleteRecord', record['id'])"></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>
                    <button @click="getRecords">Refresh</button>
                </th>
                <th>
                    <input type="search" placeholder="Search.." v-model="pagination['search']" @input="getRecords">
                    <button @click="clearSearch">X</button>
                </th>
                <th>
                    <button @click="decreasePage"><-</button>
                    <select v-model="pagination['perPage']" @change="changePagination">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <button @click="increasePage">-></button>
                </th>
                <th colspan="5">
                    Page {{ page }} of {{ pages }}, total {{ total }} records
                </th>
            </tr>
        </tfoot>
    </table>
</template>
<script>
export default {
    emits: [
        'loadRecord',
        'deleteRecord',
    ],
    props: {
        url: {
            type: String,
            default: 'localhost',
        },
    },
    data() {
        return {
            pagination: {
                page: 1,
                perPage: 10,
                search: '',
            },
            records: {
                list: [],
                total: 0,
            }
        };
    },
    computed: {
        offset() {
            return (this.pagination['page'] - 1) * this.pagination['perPage'];
        },
        limit() {
            return this.pagination['perPage'];
        },
        search() {
            return this.pagination['search'];
        },
        page() {
            return this.pagination['page'];
        },
        pages() {
            return Math.ceil(this.records['total'] / this.pagination['perPage']);
        },
        total () {
            return this.records['total'];
        }
    },
    methods: {
        async getRecords() {
            const url = `${this.url}/providers/${this.offset}/${this.limit}/${this.search}`;
            const response = await fetch(url, {method: 'GET'});

            try {
                if (response.ok) {
                    const result = await response.json();

                    this.records['list'] = result['records'];
                    this.records['total'] = result['totalRecords'];
                } else {
                    console.error('Server error');
                }
            } catch {
                console.error('Fatal error');
            }
        },
        clearSearch() {
            this.pagination['search'] = '';
            this.getRecords();
        },
        changePagination() {
            this.pagination['page'] = 1;
            this.getRecords();
        },
        decreasePage() {
            if (this.pagination['page'] <= 1) {
                return;
            }
            this.pagination['page']--;
            this.getRecords();
        },
        increasePage() {
            if (this.pagination['page'] >= this.pages) {
                return;
            }
            this.pagination['page']++;
            this.getRecords();
        }
    },
    created() {},
    mounted() {
        this.getRecords();
    },
};
</script>

<style scoped>
    .clickable {
        cursor: pointer;
    }
</style>
