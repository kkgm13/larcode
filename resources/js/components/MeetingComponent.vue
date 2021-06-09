<template>
<li>{{ meet.title }} - {{meet.start}} (Duration: {{meet.duration}})</li>
</template>
<script>
export default {
    mounted(){
        console.log("Single Meeting mounted.");
    },
    props:['meet'],
}
</script>