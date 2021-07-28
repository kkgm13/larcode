<template>
<li>{{ meet.title }} - {{meet.schedule.start}} (Duration: {{meet.schedule.duration}}) {{meet.schedule.isRepeat ? 'Repeating every '+meet.schedule.repDays+' day(s)' : ''}}</li>
</template>
<script>
export default {
    mounted(){
        console.log("Single Meeting mounted.");
    },
    props:['meet'],
}
</script>