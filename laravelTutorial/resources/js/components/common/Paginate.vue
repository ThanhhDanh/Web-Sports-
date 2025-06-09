<template>
    <div class="pagination flex space-x-2 mt-4">
        <!-- "Previous" -->
        <button
            @click="changePage(pagination.current_page - 1)"
            :disabled="pagination.current_page === 1"
            class="px-3 py-2 bg-gray-300 text-gray-700 rounded disabled:opacity-50"
        >
            «
        </button>

        <!-- List page -->
        <button
            v-for="page in pages"
            :key="page"
            @click="changePage(page)"
            :class="{
                'bg-indigo-600 text-white': page === pagination.current_page,
                'bg-gray-200 text-gray-800': page !== pagination.current_page,
            }"
            class="px-3 py-2 rounded"
        >
            {{ page }}
        </button>

        <!--"Next" -->
        <button
            @click="changePage(pagination.current_page + 1)"
            :disabled="pagination.current_page === pagination.last_page"
            class="px-3 py-2 bg-gray-300 text-gray-700 rounded disabled:opacity-50"
        >
            »
        </button>
    </div>
</template>

<script>
export default {
    props: {
        pagination: Object,
    },
    computed: {
        pages() {
            let pages = [];
            for (let i = 1; i <= this.pagination.last_page; i++) {
                pages.push(i);
            }
            return pages;
        },
    },
    methods: {
        changePage(page) {
            if (page >= 1 && page <= this.pagination.last_page) {
                this.$emit('page-changed', page);
            }
        },
        fetchCourses(page = 1) {
            axios.get(`/courses?page=${page}`).then((response) => {
                this.courses = response.data.data;
                this.pagination = response.data;
            });
        },
    },
};
</script>
