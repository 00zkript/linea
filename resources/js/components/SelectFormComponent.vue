<template>
    <div>
        <label :for="id">
            {{ label }}
            <span v-if="required" class="text-danger">(*)</span>
        </label>
        <select :class="className" :name="name" :id="id" v-model="selected" :required="required" :readonly="readonly" @change="handleChange">
            <option :value="null" hidden>[---Seleccione---]</option>
            <option v-for="(item,index) in collect" :key="index" :value="item[valueKey]">
                {{ item[valueLabel] }}
            </option>
        </select>
    </div>
</template>

<script>
    export default {
        props: {
            label: String,
            id: String,
            name: {
                type: String,
                default: "",
            },
            className: [String, Object],
            readonly: {
                type: Boolean,
                default: false,
            },
            required: {
                type: Boolean,
                default: false,
            },
            collect: {
                type: Array,
                default: () => [],
            },
            valueKey: {
                type: [String, Number],
                required: true,
            },
            valueLabel: {
                type: String,
                required: true,
            },
            value: [String, Number],
        },
        data() {
            return {
                selected: this.value || null,
            };
        },
        watch: {
            selected(newVal) {
                this.$emit("input", newVal); //setea v-model
                this.findElement(newVal);
            },
        },
        methods: {
            findElement(newVal) {
                const item = this.collect.find((ele) => ele[this.valueKey] === newVal);
                this.$emit("itemSelected", item);
            },
            handleChange(event) {
                this.findElement(this.selected);
                this.$emit('change', event);
            },
        },
    };
</script>
