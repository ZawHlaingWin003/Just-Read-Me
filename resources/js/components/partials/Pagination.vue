<template>
    <pre>
        {{ data.meta }}
    </pre>

    <!-- <div class="container flex justify-center mx-auto my-4">
        <ul class="flex">
            <li v-if="data.meta.current_page > 1">
                <button
                    class="
                        h-10
                        px-5
                        text-gray-600
                        bg-white
                        border border-r-0 border-gray-600
                        hover:bg-gray-100
                    "
                    @click.prevent="change(data.meta.current_page - 1)"
                >
                    Prev
                </button>
            </li>
            <li v-for="page in pages" :key="page">
                <button
                    :class="[
                        page == data.meta.current_page
                            ? 'text-white bg-blue border-r border-blue'
                            : 'hover:text-white hover:bg-blue text-blue border-r border-grey-light',
                        'block px-3 py-2',
                    ]"
                    class="
                        h-10
                        px-5
                        text-gray-600
                        bg-white
                        border border-r-0 border-gray-600
                    "
                    @click.stop="change(page)"
                >
                    {{ page }}
                </button>
            </li>
            <li>
                <button
                    class="
                        h-10
                        px-5
                        text-white
                        bg-gray-600
                        border border-r-0 border-gray-600
                    "
                >
                    3
                </button>
            </li>
            <li v-if="data.meta.current_page < data.meta.last_page">
                <button
                    class="
                        h-10
                        px-5
                        text-gray-600
                        bg-white
                        border border-gray-600
                        hover:bg-gray-100
                    "
                    @click.prevent="change(data.meta.current_page + 1)"
                >
                    Next
                </button>
            </li>
        </ul>
    </div> -->
</template>

<script>
export default {
    props: {
        data: {
            type: Object,
            required: true,
        },
        offset: {
            type: Number,
            default: 4,
        },
    },
    computed: {
        pages() {
            if (!this.data.meta.to) {
                return null;
            }
            let from = this.data.meta.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            let to = from + this.offset * 2;
            if (to >= this.data.meta.last_page) {
                to = this.data.meta.last_page;
            }
            let pages = [];
            for (let page = from; page <= to; page++) {
                pages.push(page);
            }
            return pages;
        },
    },
    methods: {
        change: function (page) {
            this.data.meta.current_page = page;
            this.$emit("paginate");
        },
    },
};
</script>