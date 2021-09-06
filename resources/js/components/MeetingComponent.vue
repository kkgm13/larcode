<template>
<ul v-if="schedule.isRepeat">
    <li>"Repeating every {{schedule.repDays}} day(s)</li>
    <div style="overflow: scroll; width: 250px; height: 100px;">
        <div>
            <li>{{new Date(Date.parse(schedule.start)).toDateString()}} @ {{new Date(Date.parse(schedule.start)).toLocaleTimeString()}}</li>
            <li>{{schedule.duration}}</li>
            <hr>
        </div>
    </div>
</ul>
<ul v-else>
    <li>{{new Date(Date.parse(schedule.start)).toDateString()}} @ {{new Date(Date.parse(schedule.start)).toLocaleTimeString()}}</li>
    <li>{{schedule.duration}}</li>
</ul>
</template>
<script>
export default {
    mounted(){
        console.log("Single Meeting mounted.");
    },
    props:['schedule'],
    methods:{
        sql2date() {
            this.schedule = this.schedule.map(function sched(){
                var t = this.schedule.start.split(/[- :]/)
            })
        }
    }
}
</script>