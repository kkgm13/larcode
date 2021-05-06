<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <ul>
                    <meet-item v-for="(meet,index) in meetingList" :meet="meet" :key="index"></meet-item>                
                </ul>
            </div>
        </div>
    </div>
</template> 
<script>
import meetItem from "./MeetingComponent"
export default {
    mounted() { // Standard mounting
        console.log('Meeting List Component mounted.')
    },
    components: {
        meetItem
    },
    data: function() { // Grab the initial Data
        return {
            meetingList : [
                {
                    title: "Event 1",
                    start: new Date().toLocaleString(),
                    duration: 1
                },
                {
                    title: "Event 2",
                    start: new Date().toLocaleString(),
                    duration: 1
                },
                {
                    title: "Event 3",
                    start: new Date().toLocaleString(),
                    duration: 1
                },
                {
                    title: "Event Negative",
                    start: new Date().toLocaleString(),
                    duration: 1
                },
            ]
        }
    },
}
</script>