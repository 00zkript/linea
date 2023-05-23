<template>
    <div class="autocomplete">
        <input
            type="text"
            :name="name"
            :id="id"
            :class="classInput"
            :placeholder="placeholder"
            :value="searchTerm"
            @input="handleInputChange"
            @keydown.down="handleArrowDown"
            @keydown.up="handleArrowUp"
            @keydown.enter="handleEnter"
            >
        <div class="list-result" :class="classList">
            <ul>
                <li
                    v-for="(item, index) in suggestionslist" :key="index"
                    @click="selectSuggestion(item)"
                    v-html="item"
                    >
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
        value: {
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
        suggestions: {
            tyoe: Array,
            default: [],
        },
    },
    data() {
        return {
            searchTerm: this.value,
            suggestionslist: this.suggestions,
            activeIndex: -1
        }
    },
    computed: {
        filteredSuggestions() {
            return this.suggestions.filter(suggestion =>
                suggestion.toLowerCase().includes(this.searchTerm.toLowerCase())
            );
        },
        showSuggestions() {
            return this.filteredSuggestions.length > 0;
        }
    },
    watch: {
        value(newValue) {
            this.searchTerm = newValue;
        }
    },
    methods: {
        handleInputChange(event) {
            const newTerm = event.target.value;
            this.searchTerm = newTerm;
            this.$emit('input', newTerm);
            this.activeIndex = -1;
            this.fetchSuggestions(newTerm);
        },
        handleArrowDown() {
            if (this.activeIndex < this.filteredSuggestions.length - 1) {
                this.activeIndex++;
            }
        },
        handleArrowUp() {
            if (this.activeIndex > 0) {
                this.activeIndex--;
            }
        },
        handleEnter() {
            if (this.activeIndex !== -1) {
                this.selectSuggestion(this.filteredSuggestions[this.activeIndex]);
            }
        },
        selectSuggestion(suggestion) {
            this.searchTerm = suggestion;
            this.$emit('input', suggestion);
            this.activeIndex = -1;
        },
        fetchSuggestions(searchTerm) {
            // Realizar la petición AJAX aquí utilizando la biblioteca o método de tu elección
            // Supongamos que la petición devuelve un arreglo de sugerencias
            // Aquí se utiliza un ejemplo simulado con un tiempo de espera de 500ms
            setTimeout(() => {
                const suggestions = ['Apple', 'Banana', 'Cherry', 'Date'].filter(suggestion =>
                suggestion.toLowerCase().includes(searchTerm.toLowerCase())
                );
                this.suggestions = suggestions;
            }, 500);
        },

        search() {
            this.suggestionslist = this.suggestions.filter( (item, idx) => {
                return item.includes(this.value);
            });

        }
    },
    mounted() {
        console.log('Example component mounted.')
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
