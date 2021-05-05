<template>
    <li>{{ meet.title }} - {{meet.start}} ({{meet.duration}} hour)</li>
</template>
<script>
export default {
    mounted(){
        console.log("Single Meeting mounted.");
        console.log(this.meet)
    },
    props:['meet'],
}
</script>