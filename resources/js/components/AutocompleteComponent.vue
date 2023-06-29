<template>
    <div class="autocomplete">
        <input
            type="text"
            :name="name"
            :id="id"
            :class="classInput"
            :placeholder="placeholder"

            v-model="searchValue"
            @input="getSuggestions"

            >
        <div class="list-result" :class="classList" v-if="suggestions.length > 0">
            <ul>
                <li
                    v-for="(item, index) in suggestions" :key="index"
                    @click="selectSuggestion(item, 'autocomplete-item-'+index)"
                    :ref="'autocomplete-item-'+index"
                    >
                    <slot name="item" :item="item" >
                        {{ item[suggestionLabel] }}
                    </slot>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        classList:{
            tyoe: [String,Object],
            default: '',
        },
        classInput: {
            tyoe: [String,Object],
            default: '',
        },
        placeholder: {
            tyoe: String,
            default: '',
        },
        id: {
            tyoe: String,
            default: '',
        },
        name: {
            tyoe: String,
            default: '',
        },

        url: String,
        value: {
            tyoe: Object,
            default() {
                return {};
            },
        },
        valueDefault: {
            tyoe: String,
            default: '',
        },
        suggestionLabel: {
            type: String,
            default: 'name',
        },
        limit: {
            type: Number,
            default: 5,
        },
        params: {
            tyoe: Object,
            default() {
                return {};
            },
        },
    },
    data() {
        return {
            suggestions: [],
            searchValue: this.valueDefault,
        }
    },
    methods: {
        getSuggestions() {
            axios({
                url: this.url,
                params: {
                    ...this.params,
                    txtBuscar: this.searchValue,
                    limit: this.limit,
                }
            })
            .then( response => {
                const data = response.data;
                this.suggestions = data;
            })
        },

        selectSuggestion(suggestion, ref) {
            const li = this.$refs[ref][0];

            this.searchValue = (li.innerText).trim();
            this.$emit('input', suggestion);
            this.suggestions = [];
        },
    },
    mounted() {
    }
}
</script>


<style>
.autocomplete{
    position: relative;
}

.autocomplete .list-result{
    position: absolute;
    border: 1px solid;
    border-radius: 14px;
    background-color: #fff;
    z-index: 1;
}

.list-result {
    width: 100%;
}

.list-result ul{
    list-style: none;
    padding: 0;
    margin: 0;
}

.list-result li{
    padding-top: 0.3rem;
    padding-bottom: 0.3rem;
    padding-left: 1.5rem;
    padding-right: 1.5rem;
}

.list-result li:hover{
    background-color: #5046e5;
    color: #fff;
}

</style>
