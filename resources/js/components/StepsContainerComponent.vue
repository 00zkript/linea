<template>
    <div class="steps-container">
        <slot/>
    </div>
</template>

<script>
export default {

}
</script>


<style>
    .steps-container {
        display: flex;
        flex-direction: column;
        margin-left: 60px;
    }
</style>
