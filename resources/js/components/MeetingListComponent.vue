<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <ul>
                    <li v-for="(meet,index) in meetingList" :key="index">
                        {{ meet.title }}-{{meet.start}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template> 
<script>
    export default {
        mounted() { // Standard mounting
            console.log('Meeting List Component mounted.')
            // console.log(this.meetingList)
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
                        start: new Date().setMonth(7).toLocaleString(),
                        duration: 1
                    },
                    {
                        title: "Event Negative",
                        start: new Date().setMonth(4).toLocaleString(),
                        duration: 1
                    },
                ]
            }
        },
    }
</script>