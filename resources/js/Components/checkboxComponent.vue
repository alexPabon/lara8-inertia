<template>
<span style="position: relative; display: inline-block">
    <label :for="idComp" class="containerCheck">
        <input v-on:change="castItemToParent" type="checkbox" :name="name" :id="idComp" :index="index"
               v-bind:checked="check==1?true:false">
        <span class="tooltipChecbox" :class="'checkmark_custo '+ classValue"></span>
        <slot/>
    </label>
</span>
</template>

<script>
export default {
    props:["idComp","check","classValue","name","index"],
    data(){
        return{

        }
    },
    methods:{
        castItemToParent(element){
            this.$emit('update',element.target);
        }

    },
}
</script>

<style scoped>

</style>
