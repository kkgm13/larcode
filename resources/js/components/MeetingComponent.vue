<template>
    <li>{{ meet.title }} - {{meet.start}} ({{meet.duration}} hour)</li>
</template>
<script>
export default {
    mounted(){
        console.log("Single Meeting mounted.");
    },
    props:['meet'],
}
</script>