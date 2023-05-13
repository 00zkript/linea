<template>
    <div class="step" :class="{ active: currentValue == number, completed: currentValue > number }">
        <div class="step-title" @click="showContent = !showContent" >
            <div class="step-number"><span v-text="number"></span><i class="fas fa-check"></i></div>
            <h3 v-text="title"></h3>
        </div>
        <div class="step-content" v-if=" currentValue == number || showContent && currentValue > number" >
            <div class="step-header"></div>
            <div class="step-body">
                <slot/>
            </div>
            <div class="step-footer">
                <button class="btn btn-primary next-step" @click="showContent = false; $emit('next')" >Siguiente</button>
                <button class="btn btn-secondary cancel-step">Cancelar</button>
            </div>
        </div>

    </div>


</template>

<script>
export default {
    props: [ 'title', 'number', 'currentValue' ],
    data() {
        return {
            showContent: false
        }
    },
    methods:{
        toggleContent() {
            this.showContent = !this.showContent;
        }
    }


}
</script>

<style>
    .step {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .step-title{
        display: flex;
        align-items: center
    }
    .step-title h3{
        margin-left: 1rem;
    }

    .step-title .step-number {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        font-weight: bold;
        font-size: 16px;
        background-color: #ddd;
        color: #000;
    }
    .step .step-title .step-number span{
        display: block;
    }
    .step .step-title .step-number i{
        display: none;
    }


    .step-content {
        /*display: none;*/
        margin-left: 3rem;
    }
    .step-footer{
        text-align: center;
    }

    .step.active .step-number {
        background-color: #007bff;
        color: #fff;
    }

    /*.step.active .step-content {
        display: block;
    }*/

    .step.completed .step-number {
        background-color: #28a745;
        color: #fff;
    }
    .step.completed .step-title .step-number span{
        display: none;
    }
    .step.completed .step-title .step-number i{
        display: block;
    }


</style>
